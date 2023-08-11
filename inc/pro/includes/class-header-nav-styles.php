<?php
require_once 'class-primary-nav-styles.php';

/**
 * Eighteen_Tags_Header_Nav Class
 *
 * @class Eighteen_Tags_Header_Nav
 * @version	1.0.0
 * @since 1.0.0
 * @package	Eighteen_Tags
 */
class Eighteen_Tags_Header_Nav extends Eighteen_Tags_Primary_Navigation {

	protected $css = '';
	protected $logo_url;

	/**
	 * Enqueue CSS and custom styles.
	 * @since  1.0.0
	 * @return string CSS
	 */
	public function styles() {
		$t = &$this;

		$t->css .= "\n/*Title Tagline*/\n";
		$t->title_tagline();

		$t->css .= "\n/*Primary navigation*/\n";
		$t->primary_nav_style( $t->get( 'nav-style', 'right' ) );
		$t->primary_nav_typo();
		$t->submenu_animation( $t->get( 'pri-nav-dd-animation' ) );

		$t->mobile_nav();

		//Add search icon and maybe logo in nav
		add_filter( 'wp_nav_menu_items', array( $this, 'logo_in_nav' ), 10, 2 );

		//Header cart color
		$t->css .= '.eighteen-tags-pro-active .site-header-cart .cart-contents { color: ' . $t->get( 'header-wc-cart-color', '' ) . '; }';

		$t->css .= '.eighteen-tags-pro-active #masthead, .eighteen-tags-pro-active .header-toggle { background-color:' . $t->get( 'header-bg-color' ) . ';}';

		$t->css .= "\n/*Secondary navigation*/\n";
		$t->secondary_nav_typo();
		return $this->css;
	}

	/**
	 * Primary nav typography
	 */
	public function title_tagline() {
		$t   = &$this;
		$css = &$t->css . '/* Title tagline styles */';

		$font = $t->get( 'site-title-font-size' ) ? 'font-size:' . ( 2.5 * $t->get( 'site-title-font-size' ) ) . 'px;' : '';

		$css .= '.eighteen-tags-pro-active .site-branding .site-title, .eighteen-tags-pro-active .site-branding .site-title a {' .
		        'font-family:' . $t->get( 'site-title-font', 'Raleway' ) . ';' .
		        'color:' . $t->get( 'site-title-color', '#353535' ) . ';' .
		        $t->font_style( $t->get( 'site-title-font-style' ) ) .
		        $font . '}';

		$font = $t->get( 'site-tagline-font-size' ) ? 'font-size:' . ( 1.6 * $t->get( 'site-tagline-font-size' ) ) . 'px;' : '';

		$css .= '.eighteen-tags-pro-active .site-branding .site-description {' .
		        'font-family:' . $t->get( 'site-tagline-font', 'Merriweather' ) . ';' .
		        'color:' . $t->get( 'site-tagline-color', '#565656' ) . ';' .
		        $t->font_style( $t->get( 'site-tagline-font-style' ) ) .
		        $font . '}';
	}

	/**
	 * Primary nav typography
	 */
	public function secondary_nav_typo() {
		$t = &$this;
		$css = &$t->css;
		$css .= '.eighteen-tags-pro-active nav.secondary-navigation {' .
		        'background-color:' . $t->get( 'sec-nav-bg-color' ) . ';' .
		        '}';
		$css .= '.eighteen-tags-pro-active nav.secondary-navigation a {font-family:' . $t->get( 'sec-nav-font' ) . ';}';
		$css .=
			'.eighteen-tags-pro-active nav.secondary-navigation ul,' .
			'.eighteen-tags-pro-active nav.secondary-navigation a,' .
			'.eighteen-tags-pro-active nav.secondary-navigation a:hover {' .
			'font-size:' . $t->get( 'sec-nav-text-size' ) . 'px;' .
			'letter-spacing:' . $t->get( 'sec-nav-letter-spacing' ) . 'px;' .
			'color:' . $t->get( 'sec-nav-text-color', '#fff' ) . ';' .
			$t->font_style( $t->get( 'sec-nav-font-style' ) ) .
			'}';

		$css .= '.eighteen-tags-pro-active nav.secondary-navigation ul li.current_page_item a,' .
		        '.eighteen-tags-pro-active nav.secondary-navigation ul li.current_page_item a:hover {' .
		        'color:' . $t->get( 'sec-nav-active-link-color' ) . ';' .
		        '}';
		$css .= '.eighteen-tags-pro-active nav.secondary-navigation ul ul li a,' .
		        '.eighteen-tags-pro-active nav.secondary-navigation ul ul li a:hover {' .
		        'color:' . $t->get( 'sec-nav-dd-text-color' ) . ';' .
		        '}';

		$css .= '.eighteen-tags-pro-active nav.secondary-navigation ul.menu ul {' .
		        'background-color:' . $t->get( 'sec-nav-dd-bg-color' ) . ';' .
		'}';
	}

