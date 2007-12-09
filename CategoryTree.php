<?php

/**
 * Setup and Hooks for the CategoryTree extension, an AJAX based gadget
 * to display the category structure of a wiki
 *
 * @addtogroup Extensions
 * @author Daniel Kinzler, brightbyte.de
 * @copyright © 2006-2007 Daniel Kinzler
 * @licence GNU General Public Licence 2.0 or later
 */

if( !defined( 'MEDIAWIKI' ) ) {
	echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
	die( 1 );
}

/**
* Constants for use with efCategoryTreeRenderChildren,
* defining what should be shown in the tree
*/
define('CT_MODE_CATEGORIES', 0);
define('CT_MODE_PAGES', 10);
define('CT_MODE_ALL', 20);

/**
 * Options:
 *
 * $wgCategoryTreeMaxChildren - maximum number of children shown in a tree node. Default is 200
 * $wgCategoryTreeAllowTag - enable <categorytree> tag. Default is true.
 * $wgCategoryTreeDynamicTag - loads the first level of the tree in a <categorytag> dynamically.
 *                             This way, the cache does not need to be disabled. Default is false.
 * $wgCategoryTreeDisableCache - disabled the parser cache for pages with a <categorytree> tag. Default is true.
 * $wgCategoryTreeUseCache - enable HTTP cache for anon users. Default is false.
 * $wgCategoryTreeUnifiedView - use unified view on category pages, instead of "tree" or "traditional list". Default is true.
 * $wgCategoryTreeOmitNamespace - never show namespace prefix. Default is false
 * $wgCategoryTreeMaxDepth - maximum value for depth argument; An array that maps mode values to
 *                           the maximum depth acceptable for the depth option.
 *                           Per default, the "categories" mode has a max depth of 2,
 *                           all other modes have a max depth of 1.
 */

$wgCategoryTreeMaxChildren = 200;
$wgCategoryTreeAllowTag = true;
$wgCategoryTreeDisableCache = true;
$wgCategoryTreeDynamicTag = false;
$wgCategoryTreeHTTPCache = false;
$wgCategoryTreeUnifiedView = true;
$wgCategoryTreeOmitNamespace = false;
$wgCategoryTreeMaxDepth = array(CT_MODE_PAGES => 1, CT_MODE_ALL => 1, CT_MODE_CATEGORIES => 2);
$wgCategoryTreeExtPath = '/extensions/CategoryTree';
$wgCategoryTreeDefaultMode = CT_MODE_CATEGORIES;
$wgCategoryTreeCategoryPageMode = CT_MODE_CATEGORIES;
$wgCategoryTreeVersion = '1';

/**
 * Register extension setup hook and credits
 */
$wgExtensionFunctions[] = 'efCategoryTree';
$wgExtensionCredits['specialpage'][] = array(
	'name' => 'CategoryTree',
	'version' => '1.1',
	'author' => 'Daniel Kinzler',
	'url' => 'http://www.mediawiki.org/wiki/Extension:CategoryTree',
	'description' => 'AJAX based gadget to display the category structure of a wiki',
);
$wgExtensionCredits['parserhook'][] = array(
	'name' => 'CategoryTree',
	'author' => 'Daniel Kinzler',
	'url' => 'http://www.mediawiki.org/wiki/Extension:CategoryTree',
	'description' => 'AJAX based gadget to display the category structure of a wiki',
);

/**
 * Register the special page
 */
$wgAutoloadClasses['CategoryTreePage'] = dirname( __FILE__ ) . '/CategoryTreePage.php';
$wgAutoloadClasses['CategoryTree'] = dirname( __FILE__ ) . '/CategoryTreeFunctions.php';
$wgAutoloadClasses['CategoryTreeCategoryPage'] = dirname( __FILE__ ) . '/CategoryPageSubclass.php';
$wgSpecialPages['CategoryTree'] = 'CategoryTreePage';
#$wgHooks['SkinTemplateTabs'][] = 'efCategoryTreeInstallTabs';
$wgHooks['OutputPageParserOutput'][] = 'efCategoryTreeParserOutput';
$wgHooks['LoadAllMessages'][] = 'efInjectCategoryTreeMessages';
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
	global $wgUseAjax, $wgParser, $wgCategoryTreeAllowTag;

	# Abort if AJAX is not enabled
	if ( !$wgUseAjax ) {
		wfDebug( 'efCategoryTree: $wgUseAjax is not enabled, aborting extension setup.' );
		return;
	}

	if ( $wgCategoryTreeAllowTag ) {
		$wgParser->setHook( 'categorytree' , 'efCategoryTreeParserHook' );
		$wgParser->setFunctionHook( 'categorytree' , 'efCategoryTreeParserFunction' );
	}
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
 * This loads CategoryTreeFunctions.php and calls CategoryTree::ajax()
 */
