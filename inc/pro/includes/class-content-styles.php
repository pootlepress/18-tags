<?php
/**
 * Storefront_Pro_Footer_Styles Class
 *
 * @class Storefront_Pro_Footer_Styles
 * @version	1.0.0
 * @since 1.0.0
 * @package	Storefront_Pro
 */
class Storefront_Pro_Content_Styles extends Storefront_Pro_Abstract {

	protected $css = "\n/*Main Content Styles*/";

	/**
	 * Enqueue CSS and custom styles.
	 * @since  1.0.0
	 * @return string CSS
	 */
	public function styles() {
		$this->headings_typo();
		$this->text_typo();
		$this->hr_styles();

		if ( $this->get( 'hide-link-focus-outline' ) ) {
			$this->css .= '*:focus, .button:focus, .button.alt:focus, .button.added_to_cart:focus, ' .
			'.button.wc-forward:focus, button:focus, input[type="button"]:focus, input[type="reset"]:focus, ' .
			'input[type="submit"]:focus { outline: none !important; }';
		}

		if ( $this->get( 'hide-page-title' ) ) {
			$this->css .= '.page .entry-header { height: 0; overflow: hidden; margin: 0; }';

		}
		return $this->css;
	}

	public function hr_styles() {

		if ( $this->get( 'hide-hr' ) ) {
			$this->css .= '.storefront-pro-active .hentry .entry-header, ' .
			           '.storefront-pro-active .widget h3.widget-title, ' .
			           '.hentry, .hentry .entry-header h1, ' .
			           '.storefront-pro-active .widget h2.widgettitle { ' .
			           'border: none; }';
		}

		$this->css .= '.storefront-pro-active .hentry .entry-header, ' .
		           '.storefront-pro-active .widget h3.widget-title, ' .
		           '.storefront-pro-active .widget h2.widgettitle {' .
		           'border-color: ' . $this->get( 'content-hr-color' ) . ' }';

	}

	/**
	 * Sets footer typography css
	 */
	protected function headings_typo() {
		$t = &$this;
		$css = &$this->css;

		$css .= '.storefront-pro-active h1, .storefront-pro-active h2, ' .
		        '.storefront-pro-active h3, .storefront-pro-active h4, ' .
		        '.storefront-pro-active h5, .storefront-pro-active h6 {' .
		        'font-family:' . $t->get( 'typo-header-font' ) . ';' .
		        'letter-spacing:' . $t->get( 'typo-header-letter-spacing' ) . 'px;' .
		        'line-height:' . $t->get( 'typo-header-line-height' ) . ';' .
		        $t->font_style( $t->get( 'typo-header-font-style' ) ) .
		        '}';

		if ( $t->get( 'typo-header-font-size' ) ) {
			$css .= '.storefront-pro-active h1 {' .
			        'font-size:' . ( 2 * $t->get( 'typo-header-font-size' ) ) . 'px;}';

			$css .= '.storefront-pro-active h2 {' .
			        'font-size:' . ( 1.69 * $t->get( 'typo-header-font-size' ) ) . 'px;}';

			$css .= '.storefront-pro-active h3 {' .
			        'font-size:' . ( 1.384 * $t->get( 'typo-header-font-size' ) ) . 'px;}';

			$css .= '.storefront-pro-active h4 {' .
			        'font-size:' . $t->get( 'typo-header-font-size' ) . 'px;}';

			$css .= '.storefront-pro-active h5 {' .
			        'font-size:' . ( 0.88 * $t->get( 'typo-header-font-size' ) ) . 'px;}';

			$css .= '.storefront-pro-active h6 {' .
			        'font-size:' . ( 0.7 * $t->get( 'typo-header-font-size' ) ) . 'px;}';
		}

		if ( $t->get( 'blog-header-size' ) ) {
			$css .= '.blog.storefront-pro-active .entry-title, .archive.storefront-pro-active .entry-title {' .
			        'font-size:' . ( 2 * $t->get( 'blog-header-size' ) ) . 'px;}';
		}

		$css .= '.blog.storefront-pro-active .entry-title, .archive.storefront-pro-active .entry-title, ' .
		        '.blog.storefront-pro-active .entry-title a, .archive.storefront-pro-active .entry-title a {' .
		        'color:' . $t->get( 'blog-header-color' ) . ';}';

		$css .= '.single-post.storefront-pro-active .entry-title { color:' . $t->get( 'single-header-color' ) . ';}';
		if ( $t->get( 'single-header-size' ) ) {
			$css .= '.single-post #kickass-feat .entry-title { font-size:' . ( 4.3 * $t->get( 'single-header-size' ) ) . 'px;}';
			$css .= '.single-post.storefront-pro-active .entry-title { font-size:' . ( 2.5 * $t->get( 'single-header-size' ) ) . 'px;}';
		}

	}

	/**
	 * Sets footer typography css
	 */
	protected function text_typo() {
		$t = &$this;
		$css = &$this->css;

		$css .= 'body.storefront-pro-active, .storefront-pro-active .panel-grid-cell { ' .
		        'font-family:' . $t->get( 'typo-body-font' ) . ';' .
		        'line-height:' . $t->get( 'typo-body-line-height' ) . '}';
		$css .= '.storefront-pro-active .panel-grid-cell, #primary, #secondary {' .
		        'font-size:' . $t->get( 'typo-body-font-size' ) . 'px; }';;
	}

	public function content() {
		?>
		<div class="entry-content" itemprop="articleBody">
			<?php
			storefront_post_thumbnail( 'full' );
			$this->blog_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
		<?php
	}

	/**
	 * Excerpt length in words
	 * @filter excerpt_length
	 * @return int Excerpt length in words
	 */
	function excerpt_length() {
		$set = $this->get( 'blog-excerpt-count', 55 );
		return $set;
	}

	/**
	 * String at the end of excerpt
	 * @filter excerpt_more
	 * @return string The end of the excerpt
	 */
	function excerpt_more() {

		$set = $this->get( 'blog-excerpt-end', '[...]' );
		$read_more = $this->get( 'blog-rm-butt-text' );
		if ( $read_more ) {
			$set .= '<a class="button read-more alignright" href="' . get_post_permalink() . '">' . $read_more . '</a>';
		}

		return $set;
	}

	function blog_content() {
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
		$show_full = $this->get( 'blog-content' );
		if ( $show_full ) {
			the_content(
				sprintf(
					__( 'Continue reading %s', 'storefront' ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				)
			);
		} else {
			the_excerpt();
		}
		remove_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
		remove_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
	}

} // End class