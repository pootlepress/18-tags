<?php
/**
 * eighteen-tags setup functions
 *
 * @package eighteen-tags
 */

global $eighteen_tags_version;

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

/**
 * Assign the Eighteen tags version to a var
 */
$eighteen_tags_theme 	= wp_get_theme( 'eighteen-tags' );
$eighteen_tags_version 	= $eighteen_tags_theme['Version'];

if ( ! function_exists( 'eighteen_tags_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function eighteen_tags_setup() {

		/*
		 * Load Localisation files.
		 *
		 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
		 */

		add_theme_support( 'align-wide' );

		// wp-content/languages/themes/eighteen-tags-it_IT.mo
		load_theme_textdomain( 'eighteen-tags', trailingslashit( WP_LANG_DIR ) . 'themes/' );

		// wp-content/themes/child-theme-name/languages/it_IT.mo
		load_theme_textdomain( 'eighteen-tags', get_stylesheet_directory() . '/languages' );

		// wp-content/themes/eighteen-tags/languages/it_IT.mo
		load_theme_textdomain( 'eighteen-tags', get_template_directory() . '/languages' );

		add_editor_style();

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary'		=> __( 'Primary Menu', 'eighteen-tags' ),
			'secondary'		=> __( 'Secondary Menu', 'eighteen-tags' ),
			'handheld'		=> __( 'Handheld Menu', 'eighteen-tags' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'widgets',
		) );

		// Setup the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'eighteen_tags_custom_background_args', array(
			'default-color' => apply_filters( 'eighteen_tags_default_background_color', 'ffffff' ),
			'default-image' => '',
		) ) );

		add_theme_support( 'custom-logo' );

		// Declare WooCommerce support
		add_theme_support( 'woocommerce' );

		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Declare support for title theme feature
		add_theme_support( 'title-tag' );

		wc_breadcrumb_register();
	}
endif; // eighteen_tags_setup

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function eighteen_tags_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'eighteen-tags' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header', 'eighteen-tags' ),
		'id'            => 'header-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	$footer_widget_regions = apply_filters( 'eighteen_tags_footer_widget_regions', 4 );

	for ( $i = 1; $i <= intval( $footer_widget_regions ); $i++ ) {
		register_sidebar( array(
			'name' 				=> sprintf( __( 'Footer %d', 'eighteen-tags' ), $i ),
			'id' 				=> sprintf( 'footer-%d', $i ),
			'description' 		=> sprintf( __( 'Widgetized Footer Region %d.', 'eighteen-tags' ), $i ),
			'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 		=> '</aside>',
			'before_title' 		=> '<h3>',
			'after_title' 		=> '</h3>',
			)
		);
	}
}

/**
 * Enqueue scripts and styles.
 * @since  1.0.0
 */
function eighteen_tags_scripts() {
	global $eighteen_tags_version;

	wp_enqueue_style( 'eighteen-tags-style', get_stylesheet_uri(), '', $eighteen_tags_version );

	wp_style_add_data( 'eighteen-tags-style', 'rtl', 'replace' );

	wp_enqueue_script( 'eighteen-tags-navigation', get_template_directory_uri() . '/js/navigation.min.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'eighteen-tags-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action('after_switch_theme', 'eighteen_tags_activated');

function eighteen_tags_activated() {
	update_option( 'eighteen_tags_version', EIGHTEENTAGS_VERSION );
}

function eighteen_tags_block_editor_styles() {
	?><style>
		.editor-styles-wrapper .wp-block {
			max-width: 66.4989378333em;
		}

		.editor-styles-wrapper .storefront-has-sidebar .wp-block {
			max-width: calc(66.4989378333em * 0.7391304348);
		}

		.editor-styles-wrapper .wp-block[data-align='wide'] {
			max-width: 75.9987860952em;
		}

		.editor-styles-wrapper .wp-block[data-align='full'] {
			max-width: none;
		}

	</style><?php
}
add_action( 'enqueue_block_editor_assets', 'eighteen_tags_block_editor_styles' );
