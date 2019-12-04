<div class="cm item rank-layout">
	<div class="cm-inner">
		<div class="item-thumbnail">
			<a class="item-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<div class="overlay"></div>
				<div class="link-inner">
					<?php cmn_post_thumbnail( $image_size ); ?>
				</div>
			</a>
		</div>

		<div class="item-info">
			<p class="rank"><svg width="66px" height="22px" viewBox="0 0 66 22" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon" data-v-29247e3f=""><desc data-v-29247e3f="">Created with Sketch.</desc> <g id="三大榜单排名1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" data-v-29247e3f=""><rect id="Rectangle" fill="#FFD806" x="0" y="0" width="66" height="22" rx="4" data-v-29247e3f=""></rect> <text id="TOP.1" font-family="DINPro-Black, DINPro" font-size="16" font-weight="700" fill="#442509" data-v-29247e3f=""><tspan x="12" y="17" data-v-29247e3f="">TOP.1</tspan></text></g></svg> <svg width="9px" height="12px" viewBox="0 0 9 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="changeIcon" data-v-78bb5cd0=""><desc data-v-78bb5cd0="">Created with Sketch.</desc> <g id="三大榜单排名上升" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" data-v-78bb5cd0=""><g id="Group-25" stroke="#F56C6C" data-v-78bb5cd0=""><g id="Group-11" data-v-78bb5cd0=""><g transform="translate(1.000000, 1.000000)" data-v-78bb5cd0=""><polyline id="Path-3" stroke-width="1.5" stroke-linejoin="round" points="0.00494025735 3.52274816 3.49923706 0 6.99494485 3.52274816" data-v-78bb5cd0=""></polyline> <path id="Path-4" d="M3.5,1 L3.5,9.53185237" stroke-width="1.5" data-v-78bb5cd0=""></path></g></g></g></g></svg> <svg width="9px" height="12px" viewBox="0 0 9 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="changeIcon" style="display:none;" data-v-662647ca=""><desc data-v-662647ca="">Created with Sketch.</desc> <g id="三大榜单排名下降" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" data-v-662647ca=""><g id="Group" data-v-662647ca=""><g id="Group-25" transform="translate(1.000000, 1.000000)" stroke="#1EAB50" stroke-linecap="round" stroke-width="1.5" data-v-662647ca=""><g id="Group-11-Copy-3" transform="translate(3.500000, 5.000000) scale(1, -1) translate(-3.500000, -5.000000) " data-v-662647ca=""><g id="Group-11" data-v-662647ca=""><polyline id="Path-3" stroke-linejoin="round" points="0.00494025735 3.52274816 3.49923706 0 6.99494485 3.52274816" data-v-662647ca=""></polyline> <path id="Path-4" d="M3.5,1 L3.5,9.53185237" data-v-662647ca=""></path></g></g></g> <rect id="Rectangle" x="0" y="0" width="9" height="12" data-v-662647ca=""></rect></g></g></svg> <svg width="8px" height="2px" viewBox="0 0 8 2" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="changeIcon nochange" style="display:none;" data-v-751ed3e0=""><desc data-v-751ed3e0="">Created with Sketch.</desc> <g id="三大榜单排名无变化" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" data-v-751ed3e0=""><rect id="Rectangle" fill="#B8B8B8" x="0" y="0" width="8" height="2" rx="1" data-v-751ed3e0=""></rect></g></svg> <span class="change">
			  新晋黑马
			</span></p>

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

			<?php if ( in_array( 'author', $fields ) ) : ?>
				<div class="item-author">
					<?php cmn_the_author(); ?>
				</div>
			<?php endif; ?>

			<?php if ( in_array( 'description', $fields ) ) : ?>
				<div class="item-description">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; ?>

			<?php if ( in_array( 'summary', $fields ) ) : ?>
			<div class="item-summary">
				<?php the_excerpt(); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
