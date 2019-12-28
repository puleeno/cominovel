<?php
class Cominovel_Chapter extends Cominovel_Data {

	public function __construct( $chapter = null ) {
		parent::__construct( $chapter );
		$this->load_parent_data();
	}

	public static function load_basic_info( $chapter ) {
		$chapter = new self( $chapter, false );
		$chapter->load_statistics();
		return $chapter;
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
		$image_cache_key = sprintf( 'cominovel_comic_%d_images', $this->ID );
		$images          = get_transient( $image_cache_key );
		if ( empty( $images ) ) {
			$image_ids = unserialize( array_get( $this->raw_data['cominovel_chapter_images'], 0 ) );
			$images    = array();
			foreach ( (array) $image_ids as $image_id ) {
				$image = array(
					'ID'  => $image_id,
					'url' => wp_get_attachment_url( $image_id ),
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
		return [
			'id'   => '',
			'url'  => '',
			'name' => '',
		];
	}

	public function get_previous_chapter() {
		return [
			'id'   => '',
			'url'  => '',
			'name' => '',
		];
	}
}
