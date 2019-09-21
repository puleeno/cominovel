<?php

class Cominovel_Template {
	protected $isSingleCommic     = false;
	protected $useDefaultTemplate = false;
	protected $useTemplate;

	public function __construct() {
		add_filter( 'single_template_hierarchy', array( $this, 'check_single_template' ) );
		add_filter( 'template_include', array( $this, 'load_template' ), 33 );
	}

	public function check_single_template( $templates ) {
		$template = locate_template( $templates, false );
		$template = substr( basename( $template ), 0, 12 );

		$this->isSingleCommic     = in_array( 'single-comic.php', $templates );
		$this->useDefaultTemplate = ( $template !== 'single-comic' );

		return $templates;
	}

	public function load_template( $template ) {
		if ( ! $this->useDefaultTemplate ) {
			return $template;
		}
		if ( $this->isSingleCommic ) {
			$template = sprintf( '%s/single-comic.php', COMINOVEL_TEMPLATES_DIR );
		}

		return $template;
	}
}

new Cominovel_Template();
