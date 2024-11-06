<?php
/**
 * @file
 */

namespace MediaWiki\Extension\CategoryTree;

use MediaWiki\Config\Config;
use MediaWiki\Linker\LinkRenderer;
use Wikimedia\Rdbms\IConnectionProvider;

class CategoryTreeFactory {
	private Config $config;
	private IConnectionProvider $dbProvider;
	private LinkRenderer $linkRenderer;

	public function __construct(
		Config $config,
		IConnectionProvider $dbProvider,
		LinkRenderer $linkRenderer
	) {
		$this->config = $config;
		$this->dbProvider = $dbProvider;
		$this->linkRenderer = $linkRenderer;
	}

	public function newCategoryTree(
		array $options
	): CategoryTree {
		return new CategoryTree(
			$options,
			$this->config,
			$this->dbProvider,
			$this->linkRenderer
		);
	}
}
