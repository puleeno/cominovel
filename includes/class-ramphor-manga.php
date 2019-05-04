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

	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->hooks();
	}

	private function define( $name, $value ) {
		if (!defined($name)) {
			define($name, $value);
		}
	}

	public function define_constants() {
		$this->define('RPM_ABSPATH', plugin_dir_path( RAMPHOR_MANGA_PLUGIN_FILE ) );
	}

	public function includes() {
		/**
		 * Interfaces
		 */

		/**
		 * Abstract classes
		 */

		/**
		 * Core classses
		 */
		require_once RPM_ABSPATH . 'includes/rpm-core-functions.php';
		require_once RPM_ABSPATH . 'includes/class-rpm-post-types.php';
		require_once RPM_ABSPATH . 'includes/class-rpm-install.php';
		require_once RPM_ABSPATH . 'includes/class-rpm-query.php';
		require_once RPM_ABSPATH . 'includes/class-rpm-manga-query.php';


		$this->query = new RPM_Query();
	}

	public function hooks() {
	}

	public function frontend_includes() {
	}

	private function theme_support_includes() {
	}
}
