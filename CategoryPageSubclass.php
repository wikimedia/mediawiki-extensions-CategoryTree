<?php

class CategoryTreeCategoryPage extends CategoryPage {
	function closeShowCategory() {
		global $wgOut, $wgRequest;
		$from = $wgRequest->getVal( 'from' );
		$until = $wgRequest->getVal( 'until' );

		$viewer = new CategoryTreeCategoryViewer( $this->mTitle, $from, $until );
		$wgOut->addHTML( $viewer->getHTML() );
	}
}

class CategoryTreeCategoryViewer extends CategoryViewer {
	var $child_titles;
	
	function getSubcategorySection() {
		global $wgOut, $wgRequest, $wgCookiePrefix;

		if( count( $this->children ) == 0 ) {
			return '';
		}
		
		$r = '<h2>' . wfMsg( 'subcategories' ) . "</h2>\n" .
			wfMsgExt( 'subcategorycount', array( 'parse' ), count( $this->children) );

		# Use a cookie to save the user's last selection, so that AJAX doesn't
		# keep coming back to haunt them.
		#
		# FIXME: This doesn't work very well with IMS handling in 
		# OutputPage::checkLastModified, because when the cookie changes, the 
		# category pages are not, at present, invalidated.
		$cookieName = $wgCookiePrefix.'ShowSubcatAs';
		$cookieVal = @$_COOKIE[$cookieName];
		if ( $wgRequest->getVal( 'showas' ) == 'list' ) {
			$showAs = 'list';
		} elseif ( $wgRequest->getVal( 'showas' ) == 'tree' ) {
			$showAs = 'tree';
		} elseif ( $cookieVal == 'list' || $cookieVal == 'tree' ) {
			$showAs = $cookieVal;
		} else {
			$showAs = 'tree';
		}

		if ( !$cookieVal ) {
			global $wgCookieExpiration, $wgCookiePath, $wgCookieDomain, $wgCookieSecure;
			$exp = time() + $wgCookieExpiration;
			setcookie( $cookieName, $cookieVal, $exp, $wgCookiePath, $wgCookieDomain, $wgCookieSecure );
		}
		
		if ( $showAs == 'tree' && count( $this->children ) > $this->limit ) {
			# Tree doesn't page properly 
			$showAs = 'list';
			$r .= self::msg( 'too-many-subcats' );
		} else {
			$sk = $this->getSkin();
			$r .= '<p>' .
				$this->makeShowAsLink( 'tree', $showAs ) .
				' | ' .
				$this->makeShowAsLink( 'list', $showAs ) .
				'</p>';
		}
		
		if ( $showAs == 'list' ) {
			$r .= $this->formatList( $this->children, $this->children_start_char );
		} else {
			CategoryTree::setHeaders( $wgOut );
			$ct = new CategoryTree;

			foreach ( $this->child_titles as $title ) {
				$r .= $ct->renderNode( $title );
			}
		}
		return $r;
	}
	
	function makeShowAsLink( $targetValue, $currentValue ) {
		$msg = htmlspecialchars( CategoryTree::msg( "show-$targetValue" ) );

		if ( $targetValue == $currentValue ) {
			return "<strong>$msg</strong>";
		} else {
			return $this->getSkin()->makeKnownLinkObj( $this->title, $msg, "showas=$targetValue" );
		}
	}

	function clearCategoryState() {
		$this->child_titles = array();
		parent::clearCategoryState();
	}
	
	function addSubcategory( $title, $sortKey, $pageLength ) {
		$this->child_titles[] = $title;
		parent::addSubcategory( $title, $sortKey, $pageLength );
	}

	function finaliseCategoryState() {
		if( $this->flip ) {
			$this->child_titles = array_reverse( $this->child_titles );
		}
		parent::finaliseCategoryState();
	}
}
?>
