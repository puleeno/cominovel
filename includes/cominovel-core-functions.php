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

function cominovel_asset_url( $path = '', $prefix = '' ) {
	return sprintf(
		'%sassets/%s',
		plugin_dir_url( COMINOVEL_PLUGIN_FILE ),
		$path
	);
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
	function array_combine_args( $default_args, $new_args ) {
		if ( is_array( $default_args ) ) {
			$args = $default_args;
		} else {
			$args = array();
		}
		foreach ( (array) $new_args as $index => $value ) {
			if ( is_numeric( $index ) ) {
				$args[] = $value;
			} else {
				$args[ $index ] = $value;
			}
		}
		return $args;
	}
}

if ( ! function_exists( 'array_trim' ) ) {
	function array_trim( $arr ) {
		return array_filter(
			array_map(
				'trim',
				$arr
			),
			'strlen'
		);
	}
}

function cominovel_endpoints() {
	return apply_filters(
		'cominovel_rest_endpoints',
		array(
			'wpv2'       => rest_url( 'wp/v2/' ),
			'fetchComic' => rest_url( 'cominovel/v1/comic/<post_id>' ),
			'edit_link'  => admin_url( 'post.php?post=<post_id>&action=edit' ),
		)
	);
}
