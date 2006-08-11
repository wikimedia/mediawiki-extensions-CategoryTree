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
* Abort if AJAX is not enabled
**/
if ( !$wgUseAjax ) {
	#NOTE: GlobalFunctions is not yet loaded, so use standard API only.
	trigger_error( 'CategoryTree: Ajax is not enabled, aborting extension setup.', E_USER_WARNING );
	return;
}

/**
 * Options:
 *
 * $wgCategoryTreeMaxChildren - maximum number of children shown in a tree node. Default is 200
 * $wgCategoryTreeAllowTag - enable <categorytree> tag. Default is true.
 * $wgCategoryTreeDynamicTag - loads the first level of the tree in a <categorytag> dynamically.
 *                             This way, the cache does not need to be disabled. Default is false.
 * $wgCategoryTreeDisableCache - disabled the parser cache for pages with a <categorytree> tag. Default is true.
 */  
if ( !isset( $wgCategoryTreeMaxChildren ) ) $wgCategoryTreeMaxChildren = 200;
if ( !isset( $wgCategoryTreeAllowTag ) ) $wgCategoryTreeAllowTag = true;
if ( !isset( $wgCategoryTreeDisableCache ) ) $wgCategoryTreeDisableCache = true;
if ( !isset( $wgCategoryTreeDynamicTag ) ) $wgCategoryTreeDynamicTag = false;

/**
 * Register extension setup hook and credits
 */
$wgExtensionFunctions[] = 'efCategoryTree';
$wgExtensionCredits['specialpage'][] = array( 'name' => 'CategoryTree', 'author' => 'Daniel Kinzler', 'url' => 'http://meta.wikimedia.org/wiki/CategoryTree_extension' );
$wgExtensionCredits['parserhook'][] = array( 'name' => 'CategoryTree', 'author' => 'Daniel Kinzler', 'url' => 'http://meta.wikimedia.org/wiki/CategoryTree_extension' );

/**
 * Register the special page
 */
$wgAutoloadClasses['CategoryTree'] = dirname( __FILE__ ) . '/CategoryTreePage.php';
$wgSpecialPages['CategoryTree'] = 'CategoryTree';
$wgHooks['SkinTemplateTabs'][] = 'efCategoryTreeInstallTabs';
#$wgHooks['OutputPageBeforeHTML'][] = 'efCategoryTreeHeadHook';

/**
 * register Ajax function
 */
$wgAjaxExportList[] = 'efCategoryTreeAjaxWrapper';

/**
 * Hook it up
 */
function efCategoryTree() {
	global $wgParser, $wgOut, $wgCategoryTreeAllowTag;
	global $wgJsMimeType, $wgScriptPath;
	
	if ( $wgCategoryTreeAllowTag ) $wgParser->setHook( 'categorytree' , 'efCategoryTreeParserHook' );
	
	#TODO: injecting scripts should be done on demand, by "somehow" using the ParserOutput
	
	#register css file for CategoryTree
	$wgOut->addLink( array( 'rel' => 'stylesheet', 'type' => 'text/css', 'href' => $wgScriptPath . '/extensions/CategoryTree/CategoryTree.css' ) );
	
	#register main js file for CategoryTree
	$wgOut->addScript( "<script type=\"{$wgJsMimeType}\" src=\"{$wgScriptPath}/extensions/CategoryTree/CategoryTree.js\"></script>\n" );
}

/**
 * Entry point for Ajax, registered in $wgAjaxExportList.
 * This loads CategoryTreeFunctions.php and calls efCategoryTreeAjax()
 */
function efCategoryTreeAjaxWrapper( $category, $mode = CT_MODE_CATEGORIES ) {
	require_once( dirname( __FILE__ ) . '/CategoryTreeFunctions.php' );
	
	efInjectCategoryTreeMessages();
	
	return efCategoryTreeAjax( $category, $mode );
}

/**
 * Entry point for the <categorytree> tag parser hook.
 * This loads CategoryTreeFunctions.php and calls efCategoryTreeTag()
 */
