<?php
add_action("wp_ajax_setKhachDaiDien", "setKhachDaiDien");
add_action("wp_ajax_nopriv_setKhachDaiDien", "setKhachDaiDien");

function setKhachDaiDien() {
    $keyword = $_POST['keyword'];

    $query = new WP_Query(array(
        'post_type' => 'khach_hang',
        'posts_per_page' => 5,
        'order' => 'DESC',
        'meta_key'		=> 'ten_kgd',
        'meta_value' => '^' . preg_quote( $keyword ),
        'meta_compare' => 'RLIKE',
    ));

    $data = array();

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        ?>
        <ul>
            <li><?php echo get_field('ten_kgd'); ?></li>
            <li><input type="text" value="<?php echo get_field('sdt_kgd'); ?>"></li>
            <li><input type="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>"></li>
            <li><input type="text" value="<?php echo get_field('tk_kgd'); ?>"></li>
            <li>
                <input type="text" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
                <input type="hidden" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>">
                <input type="hidden" class="ten" value="<?php echo get_field('ten_kgd'); ?>">
                <input type="hidden" class="sdt" value="<?php echo get_field('sdt_kgd'); ?>">
                <input type="hidden" class="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>">
                <input type="hidden" class="tk" value="<?php echo get_field('tk_kgd'); ?>">
                <input type="hidden" class="nick" value="<?php echo get_field('nick_kgd'); ?>">
                <input type="hidden" class="link" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
            </li>
        </ul>
    <?php
    endwhile;
    else :
    echo 'empty';
    endif;
    wp_reset_postdata();

    //wp_send_json_success('ajax');


    die();
}

add_action("wp_ajax_setKhachDaiDienSDT", "setKhachDaiDienSDT");
add_action("wp_ajax_nopriv_setKhachDaiDienSDT", "setKhachDaiDienSDT");

function setKhachDaiDienSDT() {
    $keyword = $_POST['keyword'];

    $query = new WP_Query(array(
        'post_type' => 'khach_hang',
        'posts_per_page' => 5,
        'order' => 'DESC',
        'meta_key'		=> 'sdt_kgd',
        'meta_value' => '^' . preg_quote( $keyword ),
        'meta_compare' => 'RLIKE',
    ));

    $data = array();

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        ?>
        <ul>
            <li><?php echo get_field('ten_kgd'); ?></li>
            <li><input type="text" value="<?php echo get_field('sdt_kgd'); ?>"></li>
            <li><input type="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>"></li>
            <li><input type="text" value="<?php echo get_field('tk_kgd'); ?>"></li>
            <li>
                <input type="text" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
                <input type="hidden" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>">
                <input type="hidden" class="ten" value="<?php echo get_field('ten_kgd'); ?>">
                <input type="hidden" class="sdt" value="<?php echo get_field('sdt_kgd'); ?>">
                <input type="hidden" class="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>">
                <input type="hidden" class="tk" value="<?php echo get_field('tk_kgd'); ?>">
                <input type="hidden" class="nick" value="<?php echo get_field('nick_kgd'); ?>">
                <input type="hidden" class="link" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
            </li>
        </ul>
    <?php
    endwhile;
    else :
    echo 'empty';
    endif;
    wp_reset_postdata();

    //wp_send_json_success('ajax');


    die();
}

add_action("wp_ajax_setKhachDaiDienTenKgd", "setKhachDaiDienTenKgd");
add_action("wp_ajax_nopriv_setKhachDaiDienTenKgd", "setKhachDaiDienTenKgd");

function setKhachDaiDienTenKgd() {
    $keyword = $_POST['keyword'];

    $query = new WP_Query(array(
        'post_type' => 'khach_hang',
        'posts_per_page' => 5,
        'order' => 'DESC',
        'meta_key'		=> 'ten_kgd',
        'meta_value' => '^' . preg_quote( $keyword ),
        'meta_compare' => 'RLIKE',
    ));

    $data = array();

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        ?>
        <ul>
            <li><?php echo get_field('ten_kgd'); ?></li>
            <li><input type="text" value="<?php echo get_field('sdt_kgd'); ?>"></li>
            <li><input type="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>"></li>
            <li><input type="text" value="<?php echo get_field('tk_kgd'); ?>"></li>
            <li>
                <input type="text" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
                <input type="hidden" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>">
                <input type="hidden" class="ten" value="<?php echo get_field('ten_kgd'); ?>">
                <input type="hidden" class="sdt" value="<?php echo get_field('sdt_kgd'); ?>">
                <input type="hidden" class="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>">
                <input type="hidden" class="tk" value="<?php echo get_field('tk_kgd'); ?>">
                <input type="hidden" class="nick" value="<?php echo get_field('nick_kgd'); ?>">
                <input type="hidden" class="link" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
            </li>
        </ul>
    <?php
    endwhile;
    else :
    echo 'empty';
    endif;
    wp_reset_postdata();

    //wp_send_json_success('ajax');


    die();
}


