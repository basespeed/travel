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

        $this_ma_dt = get_field('ma_dt');
        $this_id_dt = get_field('id_dt');
        $this_email_dt = get_field('email_dt');
        $this_sdt_dt = get_field('sdt_dt');
        $this_stk_dt = get_field('stk_dt');

        if (isset($_POST['sub_edit_doi_tac'])) {
            $array_user = array(
                'post_type' => 'doi_tac',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_field('ma_dt') == $_POST['ma_dt'] and $this_ma_dt != $_POST['ma_dt']) {
                        $alert = "<p class='alert_tk_fail'>Mã ĐT đã tồn tại !</p>";
                    } elseif (get_field('id_dt') == $_POST['id_dt'] and $this_id_dt != $_POST['id_dt']) {
                        $alert = "<p class='alert_tk_fail'>ID đã tồn tại !</p>";
                    } elseif (get_field('email_dt') == $_POST['email_dt'] and $this_email_dt != $_POST['email_dt']) {
                        $alert = "<p class='alert_tk_fail'>Email đã tồn tại !</p>";
                    } elseif (get_field('sdt_dt') == $_POST['sdt_dt'] and $this_sdt_dt != $_POST['sdt_dt']) {
                        $alert = "<p class='alert_tk_fail'>Số điện thoại đã tồn tại !</p>";
                    } elseif (get_field('stk_dt') == $_POST['stk_dt'] and $this_stk_dt != $_POST['stk_dt']) {
                        $alert = "<p class='alert_tk_fail'>STK đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if (!isset($alert)) {
                $update_dt = array(
                    'ID' => get_the_ID(),
                    'post_title' => $_POST['email_dt'],
                );

                $post_id = wp_update_post($update_dt);

                update_field('id_dt', $_POST['id_dt'], $post_id);
                update_field('ma_dt', $_POST['ma_dt'], $post_id);
                update_field('ten_dt', $_POST['ten_dt'], $post_id);
                update_field('email_dt', $_POST['email_dt'], $post_id);
                update_field('stk_dt', $_POST['stk_dt'], $post_id);
                update_field('don_vi_cong_tac_dt', $_POST['don_vi_cong_tac_dt'], $post_id);
                update_field('khu_vuc_dt', $_POST['khu_vuc_dt'], $post_id);
                update_field('mieu_ta_dt', $_POST['mieu_ta_dt'], $post_id);
                update_field('cap_bac_dt', $_POST['cap_bac_dt'], $post_id);
                update_field('mst_dt', $_POST['mst_dt'], $post_id);
                update_field('sdt_dt', $_POST['sdt_dt'], $post_id);
                update_field('dia_chi_dt', $_POST['dia_chi_dt'], $post_id);


                $alert = "<p class='alert_tk_sucess'>Cập nhập đối tác thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san edit_nv">
                <h1>Sửa đối tác</h1>
                <form action="<?php echo get_permalink(); ?>" method="post" enctype="multipart/form-data">
                    <ul>
                        <li>
                            <label>ID DT</label>
                            <input type="text" name="id_dt" class="id_dt" value="<?php echo get_field('id_dt'); ?>"
                                   required>
                        </li>
                        <li>
                            <label>Mã DT</label>
                            <input type="email" name="ma_dt" class="ma_dt" value="<?php echo get_field('ma_dt'); ?>"
                                   required>
                        </li>
                        <li>
                            <label>Tên DT</label>
                            <input type="text" name="ten_dt" class="ten_dt" value="<?php echo get_field('ten_dt'); ?>"
                                   required>
                        </li>
                        <li>
                            <label>Email DT</label>
                            <input type="email" name="email_dt" class="email_dt"
                                   value="<?php echo get_field('email_dt'); ?>" required>
                        </li>
                        <li>
                            <label>STK DT</label>
                            <input type="number" name="stk_dt" class="stk_dt" value="<?php echo get_field('stk_dt'); ?>"
                                   required>
                        </li>
                        <li>
                            <label>Đơn vị công tác</label>
                            <input type="text" name="don_vi_cong_tac_dt" class="don_vi_cong_tac_dt" value="<?php echo get_field('don_vi_cong_tac_dt'); ?>"
                                   required>
                        </li>
                        <li>
                            <label>Khu vực DT</label>
                            <input type="text" name="khu_vuc_dt" class="khu_vuc_dt"
                                   value="<?php echo get_field('khu_vuc_dt'); ?>" required>
                        </li>
                        <li>
                            <label>Miêu tả DT</label>
                            <input type="text" name="mieu_ta_dt" class="mieu_ta_dt"
                                   value="<?php echo get_field('mieu_ta_dt'); ?>" required>
                        </li>
                        <li>
                            <label>Cấp bậc DT</label>
                            <input type="text" name="cap_bac_dt" class="cap_bac_dt"
                                   value="<?php echo get_field('cap_bac_dt'); ?>" required>
                        </li>
                        <li>
                            <label>MST DT</label>
                            <input type="text" name="mst_dt" class="mst_dt" value="<?php echo get_field('mst_dt'); ?>"
                                   required>
                        </li>
                        <li>
                            <label>SĐT DT</label>
                            <input type="number" name="sdt_dt" class="sdt_dt" value="<?php echo get_field('sdt_dt'); ?>"
                                   required>
                        </li>
                        <li>
                            <label>Địa chỉ DT</label>
                            <input type="text" name="dia_chi_dt" class="dia_chi_dt"
                                   value="<?php echo get_field('dia_chi_dt'); ?>" required>
                        </li>
                        <div class="get_alert" style="text-align: center;"></div>
                        <?php if ($alert) {
                            echo $alert;
                        } ?>
                    </ul>
                    <div class="acf-form-submit">
                        <input type="submit" name="sub_edit_doi_tac" value="Cập nhập">
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
