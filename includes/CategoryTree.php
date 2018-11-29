<?php
/**
 * Core functions for the CategoryTree extension, an AJAX based gadget
 * to display the category structure of a wiki
 *
 * @file
 * @ingroup Extensions
 * @author Daniel Kinzler, brightbyte.de
 * @copyright © 2006-2007 Daniel Kinzler
 * @license GNU General Public Licence 2.0 or later
 */

class CategoryTree {
	public $mOptions = [];

	/**
	 * @param array $options
	 */
	function __construct( $options ) {
		global $wgCategoryTreeDefaultOptions;

		// ensure default values and order of options.
		// Order may become important, it may influence the cache key!
		foreach ( $wgCategoryTreeDefaultOptions as $option => $default ) {
			if ( isset( $options[$option] ) && !is_null( $options[$option] ) ) {
				$this->mOptions[$option] = $options[$option];
			} else {
				$this->mOptions[$option] = $default;
			}
		}

		$this->mOptions['mode'] = self::decodeMode( $this->mOptions['mode'] );

		if ( $this->mOptions['mode'] == CategoryTreeMode::PARENTS ) {
			// namespace filter makes no sense with CategoryTreeMode::PARENTS
			$this->mOptions['namespaces'] = false;
		}

		$this->mOptions['hideprefix'] = self::decodeHidePrefix( $this->mOptions['hideprefix'] );
		$this->mOptions['showcount'] = self::decodeBoolean( $this->mOptions['showcount'] );
		$this->mOptions['namespaces'] = self::decodeNamespaces( $this->mOptions['namespaces'] );

		if ( $this->mOptions['namespaces'] ) {
			# automatically adjust mode to match namespace filter
			if ( count( $this->mOptions['namespaces'] ) === 1
				&& $this->mOptions['namespaces'][0] == NS_CATEGORY ) {
				$this->mOptions['mode'] = CategoryTreeMode::CATEGORIES;
			} elseif ( !in_array( NS_FILE, $this->mOptions['namespaces'] ) ) {
				$this->mOptions['mode'] = CategoryTreeMode::PAGES;
			} else {
				$this->mOptions['mode'] = CategoryTreeMode::ALL;
			}
		}
	}

	/**
	 * @param string $name
	 * @return mixed
	 */
	function getOption( $name ) {
		return $this->mOptions[$name];
	}

	/**
	 * @return bool
	 */
	function isInverse() {
		return $this->getOption( 'mode' ) == CategoryTreeMode::PARENTS;
	}

	/**
	 * @param mixed $nn
	 * @return array|bool
	 */
	static function decodeNamespaces( $nn ) {
		global $wgContLang;

		if ( $nn === false || is_null( $nn ) ) {
			return false;
		}

		if ( !is_array( $nn ) ) {
			$nn = preg_split( '![\s#:|]+!', $nn );
		}

		$namespaces = [];

		foreach ( $nn as $n ) {
			if ( is_int( $n ) ) {
				$ns = $n;
			} else {
				$n = trim( $n );
				if ( $n === '' ) {
					continue;
				}

				$lower = strtolower( $n );

				if ( is_numeric( $n ) ) {
					$ns = (int)$n;
				} elseif ( $n == '-' || $n == '_' || $n == '*' || $lower == 'main' ) {
					$ns = NS_MAIN;
				} else {
					$ns = $wgContLang->getNsIndex( $n );
				}
			}

			if ( is_int( $ns ) ) {
				$namespaces[] = $ns;
			}
		}

		sort( $namespaces ); # get elements into canonical order
		return $namespaces;
	}

	/**
	 * @param mixed $mode
	 * @return int|string
	 */
	static function decodeMode( $mode ) {
		global $wgCategoryTreeDefaultOptions;

		if ( is_null( $mode ) ) {
			return $wgCategoryTreeDefaultOptions['mode'];
		}
		if ( is_int( $mode ) ) {
			return $mode;
		}

		$mode = trim( strtolower( $mode ) );

		if ( is_numeric( $mode ) ) {
			return (int)$mode;
		}

		if ( $mode == 'all' ) {
			$mode = CategoryTreeMode::ALL;
		} elseif ( $mode == 'pages' ) {
			$mode = CategoryTreeMode::PAGES;
		} elseif ( $mode == 'categories' || $mode == 'sub' ) {
			$mode = CategoryTreeMode::CATEGORIES;
		} elseif ( $mode == 'parents' || $mode == 'super' || $mode == 'inverse' ) {
			$mode = CategoryTreeMode::PARENTS;
		} elseif ( $mode == 'breadcrumbs' ) {
			$mode = CategoryTreeMode::BREADCRUMBS;
		} elseif ( $mode == 'default' ) {
			$mode = $wgCategoryTreeDefaultOptions['mode'];
		}

		return (int)$mode;
	}

