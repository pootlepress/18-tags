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

		add_action( 'admin_menu', array( $this, 'eighteen_tags_welcome_register_menu' ) );
		add_action( 'load-themes.php', array( $this, 'eighteen_tags_activation_admin_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'eighteen_tags_welcome_style' ) );

		add_action( 'eighteen_tags_welcome', array( $this, 'eighteen_tags_welcome_intro' ), 				10 );
		add_action( 'eighteen_tags_welcome', array( $this, 'eighteen_tags_welcome_enhance' ), 			20 );
		add_action( 'eighteen_tags_welcome', array( $this, 'eighteen_tags_welcome_contribute' ), 			30 );

	} // end constructor

	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.0.3
	 */
	public function eighteen_tags_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) { // input var okay
			add_action( 'admin_notices', array( $this, 'eighteen_tags_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 * @since 1.0.3
	 */
	public function eighteen_tags_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Thanks for choosing Eighteen tags! You can read hints and tips on how get the most out of your new theme on the %swelcome screen%s.', 'eighteen-tags' ), '<a href="' . esc_url( admin_url( 'themes.php?page=eighteen-tags-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=eighteen-tags-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Eighteen tags', 'eighteen-tags' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css
	 * @return void
	 * @since  1.4.4
	 */
	public function eighteen_tags_welcome_style( $hook_suffix ) {
		global $eighteen_tags_version;

		if ( 'appearance_page_eighteen-tags-welcome' == $hook_suffix ) {
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
	public function eighteen_tags_welcome_register_menu() {
		add_theme_page( 'Eighteen tags', 'Eighteen tags', 'edit_theme_options', 'eighteen-tags-welcome', array( $this, 'eighteen_tags_welcome_screen' ) );
	}

	/**
	 * The welcome screen
	 * @since 1.0.0
	 */
	public function eighteen_tags_welcome_screen() {
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
	public function eighteen_tags_welcome_intro() {
		require_once 'sections/intro.php';
	}


	/**
	 * Welcome screen enhance section
	 * @since 1.5.2
	 */
	public function eighteen_tags_welcome_enhance() {
		require_once 'sections/videos.php';
	}

	/**
	 * Welcome screen contribute section
	 * @since 1.5.2
	 */
	public function eighteen_tags_welcome_contribute() {
		require_once 'sections/contribute.php';
	}
}

$GLOBALS['Eighteen_Tags_Welcome'] = new Eighteen_Tags_Welcome();
