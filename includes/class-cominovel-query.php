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
		if ( $post->post_type !== 'chapter' || in_array($post->post_status, array('auto-draft')) ) {
			return $permalink;
		}
		$permalink = get_the_permalink( $post->post_parent );
		return sprintf( '%s/%s', rtrim( $permalink, '/' ), $post->post_name );
	}

	public function parse_chapter_query( $posts, $query ) {
		$this->isChapter = (
			isset( $query->query['comic'] ) && false !== strpos( $query->query['comic'], '/' )
		);
		if ( $this->isChapter ) {
			list($comic, $chapter) = explode( '/', $query->query['name'] );
			$parents               = get_posts(
				array(
					'post_type'   => $query->get( 'post_type' ),
					'name'        => $comic,
					'post_parent' => 0,
				)
			);
			return get_posts(
				array(
					'post_type'   => 'chapter',
					'name'        => $chapter,
					'post_parent' => $parents,
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
