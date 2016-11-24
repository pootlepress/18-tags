<?php
/**
 * Eighteen tags class
 * @developer http://wpdevelopment.me <shramee@wpdevelopment.me>
 */

/**
 * Supported control types
 * * text
 * * checkbox
 * * radio (requires choices array in $args)
 * * select (requires choices array in $args)
 * * dropdown-pages
 * * textarea
 * * color
 * * image
 * * sf-text
 * * sf-heading
 * * sf-divider
 *
 * sf- prefixed controls are arbitrary eighteen-tags controls
 *
 * NOTE : sf-text control doesn't show anything if description is not set but
 * in Eighteen_Tags_Pro_Customizer_Fields class we assign it to label
 * if not set ;)
 *
 */
function eighteen_tags_pro_fields() {
	$fields = array(
		//Primary Nav
		array(
			'id'      => 'nav-style',
			'label'   => 'Navigation Style',
			'section' => 'Primary Navigation',
			'type'    => 'select',
			'choices' => array(
				''              => 'Default',
				'right'         => 'Align right',
				'center'        => 'Centered',
				'center-inline' => 'Centred inline logo',
				'left-vertical' => 'Left vertical',
				'left-vertical hamburger' => 'Hamburger',
			),
		),
		array(
			'id'      => 'pri-nav-label',
			'label'   => 'Hamburger Label',
			'section' => 'Primary Navigation',
			'type'    => 'text',
		),
		array(
			'id'      => 'pri-nav-font',
			'label'   => 'Font',
			'section' => 'Primary Navigation',
			'type'    => 'font',
			'default' => 'Montserrat',
		),
		array(
			'id'          => 'pri-nav-text-size',
			'label'       => 'Text size',
			'section'     => 'Primary Navigation',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 5,
				'max'  => 25,
				'step' => 1,
			),
		),
		array(
			'id'          => 'pri-nav-letter-spacing',
			'label'       => 'Letter spacing',
			'section'     => 'Primary Navigation',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => - 2,
				'max'  => 10,
				'step' => 1,
			),
		),
		array(
			'id'      => 'pri-nav-font-style',
			'label'   => 'Font style',
			'section' => 'Primary Navigation',
			'type'    => 'multi-checkbox',
			'choices' => array(
				'bold'      => 'Bold',
				'italic'    => 'Italic',
				'underline' => 'Underline',
				'uppercase' => 'Uppercase',
			),
		),
		array(
			'id'      => 'pri-nav-text-color',
			'label'   => 'Text color',
			'section' => 'Primary Navigation',
			'type'    => 'color',
		),
		array(
			'id'      => 'pri-nav-active-link-color',
			'label'   => 'Active link color',
			'section' => 'Primary Navigation',
			'type'    => 'color',
		),
		array(
			'id'      => 'pri-nav-bg-color',
			'label'   => 'Background color',
			'section' => 'Primary Navigation',
			'type'    => 'alpha-color',
		),
		array(
			'id'      => 'pri-nav-dd-bg-color',
			'label'   => 'Drop down menu background color',
			'section' => 'Primary Navigation',
			'type'    => 'alpha-color',
			'default' => '#000',
		),
		array(
			'id'      => 'pri-nav-dd-text-color',
			'label'   => 'Drop down menu text color',
			'section' => 'Primary Navigation',
			'type'    => 'color',
			'default' => '#ffffff',
		),
		array(
			'id'      => 'pri-nav-dd-animation',
			'label'   => 'Drop down menu animation',
			'section' => 'Primary Navigation',
			'type'    => 'select',
			'choices' => array(
				''       => 'Default',
				'fade'   => 'Fade',
				'expand' => 'Expand',
				'slide'  => 'Slide',
				'flip'   => 'Flip',
			),
		),
		array(
			'id'          => 'pri-nav-height',
			'label'       => 'Menu height',
			'section'     => 'Primary Navigation',
			'type'        => 'range',
			'default'     => 1.3,
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 2.5,
				'step' => 0.1,
			),
		),
		array(
			'id'      => 'remove-search-icon',
			'label'   => 'Remove search icon from nav',
			'section' => 'Primary Navigation',
			'type'    => 'checkbox',
		),
		//Secondary Nav
		array(
			'id'      => 'sec-nav-full',
			'label'   => 'Make full width',
			'section' => 'Secondary Navigation',
			'type'    => 'checkbox',
		),
		array(
			'id'      => 'sec-nav-font',
			'label'   => 'Font',
			'section' => 'Secondary Navigation',
			'type'    => 'font',
		),
		array(
			'id'          => 'sec-nav-text-size',
			'label'       => 'Text size',
			'section'     => 'Secondary Navigation',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 5,
				'max'  => 25,
				'step' => 1,
			),
			'default'     => '',
		),
		array(
			'id'          => 'sec-nav-letter-spacing',
			'label'       => 'Letter spacing',
			'section'     => 'Secondary Navigation',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => - 2,
				'max'  => 10,
				'step' => 1,
			),
		),
		array(
			'id'      => 'sec-nav-font-style',
			'label'   => 'Font style',
			'section' => 'Secondary Navigation',
			'type'    => 'multi-checkbox',
			'choices' => array(
				'bold'      => 'Bold',
				'italic'    => 'Italic',
				'underline' => 'Underline',
				'uppercase' => 'Uppercase',
			),
		),
		array(
			'id'      => 'sec-nav-bg-color',
			'label'   => 'Background color',
			'section' => 'Secondary Navigation',
			'type'    => 'alpha-color',
		),
		array(
			'id'      => 'sec-nav-text-color',
			'label'   => 'Text color',
			'section' => 'Secondary Navigation',
			'type'    => 'color',
		),
		array(
			'id'      => 'sec-nav-active-link-color',
			'label'   => 'Active link color',
			'section' => 'Secondary Navigation',
			'type'    => 'color',
		),
		array(
			'id'      => 'sec-nav-dd-bg-color',
			'label'   => 'Drop down menu background color',
			'section' => 'Secondary Navigation',
			'type'    => 'alpha-color',
		),
		array(
			'id'      => 'sec-nav-dd-text-color',
			'label'   => 'Drop down menu text color',
			'section' => 'Secondary Navigation',
			'type'    => 'color',
		),
		// Title and tagline
		array(
			'id'          => 'site-title-font-size',
			'label'       => 'Title font size',
			'section'     => 'existing_title_tagline',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 5,
				'max'  => 52,
				'step' => 1,
			),
		),
		array(
			'id'      => 'site-title-font-style',
			'label'   => 'Title font style',
			'section' => 'existing_title_tagline',
			'type'    => 'multi-checkbox',
			'choices' => array(
				'bold'      => 'Bold',
				'italic'    => 'Italic',
				'underline' => 'Underline',
				'uppercase' => 'Uppercase',
			),
		),
		array(
			'id'      => 'site-title-font',
			'label'   => 'Title font',
			'section' => 'existing_title_tagline',
			'type'    => 'font',
		),
		array(
			'id'      => 'site-title-color',
			'label'   => 'Title color',
			'section' => 'existing_title_tagline',
			'type'    => 'color',
		),
		array(
			'id'          => 'site-tagline-font-size',
			'label'       => 'Tagline font size',
			'section'     => 'existing_title_tagline',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 5,
				'max'  => 34,
				'step' => 1,
			),
		),
		array(
			'id'      => 'site-tagline-font-style',
			'label'   => 'Tagline font style',
			'section' => 'existing_title_tagline',
			'type'    => 'multi-checkbox',
			'choices' => array(
				'bold'      => 'Bold',
				'italic'    => 'Italic',
				'underline' => 'Underline',
				'uppercase' => 'Uppercase',
			),
		),
		array(
			'id'      => 'site-tagline-font',
			'label'   => 'Tagline font',
			'section' => 'existing_title_tagline',
			'type'    => 'font',
		),
		array(
			'id'      => 'site-tagline-color',
			'label'   => 'Tagline color',
			'section' => 'existing_title_tagline',
			'type'    => 'color',
		),
		//Header Elements
		array(
			'id'          => 'logo-max-height',
			'label'       => 'Logo max height',
			'section'     => 'existing_header_image',
			'type'        => 'range',
			'default'     => 100,
			'priority'    => 1,
			'input_attrs' => array(
				'min'  => 50,
				'max'  => 250,
				'step' => 1,
			),
		),
		array(
			'id'      => 'phone-num',
			'label'   => 'Phone Number',
			'section' => 'existing_header_image',
			'type'    => 'text',
		),
		array(
			'id'      => 'email',
			'label'   => 'Email',
			'section' => 'existing_header_image',
			'type'    => 'text',
		),
		array(
			'id'      => 'facebook',
			'label'   => 'Facebook profile URL',
			'section' => 'existing_header_image',
			'type'    => 'text',
		),
		array(
			'id'      => 'twitter',
			'label'   => 'Twitter profile URL',
			'section' => 'existing_header_image',
			'type'    => 'text',
		),
		array(
			'id'      => 'googleplus',
			'label'   => 'Google+ profile URL',
			'section' => 'existing_header_image',
			'type'    => 'text',
		),
		array(
			'id'      => 'linkedin',
			'label'   => 'Linked in profile URL',
			'section' => 'existing_header_image',
			'type'    => 'text',
		),
		array(
			'id'      => 'instagram',
			'label'   => 'Instagram profile URL',
			'section' => 'existing_header_image',
			'type'    => 'text',
		),
		array(
			'id'      => 'pinterest',
			'label'   => 'Pinterest profile URL',
			'section' => 'existing_header_image',
			'type'    => 'text',
		),
		array(
			'id'      => 'youtube',
			'label'   => 'Youtube channel URL',
			'section' => 'existing_header_image',
			'type'    => 'text',
		),
		array(
			'id'      => 'align-social-info',
			'label'   => 'Align social icons and contact info',
			'section' => 'existing_header_image',
			'type'    => 'select',
			'choices' => array(
				''       => 'Left',
				'right'  => 'Right',
				'center' => 'Center',
			),
		),
		array(
			'id'      => 'search-post_type',
			'label'   => 'Post types to search',
			'section' => 'existing_header_image',
			'type'    => 'select',
			'default' => 'post,page',
			'choices' => array(
				'post,page' => 'Posts and Pages',
				'product'   => 'Products',
			),
		),
		array(
			'id'      => 'header-sticky',
			'label'   => 'Make sticky?',
			'section' => 'existing_header_image',
			'type'    => 'checkbox',
		),
		array(
			'id'      => 'header-bg-color',
			'label'   => 'Header Background Color',
			'section' => 'existing_header_image',
			'type'    => 'alpha-color',
			'default' => apply_filters( 'eighteen_tags_default_header_background_color', '#ffffff' ),
		),
		//Content
		array(
			'id'      => 'hide-link-focus-outline',
			'label'   => 'Hide accessibility box around active links',
			'section' => 'Content Elements',
			'type'    => 'checkbox',
			'default' => 1,
		),
		array(
			'id'      => 'hide-wc-breadcrumbs-pages',
			'label'   => 'Hide breadcrumbs on pages',
			'section' => 'Content Elements',
			'type'    => 'checkbox',
			'default' => true,
		),
		array(
			'id'      => 'hide-wc-breadcrumbs-posts',
			'label'   => 'Hide breadcrumbs on posts',
			'section' => 'Content Elements',
			'type'    => 'checkbox',
			'default' => true,
		),
		array(
			'id'      => 'hide-wc-breadcrumbs-archives',
			'label'   => 'Hide breadcrumbs on archives',
			'section' => 'Content Elements',
			'type'    => 'checkbox',
			'default' => true,
		),
		array(
			'id'      => 'hide-page-title',
			'label'   => 'Hide page title',
			'section' => 'Content Elements',
			'type'    => 'checkbox',
		),
		//Single
		array(
			'id'          => 'single-header-size',
			'label'       => 'Heading size',
			'section'     => 'existing_eighteen_tags_single_post',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 5,
				'max'  => 25,
				'step' => 1,
			),
		),
		array(
			'id'      => 'single-header-color',
			'label'   => 'Heading color',
			'section' => 'existing_eighteen_tags_single_post',
			'type'    => 'color',
		),
		array(
			'id'      => 'remove-single-post-meta',
			'label'   => 'Remove post meta',
			'section' => 'existing_eighteen_tags_single_post',
			'type'    => 'checkbox',
		),
		//Blog
		array(
			'id'      => 'blog-show-sidebar',
			'label'   => 'Show sidebar on archive page',
			'section' => 'existing_eighteen_tags_archive',
			'type'    => 'checkbox',
		),
		array(
			'id'          => 'blog-header-size',
			'label'       => 'Heading size',
			'section'     => 'existing_eighteen_tags_archive',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 5,
				'max'  => 25,
				'step' => 1,
			),
		),
		array(
			'id'      => 'blog-header-color',
			'label'   => 'Heading color',
			'section' => 'existing_eighteen_tags_archive',
			'type'    => 'color',
		),
		array(
			'id'      => 'blog-layout',
			'label'   => 'Layout',
			'section' => 'existing_eighteen_tags_archive',
			'type'    => 'sf-radio-image',
			'default' => 'left-image',
			'choices' => array(
				'left-image'  => PRO18_URL . '/assets/img/admin/layout-left-image.png',
				'full-image'  => PRO18_URL . '/assets/img/admin/layout-full-image.png',
				'right-image' => PRO18_URL . '/assets/img/admin/layout-right-image.png',
			),
		),
		array(
			'id'      => 'blog-grid',
			'label'   => 'Show posts',
			'section' => 'existing_eighteen_tags_archive',
			'type'    => 'grid',
			'default' => '1,10',
		),
		array(
			'id'      => 'blog-content',
			'label'   => 'Full content or Excerpt',
			'section' => 'existing_eighteen_tags_archive',
			'type'    => 'select',
			'choices' => array(
				'full' => 'Full post',
				''     => 'Excerpt',
			),
		),
		array(
			'id'      => 'blog-excerpt-count',
			'label'   => 'Excerpt word count',
			'section' => 'existing_eighteen_tags_archive',
			'type'    => 'number',
			'default' => 55,
		),
		array(
			'id'      => 'blog-excerpt-end',
			'label'   => 'Excerpt word end',
			'section' => 'existing_eighteen_tags_archive',
			'type'    => 'text',
			'default' => '...',
		),
		array(
			'id'      => 'blog-rm-butt-text',
			'label'   => 'Read more button text',
			'section' => 'existing_eighteen_tags_archive',
			'type'    => 'text',
		),
		array(
			'id'      => 'remove-archive-post-meta',
			'label'   => 'Remove post meta',
			'section' => 'existing_eighteen_tags_archive',
			'type'    => 'checkbox',
		),
		//Typography
		array(
			'id'      => 'typo-body-font',
			'label'   => 'Body font',
			'section' => 'existing_eighteen_tags_typography',
			'type'    => 'font',
		),
		array(
			'id'          => 'typo-body-font-size',
			'label'       => 'Body text size',
			'section'     => 'existing_eighteen_tags_typography',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 5,
				'max'  => 25,
				'step' => 1,
			),
			'default'     => 15,
		),
		array(
			'id'          => 'typo-body-line-height',
			'label'       => 'Body line height',
			'section'     => 'existing_eighteen_tags_typography',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 0.5,
				'max'  => 2.5,
				'step' => 0.1,
			),
		),
		array(
			'id'      => 'typo-header-font',
			'label'   => 'Heading font',
			'section' => 'existing_eighteen_tags_typography',
			'type'    => 'font',
		),
		array(
			'id'          => 'typo-header-font-size',
			'label'       => 'Heading text size',
			'section'     => 'existing_eighteen_tags_typography',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 5,
				'max'  => 25,
				'step' => 1,
			),
		),
		array(
			'id'          => 'typo-header-letter-spacing',
			'label'       => 'Heading letter spacing',
			'section'     => 'existing_eighteen_tags_typography',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => - 2,
				'max'  => 10,
				'step' => 1,
			),
		),
		array(
			'id'          => 'typo-header-line-height',
			'label'       => 'Heading line height',
			'section'     => 'existing_eighteen_tags_typography',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 0.5,
				'max'  => 2.5,
				'step' => 0.1,
			),
		),
		array(
			'id'      => 'typo-header-font-style',
			'label'   => 'Heading font style',
			'section' => 'existing_eighteen_tags_typography',
			'type'    => 'multi-checkbox',
			'choices' => array(
				'bold'      => 'Bold',
				'italic'    => 'Italic',
				'underline' => 'Underline',
				'uppercase' => 'Uppercase',
			),
		),
		//Footer - Layout
		array(
			'id'       => 'typo-footer-layout',
			'label'    => 'Footer layout',
			'section'  => 'existing_eighteen_tags_footer',
			'type'     => 'select',
			'choices'  => array(
				'4'           => '4 Columns',
				'3'           => '3 Columns',
				'2'           => '2 Columns',
				'1'           => '1 Column',
				'1_4-3_4'     => '1/4 + 3/4 Columns',
				'3_4-1_4'     => '3/4 + 1/4 Columns',
				'1_3-2_3'     => '1/3 + 2/3 Columns',
				'2_3-1_3'     => '2/3 + 1/3 Columns',
				'1_4-1_4-1_2' => '1/4 + 1/4 + 1/2 Columns',
				'1_2-1_4-1_4' => '1/2 + 1/4 + 1/4 Columns',
			),
			'priority' => 5,
		),
		array(
			'id'          => 'footer-custom-text',
			'label'       => 'Custom footer text',
			'section'     => 'existing_eighteen_tags_footer',
			'type'        => 'textarea',
			'sanitize_callback' =>'wp_kses_post',
			'description' => 'Type here some text to replace footer text.',
		),
		//Footer - Widgets
		array(
			'id'          => 'footer-wid-header-font-size',
			'label'       => 'Header text size',
			'section'     => 'Widgets',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 12,
				'max'  => 32,
				'step' => 1,
			),
		),
		array(
			'id'      => 'footer-wid-header-font-style',
			'label'   => 'Header font style',
			'section' => 'Widgets',
			'type'    => 'multi-checkbox',
			'choices' => array(
				'bold'      => 'Bold',
				'italic'    => 'Italic',
				'underline' => 'Underline',
				'uppercase' => 'Uppercase',
			),
		),
		array(
			'id'      => 'footer-wid-header-color',
			'label'   => 'Widget header color',
			'section' => 'Widgets',
			'type'    => 'color',
		),
		array(
			'id'          => 'footer-wid-font-size',
			'label'       => 'Text size',
			'section'     => 'Widgets',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 5,
				'max'  => 25,
				'step' => 1,
			),
		),
		array(
			'id'      => 'footer-wid-font-style',
			'label'   => 'Font style',
			'section' => 'Widgets',
			'type'    => 'multi-checkbox',
			'choices' => array(
				'bold'      => 'Bold',
				'italic'    => 'Italic',
				'underline' => 'Underline',
				'uppercase' => 'Uppercase',
			),
		),
		array(
			'id'      => 'footer-wid-color',
			'label'   => 'Widget text color',
			'section' => 'Widgets',
			'type'    => 'color',
		),
		array(
			'id'      => 'footer-wid-link-color',
			'label'   => 'Widget link color',
			'section' => 'Widgets',
			'type'    => 'color',
		),
		array(
			'id'      => 'footer-wid-bullet-color',
			'label'   => 'Widget bullet color',
			'section' => 'Widgets',
			'type'    => 'color',
		),
		// Mobile
		array(
			'id'      => 'mob-hide-logo',
			'label'   => 'Hide logo image',
			'section' => 'Mobile menu',
			'type'    => 'checkbox',
		),
		array(
			'id'      => 'mob-menu-icon-color',
			'label'   => 'Menu icon color',
			'section' => 'Mobile menu',
			'type'    => 'color',
			'default' => '#000000',
		),
		array(
			'id'      => 'mob-menu-bg-color',
			'label'   => 'Background color',
			'section' => 'Mobile menu',
			'type'    => 'color',
			'default' => '#000000',
		),
		array(
			'id'      => 'mob-menu-font-color',
			'label'   => 'Font color',
			'section' => 'Mobile menu',
			'type'    => 'color',
			'default' => '#ffffff',
		),
	);

	return apply_filters( 'eighteen_tags_pro_fields', $fields );
}

