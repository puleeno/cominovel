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
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_react_app' ) );
	}

	public function get_screen() {
		$this->current_screen = get_current_screen();
	}

	public function admin_styles() {
	}

	public function admin_scripts() {
		// wp_register_script( 'cominovel-admin', cominovel()->plugin_url( 'public/js/admin.js' ) );
		// wp_enqueue_script( 'cominovel-admin' );
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
		}
	}

	public function register_dev_react_assets() {
		wp_register_script( 'cominovel-bundle', $this->dev_asset_url( 'static/js/bundle.js' ), array(), null, true );
		wp_register_script( 'cominovel-runtime', $this->dev_asset_url( 'static/js/0.chunk.js' ), array(), null, true );
		wp_register_script( 'cominovel-main', $this->dev_asset_url( 'static/js/main.chunk.js' ), array( 'cominovel-bundle', 'cominovel-runtime' ), null, true );

		wp_enqueue_script( 'cominovel-main' );
	}

	public function register_prod_react_assets() {
	}
}

return new Cominovel_Admin_Assets();
