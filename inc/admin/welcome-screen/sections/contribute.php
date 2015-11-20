<?php
/**
 * Welcome screen contribute template
 */
?>
<?php

?>
<div class="col two-col" style="overflow: hidden;">
	<div class="col boxed contribute">
		<h2><?php esc_html_e( 'Contribute to Eighteen tags', 'eighteen-tags' ); ?></h2>
		<p><?php printf( esc_html__( 'Found a bug? Want to contribute a patch or create a new feature? %sGitHub is the place to go!%s Or would you like to translate %s into your language? %sGet involved on WordPress.org%s.', 'eighteen-tags' ), '<a href="https://github.com/pootlepress/eighteen-tags">', '</a>', 'Eighteen tags', '<a href="https://translate.wordpress.org/projects/wp-themes/eighteen-tags">', '</a>' ); ?></p>
	</div>

	<div class="col boxed suggest">
		<h2><?php esc_html_e( 'Suggest a feature', 'eighteen-tags' ); ?></h2>
		<p><?php printf( esc_html__( 'Please suggest and vote on ideas at the %s%s Ideasboard%s. The most popular ideas will see prioritised development.', 'eighteen-tags' ), '<a href="http://ideas.pootlepress.com/forums/275029-eighteen-tags">', 'Eighteen tags', '</a>' ); ?></p>
	</div>

	<div class="automattic">
		<p>
		<?php printf( esc_html__( 'An %s project', 'eighteen-tags' ), '<a href="https://automattic.com/"><img src="' . esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/automattic.png' . '" alt="Automattic" /></a>' ); ?>
		</p>
	</div>
</div>