add_filter( 'eighteen_tags_pro_fields', 'eighteen_tags_remove_wc_fields' );

function eighteen_tags_remove_wc_fields ( $fields ) {
	if ( class_exists( 'WooCommerce' ) ) {
		$fields[] = array(
			'id'      => 'header-wc-cart',
			'label'   => 'Cart location',
			'section' => 'existing_header_image',
			'type'    => 'select',
			'choices' => array(
				''     => 'Primary nav',
				'_sec' => 'Secondary nav',
				'hide' => 'Hide',
			),
		);
		$fields[] = array(
			'id'      => 'header-wc-cart-color',
			'label'   => 'Cart text color',
			'section' => 'existing_header_image',
			'type'    => 'color',
			'default' => '#ffffff',
		);
	}

	return $fields;
}

$google_18t_fonts = array(
	'Abel' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'sans-serif',
	),
	'Amatic SC' => array(
		'styles' 		=> '400,700',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Arimo' => array(
		'styles' 		=> '400,400italic,700italic,700',
		'character_set' => 'latin,cyrillic-ext,latin-ext,greek-ext,cyrillic,greek,vietnamese',
		'type'			=> 'sans-serif',
	),
	'Arvo' => array(
		'styles' 		=> '400,400italic,700,700italic',
		'character_set' => 'latin',
		'type'			=> 'serif',
	),
	'Bevan' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Bitter' => array(
		'styles' 		=> '400,400italic,700',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'serif',
	),
	'Black Ops One' => array(
		'styles' 		=> '400',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'cursive',
	),
	'Boogaloo' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Bree Serif' => array(
		'styles' 		=> '400',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'serif',
	),
	'Calligraffitti' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Cantata One' => array(
		'styles' 		=> '400',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'serif',
	),
	'Cardo' => array(
		'styles' 		=> '400,400italic,700',
		'character_set' => 'latin,greek-ext,greek,latin-ext',
		'type'			=> 'serif',
	),
	'Changa One' => array(
		'styles' 		=> '400,400italic',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Cherry Cream Soda' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Chewy' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Comfortaa' => array(
		'styles' 		=> '400,300,700',
		'character_set' => 'latin,cyrillic-ext,greek,latin-ext,cyrillic',
		'type'			=> 'cursive',
	),
	'Coming Soon' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Covered By Your Grace' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Crafty Girls' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Crete Round' => array(
		'styles' 		=> '400,400italic',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'serif',
	),
	'Crimson Text' => array(
		'styles' 		=> '400,400italic,600,600italic,700,700italic',
		'character_set' => 'latin',
		'type'			=> 'serif',
	),
	'Cuprum' => array(
		'styles' 		=> '400,400italic,700italic,700',
		'character_set' => 'latin,latin-ext,cyrillic',
		'type'			=> 'sans-serif',
	),
	'Dancing Script' => array(
		'styles' 		=> '400,700',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Dosis' => array(
		'styles' 		=> '400,200,300,500,600,700,800',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'sans-serif',
	),
	'Droid Sans' => array(
		'styles' 		=> '400,700',
		'character_set' => 'latin',
		'type'			=> 'sans-serif',
	),
	'Droid Serif' => array(
		'styles' 		=> '400,400italic,700,700italic',
		'character_set' => 'latin',
		'type'			=> 'serif',
	),
	'Francois One' => array(
		'styles' 		=> '400',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'sans-serif',
	),
	'Fredoka One' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'The Girl Next Door' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Gloria Hallelujah' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Happy Monkey' => array(
		'styles' 		=> '400',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'cursive',
	),
	'Indie Flower' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Josefin Slab' => array(
		'styles' 		=> '400,100,100italic,300,300italic,400italic,600,700,700italic,600italic',
		'character_set' => 'latin',
		'type'			=> 'serif',
	),
	'Judson' => array(
		'styles' 		=> '400,400italic,700',
		'character_set' => 'latin',
		'type'			=> 'serif',
	),
	'Kreon' => array(
		'styles' 		=> '400,300,700',
		'character_set' => 'latin',
		'type'			=> 'serif',
	),
	'Lato' => array(
		'styles' 		=> '400,100,100italic,300,300italic,400italic,700,700italic,900,900italic',
		'character_set' => 'latin',
		'type'			=> 'sans-serif',
	),
	'Lato Light' => array(
		'parent_font' => 'Lato',
		'styles'      => '300',
	),
	'Leckerli One' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Lobster' => array(
		'styles' 		=> '400',
		'character_set' => 'latin,cyrillic-ext,latin-ext,cyrillic',
		'type'			=> 'cursive',
	),
	'Lobster Two' => array(
		'styles' 		=> '400,400italic,700,700italic',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Lora' => array(
		'styles' 		=> '400,400italic,700,700italic',
		'character_set' => 'latin',
		'type'			=> 'serif',
	),
	'Luckiest Guy' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Merriweather' => array(
		'styles' 		=> '400,300,900,700',
		'character_set' => 'latin',
		'type'			=> 'serif',
	),
	'Metamorphous' => array(
		'styles' 		=> '400',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'cursive',
	),
	'Montserrat' => array(
		'styles' 		=> '400,700',
		'character_set' => 'latin',
		'type'			=> 'sans-serif',
	),
	'Noticia Text' => array(
		'styles' 		=> '400,400italic,700,700italic',
		'character_set' => 'latin,vietnamese,latin-ext',
		'type'			=> 'serif',
	),
	'Nova Square' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Nunito' => array(
		'styles' 		=> '400,300,700',
		'character_set' => 'latin',
		'type'			=> 'sans-serif',
	),
	'Old Standard TT' => array(
		'styles' 		=> '400,400italic,700',
		'character_set' => 'latin',
		'type'			=> 'serif',
	),
	'Open Sans' => array(
		'styles' 		=> '300italic,400italic,600italic,700italic,800italic,400,300,600,700,800',
		'character_set' => 'latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic',
		'type'			=> 'sans-serif',
	),
	'Open Sans Condensed' => array(
		'styles' 		=> '300,300italic,700',
		'character_set' => 'latin,cyrillic-ext,latin-ext,greek-ext,greek,vietnamese,cyrillic',
		'type'			=> 'sans-serif',
	),
	'Open Sans Light' => array(
		'parent_font' => 'Open Sans',
		'styles'      => '300',
	),
	'Oswald' => array(
		'styles' 		=> '400,300,700',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'sans-serif',
	),
	'Pacifico' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Passion One' => array(
		'styles' 		=> '400,700,900',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'cursive',
	),
	'Patrick Hand' => array(
		'styles' 		=> '400',
		'character_set' => 'latin,vietnamese,latin-ext',
		'type'			=> 'cursive',
	),
	'Permanent Marker' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Play' => array(
		'styles' 		=> '400,700',
		'character_set' => 'latin,cyrillic-ext,cyrillic,greek-ext,greek,latin-ext',
		'type'			=> 'sans-serif',
	),
	'Playfair Display' => array(
		'styles' 		=> '400,400italic,700,700italic,900italic,900',
		'character_set' => 'latin,latin-ext,cyrillic',
		'type'			=> 'serif',
	),
	'Poiret One' => array(
		'styles' 		=> '400',
		'character_set' => 'latin,latin-ext,cyrillic',
		'type'			=> 'cursive',
	),
	'PT Sans' => array(
		'styles' 		=> '400,400italic,700,700italic',
		'character_set' => 'latin,latin-ext,cyrillic',
		'type'			=> 'sans-serif',
	),
	'PT Sans Narrow' => array(
		'styles' 		=> '400,700',
		'character_set' => 'latin,latin-ext,cyrillic',
		'type'			=> 'sans-serif',
	),
	'PT Serif' => array(
		'styles' 		=> '400,400italic,700,700italic',
		'character_set' => 'latin,cyrillic',
		'type'			=> 'serif',
	),
	'Raleway' => array(
		'styles' 		=> '400,100,200,300,600,500,700,800,900',
		'character_set' => 'latin',
		'type'			=> 'sans-serif',
	),
	'Raleway Light' => array(
		'parent_font' => 'Raleway',
		'styles'      => '300',
	),
	'Reenie Beanie' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Righteous' => array(
		'styles' 		=> '400',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'cursive',
	),
	'Roboto' => array(
		'styles' 		=> '400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic',
		'character_set' => 'latin,cyrillic-ext,latin-ext,cyrillic,greek-ext,greek,vietnamese',
		'type'			=> 'sans-serif',
	),
	'Roboto Condensed' => array(
		'styles' 		=> '400,300,300italic,400italic,700,700italic',
		'character_set' => 'latin,cyrillic-ext,latin-ext,greek-ext,cyrillic,greek,vietnamese',
		'type'			=> 'sans-serif',
	),
	'Roboto Light' => array(
		'parent_font' => 'Roboto',
		'styles'      => '100',
	),
	'Rock Salt' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Rokkitt' => array(
		'styles' 		=> '400,700',
		'character_set' => 'latin',
		'type'			=> 'serif',
	),
	'Sanchez' => array(
		'styles' 		=> '400,400italic',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'serif',
	),
	'Satisfy' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Schoolbell' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Shadows Into Light' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Source Sans Pro' => array(
		'styles' 		=> '400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'sans-serif',
	),
	'Source Sans Pro Light' => array(
		'parent_font' => 'Source Sans Pro',
		'styles'      => '300',
	),
	'Special Elite' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Squada One' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Tangerine' => array(
		'styles' 		=> '400,700',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Ubuntu' => array(
		'styles' 		=> '400,300,300italic,400italic,500,500italic,700,700italic',
		'character_set' => 'latin,cyrillic-ext,cyrillic,greek-ext,greek,latin-ext',
		'type'			=> 'sans-serif',
	),
	'Unkempt' => array(
		'styles' 		=> '400,700',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Vollkorn' => array(
		'styles' 		=> '400,400italic,700italic,700',
		'character_set' => 'latin',
		'type'			=> 'serif',
	),
	'Walter Turncoat' => array(
		'styles' 		=> '400',
		'character_set' => 'latin',
		'type'			=> 'cursive',
	),
	'Yanone Kaffeesatz' => array(
		'styles' 		=> '400,200,300,700',
		'character_set' => 'latin,latin-ext',
		'type'			=> 'sans-serif',
	),
);

