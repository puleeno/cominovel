<?php
class Cominovel_Db_Query {
	protected static $instance;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
	}

	public static function __callStatic( $name, $args ) {
		preg_match( '/^query_(\w*)/', $name, $matches );
		if ( count( $matches ) ) {
			$method   = $matches[1];
			$callback = array( self::instance(), $method );
			if ( is_callable( $callback ) ) {
				return call_user_func_array( $callback, $args );
			}
		}
	}

	public function seasons( $post_id, $season_id = 0 ) {
		global $wpdb;
		$sql = "SELECT * FROM {$wpdb->postmeta} WHERE post_id=%d AND meta_key=%s";
		if ( (int) $season_id > 0 ) {
			$sql .= ' AND meta_id=%d';
		}

		$sql = $wpdb->prepare(
			$sql,
			$post_id,
			Cominovel_Rest_Data::SEASON_META,
			$season_id
		);

		$seasons = $season_id > 0 ? $wpdb->get_row( $sql ) : $wpdb->get_results( $sql );

		return apply_filters(
			'cominovel_get_seasons',
			$seasons,
			$post_id,
			$season_id
		);
	}

	public function update_season( $season_id, $season_name ) {
		global $wpdb;
		$sql = $wpdb->prepare(
			"UPDATE {$wpdb->postmeta} SET meta_value=%s WHERE meta_id=%d AND meta_key=%s",
			$season_name,
			$season_id,
			Cominovel_Rest_Data::SEASON_META
		);

		$wpdb->query( $sql );
	}
}
