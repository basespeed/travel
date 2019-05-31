<?php
add_action("wp_ajax_setKhachDaiDien", "setKhachDaiDien");
add_action("wp_ajax_nopriv_setKhachDaiDien", "setKhachDaiDien");

function setKhachDaiDien() {
    $keyword = $_POST['keyword'];

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
            
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'khach_hang'
                    AND postmeta1.meta_key = 'ten_kgd'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 10
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'khach_hang'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
                ?>
                <ul>
                    <li><?php
                        $str = get_field('ten_kgd');
                        $str = str_replace($keyword, " <strong> " . $keyword . " </strong> ", $str);
                        echo $str;
                        ?></li>
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
            wp_reset_postdata();
        }
    }else{
        ?>
        <p>
            <span>Khách tồn tại ! </span>
            <a href="<?php echo get_home_url(); ?>/them-khach-hang" target="_blank">Thêm khách mới</a>
        </p>
        <?php
    }


    die();
}

add_action("wp_ajax_setKhachDaiDienSDT", "setKhachDaiDienSDT");
add_action("wp_ajax_nopriv_setKhachDaiDienSDT", "setKhachDaiDienSDT");

function setKhachDaiDienSDT() {
    $keyword = $_POST['keyword'];

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
            
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'khach_hang'
                    AND postmeta1.meta_key = 'sdt_kgd'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 10
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'khach_hang'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
                ?>
                <ul>
                    <li><?php echo get_field('ten_kgd'); ?></li>
                    <li><?php
                        $str = get_field('sdt_kgd');
                        $str = str_replace($keyword, " <strong> " . $keyword . " </strong> ", $str);
                        echo $str;
                        ?></li>
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
            wp_reset_postdata();
        }
    }else{
        echo 'empty';
    }


    die();
}

add_action("wp_ajax_setKhachDaiDienTenKgd", "setKhachDaiDienTenKgd");
add_action("wp_ajax_nopriv_setKhachDaiDienTenKgd", "setKhachDaiDienTenKgd");

function setKhachDaiDienTenKgd() {
    $keyword = $_POST['keyword'];

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
            
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'khach_hang'
                    AND postmeta1.meta_key = 'ten_kgd'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 10
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'khach_hang'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
                ?>
                <ul>
                    <li><?php
                        $str = get_field('ten_kgd');
                        $str = str_replace($keyword, " <strong> " . $keyword . " </strong> ", $str);
                        echo $str;
                        ?></li>
                    <li><input type="text" value="<?php echo get_field('sdt_kgd'); ?>"></li>
                    <li><?php
                        $str = get_field('email_kgd_duy_nhat');
                        $str = str_replace($keyword, " <strong> " . $keyword . " </strong> ", $str);
                        echo $str;
                        ?></li>
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
            wp_reset_postdata();
        }
    }else{
        ?>
        <p>
            <span>Tên khách giao dịch không tồn tại ! </span>
            <a href="<?php echo get_home_url(); ?>/them-khach-hang" target="_blank">Thêm khách mới</a>
        </p>
        <?php
    }

    die();
}


add_action("wp_ajax_setNickKgd", "setNickKgd");
add_action("wp_ajax_nopriv_setNickKgd", "setNickKgd");

function setNickKgd() {
    $keyword = $_POST['keyword'];

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
            
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'khach_hang'
                    AND postmeta1.meta_key = 'nick_kgd'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 10
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'khach_hang'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
                ?>
                <ul>
                    <li><?php
                        $str = get_field('ten_kgd');
                        $str = str_replace($keyword, " <strong> " . $keyword . " </strong> ", $str);
                        echo $str;
                        ?></li>
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
            wp_reset_postdata();
        }
    }else{
        echo 'empty';
    }

    //wp_send_json_success('ajax');


    die();
}

add_action("wp_ajax_setSdtKgd", "setSdtKgd");
add_action("wp_ajax_nopriv_setSdtKgd", "setSdtKgd");

function setSdtKgd() {
    $keyword = $_POST['keyword'];

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
            
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'khach_hang'
                    AND postmeta1.meta_key = 'sdt_kgd'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 10
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'khach_hang'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
                ?>
                <ul>
                    <li><?php
                        $str = get_field('ten_kgd');
                        $str = str_replace($keyword, " <strong> " . $keyword . " </strong> ", $str);
                        echo $str;
                        ?></li>
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
            wp_reset_postdata();
        }
    }else{
        echo 'empty';
    }

    die();
}

add_action("wp_ajax_setEmail_kgd_duy_nhat", "setEmail_kgd_duy_nhat");
add_action("wp_ajax_nopriv_setEmail_kgd_duy_nhat", "setEmail_kgd_duy_nhat");

function setEmail_kgd_duy_nhat() {
    $keyword = $_POST['keyword'];

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
            
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'khach_hang'
                    AND postmeta1.meta_key = 'email_kgd_duy_nhat'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 10
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'khach_hang'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
                ?>
                <ul>
                    <li><?php
                        $str = get_field('ten_kgd');
                        $str = str_replace($keyword, " <strong> " . $keyword . " </strong> ", $str);
                        echo $str;
                        ?></li>
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
            wp_reset_postdata();
        }
    }else{
        echo 'empty';
    }

    //wp_send_json_success('ajax');


    die();
}



add_action("wp_ajax_setTk_kgd", "setTk_kgd");
add_action("wp_ajax_nopriv_setTk_kgd", "setTk_kgd");

