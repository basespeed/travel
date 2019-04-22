<?php
function cw_post_type_news_user() {
    $labels = array(
        'name' => _x('Tài khoản NV', 'travel'),
        'singular_name' => _x('Tài khoản NV', 'singular'),
        'menu_name' => _x('Tài khoản NV', 'admin menu'),
        'name_admin_bar' => _x('Tài khoản NV', 'admin bar'),
        'add_new' => _x('Thêm mới', 'add new'),
        'add_new_item' => __('Thêm mới'),
        'new_item' => __('Tài khoản NV NVmới'),
        'edit_item' => __('Sửa'),
        'view_item' => __('Xem'),
        'all_items' => __('Tất cả'),
        'search_items' => __('Tìm kiếm'),
        'not_found' => __('No news found.'),
    );
    $args = array(
        'supports' => array('title'),
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-admin-users'
    );
    register_post_type('tai_khoan', $args);
}
add_action('init', 'cw_post_type_news_user');


