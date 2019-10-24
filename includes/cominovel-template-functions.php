<?php

function cominovel_echo( $text, $context = null ) {
	if ( ! empty( $context ) ) {
		$text = apply_filters( "cominovel_echo_{$context}", $text );
	}
	echo wp_kses_post( $text );
}


function cm_post_thumbnail( $size = 'thumbnail' ) {
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( $size );
	}
}

function cm_the_title( $title, $tag = 'h3' ) {
	echo wp_kses_post( sprintf( '<%1$s>%2$s</%1$s>', $tag, $title ) );
}


function cm_the_author() {
	echo wp_kses_post(
		'Puleeno Nguyen'
	);
}


function cm_the_likes() {
	echo wp_kses_post( '199 Tr' );
}
