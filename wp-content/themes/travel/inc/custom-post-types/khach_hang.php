<?php
function cw_post_type_khach_hang() {
    $supports = array(
        'title', // post title
    );
    $labels = array(
        'name' => _x('Khách hàng', 'travel'),
        'singular_name' => _x('Khách hàng', 'singular'),
        'menu_name' => _x('Khách hàng', 'admin menu'),
        'name_admin_bar' => _x('Khách hàng', 'admin bar'),
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
        'menu_icon' => 'dashicons-groups'
    );
    register_post_type('khach_hang', $args);
}
add_action('init', 'cw_post_type_khach_hang');


