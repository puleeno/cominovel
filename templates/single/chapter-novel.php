<?php
do_action( 'cominovel_before_novel_chapter_content', $chapter );

cominovel_template( 'heading/chapter-content' );

$pre_novel_content = apply_filters( 'cominovel_chapter_novel_content', false, $chapter );
if ( empty( $pre_novel_content ) ) {
	$total_images = count( $chapter->chapter_images );
	cominovel_template( 'block/start-chapter', compact( 'chapter' ) );
	the_content();
	cominovel_template( 'block/end-chapter', compact( 'chapter' ) );
} else {
	cominovel_template(
		'single/chapter-custom',
		array(
			'content' => $pre_novel_content,
			'chapter' => $chapter,
		)
	);
}

do_action( 'cominovel_after_novel_chapter_content', $chapter );

comments_template();
