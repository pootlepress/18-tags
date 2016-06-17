<?php
/**
 * Eighteen_Tags_Pro_Footer_Styles Class
 *
 * @class Eighteen_Tags_Pro_Footer_Styles
 * @version	1.0.0
 * @since 1.0.0
 * @package	Eighteen_Tags_Pro
 */
class Eighteen_Tags_Pro_Footer_Styles extends Eighteen_Tags_Pro_Abstract {

	protected $css = "\n/* Footer Styles */";

	public function init() {
		add_filter( 'eighteen_tags_footer_widget_regions', array( $this, 'widget_areas' ) );

		remove_action( 'eighteen_tags_footer', 'eighteen_tags_credit', 20 );

		add_action( 'eighteen_tags_footer', array( $this, 'credit' ), 20 );
	}

	/**
	 * Enqueue CSS and custom styles.
	 * @since  1.0.0
	 * @return string CSS
	 */
	public function styles() {
		$t = &$this;

		$t->footer_typography();

		$t->layout();

		return $t->css;
	}

	/**
	 * Sets footer typography css
	 */
	protected function footer_typography() {
		$t = &$this;
		$css = &$this->css;
		$t->get( 'footer-wid-header-text-size' );

		$css .= '.eighteen-tags-pro-active .site-footer aside > *:not(h3) {' .
		        'font-size:' . $t->get( 'footer-wid-font-size' ) . 'px;' .
		        $t->font_style( $t->get( 'footer-wid-font-style' ) ) .
		        'color:' . $t->get( 'footer-wid-color' ) . ';' .
		        '}';

		$css .= '.eighteen-tags-pro-active .site-footer .footer-widgets h3 {' .
		        'font-size:' . $t->get( 'footer-wid-header-font-size' ) . 'px;' .
		        $t->font_style( $t->get( 'footer-wid-header-font-style' ) ) .
		        'color:' . $t->get( 'footer-wid-header-color' ) . ';' .
		        '}';

		$css .= '.eighteen-tags-pro-active .site-footer .footer-widgets a {' .
		        'color:' . $t->get( 'footer-wid-link-color' ) . ';' .
		        '}';

		$css .= '.eighteen-tags-pro-active .site-footer .footer-widgets li:before {' .
		        'color:' . $t->get( 'footer-wid-bullet-color' ) . ';' .
		        '}';
	}

	public function widget_areas( $areas ) {
		$layout = $this->get( 'typo-footer-layout' );

		if ( $layout ) {

			if ( is_numeric( $layout ) ) {

				return $layout;
			} else {

				return count( explode( '-', $layout ) );
			}
		} else {

			return $areas;
		}
	}

	protected function layout() {
		$t = &$this;
		$css = &Eighteen_Tags_Pro_Public::$desktop_css;
		$layout = $t->get( 'typo-footer-layout' );
		$class_prefix = '.footer-widget-';
		$selector_prefix = '.eighteen-tags-pro-active .footer-widgets ';
		if ( $layout && ! is_numeric( $layout ) ) {
			$sizes = explode( '-', $layout );
			$cols = count( $sizes );
			$available_width = 100 - ( ( $cols - 1 ) * 4.347826087 );
			for( $i = 0; $i < $cols; $i++ ) {
				$fraction = explode( '_', $sizes[ $i ] );
				$width = ( $fraction[0] / $fraction[1] ) * $available_width;
				$class = $class_prefix . ( $i + 1 );
				$css .= $selector_prefix . $class . ' { '
				. "width: {$width}%; }";
			}
		}
	}

	public function credit() {
		$footer_text = $this->get( 'footer-custom-text' );
		?>
		<div class="site-info">
			<?php
			if ( empty( $footer_text ) ) {
				echo esc_html(apply_filters('eighteen_tags_copyright_text', $content = '&copy; ' . get_bloginfo('name') . ' ' . date('Y')));
				if (apply_filters('eighteen_tags_credit_link', true)) { ?>
					<br/> <?php printf(__('%1$s designed by %2$s.', 'eighteen-tags'), 'Eighteen tags', '<a href="http://www.pootlepress.com" title="Premium WordPress Themes & Plugins by pootlepress" rel="designer">pootlepress</a>');
				}
			} else {
				echo $footer_text;
			}
			?>
		</div><!-- .site-info -->
		<?php
	}
} // End class