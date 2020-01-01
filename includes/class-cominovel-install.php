<?php

use Ramphor\User\Db\UserTable;

class Cominovel_Install {


	public static function active() {
		/**
		 * Flush rewrite rules after register Cominovel post types
		 */
		add_action( 'init', 'flush_rewrite_rules', 90 );

		if ( class_exists( UserTable::class ) ) {
			UserTable::create();
		}
	}

	public static function deactive() {
		add_action( 'init', 'flush_rewrite_rules', 90 );
	}
}
