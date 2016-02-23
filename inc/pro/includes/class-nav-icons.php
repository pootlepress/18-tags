<?php
/**
 * Eighteen tags class
 * @developer http://wpdevelopment.me <shramee@wpdevelopment.me>
 */
class Eighteen_Tags_Add_Nav_Icons {
	protected $ico;

	public function __construct() {
		add_filter( 'nav_menu_css_class', array( $this, 'icon_class' ), 10, 3 );
		add_filter( 'walker_nav_menu_start_el', array( $this, 'add_icon' ), 10, 4 );

	}

	public function icon_class( $classes, $item, $args ) {
		$temp = array();
		$this->ico = null;

		foreach ( $classes as $class ) {
			if ( strpos( $class, 'fa-' ) !== 0 ) {
				$temp[] = $class;
			} else {
				$this->ico = $class;
			}
		}

		return $temp;
	}

	public function add_icon( $html, $i, $depth ) {
		if ( $this->ico ) {
			$html = "<a href='{$i->url}'><i class='fa {$this->ico}'> </i>{$i->title}</a>";
		}
		return $html;
	}

}