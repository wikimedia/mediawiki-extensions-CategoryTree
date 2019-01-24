<?php

use MediaWiki\MediaWikiServices;

class CategoryTreeCategoryViewer extends CategoryViewer {
	public $child_cats;

	/**
	 * @var CategoryTree
	 */
	public $categorytree;

	/**
	 * @return CategoryTree
	 */
	function getCategoryTree() {
		global $wgCategoryTreeCategoryPageOptions, $wgCategoryTreeForceHeaders;

		if ( !isset( $this->categorytree ) ) {
			if ( !$wgCategoryTreeForceHeaders ) {
				CategoryTree::setHeaders( $this->getOutput() );
			}

			$this->categorytree = new CategoryTree( $wgCategoryTreeCategoryPageOptions );
		}

		return $this->categorytree;
	}

    /**
     * @throws Exception
     * @throws FatalError
     * @throws MWException
     */
    function doCategoryQuery() {
        $dbr = wfGetDB( DB_REPLICA, 'category' );

        $this->nextPage = [
            'page' => null,
            'subcat' => null,
            'file' => null,
        ];
        $this->prevPage = [
            'page' => null,
            'subcat' => null,
            'file' => null,
        ];

        $this->flip = [ 'page' => false, 'subcat' => false, 'file' => false ];

        foreach ( [ 'page', 'subcat', 'file' ] as $type ) {
            # Get the sortkeys for start/end, if applicable.  Note that if
            # the collation in the database differs from the one
            # set in $wgCategoryCollation, pagination might go totally haywire.
            $extraConds = [ 'cl_type' => $type ];
            if ( isset( $this->from[$type] ) && $this->from[$type] !== null ) {
                $extraConds[] = 'cl_sortkey >= '
                    . $dbr->addQuotes( $this->collation->getSortKey( $this->from[$type] ) );
            } elseif ( isset( $this->until[$type] ) && $this->until[$type] !== null ) {
                $extraConds[] = 'cl_sortkey < '
                    . $dbr->addQuotes( $this->collation->getSortKey( $this->until[$type] ) );
                $this->flip[$type] = true;
            }

            $res = $dbr->select(
                [ 'page', 'categorylinks', 'category' ],
                array_merge(
                    LinkCache::getSelectFields(),
                    [
                        'page_namespace',
                        'page_title',
                        'cl_sortkey',
                        'cat_id',
                        'cat_title',
                        'cat_subcats',
                        'cat_pages',
                        'cat_files',
                        'cl_sortkey_prefix',
                        'cl_collation'
                    ]
                ),
                array_merge( [ 'cl_to' => $this->title->getDBkey() ], $extraConds ),
                __METHOD__,
                [
                    'USE INDEX' => [ 'categorylinks' => 'cl_sortkey' ],
                    'LIMIT' => $this->limit + 1,
                    'ORDER BY' => $this->flip[$type] ? 'cl_sortkey DESC' : 'cl_sortkey',
                ],
                [
                    'categorylinks' => [ 'INNER JOIN', 'cl_from = page_id' ],
                    'category' => [ 'LEFT JOIN', [
                        'cat_title = page_title',
                        'page_namespace' => NS_CATEGORY
                    ] ]
                ]
            );

            Hooks::run( 'CategoryViewer::doCategoryQuery', [ $type, $res ] );
            $linkCache = MediaWikiServices::getInstance()->getLinkCache();

            // Get subcategories image
            $images = CategoryTreeImageList::fromCategory($this->title);

            $count = 0;
            foreach ( $res as $row ) {
                $title = Title::newFromRow( $row );
                $linkCache->addGoodLinkObjFromRow( $title, $row );

                if ( $row->cl_collation === '' ) {
                    // Hack to make sure that while updating from 1.16 schema
                    // and db is inconsistent, that the sky doesn't fall.
                    // See r83544. Could perhaps be removed in a couple decades...
                    $humanSortkey = $row->cl_sortkey;
                } else {
                    $humanSortkey = $title->getCategorySortkey( $row->cl_sortkey_prefix );
                }

                if ( ++$count > $this->limit ) {
                    # We've reached the one extra which shows that there
                    # are additional pages to be had. Stop here...
                    $this->nextPage[$type] = $humanSortkey;
                    break;
                }
                if ( $count == $this->limit ) {
                    $this->prevPage[$type] = $humanSortkey;
                }

                if ( $title->getNamespace() == NS_CATEGORY ) {
                    $cat = Category::newFromRow( $row, $title );
                    // Get image category
                    $image = $images->getImage($title);
                    // Add category
                    $this->addSubcategoryObject( $cat, $humanSortkey, $row->page_len, $image );
                } elseif ( $title->getNamespace() == NS_FILE ) {
                    $this->addImage( $title, $humanSortkey, $row->page_len, $row->page_is_redirect );
                } else {
                    $this->addPage( $title, $humanSortkey, $row->page_len, $row->page_is_redirect );
                }
            }
        }
    }

