<?php
/**
 * Welcome Screen Class
 * Sets up the welcome screen page, hides the menu item
 * and contains the screen content.
 */
class Eighteen_Tags_Welcome {

	/**
	 * Constructor
	 * Sets up the welcome screen
	 */
	public function __construct() {
		global $pagenow;

		add_action( 'admin_menu', array( $this, 'welcome_register_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'welcome_style' ) );

		add_action( 'eighteen_tags_welcome', array( $this, 'welcome_intro' ), 			10 );
		add_action( 'eighteen_tags_welcome', array( $this, 'welcome_enhance' ), 		20 );
		add_action( 'eighteen_tags_welcome', array( $this, 'welcome_contribute' ), 	30 );

		if ( isset( $_GET['eighteen-tags-theme_show_optin'] ) && $pagenow == 'themes.php' ) {
			add_action( 'admin_notices', array( $this, 'welcome' ), 	7 );
		}
	} // end constructor

	/**
	 * Load welcome screen css
	 * @return void
	 * @since  1.4.4
	 */
	public function welcome_style( $hook_suffix ) {
		global $pagenow;
		global $eighteen_tags_version;

		if ( 'themes.php' == $pagenow ) {
			wp_enqueue_style( 'eighteen-tags-welcome-screen', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome.css', $eighteen_tags_version );
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_script( 'thickbox' );
		}
	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.0.0
	 */
	public function welcome_register_menu() {
		add_theme_page( '18Tags', '18Tags', 'edit_theme_options', 'eighteen-tags-welcome', array( $this, 'welcome_screen' ) );
		add_theme_page( '18Tags skins', '18Tags skins', 'edit_theme_options', 'eighteen-tags-skins', array( $this, 'skins_screen' ) );
	}

	/**
	 * The welcome screen
	 * @since 1.0.0
	 */
	public function welcome_screen() {
		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>
		<div class="wrap about-wrap">

			<?php
			/**
			 * @hooked eighteen_tags_welcome_intro - 10
			 * @hooked eighteen_tags_welcome_enhance - 20
			 * @hooked eighteen_tags_welcome_contribute - 30
			 */
			do_action( 'eighteen_tags_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * Welcome screen intro
	 * @since 1.0.0
	 */
	public function welcome() {
		require_once 'sections/welcome.php';
	}

	/**
	 * Welcome screen intro
	 * @since 1.0.0
	 */
	public function welcome_intro() {
		require_once 'sections/intro.php';
	}

	/**
	 * Welcome screen enhance section
	 * @since 1.5.2
	 */
	public function welcome_enhance() {
		require_once 'sections/videos.php';
	}

	/**
	 * Welcome screen enhance section
	 * @since 1.5.2
	 */
	public function skins_screen() {
		require_once 'sections/skins.php';
	}

	/**
	 * Welcome screen contribute section
	 * @since 1.5.2
	 */
	public function welcome_contribute() {
		require_once 'sections/contribute.php';
	}
}

$GLOBALS['Eighteen_Tags_Welcome'] = new Eighteen_Tags_Welcome();
