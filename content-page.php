<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package eighteen-tags
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * @hooked eighteen_tags_page_header - 10
	 * @hooked eighteen_tags_page_content - 20
	 */
	do_action( 'eighteen_tags_page' );
	?>
</article><!-- #post-## -->
