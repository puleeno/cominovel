<?php

class Cominovel_Rest_Data {
	const SEASON_META = '_cominovel_seasons';

	public function __construct() {
		$this->register_endpoint();
	}

	public function register_endpoint() {
		register_rest_route(
			Cominovel_Rest_Api::NAMESPACE,
			Cominovel_Rest_Api::ENDPOINT_COMIC_INFO . '/(?P<id>\d+)',
			array(
				'methods'  => 'GET',
				'callback' => array( $this, 'get_comic' ),
			)
		);
		register_rest_route(
			Cominovel_Rest_Api::NAMESPACE,
			Cominovel_Rest_Api::ENDPOINT_NOVEL_INFO . '/(?P<id>\d+)',
			array(
				'methods'  => 'GET',
				'callback' => array( $this, 'get_novel' ),
			)
		);
		register_rest_route(
			Cominovel_Rest_Api::NAMESPACE,
			'/seasons',
			array(
				'methods'  => array( 'GET', 'PUT' ),
				'callback' => array( $this, 'season_manage' ),
			),
			true
		);
		register_rest_route(
			Cominovel_Rest_Api::NAMESPACE,
			'/chapter/parent',
			array(
				'methods'  => 'PUT',
				'callback' => array( $this, 'update_parent' ),
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

	public function season_manage( WP_REST_Request $request ) {
		$post_id = $request->get_param( 'post_id' );
		if ( 'GET' === $request->get_method() ) {
			$seasons = [];
			if ( ! empty( $post_id ) ) {
				$seasons = Cominovel_Db_Query::query_seasons( $post_id );
			}

			$response = new WP_REST_Response( $seasons );
			return $response;
		}

		if ( 'PUT' === $request->get_method() ) {
			if ( empty( $post_id ) ) {
				$response = new WP_Error( 'Post ID must be set the value' );
				return new WP_REST_Response( $response );
			}

			$seasons = $request->get_param( 'seasons' );
			foreach ( $seasons  as $meta_id => $season ) {
				if ( empty( $meta_id ) || empty( $db_season = Cominovel_Db_Query::query_seasons( $post_id, $meta_id ) ) ) {
					add_post_meta( $post_id, self::SEASON_META, $season, true );
				} else {
					update_post_meta( $post_id, self::SEASON_META, $season, $db_season->meta_value );
				}
			}
		}
	}

	public function update_parent( WP_REST_Request $request ) {
		parse_str( $request->get_body(), $body );
		$post_id = array_get( $body, 'chapter_id' );
		$post    = get_post( $post_id );
		if ( empty( $post ) || 'chapter' !== $post->post_type ) {
			return;
		}

		$postarr = array(
			'ID'          => $post->ID,
			'post_parent' => array_get( $body, 'parent' ),
		);
		wp_update_post( $postarr, $wp_error );

		if ( is_wp_error( $wp_error ) ) {
			wp_send_json_error( $wp_error );
		}
		wp_send_json_success();
	}
}