	/**
	 * Helper function to convert a string to a boolean value.
	 * Perhaps make this a global function in MediaWiki proper
	 * @param mixed $value
	 * @return bool|null|string
	 */
	static function decodeBoolean( $value ) {
		if ( is_null( $value ) ) {
			return null;
		}
		if ( is_bool( $value ) ) {
			return $value;
		}
		if ( is_int( $value ) ) {
			return ( $value > 0 );
		}

		$value = trim( strtolower( $value ) );
		if ( is_numeric( $value ) ) {
			return ( (int)$value > 0 );
		}

		if ( $value == 'yes' || $value == 'y'
			|| $value == 'true' || $value == 't' || $value == 'on'
		) {
			return true;
		} elseif ( $value == 'no' || $value == 'n'
			|| $value == 'false' || $value == 'f' || $value == 'off'
		) {
			return false;
		} elseif ( $value == 'null' || $value == 'default' || $value == 'none' || $value == 'x' ) {
			return null;
		} else {
			return false;
		}
	}

	/**
	 * @param mixed $value
	 * @return int|string
	 */
	static function decodeHidePrefix( $value ) {
		global $wgCategoryTreeDefaultOptions;

		if ( is_null( $value ) ) {
			return $wgCategoryTreeDefaultOptions['hideprefix'];
		}
		if ( is_int( $value ) ) {
			return $value;
		}
		if ( $value === true ) {
			return CategoryTreeHidePrefix::ALWAYS;
		}
		if ( $value === false ) {
			return CategoryTreeHidePrefix::NEVER;
		}

		$value = trim( strtolower( $value ) );

		if ( $value == 'yes' || $value == 'y'
			|| $value == 'true' || $value == 't' || $value == 'on'
		) {
			return CategoryTreeHidePrefix::ALWAYS;
		} elseif ( $value == 'no' || $value == 'n'
			|| $value == 'false' || $value == 'f' || $value == 'off'
		) {
			return CategoryTreeHidePrefix::NEVER;
		} elseif ( $value == 'always' ) {
			return CategoryTreeHidePrefix::ALWAYS;
		} elseif ( $value == 'never' ) {
			return CategoryTreeHidePrefix::NEVER;
		} elseif ( $value == 'auto' ) {
			return CategoryTreeHidePrefix::AUTO;
		} elseif ( $value == 'categories' || $value == 'category' || $value == 'smart' ) {
			return CategoryTreeHidePrefix::CATEGORIES;
		} else {
			return $wgCategoryTreeDefaultOptions['hideprefix'];
		}
	}

	/**
	 * Add ResourceLoader modules to the OutputPage object
	 * @param OutputPage $outputPage
	 */
	static function setHeaders( $outputPage ) {
		# Add the modules
		$outputPage->addModuleStyles( 'ext.categoryTree.css' );
		$outputPage->addModules( 'ext.categoryTree' );
	}

	/**
	 * @param array $options
	 * @param string $enc
	 * @return mixed
	 * @throws Exception
	 */
	protected static function encodeOptions( $options, $enc ) {
		if ( $enc == 'mode' || $enc == '' ) {
			$opt = $options['mode'];
		} elseif ( $enc == 'json' ) {
			$opt = FormatJson::encode( $options );
		} else {
			throw new Exception( 'Unknown encoding for CategoryTree options: ' . $enc );
		}

		return $opt;
	}

	/**
	 * @param string|null $depth
	 * @return string
	 */
	function getOptionsAsCacheKey( $depth = null ) {
		$key = "";

		foreach ( $this->mOptions as $k => $v ) {
			if ( is_array( $v ) ) {
				$v = implode( '|', $v );
			}
			$key .= $k . ':' . $v . ';';
		}

		if ( !is_null( $depth ) ) {
			$key .= ";depth=" . $depth;
		}
		return $key;
	}

