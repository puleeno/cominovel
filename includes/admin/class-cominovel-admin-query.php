<?php
class Cominovel_Admin_Query {

	public function __construct() {
		add_filter( 'posts_where', array( $this, 'filter_chapters' ), 10, 2 );
		add_filter( 'wp_count_posts', array( $this, 'filter_chapter_posts_count' ), 10, 3 );
		add_filter( 'posts_fields', array( $this, 'the_chapter_title' ), 10, 2 );
	}

	public function filter_chapters( $where, $query ) {
		if ( $query->query_vars['post_type'] !== 'chapter' ) {
			return $where;
		}

		global $wpdb;
		$post_type      = Cominovel_Post_Types::check_active_data_type();
		$filter_chapter = sprintf(
			'%1$s.post_parent IN(SELECT ID FROM %1$s WHERE post_type IN("%2$s"))',
			$wpdb->posts,
			$post_type,
		);
		$where          = sprintf( 'AND %s %s', $filter_chapter, $where ) . $where;

		return $where;
	}

	public function filter_chapter_posts_count( $counts, $type, $perm ) {
		if ( $type !== 'chapter' ) {
			return $counts;
		}
		global $wpdb;
		$cache_key = sprintf( '%s_chapters_count', Cominovel_Post_Types::check_active_data_type() );
		$counts    = wp_cache_get( $cache_key, 'counts' );
		if ( false !== $counts ) {
			return $counts;
		}
		$query   = "SELECT post_status, COUNT( * ) AS num_posts FROM {$wpdb->posts} WHERE post_parent IN (SELECT ID FROM {$wpdb->posts} WHERE post_type='novel') AND post_type = 'chapter' GROUP BY post_status";
		$results = (array) $wpdb->get_results( $query, ARRAY_A );
		$counts  = array_fill_keys( get_post_stati(), 0 );

		foreach ( $results as $row ) {
			$counts[ $row['post_status'] ] = $row['num_posts'];
		}

		$counts = (object) $counts;
		wp_cache_set( $cache_key, $counts, 'counts' );

		return $counts;
	}

	public function the_chapter_title( $fields, $query ) {
		if ( ! function_exists( 'get_current_screen' ) ) {
			return $fields;
		}

		$current_screen = get_current_screen();
		if ( $query->get( 'post_type' ) == 'chapter' && $current_screen->id !== 'chapter' ) {
			global $wpdb;

			$fields .= ", CONCAT((SELECT p2.post_title FROM {$wpdb->posts} p2 WHERE";
			$fields .= " p2.post_status='publish' AND p2.ID={$wpdb->posts}.post_parent LIMIT 1";
			$fields .= "), ' - ', {$wpdb->posts}.post_title) as post_title";

			return $fields;
		}
		return $fields;
	}
}

new Cominovel_Admin_Query();
