<?php
class Cominovel_Admin_Menus {
	protected $menu_positions;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'admin_menu', array( $this, 'sort_cominovel_menus' ), 99 );
	}

	public function admin_menus() {
		add_menu_page( __( 'Cominovel', 'cominovel' ), __( 'Cominovel', 'cominovel' ), 'manage_options', 'cominovel', array( Cominovel_Admin_Setting_Page::class, 'render' ), null );
		add_submenu_page( 'cominovel', __( 'Documentation', 'cominovel' ), __( 'Documentation', 'cominovel' ), 'manage_options', 'edit.php?post_type=chapter' );
		add_submenu_page( 'cominovel', __( 'Storages', 'cominovel' ), __( 'Storages', 'cominovel' ), 'manage_options', 'edit.php?post_type=chapter' );
		add_submenu_page( 'cominovel', __( 'Extensions', 'cominovel' ), __( 'Extensions', 'cominovel' ), 'manage_options', 'edit.php?post_type=chapter' );

		foreach ( Cominovel_Post_Types::get_allowed_post_types() as $post_type ) {
			$menu_slug = sprintf( 'edit.php?post_type=%s', $post_type );
			add_submenu_page( $menu_slug, __( 'Chapters', 'cominovel' ), __( 'Chapters', 'cominovel' ), 'manage_options', 'edit.php?post_type=chapter' );
			add_submenu_page( $menu_slug, __( 'Artists', 'cominovel' ), __( 'Artists', 'cominovel' ), 'manage_options', 'edit.php?post_type=artist' );
			add_submenu_page( $menu_slug, __( 'Authors', 'cominovel' ), __( 'Authors', 'cominovel' ), 'manage_options', 'edit.php?post_type=author' );
		}
	}

	public function extract_indexed_menus( $menus ) {
		$indexes = array();
		foreach ( $menus as $index => $menu ) {
			$indexes[ $menu[0] ] = $menu;
		}
		return $indexes;
	}

	public function sort_cominovel_menus() {
		global $submenu, $menu;
		$submenu['cominovel'][0][0] = __( 'Settings', 'cominovel' );

		foreach ( Cominovel_Post_Types::get_allowed_post_types() as $post_type ) {
			$menu_key = 'edit.php?post_type=' . $post_type;
			if ( empty( $submenu[ $menu_key ] ) ) {
				continue;
			}
		}
	}
}

return new Cominovel_Admin_Menus();
