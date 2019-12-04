<div class="cm item vcard-layout">
	<div class="cm-inner">
		<div class="cm item-thumbnail">
			<div class="overlay"></div>
			<div class="cm-inner link-inner">
				<a class="cm item-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
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


<?php
// <div class="TabW184 fl  padding16"><a href="/web/topic/1749" target="_blank" class="link play ">
// <div class="imgBox"><img alt="blank"
// src="data:image/gif;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
// class="blankImg"> <img class="img"
// data-src="http://tn1-f2.kkmh.com/image/171201/wd4irlrb9.webp-fe.w360.webp.m.i1"
// src="http://tn1-f2.kkmh.com/image/171201/wd4irlrb9.webp-fe.w360.webp.m.i1" lazy="loaded">
// <!---->
// <div class="imgFooter cls"><span title="墨香铜臭（原著）+落地成球" class="author fl">墨香铜臭（原著）+落地成球</span> <span
// class="liked fr"><svg width="11px" height="12px" viewBox="0 0 11 12" version="1.1"
// xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon">
// <desc>Created with Sketch.</desc>
// <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
// stroke-linecap="round" stroke-linejoin="round">
// <g id="tag" stroke="#ffffff" transform="translate(-503.000000, -559.000000)">
// <g id="Group-Copy-5" transform="translate(504.000000, 560.000000)">
// <path id="Stroke-1"
// d="M5.95913517,2.75540789 C5.8983025,2.93455129 6.03764219,3.11990058 6.22589463,3.11990058 L7.92468796,3.11948686 C8.78703212,3.11948686 9.36781967,3.82944084 9.21573801,4.69743819 L8.63495045,8.01345284 C8.48286878,8.88103647 7.65340715,9.59099045 6.79106299,9.59099045 L1.11800577,9.59099045 C0.503102597,9.59099045 0,9.08458971 0,8.46565547 L0,4.24482184 C0,3.6258876 0.503102597,3.11948686 1.11800577,3.11948686 L2.59443104,3.11948686 C2.7555554,3.11948686 2.91010325,3.06487501 3.037112,2.9647533 C3.33469883,2.7301706 3.7983424,2.19522276 3.80204168,1.13815258 C3.80450787,0.534939937 4.26650731,0.0343313614 4.86496923,0.00288817814 L4.89168628,0.00164699985 C5.54933673,-0.0326922661 6.09847486,0.474122201 6.13464563,1.13029179 C6.16711712,1.71695539 6.09765279,2.34912887 5.95913517,2.75540789 L5.95913517,2.75540789 Z">
// </path>
// <path id="Stroke-3" d="M2,3.5 L2,8.5"></path>
// </g>
// </g>
// </g>
// </svg>
// 99万+
// </span></div>
// </div> <span class="itemTitle">魔道祖师</span>
// </a>
// <!---->
// </div>
