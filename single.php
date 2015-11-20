<?php
/**
 * The template for displaying all single posts.
 *
 * @package eighteen-tags
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			do_action( 'eighteen_tags_single_post_before' );

			get_template_part( 'content', 'single' );

			/**
			 * @hooked eighteen_tags_post_nav - 10
			 * @hooked eighteen_tags_display_comments - 20
			 */
			do_action( 'eighteen_tags_single_post_after' );
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action( 'eighteen_tags_sidebar' ); ?>
<?php get_footer(); ?>
