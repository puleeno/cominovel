<?php
$current_parent_id = $post->post_parent;
?>
<select name="post_parent" id="post_parent" class="widefat">
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
