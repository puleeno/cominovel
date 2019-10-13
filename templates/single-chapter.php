<?php
get_header( 'novel' );

if ( have_posts() ) {
	the_post();
	$chapter      = new Cominovel_Chapter( $GLOBALS['post'] );
	$sub_template = 'none';
	if ( $chapter->parent_type ) {
		$sub_template = $chapter->parent_type;
	}
	cominovel_template( sprintf( 'single/chapter-%s', $sub_template ), compact( 'chapter' ) );
}

do_action( 'cominovel_sidebars' );

// Get theme footer
get_footer( 'novel' );
