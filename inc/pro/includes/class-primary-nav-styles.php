<?php

/**
 * Eighteen_Tags_Primary_Navigation Class
 *
 * @class Eighteen_Tags_Primary_Navigation
 * @version    1.0.0
 * @since 1.0.0
 * @package    Eighteen_Tags
 */
class Eighteen_Tags_Primary_Navigation extends Eighteen_Tags_Abstract {

	protected $css = '';

	public $logo_in_nav = false;

	protected $logo_index;
	protected $num_items;

	/**
	 * Primary navigation style
	 * Adds a class based on the extension name and any relevant settings.
	 */
	public function primary_nav_style( $style ) {
		$css = &Eighteen_Tags_Public::$desktop_css;
		switch ( true ) {
			case is_numeric( strpos( $style, 'right' ) ):
				remove_action( 'eighteen_tags_header', 'eighteen_tags_primary_navigation', 50 );
				add_action( 'eighteen_tags_header', 'eighteen_tags_primary_navigation', 25 );
				$css .= '.eighteen-tags-pro-active .site-header .main-navigation{ ' .
				        'width: 73.6%; margin: 0; padding: 0; float: right; clear: none;' .
				        '}';
				$css .= '#site-navigation > div { width: 100%; }';
				$css .= '.woocommerce-active #site-navigation > div { width: 70%; }';
				$css .= '.woocommerce-active .site-header .site-header-cart { width: 30%; }';
				break;
			case $style == 'center-inline':
				//Get primary menu on the top of header
				remove_action( 'eighteen_tags_header', 'eighteen_tags_primary_navigation', 50 );
				add_action( 'eighteen_tags_header', 'eighteen_tags_primary_navigation', 25 );
				$this->logo_in_nav = true;
				$css .= '.eighteen-tags-pro-active .site-branding { display:none }';
			/** @noinspection PhpExpressionResultUnusedInspection */
			case $style == 'center':
				$css .= '.eighteen-tags-pro-active #site-navigation { width: 100%; text-align: center; }';
				$css .= '.eighteen-tags-pro-active .site-header .custom-logo-link, .eighteen-tags-pro-active .site-header .site-branding{ width: 100%; text-align: center; }';
				$css .= '.eighteen-tags-pro-active .site-header .custom-logo-link img { margin: auto; }';
		}

		$this->heights();
	}

	/**
	 * Primary navigation style
	 * Adds a class based on the extension name and any relevant settings.
	 */
	public function heights() {
		$css = &Eighteen_Tags_Public::$desktop_css;
		$pad = $this->get( 'pri-nav-height' );
		$pad = is_numeric( $pad ) ? $pad : 1.3;

		$button_background_color = eighteen_tags_sanitize_hex_color( get_theme_mod( 'eighteen_tags_button_background_color', apply_filters( 'eighteen_tags_default_button_background_color', '#60646c' ) ) );
		$css .= '.etp-nav-search .etp-nav-search-close{' . 'color:' . $button_background_color . '}';

		$css .=
			".main-navigation ul.menu > li > a, .main-navigation ul.nav-menu > li > a, .etp-nav-search a { padding-top: {$pad}em; padding-bottom: {$pad}em; }";
		$css .= ".eighteen-tags-pro-active .main-navigation .site-header-cart li:first-child { padding-top: {$pad}em; }";
		$css .= ".eighteen-tags-pro-active .main-navigation .site-header-cart .cart-contents { padding-top: 0; padding-bottom: {$pad}em; }";

		$logo_height = $this->get( 'logo-max-height', 100 );

		if ( $logo_height ) {
			$css .= ".site-header .custom-logo-link img, .site-header .logo-in-nav-anchor img { max-height: {$logo_height}px; }";
		}
	}

