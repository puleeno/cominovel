<?php

class RPM_Post_Types {
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ) );
		add_action( 'init', array( __CLASS__, 'register_post_types' ) );
		add_action( 'init', array( __CLASS__, 'register_post_status' ) );
	}

	public static function register_post_types() {
		if ( ! is_blog_installed() || post_type_exists( 'manga' ) ) {
			return;
		}

		do_action('ramphor_manga_register_post_types');

		$manga_rewrite = array(
			'rewrite' => true,
			'slug' => 'manga',
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
					// 'map_meta_cap' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'hierarchical' => false,
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
			'manga_chapter',
			apply_filters(
				'ramphor_manga_register_post_type_manga_chapter',
				array(
					'label'           => __( 'Chapters', 'ramphor_manga' ),
					'public'          => true,
					'hierarchical'    => true,
					'supports'        => array('title', 'editor', 'post-formats'),
					// 'capability_type' => 'manga',
					'rewrite'         => array(
						'slug' => 'manga',
					),
					'show_in_menu' => false,
					'show_in_nav_menus' => false
				)
			)
		);
	}

	public static function register_taxonomies() {
	}

	public static function register_post_status() {

	}
}


RPM_Post_Types::init();