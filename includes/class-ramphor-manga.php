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

		if ($this->is_request('admin')) {
			require_once RPM_ABSPATH . 'includes/admin/class-rpm-admin.php';
		}

		if ( $this->is_request('frontend')) {
			$this->frontend_includes();
		}

		$this->theme_support_includes();
		$this->query = new RPM_Query();
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) && ! $this->is_rest_api_request();
		}
	}

	public function is_rest_api_request() {
		if ( empty( $_SERVER['REQUEST_URI'] ) ) {
			return false;
		}
		$rest_prefix         = trailingslashit( rest_get_url_prefix() );
		$is_rest_api_request = ( false !== strpos( $_SERVER['REQUEST_URI'], $rest_prefix ) ); // phpcs:disable WordPress.Security.ValidatedSanitizedInput.MissingUnslash, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		return apply_filters( 'ramphor_manga_is_rest_api_request', $is_rest_api_request );
	}

	public function hooks() {
	}

	public function frontend_includes() {
	}

	private function theme_support_includes() {
	}
}
