<?php

/**
 * Setup and Hooks for the CategoryTree extension, an AJAX based gadget
 * to display the category structure of a wiki
 *
 * @addtogroup Extensions
 * @author Daniel Kinzler, brightbyte.de
 * @copyright © 2006-2008 Daniel Kinzler and others
 * @license GNU General Public Licence 2.0 or later
 */

if( !defined( 'MEDIAWIKI' ) ) {
	echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
	die( 1 );
}

/**
* Constants for use with the mode,
* defining what should be shown in the tree
*/
define('CT_MODE_CATEGORIES', 0);
define('CT_MODE_PAGES', 10);
define('CT_MODE_ALL', 20);

/**
* Constants for use with the hideprefix option,
* defining when the namespace prefix should be hidden
*/
define('CT_HIDEPREFIX_NEVER', 0);
define('CT_HIDEPREFIX_ALWAYS', 10);
define('CT_HIDEPREFIX_CATEGORIES', 20);
define('CT_HIDEPREFIX_AUTO', 30);

/**
 * Options:
 *
 * $wgCategoryTreeMaxChildren - maximum number of children shown in a tree node. Default is 200
 * $wgCategoryTreeAllowTag - enable <categorytree> tag. Default is true.
 * $wgCategoryTreeDynamicTag - loads the first level of the tree in a <categorytag> dynamically.
 *                             This way, the cache does not need to be disabled. Default is false.
 * $wgCategoryTreeDisableCache - disabled the parser cache for pages with a <categorytree> tag. Default is true.
 * $wgCategoryTreeUseCache - enable HTTP cache for anon users. Default is false.
 * $wgCategoryTreeMaxDepth - maximum value for depth argument; An array that maps mode values to
 *                           the maximum depth acceptable for the depth option.
 *                           Per default, the "categories" mode has a max depth of 2,
 *                           all other modes have a max depth of 1.
 * $wgCategoryTreeDefaultOptions - default options for the <categorytree> tag.
 * $wgCategoryTreeCategoryPageOptions - options to apply on category pages.
 * $wgCategoryTreeSpecialPageOptions - options to apply on Special:CategoryTree.
 */

$wgCategoryTreeMaxChildren = 200;
$wgCategoryTreeAllowTag = true;
$wgCategoryTreeDisableCache = true;
$wgCategoryTreeDynamicTag = false;
$wgCategoryTreeHTTPCache = false;
#$wgCategoryTreeUnifiedView = true;
$wgCategoryTreeMaxDepth = array(CT_MODE_PAGES => 1, CT_MODE_ALL => 1, CT_MODE_CATEGORIES => 2);

$wgCategoryTreeExtPath = '/extensions/CategoryTree';
$wgCategoryTreeVersion = '2';  #NOTE: bump this when you change the CSS or JS files!

$wgCategoryTreeOmitNamespace = CT_HIDEPREFIX_CATEGORIES;
$wgCategoryTreeDefaultMode = CT_MODE_CATEGORIES;
$wgCategoryTreeDefaultOptions = array(); #Default values for most options. ADD NEW OPTIONS HERE!
$wgCategoryTreeDefaultOptions['mode'] = NULL; # will be set to $wgCategoryTreeDefaultMode in efCategoryTree(); compatibility quirk
$wgCategoryTreeDefaultOptions['hideprefix'] = NULL; # will be set to $wgCategoryTreeDefaultMode in efCategoryTree(); compatibility quirk
$wgCategoryTreeDefaultOptions['showcount'] = false;
#TODO: hideprefix: always, never, catonly, catonly_if_onlycat

$wgCategoryTreeCategoryPageMode = CT_MODE_CATEGORIES;
$wgCategoryTreeCategoryPageOptions = array(); #Options to be used for category pages
$wgCategoryTreeCategoryPageOptions['mode'] = NULL; # will be set to $wgCategoryTreeDefaultMode in efCategoryTree(); compatibility quirk
$wgCategoryTreeCategoryPageOptions['showcount'] = true;

$wgCategoryTreeSpecialPageOptions = array(); #Options to be used for Special:CategoryTree
$wgCategoryTreeSpecialPageOptions['showcount'] = true;

/**
 * Register extension setup hook and credits
 */
