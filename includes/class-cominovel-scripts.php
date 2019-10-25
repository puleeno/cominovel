<?php

class Cominovel_Scripts {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
	}

	public function register_scripts() {
		wp_register_style( Cominovel::NAME, cominovel_asset_url( 'css/cominovel.css' ), array(), Cominovel::VERSION );

		wp_enqueue_style( Cominovel::NAME );
	}
}

new Cominovel_Scripts();
