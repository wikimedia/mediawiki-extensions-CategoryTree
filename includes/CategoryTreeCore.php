<?php
/**
 * Real Core functions for the CategoryTree extension,
 * functions to get tree objects, but not the rendering part (no Html data here, only php array and objects)
 *
 * @file
 * @ingroup Extensions
 * @author Pierre Boutet
 * @license GNU General Public Licence 2.0 or later
 */

class CategoryTreeCore {


	private $params = [];

	public function __construct($params) {

		$default = [
				'inverse' => true,
				'mode' => CategoryTreeMode::BREADCRUMBS,
				'namespaces' => false
		];

		$this->params = array_merge($default,$params);
	}


	/**
	 * return an array with node info an its childs nodes infos
	 *
	 * @param Title $title
	 * @param int $depth
	 * @return array
	 */
	public function getNodeData( $title, $depth) {
		global $wgCategoryTreeMaxChildren, $wgCategoryTreeUseCategoryTable;

		$result = [
				'title' => $title,
				'categories' => [],
				'others' => []
		];

		if ( $title->getNamespace() != NS_CATEGORY ) {
			// Non-categories can't have children. :)
			return $result;
		}

		$dbr = wfGetDB( DB_SLAVE );

		$inverse = $this->params['inverse'];
		$mode =  $this->params['mode'];
		$namespaces =$this->params['namespaces'];

		$tables = [ 'page', 'categorylinks' ];
		$fields = [ 'page_id', 'page_namespace', 'page_title',
				'page_is_redirect', 'page_len', 'page_latest', 'cl_to',
				'cl_from' ];
		$where = [];
		$joins = [];
		$options = [ 'ORDER BY' => 'cl_type, cl_sortkey', 'LIMIT' => $wgCategoryTreeMaxChildren ];

		if ( $inverse ) {
			$joins['categorylinks'] = [ 'RIGHT JOIN', [ 'cl_to = page_title', 'page_namespace' => NS_CATEGORY ] ];
			$where['cl_from'] = $title->getArticleID();
		} else {
			$joins['categorylinks'] = [ 'JOIN', 'cl_from = page_id' ];
			$where['cl_to'] = $title->getDBkey();
			$options['USE INDEX']['categorylinks'] = 'cl_sortkey';

			# namespace filter.
			if ( $namespaces ) {
				# NOTE: we assume that the $namespaces array contains only integers! decodeNamepsaces makes it so.
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
			$fields = array_merge( $fields, [ 'cat_id', 'cat_title', 'cat_subcats', 'cat_pages', 'cat_files' ] );
			$joins['category'] = [ 'LEFT JOIN', [ 'cat_title = page_title', 'page_namespace' => NS_CATEGORY ] ];
		}

		$res = $dbr->select( $tables, $fields, $where, __METHOD__, $options, $joins );

		# collect categories separately from other pages
		$categories = [];
		$other = [];

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

			$s = $this->getNodeData( $t, $depth - 1 );

			if ( $row->page_namespace == NS_CATEGORY ) {
				$categories[] = $s;
			} else {
				$other[] = $s;
			}
		}

		$result['categories'] = $categories;
		$result['others'] = $other;

		return $result;
	}

}
