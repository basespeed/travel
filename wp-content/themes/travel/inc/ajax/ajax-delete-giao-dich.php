<?php
add_action("wp_ajax_delete_giao_dich", "delete_giao_dich");
add_action("wp_ajax_nopriv_delete_giao_dich", "delete_giao_dich");

function delete_giao_dich() {

    $data_id = (isset($_POST['data_id']))?esc_attr($_POST['data_id']) : '';

    $query = new WP_Query(array(
        'post_type' => 'giao_dich',
        'p' => $data_id,
    ));

    //lịch sử giao dịch
    $add_lich_su_giao_dich = array(
        'post_title' => $_POST['ten_khach_san_gd'],
        'post_status' => 'publish',
        'post_type' => 'history_giao_dich',
    );

    $post_lich_su_gd = wp_insert_post($add_lich_su_giao_dich);

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date('d-m-Y H:i:s');

    while ($query->have_posts()) : $query->the_post();

        $group_ID_ls = '6';
        $fields_ls = acf_get_fields($group_ID_ls);
        foreach ($fields_ls as $field){
            if($field['name'] != ""){
                add_post_meta($post_lich_su_gd, $field['name'], get_field($field['name']), true);
            }
        }

        add_post_meta($post_lich_su_gd, 'nguoi_sua', $_SESSION['name'], true);
        add_post_meta($post_lich_su_gd, 'hanh_dong', 'Xóa giao dịch', true);
        add_post_meta($post_lich_su_gd, 'thoi_gian_sua', $date, true);

    endwhile;
    wp_reset_postdata();

    die();

}