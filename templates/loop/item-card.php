<div class="cm item card-layout">
	<div class="cm-inner">
		<div class="cm item-thumbnail">
			<div class="overlay"></div>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php cm_post_thumbnail(); ?>
			</a>
		</div>
		<div class="cm-main">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php
			cm_the_title(
				get_the_title(),
				$title_tag
			);
			?>
			</a>
		</div>
	</div>
</div>
