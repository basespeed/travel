<?php
/*
 * Template Name: Thêm mới nhân viên*/

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
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-1',
                'menu_id' => 'primary-menu',
                'menu' => 'Admin'
            ));
            ?>
        </div>
        <?php
        if (isset($_POST['sub_new_nv'])) {
            $array_user = array(
                'post_type' => 'nhan_vien',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_field('ma_nv') == $_POST['ma_nv']) {
                        $alert = "<p class='alert_tk_fail'>Mã nhân viên đã tồn tại !</p>";
                    } elseif (get_field('email_nv') == $_POST['email_nv']) {
                        $alert = "<p class='alert_tk_fail'>Email đã tồn tại !</p>";
                    } elseif (get_field('sdt_nv') == $_POST['sdt_nv']) {
                        $alert = "<p class='alert_tk_fail'>Số điện thoại đã tồn tại !</p>";
                    } elseif (get_field('nick_nv') == $_POST['nick_nv']) {
                        $alert = "<p class='alert_tk_fail'>Nick đã tồn tại !</p>";
                    } elseif (get_field('link_fb_nv') == $_POST['link_fb_nv']) {
                        $alert = "<p class='alert_tk_fail'>Link đã tồn tại !</p>";
                    } elseif (get_field('uidfb_nv') == $_POST['uidfb_nv']) {
                        $alert = "<p class='alert_tk_fail'>Uidfb đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if (!isset($alert)) {
                $add_new_khach_san = array(
                    'post_title' => $_POST['email_nv'],
                    'post_status' => 'publish',
                    'post_type' => 'nhan_vien',
                );

                $post_id = wp_insert_post($add_new_khach_san);

                add_post_meta($post_id, 'id_nhan_vien', $_POST['id_nhan_vien'], true);
                add_post_meta($post_id, 'ma_nv', $_POST['ma_nv'], true);
                add_post_meta($post_id, 'ten_nv', $_POST['ten_nv'], true);
                add_post_meta($post_id, 'email_nv', $_POST['email_nv'], true);
                add_post_meta($post_id, 'sdt_nv', $_POST['sdt_nv'], true);
                add_post_meta($post_id, 'muc_do_uu_tien', $_POST['muc_do_uu_tien'], true);
                add_post_meta($post_id, 'nick_nv', $_POST['nick_nv'], true);
                add_post_meta($post_id, 'bo_phan_nv', $_POST['bo_phan_nv'], true);
                add_post_meta($post_id, 'link_fb_nv', $_POST['link_fb_nv'], true);
                add_post_meta($post_id, 'uidfb_nv', $_POST['uidfb_nv'], true);
                add_post_meta($post_id, 'lien_ket_tai_khoan', abs( crc32( uniqid() ) ), true);

                $alert = "<p class='alert_tk_sucess'>Thêm nhân viên thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san">
                <h1>Thêm mới nhân viên</h1>
                <form action="<?php echo home_url('/'); ?>them-moi-nhan-vien" method="post"
                      enctype="multipart/form-data">
                    <ul>
                        <li>
                            <label>ID Nhân viên</label>
                            <input type="text" name="id_nhan_vien" class="id_nhan_vien" required>
                        </li>
                        <li>
                            <label>Mã NV</label>
                            <input type="email" name="ma_nv" class="ma_nv" required>
                        </li>
                        <li>
                            <label>Tên NV</label>
                            <input type="text" name="ten_nv" class="ten_nv" required>
                        </li>
                        <li>
                            <label>Email NV</label>
                            <input type="email" name="email_nv" class="email_nv" required>
                        </li>
                        <li>
                            <label>SĐT NV</label>
                            <input type="number" name="sdt_nv" class="sdt_nv" required>
                        </li>
                        <li>
                            <label>Bộ phận NV</label>
                            <select name="bo_phan_nv" class="bo_phan_nv" required>
                                <option value="Quản lý">Quản lý</option>
                                <option value="Sales">Sales</option>
                                <option value="Booking">Booking</option>
                                <option value="Kế toán">Kế toán</option>
                            </select>
                        </li>
                        <li>
                            <label>Nick NV</label>
                            <input type="text" name="nick_nv" class="nick_nv" required>
                        </li>
                        <li>
                            <label>Link FB NV</label>
                            <input type="text" name="link_fb_nv" class="link_fb_nv" required>
                        </li>
                        <li>
                            <label>UIDFB NV</label>
                            <input type="text" name="uidfb_nv" class="uidfb_nv" required>
                        </li>
                        <div class="get_alert" style="text-align: center;"></div>
                        <?php if ($alert) {
                            echo $alert;
                        } ?>
                    </ul>
                    <div class="acf-form-submit">
                        <input type="submit" name="sub_new_nv" value="Thêm mới">
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