	/**
	 * Primary nav typography
	 */
	public function primary_nav_typo() {
		$t   = &$this;
		$css = &Eighteen_Tags_Public::$desktop_css;
		$css .= '#site-navigation {' .
		        'background-color:' . $t->get( 'pri-nav-bg-color' ) . ';' .
		        '}';
		$css .= '#site-navigation.main-navigation ul, #site-navigation.main-navigation ul li a, .eighteen-tags-pro-active .header-toggle {' .
		        'font-family:' . $t->get( 'pri-nav-font', 'Raleway' ) . ';' .
		        'font-size:' . $t->get( 'pri-nav-text-size' ) . 'px;' .
		        '}';
		$css .= '#site-navigation.main-navigation .primary-navigation ul li a, #site-navigation.main-navigation ul.site-header-cart li a, .eighteen-tags-pro-active .header-toggle {' .
		        'letter-spacing:' . $t->get( 'pri-nav-letter-spacing' ) . 'px;' .
		        'color:' . $t->get( 'pri-nav-text-color', '#353535' ) . ';' .
		        $t->font_style( $t->get( 'pri-nav-font-style' ) ) .
		        '}';
		$css .=
			'#site-navigation.main-navigation ul li.current-menu-parent a,' .
			'#site-navigation.main-navigation ul li.current-menu-item a {' .
			'color:' . $t->get( 'pri-nav-active-link-color' ) . ';' .
			'}';
		$css .= '#site-navigation.main-navigation .primary-navigation ul ul li a, #site-navigation.main-navigation .site-header-cart .widget_shopping_cart {' .
		        'color:' . $t->get( 'pri-nav-dd-text-color', '#ffffff' ) . ';' .
		        '}';
		$css .= '#site-navigation.main-navigation .site-header-cart .widget_shopping_cart, #site-navigation.main-navigation ul.menu ul {' .
		        'background-color:' . $t->get( 'pri-nav-dd-bg-color', '#000' ) . ';' .
		        '}';

		Eighteen_Tags_Public::$mobile_css .= '.handheld-navigation-container a, .handheld-navigation a {' .
						'font-family:' . $t->get( 'pri-nav-font', 'Raleway' ) . ';' .
						'font-size:' . $t->get( 'pri-nav-text-size' ) . 'px;' .
						'letter-spacing:' . $t->get( 'pri-nav-letter-spacing' ) . 'px;' .
						'color:' . $t->get( 'pri-nav-text-color', '#353535' ) . ';' .
						$t->font_style( $t->get( 'pri-nav-font-style' ) ) .
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

		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		$logo = $image[0];
		if ( ! $logo ) {
			$logo = get_template_directory_uri() . '/assets/logo.jpg';
		}
			$li_class = 'logo-in-nav-image';
			$logoHTML = ''
			            . '<a class="logo-in-nav-anchor" href="' . esc_url( home_url( '/' ) ) . '" '
			            . 'title="' . get_bloginfo( 'name' ) . '" rel="home" style="background-image:url(' . $logo . ');">'
			            . '</a>';

		$this->num_items = count( $items );
		$this->logo_index = $this->num_items / 2;

		return '<li class=" ' . $li_class . ' logo-in-nav-menu-item">' . $logoHTML . '</li>';
	}

	public function render_items( SimpleXMLElement $items, &$html ) {

		$i         = 0;
		$logo_html = $this->logo_html( $items );

		foreach ( $items as $item ) {
			$i++;

			if ( $this->logo_in_nav && $logo_html && $i > $this->logo_index ) {
				$html .= "</ul><ul class='menu nav-menu center-menu'>$logo_html</ul><ul class='menu nav-menu right-menu'>";
				$logo_html = false;
			};

			$html .= $item->asXML();

			if ( $i == $this->num_items ) {
				$html .= $this->search_menu_item();
			}
		}
	}

	public function search_menu_item() {
		if ( ! $this->get( 'remove-search-icon' ) ) {
			if ( false !== strpos( get_theme_mod( 'eighteen-tags-pro-nav-style', 'right' ), 'left-vertical' ) ) {
				$post_type_field = '';
				$search_pt = explode( ',', get_theme_mod( 'eighteen-tags-pro-search-post_type', 'post,page' ) );
				foreach( $search_pt as $pt ) {
					$post_type_field .= "<input type='hidden' name='post_type[]' value='{$pt}' />";
				}

				$html =
					'<li class="etp-search"><a>' .
					'<span class="etp-nav-search">' .
					'<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/'  ) ) . '">' .
					'<input type="search" class="search-field" placeholder="' .
					esc_attr__( 'Search&hellip;', 'eighteen-tags' ) .
					'" value="' . get_search_query() . '" name="s" title="' .
					esc_attr__( 'Search for:', 'eighteen-tags' ) . '" />' .
					'<input type="submit" value="&#xf002;" />' . $post_type_field .
					'</form></span></a></li>';
			} else {
				$html =
					'<li class="etp-search"><a><i class="fa fa-search"></i></a><ul><li>' .
					get_search_form( false ) . '</li></ul></li>';
			}

			return $html;
		}

		return '';
	}

	public function submenu_animation( $animation ) {
		$css = &$this->css;
		$animation_duration = array(
			'fade'   => '0.5s',
			'expand' => '0.5s',
			'slide'  => '0.7s',
			'flip'   => '0.34s',
		);
		$css .= '#site-navigation .primary-navigation .menu > li > ul { -webkit-transform-origin: 0 0 ; transform-origin: 0 0 ; -webkit-transition: height 500ms, -webkit-transform 0.5s; transition: height 500ms, transform 0.5s; }';

		if ( array_key_exists( $animation, $animation_duration ) ) {
			$css .=
				'#site-navigation .primary-navigation .menu > li > ul {' .
				"-webkit-animation-duration: {$animation_duration[ $animation ]};" .
				"-webkit-animation-name: sfProSubmenuAnimation-$animation;" .
				"animation-duration: {$animation_duration[ $animation ]};" .
				"animation-name: sfProSubmenuAnimation-$animation;" .
				'}';
		}
	}
} // End class