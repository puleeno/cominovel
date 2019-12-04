<div class="cm item summary-layout">
	<div class="cm-inner">
		<div class="item-thumbnail">
			<div class="overlay"></div>
			<div class="cm-inner link-inner">
				<a class="item-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php cmn_post_thumbnail( $image_size ); ?>
				</a>
				<div class="bot-inf">
					<div class="block-left">
						<?php if ( in_array( 'author', $fields ) ) : ?>
							<div class="author">
								<?php cmn_the_author(); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="block-right">
						<?php if ( in_array( 'likes', $fields ) ) : ?>
							<div class="likes">
								<span class="fa fa-thumbs-up"></span>
								<?php cmn_the_likes(); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="cm-main">
			<?php if ( in_array( 'title', $fields ) ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php
				cmn_the_title(
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
