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

	protected $screen;

	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	public function admin_styles() {
	}

	public function admin_scripts() {
		wp_register_script( 'cominovel-admin', cominovel()->plugin_url( 'public/js/admin.js' ) );
		wp_enqueue_script( 'cominovel-admin' );
	}
}

return new Cominovel_Admin_Assets();
