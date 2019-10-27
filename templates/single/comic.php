<div class="cominovel-breadcumb">
	<?php echo $breadcrumb; ?>
</div>
<div class="cm-featured">
	<div class="cm-block-inner">
		<div class="cm-main-image">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="cm-block-features">
			<h1 class="cm-title cm-comic-name"><?php the_title(); ?></h1>
			<?php do_action( 'cominovel_after_comic_name' ); ?>
			<?php if ( true ) : ?>
			<div class="author">
				<a href="<?php cominovel_echo( $comic->author->link ); ?>" title="<?php cominovel_echo( $comic->author->name ); ?>">
					<?php cominovel_echo( '偶得女' ); ?>
				</a>
			</div>
			<?php endif; ?>
			<div class="cm-short-description">
				<?php the_excerpt(); ?>
			</div>
			<div class="cm-actions">
				<div class="cm-block-inner">
					<div class="cm-user-actions">
					<?php if ( $first_chapter ) : ?>
						<a class="btn btn-primary" href="<?php the_permalink( $first_chapter ); ?>">
							<?php _e( 'Read', 'comnovel' ); ?>
						</a>
					<?php endif; ?>
						<a class="btn btn-default" href="<?php cominovel_echo( $comic->follow_url() ); ?>">
							<?php _e( 'Follow', 'comnovel' ); ?>
						</a>
					</div>

					<div class="cm-statistics">
						<div class="cm-shares">
							<span class="fa fa-share"></span>
							<?php _e( 'Share', 'cominovel' ); ?>
						</div>
						<div class="cm-popular">
							<span class="fa fa-fire"></span>
							12B
						</div>
						<div class="cm-likes">
							<span class="fa fa-thumbs-up"></span>
							99M
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<?php if ( $comic->has_content() ) : ?>
<div class="cm-summary">
	<h3 class="summary-heading"><?php _e( 'Summary', 'cominovel' ); ?></h3>
	<div class="cm-summary-content">
		<?php the_content(); ?>
	</div>
</div>
<?php endif; ?>

<?php if ( ! $is_oneshot ) : ?>
<div class="cm-single-content
	<?php
	if ( $has_sidebar ) {
		echo ' has-sidebar';
	}
	?>
">
	<?php do_action( 'cominovel_before_chapter_list' ); ?>
	<div class="<?php echo $has_sidebar ? 'cm-block-inner' : 'cm-inner'; ?>">
		<div class="cm-chapter-list">
		<?php
		global $post;
		foreach ( $comic->chapters as $index => $post ) {
			do_action( 'cominovel_before_comic_loop_chapter', $post, $index );

			setup_postdata( $post );
			$chapter = Cominovel_Chapter::load_basic_info( $post );
			cominovel_template( 'loop/chapter', compact( 'chapter' ) );

			do_action( 'cominovel_after_comic_loop_chapter', $post, $index );
		}
			wp_reset_postdata();
		?>
		</div>
		<?php if ( $has_sidebar ) : ?>
			<div class="cominovel-sidebar"><?php dynamic_sidebar( 'cominovel_single' ); ?></div>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div>
</div>
	<?php
else :
	do_action( 'cominovel_oneshot_comic_content', $comic );
endif;
?>

<?php comments_template(); ?>
