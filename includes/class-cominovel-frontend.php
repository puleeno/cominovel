<?php
class Cominovel_Frontend {

	public static function init() {
		add_action( 'admin_bar_menu', array( __CLASS__, 'change_edit_chapter_link_to_comic' ), 999 );
		add_filter( 'cominovel_edit_comic_node', array( __CLASS__, 'edit_comic_node' ), 10, 2 );
		add_action( 'widgets_init', array( __CLASS__, 'register_sidebar' ), 15 );
		add_action( 'admin_bar_menu', array( __CLASS__, 'add_edit_chapter_link' ), 75 );
		add_action( 'excerpt_length', array( __CLASS__, 'limit_the_short_description' ) );
		add_filter( 'excerpt_more', array( __CLASS__, 'dyad_excerpt_continue_reading' ) );
	}

	public function change_edit_chapter_link_to_comic( $wp_admin_bar ) {
		$comic_object = get_post_type_object( 'comic' );
		if ( ! isset( $comic_object->labels->edit_item ) ) {
			return;
		}

		$all_toolbar_nodes = $wp_admin_bar->get_nodes();
		foreach ( $all_toolbar_nodes as $node ) {
			if ( $node->title === $comic_object->labels->edit_item && ! $node->parent && $node->id === 'edit' ) {
				$queried_object = get_queried_object();
				$args           = apply_filters( 'cominovel_edit_comic_node', $node, $queried_object, $comic_object );
				$wp_admin_bar->add_node( $args );
			}
		}
	}

	public static function edit_comic_node( $node, $queried_object ) {
		if ( $queried_object->post_parent === 0 ) {
			$node->href = get_edit_post_link( $queried_object );
			return $node;
		}
		return self::edit_comic_node( $node, get_post( $queried_object->post_parent ) );
	}

	public static function register_sidebar() {
		register_sidebar(
			array(
				'name'          => __( 'Cominovel Single', 'cominovel' ),
				'id'            => 'cominovel_single',
				'description'   => __( 'Widgets in this area will be shown on comic or novel single page.', 'cominovel' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
	}

	public static function add_edit_chapter_link( $wp_admin_bar ) {
		if ( 'chapter' !== get_post_type() ) {
			return;
		}
		$args = array(
			'id'    => 'edit-chapter',
			'title' => __( 'Edit Chapter', 'cominovel' ),
			'href'  => get_edit_post_link(),
			'meta'  => array(
				'class' => 'edit-chapter',
			),
		);
		$wp_admin_bar->add_node( $args );
	}

	public static function limit_the_short_description( $length ) {
		if ( in_array( get_post_type(), array( 'comic', 'novel' ) ) ) {
			return 15;
		}
		return $length;
	}

	public static function dyad_excerpt_continue_reading( $readmore ) {
		if ( in_array( get_post_type(), array( 'comic', 'novel' ) ) ) {
			return '...';
		}
		return $readmore;
	}
}

Cominovel_Frontend::init();
