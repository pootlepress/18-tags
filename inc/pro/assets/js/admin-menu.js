/**
 * Created by shramee on 23/10/15.
 * @package makesite
 */
jQuery( document ).ready( function ( $ ) {
	$( '.menu-item-depth-0 .field-css-classes' ).each( function () {
		var $t = $( this ),
			$input = $t.find('input'),
			$cb = $( '<input/>' ).attr( 'type', 'checkbox' ),
			$p = $( '<p/>' ).html( '<label> Make a mega menu</label>' ).addClass( 'field-mega-menu description description-wide' );
		$cb.addClass( 'enable-mega-menu' );
		if ( -1 < $input.val().search('mega-menu') ) {
			$cb.prop( 'checked', true );
		}
		$p.find( 'label' ).prepend( $cb );
		$t.before( $p );
	} );
	$( '.enable-mega-menu' ).change( function () {
		var $t = $( this ),
			$class = $t.closest( '.menu-item-settings' ).find('.field-css-classes input' ),
			valNow = $class.val();
		if ( this.checked ) {
			valNow = $class.val() + ' mega-menu';
		} else {
			valNow = $class.val().replace( ' mega-menu', '' ).replace( 'mega-menu', '' );
		}
		$class.val( valNow );
	} );
} );