	/**
	 * Display Secondary Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function secondary_navigation() {
		$container = $container_close = '';
		if ( ! $this->get( 'sec-nav-full' ) ) {
			$container = '<div class="col-full">';
			$container_close = '</div>';
		}
		?>
		<nav class="secondary-navigation " role="navigation" aria-label="<?php _e( 'Secondary Navigation', 'eighteen-tags' ); ?>">
			<?php
			echo $container;
			do_action( 'eighteen_tags_pro_in_sec_nav' );
			if ( 'right' == $this->get( 'align-social-info' ) ) {
				?> <style> .eighteen-tags-pro-active .secondary-nav-menu { float: left; } </style> <?php
				wp_nav_menu( array(
					'theme_location' => 'secondary', 'fallback_cb' => '', 'container_class' => 'secondary-nav-menu',
				) );
				echo $this->sec_nav_icons( 'right' );
			} else {
				echo $this->sec_nav_icons( $this->get( 'align-social-info' ) );
				wp_nav_menu( array(
					'theme_location' => 'secondary', 'fallback_cb' => '', 'container_class'	=> 'secondary-nav-menu',
				) );
			}
			echo $container_close;
			?>
		</nav><!-- #site-navigation -->
		<?php
	}

	public function sec_nav_icons( $float = 'left' ) {
		$phone = $this->get( 'phone-num' );
		$email = $this->get( 'email' );
		$pinterest  = $this->get( 'pinterest' );
		$youtube    = $this->get( 'youtube' );

		$return = $this->sec_nav_icons_container( $float );

		if ( $phone ) { $return .= "<a href='tel:$phone' class='contact-info'><i class='fa fa-phone'></i>$phone</a>"; }

		if ( $email ) {
			$return .= "<a class='contact-info' href='mailto:{$email}'><i class='fa fa-envelope'></i>$email</a>";
		}

		$this->sec_nav_icons_social( $return );

		if ( $pinterest ) { $return .= "<a target='_blank' href='$pinterest'><i class='fa fa-pinterest'></i></a>"; }

		if ( $youtube ) { $return .= "<a target='_blank' href='$youtube'><i class='fa fa-youtube-play'></i></a>"; }

		if ( 'center' == $float ) {
			$return .= "</div>";
		}

		return $return . '</div>';
	}

	public function sec_nav_icons_container( $float ) {
		if ( 'center' == $float ) {
			return "<div style='float:left;position:relative;left:50%' ><div style='position: relative;left: -50%;' class='social-info'>";
		} elseif ( 'right' == $float ) {
			return "<div style='float:right;' class='social-info'>";
		} else {
			return "<div style='float:left;' class='social-info'>";
		}
	}

	public function sec_nav_icons_social( &$ret ) {
		$facebook   = $this->get( 'facebook' );
		$twitter    = $this->get( 'twitter' );
		$googleplus = $this->get( 'googleplus' );
		$linkedin   = $this->get( 'linkedin' );
		$instagram  = $this->get( 'instagram' );

		if ( $facebook )   { $ret .= "<a target='_blank' href='$facebook'><i class='fa fa-facebook'></i></a>"; }

		if ( $twitter )    { $ret .= "<a target='_blank' href='$twitter'><i class='fa fa-twitter'></i></a>"; }

		if ( $googleplus ) { $ret .= "<a target='_blank' href='$googleplus'><i class='fa fa-google-plus'></i></a>"; }

		if ( $linkedin )   { $ret .= "<a target='_blank' href='$linkedin'><i class='fa fa-linkedin'></i></a>"; }

		if ( $instagram )   { $ret .= "<a target='_blank' href='$instagram'><i class='fa fa-instagram'></i></a>"; }
	}

	public function mobile_nav() {
		$css = &Eighteen_Tags_Public::$mobile_css;
		if ( $this->get( 'mob-hide-logo' ) ) {
			$css .= '.site-header .site-logo-anchor, .site-header .custom-logo-link { display: none; }';
		}
		$css .= '#site-navigation a.menu-toggle, .eighteen-tags-pro-active .site-header-cart .cart-contents {';
		$css .= 'color: ' . $this->get( 'mob-menu-icon-color', '#000' ) . ';';
		$css .= '}';
		$css .= '#site-navigation .handheld-navigation{';
		$css .= 'background-color: ' . $this->get( 'mob-menu-bg-color', '#000000' ) . ';';
		$css .= '}';
		$css .= '#site-navigation .handheld-navigation li a {';
		$css .= 'color: ' . $this->get( 'mob-menu-font-color', '#ffffff' ) . ';';
		$css .= '}';
	}
} // End class