function setTk_kgd() {
    $keyword = $_POST['keyword'];

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
            
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'khach_hang'
                    AND postmeta1.meta_key = 'tk_kgd'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 10
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'khach_hang'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
                ?>
                <ul>
                    <li><?php
                        $str = get_field('ten_kgd');
                        $str = str_replace($keyword, " <strong> " . $keyword . " </strong> ", $str);
                        echo $str;
                        ?></li>
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
            wp_reset_postdata();
        }
    }else{
        echo 'empty';
    }

    //wp_send_json_success('ajax');


    die();
}


add_action("wp_ajax_setMa_kgd", "setMa_kgd");
add_action("wp_ajax_nopriv_setMa_kgd", "setMa_kgd");

function setMa_kgd() {
    $keyword = $_POST['keyword'];

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
            
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'khach_hang'
                    AND postmeta1.meta_key = 'ma_kgd'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 10
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'khach_hang'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
                ?>
                <ul>
                    <li><?php
                        $str = get_field('ten_kgd');
                        $str = str_replace($keyword, "<strong> " . $keyword . " </strong> ", $str);
                        echo $str;
                        ?></li>
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
            wp_reset_postdata();
        }
    }else{
        echo 'empty';
    }
    //wp_send_json_success('ajax');


    die();
}


add_action("wp_ajax_set_pop_ten_dt_gui_book_dt", "set_pop_ten_dt_gui_book_dt");
add_action("wp_ajax_nopriv_set_pop_ten_dt_gui_book_dt", "set_pop_ten_dt_gui_book_dt");

function set_pop_ten_dt_gui_book_dt() {
    $keyword = $_POST['keyword'];

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
            
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'doi_tac'
                    AND postmeta1.meta_key = 'ten_dt'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 10
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'doi_tac'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
                ?>
                <ul>
                    <li><?php
                        $str = get_field('ten_dt');
                        $str = str_replace($keyword, "<strong> " . $keyword . " </strong> ", $str);
                        echo $str;
                        ?></li>
                    <li><input type="text" value="<?php echo get_field('sdt_dt'); ?>"></li>
                    <li><input type="email" value="<?php echo get_field('email_dt'); ?>"></li>
                    <li><input type="text" value="<?php echo get_field('stk_dt'); ?>"></li>
                    <li>
                        <input type="text" value="<?php echo get_field('don_vi_cong_tac_dt'); ?>">
                        <input type="hidden" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>">
                        <input type="hidden" class="ten" value="<?php echo get_field('ten_dt'); ?>">
                        <input type="hidden" class="sdt" value="<?php echo get_field('sdt_dt'); ?>">
                        <input type="hidden" class="email" value="<?php echo get_field('email_dt'); ?>">
                        <input type="hidden" class="tk" value="<?php echo get_field('stk_dt'); ?>">
                        <input type="hidden" class="don_vi_cong_tac_dt" value="<?php echo get_field('don_vi_cong_tac_dt'); ?>">
                        <input type="hidden" class="mdt" value="<?php echo get_field('ma_dt'); ?>">
                    </li>
                </ul>
            <?php
            endwhile;
            wp_reset_postdata();
        }
    }else{
        ?>
        <p>
            <span>Đối tác không tồn tại ! </span>
            <a href="<?php echo get_home_url(); ?>/them-moi-doi-tac" target="_blank">Thêm đối tác</a>
        </p>
        <?php
    }
    //wp_send_json_success('ajax');


    die();
}

add_action("wp_ajax_setMGDLK", "setMGDLK");
add_action("wp_ajax_nopriv_setMGDLK", "setMGDLK");

function setMGDLK() {
    $keyword = $_POST['keyword'];

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
            
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'giao_dich'
                    AND postmeta1.meta_key = 'ma_gd_con'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 10
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'giao_dich'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
                ?>
                <ul>
                    <li><?php
                        $str = get_field('ten_kgd');
                        $str = str_replace($keyword, "<strong> " . $keyword . " </strong>", $str);
                        echo $str;
                        ?></li>
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
            wp_reset_postdata();
        }
    }else{
        echo 'empty';
    }
    //wp_send_json_success('ajax');


    die();
}


//select tên khách sạn giao dịch
add_action("wp_ajax_pop_ten_khach_san_gd", "pop_ten_khach_san_gd");
add_action("wp_ajax_nopriv_pop_ten_khach_san_gd", "pop_ten_khach_san_gd");

function pop_ten_khach_san_gd() {
    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
            
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'hotel'
                    AND postmeta1.meta_key = 'hotel_name'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 10
                ");
    /*foreach ($search_query as $data){
        setup_postdata($data);
        the_title();
        echo '</br>';
        wp_reset_postdata();
    }*/

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'hotel'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
            ?>
            <ul>
                <li><span><?php
                    $str = get_field('hotel_name');
                    $str = str_replace($keyword,"<strong>".$keyword."</strong>",$str);
                    echo $str;
                ?></span></li>
                <li><input type="text" value="<?php echo get_field('numberrooms'); ?>"></li>
                <li><input type="text" value="<?php echo get_field('city'); ?>"></li>
                <li><input type="text" value="<?php echo get_field('state'); ?>"></li>
                <li>
                    <input type="text" value="<?php echo get_field('country'); ?>">
                    <input type="hidden" class="id_ks_gd" value="<?php echo get_the_ID(); ?>"/>
                    <input type="hidden" class="hotel_name" value="<?php echo get_field('hotel_name'); ?>"/>
                </li>
            </ul>
            <?php
            endwhile;
            wp_reset_postdata();
        }
    }else{
        ?>
        <p>
            <span>Khách sạn không tồn tại ! </span>
            <a href="<?php echo get_home_url(); ?>/them-moi-khach-san" target="_blank">Thêm khách sạn</a>
        </p>
        <?php
    }
    //wp_send_json_success('ajax');


    die();
}