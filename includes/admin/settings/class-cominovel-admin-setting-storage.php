<?php

class Cominovel_Admin_Setting_Storage {
	protected static $instance;

	protected $output;
	protected $data;

	public static function render() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance->getOutput();
	}

	public function __construct() {
		$this->load_data();
		$this->settings();
	}

	public function __toString() {
		return $this->output;
	}

	public function load_storages() {
	}

	public function load_data() {
		$this->data = [
			'storages' => $this->load_storages(),
		];
	}

	public function settings() {
		ob_start();
		cominovel_core_template( 'admin/settings/storages', $this->data );
		$this->output = ob_get_clean();
	}

	public function getOutput() {
		echo $this->output;
	}
}

