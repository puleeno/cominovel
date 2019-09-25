<?php
if ( class_exists( 'Cominovel_Admin_Post_Types' ) ) {
	return new Cominovel_Admin_Post_Types();
}

class Cominovel_Admin_Post_Types {

	public function __construct() {
		require_once dirname( __FILE__ ) . '/class-cominovel-admin-meta-boxes.php';
	}
}

return new WC_Admin_Post_Types();