add_action("wp_ajax_setNickKgd", "setNickKgd");
add_action("wp_ajax_nopriv_setNickKgd", "setNickKgd");

function setNickKgd() {
    $keyword = $_POST['keyword'];

    $query = new WP_Query(array(
        'post_type' => 'khach_hang',
        'posts_per_page' => 5,
        'order' => 'DESC',
        'meta_key'		=> 'nick_kgd',
        'meta_value' => '^' . preg_quote( $keyword ),
        'meta_compare' => 'RLIKE',
    ));

    $data = array();

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        ?>
        <ul>
            <li><?php echo get_field('ten_kgd'); ?></li>
            <li><input type="text" value="<?php echo get_field('sdt_kgd'); ?>"></li>
            <li><input type="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>"></li>
            <li><input type="text" value="<?php echo get_field('tk_kgd'); ?>"></li>
            <li>
                <input type="text" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
                <input type="hidden" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>">
                <input type="hidden" class="ten" value="<?php echo get_field('ten_kgd'); ?>">
                <input type="hidden" class="sdt" value="<?php echo get_field('sdt_kgd'); ?>">
                <input type="hidden" class="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>">
                <input type="hidden" class="tk" value="<?php echo get_field('tk_kgd'); ?>">
                <input type="hidden" class="nick" value="<?php echo get_field('nick_kgd'); ?>">
                <input type="hidden" class="link" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
            </li>
        </ul>
    <?php
    endwhile;
    else :
    echo 'empty';
    endif;
    wp_reset_postdata();

    //wp_send_json_success('ajax');


    die();
}

add_action("wp_ajax_setSdtKgd", "setSdtKgd");
add_action("wp_ajax_nopriv_setSdtKgd", "setSdtKgd");

function setSdtKgd() {
    $keyword = $_POST['keyword'];

    $query = new WP_Query(array(
        'post_type' => 'khach_hang',
        'posts_per_page' => 5,
        'order' => 'DESC',
        'meta_key'		=> 'sdt_kgd',
        'meta_value' => '^' . preg_quote( $keyword ),
        'meta_compare' => 'RLIKE',
    ));

    $data = array();

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        ?>
        <ul>
            <li><?php echo get_field('ten_kgd'); ?></li>
            <li><input type="text" value="<?php echo get_field('sdt_kgd'); ?>"></li>
            <li><input type="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>"></li>
            <li><input type="text" value="<?php echo get_field('tk_kgd'); ?>"></li>
            <li>
                <input type="text" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
                <input type="hidden" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>">
                <input type="hidden" class="ten" value="<?php echo get_field('ten_kgd'); ?>">
                <input type="hidden" class="sdt" value="<?php echo get_field('sdt_kgd'); ?>">
                <input type="hidden" class="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>">
                <input type="hidden" class="tk" value="<?php echo get_field('tk_kgd'); ?>">
                <input type="hidden" class="nick" value="<?php echo get_field('nick_kgd'); ?>">
                <input type="hidden" class="link" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
            </li>
        </ul>
    <?php
    endwhile;
    else :
    echo 'empty';
    endif;
    wp_reset_postdata();

    //wp_send_json_success('ajax');


    die();
}

add_action("wp_ajax_setEmail_kgd_duy_nhat", "setEmail_kgd_duy_nhat");
add_action("wp_ajax_nopriv_setEmail_kgd_duy_nhat", "setEmail_kgd_duy_nhat");

