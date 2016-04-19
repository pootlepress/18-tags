<?php
/**
 * Welcome screen enhance template
 */
$vimeo = 'https://player.vimeo.com/video';
$video_args = array(
	'height' => '720',
	'width' => '1280',
)
?>
<div class="col">
	<div class="boxed video">
		<h2><?php _e( 'How to customize the header and menus', 'eighteen-tags' ); ?></h2>
		<div class="video-wrapper">
			<?php echo wp_oembed_get( "$vimeo/149726503?byline=0&portrait=0", $video_args ) ?>
		</div>
	</div>
	<div class="boxed video">
		<h2><?php _e( 'How to add social media icons and contact information', 'eighteen-tags' ); ?></h2>
		<div class="video-wrapper">
			<?php echo wp_oembed_get( "$vimeo/149732200?byline=0&portrait=0", $video_args ) ?>
		</div>
	</div>
	<div class="boxed video">
		<h2><?php _e( 'How to customize fonts', 'eighteen-tags' ); ?></h2>
		<div class="video-wrapper">
			<?php echo wp_oembed_get( "$vimeo/149730861?byline=0&portrait=0", $video_args ) ?>
		</div>
	</div>
	<div class="boxed video">
		<h2><?php _e( 'How to create mega menus', 'eighteen-tags' ); ?></h2>
		<div class="video-wrapper">
			<?php echo wp_oembed_get( "$vimeo/149730121?byline=0&portrait=0", $video_args ) ?>
		</div>
	</div>
	<div class="boxed video">
		<h2><?php _e( 'How to customize your blog', 'eighteen-tags' ); ?></h2>
		<div class="video-wrapper">
			<?php echo wp_oembed_get( "$vimeo/149730323?byline=0&portrait=0", $video_args ) ?>
		</div>
	</div>
	<div class="boxed video">
		<h2><?php _e( 'How to customize individual pages', 'eighteen-tags' ); ?></h2>
		<div class="video-wrapper">
			<?php echo wp_oembed_get( "$vimeo/149730785?byline=0&portrait=0", $video_args ) ?>
		</div>
	</div>
	<div class="boxed video">
		<h2><?php _e( 'How to customize the footer', 'eighteen-tags' ); ?></h2>
		<div class="video-wrapper">
			<?php echo wp_oembed_get( "$vimeo/149730772?byline=0&portrait=0", $video_args ) ?>
		</div>
	</div>
</div>
