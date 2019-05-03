<?php
/**
 * The main Ramphor Manga plugin file
 *
 * @package Ramphor/Manga
 * @author  Puleeno Nguyen <puleeno@gmail.com>
 */

/**
 * Class Ramphor_Manga is the main class of Ramphor Manga plugin
 */
class Ramphor_Manga {
	/**
	 * The instance of class Ramphor_Manga.
	 *
	 * @var Ramphor_Manga
	 */
	protected static $instance;

	/**
	 * Get Ramphor manga instance or create if not exists.
	 *
	 * @return  Ramphor_Manga  The instance of Ramphor_Manga class.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
