<?php
add_action("wp_ajax_check_logout", "check_logout");
add_action("wp_ajax_nopriv_check_logout", "check_logout");

function check_logout() {
    unset($_SESSION['sucess']);
    unset($_SESSION['avatar']);
    unset($_SESSION['name']);

    $data = home_url('/');
    wp_send_json_success($data);

    die();
}