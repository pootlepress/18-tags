<?php
/**
 * Plugin Name:			Eighteen tags Header Bar
 * Plugin URI:			http://pootlepress.com/eighteen-tags/
 * Description:			Add a full width widgetised region above the default Eighteen tags header widget area.
 * Version:				1.0.1
 * Author:				Pootlepress
 * Author URI:			http://pootlepress.com/
 * Requires at least:	4.0.0
 * Tested up to:		4.2.2
 *
 * Text Domain: eighteen-tags
 * Domain Path: /languages/
 *
 * @package Eighteen_Tags_Header_Bar
 * @category Core
 * @author Shramee
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Returns the main instance of Eighteen_Tags_Header_Bar to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Eighteen_Tags_Header_Bar
 */
function Eighteen_Tags_Header_Bar() {
	return Eighteen_Tags_Header_Bar::instance();
} // End Eighteen_Tags_Header_Bar()

Eighteen_Tags_Header_Bar();

/**
 * Main Eighteen_Tags_Header_Bar Class
 *
 * @class Eighteen_Tags_Header_Bar
 * @version	1.0.0
 * @since 1.0.0
 * @package	Eighteen_Tags_Header_Bar
 */
final class Eighteen_Tags_Header_Bar {
	/**
	 * Eighteen_Tags_Header_Bar The single instance of Eighteen_Tags_Header_Bar.
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
		$this->plugin_url 		= PRO18_URL . '/includes/ext/header-bar/';
		$this->plugin_path 		= plugin_dir_path( __FILE__ );
		$this->version 			= '1.0.1';

		add_action( 'init', array( $this, 'shb_load_plugin_textdomain' ) );

		add_action( 'init', array( $this, 'shb_setup' ) );
	}

	/**
	 * Main Eighteen_Tags_Header_Bar Instance
	 *
	 * Ensures only one instance of Eighteen_Tags_Header_Bar is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Eighteen_Tags_Header_Bar()
	 * @return Main Eighteen_Tags_Header_Bar instance
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
	public function shb_setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'shb_styles' ), 999 );
		add_action( 'customize_register', array( $this, 'shb_customize_register' ) );
		add_action( 'eighteen_tags_before_header', array( $this, 'shb_header_bar' ), 10 );
		$this->shb_register_widget_area();
	}

	/**
	 * Eighteen tags Header Bar Setup
	 * Set up the extension, create the widget region etc.
	 */
	function shb_register_widget_area() {
		register_sidebar( array(
			'name'          => __( 'Header Bar', 'eighteen-tags' ),
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
		    'title'      	=> __( 'Header Bar', 'eighteen-tags' ),
		    'priority'   	=> 55,
		    'panel'         => 'etp-header',
		) );

		$wp_customize->add_setting( 'etp_header_bar', array(
			'default'       => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'          => 'option'
		) );
		$wp_customize->add_control( 'etp_header_bar', array(
			'section'		=> 'shb_section',
			'label'			=> __( 'Enable header bar', 'eighteen-tags' ),
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
			'label'			=> __( 'Background image', 'eighteen-tags' ),
			'section'		=> 'shb_section',
			'settings'		=> 'shb_background_image',
			'priority'		=> 10,
		) ) );

		/**
		 * Background color
		 */
		$wp_customize->add_setting( 'shb_background_color', array(
			'default'			=> apply_filters( 'eighteen_tags_default_header_background_color', '#ffffff' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shb_background_color', array(
			'label'			=> __( 'Background color', 'eighteen-tags' ),
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
			'label'			=> __( 'Heading color', 'eighteen-tags' ),
			'section'		=> 'shb_section',
			'settings'		=> 'shb_heading_color',
			'priority'		=> 20,
		) ) );

		/**
		 * Text color
		 */
		$wp_customize->add_setting( 'shb_text_color', array(
			'default'			=> apply_filters( 'eighteen_tags_default_header_text_color', '#9aa0a7' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shb_text_color', array(
			'label'			=> __( 'Text color', 'eighteen-tags' ),
			'section'		=> 'shb_section',
			'settings'		=> 'shb_text_color',
			'priority'		=> 30,
		) ) );

		/**
		 * Link color
		 */
		$wp_customize->add_setting( 'shb_link_color', array(
			'default'			=> apply_filters( 'eighteen_tags_default_header_link_color', '#ffffff' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shb_link_color', array(
			'label'			=> __( 'Link color', 'eighteen-tags' ),
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
		wp_enqueue_style( 'sfb-styles', $this->plugin_url . '/assets/css/front.css' );

		$footer_bar_bg_image 	= esc_url( get_theme_mod( 'shb_background_image', '' ) );
		$footer_bar_bg 			= eighteen_tags_sanitize_hex_color( get_theme_mod( 'shb_background_color', apply_filters( 'eighteen_tags_default_header_background_color', '#ffffff' ) ) );
		$footer_bar_text 		= eighteen_tags_sanitize_hex_color( get_theme_mod( 'shb_text_color', apply_filters( 'eighteen_tags_default_header_text_color', '#9aa0a7' ) ) );
		$footer_bar_headings 	= eighteen_tags_sanitize_hex_color( get_theme_mod( 'shb_heading_color', apply_filters( 'shb_default_heading_color', '#ffffff' ) ) );
		$footer_bar_links 		= eighteen_tags_sanitize_hex_color( get_theme_mod( 'shb_link_color', apply_filters( 'eighteen_tags_default_header_link_color', '#ffffff' ) ) );

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
		if ( is_active_sidebar( 'header-bar-1' ) && get_option( 'etp_header_bar' ) ) {
			echo '<div class="shb-header-bar"><div class="col-full">';
				dynamic_sidebar( 'header-bar-1' );
			echo '</div></div>';
		}
	}
} // End Class
