<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package eighteen-tags
 */

get_header();
include get_template_directory() . '/inc/styles.php';
# region Title on top
$layout = get_option( 'etp_post_layout' );
if ( 'title-top' == $layout ) {
	?>
	<div class="col-full">
		<?php
		the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
		if ( ! get_theme_mod( 'eighteen-tags-pro-remove-single-post-meta' ) ) {
			?>
			<div class="post-meta-container">
				<?php
				eighteen_tags_posted_on();
				eighteen_tags_post_meta();
				?>
			</div>
			<?php
		}
		?>
	</div><!-- .col-full -->
	<?php
}
# endregion
?>
<header class="entry-header">
	<?php
	if ( has_post_thumbnail( get_the_ID() ) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		$class = "class='etp-full-width-image-bg'";
		echo "<div $class style=\"background-image:url('$image[0]')\"></div>";
		?>

		<?php
	} else {
		?>
		<div class="margin-bottom"></div>
		<?php
	}
	?>
</header><!-- .entry-header -->

<div class="col-full">
<div id="primary" class="content-area etp-awesome-layout-1">
	<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">
					<?php
					# region title not on top
					if ( 'title-top' != $layout ) {
						?>
						<div class="col-full">
							<?php
							the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
							if ( ! get_theme_mod( 'eighteen-tags-pro-remove-single-post-meta' ) ) {
								?>
								<div class="post-meta-container">
									<?php
									eighteen_tags_posted_on();
									eighteen_tags_post_meta();
									?>
								</div>
								<?php
							}
							?>
						</div><!-- .col-full -->
						<?php
					}
					# endregion
					?>
					<div class="col-full">
						<div class="entry-content" itemprop="articleBody">
							<?php the_content( sprintf( __( 'Continue reading %s', 'eighteen-tags' ), get_the_title() ) ); ?>
						</div><!-- .entry-content -->
					</div><!-- .col-full -->

				</article><!-- #post-## -->

				<div class="col-full">
					<?php
					/**
					 * @hooked eighteen_tags_post_nav - 10
					 */
					do_action( 'eighteen_tags_single_post_after' );
					?>
				</div><!-- .col-full -->
				<?php
			endwhile;
		else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

	<?php
	if ( get_theme_mod( 'eighteen-tags-pro-single-keep-sidebar' ) ) {
		do_action( 'eighteen_tags_sidebar' );
	} else {
		?>
		<style>
			@media only screen and (min-width: 763px) {
				.eighteen-tags-pro-active #primary {
					width: 100%;
				}
			}
		</style>
		<?php
	}
	?>
</div>
<?php
get_footer();
