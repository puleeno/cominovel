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

function cominovel_locale_template( $template ) {
	$template_loader = Cominovel_Template_Loader::instance();
	return $template_loader->locale_template( $template );
}

/**
 * Load the cominovel template
 */
function cominovel_template( $template, $data = array(), $require_once = false ) {
	$template = cominovel_locale_template( $template );
	if ( $template ) {
		extract( $data );
		if ( $require_once ) {
			require_once $template;
		} else {
			require $template;
		}
	}
}
