<?php
function cw_post_type_khach_san() {
    $supports = array(
        'title', // post title
    );
    $labels = array(
        'name' => _x('Khách sạn', 'travel'),
        'singular_name' => _x('Khách sạn', 'singular'),
        'menu_name' => _x('Khách sạn', 'admin menu'),
        'name_admin_bar' => _x('Khách sạn', 'admin bar'),
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
    register_post_type('khach_san', $args);
}
//add_action('init', 'cw_post_type_khach_san');


function cw_post_type_hotel()
{
    $supports = array(
        'title', // post title
    );
    $labels = array(
        'name' => _x('Hotel', 'travel'),
        'singular_name' => _x('Hotel', 'singular'),
        'menu_name' => _x('Hotel', 'admin menu'),
        'name_admin_bar' => _x('Hotel', 'admin bar'),
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
    register_post_type('hotel', $args);
}

add_action('init', 'cw_post_type_hotel');





