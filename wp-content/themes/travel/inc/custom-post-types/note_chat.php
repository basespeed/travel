<?php
function cw_post_type_news_note_chat() {
    $supports = array(
        'title', // post title
    );
    $labels = array(
        'name' => _x('Note Chat', 'travel'),
        'singular_name' => _x('Note Chat', 'singular'),
        'menu_name' => _x('Note Chat', 'admin menu'),
        'name_admin_bar' => _x('Note Chat', 'admin bar'),
        'add_new' => _x('Thêm mới', 'add new'),
        'add_new_item' => __('Thêm mới'),
        'new_item' => __('New news'),
        'edit_item' => __('Sửa'),
        'view_item' => __('Xem'),
        'all_items' => __('Tất cả'),
        'search_items' => __('Tìm kiếm'),
        'not_found' => __('No news found.'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-edit'
    );
    register_post_type('note_chat', $args);
}
add_action('init', 'cw_post_type_news_note_chat');