function setEmail_kgd_duy_nhat() {
    $keyword = $_POST['keyword'];

    $query = new WP_Query(array(
        'post_type' => 'khach_hang',
        'posts_per_page' => 5,
        'order' => 'DESC',
        'meta_key'		=> 'email_kgd_duy_nhat',
        'meta_value' => '^' . preg_quote( $keyword ),
        'meta_compare' => 'RLIKE',
    ));

    $data = array();

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        ?>
        <ul>
            <li><?php echo get_field('ten_kgd'); ?></li>
            <li><input type="text" value="<?php echo get_field('sdt_kgd'); ?>"></li>
            <li><input type="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>"></li>
            <li><input type="text" value="<?php echo get_field('tk_kgd'); ?>"></li>
            <li>
                <input type="text" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
                <input type="hidden" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>">
                <input type="hidden" class="ten" value="<?php echo get_field('ten_kgd'); ?>">
                <input type="hidden" class="sdt" value="<?php echo get_field('sdt_kgd'); ?>">
                <input type="hidden" class="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>">
                <input type="hidden" class="tk" value="<?php echo get_field('tk_kgd'); ?>">
                <input type="hidden" class="nick" value="<?php echo get_field('nick_kgd'); ?>">
                <input type="hidden" class="link" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
            </li>
        </ul>
    <?php
    endwhile;
    else :
    echo 'empty';
    endif;
    wp_reset_postdata();

    //wp_send_json_success('ajax');


    die();
}



add_action("wp_ajax_setTk_kgd", "setTk_kgd");
add_action("wp_ajax_nopriv_setTk_kgd", "setTk_kgd");

function setTk_kgd() {
    $keyword = $_POST['keyword'];

    $query = new WP_Query(array(
        'post_type' => 'khach_hang',
        'posts_per_page' => 5,
        'order' => 'DESC',
        'meta_key'		=> 'tk_kgd',
        'meta_value' => '^' . preg_quote( $keyword ),
        'meta_compare' => 'RLIKE',
    ));

    $data = array();

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        ?>
        <ul>
            <li><?php echo get_field('ten_kgd'); ?></li>
            <li><input type="text" value="<?php echo get_field('sdt_kgd'); ?>"></li>
            <li><input type="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>"></li>
            <li><input type="text" value="<?php echo get_field('tk_kgd'); ?>"></li>
            <li>
                <input type="text" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
                <input type="hidden" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>">
                <input type="hidden" class="ten" value="<?php echo get_field('ten_kgd'); ?>">
                <input type="hidden" class="sdt" value="<?php echo get_field('sdt_kgd'); ?>">
                <input type="hidden" class="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>">
                <input type="hidden" class="tk" value="<?php echo get_field('tk_kgd'); ?>">
                <input type="hidden" class="nick" value="<?php echo get_field('nick_kgd'); ?>">
                <input type="hidden" class="link" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
            </li>
        </ul>
    <?php
    endwhile;
    else :
    echo 'empty';
    endif;
    wp_reset_postdata();

    //wp_send_json_success('ajax');


    die();
}


add_action("wp_ajax_setMa_kgd", "setMa_kgd");
add_action("wp_ajax_nopriv_setMa_kgd", "setMa_kgd");

function setMa_kgd() {
    $keyword = $_POST['keyword'];

    $query = new WP_Query(array(
        'post_type' => 'khach_hang',
        'posts_per_page' => 5,
        'order' => 'DESC',
        'meta_key'		=> 'ma_kgd',
        'meta_value' => '^' . preg_quote( $keyword ),
        'meta_compare' => 'RLIKE',
    ));

    $data = array();

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        ?>
        <ul>
            <li><?php echo get_field('ten_kgd'); ?></li>
            <li><input type="text" value="<?php echo get_field('sdt_kgd'); ?>"></li>
            <li><input type="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>"></li>
            <li><input type="text" value="<?php echo get_field('tk_kgd'); ?>"></li>
            <li>
                <input type="text" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
                <input type="hidden" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>">
                <input type="hidden" class="ten" value="<?php echo get_field('ten_kgd'); ?>">
                <input type="hidden" class="sdt" value="<?php echo get_field('sdt_kgd'); ?>">
                <input type="hidden" class="email" value="<?php echo get_field('email_kgd_duy_nhat'); ?>">
                <input type="hidden" class="tk" value="<?php echo get_field('tk_kgd'); ?>">
                <input type="hidden" class="nick" value="<?php echo get_field('nick_kgd'); ?>">
                <input type="hidden" class="link" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
            </li>
        </ul>
    <?php
    endwhile;
    else :
    echo 'empty';
    endif;
    wp_reset_postdata();

    //wp_send_json_success('ajax');


    die();
}

