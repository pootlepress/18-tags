<?php
$layout = str_replace( '-image', '', get_theme_mod( 'eighteen-tags-pro-blog-layout', 'full-image' ) );
?>
<style>

.single.etp-nav-styleleft-vertical #content > .col-full{
	padding: 0;
}


.eighteen-tags-pro-active.single #content > .col-full,
.eighteen-tags-pro-active.single #content > .jscroll-inner > .col-full {
	margin: 0;
	max-width: none;
}

.wp-post-image {
	display: block;
	margin: auto;
}

.etp-full-width {
	width: 100%;
}

.etp-awesome-layout-full .wp-post-image.etp-full-width {
	margin: 0 0 1em;
}

.etp-full-width-image-bg {
	width: 100%;
	margin-bottom: 1.2em;
	padding-top : 42.85%;
	background-size: cover;
	position: relative;
}

#kickass-feat > .col-full {
	margin : 0;
	padding : 1em;
}

.single #masthead, .single .woocommerce-breadcrumb {
	margin-bottom: 0;
}

.attachment-thumbnail {
	max-width: 50%;
}

.archive .wp-post-image,
.blog .wp-post-image{
	float: <?php echo $layout ?>;
	margin: 0 1em 1em;
	margin-<?php echo $layout ?>: 0;
}

.entry-title {
	clear: none;
}

.blog .entry-title:after {
	content: '';
	display: block;
	clear: both;
}

.hentry.type-post .entry-content {
	float: none;
}

.entry-content:after {
	content: '';
	display: block;
	clear: both;
}

@media only screen and (min-width: 770px) {
	.eighteen-tags-pro-active .hentry.type-post .entry-content {
		width: 100%;
	}

	.eighteen-tags-pro-active .hentry.type-post .entry-meta {
		font-size: .857em;
		width: 100%;
	}

	#kickass-feat .col-full:before {
		content: '';
		height: 100%;
		width: 0;
	}
	#kickass-feat .col-full:before, #kickass-feat .col-full h1 {
		display: inline-block;
		vertical-align: bottom;
		max-width: 97%;
	}

	.eighteen-tags-pro-active #kickass-feat .col-full {
		background: rgba( 255, 255, 255, 0.5 );
		max-width: none;
		text-align: center;
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		height: 100%;
		font-size: 2.5em;
	}
}
@media only screen and (max-width: 767px) {
	#kickass-feat {
		padding-top : 0;
	}

	#kickass-feat .col-full{
		padding: 1px;
		background: rgba( 255, 255, 255, 0.5 );
	}

	#kickass-feat .col-full h1 {
		padding: 1px;
		text-align: center;
		margin-top: 2em;
		margin-bottom: 2em;
	}

}
</style>