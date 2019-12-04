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

function cmn_the_title( $title, $tag = 'h3' ) {
	echo wp_kses_post( sprintf( '<%1$s class="item-title">%2$s</%1$s>', $tag, $title ) );
}


function cmn_the_author() {
	echo wp_kses_post(
		'<a href="#">Puleeno</a>'
	);
}


function cmn_the_likes() {
	echo wp_kses_post( '199 Tr' );
}


add_action( 'cominovel_after_comic_chapter_content', 'cominovel_related_content' );
add_action( 'cominovel_after_comic_content', 'cominovel_related_content' );
function cominovel_related_content( $current_object = null ) {
	$limit     = get_option( 'cominovel_related_limit_posts', 6 );
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
		cominovel_template( 'heading/related-' . $post_type );

		cominovel_template(
			'block/start-related',
			array(
				'items'     => 6,
				'post_type' => array( $post_type ),
				'layout'    => 'card',
			)
		);
		while ( $wp_query->have_posts() ) {
			$wp_query->the_post();
			$post = $wp_query->post;
			cominovel_template(
				'loop/item-card',
				array(
					'item'       => $post->post_type === 'comic'
						? new Cominovel_Comic( $post )
						: new Cominovel_Novel( $post ),
					'title_tag'  => 'h2',
					'image_size' => 'medium',
					'fields'     => array( 'title', 'author', 'likes' ),
				)
			);
		}
		echo '<div class="clearfix"></div>';
		wp_reset_query();
		cominovel_template( 'block/end-related' );
	}
}


add_action( 'cominovel_before_chapter_list', 'cominovel_chapter_list_toolbars' );
function cominovel_chapter_list_toolbars() {
}
