<?php
class Cominovel_Shortcode_Popular extends Cominovel_Shortcode_Post {
	protected $accepted_attributes = array(
		'layout'        => 'summary',
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
		if ( $wp_query->have_posts() ) {
			cominovel_template(
				'loop/start',
				array(
					'items'     => array_get( $this->attributes, 'items_per_row' ),
					'post_type' => $post_type,
					'layout'    => $layout,
				)
			);
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				$post = $wp_query->post;
				cominovel_template(
					'loop/item-' . $layout,
					array(
						'item' => $post->post_type === 'comic'
							? new Cominovel_Comic( $post )
							: new Cominovel_Novel( $post ),
					)
				);
			}
			wp_reset_query();
			cominovel_template( 'loop/end' );
		} else {
			cominovel_template( 'loop/no-content' );
		}
	}
}
