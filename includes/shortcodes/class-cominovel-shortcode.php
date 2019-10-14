<?php

class Cominovel_Shortcode {
	protected static $instance;

	public static function register() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		self::$instance->load_shortcodes();
	}

	public function __construct() {
		$this->include_shortcodes();
	}

	public function include_shortcodes() {
		require_once dirname(__FILE__) . '/class-cominovel-shortcode-post.php';
		require_once dirname(__FILE__) . '/class-cominovel-shortcode-genre.php';
	}

	public function load_shortcodes() {
	}
}
