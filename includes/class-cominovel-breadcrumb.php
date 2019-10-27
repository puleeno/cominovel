<?php

class Cominovel_Breadcrumb {
	public function __construct() {

	}

	public function __toString() {
		ob_start();
		$this->render();
		return ob_get_clean();
	}

	public static function create() {
		return new self();
	}

	public function render() {
	}
}
