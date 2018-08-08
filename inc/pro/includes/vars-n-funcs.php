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
 * * et-text
 * * et-heading
 * * et-divider
 *
 * et- prefixed controls are arbitrary eighteen-tags controls
 *
 * NOTE : et-text control doesn't show anything if description is not set but
 * in Eighteen_Tags_Customizer_Fields class we assign it to label
 * if not set ;)
 *
 */
function eighteen_tags_pro_fields() {
	$fields = array(
			'nav-style'                    => array(
				'label'    => 'Navigation Style',
				'section'  => 'Primary Navigation',
				'type'     => 'select',
				'choices'  => array(
					''                        => 'Old Skool',
					'right'                   => 'Align right items left',
					'right nav-items-right'   => 'Align right items right',
					'center'                  => 'Centered',
					'center-inline'           => 'Centred inline logo',
					'left-vertical'           => 'Left vertical',
					'left-vertical hamburger' => 'Hamburger',
				),
				'default'  => 'right',
				'priority' => 10,
			),
			'pri-nav-label'                => array(
				'label'    => 'Hamburger Label',
				'section'  => 'Primary Navigation',
				'type'     => 'text',
				'priority' => 15,
			),
			'pri-nav-font'                 => array(
				'label'    => 'Font',
				'section'  => 'Primary Navigation',
				'type'     => 'font',
				'default'  => 'Raleway',
				'priority' => 20,
			),
			'pri-nav-text-size'            => array(
				'label'       => 'Text size',
				'section'     => 'Primary Navigation',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 5,
					'max'  => 25,
					'step' => 1,
				),
				'priority'    => 25,
			),
			'pri-nav-letter-spacing'       => array(
				'label'       => 'Letter spacing',
				'section'     => 'Primary Navigation',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => - 2,
					'max'  => 10,
					'step' => 1,
				),
				'priority'    => 30,
			),
			'pri-nav-font-style'           => array(
				'label'    => 'Font style',
				'section'  => 'Primary Navigation',
				'type'     => 'multi-checkbox',
				'choices'  => array(
					'bold'      => 'Bold',
					'italic'    => 'Italic',
					'underline' => 'Underline',
					'uppercase' => 'Uppercase',
				),
				'priority' => 35,
			),
			'pri-nav-text-color'           => array(
				'label'    => 'Text color',
				'section'  => 'Primary Navigation',
				'type'     => 'color',
				'priority' => 40,
			),
			'pri-nav-active-link-color'    => array(
				'label'    => 'Active link color',
				'section'  => 'Primary Navigation',
				'type'     => 'color',
				'priority' => 45,
			),
			'pri-nav-bg-color'             => array(
				'label'    => 'Background color',
				'section'  => 'Primary Navigation',
				'type'     => 'alpha-color',
				'priority' => 50,
			),
			'pri-nav-dd-bg-color'          => array(
				'label'    => 'Drop down menu background color',
				'section'  => 'Primary Navigation',
				'type'     => 'alpha-color',
				'default'  => '#000',
				'priority' => 55,
			),
			'pri-nav-dd-text-color'        => array(
				'label'    => 'Drop down menu text color',
				'section'  => 'Primary Navigation',
				'type'     => 'color',
				'default'  => '#ffffff',
				'priority' => 60,
			),
			'pri-nav-dd-animation'         => array(
				'label'    => 'Drop down menu animation',
				'section'  => 'Primary Navigation',
				'type'     => 'select',
				'choices'  => array(
					''       => 'Default',
					'fade'   => 'Fade',
					'expand' => 'Expand',
					'slide'  => 'Slide',
					'flip'   => 'Flip',
				),
				'priority' => 65,
			),
			'pri-nav-height'               => array(
				'label'       => 'Menu height',
				'section'     => 'Primary Navigation',
				'type'        => 'range',
				'default'     => '1.3',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 2.5,
					'step' => '0.1',
				),
				'priority'    => 70,
			),
			'remove-search-icon'           => array(
				'label'    => 'Remove search icon from nav',
				'section'  => 'Primary Navigation',
				'type'     => 'checkbox',
				'priority' => 75,
			),
			'sec-nav-full'                 => array(
				'label'    => 'Make full width',
				'section'  => 'Secondary Navigation',
				'type'     => 'checkbox',
				'priority' => 10,
			),
			'sec-nav-font'                 => array(
				'label'    => 'Font',
				'section'  => 'Secondary Navigation',
				'type'     => 'font',
				'priority' => 15,
			),
			'sec-nav-text-size'            => array(
				'label'       => 'Text size',
				'section'     => 'Secondary Navigation',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 5,
					'max'  => 25,
					'step' => 1,
				),
				'default'     => '',
				'priority'    => 20,
			),
			'sec-nav-letter-spacing'       => array(
				'label'       => 'Letter spacing',
				'section'     => 'Secondary Navigation',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => - 2,
					'max'  => 10,
					'step' => 1,
				),
				'priority'    => 25,
			),
			'sec-nav-font-style'           => array(
				'label'    => 'Font style',
				'section'  => 'Secondary Navigation',
				'type'     => 'multi-checkbox',
				'choices'  => array(
					'bold'      => 'Bold',
					'italic'    => 'Italic',
					'underline' => 'Underline',
					'uppercase' => 'Uppercase',
				),
				'priority' => 30,
			),
			'sec-nav-bg-color'             => array(
				'label'    => 'Background color',
				'section'  => 'Secondary Navigation',
				'type'     => 'alpha-color',
				'priority' => 35,
			),
			'sec-nav-text-color'           => array(
				'label'    => 'Text color',
				'section'  => 'Secondary Navigation',
				'type'     => 'color',
				'priority' => 40,
				'default'  => '#fff',
			),
			'sec-nav-active-link-color'    => array(
				'label'    => 'Active link color',
				'section'  => 'Secondary Navigation',
				'type'     => 'color',
				'priority' => 45,
			),
			'sec-nav-dd-bg-color'          => array(
				'label'    => 'Drop down menu background color',
				'section'  => 'Secondary Navigation',
				'type'     => 'alpha-color',
				'priority' => 50,
			),
			'sec-nav-dd-text-color'        => array(
				'label'    => 'Drop down menu text color',
				'section'  => 'Secondary Navigation',
				'type'     => 'color',
				'priority' => 55,
			),

			'phone-num'                    => array(
				'label'    => 'Phone Number',
				'section'  => 'Secondary Navigation',
				'type'     => 'text',
				'priority' => 60,
			),
			'email'                        => array(
				'label'    => 'Email',
				'section'  => 'Secondary Navigation',
				'type'     => 'text',
				'priority' => 65,
			),
			'facebook'                     => array(
				'label'    => 'Facebook profile URL',
				'section'  => 'Secondary Navigation',
				'type'     => 'text',
				'priority' => 70,
			),
			'twitter'                      => array(
				'label'    => 'Twitter profile URL',
				'section'  => 'Secondary Navigation',
				'type'     => 'text',
				'priority' => 75,
			),
			'googleplus'                   => array(
				'label'    => 'Google+ profile URL',
				'section'  => 'Secondary Navigation',
				'type'     => 'text',
				'priority' => 80,
			),
			'linkedin'                     => array(
				'label'    => 'Linked in profile URL',
				'section'  => 'Secondary Navigation',
				'type'     => 'text',
				'priority' => 85,
			),
			'instagram'                    => array(
				'label'    => 'Instagram profile URL',
				'section'  => 'Secondary Navigation',
				'type'     => 'text',
				'priority' => 90,
			),
			'pinterest'                    => array(
				'label'    => 'Pinterest profile URL',
				'section'  => 'Secondary Navigation',
				'type'     => 'text',
				'priority' => 95,
			),
			'youtube'                      => array(
				'label'    => 'Youtube channel URL',
				'section'  => 'Secondary Navigation',
				'type'     => 'text',
				'priority' => 100,
			),
			'align-social-info'            => array(
				'label'    => 'Align social icons and contact info',
				'section'  => 'Secondary Navigation',
				'type'     => 'select',
				'choices'  => array(
					''       => 'Left',
					'right'  => 'Right',
					'center' => 'Center',
				),
				'priority' => 105,
			),

			'site-title-font-size'         => array(
				'label'       => 'Title font size',
				'section'     => 'existing_title_tagline',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 5,
					'max'  => 52,
					'step' => 1,
				),
				'priority'    => 10,
			),
			'site-title-font-style'        => array(
				'label'    => 'Title font style',
				'section'  => 'existing_title_tagline',
				'type'     => 'multi-checkbox',
				'choices'  => array(
					'bold'      => 'Bold',
					'italic'    => 'Italic',
					'underline' => 'Underline',
					'uppercase' => 'Uppercase',
				),
				'priority' => 15,
			),
			'site-title-font'              => array(
				'label'    => 'Title font',
				'section'  => 'existing_title_tagline',
				'type'     => 'font',
				'default'  => 'Raleway',
				'priority' => 20,
			),
			'site-title-color'             => array(
				'label'    => 'Title color',
				'section'  => 'existing_title_tagline',
				'type'     => 'color',
				'priority' => 25,
			),
			'site-tagline-font-size'       => array(
				'label'       => 'Tagline font size',
				'section'     => 'existing_title_tagline',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 5,
					'max'  => 34,
					'step' => 1,
				),
				'priority'    => 30,
			),
			'site-tagline-font-style'      => array(
				'label'    => 'Tagline font style',
				'section'  => 'existing_title_tagline',
				'type'     => 'multi-checkbox',
				'choices'  => array(
					'bold'      => 'Bold',
					'italic'    => 'Italic',
					'underline' => 'Underline',
					'uppercase' => 'Uppercase',
				),
				'priority' => 35,
			),
			'site-tagline-font'            => array(
				'label'    => 'Tagline font',
				'section'  => 'existing_title_tagline',
				'type'     => 'font',
				'default'  => 'Merriweather',
				'priority' => 40,
			),
			'site-tagline-color'           => array(
				'label'    => 'Tagline color',
				'section'  => 'existing_title_tagline',
				'type'     => 'color',
				'priority' => 45,
			),
			'header-bg-color'              => array(
				'label'    => 'Header Background Color',
				'section'  => 'existing_header_image',
				'type'     => 'alpha-color',
				'default'  => '#ffffff',
				'priority' => 10,
			),
			'logo-max-height'              => array(
				'label'       => 'Logo max height',
				'section'     => 'existing_header_image',
				'type'        => 'range',
				'default'     => 100,
				'priority'    => 15,
				'input_attrs' => array(
					'min'  => 50,
					'max'  => 250,
					'step' => 1,
				),
			),
			'search-post_type'             => array(
				'label'    => 'Post types to search',
				'section'  => 'existing_header_image',
				'type'     => 'select',
				'default'  => 'post,page',
				'choices'  => array(
					'post,page' => 'Posts and Pages',
					'product'   => 'Products',
				),
				'priority' => 70,
			),
			'header-sticky'                => array(
				'label'    => 'Make sticky?',
				'section'  => 'existing_header_image',
				'type'     => 'checkbox',
				'priority' => 75,
			),
			'header-sticky-show-on-scroll-up'                => array(
				'label'    => 'Sticky header show on scrolling up',
				'section'  => 'existing_header_image',
				'type'     => 'checkbox',
				'priority' => 80,
			),
			'hide-link-focus-outline'      => array(
				'label'    => 'Hide accessibility box around active links',
				'section'  => 'Content Elements',
				'type'     => 'checkbox',
				'default'  => 1,
				'priority' => 10,
			),
			'hide-wc-breadcrumbs-pages'    => array(
				'label'    => 'Hide breadcrumbs on pages',
				'section'  => 'Content Elements',
				'type'     => 'checkbox',
				'default'  => true,
				'priority' => 15,
			),
			'hide-wc-breadcrumbs-posts'    => array(
				'label'    => 'Hide breadcrumbs on posts',
				'section'  => 'Content Elements',
				'type'     => 'checkbox',
				'default'  => true,
				'priority' => 20,
			),
			'hide-wc-breadcrumbs-archives' => array(
				'label'    => 'Hide breadcrumbs on archives',
				'section'  => 'Content Elements',
				'type'     => 'checkbox',
				'default'  => true,
				'priority' => 25,
			),
			'hide-page-title'              => array(
				'label'    => 'Hide page title',
				'section'  => 'Content Elements',
				'type'     => 'checkbox',
				'priority' => 30,
			),
			'single-header-size'           => array(
				'label'       => 'Heading size',
				'section'     => 'existing_eighteen_tags_single_post',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 5,
					'max'  => 25,
					'step' => 1,
				),
				'priority'    => 10,
			),
			'single-header-color'          => array(
				'label'    => 'Heading color',
				'section'  => 'existing_eighteen_tags_single_post',
				'type'     => 'color',
				'priority' => 20,
			),
			'remove-single-post-meta'      => array(
				'label'    => 'Remove post meta',
				'section'  => 'existing_eighteen_tags_single_post',
				'type'     => 'checkbox',
				'priority' => 25,
			),
			'single-keep-sidebar'          => array(
				'label'    => 'Keep sidebar',
				'section'  => 'existing_eighteen_tags_single_post',
				'type'     => 'checkbox',
				'default'  => true,
				'priority' => 30,
			),
			'blog-show-sidebar'            => array(
				'label'    => 'Show sidebar on posts page',
				'section'  => 'existing_eighteen_tags_archive',
				'type'     => 'checkbox',
				'default'  => true,
				'priority' => 10,
			),
			'blog-header-size'             => array(
				'label'       => 'Heading size',
				'section'     => 'existing_eighteen_tags_archive',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 5,
					'max'  => 25,
					'step' => 1,
				),
				'priority'    => 15,
			),
			'blog-header-color'            => array(
				'label'    => 'Heading color',
				'section'  => 'existing_eighteen_tags_archive',
				'type'     => 'color',
				'priority' => 20,
			),
			'blog-layout'                  => array(
				'label'    => 'Layout',
				'section'  => 'existing_eighteen_tags_archive',
				'type'     => 'et-radio-image',
				'default'  => 'full-image',
				'choices'  => array(
					'left-image'  => Eighteen_Tags::$url . 'assets/img/admin/layout-left-image.png',
					'full-image'  => Eighteen_Tags::$url . 'assets/img/admin/layout-full-image.png',
					'right-image' => Eighteen_Tags::$url . 'assets/img/admin/layout-right-image.png',
				),
				'priority' => 25,
			),
			'blog-grid'                    => array(
				'label'    => 'Show posts',
				'section'  => 'existing_eighteen_tags_archive',
				'type'     => 'grid',
				'default'  => '1,10',
				'priority' => 30,
			),
			'blog-content'                 => array(
				'label'    => 'Full content or Excerpt',
				'section'  => 'existing_eighteen_tags_archive',
				'type'     => 'select',
				'choices'  => array(
					'full' => 'Full post',
					''     => 'Excerpt',
				),
				'priority' => 35,
			),
			'blog-excerpt-count'           => array(
				'label'    => 'Excerpt word count',
				'section'  => 'existing_eighteen_tags_archive',
				'type'     => 'number',
				'default'  => 55,
				'priority' => 40,
			),
			'blog-excerpt-end'             => array(
				'label'    => 'Excerpt word end',
				'section'  => 'existing_eighteen_tags_archive',
				'type'     => 'text',
				'default'  => '...',
				'priority' => 45,
			),
			'blog-rm-butt-text'            => array(
				'label'    => 'Read more button text',
				'section'  => 'existing_eighteen_tags_archive',
				'type'     => 'text',
				'priority' => 50,
			),
			'remove-archive-post-meta'     => array(
				'label'    => 'Remove post meta',
				'section'  => 'existing_eighteen_tags_archive',
				'type'     => 'checkbox',
				'priority' => 55,
			),
			'typo-header-font'             => array(
				'label'    => 'Heading font',
				'section'  => 'existing_eighteen_tags_typography',
				'type'     => 'font',
				'default'  => 'Raleway',
				'priority' => 5,
			),
			'typo-header-font-size'        => array(
				'label'       => 'Heading text size',
				'section'     => 'existing_eighteen_tags_typography',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 5,
					'max'  => 25,
					'step' => 1,
				),
				'priority'    => 10,
			),
			'typo-header-letter-spacing'   => array(
				'label'       => 'Heading letter spacing',
				'section'     => 'existing_eighteen_tags_typography',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => - 2,
					'max'  => 10,
					'step' => 1,
				),
				'priority'    => 15,
			),
			'typo-header-line-height'      => array(
				'label'       => 'Heading line height',
				'section'     => 'existing_eighteen_tags_typography',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 0.5,
					'max'  => 2.5,
					'step' => '0.1',
				),
				'priority'    => 20,
			),
			'typo-header-font-style'       => array(
				'label'    => 'Heading font style',
				'section'  => 'existing_eighteen_tags_typography',
				'type'     => 'multi-checkbox',
				'choices'  => array(
					'bold'      => 'Bold',
					'italic'    => 'Italic',
					'underline' => 'Underline',
					'uppercase' => 'Uppercase',
				),
				'priority' => 25,
			),
			'typo-body-typo-div' => array(
				'label'   => '',
				'section' => 'existing_eighteen_tags_typography',
				'type'    => 'et-divider',
				'priority' => 27,
			),

			'typo-body-font'               => array(
				'label'    => 'Body text font',
				'section'  => 'existing_eighteen_tags_typography',
				'type'     => 'font',
				'default'  => 'Merriweather',
				'priority' => 30,
			),
			'typo-body-font-size'          => array(
				'label'       => 'Body text size',
				'section'     => 'existing_eighteen_tags_typography',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 5,
					'max'  => 25,
					'step' => 1,
				),
				'default'     => 15,
				'priority'    => 35,
			),
			'typo-body-line-height'        => array(
				'label'       => 'Body text line height',
				'section'     => 'existing_eighteen_tags_typography',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 0.5,
					'max'  => 2.5,
					'step' => '0.1',
				),
				'priority'    => 40,
			),
			'typo-footer-layout'           => array(
				'label'    => 'Footer layout',
				'section'  => 'existing_eighteen_tags_footer',
				'type'     => 'select',
				'choices'  => array(
					'4'				=> '4 Columns',
					'3'				=> '3 Columns',
					'2'				=> '2 Columns',
					'1'				=> '1 Column',
					'1_4-3_4'		=> '1/4 + 3/4 Columns',
					'3_4-1_4'		=> '3/4 + 1/4 Columns',
					'1_3-2_3'		=> '1/3 + 2/3 Columns',
					'2_3-1_3'		=> '2/3 + 1/3 Columns',
					'1_4-1_4-1_2'	=> '1/4 + 1/4 + 1/2 Columns',
					'1_2-1_4-1_4'	=> '1/2 + 1/4 + 1/4 Columns',
				),
				'priority' => 10,
			),
			'footer-custom-text'           => array(
				'label'             => 'Custom footer text',
				'section'           => 'existing_eighteen_tags_footer',
				'type'              => 'textarea',
				'sanitize_callback' => 'wp_kses_post',
				'description'       => 'Type here some text to replace footer text.',
				'priority'          => 15,
			),
			'footer-wid-header-font-size'  => array(
				'label'       => 'Header text size',
				'section'     => 'Widgets',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 12,
					'max'  => 32,
					'step' => 1,
				),
				'priority'    => 10,
			),
			'footer-wid-header-font-style' => array(
				'label'    => 'Header font style',
				'section'  => 'Widgets',
				'type'     => 'multi-checkbox',
				'choices'  => array(
					'bold'      => 'Bold',
					'italic'    => 'Italic',
					'underline' => 'Underline',
					'uppercase' => 'Uppercase',
				),
				'priority' => 15,
			),
			'footer-wid-header-color'      => array(
				'label'    => 'Widget header color',
				'section'  => 'Widgets',
				'type'     => 'color',
				'priority' => 20,
			),
			'footer-wid-font-size'         => array(
				'label'       => 'Text size',
				'section'     => 'Widgets',
				'type'        => 'range',
				'input_attrs' => array(
					'min'  => 5,
					'max'  => 25,
					'step' => 1,
				),
				'priority'    => 25,
			),
			'footer-wid-font-style'        => array(
				'label'    => 'Font style',
				'section'  => 'Widgets',
				'type'     => 'multi-checkbox',
				'choices'  => array(
					'bold'      => 'Bold',
					'italic'    => 'Italic',
					'underline' => 'Underline',
					'uppercase' => 'Uppercase',
				),
				'priority' => 30,
			),
			'footer-wid-color'             => array(
				'label'    => 'Widget text color',
				'section'  => 'Widgets',
				'type'     => 'color',
				'priority' => 35,
			),
			'footer-wid-link-color'        => array(
				'label'    => 'Widget link color',
				'section'  => 'Widgets',
				'type'     => 'color',
				'priority' => 40,
			),
			'footer-wid-bullet-color'      => array(
				'label'    => 'Widget bullet color',
				'section'  => 'Widgets',
				'type'     => 'color',
				'priority' => 45,
			),
			'mob-hide-logo'                => array(
				'label'    => 'Hide logo image',
				'section'  => 'Mobile menu',
				'type'     => 'checkbox',
				'priority' => 10,
			),
			'mob-menu-icon-color'          => array(
				'label'    => 'Menu icon color',
				'section'  => 'Mobile menu',
				'type'     => 'color',
				'default'  => '#000',
				'priority' => 15,
			),
			'mob-menu-bg-color'            => array(
				'label'    => 'Background color',
				'section'  => 'Mobile menu',
				'type'     => 'color',
				'default'  => '#000000',
				'priority' => 20,
			),
			'mob-menu-font-color'          => array(
				'label'    => 'Font color',
				'section'  => 'Mobile menu',
				'type'     => 'color',
				'default'  => '#ffffff',
				'priority' => 25,
			),
		);

	return apply_filters( 'eighteen_tags_pro_fields', $fields );
}

