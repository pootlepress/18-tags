<?php

/**
 * Storefront_Pro_Primary_Navigation Class
 *
 * @class Storefront_Pro_Primary_Navigation
 * @version    1.0.0
 * @since 1.0.0
 * @package    Storefront_Pro
 */
class Storefront_Pro_Primary_Navigation extends Storefront_Pro_Abstract {

	protected $css = '';

	public $logo_in_nav = false;

	protected $logo_index;
	protected $num_items;

	/**
	 * Primary navigation style
	 * Adds a class based on the extension name and any relevant settings.
	 */
	public function primary_nav_style( $style ) {
		$css = &Storefront_Pro_Public::$desktop_css;
		switch ( $style ) {
			case 'right':
				remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
				add_action( 'storefront_header', 'storefront_primary_navigation', 25 );
				$css .= '.storefront-pro-active .site-header .main-navigation{ ' .
				        'width: 73.6%; margin: 0; padding: 0; float: right; clear: none;' .
				        '}';
				$css .= '#site-navigation > div { width: 70%; }';
				$css .= '.woocommerce-active .site-header .site-header-cart { width: 30%; }';
				break;
			case 'center-inline':
				//Get primary menu on the top of header
				remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
				add_action( 'storefront_header', 'storefront_primary_navigation', 25 );
				$this->logo_in_nav = true;
				$css .= '.storefront-pro-active .site-branding { display:none }';
			/** @noinspection PhpExpressionResultUnusedInspection */
			case 'center':
				$css .= '.storefront-pro-active #site-navigation { width: 100%; text-align: center; }';
				$css .= '.storefront-pro-active .site-header .site-logo-link, .storefront-pro-active .site-header .site-branding{ width: 100%; text-align: center; }';
				$css .= '.storefront-pro-active .site-header .site-logo-link img { margin: auto; }';
		}

		$this->heights();
	}

	/**
	 * Primary navigation style
	 * Adds a class based on the extension name and any relevant settings.
	 */
	public function heights() {
		$css = &Storefront_Pro_Public::$desktop_css;
		$pad = $this->get( 'pri-nav-height' );
		$pad = is_numeric( $pad ) ? $pad : 1;

		$button_background_color = storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_background_color', apply_filters( 'storefront_default_button_background_color', '#60646c' ) ) );
		$css .= '.sfp-nav-search .sfp-nav-search-close{' . 'color:' . $button_background_color . '}';

		$css .= ".main-navigation ul.menu > li > a, .main-navigation .sfp-nav-search a { padding-top: {$pad}em; padding-bottom: {$pad}em; }";
		$css .= ".storefront-pro-active .main-navigation .site-header-cart li:first-child { padding-top: {$pad}em; }";
		$css .= ".storefront-pro-active .main-navigation .site-header-cart .cart-contents { padding-top: 0; padding-bottom: {$pad}em; }";

		$logo_height = $this->get( 'logo-max-height', 70 );

		if ( $logo_height ) {
			$css .= ".site-header .site-logo-link img, .site-header .logo-in-nav-anchor img { max-height: {$logo_height}px; }";
		}
	}

	/**
	 * Primary nav typography
	 */
	public function primary_nav_typo() {
		$t   = &$this;
		$css = &Storefront_Pro_Public::$desktop_css;
		$css .= '#site-navigation {' .
		        'background-color:' . $t->get( 'pri-nav-bg-color' ) . ';' .
		        '}';
		$css .= '#site-navigation.main-navigation ul, #site-navigation.main-navigation ul li a {' .
		        'font-family:' . $t->get( 'pri-nav-font' ) . ';' .
		        'font-size:' . $t->get( 'pri-nav-text-size' ) . 'px;' .
		        '}';
		$css .= '#site-navigation.main-navigation .primary-navigation ul li a {' .
		        'letter-spacing:' . $t->get( 'pri-nav-letter-spacing' ) . 'px;' .
		        'color:' . $t->get( 'pri-nav-text-color' ) . ';' .
		        $t->font_style( $t->get( 'pri-nav-font-style' ) ) .
		        '}';
		$css .= '#site-navigation.main-navigation ul li.current_page_item a {' .
		        'color:' . $t->get( 'pri-nav-active-link-color' ) . ';' .
		        '}';
		$css .= '#site-navigation.main-navigation .primary-navigation ul ul li a, #site-navigation.main-navigation .site-header-cart .widget_shopping_cart {' .
		        'color:' . $t->get( 'pri-nav-dd-text-color' ) . ';' .
		        '}';
		$css .= '#site-navigation.main-navigation .site-header-cart .widget_shopping_cart, #site-navigation.main-navigation ul.menu ul {' .
		        'background-color:' . $t->get( 'pri-nav-dd-bg-color' ) . ';' .
		        '}';
	}

	function logo_in_nav( $items, $args ) {

		if ( $args->theme_location != 'primary' ) {
			return $items;
		}

		//Init return value
		$html = '';
		//Convert items html into SimpleXML Object
		$items = new SimpleXMLElement( '<ul>' . $items . '</ul>' );
		//Num of top level menu items

		$this->render_items( $items, $html );

		return $html;
	}

