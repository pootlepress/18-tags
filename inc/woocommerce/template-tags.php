<?php
/**
 * Custom template tags used to integrate this theme with WooCommerce.
 *
 * @package eighteen-tags
 */

/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 * @param  array $settings Settings
 * @return array           Settings
 * @since  1.0.0
 */
if ( ! function_exists( 'eighteen_tags_cart_link' ) ) {
	function eighteen_tags_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'eighteen-tags' ); ?>">
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'eighteen-tags' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>
		<?php
	}
}

/**
 * Display Product Search
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'eighteen_tags_product_search' ) ) {
	function eighteen_tags_product_search() {
		if ( is_woocommerce_activated() ) { ?>
			<div class="site-search">
				<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
			</div>
		<?php
		}
	}
}

/**
 * Display Header Cart
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'eighteen_tags_header_cart' ) ) {
	function eighteen_tags_header_cart() {
		if ( is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
		?>
		<ul class="site-header-cart menu">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php eighteen_tags_cart_link(); ?>
			</li>
			<li>
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</li>
		</ul>
		<?php
		}
	}
}

/**
 * Upsells
 * Replace the default upsell function with our own which displays the correct number product columns
 * @since   1.0.0
 * @return  void
 * @uses    woocommerce_upsell_display()
 */
if ( ! function_exists( 'eighteen_tags_upsell_display' ) ) {
	function eighteen_tags_upsell_display() {
		woocommerce_upsell_display( -1, 3 );
	}
}

/**
 * Sorting wrapper
 * @since   1.4.3
 * @return  void
 */
function eighteen_tags_sorting_wrapper() {
	echo '<div class="eighteen-tags-sorting">';
}

/**
 * Sorting wrapper close
 * @since   1.4.3
 * @return  void
 */
function eighteen_tags_sorting_wrapper_close() {
	echo '</div>';
}

/**
 * Eighteen tags shop messages
 * @since   1.4.4
 * @uses    do_shortcode
 */
function eighteen_tags_shop_messages() {
	if ( ! is_checkout() ) {
		echo wp_kses_post( eighteen_tags_do_shortcode( 'woocommerce_messages' ) );
	}
}

/**
 * Eighteen tags WooCommerce Pagination
 * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
 * but since Eighteen tags adds pagination before that function is excuted we need a separate function to
 * determine whether or not to display the pagination.
 * @since 1.4.4
 */
if ( ! function_exists( 'eighteen_tags_woocommerce_pagination' ) ) {
	function eighteen_tags_woocommerce_pagination() {
		if ( woocommerce_products_will_display() ) {
			woocommerce_pagination();
		}
	}
}

/**
 * Featured and On-Sale Products
 * Check for featured products then on-sale products and use the appropiate shortcode. 
 * If neither exist, it can fallback to show recently added products.
 * @since  1.5.1
 * @uses  is_woocommerce_activated()
 * @uses  wc_get_featured_product_ids()
 * @uses  wc_get_product_ids_on_sale()
 * @uses  eighteen_tags_do_shortcode()
 * @return void
 */
if ( ! function_exists( 'eighteen_tags_promoted_products' ) ) {
	function eighteen_tags_promoted_products( $per_page = '2', $columns = '2', $recent_fallback = true ) {
		if ( is_woocommerce_activated() ) { 

			if ( wc_get_featured_product_ids() ) {

				echo '<h2>' . esc_html__( 'Featured Products', 'eighteen-tags' ) . '</h2>';

				echo eighteen_tags_do_shortcode( 'featured_products', array(
											'per_page' 	=> $per_page,
											'columns'	=> $columns,
										) );
			} elseif ( wc_get_product_ids_on_sale() ) {

				echo '<h2>' . esc_html__( 'On Sale Now', 'eighteen-tags' ) . '</h2>';

				echo eighteen_tags_do_shortcode( 'sale_products', array(
											'per_page' 	=> $per_page,
											'columns'	=> $columns,
										) );
			} elseif ( $recent_fallback ) {

				echo '<h2>' . esc_html__( 'New In Store', 'eighteen-tags' ) . '</h2>';

				echo eighteen_tags_do_shortcode( 'recent_products', array(
											'per_page' 	=> $per_page,
											'columns'	=> $columns,
										) );
			}
		}
	}
}
