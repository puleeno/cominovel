<?php

class Cominovel_Install {
	public static function active() {
		flush_rewrite_rules();
	}

	public static function deactive() {
		flush_rewrite_rules();
	}
}
