<?php
/**
 * @package Eighteen_Tags_Pro
 * @category Core
 * @author Shramee Srivastav <shramee.srivastav@gmail.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
define( 'PRO18_URL', get_template_directory_uri() . '/inc/pro/' );
define( 'PRO18_PATH', get_template_directory() . '/inc/pro/' );
define( 'PRO18_VERSION', EIGHTEENTAGS_VERSION );

/** Including abstract class */
require_once 'includes/class-abstract.php';

/** Including variables and function */
require_once 'includes/vars-n-funcs.php';

/** Including customizer class */
require_once 'includes/class-customizer-fields.php';

/** Including public class */
require_once 'includes/class-public.php';

/** Including public class */
require_once 'includes/class-nav-icons.php';

/** Including admin class */
require_once 'includes/class-admin.php';

/** Including header and nav styling class */
require_once 'includes/class-header-nav-styles.php';

/** Including footer styling class */
require_once 'includes/class-footer-styles.php';

/** Including Content styling class */
require_once 'includes/class-content-styles.php';

/**
 * Returns the main instance of Eighteen_Tags to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return Eighteen_Tags Instance
 */
function Pro_18Tags() {
	return Eighteen_Tags::instance();
} // End Pro_18Tags()

Pro_18Tags();

/**
 * Main Eighteen_Tags Class
 *
 * @class Eighteen_Tags
 * @version	1.0.0
 * @since 1.0.0
 * @package	Eighteen_Tags
 * @author Shramee Srivastav <shramee.srivastav@gmail.com>
 */
final class Eighteen_Tags {
	/**
	 * Eighteen_Tags The single instance of Eighteen_Tags.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	public static $url;

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

	/**
	 * The admin object.
	 * @var     Eighteen_Tags_Admin
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * The public object.
	 * @var     Eighteen_Tags_Public
	 * @access  public
	 * @since   1.0.0
	 */
	public $public;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 */
	public function __construct() {
		$this->token		= 'eighteen-tags-pro';
		$this->plugin_url	= PRO18_URL;
		$this->plugin_path	= PRO18_PATH;
		$this->version		= PRO18_VERSION;
		self::$url			= $this->plugin_url;

		add_action( 'after_setup_theme', array( $this, 'include_ext_plugins' ) );

		add_action( 'init', array( $this, 'setup' ) );
	}

	/**
	 * Setup all the things.
	 * Only executes if Eighteen tags or a child theme using Eighteen tags as a parent is active and the extension specific filter returns true.
	 * Child themes can disable this extension using the eighteen_tags_pro_enabled filter
	 * @return void
	 */
	public function setup() {
		//Setting admin object
		$this->admin = new Eighteen_Tags_Admin( $this->token, $this->plugin_path, $this->plugin_url );

		//Setting public object
		$this->public = new Eighteen_Tags_Public( $this->token, $this->plugin_path, $this->plugin_url );
	}

	/**
	 * Load the localisation file.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function include_ext_plugins() {

		if ( ! class_exists( 'Pootle_Page_Customizer' ) ) {
			require 'includes/page-customizer/page-customizer.php';
		}
		if ( ! class_exists( 'Eighteen_Tags_Footer_Bar' ) ) {
			require 'includes/ext/footer-bar/footer-bar.php';
		}
		if ( ! class_exists( 'Eighteen_Tags_Header_Bar' ) ) {
			require 'includes/ext/header-bar/header-bar.php';
		}
	}

	/**
	 * Main Eighteen_Tags Instance
	 *
	 * Ensures only one instance of Eighteen_Tags is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Eighteen_Tags()
	 * @return Eighteen_Tags instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

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
} // End Class
