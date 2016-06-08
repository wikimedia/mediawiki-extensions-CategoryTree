<?php
/**
 * Setup and Hooks for the CategoryTree extension, an AJAX based gadget
 * to display the category structure of a wiki
 *
 * @file
 * @ingroup Extensions
 * @author Daniel Kinzler, brightbyte.de
 * @copyright © 2006-2008 Daniel Kinzler and others
 * @license GNU General Public Licence 2.0 or later
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
	die( 1 );
}

/**
* Constants for use with the mode,
* defining what should be shown in the tree
*/
define( 'CT_MODE_CATEGORIES', 0 );
define( 'CT_MODE_PAGES', 10 );
define( 'CT_MODE_ALL', 20 );
define( 'CT_MODE_PARENTS', 100 );

/**
* Constants for use with the hideprefix option,
* defining when the namespace prefix should be hidden
*/
define( 'CT_HIDEPREFIX_NEVER', 0 );
define( 'CT_HIDEPREFIX_ALWAYS', 10 );
define( 'CT_HIDEPREFIX_CATEGORIES', 20 );
define( 'CT_HIDEPREFIX_AUTO', 30 );

$wgConfigRegistry['categorytree'] = 'GlobalVarConfig::newInstance';

/**
 * Options:
 *
 * $wgCategoryTreeMaxChildren - maximum number of children shown in a tree node. Default is 200
 * $wgCategoryTreeAllowTag - enable <categorytree> tag. Default is true.
 * $wgCategoryTreeDisableCache - disable the parser cache for pages with a <categorytree> tag or provide
 *	                         max cache time in seconds. Default is 6 hours.
 * $wgCategoryTreeUseCache - enable HTTP cache for anon users. Default is false.
 * $wgCategoryTreeMaxDepth - maximum value for depth argument; An array that maps mode values to
 *                           the maximum depth acceptable for the depth option.
 *                           Per default, the "categories" mode has a max depth of 2,
 *                           all other modes have a max depth of 1.
 * $wgCategoryTreeDefaultOptions - default options for the <categorytree> tag.
 * $wgCategoryTreeCategoryPageOptions - options to apply on category pages.
 * $wgCategoryTreeSpecialPageOptions - options to apply on Special:CategoryTree.
 */

$wgCategoryTreeMaxChildren = 200;
$wgCategoryTreeAllowTag = true;
$wgCategoryTreeDisableCache = 6*60*60;
$wgCategoryTreeHTTPCache = false;
# $wgCategoryTreeUnifiedView = true;
$wgCategoryTreeMaxDepth = array( CT_MODE_PAGES => 1, CT_MODE_ALL => 1, CT_MODE_CATEGORIES => 2 );

# Set $wgCategoryTreeForceHeaders to true to force the JS and CSS headers for CategoryTree to be included on every page.
# May be usefull for using CategoryTree from within system messages, in the sidebar, or a custom skin.
$wgCategoryTreeForceHeaders = false;
$wgCategoryTreeSidebarRoot = null;
$wgCategoryTreeHijackPageCategories = false; # EXPERIMENTAL! NOT YET FOR PRODUCTION USE! Main problem is general HTML/CSS layout cruftiness.
$wgCategoryTreeUseCategoryTable = true;

$wgCategoryTreeOmitNamespace = CT_HIDEPREFIX_CATEGORIES;
$wgCategoryTreeDefaultMode = CT_MODE_CATEGORIES;
$wgCategoryTreeDefaultOptions = array(); # Default values for most options. ADD NEW OPTIONS HERE!
$wgCategoryTreeDefaultOptions['mode'] = null; # will be set to $wgCategoryTreeDefaultMode in CategoryTreeHooks::initialize compatibility quirk
$wgCategoryTreeDefaultOptions['hideprefix'] = null; # will be set to $wgCategoryTreeDefaultMode in CategoryTreeHooks::initialize compatibility quirk
$wgCategoryTreeDefaultOptions['showcount'] = false;
$wgCategoryTreeDefaultOptions['namespaces'] = false; # false means "no filter"

$wgCategoryTreeCategoryPageMode = CT_MODE_CATEGORIES;
$wgCategoryTreeCategoryPageOptions = array(); # Options to be used for category pages
$wgCategoryTreeCategoryPageOptions['mode'] = NULL; # will be set to $wgCategoryTreeDefaultMode in CategoryTreeHooks::initialize compatibility quirk
$wgCategoryTreeCategoryPageOptions['showcount'] = true;

