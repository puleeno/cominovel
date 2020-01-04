<?php
do_action( 'cominovel_before_comic_chapter_content', $chapter );

cominovel_template( 'heading/chapter-content' );

$pre_comic_content = apply_filters( 'cominovel_chapter_comic_content', false, $chapter );
if ( empty( $pre_comic_content ) ) {
	$total_images = count( $chapter->chapter_images );
	cominovel_template( 'block/start-chapter', compact( 'chapter' ) );
	foreach ( $chapter->chapter_images as $index => $image ) {
		do_action( 'cominovel_content_before_image', $index, $total_images );
		cominovel_template( 'loop/image', compact( 'index', 'image' ) );
		do_action( 'cominovel_content_after_image', $index, $total_images );
	}
	cominovel_template( 'block/end-chapter', compact( 'chapter' ) );
} else {
	cominovel_template(
		'single/chapter-custom',
		array(
			'content' => $pre_comic_content,
			'chapter' => $chapter,
		)
	);
}

do_action( 'cominovel_after_comic_chapter_content', $chapter );

comments_template();
