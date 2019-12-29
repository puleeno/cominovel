<?php
/**
 * The main Cominovel plugin file
 *
 * @package Cominovel
 * @author  Puleeno Nguyen <puleeno@gmail.com>
 */

use Ramphor\User\Profile as UserProfile;
use Ramphor\User\LoginStyle\Enum as LoginStyle;

if ( ! class_exists( 'Cominovel' ) ) {
	/**
	 * Class Cominovel is the main class of Cominovel plugin
	 */
	class Cominovel {

		const NAME = 'cominovel';

		public $info;

		/**
		 * The instance of class Cominovel.
		 *
		 * @var Cominovel
		 */
		protected static $instance;

		/**
		 * Get Ramphor comic instance or create if not exists.
		 *
		 * @return  Cominovel  The instance of Cominovel class.
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
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		public function define_constants() {
			$this->define( 'COMINOVEL_ABSPATH', plugin_dir_path( COMINOVEL_PLUGIN_FILE ) );
			$this->define( 'COMINOVEL_INC_DIR', sprintf( '%sincludes', COMINOVEL_ABSPATH ) );
			$this->define( 'COMINOVEL_TEMPLATES_DIR', sprintf( '%stemplates', COMINOVEL_ABSPATH ) );

			if ( ! function_exists( 'get_plugin_data' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}
			$this->info = get_plugin_data( COMINOVEL_PLUGIN_FILE );
		}

		public static function getVersion() {
			return self::instance()->info['Version'];
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
			require_once COMINOVEL_ABSPATH . 'includes/cominovel-core-functions.php';
			require_once COMINOVEL_ABSPATH . 'includes/cominovel-template-functions.php';

			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-post-types.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-taxonomies.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-install.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-query.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-storage-manager.php';

			/**
			 * Load libraries via composer
			 */
			$composer = COMINOVEL_ABSPATH . 'vendor/autoload.php';
			if ( file_exists( $composer ) ) {
				require_once $composer;
			}

			require_once COMINOVEL_ABSPATH . 'includes/abstracts/class-cominovel-data.php';
			require_once COMINOVEL_ABSPATH . 'includes/abstracts/class-cominovel-shortcode-abstract.php';

			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-comic.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-novel.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-chapter.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-frontend.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-template-loader.php';

			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-addons.php';

			require_once COMINOVEL_ABSPATH . 'includes/shortcodes/class-cominovel-shortcode-post.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-layout.php';
			require_once COMINOVEL_ABSPATH . 'includes/shortcodes/class-cominovel-shortcode.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-seo.php';

			require_once COMINOVEL_ABSPATH . 'includes/rest/class-cominovel-rest-api.php';

			if ( $this->is_request( 'admin' ) ) {
				require_once COMINOVEL_ABSPATH . 'includes/admin/class-cominovel-admin.php';
			}

			if ( $this->is_request( 'frontend' ) ) {
				$this->frontend_includes();
			}

			$this->theme_support_includes();
			if ( class_exists( 'Cominovel_Query' ) ) {
				$this->query = new Cominovel_Query();
			}
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
					return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
			}
		}

		public function hooks() {
			register_activation_hook( COMINOVEL_PLUGIN_FILE, array( Cominovel_Install::class, 'active' ) );
			register_deactivation_hook( COMINOVEL_PLUGIN_FILE, array( Cominovel_Install::class, 'deactive' ) );

			add_action( 'init', array( $this, 'init' ) );

			/**
			 * Register Cominovel Shortcode
			 */
			add_shortcode( 'cominovel', array( Cominovel_Shortcode::class, 'register' ) );

			if ( class_exists( UserProfile::class ) ) {
				UserProfile::init(
					array(
						'templates_location' => sprintf( '%s/templates/users', COMINOVEL_ABSPATH ),
						'login_styles'       => array(
							LoginStyle::LOGIN_STYLE_WORDPRESS_NATIVE,
							LoginStyle::LOGIN_STYLE_POPUP_MODAL,
						),
					)
				);
			}
		}

		public function frontend_includes() {
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-scripts.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-template.php';
			require_once COMINOVEL_ABSPATH . 'includes/class-cominovel-breadcrumb.php';
		}

		private function theme_support_includes() {
			require_once COMINOVEL_ABSPATH . 'includes/theme-supports/class-cominovel-integrate-elementor.php';
			require_once COMINOVEL_ABSPATH . 'includes/theme-supports/class-cominovel-integrate-jankx.php';
		}

		public function init() {
			do_action( 'before_cominovel_init' );

			$this->load_plugin_textdomain();
		}

		public function load_plugin_textdomain() {
			$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
			$locale = apply_filters( 'plugin_locale', $locale, 'cominovel' );
			unload_textdomain( 'cominovel' );
			load_textdomain( 'cominovel', WP_LANG_DIR . '/cominovel/cominovel-' . $locale . '.mo' );
			load_plugin_textdomain( 'cominovel', false, plugin_basename( dirname( COMINOVEL_PLUGIN_FILE ) ) . '/languages' );
		}

		public function plugin_url( $path = '/' ) {
			return untrailingslashit( plugins_url( $path, COMINOVEL_PLUGIN_FILE ) );
		}

		public static function create_meta_key( $key ) {
			return sprintf( 'cominovel_%s', $key );
		}

		/**
		 * This method use to check Cominovel Develop Mode
		 */
		public static function is_dev_mode() {
			return defined( 'COMINOVEL_DEV_MODE' ) && constant( 'COMINOVEL_DEV_MODE' );
		}
	}
}
