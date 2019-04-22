<?php
add_action("wp_ajax_delete_tai_khoan", "delete_tai_khoan");
add_action("wp_ajax_nopriv_delete_tai_khoan", "delete_tai_khoan");

function delete_tai_khoan() {
    unlink(get_template_directory().'/template-parts/images/'.$_POST['data_img']);
    die();
}

