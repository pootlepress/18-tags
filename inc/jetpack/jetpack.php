<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package eighteen-tags
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function eighteen_tags_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'eighteen_tags_jetpack_setup' );
