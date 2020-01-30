<?php
class Cominovel_Rest_User {
	public function __construct() {
		$this->register_endpoints();
	}

	public function register_endpoints() {
		register_rest_route(
			Cominovel_Rest_Api::NAMESPACE,
			'user/like',
			array(
				'methods'  => 'POST',
				'callback' => array(
					$this,
					'user_like_chapter',
				),
			)
		);
	}

	public function user_like_chapter( WP_REST_Request $request ) {
	}

	public function user_follow_comic( WP_REST_Request $request ) {
	}
}