add_filter( 'eighteen_tags_pro_fields', 'eighteen_tags_add_wc_fields' );

function eighteen_tags_add_wc_fields ( $fields ) {
	if ( class_exists( 'WooCommerce' ) ) {
		$fields[ 'header-wc-cart' ] = array(
			'label'   => 'Cart location',
			'section' => 'existing_header_image',
			'type'    => 'select',
			'choices' => array(
				''     => 'Primary nav',
				'_sec' => 'Secondary nav',
				'hide' => 'Hide',
			),
		);
		$fields[ 'header-wc-cart-color' ] = array(
			'label'   => 'Cart text color',
			'section' => 'existing_header_image',
			'type'    => 'color',
			'default' => '#ffffff',
		);
	}

	return $fields;
}

$google_18t_fonts = array(
	'Georgia, serif'										=> 'Georgia',
	'"Palatino Linotype", "Book Antiqua", Palatino, serif'	=> 'Palatino Linotype',
	'"Times New Roman", Times, serif'						=> 'Times New Roman',
	'Arial, Helvetica, sans-serif'							=> 'Arial',
	'"Arial Black", Gadget, sans-serif'						=> 'Arial Black',
	'"Comic Sans MS", cursive, sans-serif'					=> 'Comic Sans MS',
	'Impact, Charcoal, sans-serif'							=> 'Impact',
	'"Lucida Sans Unicode", "Lucida Grande", sans-serif'	=> 'Lucida Sans Unicode',
	'Tahoma, Geneva, sans-serif'							=> 'Tahoma',
	'"Trebuchet MS", Helvetica, sans-serif'					=> 'Trebuchet MS',
	'Verdana, Geneva, sans-serif'							=> 'Verdana',
	'"Courier New", Courier, monospace'						=> 'Courier New',
	'"Lucida Console", Monaco, monospace'					=> 'Lucida Console',
	
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

/**
 * Gets the theme mod for customizer fields
 *
 * @param string $id
 * @param mixed $default
 * @return mixed Setting value
 */
function get_18tags_mod( $id, $default = null ){
	$return = get_theme_mod( Eighteen_Tags::instance()->token . '-' . $id, $default );

	return apply_filters( "storefront_pro_filter_mod_$id", $return, $id );
}

/**
 * @param string $value Value to font style option
 * @return string CSS for font style
 */
function eighteen_tags_font_style( $value ) {
	$s = explode( ',', $value );
	$css = '';
	if ( in_array( 'bold', $s ) ) {
		$css .= 'font-weight: bold;';
	} else {
		$css .= 'font-weight: normal;';
	}
	if ( in_array( 'italic', $s ) ) {
		$css .= 'font-style: italic;';
	} else {
		$css .= 'font-style: normal;';
	}
	if ( in_array( 'underline', $s ) ) {
		$css .= 'text-decoration: underline;';
	} else {
		$css .= 'text-decoration: none;';
	}
	if ( in_array( 'uppercase', $s ) ) {
		$css .= 'text-transform: uppercase;';
	} else {
		$css .= 'text-transform: none;';
	}

	return $css;

}

function eighteen_tags_is_ppb() {
	if ( function_exists( 'pootlepb_is_panel' ) ) {
		return pootlepb_is_panel();
	}
	return false;
}

function eighteen_tags_skins() {

	$skins     = get_transient( 'eighteen_tags_skins' );

	if ( ! $skins || isset( $_GET['force_get_skins'] ) ) {
		$response = wp_remote_retrieve_body( wp_remote_get( 'https://tags-c585f.firebaseio.com/comm.json' ) );
		if ( $response ) {
			$skins = json_decode( $response, 'assoc' );
			set_transient( 'eighteen_tags_skins', $skins, DAY_IN_SECONDS * 2.5 );
		}
	}

	return apply_filters( 'eighteen_tags_skins', $skins );
}


add_filter( 'storefront_page_customizer', 'eighteen_tags_page_customizer' );

function eighteen_tags_page_customizer ( $fields ) {
	$fields['flush-content-to-header'] = array(
		'id'      => 'flush-content-to-header',
		'section' => 'Content',
		'label'   => 'Flush content to header',
		'type'    => 'checkbox',
		'default' => '',
	);

	return $fields;
}