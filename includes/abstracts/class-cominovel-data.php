<?php

abstract class Cominovel_Data {
	public $ID;

	protected $post;
	protected $data     = array();
	protected $raw_data = array();

	public function __construct( $post = null, $autoload = true ) {
		if ( $post instanceof WP_Post ) {
			$this->post = $post;
			$this->ID   = $post->ID;
		} elseif ( is_numeric( $post ) ) {
			$this->ID   = $post;
			$this->post = get_post( $post );
			$this->verify_post_data( $this->post );
		} elseif ( is_array( $post ) && isset( $post['ID'] ) ) {
			$this->ID   = $post['ID'];
			$this->post = get_post( $this->ID );
			$this->verify_post_data( $this->post );
		}
		$this->autoload_data( $autoload );
	}

	public function autoload_data( $autoload ) {
		if ( $autoload ) {
			if ( $this->ID > 0 ) {
				$this->raw_data = get_post_custom( $this->ID );
			}
		}
	}

	protected function verify_post_data( $post ) {
		if ( empty( $post ) ) {
			$this->post = null;
			$this->ID   = null;
		}
	}

	public function __get( $name ) {
		if ( isset( $this->data[ $name ] ) ) {
			return $this->data[ $name ];
		}

		return __return_empty_string();
	}

	public function set( $name, $value ) {
		$this->data[ $name ] = $value;
	}

	public function load_chapters() {
		$chapters = array();
		if ( $this->post && $this->post->post_parent === 0 ) {
			$chapters = apply_filters( 'cominovel_pre_load_chapters', $chapters, $this );
			if ( empty( $chapters ) ) {
				$chapters = get_posts(
					array(
						'post_type'      => 'chapter',
						'post_parent'    => $this->ID,
						'post_status'    => 'publish',
						'posts_per_page' => -1,
					)
				);
			}
		}
		$this->set( 'chapters', apply_filters( 'cominovel_load_chapters', $chapters ) );
	}

	public function get_first_chapter_id() {
		if ( $this->raw_data['first_chapter_id'] > 0 ) {
			return $this->raw_data['first_chapter_id'];
		}
		return array_get( $this->chapters, 0, 0 );
	}

	public function get_latest_chapters($num = 3) {
	}

	public function follow_url() {
	}

	public function load_statistics() {
		$this->set( 'likes', 999 );
		$this->set( 'read', 10000 );
	}
}
