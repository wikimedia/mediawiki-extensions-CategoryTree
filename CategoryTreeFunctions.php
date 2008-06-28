<?php

/**
 * Core functions for the CategoryTree extension, an AJAX based gadget
 * to display the category structure of a wiki
 *
 * @addtogroup Extensions
 * @author Daniel Kinzler, brightbyte.de
 * @copyright © 2006-2007 Daniel Kinzler
 * @license GNU General Public Licence 2.0 or later
 */

if( !defined( 'MEDIAWIKI' ) ) {
	echo( "This file is part of an extension to the MediaWiki software and cannot be used standalone.\n" );
	die( 1 );
}

class CategoryTree {
	var $mIsAjaxRequest = false;
	var $mOptions = array();

	function __construct( $options, $ajax = false ) {
		global $wgCategoryTreeDefaultOptions;

		$this->mIsAjaxRequest = $ajax;

		#ensure default values and order of options. Order may become important, it may influence the cache key!
		foreach ( $wgCategoryTreeDefaultOptions as $option => $default ) {
			if ( isset( $options[$option] ) && !is_null( $options[$option] ) ) $this->mOptions[$option] = $options[$option];
			else $this->mOptions[$option] = $default;
		}

		$this->mOptions['mode'] = self::decodeMode( $this->mOptions['mode'] );
		$this->mOptions['hideprefix'] = self::decodeBoolean( $this->mOptions['hideprefix'] );
	}

	function getOption( $name ) {
		return $this->mOptions[$name];
	}

	static function decodeMode( $mode ) {
		global $wgCategoryTreeDefaultOptions;

		if ( is_null( $mode ) ) return $wgCategoryTreeDefaultOptions['mode'];
		if ( is_int( $mode ) ) return $mode;

		$mode = trim( strtolower( $mode ) );

		if ( is_numeric( $mode ) ) return (int)$mode;

		if ( $mode == 'all' ) $mode = CT_MODE_ALL;
		else if ( $mode == 'pages' ) $mode = CT_MODE_PAGES;
		else if ( $mode == 'categories' ) $mode = CT_MODE_CATEGORIES;
		else if ( $mode == 'default' ) $mode = $wgCategoryTreeDefaultOptions['mode'];

		return (int)$mode;
	}

	/**
	* Helper function to convert a string to a boolean value.
	* Perhaps make this a global function in MediaWiki proper
	*/
	static function decodeBoolean( $value ) {
		if ( is_null( $value ) ) return NULL;
		if ( is_bool( $value ) ) return $value;
		if ( is_int( $value ) ) return ( $value > 0 );

		$value = trim( strtolower( $value ) );
		if ( is_numeric( $value ) ) return ( (int)$mode > 0 );

		if ( $value == 'yes' || $value == 'y' || $value == 'true' || $value == 't' || $value == 'on' ) return true;
		else if ( $value == 'no' || $value == 'n' || $value == 'false' || $value == 'f' || $value == 'off' ) return false;
		else if ( $value == 'null' || $value == 'default' || $value == 'none' || $value == 'x' ) return NULL;
		else return false;
	}

