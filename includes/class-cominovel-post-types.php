<?php

class Cominovel_Post_Types {
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 5 );
		add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
		add_action( 'init', array( __CLASS__, 'register_post_status' ), 10 );

		add_filter( 'rest_api_allowed_post_types', array( __CLASS__, 'rest_api_allowed_post_types' ) );
		add_filter( 'gutenberg_can_edit_post_type', array( __CLASS__, 'gutenberg_can_edit_post_type' ), 10, 2 );
	}

	public static function register_post_types() {
		if ( ! is_blog_installed() || post_type_exists( 'comic' ) ) {
			return;
		}

		do_action( 'cominovel_register_post_types' );

		$comic_rewrite = array(
			'slug'  => 'comic',
			'feeds' => true,
		);
		$supports      = array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'publicize', 'wpcom-markdown' );
		$has_archive   = true;

		register_post_type(
			'comic',
			apply_filters(
				'cominovel_register_post_type_comic',
				array(
					'labels'              => array(
						'name'                  => __( 'Mangas', 'cominovel' ),
						'singular_name'         => __( 'Manga', 'cominovel' ),
						'all_items'             => __( 'All Mangas', 'cominovel' ),
						'menu_name'             => __( 'Mangas', 'cominovel' ),
						'add_new'               => __( 'Add new', 'ramphor_managa' ),
						'add_new_item'          => __( 'Add new comic', 'cominovel' ),
						'edit'                  => __( 'Edit', 'cominovel' ),
						'edit_item'             => __( 'Edit comic', 'cominovel' ),
						'new_item'              => __( 'New comic', 'cominovel' ),
						'view_item'             => __( 'View comic', 'cominovel' ),
						'view_items'            => __( 'View comics', 'cominovel' ),
						'search_items'          => __( 'Search comics', 'cominovel' ),
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
						'items_list_navigation' => __( 'Mangas navigation', 'cominovel' ),
						'items_list'            => __( 'Mangas list', 'cominovel' ),
					),
					'description'         => __( 'This is where you can add new comic for your website.', 'cominovel' ),
					'public'              => true,
					'show_ui'             => true,
					// 'capability_type' => 'comic',
					'map_meta_cap'        => true,
					'publicly_queryable'  => true,
					'exclude_from_search' => false,
					'hierarchical'        => true,
					'rewrite'             => $comic_rewrite,
					'query_var'           => true,
					'supports'            => $supports,
					'has_archive'         => $has_archive,
					'show_in_nav_menus'   => true,
					'show_in_rest'        => true,
				),
			)
		);

		register_post_type(
			'artist',
			apply_filters(
				'cominovel_register_post_type_artist',
				array(
					'labels'       => array(
						'name'          => __( 'Artist', 'cominovel' ),
						'singular_name' => __( 'Artist', 'cominovel' ),
					),
					'public'       => true,
					'hierarchical' => false,
					'show_in_menu' => false,
					'show_in_rest' => true,
				),
			),
		);

		register_post_type(
			'author',
			apply_filters(
				'cominovel_register_post_type_author',
				array(
					'labels'       => array(
						'name'          => __( 'Authors', 'cominovel' ),
						'singular_name' => __( 'Author', 'cominovel' ),
					),
					'public'       => true,
					'hierarchical' => false,
					'show_in_menu' => false,
					'show_in_rest' => true,
				),
			),
		);
	}

	public static function register_taxonomies() {
		$genre_rewrite = array(
			'slug'         => 'genre',
			'with_front'   => false,
			'hierarchical' => true,
		);
		register_taxonomy(
			'genre',
			apply_filters(
				'cominovel_taxonomy_objects_comic_genre',
				array( 'comic' ),
			),
			apply_filters(
				'cominovel_taxonomy_args_comic_genre',
				array(
					'hierarchical'          => true,
					'update_count_callback' => '_wc_term_recount',
					'label'                 => __( 'Genres', 'cominovel' ),
					'labels'                => array(
						'name'              => __( 'Manga genres', 'cominovel' ),
						'singular_name'     => __( 'Genre', 'cominovel' ),
						'menu_name'         => __( 'Genres', 'cominovel' ),
						'search_items'      => __( 'Search genres', 'cominovel' ),
						'all_items'         => __( 'All genres', 'cominovel' ),
						'parent_item'       => __( 'Parent genre', 'cominovel' ),
						'parent_item_colon' => __( 'Parent genre:', 'cominovel' ),
						'edit_item'         => __( 'Edit genre', 'cominovel' ),
						'update_item'       => __( 'update genre', 'cominovel' ),
						'add_new_item'      => __( 'Add new genre', 'cominovel' ),
						'add_new_name'      => __( 'New genre name', 'cominovel' ),
						'not_found'         => __( 'No genres found', 'cominovel' ),
					),
					'show_ui'               => true,
					'public'                => true,
					'show_in_rest'          => true,
					'query_var'             => true,
					// 'capabilities' => array(
					// 'manage_terms' => 'manage_comic_terms',
					// 'edit_terms' => 'edit_comic_terms',
					// 'delete_terms' => 'delete_comic_terms',
					// 'assign_terms' => 'assign_comic_terms',
					// ),
					'rewrite'               => $genre_rewrite,
				)
			)
		);

		register_taxonomy(
			'comic_release',
			apply_filters( 'cominovel_taxonomy_objects_comic_release', array( 'comic' ) ),
			apply_filters(
				'cominovel_taxonomy_args_comic_release',
				array(
					'labels'       => array(
						'name'          => __( 'Releases', 'cominovel' ),
						'singular_name' => __( 'Release', 'cominovel' ),
					),
					'public'       => true,
					'hierarchical' => false,
					'show_in_rest' => true,
					'show_in_menu' => false,
				)
			)
		);

		register_taxonomy(
			'comic_tag',
			apply_filters( 'cominovel_taxonomy_objects_comic_tag', array( 'comic' ) ),
			apply_filters(
				'cominovel_taxonomy_args_comic_tag',
				array(
					'labels'       => array(
						'name'          => __( 'Tags', 'cominovel' ),
						'singular_name' => __( 'Tag', 'cominovel' ),
					),
					'public'       => true,
					'hierarchical' => false,
					'show_in_rest' => true,
				)
			)
		);
	}

	public static function register_post_status() {

	}

	public static function rest_api_allowed_post_types( $post_types ) {
		$post_types[] = 'comic';
		return $post_types;
	}

	public static function gutenberg_can_edit_post_type( $can_edit, $post_type ) {
		return 'comic' === $post_type ? false : $can_edit;
	}
}


Cominovel_Post_Types::init();
