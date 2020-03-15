<?php

class Cominovel_Template {


	protected static $template_info;

	protected $isCominovel = false;
	protected $useTemplate = false;


	public function __construct() {
		add_filter( 'single_template_hierarchy', array( $this, 'check_single_template' ) );
		add_filter( 'archive_template_hierarchy', array( $this, 'check_archive_template' ) );
		add_filter( 'search_template_hierarchy', array( $this, 'check_search_template' ) );
		add_filter( 'template_include', array( $this, 'load_template' ), 33 );
	}

	public function check_single_template( $templates ) {
		$post_type          = get_post_type();
		$allowed_post_types = Cominovel_Post_Types::get_allowed_post_types();
		array_push( $allowed_post_types, 'chapter' );

		$this->isCominovel = in_array( 'single.php', $templates ) && in_array( $post_type, $allowed_post_types );
		$this->useTemplate = sprintf( 'single-%s', $post_type );

		self::$template_info = array(
			'is_cominovel' => $this->isCominovel,
			'type'         => $post_type,
		);

		return $templates;
	}

	public function check_archive_template( $templates ) {
		$queried_object = get_queried_object();
		if ( isset( $queried_object->taxonomy ) ) {
			$taxonomy          = $queried_object->taxonomy;
			$this->isCominovel = in_array(
				$taxonomy,
				array(
					'genre',
					'cmn_country',
					'cmn_tag',
					'cmn_status',
				)
			);

			if ( $this->isCominovel ) {
				$this->useTemplate = 'archive';
			}
		}

		return $templates;
	}

	public function check_search_template( $templates ) {
		global $wp_query;
		$post_types = (array) $wp_query->get( 'post_type' );
		if ( in_array( 'comic', $post_types ) || in_array( 'novel', $post_types ) ) {
			$this->isCominovel = true;
			$this->useTemplate = 'search';
		}

		return $templates;
	}

	public function load_template( $template ) {
		if ( $this->useTemplate . '.php' === basename( $template ) || ! $this->useTemplate ) {
			return $template;
		}
		if ( $this->isCominovel ) {
			$template = sprintf( '%s/%s.php', COMINOVEL_TEMPLATES_DIR, $this->useTemplate );
		}
		return $template;
	}

	public static function get_template_info() {
		return self::$template_info;
	}
}

new Cominovel_Template();
