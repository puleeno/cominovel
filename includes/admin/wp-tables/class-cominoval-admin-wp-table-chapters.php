<?php
class Cominoval_Admin_Wp_Table_Chapters {

	protected $current_screen;

	public function __construct() {
		add_action( 'current_screen', array( $this, 'get_current_screen' ) );
		add_filter( 'manage_chapter_posts_columns', array( $this, 'featured_image_column' ) );
		add_filter( 'manage_chapter_posts_custom_column', array( $this, 'feature_column' ), 10, 2 );
	}

	public function get_current_screen() {
		$current_screen       = get_current_screen();
		$this->current_screen = $current_screen->id;
	}

	public function featured_image_column( $columns ) {
		$replace_columns              = array_slice( $columns, 0, 1 );
		$replace_columns['thumbnail'] = __( 'Thumbnail', 'cominovel' );

		return array_merge( $replace_columns, $columns );
	}

	public function feature_column( $column, $post_id ) {

		if ( 'thumbnail' === $column ) {
			echo '<a href="' . get_edit_post_link() . '">';
			if ( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, array( 70, 70 ) );
			} else {
				// Image placeholder
				cominovel_core_template( 'default/image-placeholder', [], 'admin' );
			}
			echo '</a>';
		}
	}
}

new Cominoval_Admin_Wp_Table_Chapters();
