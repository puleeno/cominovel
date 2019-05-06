<?php
class RPM_Admin {
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
	}

	public function includes() {
		require_once dirname( __FILE__ ) . '/class-rpm-admin-menus.php';
	}
}

return new RPM_Admin();