function eighteen_tags_pro_google_fonts( $value ) {
	global $pootlepb_font;

	$font_faces = $pootlepb_font;
	$test_cases = array();

	if ( function_exists( 'wf_get_system_fonts_test_cases' ) ) {
		$test_cases = wf_get_system_fonts_test_cases();
	}

	$html = '';
	foreach ( $font_faces as $k => $v ) {

		$selected = '';

		// If one of the fonts requires a test case, use that value. Otherwise, use the key as the test case.
		if ( in_array( $k, array_keys( $test_cases ) ) ) {
			$value_to_test = $test_cases[ $k ];
		} else {
			$value_to_test = $k;
		}

		if ( pootlepb_test_typeface_against_test_case( $value, $value_to_test ) ) {
			$selected = ' selected="selected"';
		}
		$html .= '<option value="' . esc_attr( $k ) . '" ' . $selected . '>' . esc_html( $v ) . '</option>' . "\n";
	}

	return $html;

}

if ( ! function_exists( 'woocommerce_template_loop_rating' ) ) {

	/**
	 * Display the average rating in the loop
	 *
	 * @subpackage	Loop
	 */
	function woocommerce_template_loop_rating() {
		echo '<div>';
		wc_get_template( 'loop/rating.php' );
		echo '</div>';
	}
}

if ( ! function_exists( 'eighteen_tags_post_thumbnail' ) ) {
	/**
	 * Display post thumbnail
	 * @var $size string Thumbnail size. thumbnail|medium|large|full|$custom
	 * @var $args array Arguments passed to the_post_thumbnail()
	 * @uses has_post_thumbnail()
	 * @param string $size
	 * @since 1.5.0
	 */
	function eighteen_tags_post_thumbnail( $size, $args = array( 'itemprop' => 'image' ) ) {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( $size, $args );
		}
	}
}

