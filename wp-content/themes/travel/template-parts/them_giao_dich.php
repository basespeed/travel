<?php
/*
 * Template Name: Giao dịch mới*/

if($_SESSION['sucess'] == "sucess") {

    get_header();

    ?>
    <div id="content">
        <div class="quantri_admin">
            <div class="menu_admin">
                <div class="info_user">
                    <div class="avatar">
                        <?php
                        if(isset($_SESSION['avatar'])){
                            echo '<img src="'.$_SESSION['avatar'].'" alt="Ảnh đại diện">';
                        }else{
                            echo '<img src="'.get_template_directory_uri().'/assets/images/user.png" alt="Ảnh đại diện">';
                        }
                        ?>

                    </div>
                    <div class="info">
                        <p><strong>Hi: </strong><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?> !</p>
                        <button class="logout">Logout</button>
                    </div>
                </div>
                <a href="<?php echo home_url('/') ?>ho-so" class="ho_so"><span class="dashicons dashicons-id"></span> Hồ sơ</a>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu',
                    'menu' => 'Admin'
                ));
                ?>
            </div>

            <div class="content_admin">
                <div class="them_giao_dich">
                    <form action="<?php echo home_url('/'); ?>them-giao-dich" method="post">
                        <?php
                        if (isset($_POST['sub_new_giao_dich'])) {
                            $add_new_giao_dich = array(
                                'post_title' => $_POST['ten_khach_san_gd_val'],
                                'post_status' => 'publish',
                                'post_type' => 'giao_dich',
                            );

                            $post_id = wp_insert_post($add_new_giao_dich);

                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $date_check = date('d-m-Y H:i:s');

                            $array_gd = array(
                                'post_type' => 'giao_dich',
                                'post_status' => 'publish'
                            );

                            $query = new WP_Query($array_gd);

                            if ($query->have_posts()) {
                                while ($query->have_posts()) : $query->the_post();
                                    /*if (get_field('ma_gd') == $_POST['ma_gd']) {
                                        $alert = "<p class='alert_tk_fail'>Mã giao dịch đã tồn tại !</p>";
                                    }elseif ($_POST['sl_dt'] != $_POST['sl_gd']) {
                                        $alert = "<p class='alert_tk_fail'>Số lượng phòng khách hàng và đối tác phải bằng nhau !</p>";
                                    }*//*elseif (get_field('ma_gd_hoan_tien_1') == $_POST['ma_gd_hoan_tien_1']) {
                                            $alert = "<p class='alert_tk_fail'>Mã giao dịch hoàn tiền khách đã tồn tại !</p>";
                                        }elseif (get_field('ma_gd_hoan_tien_2') == $_POST['ma_gd_hoan_tien_2']) {
                                            $alert = "<p class='alert_tk_fail'>Mã giao dịch hoàn tiền đối tác đã tồn tại !</p>";
                                        }*/
                                endwhile;
                                wp_reset_postdata();
                            }

                            if(! isset($alert)){
                                $group_ID = '6';
                                $fields = acf_get_fields($group_ID);
                                foreach ($fields as $field){
                                    if($field['name'] == 'ci_gd'){
                                        $dob_str = $_POST['ci_gd'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ci_gd', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'co_gd'){
                                        $dob_str = $_POST['co_gd'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('co_gd', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_duoc_huy'){
                                        $dob_str = $_POST['ngay_duoc_huy'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_duoc_huy', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_duoc_thay_doi'){
                                        $dob_str = $_POST['ngay_duoc_thay_doi'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_duoc_thay_doi', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_yeu_cau_kh_hoan_tat_tt_khac'){
                                        $dob_str = $_POST['ngay_yeu_cau_kh_hoan_tat_tt_khac'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_yeu_cau_kh_hoan_tat_tt_khac', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_hoan_tat_tt_cho_ks_khac2'){
                                        if(!empty($dob_str)){
                                            $dob_str = $_POST['ngay_phai_hoan_tat_tt_cho_ks_khac2'];
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_hoan_tat_tt_cho_ks_khac2', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_coc_1'){
                                        $dob_str = $_POST['ngay_coc_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_coc_1', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_tt_lan_2_1'){
                                        $dob_str = $_POST['ngay_tt_lan_2_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_tt_lan_2_1', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_tt_lan_3_1'){
                                        $dob_str = $_POST['ngay_tt_lan_3_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_tt_lan_3_1', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_hoan_tien_1'){
                                        $dob_str = $_POST['ngay_hoan_tien_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_hoan_tien_1', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_coc_di_2'){
                                        $dob_str = $_POST['ngay_phai_coc_di_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_coc_di_2', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_di_lan_2_2'){
                                        $dob_str = $_POST['ngay_phai_di_lan_2_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_di_lan_2_2', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_di_lan_3_2'){
                                        $dob_str = $_POST['ngay_phai_di_lan_3_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_di_lan_3_2', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_hoan_tien_2'){
                                        $dob_str = $_POST['ngay_hoan_tien_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_hoan_tien_2', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_lock_phong_khach'){
                                        $dob_str = $_POST['ngay_lock_phong_khach'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_lock_phong_khach', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_lock_phong_doi_tac'){
                                        $dob_str = $_POST['ngay_lock_phong_doi_tac'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_lock_phong_doi_tac', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ma_gd_con'){
                                        $dob_str = 'MLK_'.$post_id;
                                        add_post_meta($post_id, 'ma_gd_con', $dob_str, true);
                                    }elseif($field['name'] == 'ma_gd_them_booking'){
                                        $dob_str = 'BTC_'.$post_id;
                                        add_post_meta($post_id, 'ma_gd_them_booking', $dob_str, true);
                                    }elseif($field['name'] == 'ma_gd'){
                                        $dob_str = 'MBK_'.$post_id;
                                        add_post_meta($post_id, 'ma_gd', $dob_str, true);
                                    }else{
                                        if($field['name'] != ""){
                                            add_post_meta($post_id, $field['name'], $_POST[$field['name']], true);
                                        }
                                    }

                                }

                                //lịch sử giao dịch
                                $add_lich_su_giao_dich = array(
                                    'post_status' => 'publish',
                                    'post_type' => 'history_giao_dich',
                                    'post_title' => $_POST['ten_khach_san_gd_val'],
                                );

                                $post_lich_su_gd = wp_insert_post($add_lich_su_giao_dich);

                                $group_ID_ls = '6';
                                $fields_ls = acf_get_fields($group_ID_ls);
                                foreach ($fields_ls as $field){
                                    if($field['name'] == 'ci_gd'){
                                        $dob_str = $_POST['ci_gd'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ci_gd', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'co_gd'){
                                        $dob_str = $_POST['co_gd'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('co_gd', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_duoc_huy'){
                                        $dob_str = $_POST['ngay_duoc_huy'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_duoc_huy', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_duoc_thay_doi'){
                                        $dob_str = $_POST['ngay_duoc_thay_doi'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_duoc_thay_doi', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_yeu_cau_kh_hoan_tat_tt_khac'){
                                        $dob_str = $_POST['ngay_yeu_cau_kh_hoan_tat_tt_khac'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_yeu_cau_kh_hoan_tat_tt_khac', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_hoan_tat_tt_cho_ks_khac2'){
                                        $dob_str = $_POST['ngay_phai_hoan_tat_tt_cho_ks_khac2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_hoan_tat_tt_cho_ks_khac2', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_coc_1'){
                                        $dob_str = $_POST['ngay_coc_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_coc_1', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_tt_lan_2_1'){
                                        $dob_str = $_POST['ngay_tt_lan_2_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_tt_lan_2_1', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_tt_lan_3_1'){
                                        $dob_str = $_POST['ngay_tt_lan_3_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_tt_lan_3_1', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_hoan_tien_1'){
                                        $dob_str = $_POST['ngay_hoan_tien_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_hoan_tien_1', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_coc_di_2'){
                                        $dob_str = $_POST['ngay_phai_coc_di_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_coc_di_2', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_di_lan_2_2'){
                                        $dob_str = $_POST['ngay_phai_di_lan_2_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_di_lan_2_2', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_di_lan_3_2'){
                                        $dob_str = $_POST['ngay_phai_di_lan_3_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_di_lan_3_2', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_hoan_tien_2'){
                                        $dob_str = $_POST['ngay_hoan_tien_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_hoan_tien_2', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_lock_phong_khach'){
                                        $dob_str = $_POST['ngay_lock_phong_khach'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_lock_phong_khach', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ngay_lock_phong_doi_tac'){
                                        $dob_str = $_POST['ngay_lock_phong_doi_tac'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_lock_phong_doi_tac', $date, $post_lich_su_gd);
                                        }
                                    }elseif($field['name'] == 'ma_gd_con'){
                                        $dob_str = 'MLK_'.$post_lich_su_gd;
                                        add_post_meta($post_lich_su_gd, 'ma_gd_con', $dob_str, true);
                                    }elseif($field['name'] == 'ma_gd_them_booking'){
                                        $dob_str = 'BTC_'.$post_lich_su_gd;
                                        add_post_meta($post_lich_su_gd, 'ma_gd_them_booking', $dob_str, true);
                                    }elseif($field['name'] == 'ma_gd'){
                                        $dob_str = 'MBK_'.$post_lich_su_gd;
                                        add_post_meta($post_lich_su_gd, 'ma_gd', $dob_str, true);
                                    }else{
                                        if($field['name'] != ""){
                                            add_post_meta($post_lich_su_gd, $field['name'], $_POST[$field['name']], true);
                                        }
                                    }
                                }

                                add_post_meta($post_lich_su_gd, 'nguoi_sua', $_SESSION['name'], true);
                                add_post_meta($post_lich_su_gd, 'hanh_dong', 'Thêm giao dịch', true);
                                add_post_meta($post_lich_su_gd, 'thoi_gian_sua', $date_check, true);


                                echo '<a href="'.get_permalink($post_id).'" class="rediret_to_single">rediret_to_single</a>';

                                wp_redirect(get_permalink($post_id));
                                exit;

                            }

                            if(isset($alert)){
                                echo '<p class="alert">'.$alert.'</p>';
                                echo '<a href="javascript:history.back()" class="phuc_hoi">Click phục hồi các giá trị vừa nhập để sửa lại !</a>';
                            }else{
                                echo $alert = "<p class='alert_tk_sucess'>Thêm giao dịch thành công !</p>";
                            }
                        }
                        ?>

                        <table width="100%" border="1">
                            <tbody>
                            <tr>
                                <td width="42%">
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="50%">Tên Khách sạn - Tên dịch vụ</td>
                                            <td>Mã dịch vụ</td>
                                        </tr>
                                        <td align="center"></td>
                                        <tr>
                                            <td width="50%">
                                                <input type="text" name="ten_khach_san_gd_val" class="ten_khach_san_gd_val" value="<?php
                                                if(!empty(get_field('ten_khach_san_gd'))){
                                                    $ten_khach_san_gd = get_field('ten_khach_san_gd');
                                                    if ( (int)$ten_khach_san_gd == $ten_khach_san_gd ) {
                                                        $query_name_hotel = new WP_Query(array(
                                                            'post_type' => 'hotel',
                                                            'p' => get_field('ten_khach_san_gd'),
                                                            'posts_per_page' => 1,
                                                        ));

                                                        if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                                                            echo get_the_title();
                                                        endwhile;
                                                        else :
                                                            echo get_field('ten_khach_san_gd');
                                                        endif;
                                                        wp_reset_postdata();
                                                    }else{
                                                        echo get_field('ten_khach_san_gd');
                                                    }
                                                }
                                                ?>" required autocomplete="off">
                                                <input type="hidden" value="<?php
                                                if(!empty(get_field('ten_khach_san_gd'))){
                                                    $ten_khach_san_gd = get_field('ten_khach_san_gd');
                                                    if ( (int)$ten_khach_san_gd == $ten_khach_san_gd ) {
                                                        $query_name_hotel = new WP_Query(array(
                                                            'post_type' => 'hotel',
                                                            'p' => get_field('ten_khach_san_gd'),
                                                            'posts_per_page' => 1,
                                                        ));

                                                        if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                                                            echo get_the_title();
                                                        endwhile;
                                                        else :
                                                            echo get_field('ten_khach_san_gd');
                                                        endif;
                                                        wp_reset_postdata();
                                                    }else{
                                                        echo get_field('ten_khach_san_gd');
                                                    }
                                                }
                                                ?>" class="title_new_post" />
                                                <input type="hidden" name="ten_khach_san_gd" class="ten_khach_san_gd" value="<?php echo get_field('ten_khach_san_gd'); ?>" autocomplete="off">
                                                <div class="pop_ten_khach_san_gd">
                                                    <ul>
                                                        <li>Hotel name</li>
                                                        <li>Numberrooms</li>
                                                        <li>City</li>
                                                        <li>State</li>
                                                        <li>Country</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" name="ma_dich_vu_gd_val" class="ma_dich_vu_gd_val" value="<?php
                                                if(!empty(get_field('ma_dich_vu_gd'))){
                                                    $ma_dich_vu_gd = get_field('ma_dich_vu_gd');
                                                    if ( (int)$ma_dich_vu_gd == $ma_dich_vu_gd ) {
                                                        $query_name_hotel = new WP_Query(array(
                                                            'post_type' => 'hotel',
                                                            'p' => get_field('ma_dich_vu_gd'),
                                                            'posts_per_page' => 1,
                                                        ));

                                                        if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                                                            //echo get_the_title();
                                                            echo to_slug(get_the_title()).'-'.get_the_ID();
                                                        endwhile;
                                                        else :
                                                            echo get_field('ma_dich_vu_gd');
                                                        endif;
                                                        wp_reset_postdata();
                                                    }else{
                                                        echo get_field('ma_dich_vu_gd');
                                                    }
                                                }
                                                ?>" required autocomplete="off"/>
                                                <input type="hidden" name="ma_dich_vu_gd" class="ma_dich_vu_gd" value="<?php echo get_field('ma_dich_vu_gd'); ?>" autocomplete="off"/>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="50%">Nơi đi (Hiển thị nếu chọn loại dịch vụ là VMB hoặc Xe)</td>
                                            <td>Nơi đến</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <select name="noi_di_gd" class="noi_di_gd" required>
                                                    <?php
                                                    //List các địa điểm đi và đến
                                                    $query_khach_san = new WP_Query(array(
                                                        'post_type' => 'dia_diem_local',
                                                        'posts_per_page' => 64,
                                                    ));
                                                    $n_check = 0;
                                                    if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                                        $n_check++;
                                                        if($n_check == 1){
                                                            ?><option value="<?php the_title(); ?>" selected="selected"><?php the_title(); ?></option><?php
                                                        }else{
                                                            ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                                        }
                                                    endwhile;
                                                    endif;
                                                    wp_reset_postdata();
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="noi_den_gd" class="noi_den_gd" required>
                                                    <?php
                                                    //List các địa điểm đi và đến
                                                    $query_khach_san = new WP_Query(array(
                                                        'post_type' => 'dia_diem_local',
                                                        'posts_per_page' => 64,
                                                    ));
                                                    $n_check = 1;
                                                    if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                                        $n_check++;
                                                        if($n_check == 3){
                                                            ?><option value="<?php the_title(); ?>" selected="selected"><?php the_title(); ?></option><?php
                                                        }else{
                                                            ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                                        }
                                                    endwhile;
                                                    endif;
                                                    wp_reset_postdata();
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;">
                                    MLK
                                    <input name="ma_gd_con" class="ma_gd_con" value="<?php echo 'MLK_ ...'; ?>" style="background: #FFF;" disabled/>
                                    Mã giao dịch
                                    <input name="ma_gd_them_booking" class="ma_gd_them_booking" style="background: #FFF;" value="<?php echo 'BTC_ ...'; ?>" disabled/>
                                </td>
                                <td width="42%">
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="80%">Tên ĐT gửi book - Đối tác gửi book có thể trùng hoặc khác
                                                với Đối tác cung cấp dịch vụ
                                            </td>
                                            <td>Mã ĐT</td>
                                        </tr>
                                        <tr>
                                            <td width="80%">
                                                <input name="ten_dt_gui_book_dt" class="ten_dt_gui_book_dt" value="" autocomplete="off"/>
                                                <div class="popup_get_data_list pop_ten_dt_gui_book_dt">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Đơn vị công tác</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><input type="text" name="ma_dt" class="ma_dt" value="<?php echo get_field('ma_dt'); ?>" autocomplete="off" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--<table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="50%">Nơi đi (Hiển thị nếu chọn loại dịch vụ là VMB hoặc Xe)</td>
                                            <td>Nơi đến</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <select name="noi_di_dt" class="noi_di_dt" required>
                                                    <?php
                                    /*                                                    //List các địa điểm đi và đến
                                                                                        $query_khach_san = new WP_Query(array(
                                                                                            'post_type' => 'dia_diem_local',
                                                                                            'posts_per_page' => 64,
                                                                                        ));
                                                                                        $n_check2 = 0;
                                                                                        if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                                                                            $n_check2++;
                                                                                            if($n_check2 == 1){
                                                                                                */?><option value="<?php /*the_title(); */?>" selected="selected"><?php /*the_title(); */?></option><?php
                                    /*                                                        }else{
                                                                                                */?><option value="<?php /*the_title(); */?>"><?php /*the_title(); */?></option><?php
                                    /*                                                        }
                                                                                        endwhile;
                                                                                        endif;
                                                                                        wp_reset_postdata();
                                                                                        */?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="noi_den_dt" class="noi_den_dt" required>
                                                    <?php
                                    /*                                                    //List các địa điểm đi và đến
                                                                                        $query_khach_san = new WP_Query(array(
                                                                                            'post_type' => 'dia_diem_local',
                                                                                            'posts_per_page' => 64,
                                                                                        ));
                                                                                        $n_check2 = 1;
                                                                                        if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                                                                            $n_check2++;
                                                                                            if($n_check2 == 3){
                                                                                                */?><option value="<?php /*the_title(); */?>" selected="selected"><?php /*the_title(); */?></option><?php
                                    /*                                                        }else{
                                                                                                */?><option value="<?php /*the_title(); */?>"><?php /*the_title(); */?></option><?php
                                    /*                                                        }
                                                                                        endwhile;
                                                                                        endif;
                                                                                        wp_reset_postdata();
                                                                                        */?>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="40%">Khách đại diện</td>
                                            <td width="20%">SĐT</td>
                                            <td>Trạng thái BKK với KH</td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <input type="text" name="khach_dai_dien_gd" class="khach_dai_dien_gd" value="<?php echo get_field('khach_dai_dien_gd'); ?>" autocomplete="off" required />
                                                <div class="popup_get_data_list pop_ten">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%">
                                                <input type="number" name="sdt_gd" class="sdt_gd" value="<?php echo get_field('sdt_gd'); ?>" autocomplete="off" required />
                                                <div class="popup_get_data_list pop_sdt">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <select name="trang_thai_bkk_voi_kh_gd" class="trang_thai_bkk_voi_kh_gd" autocomplete="off" required>
                                                    <option value="BKK - Tiềm năng" selected>BKK - Tiềm năng</option>
                                                    <option value="BKK - Chuẩn bị cọc">BKK - Chuẩn bị cọc</option>
                                                    <option value="BKK - Đã cọc">BKK - Đã cọc</option>
                                                    <option value="BKK - Đã trả XN">BKK - Đã trả XN</option>
                                                    <option value="Thay đổi - lần 1">Thay đổi - lần 1</option>
                                                    <option value="Thay đổi - lần 2">Thay đổi - lần 2</option>
                                                    <option value="Thay đổi - lần 3">Thay đổi - lần 3</option>
                                                    <option value="Thay đổi - Đã trả XN">Thay đổi - Đã trả XN</option>
                                                    <option value="VC - Chưa gửi, VC - Đã gửi KH">VC - Chưa gửi, VC - Đã gửi KH</option>
                                                    <option value="VC - Đã gửi KS">VC - Đã gửi KS</option>
                                                    <option value="VC - KH đã nhận">VC - KH đã nhận</option>
                                                    <option value="VC - KS đã nhận">VC - KS đã nhận</option>
                                                    <option value="TL">TL</option>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;">
                                    <strong>Mã Booking</strong>
                                    <input type="text" name="ma_gd" class="ma_gd" style="background: #FFF;" value="<?php echo 'MBK_ ...'; ?>" autocomplete="off" disabled />
                                </td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="40%">Trạng thái BKK với ĐT</td>
                                            <td width="20%">Nick</td>
                                            <td>Tên NV đặt phòng</td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <select name="trang_thai_bkk_voi_dt" class="trang_thai_bkk_voi_dt"  required>
                                                    <option value="BKK - Yêu cầu gửi" selected>BKK - Yêu cầu gửi</option>
                                                    <option value="BKK - Đang gửi">BKK - Đang gửi</option>
                                                    <option value="BKK - Đang chờ XN">BKK - Đang chờ XN</option>
                                                    <option value="BKK - Đã có XN">BKK - Đã có XN</option>
                                                    <option value="Thay đổi - Đang gửi">Thay đổi - Đang gửi</option>
                                                    <option value="Thay đổi - Đang chờ XN">Thay đổi - Đang chờ XN</option>
                                                    <option value="Thay đổi - Đã có XN">Thay đổi - Đã có XN</option>
                                                    <option value="Hủy - Yêu cầu gửi">Hủy - Yêu cầu gửi</option>
                                                    <option value="Hủy - Đang gửi">Hủy - Đang gửi</option>
                                                    <option value="Hủy - Đang chờ XN hủy">Hủy - Đang chờ XN hủy</option>
                                                    <option value="Hủy - Đã có XN hủy">Hủy - Đã có XN hủy</option>
                                                </select>
                                            </td>
                                            <td width="20%">
                                                <input type="text" name="nick_dt" class="nick_dt" value="<?php echo get_field('nick_dt'); ?>" autocomplete="off"/>
                                            </td>
                                            <td><input type="text" name="ten_nv_dat_phong_dt" class="ten_nv_dat_phong_dt" value="<?php echo get_field('ten_nv_dat_phong_dt'); ?>"  autocomplete="off"/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="40%">Check-in (thứ 6,7 màu xanh, CN màu đỏ)</td>
                                            <td width="10%">Số đêm</td>
                                            <td width="40%">Check-out</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><input type="text" name="ci_gd" data-date-format="dd/mm/yyyy" class="ci_gd datepicker-here" data-language='en' value="<?php echo get_field('ci_gd'); ?>" autocomplete="off" required /></td>
                                            <td width="10%"><input type="number" name="so_dem_gd" class="so_dem_gd" value="<?php echo get_field('so_dem_gd'); ?>" required /></td>
                                            <td width="40%"><input type="text" name="co_gd" data-date-format="dd/mm/yyyy" class="co_gd datepicker-here" data-language='en' value="<?php echo get_field('co_gd'); ?>" autocomplete="off" required /></td>
                                            <td>Còn <span class="con_ngay_gd_label">?</span> ngày<input type="hidden" name="con_ngay_gd" class="con_ngay_gd" value="<?php echo get_field('con_ngay_gd'); ?>" required autocomplete="off" /></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;">
                                    Hình thức book
                                    <!--<input type="text" name="hinh_thuc_book_gd" class="hinh_thuc_book_gd" style="background: #FFF;" value="<?php /*echo get_field('hinh_thuc_book_gd'); */?>" autocomplete="off"/">-->
                                    <select name="hinh_thuc_book_gd" class="hinh_thuc_book_gd">
                                        <option value="CODE">CODE</option>
                                        <option value="VC">VC</option>
                                        <option value="HĐ">HĐ</option>
                                        <option value="BK">BK</option>
                                        <option value="AG">AG</option>
                                        <option value="SERIES">SERIES</option>
                                        <option value="HARDLOCK">HARDLOCK</option>
                                    </select>
                                </td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="40%">Ngày được hủy (hoàn tiền 100%)</td>
                                            <td width="10%"></td>
                                            <td width="40%">Ngày được thay đổi</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><input type="text" name="ngay_duoc_huy" data-date-format="dd/mm/yyyy" class="ngay_duoc_huy datepicker-here" data-language='en' value="<?php echo get_field('ngay_duoc_huy'); ?>" autocomplete="off" /></td>
                                            <td width="10%">Còn <span class="con_ngay_dt_label">?</span> ngày<input type="hidden" name="con_ngay_dt" class="con_ngay_dt" value="0" /></td>
                                            <td width="40%"><input type="text" name="ngay_duoc_thay_doi" data-date-format="dd/mm/yyyy" class="ngay_duoc_thay_doi datepicker-here" data-language='en' value="<?php echo get_field('ngay_duoc_thay_doi'); ?>" autocomplete="off" /></td>
                                            <td>Còn <span class="con_ngay_thay_doi_dt_label">?</span> ngày<input type="hidden" name="con_ngay_thay_doi_dt" class="con_ngay_thay_doi_dt" value="0" autocomplete="off"/></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="35%">Loại phòng bán</td>
                                            <td width="10%">SL</td>
                                            <td width="15%">Đơn giá bán</td>
                                            <td width="15%">Đơn vị</td>
                                            <td width="20%">Tổng</td>
                                        </tr>
                                        <tr>
                                            <td width="35%">
                                                <select name="loai_phong_ban_gd" class="loai_phong_ban_gd">
                                                    <option value="Chọn loại phòng">Chọn loại phòng</option>
                                                </select>
                                            </td>
                                            <td width="10%"><input type="number" name="sl_gd" class="sl_gd" value="1" autocomplete="off" required /></td>
                                            <td width="15%"><input type="text" name="don_gia_ban_gd" class="don_gia_ban_gd" value="0" autocomplete="off" /></td>
                                            <td width="20%">
                                                <select name="don_vi_gd" class="don_vi_gd" required>
                                                    <option selected="selected" value="vnđ/phòng/đêm">vnđ/phòng/đêm</option>
                                                    <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                                    <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                                                </select>
                                            </td>
                                            <td width="20%"><input type="text" name="tong_gd" class="tong_gd" value="0" autocomplete="off" required /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" align="center">Ngày lock phòng</td>
                                            <td colspan="3" align="center">Gói DV - KM bán</td>
                                            <td colspan="1" align="center">Mã KM</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">
                                                <input type="text" data-date-format="dd/mm/yyyy" name="ngay_lock_phong_khach" class="ngay_lock_phong_khach datepicker-here" data-language='en' autocomplete="off"/>
                                            </td>
                                            <td colspan="3" align="center">
                                                <select name="goi_dv_km_ban_gd" class="goi_dv_km_ban_gd" required>
                                                    <option selected="selected" value="BB - Ăn sáng">BB - Ăn sáng</option>
                                                    <option value="FB - Ăn 3 bữa">FB - Ăn 3 bữa</option>
                                                    <option value="FBV - Ăn 3 bữa + Vui chơi">FBV - Ăn 3 bữa + Vui chơi</option>
                                                    <option value="FBVS - Ăn 3 bữa + Vui chơi + Safari">FBVS - Ăn 3 bữa + Vui chơi + Safari</option>
                                                </select>
                                            </td>
                                            <td colspan="1" align="center"><input type="text" name="ma_pro_gd" class="ma_pro_gd" value="<?php echo get_field('ma_pro_gd'); ?>" autocomplete="off" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center">Dịch vụ đi kèm</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center"><textarea name="dich_vu_di_kem_gd" class="dich_vu_di_kem_gd" ><?php echo get_field('dich_vu_di_kem_gd'); ?></textarea></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;">
                                    Mã xác nhận
                                    <input type="text" name="ma_xac_nhan" class="ma_xac_nhan" style="background: #FFF;" value="<?php echo get_field('ma_xac_nhan'); ?>" autocomplete="off"/>
                                    <p></p>
                                    Lý giải PT
                                    <textarea name="ly_giai_pt" class="ly_giai_pt" style="background: #FFF;"><?php echo get_field('ly_giai_pt'); ?></textarea>
                                </td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="35%">Loại phòng mua</td>
                                            <td width="10%">SL</td>
                                            <td width="15%">Đơn giá mua</td>
                                            <td width="20%">Đơn vị</td>
                                            <td width="20%">Tổng</td>
                                        </tr>
                                        <tr>
                                            <td width="35%">
                                                <select name="loai_phong_ban_dt" class="loai_phong_ban_dt">
                                                    <option value="Chọn loại phòng">Chọn loại phòng</option>
                                                </select>
                                            </td>
                                            <td width="10%"><input type="number" name="sl_dt" class="sl_dt" value="1" required autocomplete="off"/></td>
                                            <td width="15%"><input type="text" name="don_gia_ban_dt" class="don_gia_ban_dt" value="0" autocomplete="off"/></td>
                                            <td width="20%">
                                                <select name="don_vi_dt" class="don_vi_dt" required>
                                                    <option selected="selected" value="vnđ/phòng/đêm">vnđ/phòng/đêm</option>
                                                    <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                                    <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                                                </select>
                                            </td>
                                            <td width="20%"><input type="text" name="tong_dt" class="tong_dt" value="<?php echo get_field('tong_dt'); ?>" required autocomplete="off"/></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" align="center">Ngày lock phòng</td>
                                            <td colspan="3" align="center">Gói DV - KM mua</td>
                                            <td colspan="1" align="center">Mã KM</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">
                                                <input type="text" data-date-format="dd/mm/yyyy" name="ngay_lock_phong_doi_tac" class="ngay_lock_phong_doi_tac datepicker-here" data-language='en' autocomplete="off"/>
                                            </td>
                                            <td colspan="3" align="center">
                                                <select name="goi_dv_km_ban_dt" class="goi_dv_km_ban_dt" required>
                                                    <option selected="selected" value="BB - Ăn sáng">BB - Ăn sáng</option>
                                                    <option value="FB - Ăn 3 bữa">FB - Ăn 3 bữa</option>
                                                    <option value="FBV - Ăn 3 bữa + Vui chơi">FBV - Ăn 3 bữa + Vui chơi</option>
                                                    <option value="FBVS - Ăn 3 bữa + Vui chơi + Safari">FBVS - Ăn 3 bữa + Vui chơi + Safari</option>
                                                </select>
                                            </td>
                                            <td colspan="1" align="center"><input type="text" name="ma_pro_dt" class="ma_pro_dt" value="<?php echo get_field('ma_pro_dt'); ?>" autocomplete="off"/></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center">Dịch vụ đi kèm</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center">
                                                <textarea name="dich_vu_di_kem_dt" class="dich_vu_di_kem_dt"><?php echo get_field('dich_vu_di_kem_dt'); ?></textarea>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <?php
                            //Lấy dữ liệu giao dịch tổng khi có query khác chèn vào giữa
                            $ten_kgd = get_field('ten_kgd');
                            $nick_kgd = get_field('nick_kgd');
                            $sdt_kgd = get_field('sdt_kgd');
                            $email_kgd_duy_nhat = get_field('email_kgd_duy_nhat');
                            $tk_kgd = get_field('tk_kgd');
                            $ma_kgd = get_field('ma_kgd');
                            $xep_hang_kgd = get_field('xep_hang_kgd');
                            $ma_ctv = get_field('ma_ctv');
                            $ma_nv = get_field('ma_nv');
                            $ma_gd_coc_1 = get_field('ma_gd_coc_1');
                            $tien_coc_1 = get_field('tien_coc_1');
                            $ngay_coc_1 = get_field('ngay_coc_1');
                            $tk_coc_1 = get_field('tk_coc_1');
                            $ma_kho_popup_thong_tin_kho = get_field('ma_kho_popup_thong_tin_kho');
                            $ma_gd_coc_di_2 = get_field('ma_gd_coc_di_2');
                            $tien_coc_di_2 = get_field('tien_coc_di_2');
                            $ngay_phai_coc_di_2 = get_field('ngay_phai_coc_di_2');
                            $tk_coc_di_2 = get_field('tk_coc_di_2');
                            $ma_gd_tt_lan_2_1 = get_field('ma_gd_tt_lan_2_1');
                            $tien_tt_lan_2_1 = get_field('tien_tt_lan_2_1');
                            $ngay_tt_lan_2_1 = get_field('ngay_tt_lan_2_1');
                            $tk_tt_lan_2_1 = get_field('tk_tt_lan_2_1');
                            $sl_lay_tu_kho = get_field('sl_lay_tu_kho');
                            $ma_gd_di_lan_2_2 = get_field('ma_gd_di_lan_2_2');
                            $tien_di_lan_2_2 = get_field('tien_di_lan_2_2');
                            $ngay_phai_di_lan_2_2 = get_field('ngay_phai_di_lan_2_2');
                            $tk_di_lan_2_2 = get_field('tk_di_lan_2_2');
                            $ma_gd_tt_lan_3_1 = get_field('ma_gd_tt_lan_3_1');
                            $tien_tt_lan_3_1 = get_field('tien_tt_lan_3_1');
                            $ngay_tt_lan_3_1 = get_field('ngay_tt_lan_3_1');
                            $tk_tt_lan_3_1 = get_field('tk_tt_lan_3_1');
                            $ma_gd_di_lan_3_2 = get_field('ma_gd_di_lan_3_2');
                            $tien_di_lan_3_2 = get_field('tien_di_lan_3_2');
                            $ngay_phai_di_lan_3_2 = get_field('ngay_phai_di_lan_3_2');
                            $tk_di_lan_3_2 = get_field('tk_di_lan_3_2');
                            $tk_kh_1 = get_field('tk_kh_1');
                            $so_tien_hoan_1 = get_field('so_tien_hoan_1');
                            $ngay_hoan_tien_1 = get_field('ngay_hoan_tien_1');
                            $ma_gd_hoan_tien_1 = get_field('ma_gd_hoan_tien_1');
                            $tk_doi_tac_2 = get_field('tk_doi_tac_2');
                            $so_tien_hoan_2 = get_field('so_tien_hoan_2');
                            $ngay_hoan_tien_2 = get_field('ngay_hoan_tien_2');
                            $ma_gd_hoan_tien_2 = get_field('ma_gd_hoan_tien_2');
                            $ghi_chu_thanh_toan_1 = get_field('ghi_chu_thanh_toan_1');
                            $ghi_chu_thanh_toan_2 = get_field('ghi_chu_thanh_toan_2');
                            ?>
                            <tr style="display:none;">
                                <td colspan="3"><table width="100%" border="1" id="show_chat" class="show_chat_table" data-id="<?php echo get_the_ID(); ?>">
                                        <thead>
                                        <tr class="show_chat">
                                            <td width="40%" align="center" bgcolor="#EAF8FF">Ô nhập lời nhắn</td>
                                            <td align="center" bgcolor="#EAF8FF">Bộ phận</td>
                                            <td align="center" bgcolor="#EAF8FF">Mức độ ưu tiên</td>
                                            <td align="center" bgcolor="#EAF8FF">Trạng thái</td>
                                            <td align="center" bgcolor="#EAF8FF">Ngày cần nhắc lại</td>
                                            <td align="center" bgcolor="#EAF8FF">Nhập</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        //list chat
                                        $arr_chat = array(
                                            'post_type' => 'chat',
                                            'posts_per_page' => 6,
                                            'meta_key'		=> 'id_chat_gd',
                                            'meta_value' => '^' . preg_quote( get_the_ID() ),
                                            'meta_compare' => 'RLIKE',
                                        );

                                        $query_chat = get_posts($arr_chat);
                                        $this_ID = get_the_ID();
                                        $this_user = $_SESSION['mnv'];

                                        if( $query_chat ): foreach( $query_chat as $post ):
                                            setup_postdata( $post );
                                            $muc_do_uu_tien_chat = get_field('muc_do_uu_tien_chat');
                                            $trang_thai_chat = get_field('trang_thai_chat');
                                            $ngay_can_nhac_lai_chat = get_field('ngay_can_nhac_lai_chat');
                                            $reply_chat = get_field('reply_chat');

                                            if($this_ID == get_field('id_chat_gd')){
                                                ?>
                                                <tr class="show_chat count_chat <?php
                                                if($this_user == get_field('ma_nhan_vien_chat')){
                                                    echo 'check_color';
                                                }
                                                ?>" data-id="<?php echo get_the_ID(); ?>" data-count="<?php if(empty(get_field('count_chat'))){echo 0;}else{echo get_field('count_chat');} ?>">
                                                    <td bgcolor="#EAF8FF">
                                                        <?php
                                                        if(!empty(get_field('reply_chat'))){
                                                            ?>
                                                            <span class="reply_chat"><span><?php echo get_field('reply_chat'); ?></span></span>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $ngay_nhap_vao_chat = get_field('ngay_nhap_vao_chat');
                                                        $ma_nhan_vien_chat = get_field('ma_nhan_vien_chat');
                                                        $tin_nhan_chat = get_field('tin_nhan_chat');
                                                        $bo_phan_chat = get_field('bo_phan_chat');
                                                        $muc_do_uu_tien_chat = get_field('muc_do_uu_tien_chat');
                                                        $trang_thai_chat = get_field('trang_thai_chat');
                                                        $ngay_can_nhac_lai_chat = get_field('ngay_can_nhac_lai_chat');
                                                        $button = get_field('button');
                                                        $reply_chat = get_field('reply_chat');
                                                        ?>
                                                        <div class="cmt">
                                                            <div class="img"><img src="<?php
                                                                $arr_avatar = array(
                                                                    'post_type' => 'tai_khoan',
                                                                    'posts_per_page' => 6,
                                                                    'meta_query'	=> array(
                                                                        'relation'		=> 'AND',
                                                                        array(
                                                                            'key'	 	=> 'email_tai_khoan',
                                                                            'value'	  	=> get_field('ma_nhan_vien_chat'),
                                                                            'compare' 	=> '=',
                                                                        ),
                                                                    ),
                                                                );

                                                                $query_avatar = new WP_Query($arr_avatar);

                                                                if($query_avatar->have_posts()) : while ($query_avatar->have_posts()) : $query_avatar->the_post();
                                                                    $img_a = get_field('hinh_anh_tai_khoan');
                                                                    if(!empty($img_a)){
                                                                        echo $img_a;
                                                                    }else{
                                                                        echo get_template_directory_uri().'/assets/images/user.jpg';
                                                                    }
                                                                endwhile;
                                                                else:
                                                                    echo get_template_directory_uri().'/assets/images/user.jpg';
                                                                endif;
                                                                wp_reset_postdata();
                                                                ?>" alt="avatar"></div>
                                                            <div class="content">Ngày nhập vào :
                                                                <span><?php echo $ngay_nhap_vao_chat; ?></span> # Mã NV :
                                                                <span><?php echo $ma_nhan_vien_chat; ?></span> # Lời nhắn :
                                                                <span class="tn"><?php echo $tin_nhan_chat; ?></span>
                                                            </div>
                                                        </div>
                                                        <p class="edit_mess_tn">
                                                            <textarea class="tn" cols="1" rows="1" disabled><?php echo $tin_nhan_chat; ?></textarea>
                                                        </p>
                                                    </td>
                                                    <td bgcolor="#EAF8FF">
                                                        <select class="bo_phan_chat_mess" data-check="<?php echo $bo_phan_chat; ?>" disabled>
                                                            <option value="" selected disabled hidden>Chọn bộ phận</option>
                                                            <?php
                                                            $query_bp = get_posts(array(
                                                                'post_type' => 'bo_phan',
                                                            ));
                                                            if( $query_bp ):
                                                                foreach( $query_bp as $bp ):
                                                                    ?>
                                                                    <option value="<?php echo $bp->post_title; ?>"><?php echo $bp->post_title; ?></option>
                                                                <?php
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td bgcolor="#EAF8FF">
                                                        <select class="muc_do_uu_tien_chat_mess" data-check="<?php echo $muc_do_uu_tien_chat; ?>" disabled>
                                                            <option value="Thông thường" selected>Thông thường</option>
                                                            <option value="Luôn và ngay">Luôn và ngay</option>
                                                            <option value="Trong ngày">Trong ngày</option>
                                                        </select>
                                                    </td>
                                                    <td bgcolor="#EAF8FF"><input type="text" class="trang_thai_chat_mess" value="<?php echo $trang_thai_chat; ?>" disabled></td>
                                                    <td bgcolor="#EAF8FF"><input type="text" data-date-format="dd/mm/yyyy" data-position='top left' class="datepicker-here ngay_can_nhac_lai_chat_mess" value="<?php echo $ngay_can_nhac_lai_chat; ?>" data-language='en' disabled></td>
                                                    <td bgcolor="#EAF8FF"><p class="change_update_send_mess" data-id="<?php echo get_the_ID(); ?>" data-name="<?php echo $ma_nhan_vien_chat; ?>">
                                                            <?php
                                                            if($this_user == $ma_nhan_vien_chat && $button == 'true'){
                                                                ?>
                                                                <button type="button" class="btn_edit_chat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if(empty($reply_chat)){
                                                                ?><button type="button" class="reply"><i class="fa fa-reply" aria-hidden="true"></i> Trả lời</button><?php
                                                            }
                                                            ?>
                                                        </p></td>
                                                </tr>
                                                <?php
                                            }
                                        endforeach;

                                            $arr_chat_count = array(
                                                'post_type' => 'chat',
                                                'posts_per_page' => 1,
                                                'order' => 'DESC',
                                                'meta_key'		=> 'id_chat_gd',
                                                'meta_value' => '^' . preg_quote( $this_ID ),
                                                'meta_compare' => 'RLIKE',
                                            );
                                            $query_chat_count = get_posts($arr_chat_count);
                                            if( $query_chat_count ): foreach( $query_chat_count as $post ):
                                                setup_postdata( $post );
                                                if(get_field('count_chat') > 6){
                                                    ?>
                                                    <tr class="show_chat">
                                                        <td bgcolor="#EAF8FF">...</td>
                                                        <td bgcolor="#EAF8FF">...</td>
                                                        <td bgcolor="#EAF8FF">...</td>
                                                        <td bgcolor="#EAF8FF">...</td>
                                                        <td bgcolor="#EAF8FF">...</td>
                                                        <td bgcolor="#EAF8FF">...</td>
                                                    </tr>
                                                    <?php
                                                    $arr_chat_late = array(
                                                        'post_type' => 'chat',
                                                        'posts_per_page' => 1,
                                                        'order' => 'ASC',
                                                        'meta_key'		=> 'id_chat_gd',
                                                        'meta_value' => '^' . preg_quote( $this_ID ),
                                                        'meta_compare' => 'RLIKE',
                                                    );

                                                    $query_chat_late = get_posts($arr_chat_late);

                                                    if( $query_chat_late ): foreach( $query_chat_late as $post ):
                                                        setup_postdata( $post );

                                                        $muc_do_uu_tien_chat = get_field('muc_do_uu_tien_chat');
                                                        $trang_thai_chat = get_field('trang_thai_chat');
                                                        $ngay_can_nhac_lai_chat = get_field('ngay_can_nhac_lai_chat');
                                                        $reply_chat = get_field('reply_chat');

                                                        if($this_ID == get_field('id_chat_gd')){
                                                            ?>
                                                            <tr class="show_chat count_chat <?php
                                                            if($this_user == get_field('ma_nhan_vien_chat')){
                                                                echo 'check_color';
                                                            }
                                                            ?>" data-id="<?php echo get_the_ID(); ?>" data-count="<?php if(empty(get_field('count_chat'))){echo 0;}else{echo get_field('count_chat');} ?>">
                                                                <td bgcolor="#EAF8FF">
                                                                    <?php
                                                                    if(!empty(get_field('reply_chat'))){
                                                                        ?>
                                                                        <span class="reply_chat"><span><?php echo get_field('reply_chat'); ?></span></span>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    $ngay_nhap_vao_chat = get_field('ngay_nhap_vao_chat');
                                                                    $ma_nhan_vien_chat = get_field('ma_nhan_vien_chat');
                                                                    $tin_nhan_chat = get_field('tin_nhan_chat');
                                                                    $bo_phan_chat = get_field('bo_phan_chat');
                                                                    $muc_do_uu_tien_chat = get_field('muc_do_uu_tien_chat');
                                                                    $trang_thai_chat = get_field('trang_thai_chat');
                                                                    $ngay_can_nhac_lai_chat = get_field('ngay_can_nhac_lai_chat');
                                                                    $button = get_field('button');
                                                                    $reply_chat = get_field('reply_chat');
                                                                    ?>
                                                                    <div class="cmt">
                                                                        <div class="img"><img src="<?php
                                                                            $arr_avatar = array(
                                                                                'post_type' => 'tai_khoan',
                                                                                'posts_per_page' => 6,
                                                                                'meta_query'	=> array(
                                                                                    'relation'		=> 'AND',
                                                                                    array(
                                                                                        'key'	 	=> 'email_tai_khoan',
                                                                                        'value'	  	=> get_field('ma_nhan_vien_chat'),
                                                                                        'compare' 	=> '=',
                                                                                    ),
                                                                                ),
                                                                            );

                                                                            $query_avatar = new WP_Query($arr_avatar);

                                                                            if($query_avatar->have_posts()) : while ($query_avatar->have_posts()) : $query_avatar->the_post();
                                                                                $img_a = get_field('hinh_anh_tai_khoan');
                                                                                if(!empty($img_a)){
                                                                                    echo $img_a;
                                                                                }else{
                                                                                    echo get_template_directory_uri().'/assets/images/user.jpg';
                                                                                }
                                                                            endwhile;
                                                                            else:
                                                                                echo get_template_directory_uri().'/assets/images/user.jpg';
                                                                            endif;
                                                                            wp_reset_postdata();
                                                                            ?>" alt="avatar"></div>
                                                                        <div class="content">Ngày nhập vào :
                                                                            <span><?php echo $ngay_nhap_vao_chat; ?></span> # Mã NV :
                                                                            <span><?php echo $ma_nhan_vien_chat; ?></span> # Lời nhắn cũ nhất :
                                                                            <span class="tn"><?php echo $tin_nhan_chat; ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <p class="edit_mess_tn">
                                                                        <textarea class="tn" cols="1" rows="1" disabled><?php echo $tin_nhan_chat; ?></textarea>
                                                                    </p>
                                                                </td>
                                                                <td bgcolor="#EAF8FF">
                                                                    <select class="bo_phan_chat_mess" data-check="<?php echo $bo_phan_chat; ?>" disabled>
                                                                        <option value="" selected disabled hidden>Chọn bộ phận</option>
                                                                        <?php
                                                                        $query_bp = get_posts(array(
                                                                            'post_type' => 'bo_phan',
                                                                        ));
                                                                        if( $query_bp ):
                                                                            foreach( $query_bp as $bp ):
                                                                                ?>
                                                                                <option value="<?php echo $bp->post_title; ?>"><?php echo $bp->post_title; ?></option>
                                                                            <?php
                                                                            endforeach;
                                                                            wp_reset_postdata();
                                                                        endif;
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td bgcolor="#EAF8FF">
                                                                    <select class="muc_do_uu_tien_chat_mess" data-check="<?php echo $muc_do_uu_tien_chat; ?>" disabled>
                                                                        <option value="Thông thường" selected>Thông thường</option>
                                                                        <option value="Luôn và ngay">Luôn và ngay</option>
                                                                        <option value="Trong ngày">Trong ngày</option>
                                                                    </select>
                                                                </td>
                                                                <td bgcolor="#EAF8FF"><input type="text" class="trang_thai_chat_mess" value="<?php echo $trang_thai_chat; ?>" disabled></td>
                                                                <td bgcolor="#EAF8FF"><input type="text" data-date-format="dd/mm/yyyy" data-position="top left" class="datepicker-here ngay_can_nhac_lai_chat_mess" value="<?php echo $ngay_can_nhac_lai_chat; ?>" data-language='en' disabled></td>
                                                                <td bgcolor="#EAF8FF"><p class="change_update_send_mess" data-id="<?php echo get_the_ID(); ?>" data-name="<?php echo $ma_nhan_vien_chat; ?>">
                                                                        <?php
                                                                        if($this_user == $ma_nhan_vien_chat && $button == 'true'){
                                                                            ?>
                                                                            <button type="button" class="btn_edit_chat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if(empty($reply_chat)){
                                                                            ?><button type="button" class="reply"><i class="fa fa-reply" aria-hidden="true"></i> Trả lời</button><?php
                                                                        }
                                                                        ?>
                                                                    </p></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    endforeach;
                                                    endif;
                                                }
                                            endforeach;
                                            endif;
                                        else :
                                            ?>
                                            <tr class="show_chat count_chat" data-count="0"><td bgcolor="#EAF8FF" class="empy" colspan="6">Dữ liệu trống !</td></tr>
                                        <?php
                                        endif;
                                        ?>
                                        </tbody>

                                        <tfoot>
                                        <tr class="send_chat">
                                            <td>
                                                <span></span>
                                                <input type="hidden" class="reply_chat" value="" />
                                                <textarea class="tin_nhan_chat" cols="30" rows="1" placeholder="Nhập lời nhắn"></textarea>
                                            </td>
                                            <td>
                                                <label>Bộ phận</label>
                                                <select class="bo_phan_chat" data-check="Booking">
                                                    <?php
                                                    $query_bp = new WP_Query(array(
                                                        'post_type' => 'bo_phan',
                                                    ));

                                                    while ($query_bp->have_posts()) : $query_bp->the_post();
                                                        ?>
                                                        <option value="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></option>
                                                    <?php
                                                    endwhile;
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <label>Mức độ ưu tiên</label>
                                                <select class="muc_do_uu_tien_chat" data-check="Thông thường">
                                                    <option value="Thông thường" selected>Thông thường</option>
                                                    <option value="Luôn và ngay">Luôn và ngay</option>
                                                    <option value="Trong ngày">Trong ngày</option>
                                                </select>
                                            </td>
                                            <td>
                                                <label>Trạng thái</label>
                                                <input type="text" value="Đã chờ" class="trang_thai_chat" disabled>
                                            </td>
                                            <td>
                                                <label>Ngày cần nhắc lại</label>
                                                <input type="text" data-date-format="dd/mm/yyyy" data-position='top left' class="datepicker-here ngay_can_nhac_lai_chat" placeholder="27/04/2019" data-language='en' autocomplete="off">
                                            </td>
                                            <td>
                                                <label>Nhập</label>
                                                <input type="hidden" class="ma_nhan_vien_chat" value="<?php if(isset($_SESSION['mnv'])){echo $_SESSION['mnv'];} ?>" >
                                                <input type="hidden" class="id_chat_gd" value="<?php if(! is_page()){echo $this_ID;} ?>">
                                                <input type="hidden" class="id_reply" value="">
                                                <input type="submit" class="btn_send_chat" value="Gửi tin nhắn">
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table></td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <table width="100%" border="1" style="background: #9bb552a6">
                                        <tbody style="padding: 5px;">
                                        <tr style="margin-top: 5px;">
                                            <td width="5%">SL NL</td>
                                            <td width="5%">GP</td>
                                            <td width="5%">0 - 2</td>
                                            <td width="5%">2 - 4</td>
                                            <td width="5%">4 - 6</td>
                                            <td width="5%">6 - 12</td>
                                            <td width="10%">PT người</td>
                                            <td width="10%">PT giai đoạn</td>
                                            <td width="10%">PT cuối tuần</td>
                                            <td width="10%">Bữa ăn bắt buộc</td>
                                            <td width="10%">Dịch vụ khác</td>
                                            <td width="10%">Tổng PT</td>
                                            <td> KH TT PT tại?</td>
                                        </tr>
                                        <tr>
                                            <td width="5%"><input type="t" style="background: #fff;" name="sl_nl" class="sl_nl" value="2" autocomplete="off" /></td>
                                            <td width="5%"><input type="number" style="background: #fff;" name="gp" class="gp" value="0" autocomplete="off" /></td>
                                            <td width="5%"><input type="number" style="background: #fff;" name="sl02" class="sl02" value="0" autocomplete="off" /></td>
                                            <td width="5%"><input type="number" style="background: #fff;" name="sl24" class="sl24" value="0" autocomplete="off" /></td>
                                            <td width="5%"><input type="number" style="background: #fff;" name="sl46" class="sl46" value="0" autocomplete="off" /></td>
                                            <td width="5%"><input type="number" style="background: #fff;" name="sl612" class="sl612" value="0" autocomplete="off" /></td>
                                            <td width="10%"><input type="text" style="background: #fff;" name="pt_nguoi" class="pt_nguoi" value="0" autocomplete="off" /></td>
                                            <td width="10%"><input type="text" style="background: #fff;" name="pt_giai_doan" class="pt_giai_doan" value="0" autocomplete="off" /></td>
                                            <td width="10%"><input type="text" style="background: #fff;" name="pt_cuoi_tuan" class="pt_cuoi_tuan" value="0" autocomplete="off" /></td>
                                            <td width="10%"><input type="text" style="background: #fff;" name="bua_an_bat_buoc" class="bua_an_bat_buoc" value="0" autocomplete="off" /></td>
                                            <td width="10%"><input type="text" style="background: #fff;" name="dich_vu_khac" class="dich_vu_khac" value="0" autocomplete="off" /></td>
                                            <td width="10%"><input type="text" style="background: #fff;" name="tong_pt" class="tong_pt" value="0" autocomplete="off" /></td>
                                            <td>
                                                <select name="kh_tt_pt_tai" style="background: #fff;" class="kh_tt_pt_tai">
                                                    <option value="BTC" selected>BTC</option>
                                                    <option value="Khách sạn">Khách sạn</option>
                                                </select>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr class="phu_thu_kh_vs_dt">
                                <td>
                                    <table width="100%" border="1" style="background: #2e75bd63;">
                                        <tbody>
                                        <tr>
                                            <td rowspan="7">
                                                Danh sách đoàn, yêu cầu khác
                                                <textarea name="danh_sach_doan_yeu_cau_khac" class="danh_sach_doan_yeu_cau_khac"><?php echo get_field('danh_sach_doan_yeu_cau_khac'); ?></textarea>
                                            </td>
                                            <td width="25%">Tiền chưa PT</td>
                                            <td width="25%"><input type="text" width="100%" style="height:24px;" name="tien_chua_pt_khac" class="tien_chua_pt_khac" value="0" autocomplete="off"/></td>
                                        </tr>
                                        <tr>
                                            <td>Tổng phụ thu</td>
                                            <td><input type="text" name="tong_phu_thu_khac" style="height:24px;" class="tong_phu_thu_khac" value="0" autocomplete="off"/></td>
                                        </tr>
                                        <tr>
                                            <td>Giảm giá cho KH</td>
                                            <td><input type="text" name="giam_gia_cho_kh_khac" style="height:24px;" class="giam_gia_cho_kh_khac" value="0" autocomplete="off"/></td>
                                        </tr>
                                        <tr>
                                            <td>Tổng giá trị</td>
                                            <td><input type="text" name="tong_gia_tri_khac" style="height:24px;" class="tong_gia_tri_khac" value="0" autocomplete="off"/></td>
                                        </tr>
                                        <tr>
                                            <td>Đã thanh toán</td>
                                            <td><input type="text" name="da_thanh_toan_khac" style="height:24px;" class="da_thanh_toan_khac" value="0" autocomplete="off"/></td>
                                        </tr>
                                        <tr>
                                            <td>KH còn nợ</td>
                                            <td><input type="text" name="kh_con_no_khac" style="height:24px;" class="kh_con_no_khac" value="0" autocomplete="off"/></td>
                                        </tr>
                                        <tr>
                                            <td>Ngày yêu cầu KH hoàn tất TT</td>
                                            <td><input type="text" style="height:24px;" name="ngay_yeu_cau_kh_hoan_tat_tt_khac" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_yeu_cau_kh_hoan_tat_tt_khac datepicker-here" data-language='en' value="<?php echo get_field('ngay_yeu_cau_kh_hoan_tat_tt_khac'); ?>" autocomplete="off"/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td align="center" style="background-color: #f19315b3;padding-top: 5px;">
                                                <ul class="price_count">
                                                    <li>
                                                        Lãi/Lỗ
                                                        <input type="text" name="lai_lo_khac" class="lai_lo_khac" style="background: #FFF;" value="0"  autocomplete="off"/>
                                                    </li>
                                                    <li>
                                                        Thuế VAT
                                                        <input type="text" name="thue_vat_khac" class="thue_vat_khac" style="background: #FFF;" value="0" autocomplete="off" />
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="background-color: #f19315b3;">
                                                <ul class="price_count">
                                                    <li>
                                                        Thuế TNDN
                                                        <input type="text" name="thue_tndn_khac" class="thue_tndn_khac" style="background: #FFF;" value="0"  autocomplete="off"/>
                                                    </li>
                                                    <li>
                                                        CP marketing
                                                        <input type="text" name="cp_marketing_khac" class="cp_marketing_khac" style="background: #FFF;" value="0"  autocomplete="off"/>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="background-color: #f19315b3;">
                                                <ul class="price_count">
                                                    <li>
                                                        CP hậu cần
                                                        <input type="text" name="cp_hau_can_khac" class="cp_hau_can_khac" style="background: #FFF;" value="0" autocomplete="off" />
                                                    </li>
                                                    <li>
                                                        CP hậu mãi
                                                        <input type="text" name="cp_hau_mai_khac" class="cp_hau_mai_khac" style="background: #FFF;" value="0" autocomplete="off" />
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="background-color: #f19315b3;padding-bottom: 10px;">
                                                CP cố định
                                                <input type="text" name="cp_co_dinh_khac" class="cp_co_dinh_khac" style="background: #FFF;" value="0" autocomplete="off" />
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="1" style="background: #2e75bd63;">
                                        <tbody>
                                        <tr>
                                            <td width="25%"><input type="text" name="tien_chua_pt_khac2" class="tien_chua_pt_khac2" value="0"  autocomplete="off"/></td>
                                            <td width="25%">Tiền chưa PT</td>
                                            <td width="50%" colspan="2" rowspan="7">
                                                Ghi chú của ĐT
                                                <textarea name="ghi_chu_cua_dt_khac2" class="ghi_chu_cua_dt_khac2"><?php echo get_field('ghi_chu_cua_dt_khac2'); ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="tong_phu_thu_khac2" style="height:24px;" class="tong_phu_thu_khac2" value="0" autocomplete="off" /></td>
                                            <td>Tổng phụ thu</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="giam_gia_cua_dt_khac2" style="height:24px;" class="giam_gia_cua_dt_khac2" value="0" autocomplete="off" /></td>
                                            <td>Giảm giá của ĐT</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="tong_gia_tri_khac2" style="height:24px;" class="tong_gia_tri_khac2" value="0" autocomplete="off" /></td>
                                            <td>Tổng giá trị</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="da_thanh_toan_khac2" style="height:24px;" class="da_thanh_toan_khac2" value="0" autocomplete="off" /></td>
                                            <td>Đã thanh toán</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="bct_con_no_khac2" style="height:24px;" class="bct_con_no_khac2" value="0" autocomplete="off" /></td>
                                            <td>BCT còn nợ</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="ngay_phai_hoan_tat_tt_cho_ks_khac2" style="height:24px;" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_phai_hoan_tat_tt_cho_ks_khac2 datepicker-here" data-language='en' value="<?php echo get_field('ngay_phai_hoan_tat_tt_cho_ks_khac2'); ?>" autocomplete="off" ></td>
                                            <td>Ngày phải hoàn tất TT cho KS</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <table width="100%" border="1" style="background: #9bb552a6">
                                        <tbody>
                                        <tr>
                                            <td width="15%">Tên KGD</td>
                                            <td width="8%">Nick KGD</td>
                                            <td width="8%">SĐT KGD</td>
                                            <td width="15%">Email KGD (duy nhất)</td>
                                            <td width="12%">TK KGD</td>
                                            <td width="10%">Mã KGD</td>
                                            <td width="10%">Xếp hạng KGD</td>
                                            <td width="10%">Mã CTV</td>
                                            <td>Mã NV</td>
                                        </tr>
                                        <tr>
                                            <td width="15%">
                                                <input type="text" style="background: #FFF;" name="ten_kgd" class="ten_kgd" value="<?php echo $ten_kgd; ?>" autocomplete="off"/>
                                                <div class="popup_get_data_list pop_tenkgd">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="8%">
                                                <input type="text" style="background: #FFF;" name="nick_kgd" class="nick_kgd" value="<?php echo $nick_kgd; ?>" autocomplete="off"/>
                                                <div class="popup_get_data_list pop_nick_kgd">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="8%">
                                                <input type="number" style="background: #FFF;" name="sdt_kgd" class="sdt_kgd" value="<?php echo $sdt_kgd; ?>" autocomplete="off"/>
                                                <div class="popup_get_data_list pop_sdt_kgd">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="15%"><input type="email" style="background: #FFF;" name="email_kgd_duy_nhat" class="email_kgd_duy_nhat" value="<?php echo $email_kgd_duy_nhat; ?>" autocomplete="off"/></td>
                                            <td width="12%"><input type="number" style="background: #FFF;" name="tk_kgd" class="tk_kgd" value="<?php echo $tk_kgd; ?>" autocomplete="off"/></td>
                                            <td width="10%"><input type="text" style="background: #FFF;" name="ma_kgd" class="ma_kgd" value="<?php echo $ma_kgd; ?>" autocomplete="off"/></td>
                                            <td width="10%">
                                                <select name="xep_hang_kgd" class="xep_hang_kgd" style="background: #FFF;" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option selected="selected" value="5">5</option>
                                                </select>
                                            </td>
                                            <td width="10%"><input type="text" name="ma_ctv" style="background: #FFF;" class="ma_ctv" value="<?php echo $ma_ctv; ?>"  autocomplete="off"/></td>
                                            <td><input type="text" name="ma_nv" class="ma_nv" style="background: #FFF;" value="<?php echo $ma_nv; ?>" autocomplete="off" /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">Mã GD cọc</td>
                                            <td width="25%">Tiền cọc</td>
                                            <td width="25%">Ngày cọc</td>
                                            <td>TK cọc</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_coc_1" class="ma_gd_coc_1" value="<?php echo $ma_gd_coc_1; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="number" name="tien_coc_1" class="tien_coc_1" value="<?php echo $tien_coc_1; ?>"  autocomplete="off"/></td>
                                            <td width="25%"><input type="text" name="ngay_coc_1" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_coc_1 datepicker-here" data-language='en' value="<?php echo $ngay_coc_1; ?>" autocomplete="off" /></td>
                                            <td><input type="number" name="tk_coc_1" class="tk_coc_1" value="<?php echo $tk_coc_1; ?>" autocomplete="off" /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;padding-top: 5px;">
                                    Mã Kho (popup thông tin kho)
                                    <input type="text" style="background: #FFF;" name="ma_kho_popup_thong_tin_kho" class="ma_kho_popup_thong_tin_kho" value="<?php echo $ma_kho_popup_thong_tin_kho; ?>" autocomplete="off" />
                                </td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">Mã GD cọc đi</td>
                                            <td width="25%">Tiền cọc đi</td>
                                            <td width="25%">Ngày phải cọc đi</td>
                                            <td>TK cọc đi</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_coc_di_2" class="ma_gd_coc_di_2" value="<?php echo $ma_gd_coc_di_2; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="number" name="tien_coc_di_2" class="tien_coc_di_2" value="<?php echo $tien_coc_di_2; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="text" name="ngay_phai_coc_di_2" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_phai_coc_di_2 datepicker-here" data-language='en' value="<?php echo $ngay_phai_coc_di_2; ?>" autocomplete="off" /></td>
                                            <td><input type="number" name="tk_coc_di_2" class="tk_coc_di_2" value="<?php echo $tk_coc_di_2; ?>" autocomplete="off" /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">Mã GD TT lần 2</td>
                                            <td width="25%">Tiền TT lần 2</td>
                                            <td width="25%">Ngày TT lần 2</td>
                                            <td>TK TT lần 2</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_tt_lan_2_1" class="ma_gd_tt_lan_2_1" value="<?php echo $ma_gd_tt_lan_2_1; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="number" name="tien_tt_lan_2_1" class="tien_tt_lan_2_1" value="<?php echo $tien_tt_lan_2_1; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="text" name="ngay_tt_lan_2_1" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_tt_lan_2_1 datepicker-here" data-language='en' value="<?php echo $ngay_tt_lan_2_1; ?>" autocomplete="off" /></td>
                                            <td><input type="number" name="tk_tt_lan_2_1" class="tk_tt_lan_2_1" value="<?php echo $tk_tt_lan_2_1; ?>" autocomplete="off" /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;padding-top: 5px;">
                                    SL lấy từ kho
                                    <input type="number" style="background: #FFF;" name="sl_lay_tu_kho" class="sl_lay_tu_kho" value="<?php echo $sl_lay_tu_kho; ?>" autocomplete="off" />
                                </td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">Mã GD đi lần 2</td>
                                            <td width="25%">Tiền đi lần 2</td>
                                            <td width="25%">Ngày phải đi lần 2</td>
                                            <td>TK đi lần 2</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_di_lan_2_2" class="ma_gd_di_lan_2_2" value="<?php echo $ma_gd_di_lan_2_2; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="number" name="tien_di_lan_2_2" class="tien_di_lan_2_2" value="<?php echo $tien_di_lan_2_2; ?>"  autocomplete="off"/></td>
                                            <td width="25%"><input type="text" name="ngay_phai_di_lan_2_2" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_phai_di_lan_2_2 datepicker-here" data-language='en' value="<?php echo $ngay_phai_di_lan_2_2; ?>"  autocomplete="off"/></td>
                                            <td><input type="number" name="tk_di_lan_2_2" class="tk_di_lan_2_2" value="<?php echo $tk_di_lan_2_2; ?>"  autocomplete="off"/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">Mã GD TT lần 3</td>
                                            <td width="25%">Tiền TT lần 3</td>
                                            <td width="25%">Ngày TT lần 3</td>
                                            <td>TK TT lần 3</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_tt_lan_3_1" class="ma_gd_tt_lan_3_1" value="<?php echo $ma_gd_tt_lan_3_1; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="number" name="tien_tt_lan_3_1" class="tien_tt_lan_3_1" value="<?php echo $tien_tt_lan_3_1; ?>"  autocomplete="off"/></td>
                                            <td width="25%"><input type="text" name="ngay_tt_lan_3_1" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_tt_lan_3_1 datepicker-here" data-language='en' value="<?php echo $ngay_tt_lan_3_1; ?>" autocomplete="off" /></td>
                                            <td><input type="number" name="tk_tt_lan_3_1" class="tk_tt_lan_3_1" value="<?php echo $tk_tt_lan_3_1; ?>" autocomplete="off" /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;padding-top: 5px;">&nbsp;</td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">Mã GD đi lần 3</td>
                                            <td width="25%">Tiền đi lần 3</td>
                                            <td width="25%">Ngày phải đi lần 3</td>
                                            <td>TK đi lần 3</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_di_lan_3_2" class="ma_gd_di_lan_3_2" value="<?php echo $ma_gd_di_lan_3_2; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="number" name="tien_di_lan_3_2" class="tien_di_lan_3_2" value="<?php echo $tien_di_lan_3_2; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="text" name="ngay_phai_di_lan_3_2" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_phai_di_lan_3_2 datepicker-here" data-language='en' value="<?php echo $ngay_phai_di_lan_3_2; ?>" autocomplete="off" /></td>
                                            <td><input type="number" name="tk_di_lan_3_2" class="tk_di_lan_3_2" value="<?php echo $tk_di_lan_3_2; ?>" autocomplete="off" /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">TK KH</td>
                                            <td width="25%">Số tiền hoàn</td>
                                            <td width="25%">Ngày hoàn tiền</td>
                                            <td>Mã GD hoàn tiền</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="number" name="tk_kh_1" class="tk_kh_1" value="<?php echo $tk_kh_1; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="number" name="so_tien_hoan_1" class="so_tien_hoan_1" value="<?php echo $so_tien_hoan_1; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="text" name="ngay_hoan_tien_1" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_hoan_tien_1 datepicker-here" data-language='en' value="<?php echo $ngay_hoan_tien_1; ?>" autocomplete="off" /></td>
                                            <td><input type="text" name="ma_gd_hoan_tien_1" class="ma_gd_hoan_tien_1" value="<?php echo $ma_gd_hoan_tien_1; ?>" autocomplete="off" /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;padding-top: 5px;">&nbsp;</td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">TK Đối tác</td>
                                            <td width="25%">Số tiền hoàn</td>
                                            <td width="25%">Ngày hoàn tiền</td>
                                            <td>Mã GD hoàn tiền</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="number" name="tk_doi_tac_2" class="tk_doi_tac_2" value="<?php echo $tk_doi_tac_2; ?>"  autocomplete="off"/></td>
                                            <td width="25%"><input type="number" name="so_tien_hoan_2" class="so_tien_hoan_2" value="<?php echo $so_tien_hoan_2; ?>" autocomplete="off" /></td>
                                            <td width="25%"><input type="text" name="ngay_hoan_tien_2" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_hoan_tien_2 datepicker-here" data-language='en' value="<?php echo $ngay_hoan_tien_2; ?>" autocomplete="off" /></td>
                                            <td><input type="text" name="ma_gd_hoan_tien_2" class="ma_gd_hoan_tien_2" value="<?php echo $ma_gd_hoan_tien_2; ?>" autocomplete="off" /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    Ghi chú thanh toán
                                    <textarea name="ghi_chu_thanh_toan_1" class="ghi_chu_thanh_toan_1"><?php echo $ghi_chu_thanh_toan_1; ?></textarea>
                                </td>
                                <td align="center" style="background-color: #f19315b3;padding-top: 5px;">&nbsp;</td>
                                <td align="center">
                                    Ghi chú thanh toán
                                    <textarea name="ghi_chu_thanh_toan_2" class="ghi_chu_thanh_toan_2"><?php echo $ghi_chu_thanh_toan_2; ?></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="acf-form-submit">
                            <input type="submit" name="sub_new_giao_dich" value="Thêm mới">
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

    <?php
    get_footer();
}else{
    ob_start();
    header("Location: ".home_url('/'));
    exit();
}