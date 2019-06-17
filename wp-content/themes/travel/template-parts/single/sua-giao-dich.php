<?php
    $ID_GD = get_the_ID();
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

    $sl_nl = get_field('sl_nl');
    $gp = get_field('gp');
    $sl02 = get_field('sl02');
    $sl24 = get_field('sl24');
    $sl46 = get_field('sl46');
    $sl612 = get_field('sl612');
    $pt_nguoi = get_field('pt_nguoi');
    $pt_giai_doan = get_field('pt_giai_doan');
    $pt_cuoi_tuan = get_field('pt_cuoi_tuan');
    $bua_an_bat_buoc = get_field('bua_an_bat_buoc');
    $dich_vu_khac = get_field('dich_vu_khac');
    $tong_pt = get_field('tong_pt');
    $kh_tt_pt_tai = get_field('kh_tt_pt_tai');
    $danh_sach_doan_yeu_cau_khac = get_field('danh_sach_doan_yeu_cau_khac');
    $tien_chua_pt_khac = get_field('tien_chua_pt_khac');
    $tong_phu_thu_khac = get_field('tong_phu_thu_khac');
    $giam_gia_cho_kh_khac = get_field('giam_gia_cho_kh_khac');
    $tong_gia_tri_khac = get_field('tong_gia_tri_khac');
    $da_thanh_toan_khac = get_field('da_thanh_toan_khac');
    $kh_con_no_khac = get_field('kh_con_no_khac');
    $ngay_yeu_cau_kh_hoan_tat_tt_khac = get_field('ngay_yeu_cau_kh_hoan_tat_tt_khac');
    $lai_lo_khac = get_field('lai_lo_khac');
    $thue_vat_khac = get_field('thue_vat_khac');
    $thue_tndn_khac = get_field('thue_tndn_khac');
    $cp_marketing_khac = get_field('cp_marketing_khac');
    $cp_hau_can_khac = get_field('cp_hau_can_khac');
    $cp_hau_mai_khac = get_field('cp_hau_mai_khac');
    $cp_co_dinh_khac = get_field('cp_co_dinh_khac');
    $tien_chua_pt_khac2 = get_field('tien_chua_pt_khac2');
    $ghi_chu_cua_dt_khac2 = get_field('ghi_chu_cua_dt_khac2');
    $tong_phu_thu_khac2 = get_field('tong_phu_thu_khac2');
    $giam_gia_cua_dt_khac2 = get_field('giam_gia_cua_dt_khac2');
    $tong_gia_tri_khac2 = get_field('tong_gia_tri_khac2');
    $da_thanh_toan_khac2 = get_field('da_thanh_toan_khac2');
    $bct_con_no_khac2 = get_field('bct_con_no_khac2');
    $ngay_phai_hoan_tat_tt_cho_ks_khac2 = get_field('ngay_phai_hoan_tat_tt_cho_ks_khac2');

    $don_gia_ban_gd = get_field('don_gia_ban_gd');
    $don_gia_ban_dt = get_field('don_gia_ban_dt');

    $trang_thai_add_booking = get_field('trang_thai_add_booking');
