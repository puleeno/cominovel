<div class="cm-loop-chapter">
	<div class="cm-block-inner">
		<div class="e-chapter cm-chapter-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
		<div class="e-chapter cm-chapter-name">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</div>
		<div class="e-chapter cm-likes">
			<span class="fa fa-thumbs-up"></span>
			<?php cominovel_echo( $chapter->likes ); ?>
		</div>
		<div class="e-chapter cm-update-date">
			<?php cominovel_echo( '15/02/2018' ); ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
