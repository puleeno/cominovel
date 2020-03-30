<?php
function cominovel_echo( $text, $context = null ) {
	if ( ! empty( $context ) ) {
		$text = apply_filters( "cominovel_echo_{$context}", $text );
	}
	echo wp_kses_post( $text );
}

function cmn_comic_thumbnail( $size, $attr = array(), $comic_id = null ) {
	if ( is_null( $comic_id ) ) {
		$comic_id = $GLOBALS['post']->ID;
	}
	$thumbnail_id = get_post_thumbnail_id( $comic_id );
	return wp_get_attachment_image( $thumbnail_id, $size, false, $attr );
}

function cmn_post_thumbnail( $size = 'thumbnail', $attr = array(), $comic_id = null ) {
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( $size );
		return;
	}
	echo cmn_comic_thumbnail( $size, $attr, $comic_id );
}

function cmn_the_post_thumbnail( $post = null ) {
	if ( is_null( $post ) ) {
		$post = $GLOBALS['post'];
	} elseif ( ! $post instanceof WP_Post ) {
		$post = get_post( $post );
	}
	if ( empty( $post ) ) {
		cominovel_template( 'item/no-thumbnail' );
		return;
	}
}

function cmn_the_title( $title, $tag = 'h3' ) {
	echo wp_kses_post( sprintf( '<%1$s class="item-title">%2$s</%1$s>', $tag, $title ) );
}

function cmn_the_likes() {
	echo wp_kses_post( '199 Tr' );
}

add_action( 'cominovel_after_comic_chapter_content', 'cominovel_related_content' );
add_action( 'cominovel_after_comic_content', 'cominovel_related_content' );
function cominovel_related_content( $current_object = null ) {
	$limit     = get_option( 'cominovel_related_limit_posts', 4 );
	$post_type = $current_object->post_type === 'chapter'
	? get_post_type( $current_object->parent )
	: $current_object->post_type;
	$args      = apply_filters(
		'cominovel_related_args',
		array(
			'post_type'      => $post_type,
			'posts_per_page' => $limit,
		)
	);

	$wp_query = new WP_Query( $args );
	if ( $wp_query->have_posts() ) {
		echo wp_kses_post( '<div class="cominovel-realate-posts">' );
		cominovel_template( 'heading/related-' . $post_type );

		cominovel_template(
			'block/start-related',
			array(
				'items'     => 4,
				'post_type' => array( $post_type ),
				'layout'    => 'card',
			)
		);
		$post_layouts = array(
			'layout' => 'vcard',
		);
		while ( $wp_query->have_posts() ) {
			$wp_query->the_post();
			$post = $wp_query->post;
			if ( apply_filters( 'cominovel_is_custom_post', false, $post, $wp_query ) ) {
				do_action( 'cominovel_custom_post_loop_content', $post, $post_layouts, $wp_query );
			} else {
				cominovel_template(
					'loop/item-card',
					array_merge(
						$post_layouts,
						array(
							'item'       => $post->post_type === 'comic'
								? new Cominovel_Comic( $post )
								: new Cominovel_Novel( $post ),
							'title_tag'  => 'h2',
							'image_size' => 'medium',
							'fields'     => array( 'title', 'author', 'likes' ),
						)
					)
				);
			}
		}
		echo '</div><div class="clearfix"></div>';
		wp_reset_query();
		cominovel_template( 'block/end-related' );
	}
}

add_action( 'cominovel_before_chapter_list', 'cominovel_chapter_list_toolbars' );
function cominovel_chapter_list_toolbars() { }

function cmn_get_archive_title() {
	$queried_object = get_queried_object();
	if ( isset( $queried_object->name ) ) {
		return $queried_object->name;
	}
}

function cmn_get_search_title() {
	$search_query = get_search_query();
	$title        = sprintf( __( 'Kết quả tìm kiếm: %s', 'cominovel' ), $search_query );

	return apply_filters(
		'cominovel_search_title',
		$title,
		$search_query
	);
}

function cmn_the_tag( $post_id = null ) {
	if ( is_null( $post_id ) ) {
		$post_id = get_the_ID();
	}
	$tags = wp_get_post_terms( $post_id, 'cmn_tag' );
	cominovel_template( 'item/tags', compact( 'tags' ) );
}

function cmn_the_views( $post_id = null ) {
	if ( $post_id === null ) {
		$post_id = get_the_ID();
	}
	$meta_views_key = '_ramphor_post_views';
	$total_views    = get_post_meta( $post_id, $meta_views_key, true );

	cominovel_template(
		'item/views',
		[
			'views' => $total_views,
		]
	);
}
