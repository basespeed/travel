<?php
/*
 * Template Name: Thêm mới đối tác*/

if($_SESSION['sucess'] == "sucess") {
    if($_SESSION['loai_quyen_tai_khoan'] == 'Admin') {
        get_header();
        ?>
        <div id="content">
        <div class="quantri_admin">
            <?php include 'inc/template_menu.php'; ?>
            <?php
            if (isset($_POST['sub_new_doi_tac'])) {
                $array_user = array(
                    'post_type' => 'doi_tac',
                    'post_status' => 'publish'
                );

                $query = new WP_Query($array_user);


                if (!isset($alert)) {
                    $add_new_khach_san = array(
                        'post_title' => $_POST['ten_ks'],
                        'post_status' => 'publish',
                        'post_type' => 'doi_tac',
                    );

                    $post_id = wp_insert_post($add_new_khach_san);

                    add_post_meta($post_id, 'id_dt', $_POST['id_dt'], true);
                    add_post_meta($post_id, 'ma_dt', $_POST['ma_dt'], true);
                    add_post_meta($post_id, 'ten_dt', $_POST['ten_dt'], true);
                    add_post_meta($post_id, 'email_dt', $_POST['email_dt'], true);
                    add_post_meta($post_id, 'stk_dt', $_POST['stk_dt'], true);
                    add_post_meta($post_id, 'don_vi_cong_tac_dt', $_POST['don_vi_cong_tac_dt'], true);
                    add_post_meta($post_id, 'khu_vuc_dt', $_POST['khu_vuc_dt'], true);
                    add_post_meta($post_id, 'mieu_ta_dt', $_POST['mieu_ta_dt'], true);
                    add_post_meta($post_id, 'cap_bac_dt', $_POST['cap_bac_dt'], true);
                    add_post_meta($post_id, 'mst_dt', $_POST['mst_dt'], true);
                    add_post_meta($post_id, 'sdt_dt', $_POST['sdt_dt'], true);
                    add_post_meta($post_id, 'dia_chi_dt', $_POST['dia_chi_dt'], true);

                    $alert = "<p class='alert_tk_sucess'>Thêm đối tác thành công !</p>";
                }
            }
            ?>
            <div class="content_admin">
                <div class="giao_dich_moi add_user add_khach_san">
                    <h1>Thêm mới đối tác</h1>
                    <form action="<?php echo home_url('/'); ?>them-moi-doi-tac" method="post"
                          enctype="multipart/form-data">
                        <ul>
                            <li>
                                <label>ID DT</label>
                                <input type="text" name="id_dt" class="id_dt" value="<?php echo get_the_ID(); ?>">
                            </li>
                            <li>
                                <label>Mã DT</label>
                                <input type="text" name="ma_dt" class="ma_dt" value="MDT_<?php echo abs( crc32( uniqid() ) ); ?>">
                            </li>
                            <li>
                                <label>Tên DT</label>
                                <input type="text" name="ten_dt" class="ten_dt">
                            </li>
                            <li>
                                <label>Email DT</label>
                                <input type="email" name="email_dt" class="email_dt">
                            </li>
                            <li>
                                <label>STK DT</label>
                                <input type="number" name="stk_dt" class="stk_dt">
                            </li>
                            <li>
                                <label>Đơn vị công tác</label>
                                <input type="text" name="don_vi_cong_tac_dt" class="don_vi_cong_tac_dt">
                            </li>
                            <li>
                                <label>Khu vực DT</label>
                                <select name= "khu_vuc_dt" class="khu_vuc_dt">
                                    <option value="An Giang">An Giang
                                    <option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu
                                    <option value="Bắc Giang">Bắc Giang
                                    <option value="Bắc Kạn">Bắc Kạn
                                    <option value="Bạc Liêu">Bạc Liêu
                                    <option value="Bắc Ninh">Bắc Ninh
                                    <option value="Bến Tre">Bến Tre
                                    <option value="Bình Định">Quy Nhơn - Bình Định
                                    <option value="Bình Dương">Bình Dương
                                    <option value="Bình Phước">Bình Phước
                                    <option value="Bình Thuận">Mũi Né - Bình Thuận
                                    <option value="Cà Mau">Cà Mau
                                    <option value="Cao Bằng">Cao Bằng
                                    <option value="Đắk Lắk">Đắk Lắk
                                    <option value="Đắk Nông">Đắk Nông
                                    <option value="Điện Biên">Điện Biên
                                    <option value="Đồng Nai">Đồng Nai
                                    <option value="Đồng Tháp">Đồng Tháp
                                    <option value="Gia Lai">Gia Lai
                                    <option value="Hà Giang">Hà Giang
                                    <option value="Hà Nam">Hà Nam
                                    <option value="Hà Tĩnh">Hà Tĩnh
                                    <option value="Hải Dương">Hải Dương
                                    <option value="Hậu Giang">Hậu Giang
                                    <option value="Hòa Bình">Hòa Bình
                                    <option value="Hưng Yên">Hưng Yên
                                    <option value="Khánh Hòa">Khánh Hòa
                                    <option value="Kiên Giang">Kiên Giang
                                    <option value="Kon Tum">Kon Tum
                                    <option value="Lai Châu">Lai Châu
                                    <option value="Lâm Đồng">Lâm Đồng
                                    <option value="Lạng Sơn">Lạng Sơn
                                    <option value="Lào Cai">Lào Cai
                                    <option value="Long An">Long An
                                    <option value="Nam Định">Nam Định
                                    <option value="Nghệ An">Cửa Lò - Nghệ An
                                    <option value="Ninh Bình">Ninh Bình
                                    <option value="Ninh Thuận">Ninh Thuận
                                    <option value="Phú Thọ">Phú Thọ
                                    <option value="Quảng Bình">Quảng Bình
                                    <option value="Quảng Nam">Hội An - Quảng Nam
                                    <option value="Quảng Ngãi">Quảng Ngãi
                                    <option value="Quảng Ninh">Hạ Long - Quảng Ninh
                                    <option value="Quảng Trị">Quảng Trị
                                    <option value="Sóc Trăng">Sóc Trăng
                                    <option value="Sơn La">Sơn La
                                    <option value="Tây Ninh">Tây Ninh
                                    <option value="Thái Bình">Thái Bình
                                    <option value="Thái Nguyên">Thái Nguyên
                                    <option value="Thanh Hóa">Sầm Sơn - Thanh Hóa
                                    <option value="Thừa Thiên Huế">Thừa Thiên Huế
                                    <option value="Tiền Giang">Tiền Giang
                                    <option value="Trà Vinh">Trà Vinh
                                    <option value="Tuyên Quang">Tuyên Quang
                                    <option value="Vĩnh Long">Vĩnh Long
                                    <option value="Vĩnh Phúc">Vĩnh Phúc
                                    <option value="Yên Bái">Yên Bái
                                    <option value="Phú Yên">Phú Yên
                                    <option value="Cần Thơ">Cần Thơ
                                    <option value="Đà Nẵng">Đà Nẵng
                                    <option value="Hải Phòng">Hải Phòng
                                    <option value="Hà Nội">Hà Nội
                                    <option value="HCM">HCM
                                </select>
                            </li>
                            <li>
                                <label>Miêu tả DT</label>
                                <input type="text" name="mieu_ta_dt" class="mieu_ta_dt">
                            </li>
                            <li>
                                <label>Cấp bậc DT</label>
                                <input type="text" name="cap_bac_dt" class="cap_bac_dt">
                            </li>
                            <li>
                                <label>MST DT</label>
                                <input type="text" name="mst_dt" class="mst_dt">
                            </li>
                            <li>
                                <label>SĐT DT</label>
                                <input type="number" name="sdt_dt" class="sdt_dt">
                                <div class="acf-form-submit" style="margin-top: 15px;">
                                    <input type="submit" name="sub_new_doi_tac" value="Thêm mới">
                                </div>
                            </li>
                            <li>
                                <label>Địa chỉ DT</label>
                                <input type="text" name="dia_chi_dt" class="dia_chi_dt">
                            </li>
                            <div class="get_alert" style="text-align: center;"></div>
                            <?php if ($alert) {
                                echo $alert;
                            } ?>
                        </ul>
                    </form>
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
}else{
    ob_start();
    header("Location: ".home_url('/'));
    exit();
}