    /**
     * Add a subcategory to the internal lists
     * @param Category $cat
     * @param string $sortkey
     * @param int $pageLength
     * @param null $image
     */
	function addSubcategoryObject( Category $cat, $sortkey, $pageLength, $image = null ) {
		$title = $cat->getTitle();

		if ( $this->getRequest()->getCheck( 'notree' ) ) {
			parent::addSubcategoryObject( $cat, $sortkey, $pageLength );
			return;
		}

		$tree = $this->getCategoryTree();

		$this->children[] = $tree->renderNodeInfo( $title, $cat, 0, $image);

		// $this->children_start_char[] = $this->getSubcategorySortChar( $title, $sortkey );
	}

	/**
	 * Format the category data list.
	 *
	 * @return string HTML output
	 */
	public function getHTML() {

		$this->showGallery = $this->getConfig()->get( 'CategoryMagicGallery' )
			&& !$this->getOutput()->mNoGallery;

		$this->clearCategoryState();
		$this->doCategoryQuery();
		$this->finaliseCategoryState();

		$r = '';

		$r = $this->getSubcategorySection() .
			$this->getManualsSection() .
			$this->getPagesSection() .
			$this->getLatestDiscussionsSection() .
			parent::getPagesSection() .
			$this->getImageSection()
		;

		if ( $r == '' ) {
			// If there is no category content to display, only
			// show the top part of the navigation links.
			// @todo FIXME: Cannot be completely suppressed because it
			//        is unknown if 'until' or 'from' makes this
			//        give 0 results.
			$r = $r . $this->getCategoryTop();
		} else {
			$r = $this->getCategoryTop() .
				$r .
				$this->getCategoryBottom();
		}

		// Give a proper message if category is empty
		if ( $r == '' ) {
			$r = $this->msg( 'category-empty' )->parseAsBlock();
		}

		$lang = $this->getLanguage();
		$attribs = [
			'class' => 'mw-category-generated',
			'lang' => $lang->getHtmlCode(),
			'dir' => $lang->getDir()
		];
		# put a div around the headings which are in the user language
		$r = Html::openElement( 'div', $attribs ) . $r . '</div>';

		return $r;
	}

	function clearCategoryState() {
		$this->articlesTitles = [];
		$this->child_cats = [];
		parent::clearCategoryState();
	}

	function finaliseCategoryState() {
		if ( $this->flip ) {
			$this->child_cats = array_reverse( $this->child_cats );
		}
		parent::finaliseCategoryState();
	}


	/**
	 * Add a miscellaneous page
	 * @param Title $title
	 * @param string $sortkey
	 * @param int $pageLength
	 * @param bool $isRedirect
	 */
	function addPage( $title, $sortkey, $pageLength, $isRedirect = false ) {

		// we split article in Two parts : those wo are using forms, and those who don't

		if( $title->getNamespace() == NS_MAIN) {
			// TODO : find other way to realy filter matching pages
			$this->articlesTitles [] = $title;
		} else {
			parent::addPage( $title, $sortkey, $pageLength, $isRedirect );
		}
	}


	/**
	 * add breadcrumb on top of categories pages
	 *
	 * {@inheritDoc}
	 * @see CategoryViewer::getSubcategorySection()
	 */
	function getSubcategorySection() {
		$out = '';
        $hideBreadcrumb = $this->getCategoryTree()->getOption('hidebreadcrumb');

        if(!$hideBreadcrumb){
            $categoryTree = new CategoryTree([]);
            $out .= $categoryTree->getHtmlBreadcrumb($this->title);
        }

		CategoryTree::setHeaders($this->getOutput());

		$out .= parent::getSubcategorySection();
		return $out;
	}


	/**
	 * @return string
	 */
	function getPagesSection() {
		global $wgOut;

		$out = '';
		// print Tutorials parts
		if(count($this->articlesTitles) > 0) {

			$limit = 8;

			$wgOut->addModules( 'ext.wikifab.wfExplore.js');
			$WfExploreCore = new WfExploreCore();

			$params = array();
			$WfExploreCore->setPageResultsLimit($limit);
			$params['query'] = '[[Category:'.$this->title->getText().']]' ;

			if(isset($_GET['page'])) {
				$params['page'] = $_GET['page'];
			}

			$WfExploreCore->executeSearch( $request = null , $params);

			$r = "";

			$out = '';
			//$out .= $WfExploreCore->getHtmlForm();

			$paramsOutput = [
					'showPreviousButton' => true,
					//'noLoadMoreButton' => true,
					//'replaceClass' => 'exploreQueryResult',
					'isEmbed' => true
			];
			$r .= $WfExploreCore->getSearchResultsHtml($paramsOutput);

			$ti = wfEscapeWikiText( $this->title->getText() );

			$out .= "<div id=\"mw-dokit-pages\">\n";
			$out .= '<h2>' . $this->msg( 'category_tutoriels_header' )->parse() . "</h2>\n";
			$out .= $r;
			$out .= "\n</div>";
		}

		// if there is no tutorial, display default category page :
		return $out;
	}

