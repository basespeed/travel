<?php
if($_SESSION['sucess'] == "sucess") {
    acf_form_head();
    get_header();
    ?>
    <?php
    if (is_singular('giao_dich') && is_single()) {
        get_template_part('template-parts/single/sua-giao-dich');
    } elseif (is_singular('history_giao_dich') && is_single()) {
        get_template_part('template-parts/single/history-giao-dich');
    } elseif (is_singular('tai_khoan') && is_single()) {
        get_template_part('template-parts/single/single_user');
    } elseif (is_singular('hotel') && is_single()) {
        get_template_part('template-parts/single/single_khach_san');
    } elseif (is_singular('nhan_vien') && is_single()) {
        get_template_part('template-parts/single/single_nhan_vien');
    } elseif (is_singular('ctv') && is_single()) {
        get_template_part('template-parts/single/single_ctv');
    }elseif (is_singular('doi_tac') && is_single()) {
        get_template_part('template-parts/single/single_doi_tac');
    }elseif (is_singular('tien') && is_single()) {
        get_template_part('template-parts/single/single_giao_dich_tien');
    }elseif (is_singular('km') && is_single()) {
        get_template_part('template-parts/single/single_khuyen_mai');
    }elseif (is_singular('khach_hang') && is_single()) {
        get_template_part('template-parts/single/single_khach_hang');
    }
    ?>
    <?php
    get_footer();

}else{
    ob_start();
    header("Location: ".home_url('/'));
    exit();
}


