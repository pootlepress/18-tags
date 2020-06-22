<?php
/**
 * eighteen-tags engine room
 *
 * @package eighteen-tags
 * @developer shramee <shramee.srivastav@gmail.com>
 */

define( 'EIGHTEENTAGS_VERSION', '3.0.0' );

function eighteen_tags_fs() {
	global $eighteen_tags_fs;

	if ( ! isset( $eighteen_tags_fs ) ) {
		// Include Freemius SDK.
		require_once dirname(__FILE__) . '/wp-sdk/start.php';

		$eighteen_tags_fs = fs_dynamic_init( array(
			'id'                  => '1053',
			'slug'                => 'eighteen-tags',
			'type'                => 'theme',
			'public_key'          => 'pk_9e49400ad7036836549c80945771d',
			'is_premium'          => false,
			'has_addons'          => false,
			'has_paid_plans'      => false,
			'menu'                => array(
				'slug'           => 'eighteen-tags-skins',
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

/**
 * Initialize all the things.
 */

require_once get_template_directory() . '/inc/init.php';

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/pootlepress/customisations
 */