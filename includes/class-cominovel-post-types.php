<?php

class Cominovel_Post_Types {

	protected $allowed_post_types;

	public function __construct() {
		$this->allowed_post_types = self::get_allowed_post_types();
		add_action( 'init', array( $this, 'register_post_status' ), 10 );
		add_action( 'init', array( $this, 'register_main_post_types' ), 5 );
		add_action( 'init', array( $this, 'register_additional_post_types' ) );
	}

	public static function get_allowed_post_types() {
		$post_types = get_option( 'cominovel_allowed_post_types' );
		if ( empty( $post_types ) ) {
			$post_types = array( 'comic' );
		}
		return (array) $post_types;
	}

	public static function check_active_data_type( $post_id = 0 ) {
		$allowed_post_types = self::get_allowed_post_types();
		if ( isset( $_GET['data_type'] ) && in_array( $_GET['data_type'], $allowed_post_types ) ) {
			return $_GET['data_type'];
		} elseif ( $post_id > 0 ) {
			$post_type = get_post_type(
				wp_get_post_parent_id( $post_id )
			);
			if ( ! is_wp_error( $post_type ) ) {
				return $post_type;
			}
		}
		return array_shift( $allowed_post_types );
	}

	public function register_main_post_types() {
		if ( ! is_blog_installed() || post_type_exists( 'comic' ) ) {
			return;
		}
		do_action( 'cominovel_register_post_types' );
		$supports = array( 'title', 'editor', 'thumbnail', 'comments', 'wpcom-markdown' );

		if ( in_array( 'comic', $this->allowed_post_types ) ) {
			$labels = array(
				'name'                  => __( 'Comics', 'cominovel' ),
				'singular_name'         => __( 'Comic', 'cominovel' ),
				'all_items'             => __( 'All Comics', 'cominovel' ),
				'menu_name'             => __( 'Comics', 'cominovel' ),
				'add_new'               => __( 'Add new', 'cominovel' ),
				'add_new_item'          => __( 'Add New Comic', 'cominovel' ),
				'edit'                  => __( 'Edit', 'cominovel' ),
				'edit_item'             => __( 'Edit Comic', 'cominovel' ),
				'new_item'              => __( 'New Comic', 'cominovel' ),
				'view_item'             => __( 'View Comic', 'cominovel' ),
				'view_items'            => __( 'View Comics', 'cominovel' ),
				'search_items'          => __( 'Search Comics', 'cominovel' ),
				'not_found'             => __( 'No comics found', 'cominovel' ),
				'not_found_in_trash'    => __( 'No comics found in trash', 'cominovel' ),
				'parent'                => __( 'Parent comic', 'cominovel' ),
				'feature_image'         => __( 'Managa image', 'cominovel' ),
				'set_feature_image'     => __( 'Set comic image', 'cominovel' ),
				'remove_feature_image'  => __( 'Remove comic image', 'cominovel' ),
				'use_featured_image'    => __( 'Use as comic image', 'cominovel' ),
				'insert_into_item'      => __( 'Insert into comic', 'cominovel' ),
				'uploaded_to_this_item' => __( 'Uploaded to this comic', 'cominovel' ),
				'filter_items_list'     => __( 'Filter comics', 'cominovel' ),
				'items_list_navigation' => __( 'Comics navigation', 'cominovel' ),
				'items_list'            => __( 'Comics list', 'cominovel' ),
			);
			$args   = array(
				'labels'              => $labels,
				'description'         => __( 'This is where you can add new comic for your website.', 'cominovel' ),
				'public'              => true,
				'show_ui'             => true,
				// 'capability_type' => 'comic',
				'map_meta_cap'        => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'hierarchical'        => true,
				'rewrite'             => array( 'comic' ),
				'query_var'           => true,
				'supports'            => $supports,
				'has_archive'         => true,
				'menu_icon'           => 'dashicons-format-image',
				'show_in_nav_menus'   => true,
				'show_in_rest'        => true,
			);
			register_post_type(
				'comic',
				apply_filters( 'cominovel_register_post_type_comic_args', $args )
			);
		}
		if ( in_array( 'novel', $this->allowed_post_types ) ) {
			$labels = array(
				'name'                  => __( 'Novels', 'cominovel' ),
				'singular_name'         => __( 'Novel', 'cominovel' ),
				'all_items'             => __( 'All Novels', 'cominovel' ),
				'menu_name'             => __( 'Novels', 'cominovel' ),
				'add_new'               => __( 'Add New', 'cominovel' ),
				'add_new_item'          => __( 'Add New Comic', 'cominovel' ),
				'edit'                  => __( 'Edit', 'cominovel' ),
				'edit_item'             => __( 'Edit Novel', 'cominovel' ),
				'new_item'              => __( 'New Novel', 'cominovel' ),
				'view_item'             => __( 'View Novel', 'cominovel' ),
				'view_items'            => __( 'View Novels', 'cominovel' ),
				'search_items'          => __( 'Search Novels', 'cominovel' ),
				'not_found'             => __( 'No novels found', 'cominovel' ),
				'not_found_in_trash'    => __( 'No novels found in trash', 'cominovel' ),
				'parent'                => __( 'Parent novel', 'cominovel' ),
				'feature_image'         => __( 'Managa image', 'cominovel' ),
				'set_feature_image'     => __( 'Set novel image', 'cominovel' ),
				'remove_feature_image'  => __( 'Remove novel image', 'cominovel' ),
				'use_featured_image'    => __( 'Use as novel image', 'cominovel' ),
				'insert_into_item'      => __( 'Insert into novel', 'cominovel' ),
				'uploaded_to_this_item' => __( 'Uploaded to this novel', 'cominovel' ),
				'filter_items_list'     => __( 'Filter novels', 'cominovel' ),
				'items_list_navigation' => __( 'Novels navigation', 'cominovel' ),
				'items_list'            => __( 'Novels list', 'cominovel' ),
			);
			$args   = array(
				'labels'              => $labels,
				'description'         => __( 'This is where you can add new novel for your website.', 'cominovel' ),
				'public'              => true,
				'show_ui'             => true,
				// 'capability_type' => 'comic',
				'map_meta_cap'        => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'hierarchical'        => true,
				'rewrite'             => array( 'novel' ),
				'query_var'           => true,
				'supports'            => $supports,
				'has_archive'         => true,
				'menu_icon'           => 'dashicons-media-text',
				'show_in_nav_menus'   => true,
				'show_in_rest'        => true,
			);
			register_post_type(
				'novel',
				apply_filters( 'cominovel_register_post_type_novel_args', $args )
			);
		}

		$labels = array(
			'name'               => _x( 'Chapters', 'post type general name', 'cominovel' ),
			'singular_name'      => _x( 'Chapter', 'post type singular name', 'cominovel' ),
			'menu_name'          => _x( 'Chapters', 'admin menu', 'cominovel' ),
			'name_admin_bar'     => _x( 'Chapter', 'add new on admin bar', 'cominovel' ),
			'add_new'            => _x( 'Add New', 'chapter', 'cominovel' ),
			'add_new_item'       => __( 'Add New Chapter', 'cominovel' ),
			'new_item'           => __( 'New Chapter', 'cominovel' ),
			'edit_item'          => __( 'Edit Chapter', 'cominovel' ),
			'view_item'          => __( 'View Chapter', 'cominovel' ),
			'all_items'          => __( 'All Chapters', 'cominovel' ),
			'search_items'       => __( 'Search Chapters', 'cominovel' ),
			'parent_item_colon'  => __( 'Parent Chapters:', 'cominovel' ),
			'not_found'          => __( 'No chapters found.', 'cominovel' ),
			'not_found_in_trash' => __( 'No chapters found in Trash.', 'cominovel' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'cominovel' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'chapter' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'comments', 'slug' ),
			'show_in_rest'       => false,
		);

		register_post_type( 'chapter', apply_filters( 'cominovel_register_post_type_chapter_args', $args ) );
	}

