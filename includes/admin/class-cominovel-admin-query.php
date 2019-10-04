<?php
class Cominovel_Admin_Query {
    public function __construct() {
        add_filter('posts_where', array($this, 'filter_chapters'), 10, 2);
        // add_filter('posts_where', array($this, 'filter_chapter_post_count'));
    }

    public function filter_chapters($where, $query) {
        if ($query->query_vars['post_type'] !== 'chapter') {
            return $where;
        }

        global $wpdb;
        $post_type = Cominovel_Post_Types::check_active_data_type();
        $filter_chapter = sprintf(
            '%1$s.post_parent IN(SELECT ID FROM %1$s WHERE post_type IN("%2$s"))',
            $wpdb->posts,
            $post_type,
        );
        $where = sprintf('AND %s %s', $filter_chapter, $where) . $where;

        return $where;
    }

    public function filter_chapter_post_count() {
    }
}

new Cominovel_Admin_Query();
