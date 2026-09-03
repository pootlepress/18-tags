<?php
/**
 * Page Customizer loader (reconstructed).
 *
 * The original page-customizer.php was not committed to this repository, but the
 * theme's Customizer depends on the custom control class it provided
 * (Lib_Customize_Alpha_Color_Control). This lightweight loader defines the
 * expected main class (Pootle_Page_Customizer) and loads that control class at
 * the right moment — on customize_register, once WP_Customize_Control exists and
 * before the theme registers its own controls.
 *
 * @package Eighteen_Tags_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Pootle_Page_Customizer' ) ) {

	class Pootle_Page_Customizer {

		/**
		 * Directory holding the module's include files.
		 *
		 * @var string
		 */
		protected $includes;

		public function __construct() {
			$this->includes = dirname( __FILE__ ) . '/includes/';

			// The alpha-colour control extends WP_Customize_Control, which only
			// exists while the Customizer is loading — so require it then, early
			// enough that the theme's controls can use it.
			add_action( 'customize_register', array( $this, 'load_controls' ), 1 );
		}

		/**
		 * Load the bundled Customizer control classes.
		 */
		public function load_controls() {
			if ( ! class_exists( 'WP_Customize_Control' ) ) {
				return;
			}
			$file = $this->includes . 'class-alpha-color-picker.php';
			if ( is_readable( $file ) ) {
				require_once $file;
			}
		}
	}

	new Pootle_Page_Customizer();
}
