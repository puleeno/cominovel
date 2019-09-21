<?php
class Cominoval_Admin_Wp_Tables {
	public function __construct() {
		require_once dirname( __FILE__ ) . '/class-cominoval-admin-wp-table-chapters.php';
	}
}

new Cominoval_Admin_Wp_Tables();
