<?php
get_header( 'cominovel' );

cominovel_template( 'heading/search', array( 'title' => cmn_get_search_title() ) );

global $wp_query;
$args = array(
	'image_size'    => 'thumbnail',
	'layout'        => 'default',
	'content_style' => 'dark-content',
	'num'           => 10,
	'post_type'     => 'comic',
	'title'         => '',
	'type'          => 'hot',
	'title_tag'     => 'h3',
	'fields'        => 'title,author,likes,genres',
	'items_per_row' => 4,
);

$archive = new Cominovel_Layout( $wp_query, $args );
$archive->render();

do_action( 'cominovel_sidebars' );

// Get theme footer
get_footer( 'cominovel' );
