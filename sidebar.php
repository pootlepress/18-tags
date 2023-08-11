<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package eighteen-tags
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	?>
	<style>
		.right-sidebar .content-area,
		.left-sidebar .content-area {
			width: 100%;
			float: none;
			margin: 0;
		}
	</style>
	<?php
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
