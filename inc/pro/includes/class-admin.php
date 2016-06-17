<?php
/**
 * Eighteen tags admin class
 * @developer http://wpdevelopment.me <shramee@wpdevelopment.me>
 */


/**
 * Eighteen_Tags_Pro_Admin Class
 *
 * @class Eighteen_Tags_Pro_Admin
 * @version	1.0.0
 * @since 1.0.0
 * @package	Eighteen_Tags_Pro
 */
final class Eighteen_Tags_Pro_Admin extends Eighteen_Tags_Pro_Abstract {

	/**
	 * The customizer control render object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $customizer;

	/**
	 * Called by parent::__construct
	 * Do initialization here
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function init(){

		//Enqueue scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ), 999 );
		//Customizer fields renderer
		$this->customizer = new Eighteen_Tags_Pro_Customizer_Fields( $this->token, $this->plugin_path, $this->plugin_url );
		//Customize register
		add_action( $this->token . '-sections-filter-args', array( $this, 'filter_sections' ) );
		//Customize register
		add_action( $this->token . '-customize-register', array( $this, 'create_panels' ) );
		//Customize register
		add_action( 'customize_register', array( $this->customizer, 'etp_customize_register' ), 999 );
		//Customize preview init script
		add_action( 'customize_preview_init', array( $this, 'etp_customize_preview_js' ) );
		//Admin notices
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
		//Reset all Eighteen tags pro pro options
		add_action( 'wp_ajax_eighteen_tags_pro_reset', array( $this, 'reset_all' ) );
	}

	/**
	 * Resets all Eighteen tags pro options
	 * @action wp_ajax_eighteen_tags_pro_reset
	 */
	public function reset_all( $data ){
		$redirect = filter_input( INPUT_GET, 'redirect' );
		if ( $redirect ) {
			$fields = eighteen_tags_pro_fields();
			foreach ( $fields as $f ) {
				$id = $f['id'];
				remove_theme_mod( "{$this->token}-{$id}" );
			}
			$this->add_notice( '<p>All Eighteen tags pro options have been successfully reset.</p>' );
			header( 'Location:' . $redirect );
		}
	}

	public function enqueue() {
		global $pagenow;
		if ( 'nav-menus.php' == $pagenow ) {
			wp_enqueue_script( 'etp-admin-menu', $this->plugin_url . '/assets/js/admin-menu.js', array( 'jquery' ) );
		}
	}

	/**
	 * Filters the section arguments for making them sit in panels
	 * @param array $args Section arguments
	 * @filter eighteen-tags-pro-sections-filter-args
	 * @return array Arguments
	 */
	public function filter_sections ( $args ) {
		if ( in_array( $args['title'], array( 'Primary Navigation', 'Secondary Navigation', 'Header elements', 'Mobile menu', ) ) ) {
			$args['panel'] = 'etp-header';
			if ( 'Mobile menu' == $args['title'] ) {
				$args['description'] = 'Mobile menu customizations require menu assigned to Handheld Menu location';
			}
		} else if ( in_array( $args['title'], array( 'Product Details', 'Shop', 'Checkout', ) ) ) {
			$args['panel'] = 'etp-wc';
		} else if ( 'Widgets' == $args['title'] ) {
			$args['panel'] = 'etp-footer';
		} else {
			$args['panel'] = 'etp-content';
		}

		return $args;
	}

	/**
	 * Filters the section arguments for making them sit in panels
	 * @param WP_Customize_Manager $man
	 * @filter eighteen-tags-pro-sections-filter-args
	 */
	public function create_panels ( $man ) {

		$man->add_control( 'eighteen_tags_header_background_color', array(
			'label'	   => __( 'Background color', 'eighteen-tags' ),
			'section'  => 'nonexistent',
		) );

		$man->add_control( 'eighteen_tags_header_text_color', array(
			'section'		=> 'nonexistent',
			'label'			=> __( 'None', 'eighteen-tags' ),
			'type'		=> 'text',
		) );

		$man->add_control( 'eighteen_tags_header_link_color', array(
			'section'		=> 'nonexistent',
			'label'			=> __( 'None', 'eighteen-tags' ),
			'type'		=> 'text',
		) );

		$man->add_control( 'eighteen_tags_header_link_color', array(
			'section'		=> 'nonexistent',
			'label'			=> __( 'None', 'eighteen-tags' ),
			'type'		=> 'text',
		) );

		$man->add_setting( 'etp_post_layout', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'          => 'option'
		) );