	public function register_additional_post_types() {
		$labels = array(
			'name'          => __( 'Artist', 'cominovel' ),
			'singular_name' => __( 'Artist', 'cominovel' ),
		);
		$args   = array(
			'labels'       => $labels,
			'public'       => true,
			'hierarchical' => false,
			'show_in_menu' => false,
			'show_in_rest' => true,
		);
		register_post_type(
			'artist',
			apply_filters(
				'cominovel_register_post_type_artist_args',
				$args
			),
		);

		$labels = array(
			'name'          => __( 'Authors', 'cominovel' ),
			'singular_name' => __( 'Author', 'cominovel' ),
		);
		$args   = array(
			'labels'       => $labels,
			'public'       => true,
			'hierarchical' => false,
			'show_in_menu' => false,
			'show_in_rest' => true,
		);
		register_post_type(
			'author',
			apply_filters(
				'cominovel_register_post_type_author_args',
				$args,
			),
		);
	}

	public function register_post_status() {
	}

	public function rest_api_allowed_post_types( $post_types ) {
		$post_types[] = 'comic';
		return $post_types;
	}

	public function gutenberg_can_edit_post_type( $can_edit, $post_type ) {
		return 'comic' === $post_type ? false : $can_edit;
	}
}

new Cominovel_Post_Types();
