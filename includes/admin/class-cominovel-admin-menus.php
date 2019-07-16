<?php
class Cominovel_Admin_Menus {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'admin_menu', array( $this, 'sort_manga_menus' ), 99 );
	}

	public function admin_menus() {
		add_submenu_page( 'edit.php?post_type=comic', __( 'Chapters', 'cominovel' ), __( 'Chapters', 'cominovel' ), 'manage_options', 'edit.php?post_type=chapter' );
		add_submenu_page( 'edit.php?post_type=comic', __( 'Artists', 'cominovel' ), __( 'Artists', 'cominovel' ), 'manage_options', 'edit.php?post_type=artist' );
		add_submenu_page( 'edit.php?post_type=comic', __( 'Authors', 'cominovel' ), __( 'Authors', 'cominovel' ), 'manage_options', 'edit.php?post_type=author' );
		add_submenu_page( 'edit.php?post_type=comic', __( 'Comic Settings', 'cominovel' ), __( 'Settings', 'cominovel' ), 'manage_options', admin_url( 'admin.php?page=cominovel-settings' ) );
	}

	public function sort_manga_menus() {
		global $submenu, $menu;
		// $submenu['edit.php?post_type=comic'] = array();
	}
}

return new Cominovel_Admin_Menus();
