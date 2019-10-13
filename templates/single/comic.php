<div class="cm cm-featured">
	<div class="cm cm-block-inner">
		<div class="cm cm-main-image">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="cm-block-features">
			<h1 class="cm cm-title cm-comic-name"><?php the_title(); ?></h1>
			<?php if ( $comic->author > 0 ) : ?>
			<div class="author">
				<a href="<?php cominovel_echo( $comic->author->link ); ?>" title="<?php cominovel_echo( $comic->author->name ); ?>">
					<?php cominovel_echo( $comic->author->name ); ?>
				</a>
			</div>
			<?php endif; ?>
			<div class="cm cm-short-description">
				<h3 class="cm cm-summary"><?php _e( 'Summary', 'cominovel' ); ?></h3>
				<?php the_excerpt(); ?>
			</div>
			<div class="actions">
				<div class="cm cm-block-inner">
					<div class="cm cm-user-actions">
						<a class="btn btn-primary" href="<?php the_permalink( $comic->get_first_chapter_id() ); ?>">
							<?php _e( 'Read', 'comnovel' ); ?>
						</a>
						<a class="btn btn-default" href="<?php cominovel_echo( $comic->follow_url() ); ?>">
							<?php _e( 'Follow', 'comnovel' ); ?>
						</a>
					</div>

					<div class="cm cm-statistics">
						<div class="cm cm-shares">
							<span class="fa fa-share"></span>
							<?php _e( 'Share', 'cominovel' ); ?>
						</div>
						<div class="cm cm-popular">
							<span class="fa fa-fire"></span>
							12B
						</div>
						<div class="cm cm-likes">
							<span class="fa fa-thumbs-up"></span>
							99M
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="cm cm-single-content">
	<div class="cm cm-block-inner">
		<div class="cm cm-chapter-list">
		<?php
		global $post;
		foreach ( $comic->chapters as $post ) {
			setup_postdata( $post );
			$chapter = Cominovel_Chapter::load_basic_info( $post );
			cominovel_template( 'loop/chapter', compact( 'chapter' ) );
		}
			wp_reset_postdata();
		?>
		</div>
	</div>
</div>
