<?php
abstract class Cominovel_Shortcode_Abstract {
	protected $attributes;
	protected $content;
	protected $accepted_attributes;
	protected $default_attributes = array(
		'image_size' => 'thumbnail',
		'layout'     => 'default',
		'num'        => 10,
		'post_type'  => 'comic',
		'title'      => '',
		'type'       => 'post',
	);

	public function __construct( $attributes, $content ) {
		$this->content = $content;
		$this->fitter_attributes( $attributes );
	}

	protected function fitter_attributes( $attributes ) {
		$this->attributes = shortcode_atts(
			wp_parse_args(
				$this->accepted_attributes,
				apply_filters(
					'cominvel_default_shortcode_attributes',
					$this->default_attributes,
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
