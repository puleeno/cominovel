<?php
class Cominoval_Admin_Wp_Table_Chapters {

	protected $current_screen;

	public function __construct() {
		add_action( 'current_screen', array( $this, 'get_current_screen' ) );
		add_filter( 'the_title', array( $this, 'add_cominovel_parent_title' ), 10, 2 );
	}

	public function get_current_screen() {
		$current_screen       = get_current_screen();
		$this->current_screen = $current_screen->id;
	}

	public function add_cominovel_parent_title( $title, $id ) {
		if ( $this->current_screen !== 'edit-chapter' ) {
			return $title;
		}
		$chapter = get_post( $id );
		$parent  = get_post( $chapter->post_parent );

		return sprintf( '%s - %s', $parent->post_title, $title );
	}
}

new Cominoval_Admin_Wp_Table_Chapters();
