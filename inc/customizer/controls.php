<?php
/**
 * eighteen-tags Theme Customizer controls
 *
 * @package eighteen-tags
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since  1.0.0
 */
if ( ! function_exists( 'eighteen_tags_customize_register' ) ) {
	function eighteen_tags_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         	= 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport 	= 'postMessage';

		// Move background color setting alongside background image
		$wp_customize->get_control( 'background_color' )->section 	= 'background_image';
		$wp_customize->get_control( 'background_color' )->priority 	= 20;

		// Change background image section title & priority
		$wp_customize->get_section( 'background_image' )->title 	= __( 'Background', 'eighteen-tags' );
		$wp_customize->get_section( 'background_image' )->priority 	= 30;

		// Change header image section title & priority
		$wp_customize->get_section( 'header_image' )->title 		= __( 'Header', 'eighteen-tags' );
		$wp_customize->get_section( 'header_image' )->priority 		= 35;

		/**
		 * Custom controls
		 */
		require_once dirname( __FILE__ ) . '/controls/radio-image.php';
		require_once dirname( __FILE__ ) . '/controls/arbitrary.php';

		if ( apply_filters( 'eighteen_tags_customizer_more', true ) ) {
			require_once dirname( __FILE__ ) . '/controls/more.php';
		}

		/**
		 * Add the typography section
	     */
		$wp_customize->add_section( 'eighteen_tags_typography' , array(
			'title'      => __( 'Typography', 'eighteen-tags' ),
			'priority'   => 45,
		) );

		/**
		 * Heading color
		 */
		$wp_customize->add_setting( 'eighteen_tags_heading_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_heading_color', '#484c51' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_heading_color', array(
			'label'	   => __( 'Heading color', 'eighteen-tags' ),
			'section'  => 'eighteen_tags_typography',
			'settings' => 'eighteen_tags_heading_color',
			'priority' => 7,
		) ) );

		/**
		 * Text Color
		 */
		$wp_customize->add_setting( 'eighteen_tags_text_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_text_color', '#60646c' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_text_color', array(
			'label'		=> __( 'Body Text color', 'eighteen-tags' ),
			'section'	=> 'eighteen_tags_typography',
			'settings'	=> 'eighteen_tags_text_color',
			'priority'	=> 34,
		) ) );

		/**
		 * Accent Color
		 */
		$wp_customize->add_setting( 'eighteen_tags_accent_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_accent_color', '#428bca' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_accent_color', array(
			'label'	   => __( 'Link / accent color', 'eighteen-tags' ),
			'section'  => 'eighteen_tags_typography',
			'settings' => 'eighteen_tags_accent_color',
			'priority' => 40,
		) ) );

		$wp_customize->add_control( new Arbitrary_Eighteen_Tags_Control( $wp_customize, 'eighteen_tags_header_image_heading', array(
			'section'  		=> 'header_image',
			'type' 			=> 'heading',
			'label'			=> __( 'Header background image', 'eighteen-tags' ),
			'priority' 		=> 6,
		) ) );

		/**
		 * Header Background
		 */
		$wp_customize->add_setting( 'eighteen_tags_header_background_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_header_background_color', '#ffffff' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_header_background_color', array(
			'label'	   => __( 'Background color', 'eighteen-tags' ),
			'section'  => 'header_image',
			'settings' => 'eighteen_tags_header_background_color',
			'priority' => 15,
		) ) );

		/**
		 * Header text color
		 */
		$wp_customize->add_setting( 'eighteen_tags_header_text_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_header_text_color', '#9aa0a7' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_header_text_color', array(
			'label'	   => __( 'Text color', 'eighteen-tags' ),
			'section'  => 'header_image',
			'settings' => 'eighteen_tags_header_text_color',
			'priority' => 12,
		) ) );

		/**
		 * Header link color
		 */
		$wp_customize->add_setting( 'eighteen_tags_header_link_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_header_link_color', '#000000' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_header_link_color', array(
			'label'	   => __( 'Link color', 'eighteen-tags' ),
			'section'  => 'header_image',
			'settings' => 'eighteen_tags_header_link_color',
			'priority' => 30,
		) ) );

		/**
		 * Footer section
		 */
		$wp_customize->add_section( 'eighteen_tags_footer' , array(
			'title'      	=> __( 'Footer', 'eighteen-tags' ),
			'priority'   	=> 40,
			'description' 	=> __( 'Customise the look & feel of your web site footer.', 'eighteen-tags' ),
		) );

		/**
		 * Footer Background
		 */
		$wp_customize->add_setting( 'eighteen_tags_footer_background_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_footer_background_color', '#f3f3f3' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_footer_background_color', array(
			'label'	   	=> __( 'Background color', 'eighteen-tags' ),
			'section'  	=> 'eighteen_tags_footer',
			'settings' 	=> 'eighteen_tags_footer_background_color',
			'priority'	=> 10,
		) ) );

		/**
		 * Footer heading color
		 */
		$wp_customize->add_setting( 'eighteen_tags_footer_heading_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_footer_heading_color', '#494c50' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
			'transport' 		=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_footer_heading_color', array(
			'label'	   	=> __( 'Heading color', 'eighteen-tags' ),
			'section'  	=> 'eighteen_tags_footer',
			'settings' 	=> 'eighteen_tags_footer_heading_color',
			'priority'	=> 20,
		) ) );

		/**
		 * Footer text color
		 */
		$wp_customize->add_setting( 'eighteen_tags_footer_text_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_footer_text_color', '#61656b' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_footer_text_color', array(
			'label'	   	=> __( 'Text color', 'eighteen-tags' ),
			'section'  	=> 'eighteen_tags_footer',
			'settings' 	=> 'eighteen_tags_footer_text_color',
			'priority'	=> 30,
		) ) );

		/**
		 * Footer link color
		 */
		$wp_customize->add_setting( 'eighteen_tags_footer_link_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_footer_link_color', '#428bca' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_footer_link_color', array(
			'label'	   	=> __( 'Link color', 'eighteen-tags' ),
			'section'  	=> 'eighteen_tags_footer',
			'settings' 	=> 'eighteen_tags_footer_link_color',
			'priority'	=> 40,
		) ) );


		/**
		 * Buttons section
		 */
		$wp_customize->add_section( 'eighteen_tags_buttons' , array(
			'title'      	=> __( 'Buttons', 'eighteen-tags' ),
			'priority'   	=> 45,
			'description' 	=> __( 'Customise the look & feel of your web site buttons.', 'eighteen-tags' ),
		) );

		/**
		 * Button background color
		 */
		$wp_customize->add_setting( 'eighteen_tags_button_background_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_button_background_color', '#60646c' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_button_background_color', array(
			'label'	   => __( 'Background color', 'eighteen-tags' ),
			'section'  => 'eighteen_tags_buttons',
			'settings' => 'eighteen_tags_button_background_color',
			'priority' => 10,
		) ) );

		/**
		 * Button text color
		 */
		$wp_customize->add_setting( 'eighteen_tags_button_text_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_button_text_color', '#ffffff' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_button_text_color', array(
			'label'	   => __( 'Text color', 'eighteen-tags' ),
			'section'  => 'eighteen_tags_buttons',
			'settings' => 'eighteen_tags_button_text_color',
			'priority' => 20,
		) ) );

		/**
		 * Button alt background color
		 */
		$wp_customize->add_setting( 'eighteen_tags_button_alt_background_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_button_alt_background_color', '#428bca' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_button_alt_background_color', array(
			'label'	   => __( 'Alternate button background color', 'eighteen-tags' ),
			'section'  => 'eighteen_tags_buttons',
			'settings' => 'eighteen_tags_button_alt_background_color',
			'priority' => 30,
		) ) );

		/**
		 * Button alt text color
		 */
		$wp_customize->add_setting( 'eighteen_tags_button_alt_text_color', array(
			'default'           => apply_filters( 'eighteen_tags_default_button_alt_text_color', '#ffffff' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_button_alt_text_color', array(
			'label'	   => __( 'Alternate button text color', 'eighteen-tags' ),
			'section'  => 'eighteen_tags_buttons',
			'settings' => 'eighteen_tags_button_alt_text_color',
			'priority' => 40,
		) ) );

		/**
		 * Layout
		 */
		$wp_customize->add_section( 'eighteen_tags_layout' , array(
			'title'      	=> __( 'Layout', 'eighteen-tags' ),
			'priority'   	=> 50,
		) );

		$wp_customize->add_setting( 'eighteen_tags_layout', array(
			'default'    		=> apply_filters( 'eighteen_tags_default_layout', 'full' ),
			'sanitize_callback' => 'eighteen_tags_sanitize_layout',
		) );

		$wp_customize->add_control( new Eighteen_Tags_Custom_Radio_Image_Control( $wp_customize, 'eighteen_tags_layout', array(
			'settings'		=> 'eighteen_tags_layout',
			'section'		=> 'eighteen_tags_layout',
			'label'			=> __( 'General Layout', 'eighteen-tags' ),
			'priority'		=> 1,
			'choices'		=> array(
				'full' 			=> get_template_directory_uri() . '/assets/full.png',
				'right' 		=> get_template_directory_uri() . '/assets/right.png',
				'left' 			=> get_template_directory_uri() . '/assets/left.png',
			)
		) ) );

		$wp_customize->add_setting( 'eighteen_tags_boxed_layout', array(
				'default'    		=> null,
				'sanitize_callback' => 'sanitize_text_field',
			) );

		$wp_customize->add_control( 'eighteen_tags_boxed_layout', array(
			'settings'		=> 'eighteen_tags_boxed_layout',
			'section'		=> 'eighteen_tags_layout',
			'label'			=> __( 'Boxed Layout', 'eighteen-tags' ),
			'priority'		=> 1,
			'type'          => 'checkbox'
		) );

		$wp_customize->add_setting( 'eighteen_tags_boxed_layout_color', array(
				'default'    		=> null,
				'sanitize_callback' => 'sanitize_text_field',
			) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eighteen_tags_boxed_layout_color', array(
			'settings'		=> 'eighteen_tags_boxed_layout_color',
			'section'		=> 'eighteen_tags_layout',
			'label'			=> __( 'Boxed Layout - Box Color', 'eighteen-tags' ),
			'priority'		=> 1,
		) ) );

		$wp_customize->add_setting( 'eighteen_tags_boxed_layout_padding', array(
				'default'    		=> null,
				'sanitize_callback' => 'sanitize_text_field',
			) );

		$wp_customize->add_control( 'eighteen_tags_boxed_layout_padding', array(
			'settings'		=> 'eighteen_tags_boxed_layout_padding',
			'section'		=> 'eighteen_tags_layout',
			'label'			=> __( 'Boxed Layout - Box padding', 'eighteen-tags' ),
			'priority'		=> 1,
			'type'          => 'number'
		) );

		/**
		 * More
		 */
		if ( apply_filters( 'eighteen_tags_customizer_more', true ) ) {
			$wp_customize->add_section( 'eighteen_tags_more' , array(
				'title'      	=> __( 'More', 'eighteen-tags' ),
				'priority'   	=> 999,
			) );

			$wp_customize->add_setting( 'eighteen_tags_more', array(
				'default'    		=> null,
				'sanitize_callback' => 'sanitize_text_field',
			) );

			$wp_customize->add_control( new More_Eighteen_Tags_Control( $wp_customize, 'eighteen_tags_more', array(
				'label'    => __( 'Looking for more options?', 'eighteen-tags' ),
				'section'  => 'eighteen_tags_more',
				'settings' => 'eighteen_tags_more',
				'priority' => 1,
			) ) );
		}
	}
}