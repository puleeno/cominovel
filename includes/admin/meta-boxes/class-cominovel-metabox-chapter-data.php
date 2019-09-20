<?php
use Puleeno\Wallery\Wallery;
use Puleeno\Wallery\Factory\MetaboxFactory;

class Cominovel_Metabox_Chapter_Data {

	protected $wallery;

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ), 5 );
		if ( class_exists( Wallery::class ) ) {
			$this->wallery = new Wallery( new MetaboxFactory() );
			$this->wallery->setId( 'cominovel_chapter_images' );
		}
	}

	public function add_meta_box() {
		if ( ! empty( $this->wallery ) ) {
			add_meta_box(
				'cominovel_chapter_images',
				__( 'Chaper Images', 'cominovel' ),
				array( $this->wallery, 'render' ),
				'chapter',
				'advanced',
				'high'
			);
		}
	}
}
new Cominovel_Metabox_Chapter_Data();
