<?php
get_header( 'comic' );

if ( have_posts() ) {
	the_post();
	$comic = new Cominovel_Comic( $GLOBALS['post'] );
	cominovel_template( 'single/comic', compact( 'comic' ) );
}

do_action( 'cominovel_sidebars' );

// Get theme footer
get_footer( 'comic' );
