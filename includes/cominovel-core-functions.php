<?php

function cominovel_core_template( $template, $data = array(), $parent_template_directory = '', $require_once = false ) {
	$template_loader = Cominovel_Template_Loader::instance();
	$template        = $template_loader->core_template( $template, $parent_template_directory );
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

function cominovel_asset_url( $path = '' ) {
	return sprintf(
		'%sassets/%s',
		plugin_dir_url( COMINOVEL_PLUGIN_FILE ),
		$path
	);
}


function cominovel_echo( $text, $context = null ) {
	if ( ! empty( $context ) ) {
		$text = apply_filters( "cominovel_echo_{$context}", $text );
	}
	echo wp_kses_post( $text );
}

if ( ! function_exists( 'array_get' ) ) {
	function array_get( $arr, $arrayIndex, $defaultValue = null ) {
		if ( is_string( $arrayIndex ) ) {
			$arrayIndex = explode( '.', $arrayIndex );
		} else {
			$arrayIndex = (array) $arrayIndex;
		}
		foreach ( $arrayIndex as $index ) {
			if ( ! isset( $arr[ $index ] ) ) {
				return $defaultValue;
			}
			$arr = $arr[ $index ];
		}
		return $arr;
	}
}

if ( ! function_exists( 'array_combine_args' ) ) {
	function array_combine_args() {
	}
}

function cm_post_thumbnail( $size = 'thumbnail' ) {
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( $size );
	}
}

function cm_the_title( $title, $tag = 'h3' ) {
	var_dump( $tag );
	die;
	echo wp_kses_post( sprintf( '<%1$s>%2$s</%1$s>', $tag, $title ) );
}
