<?php

class Cominovel_Taxonomies {

	protected $allowed_post_types;

	public function __construct() {
		add_action( 'init', array( $this, 'setup_environment' ), 5 );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'init', array( $this, 'register_hidden_taxonomies' ) );
		add_action( 'init', array( $this, 'register_built_in_taxonomies' ) );
	}

	public function setup_environment() {
		$this->allowed_post_types = apply_filters(
			'cominovel_register_taxonomy_for_post_types',
			self::get_allowed_post_types()
		);
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

	public function register_taxonomies() {
		$genre_rewrite = array(
			'slug'         => 'genre',
			'with_front'   => false,
			'hierarchical' => true,
		);

		$labels = array(
			'name'              => __( 'Genres', 'cominovel' ),
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
		);
		$args   = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'show_in_rest'          => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
		);
		register_taxonomy(
			'genre',
			$this->allowed_post_types,
			apply_filters(
				'cominovel_taxonomy_args_cominovel_genre',
				$args,
			)
		);

		$labels = array(
			'name'          => __( 'Countries', 'cominovel' ),
			'singular_name' => __( 'Country', 'cominovel' ),
		);
		$args   = array(
			'labels'       => $labels,
			'public'       => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			'show_in_menu' => true,
		);
		register_taxonomy(
			'cm_country',
			$this->allowed_post_types,
			apply_filters(
				'cominovel_taxonomy_args_cominovel_country_args',
				$args
			)
		);

		register_taxonomy(
			'cm_tag',
			$this->allowed_post_types,
			apply_filters(
				'cominovel_taxonomy_args_cominovel_tag',
				array(
					'labels'            => array(
						'name'          => __( 'Tags', 'cominovel' ),
						'singular_name' => __( 'Tag', 'cominovel' ),
					),
					'public'            => true,
					'hierarchical'      => false,
					'show_ui'           => true,
					'show_admin_column' => true,
					'show_in_rest'      => true,
				)
			)
		);

		$post_types = self::get_allowed_post_types();
		foreach ( $post_types as $post_type ) {
			$post_type_object = get_post_type_object( $post_type );
			$args             = array(
				'labels'            => $post_type_object->labels,
				'public'            => false,
				'hierarchical'      => false,
				'show_admin_column' => self::check_active_data_type() === $post_type,
				'show_in_menu'      => false,
				'show_in_rest'      => true,
			);
			register_taxonomy(
				"tax_{$post_type}",
				'chapter',
				apply_filters(
					"cominovel_taxonomy_args_cominovel_{$post_type}_args",
					$args
				)
			);
		}
	}

	public function register_hidden_taxonomies() {
		$labels = array(
			'name'          => __( 'Releases', 'cominovel' ),
			'singular_name' => __( 'Release', 'cominovel' ),
		);
		$args   = array(
			'labels'       => $labels,
			'public'       => true,
			'hierarchical' => false,
			'show_in_rest' => true,
			'show_in_menu' => false,
		);
		register_taxonomy(
			'cm_release',
			$this->allowed_post_types,
			apply_filters(
				'cominovel_taxonomy_args_cominovel_release_args',
				$args
			)
		);
	}

	public function register_built_in_taxonomies() {
		$labels = array(
			'name'          => __( 'Authors', 'cominovel' ),
			'singular_name' => __( 'Author', 'cominovel' ),
		);
		$args   = array(
			'labels'            => $labels,
			'public'            => false,
			'hierarchical'      => false,
			'show_admin_column' => false,
			'show_in_menu'      => false,
			'show_in_rest'      => true,
			'_builtin'          => true,
		);
		register_taxonomy(
			'cm_author',
			$this->allowed_post_types,
			apply_filters(
				'cominovel_taxonomy_args_cominovel_author_args',
				$args
			)
		);

		$labels = array(
			'name'          => __( 'Artists', 'cominovel' ),
			'singular_name' => __( 'Artist', 'cominovel' ),
		);
		$args   = array(
			'labels'            => $labels,
			'public'            => false,
			'hierarchical'      => false,
			'show_admin_column' => false,
			'show_in_menu'      => false,
			'show_in_rest'      => true,
			'_builtin'          => true,
		);
		register_taxonomy(
			'cm_artist',
			$this->allowed_post_types,
			apply_filters(
				'cominovel_taxonomy_args_cominovel_artist_args',
				$args
			)
		);

		$labels = array(
			'name'          => __( 'Statuses', 'cominovel' ),
			'singular_name' => __( 'Status', 'cominovel' ),
		);
		$args   = array(
			'labels'            => $labels,
			'public'            => false,
			'hierarchical'      => false,
			'show_admin_column' => false,
			'show_in_menu'      => false,
			'show_in_rest'      => true,
			'_builtin'          => true,
		);
		register_taxonomy(
			'cm_status',
			$this->allowed_post_types,
			apply_filters(
				'cominovel_taxonomy_args_cominovel_status_args',
				$args
			)
		);
	}
}

new Cominovel_Taxonomies();
