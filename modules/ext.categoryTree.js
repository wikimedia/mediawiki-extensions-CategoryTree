/*
 * JavaScript functions for the CategoryTree extension, an AJAX based gadget
 * to display the category structure of a wiki
 *
 * @file
 * @ingroup Extensions
 * @author Daniel Kinzler, brightbyte.de
 * @copyright © 2006 Daniel Kinzler
 * @licence GNU General Public Licence 2.0 or later
 *
 * NOTE: if you change this, increment $wgCategoryTreeVersion
 *       in CategoryTree.php to avoid users getting stale copies from cache.
 */

new ( function( $, mw ) {
	/**
	 * Reference to this
	 *
	 * @var {this}
	 */
	var that = this;

	/**
	 * Sets display inline to tree toggle
	 */
	this.showToggles = function() {
		$( 'span.CategoryTreeToggle' ).css( 'display', 'inline' );
	};

	/**
	 * Handles clicks on the expand buttons, and calls the appropriate function
	 */
	this.handleNode = function() {
		$link = $( this );
		if ( $link.data( 'ctState' ) == 'collapsed' ) {
			that.expandNode( $link );
		} else {
			that.collapseNode( $link );
		}
	}

	/**
	 * Expands a given node (loading it's children if not loaded)
	 *
	 * @param {jQuery} $link
	 */
	this.expandNode = function( $link ) {
		// Show the children node
		$children = $link.parents( '.CategoryTreeItem' )
				.siblings( '.CategoryTreeChildren' );
		$children.show();

		$link
			.html( mw.msg( 'categorytree-collapse-bullet' ) )
			.attr( 'title', mw.msg( 'categorytree-collapse' ) )
			.data( 'ctState', 'expanded' );

		if ( !$link.data( 'ctLoaded' ) ) {
			that.loadChildren( $link, $children );
		}
	};

	/**
	 * Collapses a node
	 *
	 * @param {jQuery} $link
	 */
	this.collapseNode = function( $link ) {
		// Hide the children node
		$link.parents( '.CategoryTreeItem' )
			.siblings( '.CategoryTreeChildren' ).hide();

		$link
			.html( mw.msg( 'categorytree-expand-bullet' ) )
			.attr( 'title', mw.msg( 'categorytree-expand' ) )
			.data( 'ctState', 'collapsed' );
	};

	/**
	 * Loads children for a node
	 *
	 * @param {jQuery} $link
	 * @param {jQuery} $children
	 */
	this.loadChildren = function( $link, $children ) {
		$link.data( 'ctLoaded', true );
		$children.html(
			'<i class="CategoryTreeNotice">'
			+ mw.msg( 'categorytree-loading' ) + "</i>"
		);

		$parentTag = $link.parents( '.CategoryTreeTag' );

		if ( $parentTag.length == 0 ) {
			// Probably a CategoryPage
			$parentTag = $( '<div />' )
				.hide()
				.data( 'ctOptions', mw.config.get( 'wgCategoryTreePageCategoryOptions' ) )
		}

		$.get(
			mw.util.wikiScript(), {
				action: 'ajax',
				rs: 'efCategoryTreeAjaxWrapper',
				rsargs: [$link.data( 'ctTitle' ), $parentTag.data( 'ctOptions' ), 'json'] // becomes &rsargs[]=arg1&rsargs[]=arg2...
			}
		)
			.success( function ( data ) {
				data = data.replace(/^\s+|\s+$/, '');
				data = data.replace(/##LOAD##/g, mw.msg( 'categorytree-expand' ) );

				if ( data == '' ) {
					switch ( $parentTag.data( 'ctMode' ) ) {
						case 0:
							data = mw.msg( 'categorytree-no-subcategories' );
							break;
						case 10:
							data = mw.msg( 'categorytree-no-pages' );
							break;
						case 100:
							data = mw.msg( 'categorytree-no-parent-categories' );
							break;
						default:
							data = mw.msg( 'categorytree-nothing-found' );
					}

					data = $( '<i class="CategoryTreeNotice" />' ).text( data );
				}

				$children
					.html( data )
					.find( '.CategoryTreeToggle' )
						.click( that.handleNode );
				that.showToggles();
			} )
			.error( function() {
				$retryLink = $( '<a />' )
					.text( mw.msg( 'categorytree-retry' ) )
					.attr( 'href', '#' )
					.click( function() { that.loadChildren( $link, $children ) } );
				$children
					.text( mw.msg( 'categorytree-error' ) )
					.append( $retryLink );
			} );
	}

	/**
	 * Register any click events
	 */
	$( function( $ ) {
		$( '.CategoryTreeToggle' ).click( that.handleNode );

		that.showToggles();
	} );
} )( jQuery, mediaWiki );