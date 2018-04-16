<div class="boxed" id="new-user">
	<h3>Thanks for installing 18 Tags! Would you like some help getting your site started..?</h3>
	<div class="col3-set">
		<div class="col">
			<a href="<?php echo admin_url( 'themes.php?page=eighteen-tags-skins' ) ?>">
				<i class="dashicons dashicons-welcome-widgets-menus"></i>
				<h4>Choose a design</h4>
			</a>
		</div>
		<div class="col">
			<a href="#help-videos">
				<i class="dashicons dashicons-video-alt3"></i>
				<h4>Watch videos to learn more</h4>
			</a>
		</div>
		<div class="col">
			<a href="<?php echo admin_url( 'customize.php' ) ?>">
				<i class="dashicons dashicons-admin-customizer"></i>
				<h4>Start from scratch</h4>
			</a>
		</div>
	</div>
	<?php
	echo '<img src="' . get_template_directory_uri() . '/inc/admin/welcome-screen/img/pp.png' . '">';
	?>
</div>