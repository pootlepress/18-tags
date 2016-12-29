<?php
/**
 * Eighteen tags abstract class
 * @developer http://wpdevelopment.me <shramee@wpdevelopment.me>
 */

/**
 * Eighteen_Tags_Abstract
 * All classes except main extend this
 *
 * @class Eighteen_Tags_Abstract
 * @version	1.0.0
 * @since 1.0.0
 * @package	Eighteen_Tags
 */
abstract class Eighteen_Tags_Abstract {

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;
	
	/*
	 * The plugin directory url.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $plugin_url;

	/*
	 * The plugin directory url.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $plugin_path;

	/**
	 * Constructor function.
	 *
	 * @param string $token
	 * @param string $url
	 * @param string $path
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function __construct( $token, $path, $url ) {



		$this->token 	   = $token;
		$this->plugin_path = $path;
		$this->plugin_url  = $url;

		if ( method_exists( $this, 'init' ) ) {
			$this->init( func_get_args() );
		}
	}

	/**
	 * Gets the theme mod for customizer fields
	 *
	 * @param string $id
	 * @param mixed $default
	 * @return mixed Setting value
	 */
	public function get( $id, $default = null ){
		return get_theme_mod( $this->token . '-' . preg_replace( "/[^\w]+/",  '-', strtolower( $id ) ), $default );
	}

	/**
	 * Gets the theme mod for customizer fields
	 *
	 * @param string $value Font style option value
	 * @return string Setting value
	 */
	public function font_style( $value ){
		return eighteen_tags_font_style( $value );
	}

	/**
	 * Hook for descendant class
	 * @return void
	 */
	public function init(){
		//For descendants
	}

} // End class