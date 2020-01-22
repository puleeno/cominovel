<?php
$current_parent_id = $post->post_parent;
?>
<p>
	<label for="post_parent"><?php echo $post_type->labels->singular_name; ?>:</label>

	<select name="post_parent" id="post_parent" class="widefat" required>
		<option value="">Không chọn</option>
		<?php foreach ( $posts as $post ) : ?>
		<option
			value="<?php echo $post->ID; ?>"
			<?php
			if ( $current_parent_id == $post->ID ) {
				echo 'selected';
			}
			?>
		><?php echo $post->post_title; ?></option>
		<?php endforeach; ?>
	</select>
</p>

<p id="cominovel-seasons">
	<?php if ( ! empty( $seasons ) ) : ?>
		<label for="cominovel-seasons"><?php _e( 'Seasons:', 'cominovel' ); ?></label>
		<select name="cominovel_seasons" id="cominovel-seasons" class="widefat">
			<?php foreach ( $seasons as $season ) : ?>
			<option <?php selected( $choosed_season, $season->meta_id ); ?> value="<?php echo $season->meta_id; ?>"><?php echo $season->meta_value; ?></option>
			<?php endforeach; ?>
		</select>
	<?php endif; ?>
</p>
