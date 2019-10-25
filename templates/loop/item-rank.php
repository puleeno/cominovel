<div class="cm item rank-layout">
	<div class="cm-inner">
		<div class="cm item-thumbnail">
			<div class="overlay"></div>
			<a class="cm item-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<div class="cm-inner link-inner">
					<?php cm_post_thumbnail( $image_size ); ?>
					<div class="bot-inf">
						<?php if ( in_array( 'author', $fields ) ) : ?>
							<div class="author">
								<?php cm_the_author(); ?>
							</div>
						<?php endif; ?>
						<?php if ( in_array( 'likes', $fields ) ) : ?>
							<div class="likes">
								<span class="fa fa-thumbs-up"></span>
								<?php cm_the_likes(); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</a>
		</div>

		<div class="cm-main">
			<?php if ( in_array( 'title', $fields ) ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php
				cm_the_title(
					get_the_title(),
					$title_tag
				);
				?>
			</a>
			<?php endif; ?>
			<?php if ( in_array( 'summary', $fields ) ) : ?>
			<div class="cm summary">
				<?php the_excerpt(); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
