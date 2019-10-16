<?php
abstract class Cominovel_Shortcode_Abstract {
	protected $attributes;
	protected $content;

	public function __construct( $attributes, $content ) {
		$this->attributes = $attributes;
		$this->content    = $content;
	}

	abstract public function render();
}
