<?php
/**
 * Template functions used for the site header.
 *
 * @package eighteen-tags
 */

if ( ! function_exists( 'eighteen_tags_header_widget_region' ) ) {
	/**
	 * Display header widget region
	 * @since  1.0.0
	 */
	function eighteen_tags_header_widget_region() {
		if ( is_active_sidebar( 'header-1' ) ) {
		?>
		<div class="header-widget-region" role="complementary">
			<div class="col-full">
				<?php dynamic_sidebar( 'header-1' ); ?>
			</div>
		</div>
		<?php
		}
	}
}

if ( ! function_exists( 'eighteen_tags_site_branding' ) ) {
	/**
	 * Display Site Branding
	 * @since  1.0.0
	 * @return void
	 */
	function eighteen_tags_site_branding() {
		if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} else { ?>
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php if ( '' != get_bloginfo( 'description' ) ) { ?>
					<p class="site-description"><?php echo bloginfo( 'description' ); ?></p>
				<?php } ?>
			</div>
		<?php }
	}
}

if ( ! function_exists( 'eighteen_tags_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function eighteen_tags_primary_navigation() {
		$post_type_field = '';
		$search_pt = explode( ',', get_theme_mod( 'eighteen-tags-pro-search-post_type', 'post,page' ) );
		if ( 1 < count( $search_pt ) ) {
			foreach( $search_pt as $pt ) {
				$post_type_field .= "<input type='hidden' name='post_type[]' value='{$pt}' />";
			}
		} else {
			$post_type_field = "<input type='hidden' name='post_type' value='{$search_pt[0]}' />";
		}
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'eighteen-tags' ); ?>">
			<div class="sfp-nav-search" style="display: none;">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
					<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'woocommerce' ); ?></label>
					<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
					<input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" />
					<?php echo $post_type_field ?>
				</form>
				<a class='sfp-nav-search-close'><i class='fa fa-close'></i></a>
			</div><!-- .sfp-nav-search -->
			<a class="menu-toggle" aria-controls="primary-navigation" aria-expanded="false"><?php echo esc_attr( apply_filters( 'eighteen_tags_menu_toggle_text', __( 'Navigation', 'eighteen-tags' ) ) ); ?></a>
			<?php
			wp_nav_menu(
				array(
					'theme_location'	=> 'primary',
					'container_class'	=> 'primary-navigation',
				)
			);

			wp_nav_menu(
				array(
					'theme_location'	=> 'handheld',
					'container_class'	=> 'handheld-navigation',
				)
			);

			do_action( 'eighteen_tags_pro_in_nav' );
			?>
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'eighteen_tags_secondary_navigation' ) ) {
	/**
	 * Display Secondary Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function eighteen_tags_secondary_navigation() {
		?>
		<nav class="secondary-navigation" role="navigation" aria-label="<?php _e( 'Secondary Navigation', 'eighteen-tags' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location'	=> 'secondary',
						'fallback_cb'		=> '',
					)
				);
			?>
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'eighteen_tags_skip_links' ) ) {
	/**
	 * Skip links
	 * @since  1.4.1
	 * @return void
	 */
	function eighteen_tags_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#site-navigation"><?php _e( 'Skip to navigation', 'eighteen-tags' ); ?></a>
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'eighteen-tags' ); ?></a>
		<?php
	}
}


