<?php
get_header( 'novel' );

if ( have_posts() ) {
	the_post();
	$novel = new Cominovel_Novel( $GLOBALS['post'] );
	cominovel_template( 'single/novel', compact( 'novel' ) );
}

do_action( 'cominovel_sidebars' );

// Get theme footer
get_footer( 'novel' );
