<?php
/**
 * eighteen-tags engine room
 *
 * @package eighteen-tags
 * @developer shramee <shramee.srivastav@gmail.com>
 */

/**
 * Initialize all the things.
 */
require_once get_template_directory() . '/inc/init.php';

add_action('after_switch_theme', 'eighteen_tags_activated');

function eighteen_tags_activated() {
	$slug = get_option( 'stylesheet' );
	$v1_options = get_option( 'theme_mods_18-tags-1.0.0' );
	if ( $v1_options && array( '' ) == get_option( 'theme_mods_' . $slug ) ) {
		update_option( 'theme_mods_' . $slug, $v1_options );
	}

	$ppb_url = admin_url( 'plugin-install.php?tab=plugin-information&plugin=pootle-page-builder&TB_iframe=true' );
	eighteen_tags_add_notice(
		sprintf(
			__( 'Kindly check out the cool %sPootle Page Builder%s Plugin', 'eighteen-tags' ),
			"<a href='$ppb_url' class='thickbox' title='pootle page builder'>", '</a>'
		),
		'plugins'
	);

}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/pootlepress/customisations
 */