?>
<div id="content" data-check="<?php if(isset($_SESSION['add_google_sheets'])){echo $_SESSION['add_google_sheets'];} ?>" class="<?php if(isset($_GET['view'])){echo "view_fix";} ?>">
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
            <div class="giao_dich_moi">
                <div class="them_giao_dich sua_giao_dich">
                    <?php
                        $trang_thai_tach_booking = get_field('trang_thai_tach_booking');
                        $booking_lk = get_field('booking_lk');
                        $sl_dt = get_field('sl_dt');
                        $sl_gd = get_field('sl_gd');
                        if(get_field('trang_thai_tach_booking') != 'true') :
                            if($sl_dt > 1 || $sl_gd > 1){
                                ?>
                                <form action="<?php echo get_home_url('/'); ?>/tach-booking" method="post">
                                    <div class="acf-form-submit <?php if ($booking_lk == 'true') {
                                        echo 'fix_tach_gd';
                                    } ?>" style="bottom: 105px;">
                                        <?php
                                        $group_ID = '6';
                                        $fields = acf_get_fields($group_ID);
                                        foreach ($fields as $field) {
                                            ?>
                                            <input type="hidden" class="<?php echo $field['name'].'_t'; ?>" name="<?php echo $field['name']; ?>"
                                                   value="<?php echo get_field($field['name']); ?>">
                                            <?php
                                        }
                                        ?>
                                        <input type="hidden" name="so_phong_goc"
                                               value="<?php echo get_field('sl_gd'); ?>">
                                        <input type="hidden" name="id_gd_goc" value="<?php echo get_the_ID(); ?>">

                                        <?php
                                        if(get_field('trang_thai_add_booking') != 'true'){
                                            ?>
                                            <input type="submit" name="sub_tach_giao_dich" class="sub_tach_giao_dich"
                                                   value="Tách Giao dịch">
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </form>
                                <?php
                            }
                        endif;
                    ?>
                    <?php
                    if($trang_thai_tach_booking != 'true'){
                        if($booking_lk != 'true'){
                            ?>
                            <form action="<?php echo get_home_url('/'); ?>/add-booking" method="post">
                                <div class="acf-form-submit" style="bottom: 60px;">
                                    <?php
                                    $group_ID = '6';
                                    $fields = acf_get_fields($group_ID);
                                    foreach ($fields as $field) {
                                        ?>
                                        <input type="hidden" class="<?php echo $field['name'] . '_add'; ?>"
                                               name="<?php echo $field['name']; ?>"
                                               value="<?php echo get_field($field['name']); ?>">
                                        <?php
                                    }
                                    ?>
                                    <?php
                                        if(get_field('trang_thai_add_booking') != 'true'){
                                            ?><input type="submit" name="add_edit_giao_dich" class="add_edit_giao_dich" value="Thêm giao dịch"><?php
                                        }
                                    ?>
                                </div>
                            </form>
                            <?php
                        }
                    }
                    ?>
                    <form action="<?php echo get_the_permalink(); ?>" method="post">
                        <?php
                        if(isset($_POST['sub_edit_giao_dich'])){
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $date_check = date('d-m-Y H:i:s');

                            $this_ma_dich_vu_gd = get_field('ma_dich_vu_gd');
                            $this_ma_dt = get_field('ma_dt');
                            $this_ma_gd = get_field('ma_gd');
                            $this_ma_xac_nhan = get_field('ma_xac_nhan');
                            $this_ma_pro_dt = get_field('ma_pro_dt');
                            $this_ma_kgd = get_field('ma_kgd');
                            $this_ma_gd_hoan_tien_1 = get_field('ma_gd_hoan_tien_1');
                            $this_ma_gd_hoan_tien_2 = get_field('ma_gd_hoan_tien_2');
                            $this_ID = get_the_ID();

                            $array_gd = array(
                                'post_type' => 'giao_dich',
                                'post_status' => 'publish'
                            );

                            $query = new WP_Query($array_gd);

                            $so_phong_goc = get_field('sl_gd');

                            if ($query->have_posts()) {
                                while ($query->have_posts()) : $query->the_post();
                                    if (get_field('ma_xac_nhan') == $_POST['ma_xac_nhan'] and $this_ma_xac_nhan != $_POST['ma_xac_nhan']) {
                                        $alert = "<p class='alert_tk_fail'>Mã xác nhận đã tồn tại !</p>";
                                    }elseif (get_field('ma_gd') == $_POST['ma_gd'] and $this_ma_gd != $_POST['ma_gd']) {
                                        $alert = "<p class='alert_tk_fail'>Mã giao dịch đã tồn tại !</p>";
                                    }elseif ($_POST['sl_dt'] != $_POST['sl_gd']) {
                                        $alert = "<p class='alert_tk_fail'>Số lượng phòng khách hàng và đối tác phải bằng nhau !</p>";
                                    }
                                    if($booking_lk == 'true'){
                                        if($_POST['sl_gd'] < 1){
                                            $alert = "<p class='alert_tk_fail'>Số phòng không được nhỏ hơn 0 !</p>";
                                        }elseif($_POST['sl_gd'] > $so_phong_goc){
                                            $alert = "<p class='alert_tk_fail'>Số phòng tách vượt quá số lượng phòng gốc !</p>";
                                        }elseif($_POST['sl_dt'] < 1){
                                            $alert = "<p class='alert_tk_fail'>Số phòng không được nhỏ hơn 0 !</p>";
                                        }elseif($_POST['sl_dt'] > $so_phong_goc){
                                            $alert = "<p class='alert_tk_fail'>Số phòng tách vượt quá số lượng phòng gốc !</p>";
                                        }
                                    }
                                endwhile;
                                wp_reset_postdata();
                            }

                            if(! isset($alert)){
                                $update_giao_dich = array(
                                    'ID'           => $this_ID,
                                );

                                $post_update = wp_update_post($update_giao_dich);

                                $group_ID = '6';
                                $fields = acf_get_fields($group_ID);
                                foreach ($fields as $field){
                                    if($field['name'] == 'ci_gd'){
                                        $dob_str = $_POST['ci_gd'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ci_gd', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'co_gd'){
                                        $dob_str = $_POST['co_gd'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('co_gd', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_duoc_huy'){
                                        $dob_str = $_POST['ngay_duoc_huy'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_duoc_huy', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_duoc_thay_doi'){
                                        $dob_str = $_POST['ngay_duoc_thay_doi'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_duoc_thay_doi', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_yeu_cau_kh_hoan_tat_tt_khac'){
                                        $dob_str = $_POST['ngay_yeu_cau_kh_hoan_tat_tt_khac'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_yeu_cau_kh_hoan_tat_tt_khac', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_hoan_tat_tt_cho_ks_khac2'){
                                        $dob_str = $_POST['ngay_phai_hoan_tat_tt_cho_ks_khac2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_hoan_tat_tt_cho_ks_khac2', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_coc_1'){
                                        $dob_str = $_POST['ngay_coc_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_coc_1', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_tt_lan_2_1'){
                                        $dob_str = $_POST['ngay_tt_lan_2_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_tt_lan_2_1', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_tt_lan_3_1'){
                                        $dob_str = $_POST['ngay_tt_lan_3_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_tt_lan_3_1', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_hoan_tien_1'){
                                        $dob_str = $_POST['ngay_hoan_tien_1'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_hoan_tien_1', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_coc_di_2'){
                                        $dob_str = $_POST['ngay_phai_coc_di_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_coc_di_2', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_di_lan_2_2'){
                                        $dob_str = $_POST['ngay_phai_di_lan_2_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_di_lan_2_2', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_phai_di_lan_3_2'){
                                        $dob_str = $_POST['ngay_phai_di_lan_3_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_phai_di_lan_3_2', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_hoan_tien_2'){
                                        $dob_str = $_POST['ngay_hoan_tien_2'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_hoan_tien_2', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_lock_phong_khach'){
                                        $dob_str = $_POST['ngay_lock_phong_khach'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_lock_phong_khach', $date, $post_update);
                                        }
                                    }elseif($field['name'] == 'ngay_lock_phong_doi_tac'){
                                        $dob_str = $_POST['ngay_lock_phong_doi_tac'];
                                        if(!empty($dob_str)){
                                            $date = DateTime::createFromFormat('d/m/Y', $dob_str);
                                            $date = $date->format('Ymd');
                                            update_field('ngay_lock_phong_doi_tac', $date, $post_update);
                                        }
                                    }else{
                                        if($field['name'] != ""){
                                            update_field( $field['name'], $_POST[$field['name']], $post_update );
                                        }
                                    }
                                }
                            }

                            if(isset($alert)){
                                echo '<p class="alert">'.$alert.'</p>';
                            }else{
                                echo '<meta http-equiv="refresh" content="0">';
                                echo $alert = "<p class='alert_tk_sucess'>Cập nhập giao dịch thành công !</p>";
                            }


                            //lịch sử giao dịch
                            $add_lich_su_giao_dich = array(
                                'post_title' => $_POST['title_new_post'],
                                'post_status' => 'publish',
                                'post_type' => 'history_giao_dich',
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
                                }else{
                                    if($field['name'] != ""){
                                        add_post_meta($post_lich_su_gd, $field['name'], $_POST[$field['name']], true);
                                    }
                                }
                            }

                            add_post_meta($post_lich_su_gd, 'nguoi_sua', $_SESSION['name'], true);
                            add_post_meta($post_lich_su_gd, 'hanh_dong', 'Sửa giao dịch', true);
                            add_post_meta($post_lich_su_gd, 'thoi_gian_sua', $date_check, true);

                            //echo "<meta http-equiv='refresh' content='0'>";
                        }
                        ?>

                        <?php
                        include get_template_directory().'/template-parts/inc/template_booking.php';
                        ?>

                        <?php
                        if($trang_thai_tach_booking == 'true'){
                            ?>
                            <div class="acf-form-submit">
                                <input type="button" name="sub_tach_giao_dich" class="sub_tach_giao_dich" style="background: #d1c8c7;cursor: inherit;" value="GD đã tách" disabled>
                            </div>
                            <?php
                        }elseif($trang_thai_add_booking != 'true'){
                            ?>
                            <div class="acf-form-submit" data-img="<?php echo get_template_directory_uri().'/assets/images/img.png'; ?>">
                                <input type="submit" name="sub_edit_giao_dich" value="Cập nhập">
                            </div>
                            <?php
                        }else{
                            if($booking_lk != 'true'){
                                ?>
                                <div class="acf-form-submit" data-img="<?php echo get_template_directory_uri().'/assets/images/img.png'; ?>">
                                    <input type="submit" name="sub_edit_giao_dich" value="Cập nhập">
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
