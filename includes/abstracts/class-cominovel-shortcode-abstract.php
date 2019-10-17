<?php
abstract class Cominovel_Shortcode_Abstract {
	protected $attributes;
	protected $content;
	protected $accepted_attributes = array(
		'type'   => 'post',
		'layout' => 'default',
		'num'    => 10,
	);

	public function __construct( $attributes, $content ) {
		$this->content = $content;
		$this->fitter_attributes( $attributes );
	}

	protected function fitter_attributes( $attributes ) {
		$this->attributes = shortcode_atts(
			$this->accepted_attributes,
			$attributes
		);
	}

	abstract public function render();
}
