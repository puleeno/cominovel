<?php
class Cominovel_Rest_Api {
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_new_endpoint' ) );
	}

	public function register_new_endpoint() {
		register_rest_route(
			'cominovel/v1',
			'/locale/(\w+)\.js',
			array(
				'method'   => 'GET',
				'callback' => array( $this, 'languages' ),
			)
		);
	}

	public function languages( WP_REST_Request $request ) {
		add_filter(
			'wp_headers',
			function( $headers ) {
				$headers['Content-Type'] = 'text/javascript';
				return $headers;
			}
		);

		$languages_config = require dirname( __FILE__ ) . '/configs/react-app-languages.php';
		$json             = sprintf( 'var cominovel = {languages: %s}; window.cominovel = cominovel;', json_encode( $languages_config ) );

		header( 'Content-Type: text/javascript' );
		die( $json );
	}
}

new Cominovel_Rest_Api();