	public function logo_html( $items ) {
		//Fall back values
		$li_class = 'logo-in-nav-text';
		$logoHTML = '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a>';

		$logo     = $this->get( 'logo' );
		if ( $logo ) {
			$li_class = 'logo-in-nav-image';
			$logoHTML = ''
			            . '<a class="logo-in-nav-anchor" href="' . esc_url( home_url( '/' ) ) . '" title="' . get_bloginfo( 'name' ) . '" rel="home">'
			            . '<img alt="' . get_bloginfo( 'name' ) . '" src="' . $logo . '">'
			            . '</a>'
			            . '';
		}

		$this->num_items = count( $items );
		$this->logo_index = $this->num_items / 2;
		if ( ! $this->get( 'header-wc-cart' ) ) {
			$this->logo_index++;
		}

		return '<li class=" ' . $li_class . ' logo-in-nav-menu-item">' . $logoHTML . '</li>';
	}

	public function render_items( SimpleXMLElement $items, &$html ) {

		$i         = 0;
		$logo_html = $this->logo_html( $items );

		foreach ( $items as $item ) {
			$i ++;
			if ( $this->logo_in_nav && $logo_html && $i > $this->logo_index ) {
				$html .= $logo_html;
				$logo_html = false;
			};

			$html .= $item->asXML();

			if ( $i == $this->num_items && ! $this->get( 'remove-search-icon' ) ) {
				$html .= '<li class="sf-pro-search"><a><i class="fa fa-search"></i></a>' .
				         '<ul><li>' . get_search_form( false ) . '</li></ul></li>';
			}
		}
	}

	public function submenu_animation( $animation ) {
		$css = &$this->css;

		$css .= '#site-navigation .primary-navigation .menu > li > ul { -webkit-transform-origin: 0 0 ; transform-origin: 0 0 ; -webkit-transition: height 500ms, -webkit-transform 0.5s; transition: height 500ms, transform 0.5s; }';
		switch ( $animation ) {
			case 'fade':
				$css .= '#site-navigation .primary-navigation .menu > li > ul {' .
				        '-webkit-animation-duration: 0.5s;' .
				        '-webkit-animation-name: sfProSubmenuAnimation;' .
				        'animation-duration: 0.5s;' .
				        'animation-name: sfProSubmenuAnimation;' .
				        '}';
				$css .= '@-webkit-keyframes sfProSubmenuAnimation {' .
				        '0% {display:none;opacity: 0;}' .
				        '1% {display: block ;opacity: 0;}' .
				        '100% {display: block ;opacity: 1;}' .
				        '}';
				$css .= '@keyframes sfProSubmenuAnimation {' .
				        '0% {display:none;opacity: 0;}' .
				        '1% {display: block ;opacity: 0;}' .
				        '100% {display: block ;opacity: 1;}' .
				        '}';
				break;
			case 'expand':
				$css .= '#site-navigation .primary-navigation .menu > li > ul {' .
				        '-webkit-animation-duration: 0.5s; -webkit-animation-name: sfProSubmenuAnimation;' .
				        'animation-duration: 0.5s; animation-name: sfProSubmenuAnimation;' .
				        '}';
				$css .= '@-webkit-keyframes sfProSubmenuAnimation {' .
				        '0% {display:none; -webkit-transform: scale(0, 0);}' .
				        '1% {display: block ; -webkit-transform: scale(0, 0);}' .
				        '100% {display: block ; -webkit-transform: scale(1, 1);}' .
				        '}';
				$css .= '@keyframes sfProSubmenuAnimation {' .
				        '0% {display:none; transform: scale(0, 0);}' .
				        '1% {display: block ; transform: scale(0, 0);}' .
				        '100% {display: block ; transform: scale(1, 1);}' .
				        '}';
				break;
			case 'slide':
				$css .= '#site-navigation .primary-navigation .menu > li > ul {' .
				        '-webkit-animation-duration: 0.7s;' .
				        '-webkit-animation-name: sfProSubmenuAnimation;' .
				        'animation-duration: 0.7s;' .
				        'animation-name: sfProSubmenuAnimation;' .
				        '}';
				$css .= '@-webkit-keyframes sfProSubmenuAnimation {' .
				        '0% {display:none;opacity: 0; -webkit-transform: translate(50px, 0);}' .
				        '1% {display: block ;opacity: 0; -webkit-transform: translate(50px, 0);}' .
				        '100% {display: block ;opacity: 1; -webkit-transform: translate(0, 0);}' .
				        '}';
				$css .= '@keyframes sfProSubmenuAnimation {' .
				        '0% {display:none;opacity: 0; transform: translate(50px, 0);}' .
				        '1% {display: block ;opacity: 0; transform: translate(50px, 0);}' .
				        '100% {display: block ;opacity: 1; transform: translate(0, 0);}' .
				        '}';
				break;
			case 'flip':
				$css .= '#site-navigation .primary-navigation .menu > li > ul {' .
				        '-webkit-animation-duration: 0.34s; -webkit-animation-name: sfProSubmenuAnimation;' .
				        'animation-duration: 0.34s; animation-name: sfProSubmenuAnimation;' .
				        '-webkit-transform-origin: 50% 50% ; transform-origin: 50% 50% ;' .
				        '}';
				$css .= '@-webkit-keyframes sfProSubmenuAnimation {' .
				        '0% {display:none; -webkit-transform: rotateY(90deg);}' .
				        '1% {display: block ; -webkit-transform: rotateY(90deg);}' .
				        '100% {display: block ; -webkit-transform: rotateY(0deg);}' .
				        '}';
				$css .= '@keyframes sfProSubmenuAnimation {' .
				        '0% {display:none; transform: rotateY(90deg);}' .
				        '1% {display: block ; transform: rotateY(90deg);}' .
				        '100% {display: block ; transform: rotateY(0deg);}' .
				        '}';
				break;
		}
	}
} // End class