<?php

abstract class Cominovel_Data {

	public $ID;
	public $data = array();

	protected $post;
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
		if ( $this->post ) {
			$this->set( 'post_type', $this->post->post_type );
			$this->set( 'parent', (int) $this->post->post_parent );
		}
		$this->autoload_data( $autoload );
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

	public function sort_the_chapters( $orderby, $query ) {
		if ( $query->get( 'orderby' ) != 'title_number' ) {
			return $orderby;
		}
		return $orderby;
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

	public function load_chapters() {
		$chapters = false;
		if ( $this->post && $this->post->post_parent === 0 ) {
			$chapters = apply_filters( 'cominovel_pre_load_chapters', $chapters, $this );
			if ( empty( $chapters ) ) {
				$args     = array(
					'post_type'      => 'chapter',
					'post_parent'    => $this->ID,
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'orderby'        => 'date',
					'order'          => 'DESC',
				);
				$wp_query = new WP_Query( apply_filters( 'cominovel_load_chapters_args', $args, $this ) );
			}
		}
		$this->set( 'chapters', apply_filters( 'cominovel_load_chapters', $wp_query ) );
	}

	public function load_author() {
		$author = new Cominovel_Author( $this->cmn_author_terms );
		$this->set( 'author', $author );
	}

	public function get_first_chapter_id() {
		if ( isset( $this->raw_data['first_chapter_id'] ) && $this->raw_data['first_chapter_id'] > 0 ) {
			return $this->raw_data['first_chapter_id'];
		}
		return array_get( $this->chapters, 0, 0 );
	}

	public function get_latest_chapters( $num = 3 ) {
	}

	public function follow_url() {
	}

	public function load_statistics() {
		$this->set( 'likes', 999 );
		$this->set( 'read', 10000 );
	}

	public function has_content() {
		return ! empty( $this->data['content'] ) || ! empty( $this->post->post_content );
	}

	public function is_oneshot() {
		return false;
	}

	public function load_data( $initData = false ) {
		$this->parse_data_from_post();
		$this->load_custom_data();
		$this->load_taxonomies_data();

		if ( $initData ) {
			$this->load_author();
		}
	}

	public function parse_data_from_post() {
		$public_keys = apply_filters(
			'cominovel_public_post_keys',
			array(
				'ID',
				'post_type',
				'post_parent',
				'post_status',
				'post_name',
				'post_title',
				'post_content',
				'post_excerpt',
				'post_modified',
			)
		);
		foreach ( $public_keys as $public_key ) {
			$this->set( $public_key, $this->post->$public_key );
		}
	}

	public function load_custom_data() {
		$custom_keys = apply_filters(
			'cominovel_custom_data_keys',
			array(
				'alternative_name',
				'short_description',
				'season',
				'adult',
				'badge',
				'rating_system',
			)
		);
		foreach ( $custom_keys as $custom_key ) {
			$data = array_get( $this->raw_data, Cominovel::create_meta_key( $custom_key ), '' );
			if ( gettype( $data ) === 'array' ) {
				$data = array_shift( $data );
			}
			$this->set( $custom_key, $data );
		}
	}

	protected function changeKeyTermIdToId( $terms ) {
		$new_terms = [];
		foreach ( $terms as $term ) {
			$new_term       = (array) $term;
			$new_term['id'] = $new_term['term_id'];
			unset( $new_term['term_id'] );
			$new_terms[] = $new_term;
		}
		unset( $term, $terms, $new_term );
		return $new_terms;
	}

	public function load_taxonomies_data() {
		$default_taxonomies = array( 'genre', 'cmn_status', 'cmn_country', 'cmn_artist', 'cmn_author', 'cmn_release' );
		$custom_taxonomies  = apply_filters( 'cominovel_load_custom_taxomies', array() );
		foreach ( array_merge( $default_taxonomies, $custom_taxonomies ) as $taxonomy ) {
			$this->set(
				"{$taxonomy}_terms",
				$this->changeKeyTermIdToId(
					wp_get_post_terms( $this->data['ID'], $taxonomy )
				)
			);
		}
	}

	public function author() {
	}
}
