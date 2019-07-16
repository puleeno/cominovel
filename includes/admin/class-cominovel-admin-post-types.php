<?php
if ( class_exists( 'RPM_Admin_Post_Types' ) ) {
	return new RPM_Admin_Post_Types();
}

class RPM_Admin_Post_Types {
	public function __construct() {
		require_once dirname( __FILE__ ) . '/class-rpm-admin-meta-boxes.php';
	}
}

return new WC_Admin_Post_Types();
