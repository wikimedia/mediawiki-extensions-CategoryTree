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

class CategoryTree {
	var $mIsAjaxRequest = false;
	
	/**
	 * Set the script tags in an OutputPage object
	 * @param OutputPage $outputPage 
	 */
	static function setHeaders( &$outputPage ) {
		global $wgJsMimeType, $wgScriptPath;
		efInjectCategoryTreeMessages();
		
		# Register css file for CategoryTree
		$outputPage->addLink( 
			array( 
				'rel' => 'stylesheet', 
				'type' => 'text/css', 
				'href' => $wgScriptPath . '/extensions/CategoryTree/CategoryTree.css' 
			) 
		);
		
		# Register main js file for CategoryTree
		$outputPage->addScript( 
			"<script type=\"{$wgJsMimeType}\" src=\"{$wgScriptPath}/extensions/CategoryTree/CategoryTree.js\">" .
			"</script>\n" 
		);
		
		# Add messages 
		$outputPage->addScript( 
		"	<script type=\"{$wgJsMimeType}\"> 
				categoryTreeCollapseMsg = \"".Xml::escapeJsString(self::msg('collapse'))."\"; 
				categoryTreeExpandMsg = \"".Xml::escapeJsString(self::msg('expand'))."\"; 
				categoryTreeLoadMsg = \"".Xml::escapeJsString(self::msg('load'))."\"; 
				categoryTreeLoadingMsg = \"".Xml::escapeJsString(self::msg('loading'))."\"; 
				categoryTreeNothingFoundMsg = \"".Xml::escapeJsString(self::msg('nothing-found'))."\"; 
			</script>\n" 
		);
	}	

	/**
	* Ajax call. This is called by efCategoryTreeAjaxWrapper, which is used to 
	* load CategoryTreeFunctions.php on demand.
	*/
	function ajax( $category, $mode ) {
		global $wgDBname;
		$title = self::makeTitle( $category );
		
		if ( ! $title ) return false; #TODO: error message?
		$this->mIsAjaxRequest = true;

		# Retrieve page_touched for the category
		$dbkey = $title->getDBkey();
		$dbr =& wfGetDB( DB_SLAVE );
		$touched = $dbr->selectField( 'page', 'page_touched', 
			array( 
				'page_namespace' => NS_CATEGORY,
				'page_title' => $dbkey,
			), __METHOD__ );
			
		$mckey = "$wgDBname:categorytree($mode):$dbkey";
		
		$response = new AjaxResponse();
		
		if ( $response->checkLastModified( $touched ) ) {
			return $response;
		}
		
		if ( $response->loadFromMemcached( $mckey, $touched ) ) {
			return $response;
		}
		
		$html = $this->renderChildren( $title, $mode );
		$response->addText( $html );
		
		$response->storeInMemcached( $mckey, 86400 );

		return $response;
	}

	/**
	* Custom tag implementation. This is called by efCategoryTreeParserHook, which is used to 
	* load CategoryTreeFunctions.php on demand.
	*/
	function getTag( &$parser, $category, $mode, $hideroot = false, $style = '' ) {
		global $wgCategoryTreeDisableCache, $wgCategoryTreeDynamicTag;
		static $uniq = 0;

		$this->mIsAjaxRequest = false;
		$category = trim( $category );
		if ( $category === '' ) {
			return false;
		}
		if ( $wgCategoryTreeDisableCache && !$wgCategoryTreeDynamicTag ) {
			$parser->disableCache();
		}
		$title = self::makeTitle( $category );
		
		if ( $title === false || $title === NULL ) return false;
		
		$html = '';
		$html .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeTag', 'style' => $style ) );
		
		if ( !$title->getArticleID() ) {
			$html .= wfOpenElement( 'span', array( 'class' => 'CategoryTreeNotice' ) );
			$html .= self::msg( 'not-found' , htmlspecialchars( $category ) );
			$html .= wfCloseElement( 'span' );
			}
		else {
			if ( !$hideroot ) $html .= CategoryTree::renderNode( $title, $mode, true, $wgCategoryTreeDynamicTag );
			else if ( !$wgCategoryTreeDynamicTag ) $html .= $this->renderChildren( $title, $mode );
			else {
				$uniq += 1;
				$load = 'ct-' . $uniq . '-' . mt_rand( 1, 100000 );
				
				$html .= wfOpenElement( 'script', array( 'type' => 'text/javascript', 'id' => $load ) );
				$html .= 'categoryTreeLoadChildren("' . Xml::escapeJsString( $title->getDBKey() ) . '", "' . $mode . '", document.getElementById("' . $load . '").parentNode );';
				$html .= wfCloseElement( 'script' );
			}
		}
		
		$html .= wfCloseElement( 'div' );
		$html .= "\n\t\t";
		
		return $html;
	}

