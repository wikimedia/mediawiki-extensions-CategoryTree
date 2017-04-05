<?php

class CategoryTreeCategoryPage extends CategoryPage {
	protected $mCategoryViewerClass = 'CategoryTreeCategoryViewer';
}

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
	 * Add a subcategory to the internal lists
	 * @param $cat Category
	 * @param $sortkey
	 * @param $pageLength
	 */
	function addSubcategoryObject( Category $cat, $sortkey, $pageLength ) {
		$title = $cat->getTitle();

		if ( $this->getRequest()->getCheck( 'notree' ) ) {
			parent::addSubcategoryObject( $cat, $sortkey, $pageLength );
			return;
		}

		$tree = $this->getCategoryTree();

		$this->children[] = $tree->renderNodeInfo( $title, $cat );

		$this->children_start_char[] = $this->getSubcategorySortChar( $title, $sortkey );
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
	 * return true if given article is a page using tutorial forms
	 */
	private function isTutorial($article) {

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
	 * @return string
	 */
	function getPagesSection() {
		global $wgOut;

		$out = '';
		// print Tutorials parts
		if(count($this->articlesTitles) > 0) {

			$limit = 4;

			$wgOut->addModules( 'ext.wikifab.wfExplore.js');

			$WfExploreCore = new WfExploreCore();

			$params = array();
			$params['limit'] = intval($limit);
			$params['query'] = '[[Category:'.$this->title->getText().']]' ;;

			$WfExploreCore->executeSearch( $request = null , $params);

			$r = "";

			$paramsOutput = [
					'showPreviousButton' => true,
					//'noLoadMoreButton' => true,
					//'replaceClass' => 'exploreQueryResult',
					'isEmbed' => true
			];
			$r .= $WfExploreCore->getSearchResultsHtml($paramsOutput);

			$ti = wfEscapeWikiText( $this->title->getText() );

			$out = "<div id=\"mw-pages\">\n";
			$out .= '<h2>' . $this->msg( 'category_tutoriels_header', $ti )->parse() . "</h2>\n";
			$out .= $r;
			$out .= "\n</div>";
		}

		// if there is no tutorial, display default category page :
		return $out . ' ' . parent::getPagesSection();
	}

}
