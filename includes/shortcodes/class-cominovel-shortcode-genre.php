<?php
class Cominovel_Shortcode_Genre extends Cominovel_Shortcode_Abstract {
	protected $accepted_attributes = array(
		'layout'        => 'summary',
		'items_per_row' => 5,
		'num'           => 10,
	);

	public function render() {
	}
}
