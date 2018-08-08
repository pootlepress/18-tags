<?php
wp_enqueue_style( 'flexslider', PRO18_URL . 'assets/css/flexslider.css' );
wp_enqueue_script( 'flexslider', PRO18_URL . 'assets/js/flexslider.min.js', array( 'jquery' ) );
?>

<div class="updated notice is-dismissible" id="eighteen-tags-welcome">
	<h1><?php _e( 'Thanks for installing 18 Tags!', 'eighteen-tags' ); ?>
	</h1>
	<h3>
		<?php printf(
			__( 'Choose a skin or %sStart from scratch%s.', 'eighteen-tags' ),
			'<a href="' . admin_url( 'customize.php' ) . '">', '</a>' ); ?>
	</h3>
	<?php /*
	<div class="col3-set">
		<div class="col">
			<a href="<?php echo admin_url( 'themes.php?page=eighteen-tags-welcome#help-videos' ) ?>">
				<i class="dashicons dashicons-video-alt3"></i>
				<h4>Watch intro videos</h4>
			</a>
		</div>
		<div class="col">
			<a href="<?php echo admin_url( 'themes.php?page=eighteen-tags-skins' ) ?>">
				<i class="dashicons dashicons-welcome-widgets-menus"></i>
				<h4>Choose a design</h4>
			</a>
		</div>
		<div class="col">
			<a href="<?php echo admin_url( 'customize.php' ) ?>">
				<i class="dashicons dashicons-admin-customizer"></i>
				<h4>Start from scratch</h4>
			</a>
		</div>
	</div>
*/ ?>

	<div id="eighteen-tags-skins">
		<div class="skins-carousel-wrap">
			<div class="dashicons carousel-left dashicons-arrow-left-alt2"></div>
			<div class="skins-carousel">
				<?php
				$skins = eighteen_tags_skins();
				$i = 0;
				foreach ( $skins as $id => $skin ) {
					if ( $i++ > 16 ) break;
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
							$skin_url = admin_url( 'customize.php?apply_skin' );

							echo "<a href='$skin_url=$name' class='skin-anchor'>";

							if ( isset( $skin['pro'] ) ) {
								echo '<div class="pro-badge">' . __( 'PRO', 'eighteen-tags' ) . '</div>';
							}

							echo '<div class="tooltip-btn">' . __( 'Preview skin', 'eighteen-tags' ) . '</div>';

						} else {
							echo "<a href='https://www.pootlepress.com/18-tags-pro/' class='skin-anchor'>";
							echo '<div class="pro-badge"><i class="dashicons dashicons-lock"></i> ' . __( 'PRO', 'eighteen-tags' ) . '</div>';
							echo '<div class="unlock-with-pro"><div class="unlock-with-pro-icon"></div>' . __( 'Unlock with PRO', 'eighteen-tags' ) . '</div>';
						}

						echo "<img src='$skin[img]'>";

						echo '</a>';
						?>
					</div>
					<?php
				}
				?>
			</div>
			<div class="dashicons carousel-right dashicons-arrow-right-alt2"></div>
		</div>
	</div>
	<script>
		jQuery( function ( $ ) {
			var diff,
				carouselScroll = 0,
				carouselItem = 0,
				$carousel = $( '.skins-carousel' );
			$( '.carousel-left' ).click( function() {
				carouselItem--;
				diff = $carousel.children().eq( 1 ).outerWidth();
				console.log( diff )
				$carousel.animate( { scrollLeft: '-=' + diff } );
			} );
			$( '.carousel-right' ).click( function() {
				carouselItem++;
				diff = $carousel.children().eq( 1 ).outerWidth();
				console.log( diff )
				$carousel.animate( { scrollLeft: '+=' + diff } );
			} );
		} );
	</script>
	<h2><a href="?page=eighteen-tags-skins">View all skins</a></h2>
</div>