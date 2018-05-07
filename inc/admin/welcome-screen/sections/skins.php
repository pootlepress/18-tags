<div class="wrap" id="skins">
	<h1 style='margin-right:auto'>18Tags skins</h1>

	<?php settings_errors(); ?>

	<?php
	$skin_url = admin_url( "customize.php?apply_skin" );
	?>
	<div class="boxed">

		<?php
		if ( isset( $_GET['just-installed'] ) ) {
			?>
			<h1>Thanks for installing 18 Tags!</h1>
			<h3>
				Please choose a skin below or <a href="<?php echo admin_url( 'customize.php' ) ?>">start from scratch</a>
			</h3>
			<?php
		}
		?>
		<div class="skins">
			<?php
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

						if ( isset( $skin['pro'] ) ) {
							echo '<div class="pro-badge">PRO</div>';
						}

						echo '<div class="tooltip-btn">Preview skin</div>';

					} else {

						echo "<a href='https://www.pootlepress.com/18-tags-pro/' class='skin-anchor'>";
						echo '<div class="pro-badge"><i class="dashicons dashicons-lock"></i> PRO</div>';
						echo '<div class="unlock-with-pro"><div class="unlock-with-pro-icon"></div>Unlock with PRO</div>';
//						echo '<div class="tooltip-btn">Unlock with pro</div>';

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
</div>