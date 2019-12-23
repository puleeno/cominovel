<?php
class Cominovel_Query {

	protected $isChapter = false;

	public function __construct() {
		add_filter( 'post_type_link', array( $this, 'custom_chapter_link' ), 30, 2 );
		$is_frontend = $this->is_frontend();
		if ( $is_frontend ) {
			add_filter( 'posts_pre_query', array( $this, 'parse_chapter_query' ), 10, 2 );
		}
	}

	public function custom_chapter_link( $permalink, $post ) {
		if ( $post->post_type !== 'chapter' || in_array( $post->post_status, array( 'auto-draft' ) ) ) {
			return $permalink;
		}
		$permalink = get_the_permalink( $post->post_parent );
		return sprintf( '%s/%s', rtrim( $permalink, '/' ), $post->post_name );
	}

	public function parse_chapter_query( $posts, $query ) {
		$this->isChapter = (
			!empty($query->query)
				&& in_array( $query->query['post_type'], array( 'comic', 'novel' ) )
				&& false !== strpos( $query->query['name'], '/' )
		);
		if ( $this->isChapter ) {
			list($comic, $chapter) = explode( '/', $query->query['name'] );
			$args                  = array(
				'post_type'   => $query->get( 'post_type' ),
				'name'        => $comic,
				'post_parent' => 0,
				'fields'      => 'ids',
			);
			$parents               = get_posts( $args );

			return get_posts(
				array(
					'post_type'       => 'chapter',
					'name'            => $chapter,
					'post_parent__in' => $parents,
				)
			);
		}
		return $posts;
	}

	protected function is_frontend() {
		return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
	}
}

new Cominovel_Query();