	/**
	 * @param int|null $depth
	 * @return mixed
	 */
	public function getOptionsAsJsStructure( $depth = null ) {
		if ( $depth !== null ) {
			$opt = $this->mOptions;
			$opt['depth'] = $depth;
			$s = self::encodeOptions( $opt, 'json' );
		} else {
			$s = self::encodeOptions( $this->mOptions, 'json' );
		}

		return $s;
	}

	/**
	 * @return string
	 */
	function getOptionsAsUrlParameters() {
		return http_build_query( $this->mOptions );
	}

	/**
	 * return array of html data to display breadcrumbs, according to data passed in params
	 * @param array $nodesInfo
	 */
	protected function getHtmlBreadcrumbs($nodesInfo,$index =0) {

		$hideprefix = $this->getOption( 'hideprefix' );
		$ns = $nodesInfo['title']->getNamespace();

		if ( $hideprefix == CategoryTreeHidePrefix::ALWAYS ) {
			$hideprefix = true;
		} elseif ( $hideprefix == CategoryTreeHidePrefix::AUTO ) {
			$hideprefix = ( $mode == CategoryTreeMode::CATEGORIES );
		} elseif ( $hideprefix == CategoryTreeHidePrefix::CATEGORIES ) {
			$hideprefix = ( $ns == NS_CATEGORY );
		} else {
			$hideprefix = true;
		}

		# when showing only categories, omit namespace in label unless we explicitely defined the configuration setting
		# patch contributed by Manuel Schneider <manuel.schneider@wikimedia.ch>, Bug 8011
		if( ! $nodesInfo['title']) {
			$label = 'Error no title';
		} else if ( $hideprefix ) {
			$label = htmlspecialchars( $nodesInfo['title']->getText() );
		} else {
			$label = htmlspecialchars( $nodesInfo['title']->getPrefixedText() );
		}

		if( $index > 0) {
			$label = Xml::tags(
						'a',
						['href' => $nodesInfo['title']->getLocalURL()],
						$label);
		}

		$label = Xml::tags(
					'span',
					['class' => 'breadcrum-element'],
					$label
			).' ';

		if (count($nodesInfo['categories']) == 0) {
			return [ $label];
		}

		$result = [];

		$separator = Xml::tags(
					'span',
					['class' => 'breadcrum-separator fa fa-chevron-right'],
					''
		).' ';

		foreach ($nodesInfo['categories'] as $parentBreadcrumbData) {
			$parentBreadcrumbs = $this->getHtmlBreadcrumbs($parentBreadcrumbData, $index +1);
			foreach ($parentBreadcrumbs as $parentBreadcrumb) {
				$result[] = $parentBreadcrumb . $separator . $label;
			}
		}
		return $result;
	}

	protected function renderBreadcrumbs($nodeData) {
		$htmlBreadCrumbs = $this->getHtmlBreadcrumbs($nodeData);

		$r = '';
		$r .= Xml::openElement('div', ['class' => 'breadcrums-container']);
		foreach ($htmlBreadCrumbs as $htmlBreadCrumb) {
			$r .= Xml::tags(
					'div',
					['class' => 'breadcrum'],
					$htmlBreadCrumb
			).' ';
		}
		$r .= Xml::closeElement('div');
		return $r;
	}

	public function getHtmlBreadcrumb($title) {
		$param = ['mode' => CategoryTreeMode::BREADCRUMBS];
		$categoryTreeCore = new CategoryTreeCore($param);

		$nodeData = $categoryTreeCore->getNodeData( $title, 10);

		return $this->renderBreadcrumbs($nodeData);
	}