function efCategoryTreeAjaxWrapper( $category, $mode ) {
	global $wgCategoryTreeHTTPCache, $wgSquidMaxAge, $wgUseSquid;

	$ct = new CategoryTree;
	$response = $ct->ajax( $category, $mode ); //FIXME: would need to pass on depth parameter here.

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
* Helper function to convert a string to a boolean value.
* Perhaps make this a global function in MediaWiki proper
*/
function efCategoryTreeAsBool( $s ) {
	if ( is_null( $s ) || is_bool( $s ) ) return $s;
	$s = trim( strtolower( $s ) );

	if ( $s === '1' || $s === 'yes' || $s === 'on' || $s === 'true' ) {
		return true;
	}
	else if ( $s === '0' || $s === 'no' || $s === 'off' || $s === 'false' ) {
		return false;
	}
	else {
		return NULL;
	}
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
	return array( $html, 'noargs' => true, 'noparse' => true ); //XXX: isHTML would be right logically, but it causes extra blank lines
}

/**
 * Entry point for the <categorytree> tag parser hook.
 * This loads CategoryTreeFunctions.php and calls CategoryTree::getTag()
 */
function efCategoryTreeParserHook( $cat, $argv, &$parser ) {
	global $wgCategoryTreeDefaultMode;

	$parser->mOutput->mCategoryTreeTag = true; # flag for use by efCategoryTreeParserOutput

	static $initialized = false;

	$divAttribs = Sanitizer::validateTagAttributes( $argv, 'div' );
	$style = isset( $divAttribs['style'] ) ? $divAttribs['style'] : null;

	$mode = isset( $argv[ 'mode' ] ) ? $argv[ 'mode' ] : null;
	if ( $mode !== NULL ) {
		$mode= trim( strtolower( $mode ) );

		if ( $mode == 'all' ) $mode = CT_MODE_ALL;
		else if ( $mode == 'pages' ) $mode = CT_MODE_PAGES;
		else if ( $mode == 'categories' ) $mode = CT_MODE_CATEGORIES;
	}
	else {
		$mode = $wgCategoryTreeDefaultMode;
	}

	$hideroot = isset( $argv[ 'hideroot' ] ) ? efCategoryTreeAsBool( $argv[ 'hideroot' ] ) : null;
	$onlyroot = isset( $argv[ 'onlyroot' ] ) ? efCategoryTreeAsBool( $argv[ 'onlyroot' ] ) : null;
	$depthArg = isset( $argv[ 'depth' ] ) ? $argv[ 'depth' ] : null;

	$depth = efCategoryTreeCapDepth($mode, $depthArg);

	if ( $onlyroot ) $depth = 0;

	$ct = new CategoryTree;
	return $ct->getTag( $parser, $cat, $mode, $hideroot, $style, $depth );
}

/**
* Hook callback that installs a tab for CategoryTree on Category pages
 */
/*
function efCategoryTreeInstallTabs( &$skin, &$content_actions ) {
	global $wgTitle;

	if ( $wgTitle->getNamespace() != NS_CATEGORY ) return true;

	$special = Title::makeTitle( NS_SPECIAL, 'CategoryTree' );

	$content_actions['categorytree'] = array(
					'class' => false,
					'text' => htmlspecialchars( CategoryTree::msg( 'tab' ) ),
					'href' => $special->getLocalUrl() . '/' . $wgTitle->getPartialURL() );
	return true;
}*/

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
* inject messages used by CategoryTree into the message cache
*/
function efInjectCategoryTreeMessages() {
	CategoryTree::msg(false);
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
