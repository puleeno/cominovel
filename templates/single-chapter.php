<?php
get_header( 'novel' );

if ( have_posts() ) {
	the_post();
	if ( $post->post_parent > 0 ) {
		$chapter = new Cominovel_Chapter( $GLOBALS['post'] );
		cominovel_template( 'single/novel', compact( 'chapter' ) );
	}
}

do_action( 'cominovel_sidebars' );

// Get theme footer
get_footer( 'novel' );