	/**
	* Returns a string with an HTML representation of the children of the given category.
	* $title must be a Title object
	*/
	function renderChildren( &$title, $mode = CT_MODE_CATEGORIES ) {
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
				"./*AND cat.page_is_redirect = 0*/"
				$transWhere
				ORDER BY presort, cl_sortkey
				LIMIT " . (int)$wgCategoryTreeMaxChildren;

		$res = $dbr->query( $sql, __METHOD__ );
		
		$s= '';
		
		while ( $row = $dbr->fetchRow( $res ) ) {
				#TODO: translation support; ideally added to Title object
				$t = Title::makeTitle( $row['page_namespace'], $row['page_title'] );
				$s .= $this->renderNode( $t, $mode, false );
				$s .= "\n\t\t";
		}
		
		$dbr->freeResult( $res );
		
		return $s;
	}

	/**
	* Returns a string with an HTML representation of the parents of the given category.
	* $title must be a Title object
	*/
	static function renderParents( &$title, $mode ) {
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

		$res = $dbr->query( $sql, __METHOD__ );
		
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
	function renderNode( &$title, $mode = CT_MODE_CATEGORIES, $children = false, $loadchildren = false ) {
		static $uniq = 0;
		
		$load = false;
		
		if ( $loadchildren ) {
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
		
		if ( $ns == NS_CATEGORY ) {
			$labelClass .= ' CategoryTreeLabelCategory';
		} else {
			$labelClass .= ' CategoryTreeLabelPage';
		}
		
		if ( ( $ns % 2 ) > 0 ) $labelClass .= ' CategoryTreeLabelTalk';
		
		$linkattr= array( 'href' => 'javascript:void(0)' );
		
		if ( $load ) $linkattr[ 'id' ] = $load;

		if ( !$children ) {
			$txt = '+';
			$linkattr[ 'onclick' ] = "categoryTreeExpandNode('".Xml::escapeJsString($key)."','".$mode."',this);";
			# Don't load this message for ajax requests, so that we don't have to initialise $wgLang
			$linkattr[ 'title' ] = $this->mIsAjaxRequest ? '##LOAD##' : self::msg('load'); 
		}
		else {
			$txt = '–'; #NOTE: that's not a minus but a unicode ndash!
			$linkattr[ 'onclick' ] = "categoryTreeCollapseNode('".Xml::escapeJsString($key)."','".$mode."',this);";
			$linkattr[ 'title' ] = self::msg('collapse'); 
			$linkattr[ 'class' ] = 'CategoryTreeLoaded';
		}
		
		$s = '';

		#NOTE: things in CategoryTree.js rely on the exact order of tags!
		#      Specifically, the CategoryTreeChildren div must be the first
		#      sibling with nodeName = DIV of the grandparent of the expland link.
		
		$s .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeSection' ) );
		$s .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeItem' ) );
		
		$s .= wfOpenElement( 'span', array( 'class' => 'CategoryTreeBullet' ) );
		if ( $ns == NS_CATEGORY ) {
			$s .= '[' . wfElement( 'a', $linkattr, $txt ) . '] ';
		} else {
			$s .= ' ';
		}
		$s .= wfCloseElement( 'span' );
		
		$s .= wfOpenElement( 'a', array( 'class' => $labelClass, 'href' => $wikiLink ) ) . $label . wfCloseElement( 'a' );
		$s .= wfCloseElement( 'div' );
		$s .= "\n\t\t";
		$s .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeChildren', 'style' => $children ? "display:block" : "display:none" ) );
		if ( $children ) $s .= $this->renderChildren( $title, $mode ); 
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

	/**
	* Creates a Title object from a user provided (and thus unsafe) string
	*/
	static function makeTitle( $title ) {
		global $wgContLang, $wgCanonicalNamespaceNames;
		
		$title = trim($title);
		
		if ( $title === NULL || $title === '' || $title === false ) {
			return NULL;
		}

		# The title must be in the category namespace
		# Ignore a leading Category: if there is one
		$t = Title::newFromText( $title, NS_CATEGORY );
		if ( $t->getNamespace() != NS_CATEGORY ) {
			$title = "Category:$title";
			$t = Title::newFromText( $title );
		}
		return $t;
	}

	/**
	* load the CategoryTree internationalization file
	*/
	static function loadMessages() {
		global $wgLang;
		
		$messages= array();
		
		$f= dirname( __FILE__ ) . '/CategoryTree.i18n.php';
		include( $f );
		
		$f= dirname( __FILE__ ) . '/CategoryTree.i18n.' . $wgLang->getCode() . '.php';
		if ( file_exists( $f ) ) include( $f );
		
		return $messages;
	}

	/**
	 * Get a CategoryTree message, "categorytree-" prefix added automatically
	 */
	static function msg( $msg /*, ...*/ ) {
		static $initialized = false;
		global $wgMessageCache;
		if ( !$initialized ) {
			$wgMessageCache->addMessages( self::loadMessages() );
		}
		if ( $msg === false ) {
			return null;
		}
		$args = func_get_args();
		$msg = array_shift( $args );
		if ( $msg == '' ) {
			return wfMsgReal( $msg, $args );
		} else {
			return wfMsgReal( "categorytree-$msg", $args );
		}
	}
}
?>
