<?php

class Cominovel_Admin_Meta_Boxes {



	public function __construct() {
		$this->include_meta_boxes();
		$this->init_hooks();
	}

	public function include_meta_boxes() {
		require_once dirname( __FILE__ ) . '/meta-boxes/class-cominovel-metabox-main-data.php';
		require_once dirname( __FILE__ ) . '/meta-boxes/class-cominovel-metabox-chapter-data.php';
	}

	public function init_hooks() {
		add_action( 'add_meta_boxes', array( $this, 'rename_meta_boxes' ), 20 );
		add_action( 'add_meta_boxes', array( $this, 'remove_meta_boxes' ), 30 );
	}

	public function remove_meta_boxes( $screen ) {
		remove_meta_box( 'postexcerpt', Cominovel_Post_Types::get_allowed_post_types(), 'normal' );
		remove_meta_box( 'genrediv', Cominovel_Post_Types::get_allowed_post_types(), 'side' );
		remove_meta_box( 'tagsdiv-release', Cominovel_Post_Types::get_allowed_post_types(), 'side' );
		if ( $screen === 'chapter' ) {
			remove_meta_box( 'edit-slug-box', $screen, 'advanced' );
		}
	}

	public function rename_meta_boxes() {
	}
}

return new Cominovel_Admin_Meta_Boxes();
