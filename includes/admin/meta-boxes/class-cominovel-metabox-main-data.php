<?php
class Cominovel_Meta_Box_Comic_Data {


	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'register_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_cominovel_data' ), 10, 2 );
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
}
new Cominovel_Meta_Box_Comic_Data();
