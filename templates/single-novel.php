<?php
get_header( 'cominovel' );

if ( have_posts() ) {
	the_post();
	$novel = new Cominovel_Novel( $GLOBALS['post'] );

	// Load the comic chapters to render chapter list.
	$comic->load_chapters();
	cominovel_template( 'single/novel', compact( 'novel' ) );
}

do_action( 'cominovel_sidebars' );

// Get theme footer
get_footer( 'cominovel' );
