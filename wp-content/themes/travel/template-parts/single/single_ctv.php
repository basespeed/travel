<?php
if($_SESSION['loai_quyen_tai_khoan'] == 'Admin') {
get_header();
?>
<div id="content">
    <div class="quantri_admin">
        <div class="menu_admin">
            <div class="info_user">
                <div class="avatar">
                    <?php
                    if (isset($_SESSION['avatar'])) {
                        echo '<img src="' . $_SESSION['avatar'] . '" alt="Ảnh đại diện">';
                    } else {
                        echo '<img src="' . get_template_directory_uri() . '/assets/images/user.png" alt="Ảnh đại diện">';
                    }
                    ?>

                </div>
                <div class="info">
                    <p><strong>Hi: </strong><?php if (isset($_SESSION['name'])) {
                            echo $_SESSION['name'];
                        } ?> !</p>
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

        $this_id_ctv = get_field('id_ctv');
        $this_ma_ctv = get_field('ma_ctv');
        $this_email_ctv = get_field('email_ctv');
        $this_sdt_ctv = get_field('sdt_ctv');
        $this_nick_ctv = get_field('nick_ctv');
        $this_link_fb_ctv = get_field('link_fb_ctv');
        $this_uidfb_ctv = get_field('uidfb_ctv');

        if (isset($_POST['sub_edit_ctv'])) {
            $array_user = array(
                'post_type' => 'ctv',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_the_title() == $_POST['id_ctv'] and $this_id_ctv != $_POST['id_ctv']) {
                        $alert = "<p class='alert_tk_fail'>ID CTV đã tồn tại !</p>";
                    } elseif (get_field('ma_ctv') == $_POST['stk_ks'] and $this_ma_ctv != $_POST['stk_ks']) {
                        $alert = "<p class='alert_tk_fail'>Mã CTV đã tồn tại !</p>";
                    } elseif (get_field('email_ctv') == $_POST['email_ctv'] and $this_email_ctv != $_POST['email_ctv']) {
                        $alert = "<p class='alert_tk_fail'>Email CTV đã tồn tại !</p>";
                    } elseif (get_field('sdt_ctv') == $_POST['sdt_ctv'] and $this_sdt_ctv != $_POST['sdt_ctv']) {
                        $alert = "<p class='alert_tk_fail'>Số điện thoại đã tồn tại !</p>";
                    } elseif (get_field('nick_kh_ctv') == $_POST['nick_kh_ctv'] and $this_nick_ctv != $_POST['nick_kh_ctv']) {
                        $alert = "<p class='alert_tk_fail'>Nick đã tồn tại !</p>";
                    } elseif (get_field('link_fb_kh_ctv') == $_POST['link_fb_kh_ctv'] and $this_link_fb_ctv != $_POST['link_fb_kh_ctv']) {
                        $alert = "<p class='alert_tk_fail'>Link đã tồn tại !</p>";
                    } elseif (get_field('uidfb_kh_ctv') == $_POST['uidfb_kh_ctv'] and $this_uidfb_ctv != $_POST['uidfb_kh_ctv']) {
                        $alert = "<p class='alert_tk_fail'>Uidfb đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if (!isset($alert)) {
                $update_ctv = array(
                    'ID' => get_the_ID(),
                    'post_title' => $_POST['email_ctv'],
                );

                $post_id = wp_update_post($update_ctv);

                update_field('id_ctv', $_POST['id_ctv'], $post_id);
                update_field('ma_ctv', $_POST['ma_ctv'], $post_id);
                update_field('ten_ctv', $_POST['ten_ctv'], $post_id);
                update_field('email_ctv', $_POST['email_ctv'], $post_id);
                update_field('sdt_ctv', $_POST['sdt_ctv'], $post_id);
                update_field('don_vi_cong_tac_ctv', $_POST['don_vi_cong_tac_ctv'], $post_id);
                update_field('nick_kh_ctv', $_POST['nick_kh_ctv'], $post_id);
                update_field('link_fb_kh_ctv', $_POST['link_fb_kh_ctv'], $post_id);
                update_field('uidfb_kh_ctv', $_POST['uidfb_kh_ctv'], $post_id);


                $alert = "<p class='alert_tk_sucess'>Cập nhập cộng tác viên thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san edit_ctv">
                <h1>Sửa khách sạn</h1>
                <form action="<?php echo get_permalink(); ?>" method="post" enctype="multipart/form-data">
                    <ul>
                        <li>
                            <label>ID CTV</label>
                            <input type="text" name="id_ctv" class="id_ctv" value="<?php echo get_field('id_ctv'); ?>"
                                   required>
                        </li>
                        <li>
                            <label>Mã CTV</label>
                            <input type="text" name="ma_ctv" class="ma_ctv" value="<?php echo get_field('ma_ctv'); ?>"
                                   required>
                        </li>
                        <li>
                            <label>Tên CTV</label>
                            <input type="text" name="ten_ctv" class="ten_ctv"
                                   value="<?php echo get_field('ten_ctv'); ?>" required>
                        </li>
                        <li>
                            <label>Email CTV</label>
                            <input type="email" name="email_ctv" class="email_ctv"
                                   value="<?php echo get_field('email_ctv'); ?>" required>
                        </li>
                        <li>
                            <label>SĐT CTV</label>
                            <input type="number" name="sdt_ctv" class="sdt_ctv"
                                   value="<?php echo get_field('sdt_ctv'); ?>" required>
                        </li>
                        <li>
                            <label>Đơn vị công tác</label>
                            <input type="number" name="don_vi_cong_tac_ctv" class="don_vi_cong_tac_ctv"
                                   value="<?php echo get_field('don_vi_cong_tac_ctv'); ?>" required>
                        </li>
                        <li>
                            <label>Nick KH CTV</label>
                            <input type="text" name="nick_kh_ctv" class="nick_kh_ctv"
                                   value="<?php echo get_field('nick_kh_ctv'); ?>" required>
                        </li>
                        <li>
                            <label>Link FB KH CTV</label>
                            <input type="text" name="link_fb_kh_ctv" class="link_fb_kh_ctv"
                                   value="<?php echo get_field('link_fb_kh_ctv'); ?>" required>
                        </li>
                        <li>
                            <label>UIDFB KH CTV</label>
                            <input type="text" name="uidfb_kh_ctv" class="uidfb_kh_ctv"
                                   value="<?php echo get_field('uidfb_kh_ctv'); ?>" required>
                        </li>
                        <div class="get_alert" style="text-align: center;"></div>
                        <?php if ($alert) {
                            echo $alert;
                        } ?>
                    </ul>
                    <div class="acf-form-submit">
                        <input type="submit" name="sub_edit_ctv" value="Cập nhập">
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
    ?>
