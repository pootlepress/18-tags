<?php
/**
 * Plugin Name:			Storefront Header Bar
 * Plugin URI:			http://woothemes.com/storefront/
 * Description:			Add a full width widgetised region above the default Storefront header widget area.
 * Version:				1.0.1
 * Author:				Pootlepress
 * Author URI:			http://pootlepress.com/
 * Requires at least:	4.0.0
 * Tested up to:		4.2.2
 *
 * Text Domain: storefront-header-bar
 * Domain Path: /languages/
 *
 * @package Storefront_Header_Bar
 * @category Core
 * @author Shramee
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Returns the main instance of Storefront_Header_Bar to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Storefront_Header_Bar
 */
function Storefront_Header_Bar() {
	return Storefront_Header_Bar::instance();
} // End Storefront_Header_Bar()

Storefront_Header_Bar();

/**
 * Main Storefront_Header_Bar Class
 *
 * @class Storefront_Header_Bar
 * @version	1.0.0
 * @since 1.0.0
 * @package	Storefront_Header_Bar
 */
final class Storefront_Header_Bar {
	/**
	 * Storefront_Header_Bar The single instance of Storefront_Header_Bar.
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
		$this->token 			= 'storefront-header-bar';
		$this->plugin_url 		= plugin_dir_url( __FILE__ );
		$this->plugin_path 		= plugin_dir_path( __FILE__ );
		$this->version 			= '1.0.1';

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'shb_load_plugin_textdomain' ) );

		add_action( 'init', array( $this, 'shb_setup' ) );
	}

	/**
	 * Main Storefront_Header_Bar Instance
	 *
	 * Ensures only one instance of Storefront_Header_Bar is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Storefront_Header_Bar()
	 * @return Main Storefront_Header_Bar instance
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
	public function shb_load_plugin_textdomain() {
		load_plugin_textdomain( 'storefront-header-bar', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 * @access  private
	 * @since   1.0.0
	 * @return  void
	 */
	private function _log_version_number() {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	}

