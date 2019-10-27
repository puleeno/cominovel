<?php
/**
 * Plugin Name: Cominovel
 * Plugin URI: https://puleeno.com
 * Author: Ramphor Premium
 * Author URI: https://puleeno.com
 * Version: 1.0.9.1
 * Description: The Comic and Novel WordPress plugin by Ramphor Premium
 * Tags:  comic, novel, cloud, storage, cdn
 *
 * @package Cominovel
 */

/**
 * Init Cominovel plugin
 */
define( 'COMINOVEL_PLUGIN_FILE', __FILE__ );

if ( ! class_exists( 'Cominovel' ) ) {
	require_once dirname( COMINOVEL_PLUGIN_FILE ) . '/includes/class-cominovel.php';
}

if ( ! function_exists( 'cominovel' ) ) {
	/**
	 * This function will be return Cominovel instance
	 *
	 * @return  Cominovel  main instance of Cominovel
	 */
	function cominovel() {
		return Cominovel::instance();
	}
}

$GLOBALS['cominovel'] = cominovel();
