<?php

class RPM_Post_Types {
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 5 );
		add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
		add_action( 'init', array( __CLASS__, 'register_post_status' ), 10 );

		add_filter( 'rest_api_allowed_post_types', array( __CLASS__, 'rest_api_allowed_post_types' ) );
		add_filter( 'gutenberg_can_edit_post_type', array( __CLASS__, 'gutenberg_can_edit_post_type' ), 10, 2 );
	}

	public static function register_post_types() {
		if ( ! is_blog_installed() || post_type_exists( 'manga' ) ) {
			return;
		}

		do_action('ramphor_manga_register_post_types');

		$manga_rewrite = array(
			'slug' => 'manga',
			'feeds' => true,
		);
		$supports   = array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'publicize', 'wpcom-markdown' );
		$has_archive = true;

		register_post_type(
			'manga',
			apply_filters(
				'ramphor_manga_register_post_type_manga',
				array(
					'labels' => array(
						'name' =>  __('Mangas', 'ramphor_manga'),
						'singular_name' => __('Manga', 'ramphor_manga'),
						'all_items' => __('All Mangas', 'ramphor_manga'),
						'menu_name' => __('Mangas', 'ramphor_manga'),
						'add_new' => __('Add new', 'ramphor_managa'),
						'add_new_item' => __('Add new manga', 'ramphor_manga'),
						'edit' => __('Edit', 'ramphor_manga'),
						'edit_item' => __('Edit manga', 'ramphor_manga'),
						'new_item' => __('New manga', 'ramphor_manga'),
						'view_item' => __('View manga', 'ramphor_manga'),
						'view_items' => __('View mangas', 'ramphor_manga'),
						'search_items' => __('Search mangas', 'ramphor_manga'),
						'not_found' => __('No mangas found', 'ramphor_manga'),
						'not_found_in_trash' => __('No mangas found in trash', 'ramphor_manga'),
						'parent' => __('Parent manga', 'ramphor_manga'),
						'feature_image' => __('Managa image', 'ramphor_manga'),
						'set_feature_image' => __('Set manga image', 'ramphor_manga'),
						'remove_feature_image' => __('Remove manga image', 'ramphor_manga'),
						'use_featured_image' => __('Use as manga image', 'ramphor_manga'),
						'insert_into_item' => __('Insert into manga', 'ramphor_manga'),
						'uploaded_to_this_item' => __('Uploaded to this manga', 'ramphor_manga'),
						'filter_items_list' => __('Filter mangas', 'ramphor_manga'),
						'items_list_navigation' => __('Mangas navigation', 'ramphor_manga'),
						'items_list' => __('Mangas list', 'ramphor_manga'),
					),
					'description' => __('This is where you can add new manga for your website.', 'ramphor_manga'),
					'public' => true,
					'show_ui' => true,
					// 'capability_type' => 'manga',
					'map_meta_cap' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'hierarchical' => true,
					'rewrite' => $manga_rewrite,
					'query_var' => true,
					'supports' => $supports,
					'has_archive' => $has_archive,
					'show_in_nav_menus' => true,
					'show_in_rest' => true,
				),
			)
		);

		register_post_type(
			'artist',
			apply_filters(
				'ramphor_manga_register_post_type_artist',
				array(
					'labels' => array(
						'name' => __('Artist', 'ramphor_manga'),
						'singular_name' => __('Artist', 'ramphor_manga')
					),
					'public' => true,
					'hierarchical' => false,
					'show_in_menu' => false,
					'show_in_rest' => true,
				),
			),
		);

		register_post_type(
			'author',
			apply_filters(
				'ramphor_manga_register_post_type_author',
				array(
					'labels' => array(
						'name' => __('Authors', 'ramphor_manga'),
						'singular_name' => __('Author', 'ramphor_manga')
					),
					'public' => true,
					'hierarchical' => false,
					'show_in_menu' => false,
					'show_in_rest' => true,
				),
			),
		);
	}

	public static function register_taxonomies() {
		$category_rewrite = array(
			'slug' => 'genre',
			'with_front' => false,
			'hierarchical' => true,
		);
		register_taxonomy(
			'manga_cat',
			apply_filters(
				'ramphor_manga_taxonomy_objects_manga_cat',
				array( 'manga' ),
			),
			apply_filters(
				'ramphor_manga_taxonomy_args_manga_cat',
				array(
					'hierarchical' => true,
					'update_count_callback' => '_wc_term_recount',
					'label' => __('Categories', 'ramphor_manga'),
					'labels' => array(
						'name' => __('Manga categories', 'ramphor_manga'),
						'singular_name' => __('Category', 'ramphor_manga'),
						'menu_name' => __('Categories', 'ramphor_manga'),
						'search_items' => __('Search categories', 'ramphor_manga'),
						'all_items' => __('All categories', 'ramphor_manga'),
						'parent_item' => __('Parent category', 'ramphor_manga'),
						'parent_item_colon' => __('Parent category:', 'ramphor_manga'),
						'edit_item' => __('Edit category', 'ramphor_manga'),
						'update_item' => __('update category', 'ramphor_manga'),
						'add_new_item' => __('Add new category', 'ramphor_manga'),
						'add_new_name' => __('New category name', 'ramphor_manga'),
						'not_found' => __('No categories found', 'ramphor_manga'),
					),
					'show_ui' => true,
					'public' => true,
					'show_in_rest' => true,
					'query_var' => true,
					// 'capabilities' => array(
					// 	'manage_terms' => 'manage_manga_terms',
					// 	'edit_terms' => 'edit_manga_terms',
					// 	'delete_terms' => 'delete_manga_terms',
					// 	'assign_terms' => 'assign_manga_terms',
					// ),
					'rewrite' => $category_rewrite,
				)
			)
		);

		register_taxonomy(
			'manga_release',
			apply_filters('ramphor_manga_taxonomy_objects_manga_release', array( 'manga' ) ),
			apply_filters('ramphor_manga_taxonomy_args_manga_release', array(
				'labels'    => array(
					'name' => __('Releases', 'ramphor_manga'),
					'singular_name' => __('Release', 'ramphor_manga'),
				),
				'public'	=> true,
				'hierarchical' => false,
				'show_in_rest' => true,
			))
		);

		register_taxonomy(
			'manga_tag',
			apply_filters('ramphor_manga_taxonomy_objects_manga_tag', array( 'manga' ) ),
			apply_filters('ramphor_manga_taxonomy_args_manga_tag', array(
				'labels'    => array(
					'name' => __('Tags', 'ramphor_manga'),
					'singular_name' => __('Tag', 'ramphor_manga'),
				),
				'public'	=> true,
				'hierarchical' => false,
				'show_in_rest' => true,
			))
		);
	}

	public static function register_post_status() {

	}

	public static function rest_api_allowed_post_types($post_types) {
		$post_types[] = 'manga';
		return $post_types;
	}

	public static function gutenberg_can_edit_post_type( $can_edit, $post_type ) {
		return 'manga' === $post_type ? false : $can_edit;
	}
}


RPM_Post_Types::init();