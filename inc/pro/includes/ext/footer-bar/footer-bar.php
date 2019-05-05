<?php
/**
 * Plugin Name:			Eighteen tags Footer Bar
 * Plugin URI:			http://pootlepress.com/eighteen-tags/
 * Description:			Add a full width widgetised region above the default Eighteen tags footer widget area.
 * Version:				1.0.1
 * Author:				pootlepress
 * Author URI:			http://pootlepress.com/
 * Requires at least:	4.0.0
 * Tested up to:		4.2.2
 *
 * Text Domain: eighteen-tags
 * Domain Path: /languages/
 *
 * @package Eighteen_Tags_Footer_Bar
 * @category Core
 * @author James Koster
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Returns the main instance of Eighteen_Tags_Footer_Bar to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Eighteen_Tags_Footer_Bar
 */
function Eighteen_Tags_Footer_Bar() {
	return Eighteen_Tags_Footer_Bar::instance();
} // End Eighteen_Tags_Footer_Bar()

Eighteen_Tags_Footer_Bar();

/**
 * Main Eighteen_Tags_Footer_Bar Class
 *
 * @class Eighteen_Tags_Footer_Bar
 * @version	1.0.0
 * @since 1.0.0
 * @package	Eighteen_Tags_Footer_Bar
 */
