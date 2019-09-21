<?php
get_header( 'comic' );

if ( have_posts() ) {
	the_post();
	$post = $GLOBALS['post'];
	if ( $post->post_parent > 0 ) {
		cominovel_template( 'comic/chapter' );
	} else {
		cominovel_template( 'comic/comic' );
	}
}

get_sidebar( 'comic' );

get_footer( 'comic' );
