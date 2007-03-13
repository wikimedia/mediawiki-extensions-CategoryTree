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

 * $wgCategoryMaxDepth - maximum value for depth argument; can be an
 *                       integer, or an array of two integers.  The first element is the maximum
 *                       depth for the "pages" and "all" modes; the second is for the categories
 *                       mode.  Ignored if $wgCategoryTreeDynamicTag is true.
 */  

$wgCategoryTreeMaxChildren = 200;
$wgCategoryTreeAllowTag = true;
$wgCategoryTreeDisableCache = true;
$wgCategoryTreeDynamicTag = false;
$wgCategoryTreeHTTPCache = false;
$wgCategoryTreeUnifiedView = true;
$wgCategoryTreeOmitNamespace = false;
$wgCategoryMaxDepth = array(1,2);

/**
 * Register extension setup hook and credits
 */
$wgExtensionFunctions[] = 'efCategoryTree';
$wgExtensionCredits['specialpage'][] = array( 
	'name' => 'CategoryTree', 
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
 * Internal function to cap depth
 */

function efCategoryTreeCapDepth( $mode, $depth ) 
{

  if (is_numeric($depth))
    $depth = intval($depth);
  else
    $depth = 1;
  

  global $wgCategoryMaxDepth;
  if (is_array($wgCategoryMaxDepth)) {
    switch($mode) {
    case CT_MODE_PAGES:
    case CT_MODE_ALL:
      $max = isset($wgCategoryMaxDepth[0])?$wgCategoryMaxDepth[0]:1;
      break;
    case CT_MODE_CATEGORIES:
    default:
      $max = isset($wgCategoryMaxDepth[1])?$wgCategoryMaxDepth[1]:1;
      break;
    }
  } elseif (is_numeric($wgCategoryMaxDepth)) {
    $max = $wgCategoryMaxDepth;
  } else {
    wfDebug( 'efCategoryTreeCapDepth: $wgCategoryMaxDepth is invalid.' );
    $max = 1;
  }
  
  //echo "mode $mode:max is $max\n";
  if ($depth>$max)
    $depth = $max;
  
  return $depth;
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
 * Entry point for the <categorytree> tag parser hook.
 * This loads CategoryTreeFunctions.php and calls CategoryTree::getTag()
 */
function efCategoryTreeParserHook( $cat, $argv, &$parser ) {
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
		$mode = CT_MODE_CATEGORIES;
	}
	
	$hideroot = isset( $argv[ 'hideroot' ] ) ? efCategoryTreeAsBool( $argv[ 'hideroot' ] ) : null;
	$onlyroot = isset( $argv[ 'onlyroot' ] ) ? efCategoryTreeAsBool( $argv[ 'onlyroot' ] ) : null;

	$depth = efCategoryTreeCapDepth($mode,@$argv[ 'depth' ]);
	
	if ( $onlyroot ) $display = 'onlyroot';
	else if ( $hideroot ) $display = 'hideroot';
	else $display = 'expandroot';

	$ct = new CategoryTree;
	return $ct->getTag( $parser, $cat, $mode, $hideroot, $style, $depth );
	return $ct->getTag( $parser, $cat, $mode, $display, $style, $depth );
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
