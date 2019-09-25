<?php

class Cominovel_Scripts {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
	}

	public function register_scripts() {
	}
}

new Cominovel_Scripts();
