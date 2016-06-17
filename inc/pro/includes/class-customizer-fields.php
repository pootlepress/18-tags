<?php
/**
 * Admin fields output class.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Cover_Pages
 * @subpackage Cover_Pages/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @class Cover_Pages_Customizer_Fields
 * @package    Cover_Pages
 * @subpackage Cover_Pages/admin
 * @author     Your Name <email@example.com>
 */
final class Eighteen_Tags_Pro_Customizer_Fields extends Eighteen_Tags_Pro_Abstract {
	/**
	 * Initialize the class and set its properties.
	 * @since    1.0.0
	 */
	public function init() {}

	public $google_font_fields = array();

	/**
	 * Section id from name
	 *
	 * @param string $sec Section Name
	 * @return string Section ID
	 */
	public function get_sec_id( $sec ){
		return $this->token . '-section-' . preg_replace("/[^\w]+/", '-', strtolower( $sec ) );
	}

	/**
	 * Field id from name
	 *
	 * @param string $n Field Name
	 * @return string Field ID
	 */
	public function get_field_id( $n ){
		return $this->token . '-' . preg_replace("/[^\w]+/",  '-', strtolower( $n ) );
	}

	/**
	 * Customizer Controls and settings
	 * @param object WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @uses eighteen_tags_pro_fields()
	 */
	public function etp_customize_register( $wp_customize ) {
		$fields = eighteen_tags_pro_fields();

		$sections = array();
		foreach ( $fields as $f ) {
			$sections[ $f['section'] ][] = $f;
		}

		require 'class-multi-control.php';

		$this->customizer_fields( $wp_customize, $sections );
		do_action( $this->token . '-customize-register', $wp_customize );

		set_theme_mod( 'etp-google-fonts', implode( ':|:', $this->google_font_fields ) );

	}

	/**
	 * Sets the fields for the customizer
	 *
	 * @since	1.0.0
	 * @param WP_Customize_Manager $wp_customize
	 * @param array $sections Sections and their fields
	 */
	public function customizer_fields( WP_Customize_Manager $wp_customize, $sections ){

		foreach ( $sections as $Sec => $fields ) {


			if ( false === strstr( $Sec, 'existing_' ) ) {
				$sec = $this->get_sec_id( $Sec );

				$args = apply_filters(  $this->token . '-sections-filter-args', array(
					'title'    => $Sec,
					'priority' => 25,
				) );

				$args = apply_filters(  $sec . 'filter-args', $args );

				$wp_customize->add_section( $sec, $args );
			} else {
				$sec = str_replace( 'existing_', '', $Sec );
			}

			foreach ( $fields as $f ) {
				$this->setting_and_control( $wp_customize, $f, $sec );
			}
		}
	}

	protected function setting_and_control( $wp_customize, $f, $sec ) {
		$id = $this->get_field_id( $f['id'] );

		$f['id'] = $id;
		$f['section'] = $sec;

		//Setting a default
		$default = '';
		if ( isset( $f['default'] ) ) {
			$default = $f['default'];
		}

		//Add Setting
		$wp_customize->add_setting(
			$id,
			array(
				'default'   => $default,
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		if ( ! strpos( $f['id'], 'wc-cart' ) || class_exists( 'WooCommerce' ) ) {
			$this->render_customizer_field( $wp_customize, $f );
		}
	}

	/**
	 * Renders the fields for the cusmtomizer
	 * @param WP_Customize_Manager $wp_customize
	 * @param $f
	 * @since 1.0.0
	 */
	public function render_customizer_field( WP_Customize_Manager $wp_customize, $f ){
		//Add control by type
		if ( 'post-types' == $f['type'] ) {
			$f['type'] = 'multi-checkbox';
			$f['choices'] = get_post_types( array( 'exclude_from_search' => false, ) );
		}
		if ( in_array( $f['type'], array( 'sf-radio-image', 'alpha-color', 'color', 'grid', 'multi-checkbox', 'post-types', 'image', 'sf-text', 'sf-heading', 'sf-divider', ) ) ) {

			$this->cool_fields( $wp_customize, $f['type'], $f['id'], $f );
			return;

		}

		//Setting type
		$args = $f;

		if ( 'font' == $f['type'] ) {

			$this->google_font_fields[] = $f['id'];
			$args['choices'] = $this->get_fonts();
			$args['type'] = 'select';

		}

		$wp_customize->add_control(
			$f['id'],
			$args
		);

	}

	/**
	 * Array of fonts for font controls
	 * @param WP_Customize_Manager $wp_customize
	 * @param $type
	 * @param $id
	 * @param $args
	 * @since    1.0.0
	 * @return array Fonts
	 */
	public function cool_fields( WP_Customize_Manager $wp_customize, $type, $id, $args ){
		$field_class = '';
		if ( in_array( $type, array( 'multi-checkbox', 'grid', ) ) ) {
			$field_class = 'PRO18_Custom_Customize_Control';
		} elseif ( in_array( $type, array( 'sf-text', 'sf-heading', 'sf-divider', ) ) ) {
			$field_class = 'Arbitrary_Eighteen_Tags_Control';
			$args['type'] = str_replace( 'sf-', '', $type );
		} elseif ( in_array( $type, array( 'alpha-color', ) ) ) {
			$field_class = 'Lib_Customize_Alpha_Color_Control';
			$args['type'] = 'lib_color';
		} else {
			$this->find_control_class( $type, $field_class, $args );
		}

		$wp_customize->add_control(
			new $field_class(
				$wp_customize,
				$id,
				$args
			)
		);
	}

	/**
	 * Array of fonts for font controls
	 *
	 * @since	1.0.0
	 * @return array Fonts
	 */
	public function get_fonts(){
		global $sf_pro_fonts;

		return $sf_pro_fonts;
	}

	private function find_control_class( $type, &$field_class, &$args ) {
		switch ( $type ) {
			case 'color':
				$field_class = 'WP_Customize_Color_Control';
				break;
			case 'image':
				$field_class = 'WP_Customize_Image_Control';
				break;
			case 'sf-radio-image':
				$field_class = 'Eighteen_Tags_Custom_Radio_Image_Control';
				$args['type'] = str_replace( 'sf-', '', $type );
		}
	}

}
