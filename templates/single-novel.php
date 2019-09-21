<?php
get_header( 'novel' );

if ( have_posts() ) {
	the_post();
	$post = $GLOBALS['post'];
	if ( $post->post_parent > 0 ) {
		cominovel_template( 'novel/chapter' );
	} else {
		cominovel_template( 'novel/novel' );
	}
}

get_sidebar( 'novel' );

get_footer( 'novel' );