    /**
     * Custom tag implementation. This is called by CategoryTreeHooks::parserHook, which is used to
     * load CategoryTreeFunctions.php on demand.
     * @param Parser $parser
     * @param string $category
     * @param bool $hideroot
     * @param string $attr
     * @param int $depth
     * @param bool $allowMissing
     * @return bool|string
     * @throws MWException
     */
	function getTag( $parser, $category, $hideroot = false, $attr, $depth = 1,
		$allowMissing = false
	) {
		global $wgCategoryTreeDisableCache;

		$category = trim( $category );
		if ( $category === '' ) {
			return false;
		}

		if ( $parser ) {
			if ( is_bool( $wgCategoryTreeDisableCache ) && $wgCategoryTreeDisableCache === true ) {
				$parser->disableCache();
			} elseif ( is_int( $wgCategoryTreeDisableCache ) ) {
				$parser->getOutput()->updateCacheExpiry( $wgCategoryTreeDisableCache );
			}
		}

		$title = self::makeTitle( $category );

		if ( $title === false || $title === null ) {
			return false;
		}

		if ( isset( $attr['class'] ) ) {
			$attr['class'] .= ' CategoryTreeTag row';
		} else {
			$attr['class'] = ' CategoryTreeTag row';
		}

		$attr['data-ct-mode'] = $this->mOptions['mode'];
		$attr['data-ct-options'] = $this->getOptionsAsJsStructure();

		if ($attr['data-ct-mode'] == CategoryTreeMode::BREADCRUMBS) {
			// for now only for breadCrumbs, but we should migrate other modes...

			$param = ['mode' => $attr['data-ct-mode']];
			$categoryTreeCore = new CategoryTreeCore($param);

			$nodeData = $categoryTreeCore->getNodeData( $title, $depth);

			$html = $this->renderBreadcrumbs($nodeData);
			return $html;
		}

		$html = '';
		$html .= Html::openElement( 'div', $attr );

		if ( !$allowMissing && !$title->getArticleID() ) {
			$html .= Html::openElement( 'span', [ 'class' => 'CategoryTreeNotice' ] );
			if ( $parser ) {
				$html .= $parser->recursiveTagParse(
					wfMessage( 'categorytree-not-found', $category )->plain() );
			} else {
				$html .= wfMessage( 'categorytree-not-found', $category )->parse();
			}
			$html .= Html::closeElement( 'span' );
		} else {
		    $html .= $this->renderChildren( $title, $depth );
		}

		$html .= Xml::closeElement( 'div' );
		$html .= "\n\t\t";

		return $html;
	}

    /**
     * Returns a string with an HTML representation of the children of the given category.
     * @param Title $title
     * @param int $depth
     * @return string
     * @throws MWException
     */
	function renderChildren( $title, $depth = 1 ) {
		global $wgCategoryTreeMaxChildren, $wgCategoryTreeUseCategoryTable;

		if ( $title->getNamespace() != NS_CATEGORY ) {
			// Non-categories can't have children. :)
			return '';
		}

		$dbr = wfGetDB( DB_REPLICA );

		$inverse = $this->isInverse();
		$mode = $this->getOption( 'mode' );
		$namespaces = $this->getOption( 'namespaces' );

		$tables = [ 'page', 'categorylinks' ];
		$fields = [ 'page_id', 'page_namespace', 'page_title',
			'page_is_redirect', 'page_len', 'page_latest', 'cl_to',
			'cl_from' ];
		$where = [];
		$joins = [];
		$options = [ 'ORDER BY' => 'cl_type, cl_sortkey', 'LIMIT' => $wgCategoryTreeMaxChildren ];

		if ( $inverse ) {
			$joins['categorylinks'] = [ 'RIGHT JOIN', [
				'cl_to = page_title', 'page_namespace' => NS_CATEGORY
			] ];
			$where['cl_from'] = $title->getArticleID();
		} else {
			$joins['categorylinks'] = [ 'JOIN', 'cl_from = page_id' ];
			$where['cl_to'] = $title->getDBkey();
			$options['USE INDEX']['categorylinks'] = 'cl_sortkey';

			# namespace filter.
			if ( $namespaces ) {
				// NOTE: we assume that the $namespaces array contains only integers!
				// decodeNamepsaces makes it so.
				$where['page_namespace'] = $namespaces;
			} elseif ( $mode != CategoryTreeMode::ALL ) {
				if ( $mode == CategoryTreeMode::PAGES ) {
					$where['cl_type'] = [ 'page', 'subcat' ];
				} else {
					$where['cl_type'] = 'subcat';
				}
			}
		}

		# fetch member count if possible
		$doCount = !$inverse && $wgCategoryTreeUseCategoryTable;

		if ( $doCount ) {
			$tables = array_merge( $tables, [ 'category' ] );
			$fields = array_merge( $fields, [
				'cat_id', 'cat_title', 'cat_subcats', 'cat_pages', 'cat_files'
			] );
			$joins['category'] = [ 'LEFT JOIN', [
				'cat_title = page_title', 'page_namespace' => NS_CATEGORY ]
			];
		}

		$res = $dbr->select( $tables, $fields, $where, __METHOD__, $options, $joins );

		# collect categories separately from other pages
		$categories = '';
		$other = '';

		// Fetch all subcategories image from this title
		$images = CategoryTreeImageList::fromCategory($title);

		foreach ( $res as $row ) {
			# NOTE: in inverse mode, the page record may be null, because we use a right join.
			#      happens for categories with no category page (red cat links)
			if ( $inverse && $row->page_title === null ) {
				$t = Title::makeTitle( NS_CATEGORY, $row->cl_to );
			} else {
				# TODO: translation support; ideally added to Title object
				$t = Title::newFromRow( $row );
			}

			$cat = null;

			if ( $doCount && $row->page_namespace == NS_CATEGORY ) {
				$cat = Category::newFromRow( $row, $t );
			}

			// Get image of this category
            $image = $images->getImage($t);

			$s = $this->renderNodeInfo( $t, $cat, $depth - 1, $image);
			$s .= "\n\t\t";

			if ( $row->page_namespace == NS_CATEGORY ) {
				$categories .= $s;
			} else {
				$other .= $s;
			}
		}

		return $categories . $other;
	}

