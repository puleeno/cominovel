<?php

class Cominovel_Shortcodes {

	public function __construct() {
		add_shortcode( 'cominovel', array( $this, 'register_shortcode' ) );
	}

	public function register_shortcode() {
	}
}

new Cominovel_Shortcodes();
