<?php
/**
 * Load assets for Cominovel admin page
 *
 * @package Ramphor/Admin
 * @category Cominovel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Cominovel_Admin_Assets class.
 */
class Cominovel_Admin_Assets {

	protected $current_screen;
	protected $run_mode = 'prod';
	protected $dev_host = 'http://localhost';
	protected $dev_port;

	public function __construct() {
		if ( defined( 'COMINOVEL_DEV_MODE' ) && COMINOVEL_DEV_MODE ) {
			$this->run_mode = 'dev';
			$this->init_dev_mode();
		}
		add_action( 'current_screen', array( $this, 'get_screen' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_react_app' ) );
	}

	public function get_screen() {
		$this->current_screen = get_current_screen();
	}

	private function init_dev_mode() {
		if ( defined( 'COMINOVEL_DEV_PORT' ) && COMINOVEL_DEV_PORT != 80 ) {
			$this->dev_port = sprintf( ':%s', COMINOVEL_DEV_PORT );
		}
		if ( defined( 'COMINOVEL_DEV_HOST' ) ) {
			$this->dev_host = COMINOVEL_DEV_HOST;
		}
	}

	private function dev_asset_url( $path = '' ) {
		return sprintf(
			'%s%s/%s',
			$this->dev_host,
			$this->dev_port,
			$path
		);
	}

	public function register_react_app() {
		if (
			$this->current_screen->base === 'post' &&
			in_array(
				$this->current_screen->id,
				Cominovel_Post_Types::get_allowed_post_types()
			)
		) {
			if ( $this->run_mode === 'dev' ) {
				$this->register_dev_react_assets();
			} else {
				$this->register_prod_react_assets();
			}

			// Localize the script with new data
			$languages = require COMINOVEL_INC_DIR . '/languages/react-app-languages.php';
			$messages  = require COMINOVEL_INC_DIR . '/languages/react-app-messages.php';
			wp_localize_script(
				Cominovel::NAME,
				'Cominovel',
				apply_filters(
					'cominovel_global_js_object',
					array(
						'endpoints' => cominovel_endpoints(),
						'currentID' => $GLOBALS['post']->ID,
						'languages' => $languages,
						'messages'  => $messages,
					)
				)
			);
			wp_enqueue_script( Cominovel::NAME );
		}
		if ( $this->current_screen->id === 'chapter' ) {
			wp_register_style( 'select2', cominovel_asset_url( 'vendor/select2/css/select2.min.css' ), array(), '4.0.11' );
			wp_register_script( 'select2', cominovel_asset_url( 'vendor/select2/js/select2.min.js' ), array(), '4.0.11', true );

			wp_enqueue_script( 'select2' );
			wp_enqueue_style( 'select2' );
			add_action(
				'admin_footer',
				function() {
					?>
				<script>
					(function($){
						$(document).ready(function(){
							$('#post_parent').select2();
						})
					})(jQuery);
				</script>
					<?php
				}
			);
		}
	}

	public function register_dev_react_assets() {
		wp_register_script( 'cominovel-bundle', $this->dev_asset_url( 'static/js/bundle.js' ), array(), Cominovel::getVersion(), true );
		wp_register_script( 'cominovel-runtime', $this->dev_asset_url( 'static/js/0.chunk.js' ), array(), Cominovel::getVersion(), true );
		wp_register_script( Cominovel::NAME, $this->dev_asset_url( 'static/js/main.chunk.js' ), array( 'cominovel-bundle', 'cominovel-runtime' ), Cominovel::getVersion(), true );

		wp_enqueue_script( Cominovel::NAME );
	}

	public function register_prod_react_assets() {
		$assets_config = require sprintf( '%s/assets.config.php', COMINOVEL_ABSPATH );
		wp_register_style( 'cominovel-libraries', cominovel_asset_url( 'css/' . $assets_config['css']['library'] ), null, Cominovel::getVersion() );
		wp_register_style( Cominovel::NAME, cominovel_asset_url( 'css/' . $assets_config['css']['main'] ), array( 'cominovel-libraries' ), Cominovel::getVersion() );

		wp_register_script( 'cominovel-locale', rest_url( 'cominovel/v1/locale/' . get_locale() . '.js' ), array(), Cominovel::getVersion(), true );
		wp_register_script( 'cominovel-runtime', cominovel_asset_url( 'js/' . $assets_config['js']['runtime'] ), null, Cominovel::getVersion(), true );
		wp_register_script( 'cominovel-libraries', cominovel_asset_url( 'js/' . $assets_config['js']['library'] ), null, Cominovel::getVersion(), true );
		wp_register_script( Cominovel::NAME, cominovel_asset_url( 'js/' . $assets_config['js']['main'] ), array( 'cominovel-runtime', 'cominovel-libraries' ), Cominovel::getVersion(), true );

		wp_enqueue_style( Cominovel::NAME );
	}
}

return new Cominovel_Admin_Assets();
