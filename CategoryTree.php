<?php

/**
 * Setup and Hooks for the CategoryTree extension, an AJAX based gadget 
 * to display the category structure of a wiki
 *
 * @package MediaWiki
 * @subpackage Extensions
 * @author Daniel Kinzler <duesentrieb@brightbyte.de>
 * @copyright © 2006 Daniel Kinzler
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
 */  
$wgCategoryTreeMaxChildren = 200;
$wgCategoryTreeAllowTag = true;
$wgCategoryTreeDisableCache = true;
$wgCategoryTreeDynamicTag = false;
$wgCategoryTreeHTTPCache = false;
$wgCategoryTreeUnifiedView = false;

/**
 * Register extension setup hook and credits
 */
$wgExtensionFunctions[] = 'efCategoryTree';
$wgExtensionCredits['specialpage'][] = array( 
	'name' => 'CategoryTree', 
	'author' => 'Daniel Kinzler', 
	'url' => 'http://meta.wikimedia.org/wiki/CategoryTree_extension' 
);
$wgExtensionCredits['parserhook'][] = array( 
	'name' => 'CategoryTree', 
	'author' => 'Daniel Kinzler', 
	'url' => 'http://meta.wikimedia.org/wiki/CategoryTree_extension' 
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

	if ( $wgCategoryTreeAllowTag ) $wgParser->setHook( 'categorytree' , 'efCategoryTreeParserHook' );
}

/**
 * Entry point for Ajax, registered in $wgAjaxExportList.
 * This loads CategoryTreeFunctions.php and calls CategoryTree::ajax()
 */
function efCategoryTreeAjaxWrapper( $category, $mode = CT_MODE_CATEGORIES ) {
	global $wgCategoryTreeHTTPCache, $wgSquidMaxAge, $wgUseSquid;
	
	$ct = new CategoryTree;
	$response = $ct->ajax( $category, $mode );
	
	if ( $wgCategoryTreeHTTPCache && $wgSquidMaxAge && $wgUseSquid ) {
		$response->setCacheDuration( $wgSquidMaxAge );
		$response->setVary( 'Accept-Encoding, Cookie' ); #cache for anons only
		#TODO: purge the squid cache when a category page is invalidated
	}

	return $response;
}

/**
 * Entry point for the <categorytree> tag parser hook.
 * This loads CategoryTreeFunctions.php and calls CategoryTree::getTag()
 */
function efCategoryTreeParserHook( $cat, $argv, &$parser ) {
	$parser->mOutput->mCategoryTreeTag = true; # flag for use by efCategoryTreeParserOutput
	
	static $initialized = false;
	
	$divAttribs = Sanitizer::validateTagAttributes( $argv, 'div' );
	$style = @$divAttribs['style'];
	
	$mode= @$argv[ 'mode' ];
	if ( $mode !== NULL ) {
		$mode= trim( strtolower( $mode ) );
		
		if ( $mode == 'all' ) $mode = CT_MODE_ALL;
		else if ( $mode == 'pages' ) $mode = CT_MODE_PAGES;
		else if ( $mode == 'categories' ) $mode = CT_MODE_CATEGORIES;
	}
	else {
		$mode = CT_MODE_CATEGORIES;
	}
	
	$hideroot = @$argv[ 'hideroot' ];
	if ( $hideroot !== NULL ) {
		$hideroot = trim( strtolower( $hideroot ) );
		
		if ( $hideroot === '1' || $hideroot === 'yes' || $hideroot === 'on' || $hideroot === 'true' ) {
			$hideroot = true;
		}
		else if ( $hideroot === '0' || $hideroot === 'no' || $hideroot === 'off' || $hideroot === 'false' ) {
			$hideroot = false;
		}
	}

	$ct = new CategoryTree;
	return $ct->getTag( $parser, $cat, $mode, $hideroot, $style );
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

?>
