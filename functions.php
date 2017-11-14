<?php
/**
 * eighteen-tags engine room
 *
 * @package eighteen-tags
 * @developer shramee <shramee.srivastav@gmail.com>
 */

define( 'EIGHTEENTAGS_VERSION', '2.2.0' );

// Create a helper function for easy SDK access.
function eighteen_tags_fs() {
	global $eighteen_tags_fs;

	if ( ! isset( $eighteen_tags_fs ) ) {
		// Include Freemius SDK.
		require_once get_template_directory() . '/wp-sdk/start.php';

		$eighteen_tags_fs = fs_dynamic_init( array(
			'id'             => '1053',
			'slug'           => 'eighteen-tags',
			'type'           => 'theme',
			'public_key'     => 'pk_9e49400ad7036836549c80945771d',
			'is_premium'     => false,
			'has_addons'     => false,
			'has_paid_plans' => false,
			'menu'           => array(
				'slug'           => 'eighteen-tags-welcome',
				'override_exact' => true,
				'support'        => false,
				'parent'         => array(
					'slug' => 'themes.php',
				),
			),
		) );
    }

    return $eighteen_tags_fs;
}

// Init Freemius.
eighteen_tags_fs();
// Signal that SDK was initiated.
do_action( 'eighteen_tags_fs_loaded' );

function eighteen_tags_fs_settings_url() {
    return admin_url( 'themes.php?page=eighteen-tags-welcome' );
}

eighteen_tags_fs()->add_filter( 'connect_url', 'eighteen_tags_fs_settings_url' );
eighteen_tags_fs()->add_filter( 'after_skip_url', 'eighteen_tags_fs_settings_url' );
eighteen_tags_fs()->add_filter( 'after_connect_url', 'eighteen_tags_fs_settings_url' );
eighteen_tags_fs()->add_filter( 'after_pending_connect_url', 'eighteen_tags_fs_settings_url' );// Signal that SDK was initiated.

/**
 * Initialize all the things.
 */

require_once get_template_directory() . '/inc/init.php';

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/pootlepress/customisations
 */