<?php
/**
 * Eighteen tags class
 * @developer http://wpdevelopment.me <shramee@wpdevelopment.me>
 */


/**
 * Eighteen_Tags_Pro_Public Class
 *
 * @class Eighteen_Tags_Pro_Public
 * @version	1.0.0
 * @since 1.0.0
 * @package	Eighteen_Tags_Pro
 */
final class Eighteen_Tags_Pro_Public extends Eighteen_Tags_Pro_Abstract {

	public static $desktop_css = '';

	public static $mobile_css = '';


	/** @var Eighteen_Tags_Pro_Header_Nav Instance */
	public $header_nav_styles;

	/** @var Eighteen_Tags_Pro_Content_Styles Instance */
	public $content_styles;

	/** @var Eighteen_Tags_Pro_Footer_Styles Instance */
	public $footer_styles;

	protected $header;

	/**
	 * Called by parent::__construct
	 * Do initialization here
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function init(){

		add_filter( 'home_template', array( $this, 'blog_layout' ) );
		add_filter( 'archive_template', array( $this, 'blog_layout' ) );

		add_filter( 'single_template', array( $this, 'post_layout' ) );

		//Enqueue scripts and styles
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts_styles' ), 999 );
		//Add plugin classes to body
		add_filter( 'body_class', array( $this, 'body_class' ) );
		//exclude/include products in search
		add_filter( 'pre_get_posts', array( $this, 'pre_get_posts' ), 999 );
		//Products per page
		add_filter( 'eighteen_tags_products_per_page', array( $this, 'products_per_page' ), 999 );
		add_filter( 'pootlepb_render', array( $this, 'page_builder_styles' ) );
		add_filter( 'siteorigin_panels_render', array( $this, 'page_builder_styles' ) );
		add_filter( 'siteorigin_panels_render', array( $this, 'page_builder_styles' ) );
	}

	/**
	 * Enqueue CSS and custom styles.
	 * @since   1.0.0
	 * @return  void
	 */
	public function scripts_styles() {

		wp_dequeue_script( 'eighteen-tags-navigation' );
		wp_enqueue_style( 'etp-fawesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
		wp_enqueue_script( 'etp-skrollr', get_template_directory_uri() . '/js/skrollr.min.js', array( 'jquery' ) );
		wp_enqueue_style( 'etp-styles', $this->plugin_url . '/assets/css/front.css' );
		wp_enqueue_script( 'etp-public-script', $this->plugin_url . '/assets/js/public.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'jquery-masonry' );

		$this->header_nav_styles = new Eighteen_Tags_Pro_Header_Nav( $this->token, $this->plugin_path, $this->plugin_url );
		$this->content_styles = new Eighteen_Tags_Pro_Content_Styles( $this->token, $this->plugin_path, $this->plugin_url );
		$this->footer_styles = new Eighteen_Tags_Pro_Footer_Styles( $this->token, $this->plugin_path, $this->plugin_url );

		$this->features();

		$css = "/*-----STOREFRONT PRO-----*/";

		$css .= $this->header_nav_styles->styles();

		$css .= $this->content_styles->styles();

		$css .= $this->footer_styles->styles();

		$css .= '@media only screen and (min-width: 768px) {';

		$css .= self::$desktop_css;

		$css .= '}';

		$css .= '@media only screen and (max-width: 768px) {';

		$css .= self::$mobile_css;

		$css .= '}';

		if ( function_exists( 'et_pb_is_pagebuilder_used' ) && et_pb_is_pagebuilder_used( get_the_ID() ) ) {
			$css .= '#content > .col-full { max-width: none; margin: 0; }';
			$css .= strip_tags( $this->page_builder_styles() );
		}

		wp_add_inline_style( 'etp-styles', $css );

		$fonts_options = explode( ':|:', get_theme_mod( 'etp-google-fonts', '' ) );
		$load_fonts = array( 'Montserrat' );

		foreach ( $fonts_options as $option ) {
			$font = get_theme_mod( $option );
			if ( ! empty( $font ) && false === strpos( $font, 'serif' ) ) {
				$load_fonts[] = $font;
			}
		}

		wp_enqueue_style( 'etp-google-fonts', '//fonts.googleapis.com/css?family=' . join( '%7C', $load_fonts ) );

	}

	public function features() {

		new Eighteen_Tags_Add_Nav_Icons();

		remove_action( 'eighteen_tags_loop_post', 'eighteen_tags_post_content', 30 );
		add_action( 'eighteen_tags_loop_post', array( $this->content_styles, 'content' ), 30 );

		if ( $this->get( 'header-sticky' ) ) {
			wp_enqueue_script( 'etp-sticky-header', $this->plugin_url . '/assets/js/sticky-header.js', array( 'jquery' ) );
		}

		if ( 'full' == get_theme_mod( 'eighteen_tags_layout', 'full' ) ) {
			remove_action( 'eighteen_tags_sidebar', 'eighteen_tags_get_sidebar' );
		}

		// Infinite scroll
		if ( $this->get( 'wc-infinite-scroll' ) ) {
			add_action( 'woocommerce_before_shop_loop', array( $this, 'infinite_scroll_wrapper' ), 7 );
			add_action( 'woocommerce_after_shop_loop', array( $this, 'infinite_scroll_wrapper_close' ), 50 );
			wp_enqueue_script( 'jscroll', $this->plugin_url . '/assets/js/jquery.jscroll.min.js', array( 'jquery' ) );
		}

		remove_action( 'eighteen_tags_header', 'eighteen_tags_secondary_navigation', 30 );
		add_action( 'eighteen_tags_before_header', array( $this->header_nav_styles, 'secondary_navigation' ) );

	}

	/**
	 * Adds pb page styles to pb html
	 * @param string $html page builder HTML
	 * @return string pb html with pb page styles
	 * @filter pootlepb_render
	 */
	function page_builder_styles( $html = '' ) {
		return $html . '
	<style>
		.etp-nav-styleleft-vertical #content div.col-full { padding-top: 0; }
		.home.blog .site-header, .home.post-type-archive-product .site-header,
		.home.page:not(.page-template-template-homepage) .site-header, .eighteen-tags-pro-active .site-header,
		.eighteen-tags-pro-active .woocommerce-breadcrumb, .eighteen-tags-pro-active .no-wc-breadcrumb .site-header { margin-bottom: 0; }
		.eighteen-tags-pro-active .hentry .entry-header { display: none; }
		.eighteen-tags-pro-active #secondary { margin-top: 4.236em; }
		.eighteen-tags-pro-active .page.hentry { margin: 0; padding: 0; border: none; }
		.eighteen-tags-pro-active .site-main { margin: 0; }
		.eighteen-tags-pro-active .content-area { margin: 0; }
    </style>';
	}

	/**
	 * Specifies the number of products on the shop page
	 * @param int $num Number of products per page
	 * @return int Number of products per page
	 * @filter eighteen_tags_products_per_page
	 * @since 1.0.0
	 */
	public function products_per_page( $num ) {
		$per_page = $this->get( 'wc-shop-products' );

		if ( $per_page ) {
			return $per_page;
		} else {
			return $num;
		}
	}

	/**
	 * Removes or adds products CPT in search
	 * @param WP_Query $query
	 */
	public function pre_get_posts( $query ) {
		if ( $query->is_main_query() ) {
			global $etp_blog_grid;
			if ( $query->is_search && ! empty( $_GET['post_type'] ) ) {
				$post_types = $_GET['post_type'];
				$query->set( 'post_type', $post_types );
			}

			$post_archive = $query->is_category() || $query->is_tag() || $query->is_home();
			if ( $post_archive ) {
				$etp_blog_grid = explode( ',', $this->get( 'blog-grid', '1,10' ) );
				$per_page      = array_product( $etp_blog_grid );
				if ( $this->get( 'blog-layout', 'left-image' ) && $per_page ) {
					$query->set( 'posts_per_page', $per_page );
				}
			}
		}
	}

	/**
	 * Eighteen tags Pro Body Class
	 * Adds a class based on the extension name and any relevant settings.
	 */
	public function body_class( $classes ) {
		$classes[] = 'layout-' . filter_input( INPUT_GET, 'layout' );
		$classes[] = 'eighteen-tags-pro-active';
		$classes[] = 'etp-nav-style' . $this->get( 'nav-style' );
		return $classes;
	}

	/**
	 * Filters the blog template
	 * @return string Template path
	 */
	function blog_layout( $template ) {
		$layout = $this->get( 'blog-layout', 'left-image' );
		$dir = dirname( __FILE__ );

		if ( ! empty( $layout ) && file_exists( "$dir/template/home-{$layout}.php" ) ) {
			global $etp_blog_grid, $etp_blog_across, $etp_blog_down;
			$etp_blog_across = $etp_blog_grid[0];
			$etp_blog_down   = $etp_blog_grid[1];
			return  "$dir/template/home-{$layout}.php";
		} else {
			return $template;
		}
	}

	/**
	 * Filters the blog template
	 * @return string Template path
	 */
	function post_layout( $template ) {
		$layout = get_option( 'etp_post_layout' );
		$dir = dirname( __FILE__ );

		if ( ! empty( $layout ) && file_exists( "$dir/template/single-{$layout}.php" ) ) {
			return "$dir/template/single-{$layout}.php";
		} else {
			return $template;
		}
	}

	/**
	 * Infinite scroll wrapper
	 * @return void
	 */
	function infinite_scroll_wrapper() {
		echo '<div class="scroll-wrap">';
	}

	/**
	 * Infinite scroll wrapper close
	 * @return void
	 */
	function infinite_scroll_wrapper_close() {
		echo '</div>';
	}
} // End class