$wgExtensionFunctions[] = 'efCategoryTree';
$wgExtensionCredits['specialpage'][] = array(
	'name' => 'CategoryTree',
	'svn-date' => '$LastChangedDate$',
	'svn-revision' => '$LastChangedRevision$',
	'author' => 'Daniel Kinzler',
	'url' => 'http://www.mediawiki.org/wiki/Extension:CategoryTree',
	'description' => 'Dynamically navigate the category structure',
	'descriptionmsg' => 'categorytree-desc',
);
$wgExtensionCredits['parserhook'][] = array(
	'name' => 'CategoryTree',
	'svn-date' => '$LastChangedDate$',
	'svn-revision' => '$LastChangedRevision$',
	'author' => 'Daniel Kinzler',
	'url' => 'http://www.mediawiki.org/wiki/Extension:CategoryTree',
	'description' => 'Dynamically navigate the category structure',
	'descriptionmsg' => 'categorytree-desc',
);

/**
 * Register the special page
 */
$dir = dirname(__FILE__) . '/';
$wgExtensionMessagesFiles['CategoryTree'] = $dir . 'CategoryTree.i18n.php';
$wgAutoloadClasses['CategoryTreePage'] = $dir . 'CategoryTreePage.php';
$wgAutoloadClasses['CategoryTree'] = $dir . 'CategoryTreeFunctions.php';
$wgAutoloadClasses['CategoryTreeCategoryPage'] = $dir . 'CategoryPageSubclass.php';
$wgSpecialPages['CategoryTree'] = 'CategoryTreePage';
$wgSpecialPageGroups['CategoryTree'] = 'pages';
#$wgHooks['SkinTemplateTabs'][] = 'efCategoryTreeInstallTabs';
$wgHooks['OutputPageParserOutput'][] = 'efCategoryTreeParserOutput';
$wgHooks['ArticleFromTitle'][] = 'efCategoryTreeArticleFromTitle';
$wgHooks['LanguageGetMagic'][] = 'efCategoryTreeGetMagic';


/**
 * register Ajax function
 */
$wgAjaxExportList[] = 'efCategoryTreeAjaxWrapper';

/**
 * Hook it up
 */
function efCategoryTree() {
	global $wgUseAjax, $wgHooks;
	global $wgCategoryTreeDefaultOptions, $wgCategoryTreeDefaultMode, $wgCategoryTreeOmitNamespace;
	global $wgCategoryTreeCategoryPageOptions, $wgCategoryTreeCategoryPageMode;

	# Abort if AJAX is not enabled
	if ( !$wgUseAjax ) {
		wfDebug( 'efCategoryTree: $wgUseAjax is not enabled, aborting extension setup.' );
		return;
	}

	if ( defined( 'MW_SUPPORTS_PARSERFIRSTCALLINIT' ) ) {
		$wgHooks['ParserFirstCallInit'][] = 'efCategoryTreeSetHooks';
	} else {
		efCategoryTreeSetHooks();
	}

	if ( !isset( $wgCategoryTreeDefaultOptions['mode'] ) || is_null( $wgCategoryTreeDefaultOptions['mode'] ) ) {
		$wgCategoryTreeDefaultOptions['mode'] = $wgCategoryTreeDefaultMode;
	}

	if ( !isset( $wgCategoryTreeDefaultOptions['hideprefix'] ) || is_null( $wgCategoryTreeDefaultOptions['hideprefix'] ) ) {
		$wgCategoryTreeDefaultOptions['hideprefix'] = $wgCategoryTreeOmitNamespace;
	}

	if ( !isset( $wgCategoryTreeCategoryPageOptions['mode'] ) || is_null( $wgCategoryTreeCategoryPageOptions['mode'] ) ) {
		$wgCategoryTreeCategoryPageOptions['mode'] = $wgCategoryTreeCategoryPageMode;
	}
}

function efCategoryTreeSetHooks() {
	global $wgParser, $wgCategoryTreeAllowTag;
	if ( $wgCategoryTreeAllowTag ) {
		$wgParser->setHook( 'categorytree' , 'efCategoryTreeParserHook' );
		$wgParser->setFunctionHook( 'categorytree' , 'efCategoryTreeParserFunction' );
	}
	return true;
}

/**
* Hook magic word
*/
function efCategoryTreeGetMagic( &$magicWords, $langCode ) {
	global $wgUseAjax, $wgCategoryTreeAllowTag;

	if ( $wgUseAjax && $wgCategoryTreeAllowTag ) {
		//XXX: should we allow a local alias?
		$magicWords['categorytree'] = array( 0, 'categorytree' );
	}

	return true;
}

/**
 * Entry point for Ajax, registered in $wgAjaxExportList.
 * The $enc parameter determins how the $options is decoded into a PHP array.
 * If $enc is not given, '' is asumed, which simulates the old call interface,
 * namely, only providing the mode name or number.
 * This loads CategoryTreeFunctions.php and calls CategoryTree::ajax()
 */
