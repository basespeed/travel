<?php
function cw_post_type_news_nv() {
    $supports = array(
        'title', // post title
    );
    $labels = array(
        'name' => _x('Nhân viên', 'travel'),
        'singular_name' => _x('Nhân viên', 'singular'),
        'menu_name' => _x('Nhân viên', 'admin menu'),
        'name_admin_bar' => _x('Nhân viên', 'admin bar'),
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
    register_post_type('nhan_vien', $args);
}
add_action('init', 'cw_post_type_news_nv');