    /**
     * Returns a string with an HTML representation of the parents of the given category.
     * @param Title $title
     * @return string
     * @throws MWException
     */
	function renderParents( $title ) {
		global $wgCategoryTreeMaxChildren;

		$dbr = wfGetDB( DB_REPLICA );

		$res = $dbr->select(
			'categorylinks',
			[
				'page_namespace' => NS_CATEGORY,
				'page_title' => 'cl_to',
			],
			[ 'cl_from' => $title->getArticleID() ],
			__METHOD__,
			[
				'LIMIT' => $wgCategoryTreeMaxChildren,
				'ORDER BY' => 'cl_to'
			]
		);

		$special = SpecialPage::getTitleFor( 'CategoryTree' );

		$s = '';

		foreach ( $res as $row ) {
			$t = Title::newFromRow( $row );

			$label = htmlspecialchars( $t->getText() );

			$wikiLink = $special->getLocalURL( 'target=' . $t->getPartialURL() .
				'&' . $this->getOptionsAsUrlParameters() );

			if ( $s !== '' ) {
				$s .= wfMessage( 'pipe-separator' )->escaped();
			}

			$s .= Xml::openElement( 'span', [ 'class' => 'CategoryTreeItem' ] );
			$s .= Xml::openElement( 'a', [ 'class' => 'CategoryTreeLabel', 'href' => $wikiLink ] )
				. $label . Xml::closeElement( 'a' );
			$s .= Xml::closeElement( 'span' );

			$s .= "\n\t\t";
		}

		return $s;
	}

    /**
     * Returns a string with a HTML representation of the given page.
     * @param Title $title
     * @param int $children
     * @param $image
     * @return string
     */
	function renderNode( $title, $children = 0, $image = null) {
		global $wgCategoryTreeUseCategoryTable;

		if ( $wgCategoryTreeUseCategoryTable && $title->getNamespace() == NS_CATEGORY
			&& !$this->isInverse()
		) {
			$cat = Category::newFromTitle( $title );
		} else {
			$cat = null;
		}

		return $this->renderNodeInfo( $title, $cat, $children, $image );
	}

