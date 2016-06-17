<?php
/**
 * Template functions used for the site footer.
 *
 * @package eighteen-tags
 */

if ( ! function_exists( 'eighteen_tags_footer_widgets' ) ) {
	/**
	 * Display the footer widget regions
	 * @since  1.0.0
	 * @return  void
	 */
	function eighteen_tags_footer_widgets() {
		if ( is_active_sidebar( 'footer-4' ) ) {
			$widget_columns = apply_filters( 'eighteen_tags_footer_widget_regions', 4 );
		} elseif ( is_active_sidebar( 'footer-3' ) ) {
			$widget_columns = apply_filters( 'eighteen_tags_footer_widget_regions', 3 );
		} elseif ( is_active_sidebar( 'footer-2' ) ) {
			$widget_columns = apply_filters( 'eighteen_tags_footer_widget_regions', 2 );
		} elseif ( is_active_sidebar( 'footer-1' ) ) {
			$widget_columns = apply_filters( 'eighteen_tags_footer_widget_regions', 1 );
		} else {
			$widget_columns = apply_filters( 'eighteen_tags_footer_widget_regions', 0 );
		}

		if ( $widget_columns > 0 ) : ?>

			<section class="footer-widgets col-<?php echo intval( $widget_columns ); ?> fix">

				<?php $i = 0; while ( $i < $widget_columns ) : $i++; ?>

					<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>

						<section class="block footer-widget-<?php echo intval( $i ); ?>">
				        	<?php dynamic_sidebar( 'footer-' . intval( $i ) ); ?>
						</section>

			        <?php endif; ?>

				<?php endwhile; ?>

			</section><!-- /.footer-widgets  -->

		<?php endif;
	}
}

if ( ! function_exists( 'eighteen_tags_credit' ) ) {
	/**
	 * Display the theme credit
	 * @since  1.0.0
	 * @return void
	 */
	function eighteen_tags_credit() {
		$title = __( 'Premium WordPress Themes & Plugins by pootlepress', 'eighteen-tags' );
		$link = "<a href='http://www.pootlepress.com' title='$title' rel='designer'>pootlepress</a>";
		$copy = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' )
		?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'eighteen_tags_copyright_text', $copy ) ); ?>
			<?php if ( apply_filters( 'eighteen_tags_credit_link', true ) ) { ?>
			<br /> <?php printf( __( '%1$s designed by %2$s.', 'eighteen-tags' ), 'Eighteen tags', $link ); ?>
			<?php } ?>
		</div><!-- .site-info -->
		<?php
	}
}
