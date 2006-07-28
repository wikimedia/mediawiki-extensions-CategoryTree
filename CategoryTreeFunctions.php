<?php

/**
 * Core functions for the CategoryTree extension, an AJAX based gadget 
 * to display the category structure of a wiki
 *
 * @package MediaWiki
 * @subpackage Extensions
 * @author Daniel Kinzler <duesentrieb@brightbyte.de>
 * @copyright © 2006 Daniel Kinzler
 * @licence GNU General Public Licence 2.0 or later
 */
 
if( !defined( 'MEDIAWIKI' ) ) {
	echo( "This file is part of an extension to the MediaWiki software and cannot be used standalone.\n" );
	die( 1 );
}

/**
* Inserts code into the HTML head. This mainly links CategoryTree.js and CategoryTree.css
*/
function efCategoryTreeHeader() {
	global $wgOut, $wgCategoryTreeHeaderDone;
	global $wgJsMimeType, $wgScriptPath;
	
	if ( $wgCategoryTreeHeaderDone ) return;
	else $wgCategoryTreeHeaderDone = true;
	
	#register css file for CategoryTree
	$wgOut->addLink( array( 'rel' => 'stylesheet', 'type' => 'text/css', 'href' => $wgScriptPath . '/extensions/CategoryTree/CategoryTree.css' ) );
	
	#register main js file for CategoryTree
	$wgOut->addScript( "<script type=\"{$wgJsMimeType}\" src=\"{$wgScriptPath}/extensions/CategoryTree/CategoryTree.js\"></script>\n" );
	
	#make some localized messages available in JS
	$wgOut->addScript( "<script type=\"{$wgJsMimeType}\"> 
				categoryTreeCollapseMsg = \"".Xml::escapeJsString(wfMsg('categorytree-collapse'))."\"; 
				categoryTreeExpandMsg = \"".Xml::escapeJsString(wfMsg('categorytree-expand'))."\"; 
				categoryTreeLoadingMsg = \"".Xml::escapeJsString(wfMsg('categorytree-loading'))."\"; 
				categoryTreeNothingFoundMsg = \"".Xml::escapeJsString(wfMsg('categorytree-nothing-found'))."\"; 
			    </script>\n" );
}

/**
* Ajax call. This is called by efCategoryTreeAjaxWrapper, which is used to 
* load CategoryTreeFunctions.php on demand.
*/
function efCategoryTreeAjax( $category, $mode ) {
	efInjectCategoryTreeMessages();
	
	$title = efCategoryTreeMakeTitle( $category );
	
	return efCategoryTreeRenderChildren( $title, $mode );
}

/**
* Custom tag implementation. This is called by efCategoryTreeParserHook, which is used to 
* load CategoryTreeFunctions.php on demand.
*/
function efCategoryTreeTag( $category, $mode, $hideroot = false, $style = '' ) {
	global $wgOut, $wgParser, $wgCategoryTreeDisableCache, $wgCategoryTreeDynamicTag;
	
	efInjectCategoryTreeMessages();
	efCategoryTreeHeader();
	
	if ( $wgCategoryTreeDisableCache && !$wgCategoryTreeDynamicTag ) $wgParser->disableCache();
	
	$title = efCategoryTreeMakeTitle( $category );
	
	$html = '';
	$html .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeTag', 'style' => $style ) );
	
	if ( !$title->getArticleID() ) {
		$html .= wfOpenElement( 'span', array( 'class' => 'CategoryTreeNotice' ) );
		$html .= $wgOut->parse( wfMsg( 'categorytree-not-found' , $category ) );
		$html .= wfCloseElement( 'span' );
        }
	else {
		if ( !$hideroot ) $html .= efCategoryTreeRenderNode( $title, $mode, true );
		else $html .= efCategoryTreeRenderChildren( $title, $mode );
	}
	
	$html .= wfCloseElement( 'div' );
	
	return $html;
}

/**
* Returns a string with an HTML representation of the children of the given category.
* $title must be a Title object
*/
function efCategoryTreeRenderChildren( &$title, $mode = CT_MODE_CATEGORIES ) {
        global $wgCategoryTreeMaxChildren;
        
        $dbr =& wfGetDB( DB_SLAVE );
        
        #additional stuff to be used if "transaltion" by interwiki-links is desired
        $transFields = '';
        $transJoin = '';
        $transWhere = '';
        
        #namespace filter. Should be configurable
        if ( $mode == CT_MODE_ALL ) $nsmatch = '';
        else if ( $mode == CT_MODE_PAGES ) $nsmatch = ' AND cat.page_namespace != ' . NS_IMAGE;
        else $nsmatch = ' AND cat.page_namespace = ' . NS_CATEGORY;
    
        $page = $dbr->tableName( 'page' );
        $categorylinks = $dbr->tableName( 'categorylinks' );
        
        $sql = "SELECT cat.page_namespace, cat.page_title, 
                      if( cat.page_namespace = " . NS_CATEGORY . ", 0, 1) as presort 
                      $transFields
                FROM $page as cat
                JOIN $categorylinks ON cl_from = cat.page_id
                $transJoin
                WHERE cl_to = " . $dbr->addQuotes( $title->getDBKey() ) . " 
                $nsmatch
                AND cat.page_is_redirect = 0
                $transWhere
                ORDER BY presort, cat.page_namespace DESC, cat.page_title
                LIMIT " . (int)$wgCategoryTreeMaxChildren;

        $res = $dbr->query( $sql, 'efCategoryTreeRenderChildren' );
        
        $s= '';
        
        while ( $row = $dbr->fetchRow( $res ) ) {
                #TODO: translation support; ideally added to Title object
                $t = Title::makeTitle( $row['page_namespace'], $row['page_title'] );
                $s .= efCategoryTreeRenderNode( $t, $mode, false );
                $s .= "\n\t\t";
        }
        
        $dbr->freeResult( $res );
        
        return $s;
}

/**
* Returns a string with an HTML representation of the parents of the given category.
* $title must be a Title object
*/
function efCategoryTreeRenderParents( &$title, $mode ) {
        global $wgCategoryTreeMaxChildren;
        
        $dbr =& wfGetDB( DB_SLAVE );
        
        #additional stuff to be used if "transaltion" by interwiki-links is desired
        $transFields = '';
        $transJoin = '';
        $transWhere = '';
        
        $categorylinks = $dbr->tableName( 'categorylinks' );
        
        $sql = "SELECT " . NS_CATEGORY . " as page_namespace, cl_to as page_title $transFields
                FROM $categorylinks
                $transJoin
                WHERE cl_from = " . $title->getArticleID() . " 
                $transWhere
                ORDER BY cl_to
                LIMIT " . (int)$wgCategoryTreeMaxChildren;

        $res = $dbr->query( $sql, 'efCategoryTreeRenderParents' );
        
        $special = Title::makeTitle( NS_SPECIAL, 'CategoryTree' );
        
        $s= '';
        
        while ( $row = $dbr->fetchRow( $res ) ) {
                #TODO: translation support; ideally added to Title object
                $t = Title::makeTitle( $row['page_namespace'], $row['page_title'] );
                
                #$trans = $title->getLocalizedText();
                $trans = ''; #place holder for when translated titles are available
                
                $label = htmlspecialchars( $t->getText() );
                if ( $trans && $trans!=$label ) $label.= ' ' . wfElement( 'i', array( 'class' => 'translation'), $trans );
                
                $wikiLink = $special->getLocalURL( 'target=' . $t->getPartialURL() . '&mode=' . $mode );
                
                if ( $s !== '' ) $s .= ' | ';
                
                $s .= wfOpenElement( 'span', array( 'class' => 'CategoryTreeItem' ) );
                $s .= wfOpenElement( 'a', array( 'class' => 'CategoryTreeLabel', 'href' => $wikiLink ) ) . $label . wfCloseElement( 'a' );
                $s .= wfCloseElement( 'span' );
                
                $s .= "\n\t\t";
        }
        
        $dbr->freeResult( $res );
        
        return $s;
}

/**
* Returns a string with a HTML represenation of the given page.
* $title must be a Title object
*/
function efCategoryTreeRenderNode( &$title, $mode = CT_MODE_CATEGORIES, $children = false ) {
        global $wgCategoryTreeDynamicTag;
        static $uniq = 0;
        
        $load = false;
        
        if ( $children && $wgCategoryTreeDynamicTag ) {
                 $uniq += 1;
                 
                 $load = 'ct-' . $uniq . '-' . mt_rand( 1, 100000 );
                 $children = false;
        }

        $ns = $title->getNamespace();
        $key = $title->getDBKey();
        
        #$trans = $title->getLocalizedText();
        $trans = ''; #place holder for when translated titles are available
        
        #when showing only categories, omit namespace in label
        if ( $mode == CT_MODE_CATEGORIES ) $label = htmlspecialchars( $title->getText() );
        else $label = htmlspecialchars( $title->getPrefixedText() );
        
        if ( $trans && $trans!=$label ) $label.= ' ' . wfElement( 'i', array( 'class' => 'translation'), $trans );
        
        $wikiLink = $title->getLocalURL();
        
        $labelClass = 'CategoryTreeLabel ' . ' CategoryTreeLabelNs' . $ns;
        
        if ( $ns == NS_CATEGORY ) $labelClass .= ' CategoryTreeLabelCategory';
        else $labelClass .= ' CategoryTreeLabelPage';
        
        if ( ( $ns % 2 ) > 0 ) $labelClass .= ' CategoryTreeLabelTalk';
        
        $linkattr= array( 'href' => 'javascript:void(0)' );
        
        if ( $load ) $linkattr[ 'id' ] = $load;
        
        if ( !$children ) {
                $txt = '+';
                $linkattr[ 'onclick' ] = "categoryTreeExpandNode('".Xml::escapeJsString($key)."','".$mode."',this);";
                $linkattr[ 'title' ] = wfMsg('categorytree-load'); 
        }
        else {
                $txt = '–'; #NOTE: that's not a minus but a unicode ndash!
                $linkattr[ 'onclick' ] = "categoryTreeCollapseNode('".Xml::escapeJsString($key)."','".$mode."',this);";
                $linkattr[ 'title' ] = wfMsg('categorytree-collapse'); 
                $linkattr[ 'class' ] = 'CategoryTreeLoaded';
        }
        
        $s = '';

        #NOTE: things in CategoryTree.js rely on the exact order of tags!
        #      Specifically, the CategoryTreeChildren div must be the first
        #      sibling with nodeName = DIV of the grandparent of the expland link.
        
        $s .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeSection' ) );
        $s .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeItem' ) );
        
        $s .= wfOpenElement( 'span', array( 'class' => 'CategoryTreeBullet' ) );
        if ( $ns == NS_CATEGORY ) $s .= '[' . wfElement( 'a', $linkattr, $txt ) . '] ';
        else $s .= ' ';
        $s .= wfCloseElement( 'span' );
        
        $s .= wfOpenElement( 'a', array( 'class' => $labelClass, 'href' => $wikiLink ) ) . $label . wfCloseElement( 'a' );
        $s .= wfCloseElement( 'div' );
        $s .= "\n\t\t";
        $s .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeChildren', 'style' => $children ? "display:block" : "display:none" ) );
        if ( $children ) $s .= efCategoryTreeRenderChildren( $title, $mode ); 
        $s .= wfCloseElement( 'div' );
        $s .= wfCloseElement( 'div' );
        
        if ( $load ) {
                $s .= "\n\t\t";
                $s .= wfOpenElement( 'script', array( 'type' => 'text/javascript' ) );
                $s .= 'categoryTreeExpandNode("'.Xml::escapeJsString($key).'", "'.$mode.'", document.getElementById("'.$load.'") );';
                $s .= wfCloseElement( 'script' );
        }
        
        $s .= "\n\t\t";
        
        return $s;
}

?>