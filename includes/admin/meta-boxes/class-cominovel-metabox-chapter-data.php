<?php
use Puleeno\Wallery\Wallery;
use Puleeno\Wallery\Factory\MetaboxFactory;

class Cominovel_Metabox_Chapter_Data {


	protected $wallery;
	protected $post_type;
	protected $is_chapter_edit;

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ), 5 );
		add_action( 'admin_head', array( $this, 'hide_editor_area' ) );
		add_action( 'save_post', array( $this, 'save_chapter_data' ), 10, 2 );
		add_action( 'save_post', array( $this, 'clean_cache_chapter' ) );

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

		$this->post_type = Cominovel_Post_Types::check_active_data_type(
			isset( $_GET['post'] ) ? $_GET['post'] : 0
		);

		add_meta_box(
			'cominovel_comic_of_chapter',
			__( 'Chapter Informations', 'cominovel' ),
			array( $this, 'chapter_information' ),
			'chapter',
			'side'
		);

		if ( ! empty( $this->wallery ) && $this->post_type === 'comic' ) {
			add_meta_box(
				'cominovel_chapter_images',
				__( 'Upload Chapter Images', 'cominovel' ),
				array( $this->wallery, 'render' ),
				'chapter',
				'advanced',
				'high'
			);
		}
	}

	public function chapter_information( $post ) {
		$posts          = get_posts(
			array(
				'post_type'      => $this->post_type,
				'posts_per_page' => -1,
			)
		);
		$post_type      = get_post_type_object( $this->post_type );
		$seasons        = Cominovel_Db_Query::query_seasons( $post->post_parent );
		$choosed_season = get_post_meta( $post->ID, '_season', true );
		cominovel_core_template(
			'metaboxes/chapter-info',
			compact( 'post', 'posts', 'post_type', 'seasons', 'choosed_season' ),
			'admin'
		);
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
			if ( empty( $post ) ) {
				return $args;
			}

			if ( $post && $post->post_parent <= 0 || $post->post_type !== 'chapter' ) {
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
		if ( 'chapter' !== $post->post_type || empty( $_POST['post_parent'] ) ) {
			return;
		}
		$post->post_parent = $_POST['post_parent'];

		if ( empty( $_POST['cominovel_seasons'] ) ) {
			delete_post_meta( $post_id, '_season' );
		} else {
			update_post_meta( $post_id, '_season', (int) $_POST['cominovel_seasons'] );
		}
	}

	public function allow_dupplicate_slug( $pre, $slug, $post_ID, $post_status, $post_type, $post_parent ) {
		if ( 'chapter' === $post_type ) {
			return sanitize_title( get_the_title( $post_ID ) );
		}
		return $pre;
	}

	public function clean_cache_chapter( $post_ID ) {
		/**
		 * Make the chapter images transient key from Post ID
		 */
		$image_cache_key = sprintf( 'cominovel_comic_%d_images', $post_ID );

		/**
		 * Delete the chapter images transient when update the chapter
		 */
		delete_transient( $image_cache_key );
	}
}
new Cominovel_Metabox_Chapter_Data();
