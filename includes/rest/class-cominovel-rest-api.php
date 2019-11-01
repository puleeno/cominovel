<?php
class Cominovel_Rest_Api {
	const ENDPOINT_NAMESPACE  = 'cominovel/v1';
	const ENDPOINT_COMIC_INFO = '/comic';
	const ENDPOINT_NOVEL_INFO = '/novel';


	public function __construct() {
		$this->includes();

		add_action( 'rest_api_init', array( $this, 'register_new_endpoint' ) );
	}

	public function includes() {
		require_once dirname( __FILE__ ) . '/class-cominovel-rest-data.php';
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

		new Cominovel_Rest_Data();
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
		$messages_config  = require dirname( __FILE__ ) . '/configs/react-app-messages.php';
		$json             = sprintf(
			'window.Cominovel = window.Cominovel || {};%1$s'
				. 'window.Cominovel.languages = %2$s;%1$s'
				. 'window.Cominovel.messages = %3$s',
			"\n",
			json_encode( $languages_config ),
			json_encode( $messages_config )
		);

		header( 'Content-Type: text/javascript' );
		die( $json );
	}
}

new Cominovel_Rest_Api();
