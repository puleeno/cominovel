<?php
/**
 * The Cominovel shortcode with style look like Madara theme
 */

 class Cominovel_Shortcode_Madara extends Cominovel_Shortcode_Post {

	protected $accepted_attributes = array(
		'fields'        => 'title,author,likes',
		'layout'        => 'madara',
		'items_per_row' => 5,
		'num'           => 10,
	);

	public function render() {
		$post_type = $this->get_post_type();
		$layout    = array_get( $this->attributes, 'layout', 'default' );

		$wp_query = new WP_Query(
			array(
				'post_type'      => $post_type,
				'posts_per_page' => $this->get_posts_per_page(),
			)
		);

		$ui = new Cominovel_Layout( $wp_query, $this->attributes );
		$ui->render();
	}
}
