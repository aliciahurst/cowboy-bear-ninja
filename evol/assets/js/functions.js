( function( $ ) {

	"use strict";

	if ( $().isotope ) {
		var $container = $( '#portfolio' );

		if ( $container.length ) {
			$container.imagesLoaded( function() {
				$container.isotope( {
					itemSelector: '.type-project',
					layoutMode: 'fitRows'
				} );
			} );

			$( '#filter a' ).on( 'click', function( e ) {
				e.preventDefault();
				$container.isotope( {
					filter: $( this ).attr( 'value' )
				} );
				$( '#filter span a' ).removeClass( 'active' );
				$( this ).addClass( 'active' );
			} );
		}
	}

	$( '.hentry' ).find( 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]' ).attr( 'rel', 'gallery' ).fancybox( {
		padding : 0,
		closeBtn : false
	} );

	$( '.menu-toggle' ).on( 'click', function() {
		$( '.nav-menu' ).toggleClass( 'toggled-on' );
	} );

	$( '.hentry' ).fitVids();

	if ( $().validate ) {
		$( '#contact-form' ).validate();
	}

} )( jQuery );