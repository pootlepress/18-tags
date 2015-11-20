<?php
/**
 * Plugin Name:			Eighteen tags Product Sharing
 * Plugin URI:			http://pootlepress.com/products/eighteen-tags-product-sharing/
 * Description:			Add attractive social sharing icons for Facebook, Twitter, Pinterest and Email to your product pages.
 * Version:				1.0.2
 * Author:				pootlepress
 * Author URI:			http://pootlepress.com/
 * Requires at least:	4.0.0
 * Tested up to:		4.2.2
 *
 * Text Domain: eighteen-tags-product-sharing
 * Domain Path: /languages/
 *
 * @package Eighteen_Tags_Product_Sharing
 * @category Core
 * @author James Koster
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Returns the main instance of Eighteen_Tags_Product_Sharing to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Eighteen_Tags_Product_Sharing
 */
function Eighteen_Tags_Product_Sharing() {
	return Eighteen_Tags_Product_Sharing::instance();
} // End Eighteen_Tags_Product_Sharing()

Eighteen_Tags_Product_Sharing();

/**
 * Main Eighteen_Tags_Product_Sharing Class
 *
 * @class Eighteen_Tags_Product_Sharing
 * @version	1.0.0
 * @since 1.0.0
 * @package	Eighteen_Tags_Product_Sharing
 */
final class Eighteen_Tags_Product_Sharing {
	/**
	 * Eighteen_Tags_Product_Sharing The single instance of Eighteen_Tags_Product_Sharing.
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
		$this->token 			= 'eighteen-tags-product-sharing';
		$this->plugin_url 		= PRO18_URL . '/includes/ext/product-sharing/';
		$this->plugin_path 		= plugin_dir_path( __FILE__ );
		$this->version 			= '1.0.2';

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'sps_load_plugin_textdomain' ) );

		add_action( 'init', array( $this, 'sps_setup' ) );
	}

	/**
	 * Main Eighteen_Tags_Product_Sharing Instance
	 *
	 * Ensures only one instance of Eighteen_Tags_Product_Sharing is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Eighteen_Tags_Product_Sharing()
	 * @return Main Eighteen_Tags_Product_Sharing instance
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
	public function sps_load_plugin_textdomain() {
		load_plugin_textdomain( 'eighteen-tags-product-sharing', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
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
	 * Only executes if Eighteen tags or a child theme using Eighteen tags as a parent is active and the extension specific filter returns true.
	 * Child themes can disable this extension using the eighteen_tags_extension_boilerplate_enabled filter
	 * @return void
	 */
	public function sps_setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'sps_styles' ), 999 );
		add_action( 'woocommerce_after_single_product_summary', array( $this, 'sps_product_sharing' ), 5 );
	}

	/**
	 * Enqueue CSS.
	 * @since   1.0.0
	 * @return  void
	 */
	public function sps_styles() {
		if ( ! get_theme_mod( 'eighteen-tags-pro-wc-prod-share-icons' ) ) { return; }
		wp_enqueue_style( 'sps-styles', $this->plugin_url . '/assets/css/style.css' );
	}

	/**
	 * Product sharing links
	 */
	public function sps_product_sharing() {
		if ( ! get_theme_mod( 'eighteen-tags-pro-wc-prod-share-icons' ) ) { return; }
		$product_title 	= get_the_title();
		$product_url	= get_permalink();
		$product_img	= wp_get_attachment_url( get_post_thumbnail_id() );

		$facebook_url 	= 'https://www.facebook.com/sharer/sharer.php?u=' . $product_url;
		$twitter_url	= 'http://twitter.com/intent/tweet?status=' . rawurlencode( $product_title ) . '+' . $product_url;
		$pinterest_url	= 'http://pinterest.com/pin/create/bookmarklet/?media=' . $product_img . '&url=' . $product_url . '&is_video=false&description=' . rawurlencode( $product_title );
		$email_url		= 'mailto:?subject=' . rawurlencode( $product_title ) . '&body=' . $product_url;
		?>
		<div class="eighteen-tags-product-sharing">
			<ul>
				<li class="twitter"><a href="<?php echo esc_url( $twitter_url ); ?>"><?php _e( 'Share on Twitter', 'eighteen-tags-product-sharing' ); ?></a></li>
				<li class="facebook"><a href="<?php echo esc_url( $facebook_url ); ?>"><?php _e( 'Share on Facebook', 'eighteen-tags-product-sharing' ); ?></a></li>
				<li class="pinterest"><a href="<?php echo esc_url( $pinterest_url ); ?>"><?php _e( 'Pin this product', 'eighteen-tags-product-sharing' ); ?></a></li>
				<li class="email"><a href="<?php echo esc_url( $email_url ); ?>"><?php _e( 'Share via Email', 'eighteen-tags-product-sharing' ); ?></a></li>
			</ul>
		</div>
		<?php
	}
} // End Class
