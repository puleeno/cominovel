<?php
use Jankx\SiteLayout\Layout;

class Cominovel_Integrate_Jankx {


	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'integrate' ) );
	}

	public function integrate() {
		$this->jankx_is_activated = defined( 'JANKX_FRAMEWORK_LOADED' ) || class_exists( 'Jankx' );
		if ( ! $this->jankx_is_activated ) {
			return;
		}
		add_action( 'template_redirect', array( $this, 'layout' ) );
	}

	public function layout() {
		remove_all_actions( 'cominovel_sidebars' );
		add_filter( 'jankx_get_layout', array( $this, 'change_layout' ) );
	}

	public function change_layout( $layout ) {
		$template_info = Cominovel_Template::get_template_info();
		if ( $template_info['is_cominovel'] && class_exists( Layout::class ) ) {
			$post = $GLOBALS['post'];
			if ( $template_info['type'] === 'chapter' ) {
				return Layout::LAYOUT_FULL_WIDTH;
			}

			return apply_filters( 'cominovel_jankx_layout', Layout::LAYOUT_FULL_WIDTH, $template_info['type'] );
		}
		return $layout;
	}
}

new Cominovel_Integrate_Jankx();
