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
                                <input type="text" name="id_khach_sạn" class="id_khach_sạn" required>
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
                                <input type="text" name="mst_ks" class="mst_ks" required>
                            </li>
                            <li>
                                <label>STK Khách sạn</label>
                                <input type="number" name="stk_ks" class="stk_ks" required>
                            </li>
                            <li>
                                <label>Khu vực Khách sạn</label>
                                <input type="text" name="khu_vuc_ks" class="khu_vuc_ks" required>
                            </li>
                            <li>
                                <label>Địa chỉ</label>
                                <input type="text" name="dia_chi_ks" class="dia_chi_ks" required>
                            </li>
                            <li>
                                <label>Email sale Khách sạn</label>
                                <input type="email" name="email_sale_ks" class="email_sale_ks" required>
                            </li>
                            <li>
                                <label>SĐT sale Khách sạn</label>
                                <input type="text" name="sdt_sale_ks" class="sdt_sale_ks" required>
                            </li>
                            <li>
                                <label>Email đặt phòng</label>
                                <input type="email" name="email_dat_phong" class="email_dat_phong" required>
                            </li>
                            <li>
                                <label>SĐT đặt phòng</label>
                                <input type="number" name="sdt_dat_phong" class="sdt_dat_phong" required>
                            </li>
                            <li>
                                <label>Link HĐ gốc</label>
                                <input type="text" name="link_hd_goc" class="link_hd_goc" required>
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
