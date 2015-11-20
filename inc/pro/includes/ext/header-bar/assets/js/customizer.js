/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	wp.customize( 'shb_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.shb-header-bar' ).css( 'background-color', to );
		} );
	} );

	wp.customize( 'shb_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.shb-header-bar .widget' ).css( 'color', to );
		} );
	} );

	wp.customize( 'shb_heading_color', function( value ) {
		value.bind( function( to ) {
			$( '.shb-header-bar .widget h1, .shb-header-bar .widget h2, .shb-header-bar .widget h3, .shb-header-bar .widget h4, .shb-header-bar .widget h5, .shb-header-bar .widget h6' ).css( 'color', to );
		} );
	} );
} )( jQuery );
