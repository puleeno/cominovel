<?php
use Puleeno\Wallery\Wallery;
use Puleeno\Wallery\Factory\MetaboxFactory;

class Cominovel_Metabox_Chapter_Data {
	protected $wallery;
	protected $post_type;
	protected $is_chapter_edit;

	public function __construct() {
		add_action( 'admin_head', array( $this, 'hide_editor_area' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ), 5 );
		add_filter( 'cominovel_register_post_type_chapter_args', array( $this, 'remove_editor_for_comic' ) );

		if ( class_exists( Wallery::class ) ) {
			$this->wallery = new Wallery( new MetaboxFactory() );
			$this->wallery->setId( 'cominovel_chapter_images' );
		}
	}

	public function add_meta_box() {
		$current_screen = get_current_screen();
		if ( $current_screen->id !== 'chapter' ) {
			return;
		}
		$this->is_chapter_edit = true;

		$allowed_post_types = Cominovel_Post_Types::get_allowed_post_types();
		if ( isset( $_GET['data_type'] ) && in_array( $_GET['data_type'], $allowed_post_types ) ) {
			$parent_data_type = $_GET['data_type'];
		} else {
			$parent_data_type = array_shift( $allowed_post_types );
		}
		$post_type       = get_post_type_object( $parent_data_type );
		$this->post_type = $parent_data_type;
		add_meta_box(
			'cominovel_comic_of_chapter',
			sprintf( __( 'Choose %s', 'cominovel' ), $post_type->labels->singular_name ),
			array( $this, 'comic_info' ),
			'chapter',
			'side'
		);

		if ( ! empty( $this->wallery ) && $parent_data_type === 'comic' ) {
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

	public function comic_info() {
	}

	public function hide_editor_area() {
		if ( ! $this->is_chapter_edit ) {
			return;
		}
		?>
			<style type="text/css"> #slugdiv, #edit-slug-box { display: none; }</style>
		<?php
	}
	public function remove_editor_for_comic( $args ) {
		if ( empty( $_GET['data_type'] ) || $_GET['data_type'] !== 'comic' ) {
			return $args;
		}
		$supports = $args['supports'];
		$index    = array_search( 'editor', $supports );
		if ( $index !== false ) {
			unset( $supports[ $index ] );
		}
		$args['supports'] = array_values( $supports );
		return $args;
	}
}
new Cominovel_Metabox_Chapter_Data();