function efCategoryTreeAjaxWrapper( $category, $options, $enc = '' ) {
	global $wgCategoryTreeHTTPCache, $wgSquidMaxAge, $wgUseSquid;

	if ( is_string( $options ) ) {
		$options = CategoryTree::decodeOptions( $options, $enc );
	}

	$depth = isset( $options['depth'] ) ? (int)$options['depth'] : 1;

	$ct = new CategoryTree( $options, true );
	$depth = efCategoryTreeCapDepth( $ct->getOption('mode'), $depth );
	$response = $ct->ajax( $category, $depth );

	if ( $wgCategoryTreeHTTPCache && $wgSquidMaxAge && $wgUseSquid ) {
		$response->setCacheDuration( $wgSquidMaxAge );
		$response->setVary( 'Accept-Encoding, Cookie' ); #cache for anons only
		#TODO: purge the squid cache when a category page is invalidated
	}

	return $response;
}

/**
 * Internal function to cap depth
 */

function efCategoryTreeCapDepth( $mode, $depth ) {
	global $wgCategoryTreeMaxDepth;

	if (is_numeric($depth))
		$depth = intval($depth);
	else return 1;

	if (is_array($wgCategoryTreeMaxDepth)) {
		$max = isset($wgCategoryTreeMaxDepth[$mode]) ? $wgCategoryTreeMaxDepth[$mode] : 1;
	} elseif (is_numeric($wgCategoryTreeMaxDepth)) {
		$max = $wgCategoryTreeMaxDepth;
	} else {
		wfDebug( 'efCategoryTreeCapDepth: $wgCategoryTreeMaxDepth is invalid.' );
		$max = 1;
	}

	return min($depth, $max);
}

/**
 * Entry point for the {{#categorytree}} tag parser function.
 * This is a wrapper around efCategoryTreeParserHook
 */
function efCategoryTreeParserFunction( &$parser ) {
	$params = func_get_args();
	array_shift( $params ); //first is &$parser, strip it

	//first user-supplied parameter must be category name
	if ( !$params ) return ''; //no category specified, return nothing
	$cat = array_shift( $params );

	//build associative arguments from flat parameter list
	$argv = array();
	foreach ( $params as $p ) {
		if ( preg_match('/^\s*(\S.*?)\s*=\s*(.*?)\s*$/', $p, $m) ) {
			$k = $m[1];
			$v = $m[2];
		}
		else {
			$k = trim($p);
			$v = true;
		}

		$argv[$k] = $v;
	}

	//now handle just like a <categorytree> tag
	$html = efCategoryTreeParserHook( $cat, $argv, $parser );
	return array( $html, 'isHTML' => true );
}

/**
 * Entry point for the <categorytree> tag parser hook.
 * This loads CategoryTreeFunctions.php and calls CategoryTree::getTag()
 */
function efCategoryTreeParserHook( $cat, $argv, &$parser ) {
	global $wgCategoryTreeDefaultMode;

	$parser->mOutput->mCategoryTreeTag = true; # flag for use by efCategoryTreeParserOutput

	static $initialized = false;

	$ct = new CategoryTree( $argv );

	$attr = Sanitizer::validateTagAttributes( $argv, 'div' );

	$hideroot = isset( $argv[ 'hideroot' ] ) ? CategoryTree::decodeBoolean( $argv[ 'hideroot' ] ) : null;
	$onlyroot = isset( $argv[ 'onlyroot' ] ) ? CategoryTree::decodeBoolean( $argv[ 'onlyroot' ] ) : null;
	$depthArg = isset( $argv[ 'depth' ] ) ? $argv[ 'depth' ] : null;

	$depth = efCategoryTreeCapDepth( $ct->getOption( 'mode' ), $depthArg );
	if ( $onlyroot ) $depth = 0;

	return $ct->getTag( $parser, $cat, $hideroot, $attr, $depth );
}

/**
* Hook callback that injects messages and things into the <head> tag
* Does nothing if $parserOutput->mCategoryTreeTag is not set
*/
function efCategoryTreeParserOutput( &$outputPage, &$parserOutput )  {
	if ( !empty( $parserOutput->mCategoryTreeTag ) ) {
		CategoryTree::setHeaders( $outputPage );
	}
	return true;
}

/**
 * ArticleFromTitle hook, override category page handling
 */
function efCategoryTreeArticleFromTitle( &$title, &$article ) {
	if ( $title->getNamespace() == NS_CATEGORY ) {
		$article = new CategoryTreeCategoryPage( $title );
	}
	return true;
}
