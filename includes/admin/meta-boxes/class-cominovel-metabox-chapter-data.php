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
		add_action( 'save_post', array( $this, 'save_chapter_data' ), 10, 2 );
		add_filter( 'cominovel_register_post_type_chapter_args', array( $this, 'remove_editor_for_comic' ) );
		add_filter( 'pre_wp_unique_post_slug', array( $this, 'allow_dupplicate_slug' ), 10, 6 );

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

		$post_type       = get_post_type_object( Cominovel_Post_Types::check_active_data_type() );
		$this->post_type = $parent_data_type;
		add_meta_box(
			'cominovel_comic_of_chapter',
			sprintf( __( 'Choose %s', 'cominovel' ), $post_type->labels->singular_name ),
			array( $this, 'choose_chapter_parent' ),
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

	public function choose_chapter_parent( $post ) {
		$posts = get_posts(
			array(
				'post_type'      => $this->post_type,
				'posts_per_page' => -1,
			)
		);
		cominovel_core_template( 'admin/metaboxes/choose-parent', compact( 'post', 'posts' ) );
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
			if ( empty( $_GET['post'] ) ) {
				return $args;
			}
			$post = get_post( $_GET['post'] );
			if ( $post->post_parent <= 0 || $post->post_type !== 'chapter' ) {
				return $args;
			}
			if ( get_post_type( $post->post_parent ) !== 'comic' ) {
				return $args;
			}
		}
		$supports = $args['supports'];
		$index    = array_search( 'editor', $supports );
		if ( $index !== false ) {
			unset( $supports[ $index ] );
		}
		$args['supports'] = array_values( $supports );
		return $args;
	}

	public function save_chapter_data( $post_id, $post ) {
		if ( $post->post_type !== 'chapter' ) {
			return;
		}
		$post->post_parent = $_POST['post_parent'];
	}

	public function allow_dupplicate_slug( $pre, $slug, $post_ID, $post_status, $post_type, $post_parent ) {
		if ( $post_type === 'chapter' ) {
			return sanitize_title( get_the_title( $post_ID ) );
		}
		return $pre;
	}
}
new Cominovel_Metabox_Chapter_Data();
