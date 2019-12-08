<?php
class Cominovel_Storage_Manager {
	public function __construct() {
		if ( is_admin() ) {
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		}
	}

	public function add_meta_box() {
		add_meta_box(
			'cominovel-storage',
			__( 'Cloud Storages', 'cominovel' ),
			array( $this, 'cloud_meta_box' ),
			array( 'comic', 'chapter' ),
			'side'
		);
	}

	public function cloud_meta_box() {
		$cloud_storages = self::get_storages();
		if ( empty( $cloud_storages ) ) {
			cominovel_core_template( 'metaboxes/no-clouds', [], 'admin' );
		} else {
			// Code cloud storage
		}
	}

	public static function get_storages() {
	}
}

new Cominovel_Storage_Manager();
