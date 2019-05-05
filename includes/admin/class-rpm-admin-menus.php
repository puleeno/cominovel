<?php
class RPM_Admin_Menus {
	public function __construct() {
		add_action('admin_menu', array($this, 'admin_menus'));
	}

	public function admin_menus() {
		add_submenu_page('edit.php?post_type=manga', __('Artists', 'ramphor_manga'), __('Artists', 'ramphor_manga'), 'manage_options', 'edit.php?post_type=artist');
		add_submenu_page('edit.php?post_type=manga', __('Authors', 'ramphor_manga'), __('Authors', 'ramphor_manga'), 'manage_options', 'edit.php?post_type=author');
	}
}

return new RPM_Admin_Menus();