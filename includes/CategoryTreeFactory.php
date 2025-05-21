<?php
/**
 * @file
 */

namespace MediaWiki\Extension\CategoryTree;

use MediaWiki\Cache\LinkBatchFactory;
use MediaWiki\Config\Config;
use MediaWiki\Language\Language;
use MediaWiki\Linker\LinkRenderer;
use Wikimedia\Rdbms\IConnectionProvider;

class CategoryTreeFactory {
	private Config $config;
	private Language $contLang;
	private IConnectionProvider $dbProvider;
	private LinkBatchFactory $linkBatchFactory;
	private LinkRenderer $linkRenderer;

	public function __construct(
		Config $config,
		Language $contLang,
		IConnectionProvider $dbProvider,
		LinkBatchFactory $linkBatchFactory,
		LinkRenderer $linkRenderer
	) {
		$this->config = $config;
		$this->contLang = $contLang;
		$this->dbProvider = $dbProvider;
		$this->linkBatchFactory = $linkBatchFactory;
		$this->linkRenderer = $linkRenderer;
	}

	public function newCategoryTree(
		array $options
	): CategoryTree {
		return new CategoryTree(
			$options,
			$this->config,
			$this->contLang,
			$this->dbProvider,
			$this->linkBatchFactory,
			$this->linkRenderer
		);
	}
}
