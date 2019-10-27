</div>
<?php
$next_chapter = $chapter->get_next_chapter();
$prev_chapter = $chapter->get_previous_chapter();
?>
<div class="chapter-navigation fixed-navigation">
	<div class="cm-block-inner">
		<div class="block-left">
			<a href="<?php echo wp_kses_post( $prev_chapter['url'] ); ?>"><?php _e( 'Prev Chapter', 'cominovel' ); ?></a>
		</div>
		<div class="block-right">
			<a href="<?php echo wp_kses_post( $next_chapter['url'] ); ?>"><?php _e( 'Next Chapter', 'cominovel' ); ?></a>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
