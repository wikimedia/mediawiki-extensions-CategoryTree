<?php
/**
 * Special page for the  CategoryTree extension, an AJAX based gadget
 * to display the category structure of a wiki
 *
 * @addtogroup Extensions
 * @author Daniel Kinzler, brightbyte.de
 * @copyright © 2006 Daniel Kinzler
 * @license GNU General Public Licence 2.0 or later
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
				$html = Xml::openElement( 'div', array( 'class' => 'CategoryTreeParents' ) );
					Xml::element( 'span',
					array( 'class' => 'CategoryTreeParents' ),
					wfMsg( 'categorytree-parents' ) ) . ': ';

				$ct = new CategoryTree;
				$parents = $ct->renderParents( $title, $this->mode );

				if ( $parents == '' ) {
					$html .= wfMsg( 'categorytree-nothing-found' );
				} else {
					$html .= $parents;
				}

				$html .= Xml::closeElement( 'div' ) .
					Xml::openElement( 'div', array( 'class' => 'CategoryTreeResult' ) ) .
					$ct->renderNode( $title, $this->mode, true, false ) .
					Xml::closeElement( 'div' );
				$wgOut->addHtml( $html );
			}
			else {
				$wgOut->addHtml( Xml::openElement( 'div', array( 'class' => 'CategoryTreeNotice' ) ) );
				$wgOut->addWikiText( wfMsg( 'categorytree-not-found' , $this->target ) );
				$wgOut->addHtml( Xml::closeElement( 'div' ) );
			}
		}

	}

	/**
	 * Input form for entering a category
	 */
	function makeInputForm() {
		global $wgScript;
		$thisTitle = Title::makeTitle( NS_SPECIAL, $this->getName() );

		$form = Xml::openElement( 'form', array( 'name' => 'categorytree', 'method' => 'get', 'action' => $wgScript, 'id' => 'mw-categorytree-form' ) ) .
			Xml::openElement( 'fieldset' ) .
			Xml::element( 'legend', null, wfMsg( 'categorytree-legend' ) ) .
			Xml::hidden( 'title', $thisTitle->getPrefixedDbKey() ) .
			Xml::inputLabel( wfMsg( 'categorytree-category' ), 'target', 'target', 20, $this->target ) . ' ' .
			Xml::openElement( 'select', array( 'name' => 'mode' ) ) .
			Xml::option( wfMsg( 'categorytree-mode-categories' ), 'categories', $this->mode == CT_MODE_CATEGORIES ? true : false ) .
			Xml::option( wfMsg( 'categorytree-mode-pages' ), 'pages', $this->mode == CT_MODE_PAGES ? true : false ) .
			Xml::option( wfMsg( 'categorytree-mode-all' ), 'all', $this->mode == CT_MODE_ALL ? true : false ) .
			Xml::closeElement( 'select' ) . ' ' .
			Xml::submitButton( wfMsg( 'categorytree-go' ), array( 'name' => 'dotree' ) ) .
			Xml::closeElement( 'fieldset' ) .
			Xml::closeElement( 'form' );
		return $form;
	}
}
