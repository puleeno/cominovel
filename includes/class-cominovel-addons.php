<?php
class Cominovel_Addons {
	protected $addons;

	public function __construct() {
		$this->includes();
		$this->init_hooks();
	}

	public function includes() {
		require_once dirname( __FILE__ ) . '/addons/class-cominovel-addon-filters.php';
		require_once dirname( __FILE__ ) . '/addons/class-cominovel-addon-user-activity.php';
	}

	public function init_hooks() {
		add_action( 'plugins_loaded', array( $this, 'load_addons' ) );
		add_action( 'plugins_loaded', array( $this, 'init_addons' ), 25 );
	}

	public function load_addons() {
		$addons = array(
			'filters'       => Cominovel_Addon_Filters::class,
			'user_activity' => Cominovel_Addon_User_Activity::class,
		);

		$this->addons = apply_filters( 'cominovel_load_addons', $addons );
	}

	public function init_addons() {
		foreach ( $this->addons as $id => $class_name ) {
			$init_args = apply_filters( 'cominovel_addon_init_args', null, $id, $class_name );
			$addon     = new $class_name( $init_args );
			if ( is_callable( array( $addon, 'do' ) ) ) {
				add_action( 'init', array( $addon, 'do' ) );
			}
		}
	}
}

new Cominovel_Addons();
