<?php
class RPM_Admin_Menus {
	public function __construct() {
		add_action('admin_menu', array($this, 'admin_menus'));
	}


	public function admin_menus() {
		add_submenu_page( 'edit.php?post_type=manga', __( 'Attributes', 'woocommerce' ), __( 'Attributes', 'woocommerce' ), 'manage_options', 'manga_chapter', array( $this, 'attributes_page' ) );

	}
}

return new RPM_Admin_Menus();