<?php
use Jankx\Template\Template;
use Jankx\Template\Loader;

function cominovel_core_template( $template, $data = array(), $require_once = false ) {
	$template = sprintf( '%s/admin/templates/%s.php', COMINOVEL_INC_DIR, $template );
	if ( file_exists( $template ) ) {
		extract( $data );
		if ( $require_once ) {
			require_once $template;
		} else {
			require $template;
		}
	}
}

/**
 * Load the cominovel template
 */
function cominovel_template( $templates, $data = [], $context = '', $echo = true ) {
	if ( empty( $GLOBALS['cominovel_template'] ) ) {
		$GLOBALS['cominovel_template'] = Template::getInstance(
			COMINOVEL_TEMPLATES_DIR,
			'cominovel'
		);
	}
	$templateLoader = $GLOBALS['cominovel_template'];
	if ( ! ( $templateLoader instanceof Loader ) ) {
		throw new \Error(
			sprintf( 'The template loader must be is instance of %s', Loader::class )
		);
	}

	return $templateLoader->render(
		$templates,
		$data,
		$echo
	);
}

function cominovel_asset_url( $path = '', $prefix = '' ) {
	return sprintf(
		'%sassets/%s',
		plugin_dir_url( COMINOVEL_PLUGIN_FILE ),
		$path
	);
}

if ( ! function_exists( 'array_get' ) ) {
	function array_get( $array, $key, $defaultValue = false ) {
		$keys = explode( '.', $key );
		foreach ( $keys as $key ) {
			if ( ! isset( $array[ $key ] ) ) {
				return $defaultValue;
			}
			$value = $array = $array[ $key ];
		}
		return $value;
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
			'wpv2'                  => rest_url( 'wp/v2/' ),
			'fetchComic'            => rest_url( 'cominovel/v1/comic/<post_id>' ),
			'edit_link'             => admin_url( 'post.php?post=<post_id>&action=edit' ),
			'update_chapter_parent' => rest_url( 'cominovel/v1/chapter/parent/' ),
			'seasons'               => rest_url( 'cominovel/v1/seasons/' ),
		)
	);
}

/**
 * This is feature is develop in the future.
 *
 * @return  boolean  Edit on front end is enaled.
 */
function frontend_edit_enabled() {
	return false;
}

function cominovel_get_country( $post = null, $args = array() ) {
	if ( null === $post ) {
		$post = $GLOBALS['post'];
	} else {
		$post = get_post( $post );
	}

	if ( in_array( $post->post_type, array( 'comic', 'novel' ) ) ) {
		return wp_get_post_terms( $post->ID, 'cmn_country', $args );
	} elseif ( $post->post_type == 'chapter' ) {
		return wp_get_post_terms( $post->post_parent, 'cmn_country', $args );
	}

	return __return_empty_array();
}

function cominovel_get_tag( $post = null, $args = array() ) {
	if ( null === $post ) {
		$post = $GLOBALS['post'];
	} else {
		$post = get_post( $post );
	}

	if ( in_array( $post->post_type, array( 'comic', 'novel' ) ) ) {
		return wp_get_post_terms( $post->ID, 'cmn_tag', $args );
	} elseif ( $post->post_type == 'chapter' ) {
		return wp_get_post_terms( $post->post_parent, 'cmn_tag', $args );
	}

	return __return_empty_array();
}

function cominovel_filter_user_likes_posts( $postwhere, $query = null ) {
}

function cominovel_filter_user_follows_posts( $postwhere, $query = null ) {
}
