<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

namespace MediaWiki\Extension\CategoryTree;

use MediaWiki\Category\Category;
use MediaWiki\Linker\LinkTarget;
use Wikimedia\Rdbms\IConnectionProvider;
use Wikimedia\Rdbms\IResultWrapper;

/**
 * Caches Category::class objects
 */
class CategoryCache {
	/** @var (?Category)[] Keys are category database names, values are either a Category object or null */
	private array $cache = [];

	public function __construct(
		private readonly IConnectionProvider $dbProvider,
	) {
	}

	/**
	 * Get a preloaded Category object or null when the Category does not exists. Loaded the Category on demand,
	 * if not in cache, use self::doQuery when requesting a high number of category
	 */
	public function getCategory( LinkTarget $categoryTarget ): ?Category {
		if ( $categoryTarget->getNamespace() !== NS_CATEGORY ) {
			return null;
		}
		$categoryDbKey = $categoryTarget->getDBkey();

		if ( !array_key_exists( $categoryDbKey, $this->cache ) ) {
			$this->doQuery( [ $categoryTarget ] );
		}

		return $this->cache[$categoryDbKey];
	}

	/**
	 * Preloads category counts in this cache
	 * @param LinkTarget[] $linkTargets
	 */
	public function doQuery( array $linkTargets ): void {
		$categoryDbKeys = [];
		foreach ( $linkTargets as $linkTarget ) {
			if ( $linkTarget->getNamespace() !== NS_CATEGORY ) {
				continue;
			}
			$categoryDbKey = $linkTarget->getDBkey();
			if ( !array_key_exists( $categoryDbKey, $this->cache ) ) {
				$categoryDbKeys[] = $categoryDbKey;
				// To cache db misses, also avoid duplicates in the db query
				$this->cache[$categoryDbKey] = null;
			}
		}
		if ( $categoryDbKeys === [] ) {
			return;
		}

		$rows = $this->dbProvider->getReplicaDatabase()
			->newSelectQueryBuilder()
			->select( [ 'cat_id', 'cat_title', 'cat_pages', 'cat_subcats', 'cat_files' ] )
			->from( 'category' )
			->where( [ 'cat_title' => $categoryDbKeys ] )
			->caller( __METHOD__ )
			->fetchResultSet();

		$this->fillFromQuery( $rows );
	}

	public function fillFromQuery( IResultWrapper $rows ): void {
		foreach ( $rows as $row ) {
			$this->cache[$row->cat_title] = Category::newFromRow( $row );
		}
	}

}
