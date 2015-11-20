<?php
/**
 * eighteen-tags customizer hooks
 *
 * @package eighteen-tags
 */

add_action( 'customize_preview_init', 			'eighteen_tags_customize_preview_js' );
add_action( 'customize_register', 				'eighteen_tags_customize_register' );
add_filter( 'body_class', 						'eighteen_tags_layout_class' );
add_action( 'wp_enqueue_scripts', 				'eighteen_tags_add_customizer_css', 130 );
add_action( 'after_setup_theme', 				'eighteen_tags_custom_header_setup' );
add_action( 'customize_controls_print_styles', 	'eighteen_tags_customizer_custom_control_css' );