	/**
	 *
	 */
	function getManualsSection(){
		global $IP;
		global $wgExploreResultsLayouts ;


		// Stop if GroupsPage extension doesn't exists, do not generate Manuals list
		if(!file_exists("$IP/extensions/GroupsPage/GroupsPage.php")){
			return '';
		}

		$limit = 6;

		$WfExploreCore = new \WfExploreCore();

		$WfExploreCore->setNamespace(array('Manual'));
		$WfExploreCore->setPageResultsLimit($limit);
		$WfExploreCore->setFilters(array());

		$formatter = new \WikifabExploreResultFormatter();

		$layout = __DIR__ . '/../../GroupsPage/layout/layout-group-search-result.html';
		if(isset($wgExploreResultsLayouts['group'])) {
			$layout = $wgExploreResultsLayouts['group'];
		}
		// $wgExploreResultsLayouts = ['group' => __DIR__ . '/extensions/WfextStyle/templates/layout-group-search-result.html'];
		$formatter->setTemplate($layout);

		$WfExploreCore->setFormatter($formatter);

		$params = [
			'query' => '[[Category:'.$this->title->getText().']]',
			'nolang' => true
		];

		if(isset($_GET['page'])) {
			$params['page'] = $_GET['page'];
		}

		$WfExploreCore->executeSearch( $request = null , $params);

		if ($WfExploreCore->getNbResults() > 0) {

			$paramsOutput = [
				'showPreviousButton' => false,
				'isEmbed' => true,
				'loadMoreLabel' => $this->msg( 'categorytree-loadmoremanuals-label' )->parse(),
				'noAutoLoadOnScroll' => true
			];

			$ti = wfEscapeWikiText( $this->title->getText() );

			$out = "<div id=\"mw-manuals\">\n";
			$out .= '<h2>' . $this->msg( 'category-manuals-header' )->parse() . '</h2>';
			$out .= $WfExploreCore->getSearchResultsHtml($paramsOutput);
			$out .= "\n</div>";

			return $out;
		}

	}

	/**
	 *
	 */
	function getLatestDiscussionsSection(){
		global $IP;

		// Stop if LatestDiscussions extension doesn't exists, do not generate list
		if(!file_exists("$IP/extensions/LatestDiscussions/extension.json")){
			return '';
		}

		// Get category title
		$ti = wfEscapeWikiText( $this->title->getText() );

		// Get Special::NewDiscussion title instance to generate link
		$newDiscussionTitle = Title::makeTitleSafe(NS_SPECIAL, "NewDiscussion");

		$ld = new LatestDiscussions();

		$out = "<div id=\"mw-latest-discussions\">\n";
		$out .= '<h2>';
		$out .= $this->msg( 'category-latestdiscussions-header' )->parse();
		$out .= '<a class="btn btn-default pull-right" href="'.$newDiscussionTitle->getLinkURL(['page_title' => $ti]).'">'.wfMessage('category-latestdiscussions-btn-askquestion').'</a>';
		$out .= '</h2>';
		$out .= $ld->renderDiscussionsFromCategory($this->getTitle(), 10, 0);
		$out .= "\n</div>";

		return $out;
	}

    /**
     * @param array $articles
     * @param array $articles_start_char
     * @param int $cutoff
     * @return string
     */
    function formatList($articles, $articles_start_char, $cutoff = 6)
    {
        $list = '';
        if ( count( $articles_start_char ) === 0){
            $list = self::tileList( $articles );
        } elseif ( count( $articles ) > $cutoff ) {
            $list = self::columnList( $articles, $articles_start_char );
        } elseif ( count( $articles ) > 0 ) {
            // for short lists of articles in categories.
            $list = self::shortList( $articles, $articles_start_char );
        }

        $pageLang = $this->title->getPageLanguage();
        $attribs = [ 'lang' => $pageLang->getHtmlCode(), 'dir' => $pageLang->getDir(),
            'class' => 'mw-content-' . $pageLang->getDir() ];
        $list = Html::rawElement( 'div', $attribs, $list );

        return $list;
    }

    /**
     * @param $articles
     * @return string
     */
    function tileList($articles) {
        # All articles are in a Bootstrap row div
        $list = '<div class="row">'.implode('', $articles).'</div>';

        $pageLang = $this->title->getPageLanguage();
        $attribs = [ 'lang' => $pageLang->getHtmlCode(), 'dir' => $pageLang->getDir(),
            'class' => 'mw-content-' . $pageLang->getDir() ];
        $list = Html::rawElement( 'div', $attribs, $list );

        return $list;
    }

}
