<div class="wrap" id="skins">
	<h1 style='margin-right:auto'>18Tags skins</h1>

	<?php settings_errors(); ?>

	<?php
	if ( isset( $_GET['skin_applied'] ) ) {
		$notice = sprintf( __( '%s Skin applied.', 'eighteen-tags' ), "&quot;<b>$_GET[skin_applied]</b>&quot;" );
		echo "<div class='notice is-dismissible updated'><p>$notice</p></div>";
	}

	$url = wp_nonce_url(
		admin_url(
			'admin-ajax.php?action=18tags_apply_skin&redirect=' .
			urlencode( admin_url( 'themes.php?page=eighteen-tags-skins' ) )
		),
		'18tags_apply_skin'
	);
	?>
	<div class="boxed">
		<?php
		$skins = eighteen_tags_skins();
		foreach ( $skins as $name => $skin ) {
			echo "<a href='$url&skin=$name' class='skin'><img src='$skin[img]'><span>$name</span></a>";
		}
		?>
	</div>
</div>