    /**
     * Returns a string with a HTML represenation of the given page.
     * $info must be an associative array, containing at least a Title object under the 'title' key.
     * @param Title $title
     * @param Category $cat
     * @param int $children
     * @param File $image
     * @return string
     */
	function renderNodeInfo( $title, $cat, $children = 0, File $image = null) {
		$mode = $this->getOption( 'mode' );

		$ns = $title->getNamespace();
		$key = $title->getDBkey();

		$hideprefix = $this->getOption( 'hideprefix' );

		if ( $hideprefix == CategoryTreeHidePrefix::ALWAYS ) {
			$hideprefix = true;
		} elseif ( $hideprefix == CategoryTreeHidePrefix::AUTO ) {
			$hideprefix = ( $mode == CategoryTreeMode::CATEGORIES );
		} elseif ( $hideprefix == CategoryTreeHidePrefix::CATEGORIES ) {
			$hideprefix = ( $ns == NS_CATEGORY );
		} else {
			$hideprefix = true;
		}

		// when showing only categories, omit namespace in label unless we explicitely defined the
		// configuration setting
		// patch contributed by Manuel Schneider <manuel.schneider@wikimedia.ch>, Bug 8011
		if ( $hideprefix ) {
			$label = htmlspecialchars( $title->getText() );
		} else {
			$label = htmlspecialchars( $title->getPrefixedText() );
		}

		$labelClass = 'CategoryTreeLabel ' . ' CategoryTreeLabelNs' . $ns;

		if ( !$title->getArticleID() ) {
			$labelClass .= ' new';
			$wikiLink = $title->getLocalURL( 'action=edit&redlink=1' );
		} else {
			$wikiLink = $title->getLocalURL();
		}

		if ( $ns == NS_CATEGORY ) {
			$labelClass .= ' CategoryTreeLabelCategory';
		} else {
			$labelClass .= ' CategoryTreeLabelPage';
		}

		if ( ( $ns % 2 ) > 0 ) {
			$labelClass .= ' CategoryTreeLabelTalk';
		}

		$count = false;
		$s = Xml::openElement('div', ['class' => 'col-md-3 col-sm-6 col-xs-6']);

		# NOTE: things in CategoryTree.js rely on the exact order of tags!
		#      Specifically, the CategoryTreeChildren div must be the first
		#      sibling with nodeName = DIV of the grandparent of the expland link.

        # Open the category section
		$s .= Xml::openElement( 'a', [ 'class' => 'CategoryTreeSection', 'href' => $wikiLink] );

        # Open the image div
        $s .= Xml::openElement('div', ['class' => 'CategoryTreeImage tagpattern-' . (hexdec(substr(md5(strtolower($label)), 0, 6)) % 33)]);
        if ( $ns == NS_CATEGORY && $image !== null ){
            $s .= Xml::element('img', ['src' => $image->getFullUrl()]);
        }
        $s .= Xml::closeElement('div');
        # ... and close the image div

        # Open the category item where all textual informations are located
		$s .= Xml::openElement( 'div', [ 'class' => 'CategoryTreeItem' ] );

		if ( $ns == NS_CATEGORY ) {
			if ( $cat ) {
				if ( $mode == CategoryTreeMode::CATEGORIES ) {
					$count = intval( $cat->getSubcatCount() );
				} elseif ( $mode == CategoryTreeMode::PAGES ) {
					$count = intval( $cat->getPageCount() ) - intval( $cat->getFileCount() );
				} else {
					$count = intval( $cat->getPageCount() );
				}
			}
        }

		$s .= Xml::openElement( 'h3', ['class' => $labelClass] );
		$s .= $label;
		$s .= Xml::closeElement( 'h3' );

		if ( $count !== false && $this->getOption( 'showcount' ) ) {
			$s .= self::createCountString( RequestContext::getMain(), $cat, $count );
		}

		$s .= Xml::closeElement( 'div' );
		$s .= "\n\t\t";
		$s .= Xml::openElement(
			'div',
			[
				'class' => 'CategoryTreeChildren',
				'style' => $children > 0 ? "display:block" : "display:none"
			]
		);

		if ( $ns == NS_CATEGORY && $children > 0 ) {
			$children = $this->renderChildren( $title, $children );
			if ( $children == '' ) {
				$s .= Xml::openElement( 'i', [ 'class' => 'CategoryTreeNotice' ] );
				if ( $mode == CategoryTreeMode::CATEGORIES ) {
					$s .= wfMessage( 'categorytree-no-subcategories' )->text();
				} elseif ( $mode == CategoryTreeMode::PAGES ) {
					$s .= wfMessage( 'categorytree-no-pages' )->text();
				} elseif ( $mode == CategoryTreeMode::PARENTS ) {
					$s .= wfMessage( 'categorytree-no-parent-categories' )->text();
				} else {
					$s .= wfMessage( 'categorytree-nothing-found' )->text();
				}
				$s .= Xml::closeElement( 'i' );
			} else {
				$s .= $children;
			}
		}

		$s .= Xml::closeElement( 'div' );
		$s .= Xml::closeElement( 'a' );

		$s .= Xml::closeElement( 'div' );

		$s .= "\n\t\t";

		return $s;
	}

