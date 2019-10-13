<?php

class Cominovel_Template_Loader {

	protected static $instance;
	protected $defaultTemplateDir;

	public function __construct() {
		$this->defaultTemplateDir = sprintf( '%s/templates', COMINOVEL_ABSPATH );
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function core_template( $templates, $parent_template_directory = '') {
		foreach ( (array) $templates as $template ) {
			if ($parent_template_directory) {
				$parent_template_directory = sprintf('includes/%s/templates', $parent_template_directory);
			} else {
				$parent_template_directory = 'templates';
			}

			$template_file = sprintf( '%s%s/%s.php', COMINOVEL_ABSPATH, $parent_template_directory, $template );
			if ( file_exists( $template_file ) ) {
				return $template_file;
			}
		}
		return __return_empty_string();
	}

	public function locate_template( $template ) {
		$theme_template = sprintf( 'cominovel/%s.php', $template );
		$template_file  = locate_template( $theme_template, false );
		if ( $template_file ) {
			return $template_file;
		}
		return $this->core_template( $template, '' );
	}
}
