<?php
/**
 * Welcome screen enhance template
 */
?>
<?php

?>
<div class="col two-col" style="overflow: hidden;">
	<div class="col">
		<div class="boxed enhance">
			<h2><?php printf( esc_html__( 'Enhance %s', 'eighteen-tags' ), 'Eighteen tags' ); ?></h2>
			<p>
				<?php printf( esc_html__( 'Take a look at our range of extensions that compliment and extend %s functionality.', 'eighteen-tags' ), 'Eighteen tags\'s' ); ?>
			</p>

			<ul class="extensions">
				<li><a href="https://www.pootlepress.com/products/eighteen-tags-woocommerce-customiser?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons">WooCommerce Customiser</a></li>
				<li><a href="https://www.pootlepress.com/products/eighteen-tags-product-hero?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons">Product Hero</a></li>
				<li><a href="https://www.pootlepress.com/products/eighteen-tags-parallax-hero?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons">Parallax Hero</a></li>
				<li><a href="https://www.pootlepress.com/products/eighteen-tags-designer?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons">Designer</a></li>
				<li><a href="https://www.pootlepress.com/products/eighteen-tags-checkout-customiser/?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons">Checkout Customiser</a></li>
				<li><a href="https://www.pootlepress.com/products/eighteen-tags-reviews?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons">Reviews</a></li>
				<li><a href="https://www.pootlepress.com/products/eighteen-tags-pricing-tables?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons">Pricing Tables</a></li>
				<li><a href="https://www.pootlepress.com/products/eighteen-tags-blog-customiser?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons">Blog Customiser</a></li>
			</ul>

			<a href="http://www.pootlepress.com/product-category/eighteen-tags-extensions?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons" class="button button-primary">
				<?php printf( esc_html__( 'View all %s extensions &rarr;', 'eighteen-tags' ), 'Eighteen tags' ); ?>
			</a>

		</div>

		<div class="boxed free-plugins">
			<h2><?php esc_html_e( 'Install free plugins', 'eighteen-tags' ); ?></h2>
			<p>
				<?php echo sprintf( esc_html__( 'There are a number of free plugins available for %s on the WordPress.org %splugin repository%s. Here are just a few:', 'eighteen-tags' ), 'Eighteen tags', '<a href="https://wordpress.org/plugins/search.php?q=eighteen-tags">', '</a>' ); ?>
			</p>
			<ul class="extensions">
				<li><a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=eighteen-tags-product-pagination&TB_iframe=true&width=744&height=800' ), 'install-plugin_eighteen-tags-product-pagination' ) ); ?>">Product Pagination</a></li>
				<li><a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=eighteen-tags-product-sharing&TB_iframe=true&width=744&height=800' ), 'install-plugin_eighteen-tags-product-sharing' ) ); ?>">Product Sharing</a></li>
				<li><a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=eighteen-tags-footer-bar&TB_iframe=true&width=744&height=800' ), 'install-plugin_eighteen-tags-footer-bar' ) ); ?>">Footer Bar</a></li>
				<li><a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=eighteen-tags-sticky-add-to-cart&TB_iframe=true&width=744&height=800' ), 'install-plugin_eighteen-tags-sticky-add-to-cart' ) ); ?>">Sticky Add to Cart</a></li>
			</ul>
		</div>
	</div>

	<div class="col boxed child-themes">
		<h2><?php esc_html_e( 'Child themes', 'eighteen-tags' ); ?></h2>
		<p><?php printf( esc_html__( 'Take a look at our range of child themes for %s that allow you to easily change the look of your store to suit a specific industry.', 'eighteen-tags' ), 'Eighteen tags' ); ?></p>

		<div class="child-theme">
			<a href="http://www.pootlepress.com/products/outlet?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/outlet.jpg'; ?>" alt="<?php esc_html_e( 'Proshop Child Theme', 'eighteen-tags' ); ?>" class="image-50" />
				<span class="child-theme-title">Outlet</span>
			</a>
		</div>

		<div class="child-theme">
			<a href="http://www.pootlepress.com/products/proshop?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/proshop.jpg'; ?>" alt="<?php esc_html_e( 'Proshop Child Theme', 'eighteen-tags' ); ?>" class="image-50" />
				<span class="child-theme-title">ProShop</span>
			</a>
		</div>

		<div class="child-theme">
			<a href="http://www.pootlepress.com/products/galleria?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/galleria.jpg'; ?>" alt="<?php esc_html_e( 'Galleria Child Theme', 'eighteen-tags' ); ?>" class="image-50" />
				<span class="child-theme-title">Galleria</span>
			</a>
		</div>

		<div class="child-theme">
			<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=boutique' ), 'install-theme_boutique' ) ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/boutique.jpg'; ?>" alt="<?php esc_html_e( 'Boutique Child Theme', 'eighteen-tags' ); ?>" class="image-50" />
				<p class="free"><?php esc_html_e( 'Free!', 'eighteen-tags' ); ?></p>
				<span class="child-theme-title">Boutique</span>
			</a>
		</div>

		<a href="http://www.pootlepress.com/product-category/themes/eighteen-tags-child-theme-themes?utm_source=product&utm_medium=upsell&utm_campaign=eighteen-tagsaddons" class="button button-primary">
			<?php printf( esc_html__( 'View all %s child themes &rarr;', 'eighteen-tags' ), 'Eighteen tags' ); ?>
		</a>
	</div>
</div>