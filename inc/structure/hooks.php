<?php
/**
 * eighteen-tags hooks
 *
 * @package eighteen-tags
 */

/**
 * General
 * @see  eighteen_tags_setup()
 * @see  eighteen_tags_widgets_init()
 * @see  eighteen_tags_scripts()
 * @see  eighteen_tags_header_widget_region()
 * @see  eighteen_tags_get_sidebar()
 */
add_action( 'widgets_init',					'eighteen_tags_widgets_init' );
add_action( 'after_setup_theme',			'eighteen_tags_setup',                  12 );
add_action( 'wp_enqueue_scripts',			'eighteen_tags_scripts',				10 );
add_action( 'eighteen_tags_before_content',	'eighteen_tags_header_widget_region',	10 );
add_action( 'eighteen_tags_sidebar',		'eighteen_tags_get_sidebar',	    	10 );

/**
 * Header
 * @see  eighteen_tags_skip_links()
 * @see  eighteen_tags_hamburger_menu()
 * @see  eighteen_tags_site_branding()
 * @see  eighteen_tags_primary_navigation()
 */
add_action( 'eighteen_tags_header', 'eighteen_tags_skip_links', 			0 );
add_action( 'eighteen_tags_header', 'eighteen_tags_hamburger_menu',			5 );
add_action( 'eighteen_tags_header', 'eighteen_tags_site_branding',			20 );
add_action( 'eighteen_tags_header', 'eighteen_tags_primary_navigation',		50 );

/**
 * Footer
 * @see  eighteen_tags_footer_widgets()
 * @see  eighteen_tags_credit()
 */
add_action( 'eighteen_tags_footer', 'eighteen_tags_footer_widgets',	10 );
add_action( 'eighteen_tags_footer', 'eighteen_tags_credit',			20 );

/**
 * Homepage
 * @see  eighteen_tags_homepage_content()
 * @see  eighteen_tags_product_categories()
 * @see  eighteen_tags_recent_products()
 * @see  eighteen_tags_featured_products()
 * @see  eighteen_tags_popular_products()
 * @see  eighteen_tags_on_sale_products()
 */
add_action( 'homepage', 'eighteen_tags_homepage_content',		10 );
add_action( 'homepage', 'eighteen_tags_product_categories',	20 );
add_action( 'homepage', 'eighteen_tags_recent_products',		30 );
add_action( 'homepage', 'eighteen_tags_featured_products',		40 );
add_action( 'homepage', 'eighteen_tags_popular_products',		50 );
add_action( 'homepage', 'eighteen_tags_on_sale_products',		60 );

/**
 * Posts
 * @see  eighteen_tags_post_header()
 * @see  eighteen_tags_post_meta()
 * @see  eighteen_tags_post_content()
 * @see  eighteen_tags_paging_nav()
 * @see  eighteen_tags_single_post_header()
 * @see  eighteen_tags_post_nav()
 * @see  eighteen_tags_display_comments()
 */
add_action( 'eighteen_tags_loop_post',			'eighteen_tags_post_header',		10 );
add_action( 'eighteen_tags_loop_post',			'eighteen_tags_post_meta',			20 );
add_action( 'eighteen_tags_loop_post',			'eighteen_tags_post_content',		30 );
add_action( 'eighteen_tags_loop_after',		'eighteen_tags_paging_nav',		10 );
add_action( 'eighteen_tags_single_post',		'eighteen_tags_post_header',		10 );
add_action( 'eighteen_tags_single_post',		'eighteen_tags_post_meta',			20 );
add_action( 'eighteen_tags_single_post',		'eighteen_tags_post_content',		30 );
add_action( 'eighteen_tags_single_post_after',	'eighteen_tags_post_nav',			10 );
add_action( 'eighteen_tags_single_post_after',	'eighteen_tags_display_comments',	20 );

/**
 * Pages
 * @see  eighteen_tags_page_header()
 * @see  eighteen_tags_page_content()
 * @see  eighteen_tags_display_comments()
 */
add_action( 'eighteen_tags_page', 			'eighteen_tags_page_header',		10 );
add_action( 'eighteen_tags_page', 			'eighteen_tags_page_content',		20 );
add_action( 'eighteen_tags_page_after', 	'eighteen_tags_display_comments',	10 );

/**
 * Extras
 * @see  eighteen_tags_body_classes()
 * @see  eighteen_tags_page_menu_args()
 */
add_filter( 'body_class',			'eighteen_tags_body_classes' );
add_filter( 'wp_page_menu_args',	'eighteen_tags_page_menu_args' );