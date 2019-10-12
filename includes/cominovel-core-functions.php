<?php

function cominovel_core_template( $template, $data = array(), $require_once = false ) {
	$template_loader = Cominovel_Template_Loader::instance();
	$template        = $template_loader->core_template( $template );
	if ( $template ) {
		extract( $data );
		if ( $require_once ) {
			require_once $template;
		} else {
			require $template;
		}
	}
}

function cominovel_locate_template( $template ) {
	$template_loader = Cominovel_Template_Loader::instance();
	return $template_loader->locate_template( $template );
}

/**
 * Load the cominovel template
 */
function cominovel_template( $template, $data = array(), $require_once = false ) {
	$template = cominovel_locate_template( $template );
	if ( $template ) {
		extract( $data );
		if ( $require_once ) {
			require_once $template;
		} else {
			require $template;
		}
	}
}

function cominovel_asset_url( $path = '') {
	return sprintf(
		'%sassets/%s',
		plugin_dir_url( COMINOVEL_PLUGIN_FILE ),
		$path
	);
}
