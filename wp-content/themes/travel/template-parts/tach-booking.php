<?php
/*
 * Template Name: Tách booking*/

if($_SESSION['sucess'] == "sucess") {

    get_header();

    ?>
    <div id="content">
        <div class="quantri_admin">
            <?php include 'inc/template_menu.php'; ?>

            <div class="content_admin">
                <div class="them_giao_dich">
                    <form action="<?php echo home_url('/'); ?>tach-booking" method="post">
                        <input type="hidden" name="so_phong_goc" class="so_phong_goc" value="<?php echo $_POST['so_phong_goc']; ?>">
                        <input type="hidden" name="id_gd_goc" class="id_gd_goc" value="<?php echo $_POST['id_gd_goc']; ?>">
                        <?php
                        $so_phong_goc = $_POST['so_phong_goc'];
                        $slp_tach = (int)$_POST['so_phong_goc'] - (int)$_POST['sl_gd'];

                        if (isset($_POST['sub_new_giao_dich'])) {
                            $_SESSION['number_cup_booking'] = $slp_tach;

                            $so_phong_goc = $_POST['so_phong_goc'];
                            $slp_tach = (int)$_POST['so_phong_goc'] - (int)$_POST['sl_gd'];

                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $date_check = date('d-m-Y H:i:s');

                            $array_gd = array(
                                'post_type' => 'giao_dich',
                                'post_status' => 'publish'
                            );

                            $query = new WP_Query($array_gd);

                            if ($query->have_posts()) {
                                while ($query->have_posts()) : $query->the_post();
                                    if($_POST['sl_gd'] < 1){
                                        $alert = "<p class='alert_tk_fail'>Số phòng không được nhỏ hơn 0 !</p>";
                                    }elseif($_POST['sl_gd'] > $so_phong_goc){
                                        $alert = "<p class='alert_tk_fail'>Số phòng tách vượt quá số lượng phòng gốc !</p>";
                                    }elseif($_POST['sl_gd'] == $so_phong_goc){
                                        $alert = "<p class='alert_tk_fail'>Số phòng tách bằng số lượng phòng gốc, không cần phải tách !</p>";
                                    }elseif($_POST['sl_dt'] < 1){
                                        $alert = "<p class='alert_tk_fail'>Số phòng không được nhỏ hơn 0 !</p>";
                                    }elseif($_POST['sl_dt'] > $so_phong_goc){
                                        $alert = "<p class='alert_tk_fail'>Số phòng tách vượt quá số lượng phòng gốc !</p>";
                                    }elseif($_POST['sl_dt'] == $so_phong_goc){
                                        $alert = "<p class='alert_tk_fail'>Số phòng tách bằng số lượng phòng gốc, không cần phải tách !</p>";
                                    }elseif ($_POST['sl_dt'] != $_POST['sl_gd']) {
                                        $alert = "<p class='alert_tk_fail'>Số lượng phòng khách hàng và đối tác phải bằng nhau !</p>";
                                    }
                                endwhile;
                                wp_reset_postdata();
                            }

                            if(! isset($alert)){
                                $_SESSION['cut_google_sheets'] = 'true';

                                $update_trang_thai_tach_booking = array(
                                    'ID'           => $_POST['id_gd_goc'],
                                );
                                $post_update_trang_thai_tach_booking = wp_update_post($update_trang_thai_tach_booking);
                                update_field( 'trang_thai_tach_booking', 'true', $post_update_trang_thai_tach_booking );

                                $add_new_giao_dich = array(
                                    'post_title' => $_POST['ma_gd'],
                                    'post_status' => 'publish',
                                    'post_type' => 'giao_dich',
                                );

                                $post_id = wp_insert_post($add_new_giao_dich);

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
                                        var_dump($dob_str);
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_duoc_thay_doi', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_yeu_cau_kh_hoan_tat_tt_khac'){
                                        $dob_str = $_POST['ngay_yeu_cau_kh_hoan_tat_tt_khac'];
                                        var_dump($dob_str);
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_yeu_cau_kh_hoan_tat_tt_khac', $date, $post_id);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_hoan_tat_tt_cho_ks_khac2'){
                                        $dob_str = $_POST['ngay_phai_hoan_tat_tt_cho_ks_khac2'];
                                        if(!empty($dob_str)){
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
                                    }elseif($field['name'] == 'ma_gd_them_booking'){
                                        add_post_meta($post_id, 'ma_gd_them_booking', 'BTC_'.$post_id, true);
                                    }elseif($field['name'] == 'ma_gd'){
                                        add_post_meta($post_id, 'ma_gd', 'MBK_'.$post_id, true);
                                    }else{
                                        if($field['name'] != ""){
                                            add_post_meta($post_id, $field['name'], $_POST[$field['name']], true);
                                        }
                                    }
                                }

                                //lịch sử giao dịch
                                $add_lich_su_giao_dich = array(
                                    'post_title' => $_POST['ma_gd'],
                                    'post_status' => 'publish',
                                    'post_type' => 'history_giao_dich',
                                );

                                $post_lich_su_gd = wp_insert_post($add_lich_su_giao_dich);

                                $group_ID_ls = '6';
                                $fields_ls = acf_get_fields($group_ID_ls);
                                foreach ($fields_ls as $field){
                                    if($field['name'] == 'sl_gd'){
                                        add_post_meta($post_lich_su_gd, 'sl_gd', $_POST['sl_gd'], true);
                                    }elseif($field['name'] == 'sl_dt'){
                                        add_post_meta($post_lich_su_gd, 'sl_dt', $_POST['sl_dt'], true);
                                    }elseif($field['name'] == 'booking_lk'){
                                        add_post_meta($post_lich_su_gd, 'booking_lk', 'true', true);
                                    }elseif($field['name'] == 'ci_gd'){
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
                                    }elseif($field['name'] == 'ma_gd_them_booking'){
                                        add_post_meta($post_lich_su_gd, 'ma_gd_them_booking', 'BTC_'.$post_id, true);
                                    }elseif($field['name'] == 'ma_gd'){
                                        add_post_meta($post_lich_su_gd, 'ma_gd', 'MBK_'.$post_id, true);
                                    }else{
                                        if($field['name'] != ""){
                                            add_post_meta($post_lich_su_gd, $field['name'], $_POST[$field['name']], true);
                                        }
                                    }
                                }

                                add_post_meta($post_lich_su_gd, 'nguoi_sua', $_SESSION['name'], true);
                                add_post_meta($post_lich_su_gd, 'hanh_dong', 'Tách booking', true);
                                add_post_meta($post_lich_su_gd, 'thoi_gian_sua', $date_check, true);

                                //Tách 2

                                $add_new_giao_dich_2 = array(
                                    'post_title' => $_POST['ma_gd'].'t',
                                    'post_status' => 'publish',
                                    'post_type' => 'giao_dich',
                                );

                                $post_id_2 = wp_insert_post($add_new_giao_dich_2);

                                $_SESSION['cup_mkb'] = 'MBK_'.$post_id_2;

                                $sl_gd_cup = $slp_tach;
                                $so_dem_gd_cup = (int)$_POST['so_dem_gd'];
                                $don_gia_ban_gd_cup = $_POST['don_gia_ban_gd'];
                                $don_gia_ban_gd_cup = str_replace(',','',$don_gia_ban_gd_cup);
                                $don_gia_ban_gd_cup = str_replace(',','',$don_gia_ban_gd_cup);
                                $don_gia_ban_gd_cup = str_replace(',','',$don_gia_ban_gd_cup);

                                $don_gia_ban_dt_cup = $_POST['don_gia_ban_dt'];
                                $don_gia_ban_dt_cup = str_replace(',','',$don_gia_ban_dt_cup);
                                $don_gia_ban_dt_cup = str_replace(',','',$don_gia_ban_dt_cup);
                                $don_gia_ban_dt_cup = str_replace(',','',$don_gia_ban_dt_cup);

                                $tong_phu_thu_khac = $_POST['tong_phu_thu_khac'];
                                $tong_phu_thu_khac = str_replace(',','',$tong_phu_thu_khac);
                                $tong_phu_thu_khac = str_replace(',','',$tong_phu_thu_khac);
                                $tong_phu_thu_khac = str_replace(',','',$tong_phu_thu_khac);

                                $giam_gia_cho_kh_khac = $_POST['giam_gia_cho_kh_khac'];
                                $giam_gia_cho_kh_khac = str_replace(',','',$giam_gia_cho_kh_khac);
                                $giam_gia_cho_kh_khac = str_replace(',','',$giam_gia_cho_kh_khac);
                                $giam_gia_cho_kh_khac = str_replace(',','',$giam_gia_cho_kh_khac);

                                $giam_gia_cua_dt_khac2 = $_POST['giam_gia_cua_dt_khac2'];
                                $giam_gia_cua_dt_khac2 = str_replace(',','',$giam_gia_cua_dt_khac2);
                                $giam_gia_cua_dt_khac2 = str_replace(',','',$giam_gia_cua_dt_khac2);
                                $giam_gia_cua_dt_khac2 = str_replace(',','',$giam_gia_cua_dt_khac2);

                                $da_thanh_toan_khac = $_POST['da_thanh_toan_khac'];
                                $da_thanh_toan_khac = str_replace(',','',$da_thanh_toan_khac);
                                $da_thanh_toan_khac = str_replace(',','',$da_thanh_toan_khac);
                                $da_thanh_toan_khac = str_replace(',','',$da_thanh_toan_khac);

                                $da_thanh_toan_khac2 = $_POST['da_thanh_toan_khac2'];
                                $da_thanh_toan_khac2 = str_replace(',','',$da_thanh_toan_khac2);
                                $da_thanh_toan_khac2 = str_replace(',','',$da_thanh_toan_khac2);
                                $da_thanh_toan_khac2 = str_replace(',','',$da_thanh_toan_khac2);

                                $tong_gd_cup = $don_gia_ban_gd_cup * $sl_gd_cup;
                                $tong_gd_cup = $tong_gd_cup * $so_dem_gd_cup;

                                $tong_dt_cup = $don_gia_ban_dt_cup * $sl_gd_cup;
                                $tong_dt_cup = $tong_dt_cup * $so_dem_gd_cup;

                                $tong_gia_tri_khac = $tong_phu_thu_khac + $tong_gd_cup;
                                $tong_gia_tri_khac = $tong_gia_tri_khac - $giam_gia_cho_kh_khac;

                                $tong_gia_tri_khac2 = $tong_phu_thu_khac + $tong_dt_cup;
                                $tong_gia_tri_khac2 = $tong_gia_tri_khac2 - $giam_gia_cua_dt_khac2;

                                $kh_con_no_khac = $tong_gia_tri_khac - $da_thanh_toan_khac;
                                $bct_con_no_khac2 = $tong_gia_tri_khac2 - $da_thanh_toan_khac2;

                                $group_ID_2 = '6';
                                $fields_2 = acf_get_fields($group_ID_2);
                                foreach ($fields_2 as $field){
                                    if($field['name'] == 'sl_gd'){
                                        add_post_meta($post_id_2, 'sl_gd', $slp_tach, true);
                                    }elseif($field['name'] == 'sl_dt'){
                                        add_post_meta($post_id_2, 'sl_dt', $slp_tach, true);
                                    }elseif($field['name'] == 'tong_gd'){
                                        add_post_meta($post_id_2, 'tong_gd', $tong_gd_cup, true);
                                    }elseif($field['name'] == 'tong_dt'){
                                        add_post_meta($post_id_2, 'tong_dt', $tong_dt_cup, true);
                                    }elseif($field['name'] == 'tien_chua_pt_khac2'){
                                        add_post_meta($post_id_2, 'tien_chua_pt_khac2', $tong_dt_cup, true);
                                    }elseif($field['name'] == 'tong_gia_tri_khac2'){
                                        add_post_meta($post_id_2, 'tong_gia_tri_khac2', $tong_gia_tri_khac2, true);
                                    }elseif($field['name'] == 'tien_chua_pt_khac2'){
                                        add_post_meta($post_id_2, 'tien_chua_pt_khac2', $tong_dt_cup, true);
                                    }elseif($field['name'] == 'tien_chua_pt_khac'){
                                        add_post_meta($post_id_2, 'tien_chua_pt_khac', $tong_gd_cup, true);
                                    }elseif($field['name'] == 'tong_gia_tri_khac'){
                                        add_post_meta($post_id_2, 'tong_gia_tri_khac', $tong_gia_tri_khac, true);
                                    }elseif($field['name'] == 'kh_con_no_khac'){
                                        add_post_meta($post_id_2, 'kh_con_no_khac', $kh_con_no_khac, true);
                                    }elseif($field['name'] == 'bct_con_no_khac2'){
                                        add_post_meta($post_id_2, 'bct_con_no_khac2', $bct_con_no_khac2, true);
                                    }elseif($field['name'] == 'ci_gd'){
                                        $dob_str = $_POST['ci_gd'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ci_gd', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'co_gd'){
                                        $dob_str = $_POST['co_gd'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('co_gd', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_duoc_huy'){
                                        $dob_str = $_POST['ngay_duoc_huy'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_duoc_huy', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_duoc_thay_doi'){
                                        $dob_str = $_POST['ngay_duoc_thay_doi'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_duoc_thay_doi', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_yeu_cau_kh_hoan_tat_tt_khac'){
                                        $dob_str = $_POST['ngay_yeu_cau_kh_hoan_tat_tt_khac'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_yeu_cau_kh_hoan_tat_tt_khac', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_hoan_tat_tt_cho_ks_khac2'){
                                        $dob_str = $_POST['ngay_phai_hoan_tat_tt_cho_ks_khac2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_hoan_tat_tt_cho_ks_khac2', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_coc_1'){
                                        $dob_str = $_POST['ngay_coc_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_coc_1', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_tt_lan_2_1'){
                                        $dob_str = $_POST['ngay_tt_lan_2_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_tt_lan_2_1', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_tt_lan_3_1'){
                                        $dob_str = $_POST['ngay_tt_lan_3_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_tt_lan_3_1', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_hoan_tien_1'){
                                        $dob_str = $_POST['ngay_hoan_tien_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_hoan_tien_1', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_coc_di_2'){
                                        $dob_str = $_POST['ngay_phai_coc_di_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_coc_di_2', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_di_lan_2_2'){
                                        $dob_str = $_POST['ngay_phai_di_lan_2_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_di_lan_2_2', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_di_lan_3_2'){
                                        $dob_str = $_POST['ngay_phai_di_lan_3_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_di_lan_3_2', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ngay_hoan_tien_2'){
                                        $dob_str = $_POST['ngay_hoan_tien_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_hoan_tien_2', $date, $post_id_2);
                                        }
                                    }elseif($field['name'] == 'ma_gd_them_booking'){
                                        add_post_meta($post_id_2, 'ma_gd_them_booking', 'BTC_'.$post_id_2, true);
                                    }elseif($field['name'] == 'ma_gd'){
                                        add_post_meta($post_id_2, 'ma_gd', 'MBK_'.$post_id_2, true);
                                    }else{
                                        if($field['name'] != ""){
                                            add_post_meta($post_id_2, $field['name'], $_POST[$field['name']], true);
                                        }
                                    }
                                }

                                //lịch sử giao dịch
                                $add_lich_su_giao_dich_2 = array(
                                    'post_title' => $_POST['ma_gd'].'t',
                                    'post_status' => 'publish',
                                    'post_type' => 'history_giao_dich',
                                );

                                $post_lich_su_gd_2 = wp_insert_post($add_lich_su_giao_dich_2);

                                $group_ID_ls_2 = '6';
                                $fields_ls_2 = acf_get_fields($group_ID_ls_2);
                                foreach ($fields_ls_2 as $field){
                                    if($field['name'] == 'sl_gd'){
                                        add_post_meta($post_lich_su_gd_2, 'sl_gd', $slp_tach, true);
                                    }elseif($field['name'] == 'sl_dt'){
                                        add_post_meta($post_lich_su_gd_2, 'sl_dt', $slp_tach, true);
                                    }elseif($field['name'] == 'sl_gd'){
                                        add_post_meta($post_lich_su_gd_2, 'sl_gd', $slp_tach, true);
                                    }elseif($field['name'] == 'sl_dt'){
                                        add_post_meta($post_lich_su_gd_2, 'sl_dt', $slp_tach, true);
                                    }elseif($field['name'] == 'ma_gd'){
                                        add_post_meta($post_lich_su_gd_2, 'ma_gd', $_POST['ma_gd'].'t', true);
                                    }elseif($field['name'] == 'ma_xac_nhan'){
                                        add_post_meta($post_lich_su_gd_2, 'ma_xac_nhan', $_POST['ma_xac_nhan'].'t', true);
                                    }elseif($field['name'] == 'booking_lk'){
                                        add_post_meta($post_lich_su_gd_2, 'booking_lk', 'true', true);
                                    }elseif($field['name'] == 'ci_gd'){
                                        $dob_str = $_POST['ci_gd'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ci_gd', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'co_gd'){
                                        $dob_str = $_POST['co_gd'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('co_gd', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_duoc_huy'){
                                        $dob_str = $_POST['ngay_duoc_huy'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_duoc_huy', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_duoc_thay_doi'){
                                        $dob_str = $_POST['ngay_duoc_thay_doi'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_duoc_thay_doi', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_yeu_cau_kh_hoan_tat_tt_khac'){
                                        $dob_str = $_POST['ngay_yeu_cau_kh_hoan_tat_tt_khac'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_yeu_cau_kh_hoan_tat_tt_khac', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_hoan_tat_tt_cho_ks_khac2'){
                                        $dob_str = $_POST['ngay_phai_hoan_tat_tt_cho_ks_khac2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_hoan_tat_tt_cho_ks_khac2', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_coc_1'){
                                        $dob_str = $_POST['ngay_coc_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_coc_1', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_tt_lan_2_1'){
                                        $dob_str = $_POST['ngay_tt_lan_2_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_tt_lan_2_1', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_tt_lan_3_1'){
                                        $dob_str = $_POST['ngay_tt_lan_3_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_tt_lan_3_1', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_hoan_tien_1'){
                                        $dob_str = $_POST['ngay_hoan_tien_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_hoan_tien_1', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_coc_di_2'){
                                        $dob_str = $_POST['ngay_phai_coc_di_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_coc_di_2', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_di_lan_2_2'){
                                        $dob_str = $_POST['ngay_phai_di_lan_2_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_di_lan_2_2', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_di_lan_3_2'){
                                        $dob_str = $_POST['ngay_phai_di_lan_3_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_di_lan_3_2', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ngay_hoan_tien_2'){
                                        $dob_str = $_POST['ngay_hoan_tien_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_hoan_tien_2', $date, $post_lich_su_gd_2);
                                        }
                                    }elseif($field['name'] == 'ma_gd_them_booking'){
                                        add_post_meta($post_lich_su_gd_2, 'ma_gd_them_booking', 'BTC_'.$post_id_2, true);
                                    }elseif($field['name'] == 'ma_gd'){
                                        add_post_meta($post_lich_su_gd_2, 'ma_gd', 'MBK_'.$post_id_2, true);
                                    }else{
                                        if($field['name'] != ""){
                                            add_post_meta($post_lich_su_gd_2, $field['name'], $_POST[$field['name']], true);
                                        }
                                    }
                                }

                                add_post_meta($post_lich_su_gd_2, 'nguoi_sua', $_SESSION['name'], true);
                                add_post_meta($post_lich_su_gd_2, 'hanh_dong', 'Tách booking', true);
                                add_post_meta($post_lich_su_gd_2, 'thoi_gian_sua', $date_check, true);

                                wp_redirect(get_permalink($post_id));
                                exit;
                            }

                            if(isset($alert)){
                                echo $alert;
                                echo '<a href="javascript:history.back()" class="phuc_hoi">Click phục hồi các giá trị cần tách !</a>';
                            }else{
                                echo $alert = "<p class='alert_tk_sucess'>Lưu giao dịch thành công !</p>";
                            }
                        }
                        ?>

                        <?php
                        include get_template_directory().'/template-parts/inc/template_booking.php';
                        ?>

                        <div class="acf-form-submit save_tach_bk">
                            <input type="submit" name="sub_new_giao_dich" class="sub_new_giao_dich" value="Lưu tách booking">
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