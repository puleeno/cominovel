<?php
class Cominovel_Deploy_React_App {
	public function __construct() {
		$this->clean_old_file();
		$this->copy_new_files();
		$this->export_asset_configs();
		$this->clean_build_folder();
	}

	public function clean_old_file() {
	}

	public function copy_new_files() {
	}

	public function export_asset_configs() {
	}

	public function clean_build_folder() {
	}
}

new Cominovel_Deploy_React_App();
