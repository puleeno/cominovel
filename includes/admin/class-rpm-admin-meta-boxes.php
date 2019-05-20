<?php

class RPM_Admin_Meta_Boxes {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'remove_meta_boxes' ), 10 );
		add_action( 'add_meta_boxes', array( $this, 'rename_meta_boxes' ), 20 );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 30 );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );
	}

	public function remove_meta_boxes() {
		remove_meta_box( 'postexcerpt', 'manga', 'normal' );
		remove_meta_box( 'tagsdiv-manga_release', 'manga', 'side' );
	}

	public function rename_meta_boxes() {
	}

	public function add_meta_boxes() {
		add_meta_box( 'ramphor-manga-data', __( 'Manga data', 'ramphor_manga' ), 'RPM_Meta_Box_Manga_Data::output', array( 'manga' ), 'advanced', 'high', );
	}

	public function save_meta_boxes( $post_id, $post ) {
	}
}

return new RPM_Admin_Meta_Boxes();
