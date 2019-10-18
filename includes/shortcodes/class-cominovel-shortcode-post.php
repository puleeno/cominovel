<?php
class Cominovel_Shortcode_Post extends Cominovel_Shortcode_Abstract {
	protected $default_attributes = array(
		'fields'    => 'title,author,summary,likes,thumbnail,new_chapter,rating,badge',
		'layout'    => 'default',
		'num'       => 10,
		'post_type' => 'comic',
		'title'     => '',
		'type'      => 'post',
	);

	public function render() {
	}
}
