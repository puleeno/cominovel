<?php
class Cominovel_Meta_Box_Comic_Data {


	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'register_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_cominovel_data' ), 10, 2 );
		add_action( 'save_post', array( $this, 'link_builtin_taxonomy_term_to_post_type' ), 10, 2 );
		add_action( 'delete_post', array( $this, 'delete_builtin_links' ) );
	}

	public function register_meta_box( $post_type ) {
		add_meta_box(
			'cominovel-main-info',
			'Cominovel',
			array( $this, 'render' ),
			Cominovel_Post_Types::get_allowed_post_types(),
			'advanced',
			'high'
		);

		add_meta_box(
			'cominovel-cloud-storage',
			__( 'Cloud Storages', 'cominovel' ),
			array( $this, 'cloud_storage' ),
			Cominovel_Post_Types::get_allowed_post_types(),
			'side'
		);
	}

	public function render() {
		cominovel_core_template( 'metaboxes/cominovel', [], 'admin' );
	}

	public function cloud_storage() {
	}

	public function save_cominovel_data( $post_id, $post ) {
		if ( empty( $_POST['cominovel_loaded'] ) ) {
			// This code is tricker to check cominovel data is loaded via Javascript
			return;
		}
		$basic_fields = apply_filters(
			'cominovel_main_meta_basic_fields',
			array(
				'alternative_name',
				'rating_system',
			)
		);
		foreach ( $basic_fields as $basic_field ) {
			if ( isset( $_POST[ $basic_field ] ) ) {
				$data = $_POST[ $basic_field ];
				if ( $data !== '' ) {
					update_post_meta( $post_id, Cominovel::create_meta_key( $basic_field ), $data );
				} else {
					delete_post_meta( $post_id, Cominovel::create_meta_key( $basic_field ) );
				}
			}
			do_action( "cominovel_save_meta_{$basic_field}_data", $basic_field, $_POST, $post_id, $post );
		}
	}

	protected function get_builtin_taxonomy_post_types() {
		return apply_filters(
			'cominovel_link_builtin_taxonomy_terms_to_post_types',
			array(
				'author' => 'cm_author',
				'artist' => 'cm_artist',
				'comic'  => 'tax_comic',
				'novel'  => 'tax_novel',
			)
		);
	}

	public function link_builtin_taxonomy_term_to_post_type( $post_id, $post ) {
		$built_in_taxonomies = $this->get_builtin_taxonomy_post_types();
		$post_type           = $post->post_type;
		if ( ! in_array( $post_type, array_keys( $built_in_taxonomies ) ) ) {
			return;
		}
		$taxonomy = $built_in_taxonomies[ $post_type ];
		$meta_key = sprintf( '_%s_link_to_%s', $post_type, $taxonomy );
		$exists   = get_post_meta( $post_id, $meta_key, true );
		if ( $exists != '' ) {
			$term = get_term( $exists, $taxonomy );
			if ( $term->name !== $post->post_title ) {
				wp_update_term(
					$exists,
					$taxonomy,
					array(
						'name' => $post->post_title,
					)
				);
			}
			return;
		}
		$term = wp_insert_term( $post->post_title, $taxonomy );
		if ( ! is_wp_error( $term ) ) {
			$meta_value = $term['term_id'];
		} elseif ( isset( $term->error_data['term_exists'] ) ) {
			$meta_value = $term->error_data['term_exists'];
		}
		if ( $meta_value ) {
			update_post_meta( $post_id, $meta_key, $meta_value );
		}
	}

	public function delete_builtin_links( $post_id ) {
		$post_type           = get_post_type( $post_id );
		$built_in_taxonomies = $this->get_builtin_taxonomy_post_types();
		$taxonomy            = $built_in_taxonomies[ $post_type ];
		$meta_key            = sprintf( '_%s_link_to_%s', $post_type, $taxonomy );
		delete_post_meta( $post_id, $meta_key );
	}
}

new Cominovel_Meta_Box_Comic_Data();
