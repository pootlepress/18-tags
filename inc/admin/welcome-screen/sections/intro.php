<?php
/**
 * Welcome screen intro template
 */
?>
<h1 style='margin-right:auto'>
	<?php echo '<strong>Eighteen tags</strong>
	<sup class="version">' . esc_attr( EIGHTEENTAGS_VERSION ) . '</sup>'; ?>
</h1>

<p><?php echo sprintf( esc_html__( '%sEnjoying %s?%s Why not %sleave a review%s on WordPress.org? We\'d really appreciate it!', 'eighteen-tags' ), '<strong>', 'Eighteen tags', '</strong>', '<a href="https://wordpress.org/themes/eighteen-tags">', '</a>' ); ?></p>

<br>
<?php settings_errors(); ?>
<br>