<?php
/*
 * Template Name: Thêm mới khách sạn*/

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
        <?php
        if (isset($_POST['sub_new_khach_san'])) {
            $array_user = array(
                'post_type' => 'khach_san',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_the_title() == $_POST['ten_ks']) {
                        $alert = "<p class='alert_tk_fail'>Tên khách sạn đã tồn tại !</p>";
                    } elseif (get_field('stk_ks') == $_POST['stk_ks']) {
                        $alert = "<p class='alert_tk_fail'>Số tài khoản đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if (!isset($alert)) {
                $add_new_khach_san = array(
                    'post_title' => $_POST['ten_ks'],
                    'post_status' => 'publish',
                    'post_type' => 'khach_san',
                );

                $post_id = wp_insert_post($add_new_khach_san);

                add_post_meta($post_id, 'id_khach_sạn', $_POST['id_khach_sạn'], true);
                add_post_meta($post_id, 'ma_ks', $_POST['ma_ks'], true);
                add_post_meta($post_id, 'ten_ks', $_POST['ten_ks'], true);
                add_post_meta($post_id, 'mst_ks', $_POST['mst_ks'], true);
                add_post_meta($post_id, 'stk_ks', $_POST['stk_ks'], true);
                add_post_meta($post_id, 'khu_vuc_ks', $_POST['khu_vuc_ks'], true);
                add_post_meta($post_id, 'dia_chi_ks', $_POST['dia_chi_ks'], true);
                add_post_meta($post_id, 'email_sale_ks', $_POST['email_sale_ks'], true);
                add_post_meta($post_id, 'sdt_sale_ks', $_POST['sdt_sale_ks'], true);
                add_post_meta($post_id, 'email_dat_phong', $_POST['email_dat_phong'], true);
                add_post_meta($post_id, 'sdt_dat_phong', $_POST['sdt_dat_phong'], true);
                add_post_meta($post_id, 'link_hd_goc', $_POST['link_hd_goc'], true);
                add_post_meta($post_id, 'loai_phong_ks', $_POST['loai_phong_ks'], true);

                $alert = "<p class='alert_tk_sucess'>Thêm khách sạn thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san">
                <form action="<?php echo home_url('/'); ?>them-moi-khach-san" method="post" enctype="multipart/form-data">
                <div class="add_hotel">
                    <div class="item">
                        <h1>Thêm mới khách sạn</h1>
                        <ul>
                            <li>
                                <label>ID Khách sạn</label>
                                <input type="text" name="id_khach_sạn" class="id_khach_sạn" value="<?php echo get_the_ID(); ?>" required>
                            </li>
                            <li>
                                <label>Mã Khách sạn</label>
                                <input type="email" name="ma_ks" class="ma_ks" required>
                            </li>
                            <li>
                                <label>Tên Khách sạn</label>
                                <input type="text" name="ten_ks" class="ten_ks" required>
                            </li>
                            <li>
                                <label>MST Khách sạn</label>
                                <input type="text" name="mst_ks" class="mst_ks">
                            </li>
                            <li>
                                <label>STK Khách sạn</label>
                                <input type="number" name="stk_ks" class="stk_ks">
                            </li>
                            <li>
                                <label>Khu vực Khách sạn</label>
                                <select name="khu_vuc_ks" class="khu_vuc_ks">
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
                                <label>Địa chỉ</label>
                                <input type="text" name="dia_chi_ks" class="dia_chi_ks">
                            </li>
                            <li>
                                <label>Email sale Khách sạn</label>
                                <input type="email" name="email_sale_ks" class="email_sale_ks">
                            </li>
                            <li>
                                <label>SĐT sale Khách sạn</label>
                                <input type="text" name="sdt_sale_ks" class="sdt_sale_ks">
                            </li>
                            <li>
                                <label>Email đặt phòng</label>
                                <input type="email" name="email_dat_phong" class="email_dat_phong">
                            </li>
                            <li>
                                <label>SĐT đặt phòng</label>
                                <input type="number" name="sdt_dat_phong" class="sdt_dat_phong">
                            </li>
                            <li>
                                <label>Link HĐ gốc</label>
                                <input type="text" name="link_hd_goc" class="link_hd_goc">
                            </li>
                            <div class="get_alert" style="text-align: center;"></div>
                            <?php if ($alert) {
                                echo $alert;
                            } ?>
                        </ul>
                        <div class="acf-form-submit">
                            <input type="submit" name="sub_new_khach_san" value="Thêm mới">
                        </div>
                    </div>

                    <div class="item">
                        <h1>Giá phòng và loại phòng</h1>

                        <ul>
                            <li>
                                <label>Loại phòng : </label>
                                <input type="text" class="ten_phong_ks">
                            </li>
                            <li>
                                <label>Giá phòng : </label>
                                <input type="text" class="gia_phong_ks">
                                <button type="button" class="add_rom">Thêm</button>
                            </li>
                            <li>
                                <strong>Danh sách loại phòng</strong>
                                <div class="loai_phong"></div>
                                <input type="hidden" name="loai_phong_ks" class="loai_phong_ks">
                            </li>
                        </ul>
                    </div>
                </div>
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