final class Eighteen_Tags_Footer_Bar {
	/**
	 * Eighteen_Tags_Footer_Bar The single instance of Eighteen_Tags_Footer_Bar.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	// Admin - Start
	/**
	 * The admin object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct() {
		$this->token 			= 'eighteen-tags';
		$this->plugin_url 		= PRO18_URL . '/includes/ext/footer-bar/';
		$this->plugin_path 		= PRO18_PATH . '/includes/ext/footer-bar/';
		$this->version 			= '1.0.1';

		add_action( 'init', array( $this, 'etfb_load_plugin_textdomain' ) );

		add_action( 'init', array( $this, 'etfb_setup' ) );
	}

	/**
	 * Main Eighteen_Tags_Footer_Bar Instance
	 *
	 * Ensures only one instance of Eighteen_Tags_Footer_Bar is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Eighteen_Tags_Footer_Bar()
	 * @return Main Eighteen_Tags_Footer_Bar instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function etfb_load_plugin_textdomain() {
		load_plugin_textdomain( 'eighteen-tags', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'eighteen-tags' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'eighteen-tags' ), '1.0.0' );
	}

	/**
	 * Setup all the things.
	 * Only executes if Eighteen tags or a child theme using Eighteen tags as a parent is active and the extension specific filter returns true.
	 * Child themes can disable this extension using the eighteen_tags_extension_boilerplate_enabled filter
	 * @return void
	 */
	public function etfb_setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'etfb_styles' ), 999 );
		add_action( 'customize_register', array( $this, 'etfb_customize_register' ) );
		add_action( 'customize_preview_init', array( $this, 'etfb_customize_preview_js' ) );
		$this->etfb_register_widget_area();
	}

	/**
	 * Eighteen tags Footer Bar Setup
	 * Set up the extension, create the widget region etc.
	 */
	function etfb_register_widget_area() {
		register_sidebar( array(
			'name'          => __( 'Footer Bar', 'eighteen-tags' ),
			'id'            => 'footer-bar-1',
			'description'   => '',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	/**
	 * Customizer Controls and settings
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function etfb_customize_register( $wp_customize ) {
		/**
	     * Add a new section
	     */
        $wp_customize->add_section( 'etfb_section' , array(
		    'title'      	=> __( 'Footer Bar', 'eighteen-tags' ),
		    'priority'   	=> 55,
	        'panel'         => 'etp-footer',
		) );

		$wp_customize->add_setting( 'etp_footer_bar', array(
			'default'       => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'          => 'option'
		) );
		$wp_customize->add_control( 'etp_footer_bar', array(
			'section'		=> 'etfb_section',
			'label'			=> __( 'Enable footer bar', 'eighteen-tags' ),
			'type'		=> 'checkbox',
			'priority'		=> 5,
		) );

		/**
		 * Background image
		 */
		$wp_customize->add_setting( 'etfb_background_image', array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url_raw',
		) );

		$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'etfb_background_image', array(
			'label'			=> __( 'Background image', 'eighteen-tags' ),
			'section'		=> 'etfb_section',
			'settings'		=> 'etfb_background_image',
			'priority'		=> 10,
		) ) );

		/**
		 * Background color
		 */
		$wp_customize->add_setting( 'etfb_background_color', array(
			'default'			=> apply_filters( 'eighteen_tags_default_header_background_color', '#ffffff' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'postMessage', // Refreshes instantly via js. See customizer.js. (default = refresh).
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'etfb_background_color', array(
			'label'			=> __( 'Background color', 'eighteen-tags' ),
			'section'		=> 'etfb_section',
			'settings'		=> 'etfb_background_color',
			'priority'		=> 15,
		) ) );

		/**
		 * Heading color
		 */
		$wp_customize->add_setting( 'etfb_heading_color', array(
			'default'			=> apply_filters( 'etfb_default_heading_color', '#ffffff' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'postMessage', // Refreshes instantly via js. See customizer.js. (default = refresh).
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'etfb_heading_color', array(
			'label'			=> __( 'Heading color', 'eighteen-tags' ),
			'section'		=> 'etfb_section',
			'settings'		=> 'etfb_heading_color',
			'priority'		=> 20,
		) ) );

		/**
		 * Text color
		 */
		$wp_customize->add_setting( 'etfb_text_color', array(
			'default'			=> apply_filters( 'eighteen_tags_default_header_text_color', '#9aa0a7' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'postMessage', // Refreshes instantly via js. See customizer.js. (default = refresh).
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'etfb_text_color', array(
			'label'			=> __( 'Text color', 'eighteen-tags' ),
			'section'		=> 'etfb_section',
			'settings'		=> 'etfb_text_color',
			'priority'		=> 30,
		) ) );

		/**
		 * Link color
		 */
		$wp_customize->add_setting( 'etfb_link_color', array(
			'default'			=> apply_filters( 'eighteen_tags_default_header_link_color', '#ffffff' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'etfb_link_color', array(
			'label'			=> __( 'Link color', 'eighteen-tags' ),
			'section'		=> 'etfb_section',
			'settings'		=> 'etfb_link_color',
			'priority'		=> 40,
		) ) );
	}

	/**
	 * Enqueue CSS and custom styles.
	 * @since   1.0.0
	 * @return  void
	 */
	public function etfb_styles() {
		if ( is_active_sidebar( 'footer-bar-1' ) && get_option( 'etp_footer_bar' ) ) {
			add_action( 'eighteen_tags_before_footer', array( $this, 'etfb_footer_bar' ), 10 );
			wp_enqueue_style( 'sfb-styles', $this->plugin_url . '/assets/css/front.css' );

			$footer_bar_bg_image = esc_url( get_theme_mod( 'etfb_background_image', '' ) );
			$footer_bar_bg       = eighteen_tags_sanitize_hex_color( get_theme_mod( 'etfb_background_color', apply_filters( 'eighteen_tags_default_header_background_color', '#ffffff' ) ) );
			$footer_bar_text     = eighteen_tags_sanitize_hex_color( get_theme_mod( 'etfb_text_color', apply_filters( 'eighteen_tags_default_header_text_color', '#9aa0a7' ) ) );
			$footer_bar_headings = eighteen_tags_sanitize_hex_color( get_theme_mod( 'etfb_heading_color', apply_filters( 'etfb_default_heading_color', '#ffffff' ) ) );
			$footer_bar_links    = eighteen_tags_sanitize_hex_color( get_theme_mod( 'etfb_link_color', apply_filters( 'eighteen_tags_default_header_link_color', '#ffffff' ) ) );

			$etfb_style = '
				.sfb-footer-bar {
					background-color: ' . $footer_bar_bg . ';
					' . ( $footer_bar_bg_image ? 'background-image: url(' . $footer_bar_bg_image . ');' : '' ) . '
				}

				.sfb-footer-bar .widget {
					color: ' . $footer_bar_text . ';
				}

				.sfb-footer-bar .widget h1,
				.sfb-footer-bar .widget h2,
				.sfb-footer-bar .widget h3,
				.sfb-footer-bar .widget h4,
				.sfb-footer-bar .widget h5,
				.sfb-footer-bar .widget h6 {
					color: ' . $footer_bar_headings . ';
				}

				.sfb-footer-bar .widget a {
					color: ' . $footer_bar_links . ';
				}';

			wp_add_inline_style( 'sfb-styles', $etfb_style );
		}
	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @since  1.0.0
	 */
	public function etfb_customize_preview_js() {
			wp_enqueue_script( 'sfb-customizer', $this->plugin_url . '/assets/js/customizer.min.js', array( 'customize-preview' ), '1.1', true );
	}

	/**
	 * Footer bar display
	 */
	public function etfb_footer_bar() {
		echo '<div class="sfb-footer-bar"><div class="col-full">';
		dynamic_sidebar( 'footer-bar-1' );
		echo '</div></div>';
	}
} // End Class
