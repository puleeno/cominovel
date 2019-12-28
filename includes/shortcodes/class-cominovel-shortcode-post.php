<?php
class Cominovel_Shortcode_Post extends Cominovel_Shortcode_Abstract {

	protected $default_attributes = array(
		'fields'    => 'title,author,summary,likes,badge',
		'post_type' => 'comic',
	);

	public function default_attributes() {
		return array_combine_args(
			parent::default_attributes(),
			$this->default_attributes
		);
	}

	public static function parse_post_fields( $fields ) {
		return array_trim(
			explode( ',', $fields )
		);
	}

	public function render() {
	}
}
