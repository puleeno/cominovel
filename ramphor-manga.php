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
 * Load plugin classes
 *
 * @param string $plugin_file  Main file of plugin to detect and load plugin.
 */
function load_ramphor_manga( $plugin_file ) {
	if ( ! class_exists( 'Ramphor_Manga' ) ) {
		require_once dirname( $plugin_file ) . '/classes/class-ramphor-manga.php';
	}
}

define( 'RAMPHOR_MANGA_PLUGIN_FILE', __FILE__, true );
load_ramphor_manga( RAMPHOR_MANGA_PLUGIN_FILE );

$GLOBALS['rp_manga'] = Ramphor_Manga::instance();
