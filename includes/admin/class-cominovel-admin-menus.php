<?php
class RPM_Admin_Menus {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
	}

	public function admin_menus() {
		add_submenu_page( 'edit.php?post_type=comic', __( 'Artists', 'cominovel' ), __( 'Artists', 'cominovel' ), 'manage_options', 'edit.php?post_type=artist' );
		add_submenu_page( 'edit.php?post_type=comic', __( 'Authors', 'cominovel' ), __( 'Authors', 'cominovel' ), 'manage_options', 'edit.php?post_type=author' );
		add_submenu_page( 'edit.php?post_type=comic', __( 'Manga Settings', 'cominovel' ), __( 'Settings', 'cominovel' ), 'manage_options', admin_url( 'admin.php?page=rpm-settings' ) );
	}
}

return new RPM_Admin_Menus();
