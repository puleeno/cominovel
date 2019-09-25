<?php
class Cominovel_Admin {
	protected $screen;

	public function __construct() {
		$this->includes();
		$this->init_admin_hooks();
	}

	public function includes() {
		require_once dirname( __FILE__ ) . '/class-cominovel-admin-post-types.php';
		require_once dirname( __FILE__ ) . '/class-cominovel-admin-setting-page.php';
		require_once dirname( __FILE__ ) . '/class-cominovel-admin-menus.php';
		require_once dirname( __FILE__ ) . '/class-cominovel-admin-assets.php';
		require_once dirname( __FILE__ ) . '/wp-tables/class-cominoval-admin-wp-tables.php';

		/**
		 * Load Cominovel Settings
		 */
		require_once dirname( __FILE__ ) . '/settings/class-cominovel-admin-setting-storage.php';
	}

	public function init_admin_hooks() {
		add_filter( 'admin_url', array( $this, 'add_chapter_parent_data_type' ), 10, 2 );
		add_filter( 'pre_get_posts', array( $this, 'filter_comics' ) );
		add_filter( 'wp_count_posts', array( $this, 'count_posts' ), 10, 3 );
	}

	public function add_chapter_parent_data_type( $url, $path ) {
		if ( $path !== 'post-new.php?post_type=chapter' ) {
			return $url;
		}
		$allowed_post_types = Cominovel_Post_Types::get_allowed_post_types();
		$post_type          = empty( $_GET['data_type'] ) ? 'comic' : $_GET['data_type'];
		$data_type          = sprintf(
			'&data_type=%s',
			in_array( $post_type, $allowed_post_types ) ? $post_type : array_shift( $allowed_post_types )
		);
		return admin_url( sprintf( '%s%s', $path, $data_type ) );
	}

	public function filter_comics( $query ) {
		if ( $query->get( 'post_type' ) != 'comic' ) {
			return $query;
		}
		$query->set( 'post_parent', 0 );
		return $query;
	}

	public function count_posts( $counts, $type, $perm ) {
		global $wpdb;

		if ( $type !== 'comic' ) {
			return $counts;
		}
		$cache_key = 'cominovel_posts_count';
		$counts    = wp_cache_get( $cache_key, 'counts' );
		if ( false !== $counts ) {
			/** This filter is documented in wp-includes/post.php */
			return apply_filters( 'cominovel_posts_count', $counts, $type, $perm );
		}

		$query = "SELECT post_status, COUNT( * ) AS num_posts FROM {$wpdb->posts} WHERE post_type = %s AND post_parent = %d";
		if ( 'readable' == $perm && is_user_logged_in() ) {
			$post_type_object = get_post_type_object( $type );
			if ( ! current_user_can( $post_type_object->cap->read_private_posts ) ) {
				$query .= $wpdb->prepare(
					" AND (post_status != 'private' OR ( post_author = %d AND post_status = 'private' ))",
					get_current_user_id()
				);
			}
		}
		$query .= ' GROUP BY post_status';

		$query = apply_filters( 'cominovel_count_comic_posts_query', $query, $counts, $type, $perm );

		$results = (array) $wpdb->get_results( $wpdb->prepare( $query, $type, 0 ), ARRAY_A );
		$counts  = array_fill_keys( get_post_stati(), 0 );

		foreach ( $results as $row ) {
			$counts[ $row['post_status'] ] = $row['num_posts'];
		}

		$counts = (object) $counts;
		wp_cache_set( $cache_key, $counts, 'counts' );

		return $counts;
	}
}

return new Cominovel_Admin();
