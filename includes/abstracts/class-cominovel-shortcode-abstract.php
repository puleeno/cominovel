<?php
abstract class Cominovel_Shortcode_Abstract {
	protected $attributes;
	protected $content;
	protected $accepted_attributes;

	public function __construct( $attributes, $content ) {
		$this->content = $content;
		$this->fitter_attributes( $attributes );
	}

	protected function fitter_attributes( $attributes ) {
		$this->attributes = shortcode_atts(
			wp_parse_args(
				$this->accepted_attributes,
				array(
					'type'      => 'post',
					'layout'    => 'default',
					'post_type' => 'comic',
					'title'     => '',
					'num'       => 10,
				)
			),
			$attributes
		);
	}

	public function get_post_type() {
		return array_filter(
			array_map(
				'trim',
				explode( ',', $this->attributes['post_type'] )
			),
			'strlen'
		);
	}

	public function get_posts_per_page() {
		return array_get(
			$this->attributes,
			'num',
			10
		);
	}

	abstract public function render();
}
