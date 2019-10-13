<div class="cm cm-loop cm-loop-chapter">
	<div class="cm-inner">
		<div class="cm cm-chapter-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
		<div class="cm cm-chapter-name">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</div>
		<div class="cm cm-likes">
			<span class="fa fa-thumbs-up"></span>
			<?php cominovel_echo( $chapter->likes ); ?>
		</div>
		<div class="cm cm-update-date">
			<?php cominovel_echo( $chapter->created_at ); ?>
		</div>
	</div>
</div>
