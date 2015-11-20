<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package eighteen-tags
 */
global $etp_blog_across;
$etp_thumb_size = 'medium';
$etp_thumb_args = array( 'class' => "etp-full-width", );
//if ( 3 > $etp_blog_across ) {
//	$etp_thumb_size = 'large';
//}

include 'home-left-image.php';