	/**
	 * Create a string which format the page, subcat and file counts of a category
	 * @param IContextSource $context
	 * @param Category|null $cat
	 * @param int $countMode
	 * @return string
	 */
	public static function createCountString( IContextSource $context, $cat, $countMode ) {
		global $wgContLang;

		# Get counts, with conversion to integer so === works
		# Note: $allCount is the total number of cat members,
		# not the count of how many members are normal pages.
		$allCount = $cat ? intval( $cat->getPageCount() ) : 0;
		$subcatCount = $cat ? intval( $cat->getSubcatCount() ) : 0;
		$fileCount = $cat ? intval( $cat->getFileCount() ) : 0;
		$pages = $allCount - $subcatCount - $fileCount;

		$attr = [
			'title' => $context->msg( 'categorytree-member-counts' )
				->numParams( $subcatCount, $pages, $fileCount, $allCount, $countMode )->text(),
			'dir' => $context->getLanguage()->getDir() # numbers and commas get messed up in a mixed dir env
		];

		$s = $wgContLang->getDirMark() . ' ';

		# Create a list of category members with only non-zero member counts
		$memberNums = [];
		if ( $subcatCount ) {
			$memberNums[] = "<i class='fa fa-folder-o' aria-hidden='true'></i> " . $context->msg( 'categorytree-num-categories' )
				->numParams( $subcatCount )->text();
		}
		if ( $pages ) {
			$memberNums[] = "<i class='fa fa-file-text-o' aria-hidden='true'></i> " .  $context->msg( 'categorytree-num-pages' )->numParams( $pages )->text();
		}
		if ( $fileCount ) {
			$memberNums[] = $context->msg( 'categorytree-num-files' )
				->numParams( $fileCount )->text();
		}
		//$memberNumsShort = $memberNums
		//	? $context->getLanguage()->commaList( $memberNums )
		//	: $context->msg( 'categorytree-num-empty' )->text();

		$messageSpans = '';
		foreach ($memberNums as $memberNum) {
			$messageSpans .= Xml::tags(
					'span',
					['class' => 'subcontent-label'],
					$memberNum
			).' ';
		}
		if( ! $memberNums) {
			$messageSpans = Xml::tags(
					'span',
					['class' => 'empty-label'],
					$context->msg( 'categorytree-num-empty' )->text()
			);
		}

		$s .= Xml::tags(
			'span',
			$attr,
			$messageSpans
		);

		return $s;
	}

	/**
	 * Creates a Title object from a user provided (and thus unsafe) string
	 * @param string $title
	 * @return null|Title
	 */
	static function makeTitle( $title ) {
		$title = trim( $title );

		if ( strval( $title ) === '' ) {
			return null;
		}

		# The title must be in the category namespace
		# Ignore a leading Category: if there is one
		$t = Title::newFromText( $title, NS_CATEGORY );
		if ( !$t || $t->getNamespace() != NS_CATEGORY || $t->getInterwiki() != '' ) {
			// If we were given something like "Wikipedia:Foo" or "Template:",
			// try it again but forced.
			$title = "Category:$title";
			$t = Title::newFromText( $title );
		}
		return $t;
	}

	/**
	 * Internal function to cap depth
	 * @param string $mode
	 * @param int $depth
	 * @return int|mixed
	 */
	static function capDepth( $mode, $depth ) {
		global $wgCategoryTreeMaxDepth;

		if ( is_numeric( $depth ) ) {
			$depth = intval( $depth );
		} else if ($mode == CategoryTreeMode::BREADCRUMBS ) {
			$depth = isset( $wgCategoryTreeMaxDepth[$mode] ) ? $wgCategoryTreeMaxDepth[$mode] : 1;
		} else {
			return 1;
		}

		if ( is_array( $wgCategoryTreeMaxDepth ) ) {
			$max = isset( $wgCategoryTreeMaxDepth[$mode] ) ? $wgCategoryTreeMaxDepth[$mode] : 1;
		} elseif ( is_numeric( $wgCategoryTreeMaxDepth ) ) {
			$max = $wgCategoryTreeMaxDepth;
		} else {
			wfDebug( 'CategoryTree::capDepth: $wgCategoryTreeMaxDepth is invalid.' );
			$max = 1;
		}

		return min( $depth, $max );
	}
}
