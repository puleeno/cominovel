<?php
class Cominovel_Meta_Box_Comic_Data {


	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'register_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_cominovel_data' ) );
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

	public function save_cominovel_data( $post_id ) {
	}
}
new Cominovel_Meta_Box_Comic_Data();