function efCategoryTreeParserHook( $cat, $argv ) {
	#global $wgParser;
	#$wgParser->mOutput->mCategoryTreeTag = true; #HACK: flag for use by efCategoryTreeHeadHook
	
	require_once( dirname( __FILE__ ) . '/CategoryTreeFunctions.php' );
	
	$style= @$argv[ 'style' ];
	
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
		
		if ( $hideroot === '1' || $hideroot === 'yes' || $hideroot === 'on' || $hideroot === 'true' ) $hideroot = true;
		else if ( $hideroot === '0' || $hideroot === 'no' || $hideroot === 'off' || $hideroot === 'false' ) $hideroot = false;
	}
        
	efInjectCategoryTreeMessages();
	#efCategoryTreeHeader();
	
	#HACK for inlining JS messages "on demand". Putting them into the head would be nicer,
	#     but that would require some changes to ParserOutput to deal with the parser cache
	static $messages = true;
	
	if ( $messages ) {
		efInjectCategoryTreeMessages();
		$m = efCategoryTreeGetJsMessages();
		$messages = false;
	}
	else {
		$m = '';
	}
	
	return $m . efCategoryTreeTag( $cat, $mode, $hideroot, $style );
}

/**
* Hook callback that installs a tab for CategoryTree on Category pages
*/
function efCategoryTreeInstallTabs( &$skin, &$content_actions ) {
	global $wgTitle;
	        
	if ( $wgTitle->getNamespace() != NS_CATEGORY ) return true;
	
	$special = Title::makeTitle( NS_SPECIAL, 'CategoryTree' );
	
	efInjectCategoryTreeMessages();
	
	$content_actions['categorytree'] = array(
					'class' => false,
					'text' => wfMsgHTML( 'categorytree-tab' ),
					'href' => $special->getLocalUrl() . '/' . $wgTitle->getPartialURL() );  
	return true;
}

/**
* Hook callback that injects messages and things into the <head> tag
* Does nothing if $parserOutput->mCategoryTreeTag is not set
*/
/* function efCategoryTreeHeadHook( &$parserOutput, &$text )  {
	if ( ! @$parserOutput->mCategoryTreeTag ) return;
	
	require_once( dirname( __FILE__ ) . '/CategoryTreeFunctions.php' );
        
	efInjectCategoryTreeMessages();
	efCategoryTreeHeader();
} */

/**
* inject messages used by CategoryTree into the message cache
*/
function efInjectCategoryTreeMessages() {
	global $wgMessageCache;
	
	static $done = false;
	if ( $done ) return;
	else $done = true;
	        
	$msg = efLoadCategoryTreeMessages();
	$wgMessageCache->addMessages( $msg );
}

/**
* load the CategoryTree internationalization file
*/
function efLoadCategoryTreeMessages() {
	global $wgLang;
	
	$messages= array();
	
	$f= dirname( __FILE__ ) . '/CategoryTree.i18n.php';
	include( $f );
	
	$f= dirname( __FILE__ ) . '/CategoryTree.i18n.' . $wgLang->getCode() . '.php';
	if ( file_exists( $f ) ) include( $f );
	
	return $messages;
}

/**
* Creates a Title object from a user provided (and thus unsafe) string
*/
function & efCategoryTreeMakeTitle( $title ) {
	global $wgContLang, $wgCanonicalNamespaceNames;
	
	$title = trim($title);
	
	if ( $title === NULL || $title === '' || $title === false ) {
		$dummy = NULL; #php sucks
		return $dummy;
	}
	
	#HACK to strip redundant namespace name
	$title = preg_replace( '~^\s*(' . $wgCanonicalNamespaceNames[ NS_CATEGORY ] . '|' . $wgContLang->getNsText( NS_CATEGORY ) . ')\s*:\s*~i', '', $title ); 
	
	$t = Title::makeTitleSafe( NS_CATEGORY, $title );
	return $t;
}
 
?>