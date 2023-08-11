<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package eighteen-tags
 */

/**
 * Check whether the Eighteen tags Customizer settings ar enabled
 * @return boolean
 * @since  1.1.2
 */
function is_eighteen_tags_customizer_enabled() {
	return apply_filters( 'eighteen_tags_customizer_enabled', true );
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function eighteen_tags_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function eighteen_tags_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( ! has_action( 'eighteen_tags_content_top', 'woocommerce_breadcrumb' ) ) {
		$classes[]	= 'no-wc-breadcrumb';
	}

	return $classes;
}

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * Schema type
 * @return string schema itemprop type
 */
function eighteen_tags_html_tag_schema() {
	$schema 	= 'http://schema.org/';
	$type 		= 'WebPage';

	// Is single post
	if ( is_singular( 'post' ) ) {
		$type 	= 'Article';
	}

	// Is author page
	elseif ( is_author() ) {
		$type 	= 'ProfilePage';
	}

	// Is search results page
	elseif ( is_search() ) {
		$type 	= 'SearchResultsPage';
	}

	echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function eighteen_tags_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'eighteen_tags_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'eighteen_tags_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so eighteen_tags_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so eighteen_tags_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in eighteen_tags_categorized_blog.
 */
function eighteen_tags_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'eighteen_tags_categories' );
}
add_action( 'edit_category', 'eighteen_tags_category_transient_flusher' );
add_action( 'save_post',     'eighteen_tags_category_transient_flusher' );

/**
 * Call a shortcode function by tag name.
 *
 * @since  1.4.6
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
function eighteen_tags_do_shortcode( $tag, array $atts = array(), $content = null ) {

	global $shortcode_tags;

	if ( ! isset( $shortcode_tags[ $tag ] ) ) {
		return false;
	}

	return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}

function wc_breadcrumb_register() {

	if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
		function woocommerce_breadcrumb() {
			global $post;
			$sep = " / "; // Simply change the separator to what ever you need e.g. / or >
			if ( ! is_front_page() ) {
				$home = '<div class="woocommerce-breadcrumb"><a href="' . home_url() . '">Home</a> ' . $sep;
				if ( is_category() || is_single() ) {
					echo $home;
					the_category( ', ' );
					if ( is_single() ) {
						echo $sep;
						the_title();
					}
					echo '</div>';
				} elseif ( is_page() && $post->post_parent ) {
					echo $home;
					$home = get_page( get_option( 'page_on_front' ) );
					for ( $i = count( $post->ancestors ) - 1; $i >= 0; $i -- ) {
						if ( ( $home->ID ) != ( $post->ancestors[ $i ] ) ) {
							echo '<a href="';
							echo get_permalink( $post->ancestors[ $i ] );
							echo '">';
							echo get_the_title( $post->ancestors[ $i ] );
							echo "</a>" . $sep;
						}
					}
					echo the_title();
					echo '</div>';
				} elseif ( is_page() ) {
					echo $home . get_the_title() . '</div>';
				} elseif ( is_home() && ! is_front_page() ) {
					echo $home . get_the_title( get_option( 'page_for_posts' ) ) . '</div>';
				} elseif ( is_404() ) {
					echo "{$home}404</div>";
				}
			}
		}
	}
}

function eighteen_tags_add_notice( $notice, $key = null ) {
	$notices = get_theme_mod( '18-tags-notices', array() );

	if ( $key ) {
		$notices[ $key ] = '<p>' . $notice . '</p>';
	} else {
		$notices[] = '<p>' . $notice . '</p>';
	}

	set_theme_mod( '18-tags-notices', $notices );
}