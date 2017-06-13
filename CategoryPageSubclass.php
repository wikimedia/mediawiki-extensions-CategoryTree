<?php

class CategoryTreeCategoryPage extends CategoryPage {
	public $mCategoryViewerClass = 'CategoryTreeCategoryViewer';
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
		$this->child_cats = [];
		parent::clearCategoryState();
	}

	function finaliseCategoryState() {
		if ( $this->flip ) {
			$this->child_cats = array_reverse( $this->child_cats );
		}
		parent::finaliseCategoryState();
	}
}
