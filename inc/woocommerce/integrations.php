<?php
/**
 * Integration logic for WooCommerce extensions
 *
 * @package eighteen-tags
 */

/**
 * Styles & Scripts
 * @return void
 */
function eighteen_tags_woocommerce_integrations_scripts() {
//Header cart display
	$header_cart = get_theme_mod( 'eighteen-tags-pro-header-wc-cart' );

	add_action( 'eighteen_tags_pro_in' . $header_cart . '_nav', 'eighteen_tags_header_cart' );
	if ( ! empty( $header_cart ) ) {
		add_action( 'eighteen_tags_pro_in_nav', 'eighteen_tags_header_cart' );
		Eighteen_Tags_Public::$desktop_css .= '#site-navigation.main-navigation .site-header-cart { display: none !important; }';
		Eighteen_Tags_Public::$desktop_css .= '.eighteen-tags-pro-active.woocommerce-active #site-navigation > div { width: 100%; }';
	}
}

