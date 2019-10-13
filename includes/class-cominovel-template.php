<?php

class Cominovel_Template {

	protected static $template_info;

	protected $isSingle    = false;
	protected $useTemplate = false;

	public function __construct() {
		add_filter( 'single_template_hierarchy', array( $this, 'check_single_template' ) );
		add_filter( 'template_include', array( $this, 'load_template' ), 33 );
	}

	public function check_single_template( $templates ) {
		$post_type          = get_post_type();
		$allowed_post_types = Cominovel_Post_Types::get_allowed_post_types();
		array_push( $allowed_post_types, 'chapter' );

		$this->isSingle    = in_array( 'single.php', $templates ) && in_array( $post_type, $allowed_post_types );
		$this->useTemplate = sprintf( 'single-%s', $post_type );

		self::$template_info = array(
			'is_cominovel' => $this->isSingle,
			'type'         => $post_type,
		);

		return $templates;
	}

	public function load_template( $template ) {
		if ( ! $this->useTemplate ) {
			return $template;
		}
		if ( $this->isSingle ) {
			$template = sprintf( '%s/%s.php', COMINOVEL_TEMPLATES_DIR, $this->useTemplate );
		}
		return $template;
	}

	public static function get_template_info() {
		return self::$template_info;
	}
}

new Cominovel_Template();
