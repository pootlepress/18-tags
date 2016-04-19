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

//Thumbnail args
if ( empty( $etp_thumb_size ) ) {
	$etp_thumb_size = 'thumbnail';
	$etp_thumb_args = array();
}

$i = 0;
$posts_array = array();
?>

<div id="primary" class="content-area etp-awesome-layout-<?php echo $layout ?>">
	<main id="main" class="site-main section group" role="main">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				$i++;
				ob_start();
			?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">
			<header class="entry-header">
				<?php
				echo sprintf( '<a href="%s" rel="bookmark">', get_permalink() );
				eighteen_tags_post_thumbnail( $etp_thumb_size, $etp_thumb_args );
				the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
				echo '</a>';
				if ( ! get_theme_mod( 'eighteen-tags-pro-remove-archive-post-meta' ) ) {
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
			</header><!-- .entry-header -->
			<div class="entry-content" itemprop="articleBody">
				<?php Eighteen_Tags_Pro::instance()->public->content_styles->blog_content(); ?>
			</div><!-- .entry-content -->

		</article><!-- #post-## -->

			<?php
				$posts_array[ $i % $etp_blog_across ][] = ob_get_clean();
			endwhile;
		foreach ( $posts_array as $posts ) {
			echo "<div class='col col-1-$etp_blog_across'>";
			foreach ( $posts as $post ) {
				echo $post;
			}
			echo '</div>';
		}
		else :
			get_template_part( 'content', 'none' );
		endif;

		/**
		 * @hooked eighteen_tags_paging_nav - 10
		 */
		do_action( 'eighteen_tags_loop_after' );
		?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php
if ( Eighteen_Tags_Pro::instance()->public->get( 'blog-show-sidebar' ) ) {
	get_sidebar();
	?>
	<style>
	@media screen and (min-width: 768px) {
		.eighteen-tags-pro-active div#primary {
			width: 73.9130434783%;
			float: left;
			margin-right: 4.347826087%;
		}
	}
	</style>
	<?php
}
get_footer();
?>
