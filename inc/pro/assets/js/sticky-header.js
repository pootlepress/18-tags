/**
 * Created by shramee on 9/10/15.
 */
jQuery( document ).ready( function ($) {
	var $t = $( '#masthead' ),
		stickyNavTop = $t.offset().top,
		$tHi = $t.outerHeight() + parseInt( $t.css( 'margin-bottom' ) );

	var stickyNav = function () {
		var scrollTop = $( window ).scrollTop();

		if ( $(window ).width() > 763 ) {
			if ( scrollTop > stickyNavTop ) {
				$t.addClass( 'sticky' );
				$( '.secondary-navigation' ).css( 'margin-bottom', $tHi )
			} else {
				$t.removeClass( 'sticky' );
				$( '.secondary-navigation' ).css( 'margin-bottom', 0 );
			}
		}
	};

	stickyNav();

	$( window ).scroll( function () {
		stickyNav();
	} );
} );