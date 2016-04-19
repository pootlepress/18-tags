<?php
/**
 * eighteen-tags Theme Customizer display functions
 *
 * @package eighteen-tags
 */

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'eighteen_tags_add_customizer_css' ) ) {
	function eighteen_tags_add_customizer_css() {
		$accent_color 					= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_accent_color', apply_filters( 'eighteen_tags_default_accent_color', '#428bca' ) ) );
		$header_background_color 		= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_header_background_color', apply_filters( 'eighteen_tags_default_header_background_color', '#ffffff' ) ) );
		$header_link_color 				= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_header_link_color', apply_filters( 'eighteen_tags_default_header_link_color', '#000000' ) ) );
		$header_text_color 				= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_header_text_color', apply_filters( 'eighteen_tags_default_header_text_color', '#9aa0a7' ) ) );

		$footer_background_color 		= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_footer_background_color', apply_filters( 'eighteen_tags_default_footer_background_color', '#f3f3f3' ) ) );
		$footer_link_color 				= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_footer_link_color', apply_filters( 'eighteen_tags_default_footer_link_color', '#428bca' ) ) );
		$footer_heading_color 			= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_footer_heading_color', apply_filters( 'eighteen_tags_default_footer_heading_color', '#494c50' ) ) );
		$footer_text_color 				= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_footer_text_color', apply_filters( 'eighteen_tags_default_footer_text_color', '#61656b' ) ) );

		$text_color 					= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_text_color', apply_filters( 'eighteen_tags_default_text_color', '#60646c' ) ) );
		$heading_color 					= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_heading_color', apply_filters( 'eighteen_tags_default_heading_color', '#484c51' ) ) );
		$button_background_color 		= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_button_background_color', apply_filters( 'eighteen_tags_default_button_background_color', '#60646c' ) ) );
		$button_text_color 				= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_button_text_color', apply_filters( 'eighteen_tags_default_button_text_color', '#ffffff' ) ) );
		$button_alt_background_color 	= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_button_alt_background_color', apply_filters( 'eighteen_tags_default_button_alt_background_color', '#428bca' ) ) );
		$button_alt_text_color 			= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_button_alt_text_color', apply_filters( 'eighteen_tags_default_button_alt_text_color', '#ffffff' ) ) );

		$brighten_factor 				= apply_filters( 'eighteen_tags_brighten_factor', 25 );
		$darken_factor 					= apply_filters( 'eighteen_tags_darken_factor', -25 );

		$box_color 						= eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_boxed_layout_color', apply_filters( 'eighteen_tags_default_box_layout_color', '' ) ) );
		$box_padding 					= get_theme_mod( 'eighteen_tags_boxed_layout_padding', apply_filters( 'eighteen_tags_default_box_layout_padding', '' ) );

		$style 							= '
		.main-navigation ul li a,
		.site-title a,
		ul.menu li a,
		.site-branding h1 a {
			color: ' . $header_link_color . ';
		}

		.main-navigation ul li a:hover,
		.site-title a:hover {
			color: ' . eighteen_tags_adjust_color_brightness( $header_link_color, $darken_factor ) . ';
		}

		.site-header {
			background-image: url(' . esc_url( get_header_image() ) . ');
		}

		.site-header,
		.secondary-navigation ul ul,
		.main-navigation ul.menu > li.menu-item-has-children:after,
		.secondary-navigation ul.menu ul {
			background-color: ' . $header_background_color . ';
		}

		p.site-description,
		ul.menu li.current-menu-item > a {
			color: ' . $header_text_color . ';
		}

		h1, h2, h3, h4, h5, h6 {
			color: ' . $heading_color . ';
		}

		.hentry .entry-header {
			border-color: ' . $heading_color . ';
		}

		.widget h1 {
			border-bottom-color: ' . $heading_color . ';
		}

		body,
		.secondary-navigation a,
		.widget-area .widget a,
		.onsale,
		#comments .comment-list .reply a,
		.pagination .page-numbers li .page-numbers:not(.current), .woocommerce-pagination .page-numbers li .page-numbers:not(.current) {
			color: ' . $text_color . ';
		}

		a  {
			color: ' . $accent_color . ';
		}

		a:focus,
		.button:focus,
		.button.alt:focus,
		.button.added_to_cart:focus,
		.button.wc-forward:focus,
		button:focus,
		input[type="button"]:focus,
		input[type="reset"]:focus,
		input[type="submit"]:focus {
			outline-color: ' . $accent_color . ';
		}

		button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart, .widget-area .widget a.button, .site-header-cart .widget_shopping_cart a.button {
			background-color: ' . $button_background_color . ';
			border-color: ' . $button_background_color . ';
			color: ' . $button_text_color . ';
		}

		button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .widget-area .widget a.button:hover, .site-header-cart .widget_shopping_cart a.button:hover {
			background-color: ' . eighteen_tags_adjust_color_brightness( $button_background_color, $darken_factor ) . ';
			border-color: ' . eighteen_tags_adjust_color_brightness( $button_background_color, $darken_factor ) . ';
			color: ' . $button_text_color . ';
		}

		button.alt, input[type="button"].alt, input[type="reset"].alt, input[type="submit"].alt, .button.alt, .added_to_cart.alt, .widget-area .widget a.button.alt, .added_to_cart, .pagination .page-numbers li .page-numbers.current, .woocommerce-pagination .page-numbers li .page-numbers.current {
			background-color: ' . $button_alt_background_color . ';
			border-color: ' . $button_alt_background_color . ';
			color: ' . $button_alt_text_color . ';
		}

		button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover, .widget-area .widget a.button.alt:hover, .added_to_cart:hover {
			background-color: ' . eighteen_tags_adjust_color_brightness( $button_alt_background_color, $darken_factor ) . ';
			border-color: ' . eighteen_tags_adjust_color_brightness( $button_alt_background_color, $darken_factor ) . ';
			color: ' . $button_alt_text_color . ';
		}

		.site-footer {
			background-color: ' . $footer_background_color . ';
			color: ' . $footer_text_color . ';
		}

		.site-footer a:not(.button) {
			color: ' . $footer_link_color . ';
		}

		.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {
			color: ' . $footer_heading_color . ';
		}

		@media screen and ( min-width: 768px ) {
			.secondary-navigation ul.menu a:hover {
				color: ' . eighteen_tags_adjust_color_brightness( $header_text_color, $brighten_factor ) . ';
			}

			.secondary-navigation ul.menu a {
				color: ' . $header_text_color . ';
			}

			body > .col-full {
				background-color: ' . $box_color . ';
				padding: ' . $box_padding . 'px;
			}
		}';

		$woocommerce_style 							= '
		a.cart-contents,
		.site-header-cart .widget_shopping_cart a {
			color: ' . $header_link_color . ';
		}

		a.cart-contents:hover,
		.site-header-cart .widget_shopping_cart a:hover {
			color: ' . eighteen_tags_adjust_color_brightness( $header_link_color, $darken_factor ) . ';
		}

		.site-header-cart .widget_shopping_cart {
			background-color: ' . $header_background_color . ';
		}

		.woocommerce-tabs ul.tabs li.active a,
		ul.products li.product .price,
		.onsale {
			color: ' . $text_color . ';
		}

		.onsale {
			border-color: ' . $text_color . ';
		}

		.star-rating span:before,
		.widget-area .widget a:hover,
		.product_list_widget a:hover,
		.quantity .plus, .quantity .minus,
		p.stars a:hover:after,
		p.stars a:after,
		.star-rating span:before {
			color: ' . $accent_color . ';
		}

		.widget_price_filter .ui-slider .ui-slider-range,
		.widget_price_filter .ui-slider .ui-slider-handle {
			background-color: ' . $accent_color . ';
		}

		#order_review_heading, #order_review {
			border-color: ' . $accent_color . ';
		}

		@media screen and ( min-width: 768px ) {
			.site-header-cart .widget_shopping_cart,
			.site-header .product_list_widget li .quantity {
				color: ' . $header_text_color . ';
			}
		}';

		wp_add_inline_style( 'eighteen-tags-style', $style );
		wp_add_inline_style( 'eighteen-tags-woocommerce-style', $woocommerce_style );
	}
}