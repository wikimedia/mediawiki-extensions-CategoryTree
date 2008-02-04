<?php
/**
 * Special page for the  CategoryTree extension, an AJAX based gadget
 * to display the category structure of a wiki
 *
 * @addtogroup Extensions
 * @author Daniel Kinzler, brightbyte.de
 * @copyright © 2006 Daniel Kinzler
 * @licence GNU General Public Licence 2.0 or later
 */

if( !defined( 'MEDIAWIKI' ) ) {
	echo( "This file is part of an extension to the MediaWiki software and cannot be used standalone.\n" );
	die( 1 );
}

class CategoryTreePage extends SpecialPage {

	var $target = '';
	var $mode = CT_MODE_CATEGORIES;

	/**
	 * Constructor
	 */
	function __construct() {
		global $wgOut;
		SpecialPage::SpecialPage( 'CategoryTree', '', true );
		wfLoadExtensionMessages( 'CategoryTree' );
	}

	/**
	 * Main execution function
	 * @param $par Parameters passed to the page
	 */
	function execute( $par ) {
		global $wgRequest, $wgOut, $wgMakeBotPrivileged, $wgUser;

		$this->setHeaders();

		if ( $par ) $this->target = $par;
		else $this->target = $wgRequest->getVal( 'target', wfMsg( 'rootcategory') );

		$this->target = trim( $this->target );

		#HACK for undefined root category
		if ( $this->target == '<rootcategory>' || $this->target == '&lt;rootcategory&gt;' ) $this->target = NULL;

		$this->mode = $wgRequest->getVal( 'mode', CT_MODE_CATEGORIES );

		if ( $this->mode == 'all' ) $this->mode = CT_MODE_ALL;
		else if ( $this->mode == 'pages' ) $this->mode = CT_MODE_PAGES;
		else if ( $this->mode == 'categories' ) $this->mode = CT_MODE_CATEGORIES;

		$this->mode = (int)$this->mode;

		$wgOut->addWikiText( wfMsgNoTrans( 'categorytree-header' ) );

		$wgOut->addHtml( $this->makeInputForm() );

		if( $this->target !== '' && $this->target !== NULL ) {
			CategoryTree::setHeaders( $wgOut );

			$title = CategoryTree::makeTitle( $this->target );

			if ( $title && $title->getArticleID() ) {
				$html = '';
				$html .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeParents' ) );
				$html .= wfElement( 'span',
					array( 'class' => 'CategoryTreeParents' ),
					wfMsg( 'categorytree-parents' ) ) . ': ';

				$ct = new CategoryTree;
				$parents = $ct->renderParents( $title, $this->mode );

				if ( $parents == '' ) $html .= wfMsg( 'categorytree-nothing-found' );
				else $html .= $parents;

				$html .= wfCloseElement( 'div' );

				$html .= wfOpenElement( 'div', array( 'class' => 'CategoryTreeResult' ) );
				$html .= $ct->renderNode( $title, $this->mode, true, false );
				$html .= wfCloseElement( 'div' );
				$wgOut->addHtml( $html );
			}
			else {
				$wgOut->addHtml( wfOpenElement( 'div', array( 'class' => 'CategoryTreeNotice' ) ) );
				$wgOut->addWikiText( wfMsg( 'categorytree-not-found' , $this->target ) );
				$wgOut->addHtml( wfCloseElement( 'div' ) );
			}
		}

	}

	/**
	 * Input form for entering a category
	 */
	function makeInputForm() {
		global $wgScript;
		$thisTitle = Title::makeTitle( NS_SPECIAL, $this->getName() );
		$form = '';
		$form .= wfOpenElement( 'form', array( 'name' => 'categorytree', 'method' => 'get', 'action' => $wgScript ) );
		$form .= wfElement( 'input', array( 'type' => 'hidden', 'name' => 'title', 'value' => $thisTitle->getPrefixedDbKey() ) );
		$form .= wfElement( 'label', array( 'for' => 'target' ), wfMsg( 'categorytree-category' ) ) . ' ';
		$form .= wfElement( 'input', array( 'type' => 'text', 'name' => 'target', 'id' => 'target', 'value' => $this->target ) ) . ' ';
		$form .= wfOpenElement( 'select', array( 'name' => 'mode' ) );
		$form .= wfElement( 'option', array( 'value' => 'categories' ) + ( $this->mode == CT_MODE_CATEGORIES ? array ( 'selected' => 'selected' ) : array() ), wfMsg( 'categorytree-mode-categories' ) );
		$form .= wfElement( 'option', array( 'value' => 'pages' ) + ( $this->mode == CT_MODE_PAGES ? array ( 'selected' => 'selected' ) : array() ), wfMsg( 'categorytree-mode-pages' ) );
		$form .= wfElement( 'option', array( 'value' => 'all' ) + ( $this->mode == CT_MODE_ALL ? array ( 'selected' => 'selected' ) : array() ), wfMsg( 'categorytree-mode-all' ) );
		$form .= wfCloseElement( 'select' );
		$form .= wfElement( 'input', array( 'type' => 'submit', 'name' => 'dotree', 'value' => wfMsg( 'categorytree-go' ) ) );
		$form .= wfCloseElement( 'form' );
		return $form;
	}
}
