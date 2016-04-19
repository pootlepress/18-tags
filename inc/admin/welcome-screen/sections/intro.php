<?php
/**
 * Welcome screen intro template
 */
?>
<?php
$eighteen_tags = wp_get_theme( '18-tags' );
?>
<div class="col two-col">
	<h1 class="sf-title"><?php echo '<strong>Eighteen tags</strong> <sup class="version">' . esc_attr( $eighteen_tags['Version'] ) . '</sup>'; ?></h1>

	<section class="sf-review">
		<p><?php echo sprintf( esc_html__( '%sEnjoying %s?%s Why not %sleave a review%s on WordPress.org? We\'d really appreciate it!', 'eighteen-tags' ), '<strong>', 'Eighteen tags', '</strong>', '<a href="https://wordpress.org/themes/eighteen-tags">', '</a>' ); ?></p>
	</section>

</div>