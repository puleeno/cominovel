<?php
class RPM_Admin {
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
		add_filter( 'pre_get_posts', array($this, 'filter_mangas'));
	}

	public function includes() {
		require_once dirname( __FILE__ ) . '/class-rpm-admin-post-types.php';
		require_once dirname( __FILE__ ) . '/class-rpm-admin-menus.php';
		require_once dirname( __FILE__ ) . '/class-rpm-admin-assets.php';
	}

	public function filter_mangas($query) {
		if ( $query->get( 'post_type' ) != 'manga' ) {
			return $query;
		}

		return $query;
	}
}

return new RPM_Admin();
