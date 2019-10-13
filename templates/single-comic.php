<?php
get_header( 'comic' );

if ( have_posts() ) {
	the_post();
	$post = $GLOBALS['post'];
	if ( $post->post_parent > 0 ) {
		$chapter = new Cominovel_Chapter( $post );
		cominovel_template( 'comic/chapter', compact( 'chapter' ) );
	} else {
		$comic = new Cominovel_Comic( $post );
		cominovel_template( 'comic/comic', compact( 'comic' ) );
	}
}

do_action( 'cominovel_sidebars' );

// Get theme footer
get_footer( 'comic' );
