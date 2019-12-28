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
			array_combine_args(
				apply_filters(
					'cominvel_default_shortcode_attributes',
					$this->default_attributes(),
				),
				$this->accepted_attributes
			),
			$attributes
		);
	}

	public function default_attributes() {
		return array(
			'image_size'    => 'thumbnail',
			'layout'        => 'default',
			'content_style' => 'dark-content',
			'num'           => 10,
			'post_type'     => 'comic',
			'title'         => '',
			'type'          => 'post',
			'title_tag'     => 'h3',
		);
	}

	public function get_post_type() {
		return array_trim(
			explode( ',', $this->attributes['post_type'] )
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
