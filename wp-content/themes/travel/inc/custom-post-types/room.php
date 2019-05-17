<?php
function cw_post_type_news_room() {
    $supports = array(
        'title', // post title
    );
    $labels = array(
        'name' => _x('Phòng khách sạn', 'travel'),
        'singular_name' => _x('Phòng khách sạn', 'singular'),
        'menu_name' => _x('Phòng khách sạn', 'admin menu'),
        'name_admin_bar' => _x('Phòng khách sạn', 'admin bar'),
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
        'menu_icon' => 'dashicons-building'
    );
    register_post_type('room', $args);
}
add_action('init', 'cw_post_type_news_room');


