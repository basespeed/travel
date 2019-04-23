<?php
add_action("wp_ajax_check_logout", "check_logout");
add_action("wp_ajax_nopriv_check_logout", "check_logout");

function check_logout() {
    $update_ctv = array(
        'ID'           => $_SESSION['user_id'],
    );
    $post_id = wp_update_post($update_ctv);
    update_field( 'check_online', 'off', $post_id );

    unset($_SESSION['sucess']);
    unset($_SESSION['avatar']);
    unset($_SESSION['name']);
    unset($_SESSION['user_id']);
    unset($_SESSION['lien_ket_tai_khoan']);

    $data = home_url('/');
    wp_send_json_success($data);

    die();
}