$wgCategoryTreeSpecialPageOptions = array(); # Options to be used for Special:CategoryTree
$wgCategoryTreeSpecialPageOptions['showcount'] = true;

$wgCategoryTreeSidebarOptions = array(); # Options to be used in the sidebar (for use with $wgCategoryTreeSidebarRoot)
$wgCategoryTreeSidebarOptions['mode'] = CT_MODE_CATEGORIES;
$wgCategoryTreeSidebarOptions['hideprefix'] = CT_HIDEPREFIX_CATEGORIES;
$wgCategoryTreeSidebarOptions['showcount'] = false;
$wgCategoryTreeSidebarOptions['hideroot'] = true;
$wgCategoryTreeSidebarOptions['namespaces'] = false;
$wgCategoryTreeSidebarOptions['depth'] = 1;

$wgCategoryTreePageCategoryOptions = array(); # Options to be used in the sidebar (for use with $wgCategoryTreePageCategories)
$wgCategoryTreePageCategoryOptions['mode'] = CT_MODE_PARENTS;
$wgCategoryTreePageCategoryOptions['hideprefix'] = CT_HIDEPREFIX_CATEGORIES;
$wgCategoryTreePageCategoryOptions['showcount'] = false;
$wgCategoryTreePageCategoryOptions['hideroot'] = false;
$wgCategoryTreePageCategoryOptions['namespaces'] = false;
$wgCategoryTreePageCategoryOptions['depth'] = 0;
# $wgCategoryTreePageCategoryOptions['class'] = 'CategoryTreeInlineNode';

$wgExtensionMessagesFiles['CategoryTreeAlias'] = __DIR__ . '/CategoryTree.alias.php';

/**
 * Register extension setup hook and credits
 */
$wgExtensionFunctions[] = 'CategoryTreeHooks::initialize';
$wgExtensionCredits['specialpage'][] = $wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'CategoryTree',
	'author' => 'Daniel Kinzler',
	'url' => 'https://www.mediawiki.org/wiki/Extension:CategoryTree',
	'descriptionmsg' => 'categorytree-desc',
	'license-name' => 'GPL-2.0+',
);

/**
 * Register the special page
 */
$wgMessagesDirs['CategoryTree'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['CategoryTree'] = __DIR__ . '/CategoryTree.i18n.php';
$wgExtensionMessagesFiles['CategoryTreeMagic'] = __DIR__ . '/CategoryTree.i18n.magic.php';
$wgAutoloadClasses['CategoryTreePage'] = __DIR__ . '/CategoryTreePage.php';
$wgAutoloadClasses['CategoryTree'] = __DIR__ . '/CategoryTreeFunctions.php';
$wgAutoloadClasses['CategoryTreeCategoryPage'] = __DIR__ . '/CategoryPageSubclass.php';
$wgAutoloadClasses['CategoryTreeCategoryViewer'] = __DIR__ . '/CategoryPageSubclass.php';
$wgAutoloadClasses['CategoryTreeHooks'] = __DIR__ . '/CategoryTree.hooks.php';
$wgAutoloadClasses['ApiCategoryTree'] = __DIR__ . '/ApiCategoryTree.php';
$wgSpecialPages['CategoryTree'] = 'CategoryTreePage';
# $wgHooks['SkinTemplateTabs'][] = 'efCategoryTreeInstallTabs';
$wgHooks['ArticleFromTitle'][] = 'CategoryTreeHooks::articleFromTitle';

$wgAPIModules['categorytree'] = 'ApiCategoryTree';

/**
 * Register ResourceLoader modules
 */
$commonModuleInfo = array(
	'localBasePath' => __DIR__ . '/modules',
	'remoteExtPath' => 'CategoryTree/modules',
);

$wgResourceModules['ext.categoryTree'] = array(
	'scripts' => 'ext.categoryTree.js',
	'messages' => array(
		'categorytree-collapse',
		'categorytree-expand',
		'categorytree-collapse-bullet',
		'categorytree-expand-bullet',
		'categorytree-load',
		'categorytree-loading',
		'categorytree-nothing-found',
		'categorytree-no-subcategories',
		'categorytree-no-parent-categories',
		'categorytree-no-pages',
		'categorytree-error',
		'categorytree-retry',
	),
) + $commonModuleInfo;

$wgResourceModules['ext.categoryTree.css'] = array(
	'position' => 'top',
	'styles' => 'ext.categoryTree.css',
) + $commonModuleInfo;
