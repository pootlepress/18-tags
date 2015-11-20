<?php
/**
 * @package eighteen-tags
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php
	/**
	 * @hooked eighteen_tags_post_header - 10
	 * @hooked eighteen_tags_post_meta - 20
	 * @hooked eighteen_tags_post_content - 30
	 */
	do_action( 'eighteen_tags_single_post' );
	?>

</article><!-- #post-## -->
