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

use MediaWiki\MediaWikiServices;

// PHP unit does not understand code coverage for this file
// as the @covers annotation cannot cover a specific file
// This is fully tested in CategoryTreeServiceWiringTest.php
// @codeCoverageIgnoreStart

/**
 * CategoryTree wiring for MediaWiki services.
 */
/** @phpcs-require-sorted-array */
return [
	'CategoryTree.CategoryCache' => static function ( MediaWikiServices $services ): CategoryCache {
		return new CategoryCache(
			$services->getConnectionProvider()
		);
	},
	'CategoryTree.CategoryTreeFactory' => static function ( MediaWikiServices $services ): CategoryTreeFactory {
		return new CategoryTreeFactory(
			$services->getMainConfig(),
			$services->getContentLanguage(),
			$services->getConnectionProvider(),
			$services->getLinkBatchFactory(),
			$services->getLinkRenderer()
		);
	},
];
// @codeCoverageIgnoreEnd
