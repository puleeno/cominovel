<?php

class Cominovel_Rest_Data {


	public function __construct() {
		$this->register_endpoint();
	}

	public function register_endpoint() {
		register_rest_route(
			Cominovel_Rest_Api::ENDPOINT_NAMESPACE,
			Cominovel_Rest_Api::ENDPOINT_COMIC_INFO . '/(?P<id>\d+)',
			array(
				'method'   => 'GET',
				'callback' => array( $this, 'get_comic' ),
			)
		);
		register_rest_route(
			Cominovel_Rest_Api::ENDPOINT_NAMESPACE,
			Cominovel_Rest_Api::ENDPOINT_NOVEL_INFO . '/(?P<id>\d+)',
			array(
				'method'   => 'GET',
				'callback' => array( $this, 'get_novel' ),
			)
		);
	}

	public function get_comic( WP_REST_Request $request ) {
		$comic = new Cominovel_Comic( $request->get_param( 'id' ) );
		$comic->load_data();

		$response = new WP_REST_Response( $comic->data );
		return $response;
	}
	public function get_novel( WP_REST_Request $request ) {
		$novel = new Cominovel_Novel( $request->get_param( 'id' ) );
		$novel->load_data();

		$response = new WP_REST_Response( $novel->data );
		return $response;
	}
}
