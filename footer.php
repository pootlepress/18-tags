<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package eighteen-tags
 */
?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'eighteen_tags_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">

			<?php
			/**
			 * @hooked eighteen_tags_footer_widgets - 10
			 * @hooked eighteen_tags_credit - 20
			 */
			do_action( 'eighteen_tags_footer' ); ?>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'eighteen_tags_after_footer' );
	if ( get_theme_mod( 'eighteen_tags_boxed_layout' ) ) {
		echo '</div>';
	}
	?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
