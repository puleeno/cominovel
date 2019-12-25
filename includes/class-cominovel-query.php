<?php
class Cominovel_Query {
	protected $isChapter = false;
	protected $parent_type;
	protected $parent_name;

	public function __construct() {
		add_filter( 'post_type_link', array( $this, 'custom_chapter_link' ), 30, 2 );
		$is_frontend = $this->is_frontend();
		if ( $is_frontend ) {
			add_action( 'parse_query', array( $this, 'parse_chapter_query' ) );
			add_filter( 'posts_where', array( $this, 'filter_chapter_by_parent' ), 10, 2 );
		}
	}

	public function custom_chapter_link( $permalink, $post ) {
		if ( $post->post_type !== 'chapter' || in_array( $post->post_status, array( 'auto-draft' ) ) ) {
			return $permalink;
		}
		$permalink = get_the_permalink( $post->post_parent );
		return sprintf( '%s/%s', rtrim( $permalink, '/' ), $post->post_name );
	}

	public function parse_chapter_query( $wp_query ) {
		if ( is_single() && $wp_query->is_main_query() ) {
			$post_type = $wp_query->get( 'post_type' );
			if ( ! in_array( $post_type, array( 'comic', 'novel' ) ) && ! isset( $wp_query->query[ $post_type ] ) ) {
				return;
			}
			$post_slug = explode( '/', $wp_query->query[ $post_type ] );
			if ( count( $post_slug ) <= 1 ) {
				return;
			}
			$this->isChapter   = true;
			$this->parent_type = $post_type;
			$this->parent_name = $post_slug[0];
			$chapter_name      = $post_slug[1];

			$query = $wp_query->query;
			if ( isset( $query[ $post_type ] ) ) {
				unset( $query[ $post_type ] );
				$query['chapter'] = $chapter_name;
			}
			$query['post_type'] = 'chapter';
			$wp_query->query    = $query;

			$query_vars = $wp_query->query_vars;
			if ( isset( $query_vars[ $post_type ] ) ) {
				unset( $query_vars[ $post_type ] );
				$query_vars['chapter'] = $chapter_name;
			}
			$query_vars['post_type'] = 'chapter';
			$wp_query->query_vars    = $query_vars;
			$wp_query->set( 'post_type', 'chapter' );
		}
	}

	public function filter_chapter_by_parent( $where, $query ) {
		if ( ! $this->isChapter ) {
			return $where;
		}
		global $wpdb;

		$where .= " AND post_parent IN (SELECT ID FROM {$wpdb->posts} WHERE post_type='";
		$where .= $this->parent_type . "' AND post_status='publish' AND post_name='" . $this->parent_name . "')";

		return $where;
	}

	protected function is_frontend() {
		return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
	}
}

new Cominovel_Query();
