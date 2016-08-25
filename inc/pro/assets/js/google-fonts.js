/**
 * Created by shramee on 16/11/15.
 */
( function ( $ ) {
	$.fn.msGoogleFonts = function () {
		var $t = $( this ),
			$div = $( '<div />' ).addClass( 'ms-google-fonts' );

		if ( $t.siblings( '.ms-google-fonts' ).length ) {
			return;
		}

		$t.find( 'option' ).each( function () {
			var $$ = $( this ),
				Font = $$.attr( 'value' ) || 'Default',
				font = Font.replace( / /g, '-' ).toLowerCase(),
				classes = 'ms-gf-' + font;
			if ( $$.prop( 'selected' ) ) {
				classes += ' active'
			}
			$div.append( $( '<span/>' ).data( 'font', Font ).addClass( classes ).text( Font ) );
		} );
		$t.after( $( '<div />' ).addClass( 'ms-google-fonts-wrap' ).append( $div ) );
		$t.hide();
		$div = $t.siblings( '.ms-google-fonts-wrap' ).children( '.ms-google-fonts' );
		$div.show();
		$div.find( 'span' ).click( function () {
			var $$ = $( this );
			$$.siblings().removeClass( 'active' );
			$$.addClass( 'active' );
			$t.val( $$.data( 'font' ) ).change();
		} );

		var $active_field = $t.siblings( 'div.ms-google-fonts' ).find( '.active' );

		if ( 1 == $active_field.count ) {
			$t.siblings( 'div.ms-google-fonts' ).scrollTop( $active_field.offsetTop )
		}
	};
	$( '.ms-google-fonts' ).msGoogleFonts();
} )( jQuery );