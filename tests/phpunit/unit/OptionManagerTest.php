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

namespace MediaWiki\Extension\CategoryTree\Tests\Unit;

use MediaWiki\Config\HashConfig;
use MediaWiki\Extension\CategoryTree\CategoryTreeHidePrefix;
use MediaWiki\Extension\CategoryTree\CategoryTreeMode;
use MediaWiki\Extension\CategoryTree\OptionManager;
use MediaWikiUnitTestCase;

/**
 * @covers \MediaWiki\Extension\CategoryTree\OptionManager
 */
class OptionManagerTest extends MediaWikiUnitTestCase {

	private function newOptionManager( array $options, array $config = [] ): OptionManager {
		return new OptionManager( $options, new HashConfig( $config + [
			'CategoryTreeDefaultOptions' => [
				'mode' => 'categories',
				'hideprefix' => 'categories',
				'showcount' => false,
				'namespaces' => false,
				'notranslations' => false,
			],
			'CategoryTreeMaxDepth' => [
				'pages' => 1,
				'all' => 1,
				'categories' => 2,
			],
		] ) );
	}

	public static function provideModes(): array {
		return [
			'string categories' => [ 'categories', CategoryTreeMode::CATEGORIES ],
			'string pages' => [ 'pages', CategoryTreeMode::PAGES ],
			'string all' => [ 'all', CategoryTreeMode::ALL ],
			'string parents' => [ 'parents', CategoryTreeMode::PARENTS ],
			'alias sub' => [ 'sub', CategoryTreeMode::CATEGORIES ],
			'alias super' => [ 'super', CategoryTreeMode::PARENTS ],
			'alias inverse' => [ 'inverse', CategoryTreeMode::PARENTS ],
			'untrimmed uppercase' => [ ' All ', CategoryTreeMode::ALL ],
			'null uses default' => [ null, CategoryTreeMode::CATEGORIES ],
			'string default' => [ 'default', CategoryTreeMode::CATEGORIES ],
			'unknown string' => [ 'bogus', CategoryTreeMode::CATEGORIES ],
		];
	}

	/**
	 * @dataProvider provideModes
	 */
	public function testDecodeMode( $mode, string $expected ) {
		$optionManager = $this->newOptionManager( [ 'mode' => $mode ] );
		$this->assertSame( $expected, $optionManager->getOption( 'mode' ) );
	}

	public static function provideLegacyModes(): array {
		return [
			'legacy categories' => [ 0, CategoryTreeMode::CATEGORIES ],
			'legacy pages' => [ 10, CategoryTreeMode::PAGES ],
			'legacy all' => [ 20, CategoryTreeMode::ALL ],
			'legacy parents' => [ 100, CategoryTreeMode::PARENTS ],
			'legacy numeric string' => [ '100', CategoryTreeMode::PARENTS ],
			'unknown number' => [ 55, CategoryTreeMode::CATEGORIES ],
		];
	}

	/**
	 * @dataProvider provideLegacyModes
	 */
	public function testDecodeLegacyMode( $mode, string $expected ) {
		$optionManager = $this->newOptionManager( [ 'mode' => $mode ] );
		$this->assertSame( $expected, $optionManager->getOption( 'mode' ) );
	}

	public function testDecodeModeLegacyDefault() {
		$optionManager = $this->newOptionManager( [], [
			'CategoryTreeDefaultOptions' => [
				'mode' => 10,
				'hideprefix' => 20,
				'showcount' => false,
				'namespaces' => false,
				'notranslations' => false,
			],
		] );
		$this->assertSame( CategoryTreeMode::PAGES, $optionManager->getOption( 'mode' ) );
		$this->assertSame( CategoryTreeHidePrefix::CATEGORIES, $optionManager->getOption( 'hideprefix' ) );
	}

	public static function provideHidePrefixValues(): array {
		return [
			'string never' => [ 'never', CategoryTreeHidePrefix::NEVER ],
			'string always' => [ 'always', CategoryTreeHidePrefix::ALWAYS ],
			'string auto' => [ 'auto', CategoryTreeHidePrefix::AUTO ],
			'string categories' => [ 'categories', CategoryTreeHidePrefix::CATEGORIES ],
			'alias smart' => [ 'smart', CategoryTreeHidePrefix::CATEGORIES ],
			'boolean true' => [ true, CategoryTreeHidePrefix::ALWAYS ],
			'boolean false' => [ false, CategoryTreeHidePrefix::NEVER ],
			'string on' => [ 'on', CategoryTreeHidePrefix::ALWAYS ],
			'string no' => [ 'no', CategoryTreeHidePrefix::NEVER ],
			'null uses default' => [ null, CategoryTreeHidePrefix::CATEGORIES ],
			'unknown string uses default' => [ 'bogus', CategoryTreeHidePrefix::CATEGORIES ],
		];
	}

	/**
	 * @dataProvider provideHidePrefixValues
	 */
	public function testDecodeHidePrefix( $value, string $expected ) {
		$optionManager = $this->newOptionManager( [ 'hideprefix' => $value ] );
		$this->assertSame( $expected, $optionManager->getOption( 'hideprefix' ) );
	}

	public static function provideLegacyHidePrefixValues(): array {
		return [
			'legacy never' => [ 0, CategoryTreeHidePrefix::NEVER ],
			'legacy always' => [ 10, CategoryTreeHidePrefix::ALWAYS ],
			'legacy categories' => [ 20, CategoryTreeHidePrefix::CATEGORIES ],
			'legacy auto' => [ 30, CategoryTreeHidePrefix::AUTO ],
			'legacy numeric string' => [ '30', CategoryTreeHidePrefix::AUTO ],
			'unknown number' => [ 55, CategoryTreeHidePrefix::NEVER ],
		];
	}

	/**
	 * @dataProvider provideLegacyHidePrefixValues
	 */
	public function testDecodeLegacyHidePrefix( $value, string $expected ) {
		$optionManager = $this->newOptionManager( [ 'hideprefix' => $value ] );
		$this->assertSame( $expected, $optionManager->getOption( 'hideprefix' ) );
	}

	public function testCapDepth() {
		$optionManager = $this->newOptionManager( [ 'mode' => 'categories' ] );
		$this->assertSame( 2, $optionManager->capDepth( 5 ) );
		$this->assertSame( 1, $optionManager->capDepth( 1 ) );
	}

	public function testCapDepthLegacyKeys() {
		// Site config keyed by the legacy numeric mode values takes precedence
		// over the extension defaults merged into it
		$optionManager = $this->newOptionManager( [ 'mode' => 'pages' ], [
			'CategoryTreeMaxDepth' => [
				'pages' => 1,
				'all' => 1,
				'categories' => 2,
				10 => 4,
			],
		] );
		$this->assertSame( 4, $optionManager->capDepth( 9 ) );
	}

	public function testCapDepthScalar() {
		$optionManager = $this->newOptionManager( [ 'mode' => 'all' ], [
			'CategoryTreeMaxDepth' => 3,
		] );
		$this->assertSame( 3, $optionManager->capDepth( 5 ) );
	}
}
