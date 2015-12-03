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

		var $menu_style = $( '[data-customize-setting-link="eighteen-tags-pro-nav-style"]' ),
			show_hide_ham_label = function () {
				var $ham_icon_label = $( '#customize-control-eighteen-tags-pro-pri-nav-label' );
				if ( 'left-vertical hamburger' == $menu_style.val() ) {
					$ham_icon_label.slideDown();
				} else {
					$ham_icon_label.slideUp();
				}
			};
		$menu_style.change( show_hide_ham_label );
		show_hide_ham_label();

		var $blog_layout = $( '#input_eighteen-tags-pro-blog-layout' ),
			$grid = $('#customize-control-eighteen-tags-pro-blog-grid' ),
			show_hide_grid = function () {
				if ( $blog_layout.find( 'input:checked' ).val() ) {
					$grid.slideDown();
				} else {
					$grid.slideUp();
				}
			};
		$blog_layout.find( 'input' ).change( show_hide_grid );
		show_hide_grid();

		var $post_content = $( 'select[data-customize-setting-link="eighteen-tags-pro-blog-content"]' ),
			$excert_fields = $(
				'#customize-control-eighteen-tags-pro-blog-excerpt-count,' +
				'#customize-control-eighteen-tags-pro-blog-excerpt-end,' +
				'#customize-control-eighteen-tags-pro-blog-rm-butt-text'
			),
			show_hide_excerpt_options = function () {
				if ( $post_content.val() ) {
					$excert_fields.slideUp();
				} else {
					$excert_fields.slideDown();
				}
			};
		$post_content.change( show_hide_excerpt_options );
		show_hide_excerpt_options();

		var $boxed_layout = $( '[data-customize-setting-link="eighteen_tags_boxed_layout"]' ),
			show_hide_boxed_layout_options = function () {
				var $box_props = $( '[id*="customize-control-eighteen_tags_boxed_layout_"]' );
				if ( $boxed_layout.prop( 'checked' ) ) {
					$box_props.slideDown();
				} else {
					$box_props.slideUp();
				}
			};
		$boxed_layout.change( show_hide_boxed_layout_options );
		show_hide_boxed_layout_options();

	} );
})( wp, jQuery );