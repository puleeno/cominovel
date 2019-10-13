<?php
class Cominovel_Novel extends Cominovel_Data {
	public function __construct( $post = null ) {
		parent::__construct( $post, true );

		$this->load_chapters();
	}
}