	/**
	 * Setup all the things.
	 * Only executes if Storefront or a child theme using Storefront as a parent is active and the extension specific filter returns true.
	 * Child themes can disable this extension using the storefront_extension_boilerplate_enabled filter
	 * @return void
	 */
	public function shb_setup() {
		$theme = wp_get_theme();

		if ( 'Storefront' == $theme->name || 'storefront' == $theme->template && apply_filters( 'storefront_footer_bar_supported', true ) ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'shb_styles' ), 999 );
			add_action( 'customize_register', array( $this, 'shb_customize_register' ) );
			add_action( 'storefront_before_header', array( $this, 'shb_header_bar' ), 10 );
			$this->shb_register_widget_area();
		}
	}

	/**
	 * Storefront Header Bar Setup
	 * Set up the extension, create the widget region etc.
	 */
	function shb_register_widget_area() {
		register_sidebar( array(
			'name'          => __( 'Header Bar', 'storefront-header-bar' ),
			'id'            => 'header-bar-1',
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
	public function shb_customize_register( $wp_customize ) {
		/**
	     * Add a new section
	     */
        $wp_customize->add_section( 'shb_section' , array(
		    'title'      	=> __( 'Header Bar', 'storefront-extention-boilerplate' ),
		    'priority'   	=> 55,
		) );

		$wp_customize->add_setting( 'sfp_header_bar', array(
			'default'       => '',
			'type'          => 'option'
		) );
		$wp_customize->add_control( 'sfp_header_bar', array(
			'section'		=> 'shb_section',
			'label'			=> __( 'Enable header bar', 'storefront' ),
			'type'		=> 'checkbox',
			'priority'		=> 5,
		) );

		/**
		 * Background image
		 */
		$wp_customize->add_setting( 'shb_background_image', array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url_raw',
		) );

		$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'shb_background_image', array(
			'label'			=> __( 'Background image', 'storefront-header-bar' ),
			'section'		=> 'shb_section',
			'settings'		=> 'shb_background_image',
			'priority'		=> 10,
		) ) );

		/**
		 * Background color
		 */
		$wp_customize->add_setting( 'shb_background_color', array(
			'default'			=> apply_filters( 'storefront_default_header_background_color', '#2c2d33' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shb_background_color', array(
			'label'			=> __( 'Background color', 'storefront-header-bar' ),
			'section'		=> 'shb_section',
			'settings'		=> 'shb_background_color',
			'priority'		=> 15,
		) ) );

		/**
		 * Heading color
		 */
		$wp_customize->add_setting( 'shb_heading_color', array(
			'default'			=> apply_filters( 'shb_default_heading_color', '#ffffff' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shb_heading_color', array(
			'label'			=> __( 'Heading color', 'storefront-header-bar' ),
			'section'		=> 'shb_section',
			'settings'		=> 'shb_heading_color',
			'priority'		=> 20,
		) ) );

		/**
		 * Text color
		 */
		$wp_customize->add_setting( 'shb_text_color', array(
			'default'			=> apply_filters( 'storefront_default_header_text_color', '#9aa0a7' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shb_text_color', array(
			'label'			=> __( 'Text color', 'storefront-header-bar' ),
			'section'		=> 'shb_section',
			'settings'		=> 'shb_text_color',
			'priority'		=> 30,
		) ) );

		/**
		 * Link color
		 */
		$wp_customize->add_setting( 'shb_link_color', array(
			'default'			=> apply_filters( 'storefront_default_header_link_color', '#ffffff' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shb_link_color', array(
			'label'			=> __( 'Link color', 'storefront-header-bar' ),
			'section'		=> 'shb_section',
			'settings'		=> 'shb_link_color',
			'priority'		=> 40,
		) ) );

	}

	/**
	 * Enqueue CSS and custom styles.
	 * @since   1.0.0
	 * @return  void
	 */
	public function shb_styles() {
		wp_enqueue_style( 'sfb-styles', plugins_url( '/assets/css/style.css', __FILE__ ) );

		$footer_bar_bg_image 	= esc_url( get_theme_mod( 'shb_background_image', '' ) );
		$footer_bar_bg 			= storefront_sanitize_hex_color( get_theme_mod( 'shb_background_color', apply_filters( 'storefront_default_header_background_color', '#2c2d33' ) ) );
		$footer_bar_text 		= storefront_sanitize_hex_color( get_theme_mod( 'shb_text_color', apply_filters( 'storefront_default_header_text_color', '#9aa0a7' ) ) );
		$footer_bar_headings 	= storefront_sanitize_hex_color( get_theme_mod( 'shb_heading_color', apply_filters( 'shb_default_heading_color', '#ffffff' ) ) );
		$footer_bar_links 		= storefront_sanitize_hex_color( get_theme_mod( 'shb_link_color', apply_filters( 'storefront_default_header_link_color', '#ffffff' ) ) );

		$shb_style = '
		.shb-header-bar {
			background-color: ' . $footer_bar_bg . ';
			background-image: url(' . $footer_bar_bg_image . ');
		}

		.shb-header-bar .widget {
			color: ' . $footer_bar_text . ';
		}

		.shb-header-bar .widget h1,
		.shb-header-bar .widget h2,
		.shb-header-bar .widget h3,
		.shb-header-bar .widget h4,
		.shb-header-bar .widget h5,
		.shb-header-bar .widget h6 {
			color: ' . $footer_bar_headings . ';
		}

		.shb-header-bar .widget a {
			color: ' . $footer_bar_links . ';
		}';

		wp_add_inline_style( 'sfb-styles', $shb_style );
	}

	/**
	 * Footer bar display
	 */
	public function shb_header_bar() {
		if ( is_active_sidebar( 'header-bar-1' ) && get_option( 'sfp_header_bar' ) ) {
			echo '<div class="shb-header-bar"><div class="col-full">';
				dynamic_sidebar( 'header-bar-1' );
			echo '</div></div>';
		}
	}
} // End Class
