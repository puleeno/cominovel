<?php
/**
 * Plugin Name: Ramphor Manga
 * Plugin URI: https://puleeno.com
 * Author: Puleeno Nguyen
 * Author URI: https://puleeno.com
 * Version: 1.0
 * Description: Manga plugins
 * Tags: manga, cloud, cdn
 *
 * @package Ramphor/Manga
 */

/**
 * Init Ramphor Manga plugin
 */
define( 'RAMPHOR_MANGA_PLUGIN_FILE', __FILE__ );

if ( ! class_exists( 'Ramphor_Manga' ) ) {
	require_once dirname( RAMPHOR_MANGA_PLUGIN_FILE ) . '/includes/class-ramphor-manga.php';
}

if ( ! function_exists( 'ramphor_manga' ) ) {
	/**
	 * This function will be return Ramphor_Manga instance
	 *
	 * @return  Ramphor_Manga  main instance of Ramphor Manga
	 */
	function ramphor_manga() {
		return Ramphor_Manga::instance();
	}
}

$GLOBALS['rp_manga'] = ramphor_manga();
