<div class="wrap" id="skins">
	<h1 style='margin-right:auto'>18Tags skins</h1>

	<?php settings_errors(); ?>

	<?php
	$reset_url = wp_nonce_url(
		       admin_url(
			       'admin-ajax.php?redirect=' .
			       urlencode( admin_url( 'themes.php?page=eighteen-tags-skins' ) )
		       ),
		       '18tags_apply_skin'
	       ) . '&action=18tags_reset';

	$skin_url = admin_url( "customize.php?apply_skin" );
	?>
	<div class="boxed">
		<?php
		echo "<div class='skin'><a href='$reset_url' class='skin-anchor'><img src='" . get_template_directory_uri() . "/assets/reset.png'><span>Reset settings</span></a></div>";
		$skins = eighteen_tags_skins();
		foreach ( $skins as $name => $skin ) {
			if ( isset( $skin['name'] ) ) {
				$name = $skin['name'];
			}
			if ( ! isset( $skin['img'] ) ) {
				$skin['img'] = 'https://image.freepik.com/free-vector/modern-geometric-infographic-template_1201-1154.jpg';
			}
			?>
			<div class='skin'>
				<?php
				if ( ! isset( $skin['pro'] ) || class_exists( 'Eighteen_Tags_Pro' ) ) {

					echo "<a href='$skin_url=$name' class='skin-anchor'>";

					if ( isset( $skin['pro'] ) )
						echo '<div class="pro-badge">PRO</div>';

				} else {

					echo "<a href='https://www.pootlepress.com/18-tags-pro/' class='skin-anchor'>";
					echo '<div class="pro-badge"><i class="dashicons dashicons-lock"></i> PRO</div>';
					echo '<div class="unlock-with-pro"><div class="unlock-with-pro-icon"></div>Unlock with PRO</div>';

				}

				echo "<img src='$skin[img]'><span>$name</span>";

				echo '</a>';
				?>
			</div>
			<?php
		}
		?>
	</div>
</div>