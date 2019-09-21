<?php

class Cominovel_Template {
	protected $isSingle    = false;
	protected $useTemplate = false;

	public function __construct() {
		add_filter( 'single_template_hierarchy', array( $this, 'check_single_template' ) );
		add_filter( 'template_include', array( $this, 'load_template' ), 33 );
	}

	public function check_single_template( $templates ) {
		$template = locate_template( $templates, false );
		$template = substr( basename( $template ), 0, 12 );

		if ( in_array( 'single-comic.php', $templates ) ) {
			$this->isSingle    = true;
			$this->useTemplate = 'single-comic';
		} elseif ( in_array( 'single-novel.php', $templates ) ) {
			$this->isSingle    = true;
			$this->useTemplate = 'single-novel';
		}

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
}

new Cominovel_Template();