		$man->add_control( new Eighteen_Tags_Custom_Radio_Image_Control( $man, 'etp_post_layout', array(
			'settings'		=> 'etp_post_layout',
			'section'		=> 'eighteen_tags_single_post',
			'label'			=> __( 'Post page Layout', 'eighteen-tags' ),
			'priority'		=> 7,
			'choices'		=> array(
				''      => PRO18_URL . '/assets/img/admin/layout-full-image.png',
				'title-top'      => PRO18_URL . '/assets/img/admin/layout-full-image-title-top.png',
				'fancy' => PRO18_URL . '/assets/img/admin/layout-title-in-image.png',
			)
		) ) );

		$man->add_setting( 'etp_blog_layout', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'       => '',
			'type'          => 'option'

		) );

		$man->add_section( 'eighteen_tags_archive', array(
			'title' => 'Archive',
			'panel' => 'etp-blog',
			'priority' => 7,
		) );

		$man->add_section( 'eighteen_tags_single_post', array(
			'title' => 'Single post',
			'panel' => 'etp-blog',
			'priority' => 7,
		) );

		$man->add_section( 'eighteen_tags_footer', array(
			'title' => 'Layout',
			'panel' => 'etp-footer',
			'priority' => 7,
		) );

		$man->get_section( 'header_image' )->title = 'Header Elements';
		$man->get_section( 'header_image' )->panel = 'etp-header';
		$man->get_section( 'header_image' )->priority = 7;

		$man->get_section( 'background_image' )->priority = 7;
		$man->get_section( 'background_image' )->panel = 'etp-content';
		$man->get_section( 'eighteen_tags_typography' )->panel = 'etp-content';
		$man->get_section( 'eighteen_tags_buttons' )->panel = 'etp-content';
		$man->get_section( 'eighteen_tags_layout' )->panel = 'etp-content';

		$man->add_panel( 'etp-header', array(
			'title' => 'Header and Navigation',
			'priority' => 23,
		) );

		$man->add_panel( 'etp-content', array(
			'title' => 'Content',
			'priority' => 25,
		) );

		$man->add_panel( 'etp-blog', array(
			'title' => 'Blog',
			'priority' => 30,
		) );

		$man->add_panel( 'etp-wc', array(
			'title' => 'WooCommerce',
			'priority' => 32,
		) );

		$man->add_panel( 'etp-footer', array(
			'title' => 'Footer',
			'priority' => 34,
		) );
	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @since  1.0.0
	 */
	public function etp_customize_preview_js() {
		wp_enqueue_script( 'etp-customizer', $this->plugin_url . '/assets/js/customizer.min.js', array( 'customize-preview' ), '1.1', true );
	}

	/**
	 * Admin notice
	 * Checks the notice setup in install(). If it exists display it then delete the option so it's not displayed again.
	 * @since   1.0.0
	 * @return  void
	 */
	public function admin_notices() {
		if ( $notices = get_theme_mod( '18tags-pro-notices', '' ) ) {
			$notices = explode( ':|:', get_theme_mod( '18tags-pro-notices', '' ) );
			foreach ( $notices as $notice ) {
				echo "<div class='notice is-dismissible updated'>$notice</div>";
			}
			remove_theme_mod( '18tags-pro-notices' );
		}
	}

	/**
	 * Adds an admin notice
	 * @since   1.0.0
	 * @return  void
	 */
	public function add_notice( $notice ) {
		$notices = explode( ':|:', get_theme_mod( '18tags-pro-notices', '' ) );

		$notices[] = $notice;

		set_theme_mod( '18tags-pro-notices', implode( ':|:',  $notices ) );
	}

} // End class