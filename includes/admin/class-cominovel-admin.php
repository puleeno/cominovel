<?php
class RPM_Admin {
	protected $screen;

	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );

		add_filter( 'pre_get_posts', array( $this, 'filter_comics' ) );
		add_filter( 'wp_count_posts', array( $this, 'count_posts' ), 10, 3 );
	}

	public function includes() {
		require_once dirname( __FILE__ ) . '/class-rpm-admin-post-types.php';
		require_once dirname( __FILE__ ) . '/class-rpm-admin-menus.php';
		require_once dirname( __FILE__ ) . '/class-rpm-admin-assets.php';
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
		$cache_key = 'ramphor_managa_posts_count';
		$counts    = wp_cache_get( $cache_key, 'counts' );
		if ( false !== $counts ) {
			/** This filter is documented in wp-includes/post.php */
			return apply_filters( 'ramphor_managa_posts_count', $counts, $type, $perm );
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

		$query = apply_filters( 'cominovel_count_managa_posts_query', $query, $counts, $type, $perm );

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

return new RPM_Admin();
