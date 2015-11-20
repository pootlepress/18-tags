/**
 * Created by shramee on 9/10/15.
 */
(function( exports, $ ){
	var api = wp.customize;

	api.lib_multi_checkbox = api.Control.extend( {
		ready : function () {
			var $p = this.container,
				$inputs = $p.find( 'input:not(.hidden)' );
			$inputs.change( function () {

				checkbox_values = $p.find( 'input:checked' ).not('.hidden').map(
					function () {
						return this.value;
					}
				).get().join( ',' );

				$p.find( 'input.hidden' ).val( checkbox_values ).trigger( 'change' );

			} );
		}
	} );
	api.controlConstructor['multi-checkbox'] = api.lib_multi_checkbox;

	api.lib_grid = api.Control.extend( {
		ready : function () {
			var $p = this.container,
				$inputs = $p.find( 'select' );

			$inputs.change( function () {
				checkbox_values = $p.find( 'select' ).map(
					function () {
						return this.value;
					}
				).get().join( ',' );

				$p.find( 'input.hidden' ).val( checkbox_values ).trigger( 'change' );

			} );
		}
	} );
	api.controlConstructor['grid'] = api.lib_grid;

	api.etp_range = api.Control.extend( {
		ready : function () {
			var control = this,
				container = control.container;
			container.find( 'input[type="range"]' )
				.css('vertical-align', 'middle')
				.after( $( ' <span class="dashicons dashicons-update"></span>' ) );
			container.find( '.dashicons' )
				.css('vertical-align', 'middle')
				.click( function () {
					var $t = $( this ),
						$input = $t.siblings( 'input' );
					$input
						.val( '0' );
					control.setting.set( false );
				} );
		}
	} );
	api.controlConstructor['range'] = api.etp_range;

	$( document ).ready( function () {
		var $blog_layout = $( '#input_eighteen-tags-pro-blog-layout' ),
			$grid = $('#customize-control-eighteen-tags-pro-blog-grid' ),
			$post_content = $( 'select[data-customize-setting-link="eighteen-tags-pro-blog-content"]' ),
			$excert_fields = $(
				'#customize-control-eighteen-tags-pro-blog-excerpt-count,' +
				'#customize-control-eighteen-tags-pro-blog-excerpt-end,' +
				'#customize-control-eighteen-tags-pro-blog-rm-butt-text'
			);
		show_hide_grid = function () {
			if ( $blog_layout.find( 'input:checked' ).val() ) {
				$grid.slideDown();
			} else {
				$grid.slideUp();
			}
		};
		show_hide_excerpt_options = function () {
			if ( $post_content.val() ) {
				$excert_fields.slideUp();
			} else {
				$excert_fields.slideDown();
			}
		};

		$blog_layout.find( 'input' ).change( show_hide_grid );
		show_hide_grid();

		$post_content.change( show_hide_excerpt_options );
		show_hide_excerpt_options();
	} );
})( wp, jQuery );