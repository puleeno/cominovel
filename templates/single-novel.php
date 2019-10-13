<?php
get_header( 'novel' );

if ( have_posts() ) {
	the_post();
	$post = $GLOBALS['post'];
	if ( $post->post_parent > 0 ) {
		$chapter = new Cominovel_Chapter( $post );
		cominovel_template( 'novel/chapter', compact( 'chapter' ) );
	} else {
		$novel = new Cominovel_Novel( $post );
		cominovel_template( 'novel/novel', compact( 'novel' ) );
	}
}

do_action( 'cominovel_sidebars' );

// Get theme footer
get_footer( 'novel' );
