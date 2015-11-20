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
 * @package storefront
 */

get_header();
include 'styles.php';

//Thumbnail args
if ( empty( $sfp_thumb_size ) ) {
	$sfp_thumb_size = 'thumbnail';
	$sfp_thumb_args = array();
}

$i = 0;
$posts_array = array();
?>

<div id="primary" class="content-area sfp-awesome-layout-<?php echo $layout ?>">
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
				storefront_post_thumbnail( $sfp_thumb_size, $sfp_thumb_args );
				the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
				echo '</a>';
				?>
			</header><!-- .entry-header -->
			<div class="entry-content" itemprop="articleBody">
				<?php Storefront_Pro::instance()->public->content_styles->blog_content(); ?>
			</div><!-- .entry-content -->
			<?php
			storefront_posted_on();
			storefront_post_meta();
			?>

		</article><!-- #post-## -->

			<?php
				$posts_array[ $i % $sfp_blog_across ][] = ob_get_clean();
			endwhile;
		foreach ( $posts_array as $posts ) {
			echo "<div class='col col-1-$sfp_blog_across'>";
			foreach ( $posts as $post ) {
				echo $post;
			}
			echo '</div>';
		}
		else :
			get_template_part( 'content', 'none' );
		endif;

		/**
		 * @hooked storefront_paging_nav - 10
		 */
		do_action( 'storefront_loop_after' );
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
