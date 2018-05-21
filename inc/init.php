<?php
/**
 * eighteen-tags engine room
 *
 * @package eighteen-tags
 */

/**
 * Load pro styling
 */
require_once get_template_directory() . '/inc/pro/pro.php';

/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */
require_once get_template_directory() . '/inc/functions/setup.php';

/**
 * Structure.
 * Template functions used throughout the theme.
 */
require_once get_template_directory() . '/inc/structure/hooks.php';
require_once get_template_directory() . '/inc/structure/post.php';
require_once get_template_directory() . '/inc/structure/page.php';
require_once get_template_directory() . '/inc/structure/header.php';
require_once get_template_directory() . '/inc/structure/footer.php';
require_once get_template_directory() . '/inc/structure/comments.php';
require_once get_template_directory() . '/inc/structure/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/inc/functions/extras.php';

/**
 * Customizer additions.
 */
if ( is_eighteen_tags_customizer_enabled() ) {
	require_once get_template_directory() . '/inc/customizer/hooks.php';
	require_once get_template_directory() . '/inc/customizer/controls.php';
	require_once get_template_directory() . '/inc/customizer/display.php';
	require_once get_template_directory() . '/inc/customizer/functions.php';
	require_once get_template_directory() . '/inc/customizer/custom-header.php';
}

/**
 * Load Jetpack compatibility file.
 */
require_once get_template_directory() . '/inc/jetpack/jetpack.php';

/**
 * Welcome screen
 */
if ( is_admin() ) {
	require_once get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
}

/**
 * Load WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	require_once get_template_directory() . '/inc/woocommerce/hooks.php';
	require_once get_template_directory() . '/inc/woocommerce/functions.php';
	require_once get_template_directory() . '/inc/woocommerce/template-tags.php';
	require_once get_template_directory() . '/inc/woocommerce/integrations.php';
}