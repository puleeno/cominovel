<?php
class Cominovel_Chapter extends Cominovel_Data {
	protected $prev_chapter;
	protected $next_chapter;

	public function __construct( $chapter = null ) {
		parent::__construct( $chapter );
		$this->load_parent_data();
	}

	public static function load_basic_info( $chapter ) {
		$chapter = new self( $chapter, false );
		$chapter->load_statistics();

		return $chapter;
	}

	/**
	 * The method don't support on chapter
	 */
	final public function load_chapters() {
		throw new \Exception( 'The chapter don\'t support Cominovel_Chapter::load_chapters() method' );
	}

	protected function load_parent_data() {
		if ( empty( $this->ID ) ) {
			return;
		}
		$this->set( 'parent_type', get_post_type( $this->post->post_parent ) );
		if ( $this->parent_type === 'comic' ) {
			$this->load_comic_chapter();
		} elseif ( get_post_type( $this->post->post_parent ) === 'novel' ) {
			$this->load_novel_chapter();
		}
	}

	public function load_chapter_images() {
		$image_cache_key = sprintf( 'cominovel_chapter_%d_images', $this->ID );
		$images          = get_transient( $image_cache_key );
		if ( empty( $images ) ) {
			$image_ids = get_post_meta( $this->ID, 'cominovel_chapter_images', true );
			$images    = array();
			foreach ( (array) $image_ids as $image_id ) {
				$image = array(
					'ID'    => $image_id,
					'image' => wp_get_attachment_image( $image_id, 'full' ),
				);

				array_push( $images, $image );
			}
			set_transient( $image_cache_key, $images, 12 * HOUR_IN_SECONDS );
		}

		$this->set( 'chapter_images', $images );
	}

	public function load_comic_chapter() {
		$this->load_chapter_images();
	}

	public function load_novel_chapter() {
	}

	public function get_next_chapter() {
		if ( empty( $this->next_chapter ) ) {
			return false;
		}
		return [
			'id'   => $this->next_chapter->ID,
			'url'  => get_the_permalink( $this->next_chapter ),
			'name' => $this->next_chapter->post_name,
		];
	}

	public function get_previous_chapter() {
		if ( empty( $this->prev_chapter ) ) {
			return false;
		}
		return [
			'id'   => $this->prev_chapter->ID,
			'url'  => get_the_permalink( $this->prev_chapter ),
			'name' => $this->prev_chapter->post_name,
		];
	}

	public function created_date() {
		return get_the_date(
			get_option( 'date_format' ),
			$this->post
		);
	}

	protected function get_adjacent_post( $chapter_id, $is_previous = false, $limit = 1 ) {
		global $wpdb;
		$filter_sql = $wpdb->prepare( "SELECT post_parent from {$wpdb->posts} where ID=%s", $chapter_id );
		$date_sql   = $wpdb->prepare( "SELECT post_date from {$wpdb->posts} where ID=%s", $chapter_id );
		$operator   = $is_previous ? '<' : '>';
		$sql        = $wpdb->prepare(
			"SELECT * from {$wpdb->posts} where post_parent=({$filter_sql}) and post_type='chapter' and post_status='publish' and post_date {$operator} ({$date_sql}) and ID <> %d LIMIT %d",
			$chapter_id,
			$limit
		);

		$posts = array_map( 'get_post', $wpdb->get_results( $sql ) );
		if ( $limit > 1 ) {
			return $posts;
		}
		return array_shift( $posts );
	}

	public function load_adjacent_posts() {
		$this->prev_chapter = $this->get_adjacent_post( $this->ID, true );
		$this->next_chapter = $this->get_adjacent_post( $this->ID );
	}
}
