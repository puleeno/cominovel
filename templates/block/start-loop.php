<?php
echo wp_kses_post(
	sprintf(
		'<div class="cm-layouts layout-%1$s%2$s%3$s">',
		$layout,
		! empty( $items ) ? ' r' . $items . '-items' : '',
		! empty( $content_style ) ? ' ' . $content_style : '',
	)
);
?>
	<div class="posts items <?php echo implode( ' ', $post_type ); ?>">
