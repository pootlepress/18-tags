<?php

require 'class-woocommerce-shop.php';

/**
 * Eighteen_Tags_Pro_WooCommerce Class
 *
 * @class Eighteen_Tags_Pro_WooCommerce
 * @version	1.0.0
 * @since 1.0.0
 * @package	Eighteen_Tags_Pro
 */
class Eighteen_Tags_Pro_WooCommerce extends Eighteen_Tags_Pro_WooCommerce_Shop {

	public function init() {
		wp_localize_script( 'sfp-script', 'sfpSettings', array(
			'shopLayout' => false,
			'mobStore' => false,
			'infiniteScroll' => false,
		) );
		if ( ! is_woocommerce_activated() ) {
			$this->css .= '.eighteen-tags-pro-active #site-navigation > div { width: 100%; }';
			return;
		}

		add_filter( 'eighteen_tags_loop_columns', array( $this, 'columns' ), 999 );

		//Header cart display
		$header_cart = $this->get( 'header-wc-cart' );
		add_action( 'eighteen_tags_pro_in' . $header_cart . '_nav', 'eighteen_tags_header_cart' );
		if ( ! empty( $header_cart ) ) {
			add_action( 'eighteen_tags_pro_in_nav', 'eighteen_tags_header_cart' );
			Eighteen_Tags_Pro_Public::$desktop_css .= '#site-navigation.main-navigation .site-header-cart { display: none !important; }';
			$this->css .= '.eighteen-tags-pro-active #site-navigation > div { width: 100%; }';
		}
		//Header cart color
		$this->css .= '.eighteen-tags-pro-active .site-header-cart .cart-contents { color: ' . $this->get( 'header-wc-cart-color', '#000000' ) . '; }';

		$is_product_archive = is_shop() || is_product_taxonomy();
		$is_checkout_process = is_cart() || is_checkout();

		$this->set_styles( $is_product_archive, $is_checkout_process );
	}

	/**
	 * Specifies the number of columns for products on the shop page
	 * @param int $cols Columns
	 * @return int Columns
	 * @filter eighteen_tags_loop_columns
	 * @since 1.0.0
	 */
	public function columns( $cols ) {
		$columns = $this->get( 'wc-shop-columns' );
		if ( $columns ) {
			return $columns;
		} else {
			return $cols;
		}
	}

	/**
	 * Enqueue CSS and custom styles.
	 * @since  1.0.0
	 * @return string CSS
	 */
	public function styles() {
		return $this->css;
	}

	/**
	 * Enqueue CSS and custom styles.
	 * @since  1.0.0
	 * @return string CSS
	 */
	public function set_styles( $is_product_archive, $is_checkout_process ) {

		//Shop css and hooks
		$this->shop();
		//Messages css
		$this->messages();

		if ( is_product() ) {
			//It's product page!
			$this->its_product();
		} else if ( $is_product_archive ) {
			wp_localize_script( 'sfp-script', 'sfpSettings', array(
				'shopLayout' => $this->get( 'wc-shop-layout' ),
				'mobStore' => $this->get( 'wc-mob-store' ),
				'infiniteScroll' => $this->get( 'wc-infinite-scroll' ),
			) );
			//It's a product archive maybe a shop
			$this->its_product_archive();
		} else if ( $is_checkout_process ) {
			//Enable distraction free checkout if set
			$this->distraction_free_checkout();
			$hide_breadcrumbs = $this->get( 'hide-wc-breadcrumbs-checkout' );
			$this->remove_breadcrumbs( $hide_breadcrumbs );
		} else {
			//It's checkout process page
			$this->its_non_woocommerce_page();
		}

		return $this->css;
	}

	/**
	 * Shop Layout
	 * Tweaks the WooCommerce layout based on settings
	 */
	public function its_product() {

		$hide_breadcrumbs = $this->get( 'hide-wc-breadcrumbs-product' );
		$this->remove_breadcrumbs( $hide_breadcrumbs );

		if ( 'full' == $this->get( 'wc-product-layout', 'default' ) ) {
			remove_action( 'eighteen_tags_sidebar', 'eighteen_tags_get_sidebar' );
			$this->css .= '.eighteen-tags-pro-active.right-sidebar .content-area{ width: auto; margin: auto; }';
		}

		if ( ! $this->get( 'wc-product-tabs', true ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		}

		if ( ! $this->get( 'wc-product-meta', true ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		}

		if ( ! $this->get( 'wc-rel-product', true ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}
	}

	protected function its_non_woocommerce_page() {
		//Remove breadcrumbs on archives
		$this->remove_breadcrumbs( is_archive() && $this->get( 'hide-wc-breadcrumbs-archives' ) );
		//Remove breadcrumbs on posts
		$this->remove_breadcrumbs( is_singular( 'post' ) && $this->get( 'hide-wc-breadcrumbs-posts', true ) );
		//Remove breadcrumbs on pages
		$this->remove_breadcrumbs( is_page() && $this->get( 'hide-wc-breadcrumbs-pages' ) );
	}

	private function distraction_free_checkout() {
		$css = &$this->css;
		if ( $this->get( 'wc-co-distraction-free' ) ) {
			remove_all_actions( 'eighteen_tags_header' );
			remove_all_actions( 'eighteen_tags_footer' );
			remove_action( 'eighteen_tags_sidebar', 'eighteen_tags_get_sidebar' );
			$css .= '.eighteen-tags-pro-active.right-sidebar .content-area{ width: auto; margin: auto; }';
			$css .= '.secondary-navigation, .site-header, .site-footer { display: none; } ';
		}
	}

	/**
	 * Add CSS in <head> for styles handled by the Customizer
	 *
	 * @since 1.0.0
	 */
	public function messages() {
		$success_bg_clr  = eighteen_tags_sanitize_hex_color( $this->get( 'wc-success-bg-color', '#0f834d' ) );
		$success_txt_clr = eighteen_tags_sanitize_hex_color( $this->get( 'wc-success-text-color', '#ffffff' ) );
		$message_bg_clr  = eighteen_tags_sanitize_hex_color( $this->get( 'wc-info-bg-color', '#3D9CD2' ) );
		$message_txt_clr = eighteen_tags_sanitize_hex_color( $this->get( 'wc-info-text-color', '#ffffff' ) );
		$error_bg_clr 	 = eighteen_tags_sanitize_hex_color( $this->get( 'wc-error-bg-color', '#e2401c' ) );
		$error_txt_clr 	 = eighteen_tags_sanitize_hex_color( $this->get( 'wc-error-text-color', '#ffffff' ) );

		$this->css .=
		//Success message colors
		".woocommerce-message { background-color:{$success_bg_clr} !important; color:{$success_txt_clr} !important;}" .
		".woocommerce-message * { color:{$success_txt_clr} !important; }" .
		//Info message colors
		".woocommerce-info { background-color:{$message_bg_clr} !important; color:{$message_txt_clr} !important;}" .
		".woocommerce-info * { color:{$message_txt_clr} !important;}" .
		//Error message colors
		".woocommerce-error { background-color:{$error_bg_clr} !important; color:{$error_txt_clr} !important; }" .
		".woocommerce-error * { color:{$error_txt_clr} !important; }";
	}
} // End class