<?php
do_action( 'cominovel_before_comic_chapter_custom_content', $chapter, $content );

echo apply_filters(
	'the_content',
	$content
);

do_action( 'cominovel_after_comic_chapter_custom_content', $chapter, $content );
