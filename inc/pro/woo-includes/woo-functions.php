<?php
/**
 * Functions used by plugins
 */
if ( ! class_exists( 'WC_Dependencies' ) )
	require_once 'class-wc-dependencies.php';

/**
 * WC Detection
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {
	function is_woocommerce_active() {
		return WC_Dependencies::woocommerce_active_check();
	}
}

/**
 * Queue updates for the WooUpdater
 */
if ( ! function_exists( 'pootlepress_queue_update' ) ) {
	function pootlepress_queue_update( $file, $file_id, $product_id ) {
		global $pootlepress_queued_updates;

		if ( ! isset( $pootlepress_queued_updates ) )
			$pootlepress_queued_updates = array();

		$plugin             = new stdClass();
		$plugin->file       = $file;
		$plugin->file_id    = $file_id;
		$plugin->product_id = $product_id;

		$pootlepress_queued_updates[] = $plugin;
	}
}

/**
 * Load installer for the pootlepress Updater.
 * @return $api Object
 */
if ( ! class_exists( 'pootlepress_Updater' ) && ! function_exists( 'pootlepress_updater_install' ) ) {
	function pootlepress_updater_install( $api, $action, $args ) {
		$download_url = 'http://woodojo.s3.amazonaws.com/downloads/pootlepress-updater/pootlepress-updater.zip';

		if ( 'plugin_information' != $action ||
			false !== $api ||
			! isset( $args->slug ) ||
			'pootlepress-updater' != $args->slug
		) return $api;

		$api = new stdClass();
		$api->name = 'pootlepress Updater';
		$api->version = '1.0.0';
		$api->download_link = esc_url( $download_url );
		return $api;
	}

	add_filter( 'plugins_api', 'pootlepress_updater_install', 10, 3 );
}

/**
 * WooUpdater Installation Prompts
 */
if ( ! class_exists( 'pootlepress_Updater' ) && ! function_exists( 'pootlepress_updater_notice' ) ) {

	/**
	 * Display a notice if the "pootlepress Updater" plugin hasn't been installed.
	 * @return void
	 */
	function pootlepress_updater_notice() {
		$active_plugins = apply_filters( 'active_plugins', get_option('active_plugins' ) );
		if ( in_array( 'pootlepress-updater/pootlepress-updater.php', $active_plugins ) ) return;

		$slug = 'pootlepress-updater';
		$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $slug ), 'install-plugin_' . $slug );
		$activate_url = 'plugins.php?action=activate&plugin=' . urlencode( 'pootlepress-updater/pootlepress-updater.php' ) . '&plugin_status=all&paged=1&s&_wpnonce=' . urlencode( wp_create_nonce( 'activate-plugin_pootlepress-updater/pootlepress-updater.php' ) );

		$message = '<a href="' . esc_url( $install_url ) . '">Install the pootlepress Updater plugin</a> to get updates for your pootlepress plugins.';
		$is_downloaded = false;
		$plugins = array_keys( get_plugins() );
		foreach ( $plugins as $plugin ) {
			if ( strpos( $plugin, 'pootlepress-updater.php' ) !== false ) {
				$is_downloaded = true;
				$message = '<a href="' . esc_url( admin_url( $activate_url ) ) . '">Activate the pootlepress Updater plugin</a> to get updates for your pootlepress plugins.';
			}
		}
		echo '<div class="updated fade"><p>' . $message . '</p></div>' . "\n";
	}

	add_action( 'admin_notices', 'pootlepress_updater_notice' );
}

/**
 * Prevent conflicts with older versions
 */
if ( ! class_exists( 'pootlepress_Plugin_Updater' ) ) {
	class pootlepress_Plugin_Updater { function init() {} }
}