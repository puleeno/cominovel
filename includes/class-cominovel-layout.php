<?php
class Cominovel_Layout {

	protected $query;
	protected $args;

	public function __construct( $query, $args = [] ) {
		$this->query = $query;
		$this->args  = $args;
	}

	public function render() {
		$layout    = array_get( $this->args, 'layout', 'default' );
		$post_type = array_get( $this->args, 'post_type', $this->query->get( 'post_type' ) );
		if ( is_array( $post_type ) ) {
			$post_type = implode( ' ', $post_type );
		}

		if ( $this->query->have_posts() ) {
			cominovel_template(
				'block/start-loop',
				array(
					'items'         => array_get( $this->args, 'items_per_row' ),
					'content_style' => array_get( $this->args, 'content_style' ),
					'post_type'     => $post_type,
					'layout'        => $layout,
				)
			);
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$post = $this->query->post;
				if ( apply_filters( 'cominovel_is_custom_post', false, $post, $this->query ) ) {
					do_action( 'cominovel_custom_post_loop_content', $post, $this->args, $this->query );
				} else {
					cominovel_template(
						'loop/item-' . $layout,
						array(
							'item'       => $post->post_type === 'comic'
								? new Cominovel_Comic( $post )
								: new Cominovel_Novel( $post ),
							'title_tag'  => array_get( $this->args, 'title_tag' ),
							'image_size' => array_get( $this->args, 'image_size' ),
							'fields'     => Cominovel_Shortcode_Post::parse_post_fields(
								array_get( $this->args, 'fields', '' )
							),
						)
					);
				}
			}
			echo '<div class="clearfix"></div>';
			wp_reset_query();
			cominovel_template( 'block/end-loop' );
		} else {
			cominovel_template( 'loop/no-content' );
		}
	}
}