	/**
	 * Set the script tags in an OutputPage object
	 * @param OutputPage $outputPage
	 */
	static function setHeaders( &$outputPage ) {
		global $wgJsMimeType, $wgScriptPath, $wgContLang, $wgCategoryTreeExtPath, $wgCategoryTreeVersion;
		wfLoadExtensionMessages( 'CategoryTree' );

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
			var categoryTreeCollapseBulletMsg = \"".Xml::escapeJsString(self::msg('collapse-bullet'))."\";
			var categoryTreeExpandBulletMsg = \"".Xml::escapeJsString(self::msg('expand-bullet'))."\";
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

	static function getJsonCodec() {
		static $json = NULL;

		if (!$json) {
			$json = new Services_JSON(); #recycle API's JSON codec implementation
		}

		return $json;
	}

	static function encodeOptions( $options, $enc ) {
		if ( $enc == 'mode' || $enc == '' ) {
			$opt =$options['mode'];
		} elseif ( $enc == 'json' ) {
			$json = self::getJsonCodec(); //XXX: this may be a bit heavy...
			$opt = $json->encode( $options );
		} else {
			throw new MWException( 'Unknown encoding for CategoryTree options: ' . $enc );
		}

		return $opt;
	}

	static function decodeOptions( $options, $enc ) {
		if ( $enc == 'mode' || $enc == '' ) {
			$opt = array( "mode" => $options );
		} elseif ( $enc == 'json' ) {
			$json = self::getJsonCodec(); //XXX: this may be a bit heavy...
			$opt = $json->decode( $options );
			$opt = get_object_vars( $opt );
		} /* elseif () {
			foreach ( $oo as $o ) {
				if ($o === "") continue;
		
				if ( preg_match( '!^(.*?)=(.*)$!', $o, $m ) {
					$n = $m[1];
					$opt[$n] = $m[2];
				} else {
					$opt[$o] = true;
				}
			}
		} */ else {
			throw new MWException( 'Unknown encoding for CategoryTree options: ' . $enc );
		}

		return $opt;
	}

	function getOptionsAsCacheKey( $depth = NULL ) {
		$key = "";

		foreach ( $this->mOptions as $k => $v ) {
			$key .= $k . ':' . $v . ';';
		}

		if ( !is_null( $depth ) ) $key .= ";depth=" . $depth;
		return $key;
	}

	function getOptionsAsJsStructure( $depth = NULL ) {
		if ( !is_null( $depth ) ) {
			$opt = $this->mOptions;
			$opt['depth'] = $depth;
			$s = self::encodeOptions( $opt, 'json' );
		} else {
			$s = self::encodeOptions( $this->mOptions, 'json' );
		}

		return $s;
	}

	function getOptionsAsJsString( $depth = NULL ) {
		return Xml::escapeJsString( $s );
	}

	function getOptionsAsUrlParameters() {
		$u = '';

		foreach ( $this->mOptions as $k => $v ) {
			if ( $u != '' ) $u .= '&';
			$u .= $k . '=' . urlencode($v) ;
		}

		return $u;
	}

	/**
	* Ajax call. This is called by efCategoryTreeAjaxWrapper, which is used to
	* load CategoryTreeFunctions.php on demand.
	*/
	function ajax( $category, $depth = 1 ) {
		global $wgDBname;
		$title = self::makeTitle( $category );

		if ( ! $title ) return false; #TODO: error message?

		# Retrieve page_touched for the category
		$dbkey = $title->getDBkey();
		$dbr =& wfGetDB( DB_SLAVE );
		$touched = $dbr->selectField( 'page', 'page_touched',
			array(
				'page_namespace' => NS_CATEGORY,
				'page_title' => $dbkey,
			), __METHOD__ );

		$mckey = "$wgDBname:categorytree(" . $this->getOptionsAsCacheKey( $depth ) . "):$dbkey"; 

		$response = new AjaxResponse();

		if ( $response->checkLastModified( $touched ) ) {
			return $response;
		}

		if ( $response->loadFromMemcached( $mckey, $touched ) ) {
			return $response;
		}

		$html = $this->renderChildren( $title, $depth ); 

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
	function getTag( &$parser, $category, $hideroot = false, $style = '', $depth=1 ) {
		global $wgCategoryTreeDisableCache, $wgCategoryTreeDynamicTag;
		static $uniq = 0;

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
		$html .= Xml::openElement( 'div', array( 'class' => 'CategoryTreeTag', 'style' => $style ) );

		if ( !$title->getArticleID() ) {
			$html .= Xml::openElement( 'span', array( 'class' => 'CategoryTreeNotice' ) );
			$html .= self::msg( 'not-found' , htmlspecialchars( $category ) );
			$html .= Xml::closeElement( 'span' );
			}
		else {
			if ( !$hideroot ) $html .= CategoryTree::renderNode( $title, $depth, $wgCategoryTreeDynamicTag );
			else if ( !$wgCategoryTreeDynamicTag ) $html .= $this->renderChildren( $title, $depth );
			else { 
				$uniq += 1;
				$load = 'ct-' . $uniq . '-' . mt_rand( 1, 100000 );

				$html .= Xml::openElement( 'script', array( 'type' => 'text/javascript', 'id' => $load ) );
				$html .= 'categoryTreeLoadChildren("' . Xml::escapeJsString( $title->getDBkey() ) . '", ' . $this->getOptionsAsJsStructure( $depth ) . ', document.getElementById("' . $load . '").parentNode);';
				$html .= Xml::closeElement( 'script' );
			}
		}

		$html .= Xml::closeElement( 'div' );
		$html .= "\n\t\t";

		return $html;
	}

	/**
	* Returns a string with an HTML representation of the children of the given category.
	* $title must be a Title object
	*/
	function renderChildren( &$title, $depth=1 ) {
		global $wgCategoryTreeMaxChildren;

		if( $title->getNamespace() != NS_CATEGORY ) {
			// Non-categories can't have children. :)
			return '';
		}

		$dbr =& wfGetDB( DB_SLAVE );

		#additional stuff to be used if "transaltion" by interwiki-links is desired
		$transFields = '';
		$transJoin = '';
		$transWhere = '';

		$mode = $this->getOption('mode');

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
				WHERE cl_to = " . $dbr->addQuotes( $title->getDBkey() ) . "
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

			$s = $this->renderNode( $t, $depth-1, false );
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
	function renderParents( &$title ) {
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
			if ( $trans && $trans!=$label ) $label.= ' ' . Xml::element( 'i', array( 'class' => 'translation'), $trans );

			$wikiLink = $special->getLocalURL( 'target=' . $t->getPartialURL() . '&' . $this->getOptionsAsUrlParameters() );

			if ( $s !== '' ) $s .= ' | ';

			$s .= Xml::openElement( 'span', array( 'class' => 'CategoryTreeItem' ) );
			$s .= Xml::openElement( 'a', array( 'class' => 'CategoryTreeLabel', 'href' => $wikiLink ) ) . $label . Xml::closeElement( 'a' );
			$s .= Xml::closeElement( 'span' );

			$s .= "\n\t\t";
		}

		$dbr->freeResult( $res );

		return $s;
	}

	/**
	* Returns a string with a HTML represenation of the given page.
	* $title must be a Title object
	*/
	function renderNode( &$title, $children = 0, $loadchildren = false ) {
		global $wgCategoryTreeDefaultMode;
		static $uniq = 0;

		$mode = $this->getOption('mode');
		$load = false;

		if ( $children > 0 && $loadchildren ) {
			$uniq += 1;

			$load = 'ct-' . $uniq . '-' . mt_rand( 1, 100000 );
		}

		$ns = $title->getNamespace();
		$key = $title->getDBkey();

		#$trans = $title->getLocalizedText();
		$trans = ''; #place holder for when translated titles are available

		#when showing only categories, omit namespace in label unless we explicitely defined the configuration setting
		#patch contributed by Manuel Schneider <manuel.schneider@wikimedia.ch>, Bug 8011
		if ( $this->getOption('hideprefix') || $mode == CT_MODE_CATEGORIES ) $label = htmlspecialchars( $title->getText() );
		else $label = htmlspecialchars( $title->getPrefixedText() );

		if ( $trans && $trans!=$label ) $label.= ' ' . Xml::element( 'i', array( 'class' => 'translation'), $trans );

		$wikiLink = $title->getLocalURL();

		$labelClass = 'CategoryTreeLabel ' . ' CategoryTreeLabelNs' . $ns;

		if ( $ns == NS_CATEGORY ) {
			$labelClass .= ' CategoryTreeLabelCategory';
		} else {
			$labelClass .= ' CategoryTreeLabelPage';
		}

		if ( ( $ns % 2 ) > 0 ) $labelClass .= ' CategoryTreeLabelTalk';

		$s = '';

		#NOTE: things in CategoryTree.js rely on the exact order of tags!
		#      Specifically, the CategoryTreeChildren div must be the first
		#      sibling with nodeName = DIV of the grandparent of the expland link.

		$s .= Xml::openElement( 'div', array( 'class' => 'CategoryTreeSection' ) );
		$s .= Xml::openElement( 'div', array( 'class' => 'CategoryTreeItem' ) );

		$attr = array( 'class' => 'CategoryTreeBullet' );
		$s .= Xml::openElement( 'span', $attr );

		if ( $ns == NS_CATEGORY ) {
			$linkattr= array( 'href' => '#' );
			if ( $load ) $linkattr[ 'id' ] = $load;

			$linkattr[ 'class' ] = "CategoryTreeToggle";

			if ( $children == 0 || $loadchildren ) {
				$txt = $this->msg('expand-bullet');
				$linkattr[ 'onclick' ] = "this.href='javascript:void(0)'; categoryTreeExpandNode('".Xml::escapeJsString($key)."',".$this->getOptionsAsJsStructure().",this);";
				# Don't load this message for ajax requests, so that we don't have to initialise $wgLang
				$linkattr[ 'title' ] = $this->mIsAjaxRequest ? '##LOAD##' : self::msg('expand');
			}
			else {
				$txt = $this->msg('collapse-bullet');
				$linkattr[ 'onclick' ] = "this.href='javascript:void(0)'; categoryTreeCollapseNode('".Xml::escapeJsString($key)."',".$this->getOptionsAsJsStructure().",this);";
				$linkattr[ 'title' ] = self::msg('collapse');
				$linkattr[ 'class' ] .= ' CategoryTreeLoaded';
			}

			$s .= Xml::openElement( 'a', $linkattr ) . $txt . Xml::closeElement( 'a' ) . ' ';
		} else {
			$s .= $this->msg('page-bullet');
		}

		$s .= Xml::closeElement( 'span' );

		$s .= Xml::openElement( 'a', array( 'class' => $labelClass, 'href' => $wikiLink ) ) . $label . Xml::closeElement( 'a' );
		$s .= Xml::closeElement( 'div' );
		$s .= "\n\t\t";
		$s .= Xml::openElement( 'div', array( 'class' => 'CategoryTreeChildren', 'style' => $children > 0 ? "display:block" : "display:none" ) );
		
		if ( $children > 0 && !$loadchildren) $s .= $this->renderChildren( $title, $children );
		$s .= Xml::closeElement( 'div' );
		$s .= Xml::closeElement( 'div' );

		if ( $load ) {
			$s .= "\n\t\t";
			$s .= Xml::openElement( 'script', array( 'type' => 'text/javascript' ) );
			$s .= 'categoryTreeExpandNode("'.Xml::escapeJsString($key).'", '.$this->getOptionsAsJsStructure($children).', document.getElementById("'.$load.'"));';
			$s .= Xml::closeElement( 'script' );
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
	 * Get a CategoryTree message, "categorytree-" prefix added automatically
	 */
	static function msg( $msg /*, ...*/ ) {
		wfLoadExtensionMessages( 'CategoryTree' );

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
