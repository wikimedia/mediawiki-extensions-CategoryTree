<?php

/**
 * Core functions for the CategoryTree extension, an AJAX based gadget 
 * to display the category structure of a wiki
 *
 * @addtogroup Extensions
 * @author Daniel Kinzler, brightbyte.de
 * @copyright © 2006-2007 Daniel Kinzler
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
		global $wgJsMimeType, $wgScriptPath, $wgContLang, $wgCategoryTreeExtPath, $wgCategoryTreeVersion;
		efInjectCategoryTreeMessages();
		
		# Register css file for CategoryTree
		$outputPage->addLink( 
			array( 
				'rel' => 'stylesheet', 
				'type' => 'text/css', 
				'href' => "$wgScriptPath$wgCategoryTreeExtPath/CategoryTree.css?$wgCategoryTreeVersion",
			) 
		);
		
		# Register css RTL file for CategoryTree
		if( $wgContLang->isRTL() ) {
			$outputPage->addLink( 
				array( 
					'rel' => 'stylesheet', 
					'type' => 'text/css', 
					'href' => "$wgScriptPath$wgCategoryTreeExtPath/CategoryTree.rtl.css?$wgCategoryTreeVersion" 
				) 
			);
		}
		
		# Register main js file for CategoryTree
		$outputPage->addScript( 
			"<script type=\"{$wgJsMimeType}\" src=\"{$wgScriptPath}{$wgCategoryTreeExtPath}/CategoryTree.js?{$wgCategoryTreeVersion}\">" .
			"</script>\n" 
		);
		
		# Add messages 
		$outputPage->addScript( 
		"	<script type=\"{$wgJsMimeType}\"> 
			var categoryTreeCollapseMsg = \"".Xml::escapeJsString(self::msg('collapse'))."\"; 
			var categoryTreeExpandMsg = \"".Xml::escapeJsString(self::msg('expand'))."\"; 
			var categoryTreeLoadMsg = \"".Xml::escapeJsString(self::msg('load'))."\"; 
			var categoryTreeLoadingMsg = \"".Xml::escapeJsString(self::msg('loading'))."\"; 
			var categoryTreeNothingFoundMsg = \"".Xml::escapeJsString(self::msg('nothing-found'))."\"; 
			var categoryTreeNoSubcategoriesMsg = \"".Xml::escapeJsString(self::msg('no-subcategories'))."\"; 
			var categoryTreeNoPagesMsg = \"".Xml::escapeJsString(self::msg('no-pages'))."\"; 
			var categoryTreeErrorMsg = \"".Xml::escapeJsString(self::msg('error'))."\"; 
			var categoryTreeRetryMsg = \"".Xml::escapeJsString(self::msg('retry'))."\"; 
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
			
		$mckey = "$wgDBname:categorytree($mode):$dbkey"; //FIXME: would need to add depth parameter.
		
		$response = new AjaxResponse();
		
		if ( $response->checkLastModified( $touched ) ) {
			return $response;
		}
		
		if ( $response->loadFromMemcached( $mckey, $touched ) ) {
			return $response;
		}
		
		$html = $this->renderChildren( $title, $mode ); //FIXME: would need to pass depth parameter.
		
		if ( $html == '' ) $html = ' ';   #HACK: Safari doesn't like empty responses. 
						  #see Bug 7219 and http://bugzilla.opendarwin.org/show_bug.cgi?id=10716
		
		$response->addText( $html );
		
		$response->storeInMemcached( $mckey, 86400 );

		return $response;
	}

	/**
	* Custom tag implementation. This is called by efCategoryTreeParserHook, which is used to 
	* load CategoryTreeFunctions.php on demand.
	*/
	function getTag( &$parser, $category, $mode, $hideroot = false, $style = '', $depth=1 ) {
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
			if ( !$hideroot ) $html .= CategoryTree::renderNode( $title, $mode, $depth>0, $wgCategoryTreeDynamicTag, $depth-1 );
			else if ( !$wgCategoryTreeDynamicTag ) $html .= $this->renderChildren( $title, $mode, $depth-1 );
			else { //FIXME: depth would need to be propagated here. this would imact the cache key, too
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
	function renderChildren( &$title, $mode = NULL, $depth=0 ) {
		global $wgCategoryTreeMaxChildren, $wgCategoryTreeDefaultMode;
		
		if( $title->getNamespace() != NS_CATEGORY ) {
			// Non-categories can't have children. :)
			return '';
		}
		
		$dbr =& wfGetDB( DB_SLAVE );

		#additional stuff to be used if "transaltion" by interwiki-links is desired
		$transFields = '';
		$transJoin = '';
		$transWhere = '';

		if ( $mode === NULL ) $wgCategoryTreeDefaultMode;
		
		#namespace filter. Should be configurable
		if ( $mode == CT_MODE_ALL ) $nsmatch = '';
		else if ( $mode == CT_MODE_PAGES ) $nsmatch = ' AND cat.page_namespace != ' . NS_IMAGE;
		else $nsmatch = ' AND cat.page_namespace = ' . NS_CATEGORY;
	
		$page = $dbr->tableName( 'page' );
		$categorylinks = $dbr->tableName( 'categorylinks' );
		
		$sql = "SELECT cat.page_namespace, cat.page_title
					  $transFields
				FROM $page as cat
				JOIN $categorylinks ON cl_from = cat.page_id
				$transJoin
				WHERE cl_to = " . $dbr->addQuotes( $title->getDBKey() ) . " 
				$nsmatch
				"./*AND cat.page_is_redirect = 0*/"
				$transWhere
				ORDER BY cl_sortkey
				LIMIT " . (int)$wgCategoryTreeMaxChildren;

		$res = $dbr->query( $sql, __METHOD__ );
		
		#collect categories separately from other pages
		$categories= '';
		$other= '';
		
		while ( $row = $dbr->fetchRow( $res ) ) {
			#TODO: translation support; ideally added to Title object
			$t = Title::makeTitle( $row['page_namespace'], $row['page_title'] );

			$s = $this->renderNode( $t, $mode, $depth>0, false, $depth-1 );
			$s .= "\n\t\t";

			if ($row['page_namespace'] == NS_CATEGORY) $categories .= $s;
			else $other .= $s;
		}
		
		$dbr->freeResult( $res );
		
		return $categories . $other;
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
	function renderNode( &$title, $mode = NULL, $children = false, $loadchildren = false, $depth = 1 ) {
		global $wgCategoryTreeOmitNamespace, $wgCategoryTreeDefaultMode;
		static $uniq = 0;
		
		if ( $mode === NULL ) $wgCategoryTreeDefaultMode;
		$load = false;
		
		if ( $children && $loadchildren ) {
			$uniq += 1;

			$load = 'ct-' . $uniq . '-' . mt_rand( 1, 100000 );
			$children = false;
		}

		$ns = $title->getNamespace();
		$key = $title->getDBKey();
		
		#$trans = $title->getLocalizedText();
		$trans = ''; #place holder for when translated titles are available
		
		#when showing only categories, omit namespace in label unless we explicitely defined the configuration setting
		#patch contributed by Manuel Schneider <manuel.schneider@wikimedia.ch>, Bug 8011
		if ( $wgCategoryTreeOmitNamespace || $mode == CT_MODE_CATEGORIES ) $label = htmlspecialchars( $title->getText() );
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
		
		$linkattr= array( 'href' => '#' );
		
		if ( $load ) $linkattr[ 'id' ] = $load;

		if ( !$children ) {
			$txt = '+';
			$linkattr[ 'onclick' ] = "this.href='javascript:void(0)'; categoryTreeExpandNode('".Xml::escapeJsString($key)."','".$mode."',this);";
			# Don't load this message for ajax requests, so that we don't have to initialise $wgLang
			$linkattr[ 'title' ] = $this->mIsAjaxRequest ? '##LOAD##' : self::msg('expand'); 
		}
		else {
			$txt = '–'; #NOTE: that's not a minus but a unicode ndash!
			$linkattr[ 'onclick' ] = "this.href='javascript:void(0)'; categoryTreeCollapseNode('".Xml::escapeJsString($key)."','".$mode."',this);";
			$linkattr[ 'title' ] = self::msg('collapse'); 
			$linkattr[ 'class' ] = 'CategoryTreeLoaded';
		}
		
		$s = '';
		
		#NOTE: things in CategoryTree.js rely on the exact order of tags!
		#      Specifically, the CategoryTreeChildren div must be the first
		#      sibling with nodeName = DIV of the grandparent of the expland link.
		
		$s .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeSection' ) );
		$s .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeItem' ) );
		
		if ( $ns == NS_CATEGORY ) {
			$s .= wfOpenElement( 'span', array( 'class' => 'CategoryTreeBullet' ) );
			$s .= '[' . wfElement( 'a', $linkattr, $txt ) . '] ';
			$s .= wfCloseElement( 'span' );
		} else {
			$s .= ' ';
		}
		
		$s .= wfOpenElement( 'a', array( 'class' => $labelClass, 'href' => $wikiLink ) ) . $label . wfCloseElement( 'a' );
		$s .= wfCloseElement( 'div' );
		$s .= "\n\t\t";
		$s .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeChildren', 'style' => $children ? "display:block" : "display:none" ) );
		//HACK here?
		if ( $children ) $s .= $this->renderChildren( $title, $mode, $depth ); 
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
		if ( $t && ( $t->getNamespace() != NS_CATEGORY || $t->getInterWiki() != '' ) ) {
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
			$initialized = true;
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

