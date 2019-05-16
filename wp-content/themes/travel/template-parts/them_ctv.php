<?php
/*
 * Template Name: Thêm mới cộng tác viên*/

if($_SESSION['sucess'] == "sucess") {
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
            if (isset($_POST['sub_new_ctv'])) {
                $array_user = array(
                    'post_type' => 'ctv',
                    'post_status' => 'publish'
                );

                $query = new WP_Query($array_user);

                if ($query->have_posts()) {
                    while ($query->have_posts()) : $query->the_post();
                        if (get_the_title() == $_POST['id_ctv']) {
                            $alert = "<p class='alert_tk_fail'>ID CTV đã tồn tại !</p>";
                        } elseif (get_field('ma_ctv') == $_POST['stk_ks']) {
                            $alert = "<p class='alert_tk_fail'>Mã CTV đã tồn tại !</p>";
                        } elseif (get_field('email_ctv') == $_POST['email_ctv']) {
                            $alert = "<p class='alert_tk_fail'>Email CTV đã tồn tại !</p>";
                        } elseif (get_field('sdt_ctv') == $_POST['sdt_ctv']) {
                            $alert = "<p class='alert_tk_fail'>Số điện thoại đã tồn tại !</p>";
                        } elseif (get_field('nick_kh_ctv') == $_POST['nick_kh_ctv']) {
                            $alert = "<p class='alert_tk_fail'>Nick đã tồn tại !</p>";
                        } elseif (get_field('link_fb_kh_ctv') == $_POST['link_fb_kh_ctv']) {
                            $alert = "<p class='alert_tk_fail'>Link đã tồn tại !</p>";
                        } elseif (get_field('uidfb_kh_ctv') == $_POST['uidfb_kh_ctv']) {
                            $alert = "<p class='alert_tk_fail'>Uidfb đã tồn tại !</p>";
                        }elseif (get_field('stk_ctv') == $_POST['stk_ctv']) {
                            $alert = "<p class='alert_tk_fail'>STK đã tồn tại !</p>";
                        }
                    endwhile;
                    wp_reset_postdata();
                }

                if (!isset($alert)) {
                    $add_new_khach_san = array(
                        'post_title' => $_POST['email_ctv'],
                        'post_status' => 'publish',
                        'post_type' => 'ctv',
                    );

                    $post_id = wp_insert_post($add_new_khach_san);

                    add_post_meta($post_id, 'id_ctv', $_POST['id_ctv'], true);
                    add_post_meta($post_id, 'ma_ctv', $_POST['ma_ctv'], true);
                    add_post_meta($post_id, 'ten_ctv', $_POST['ten_ctv'], true);
                    add_post_meta($post_id, 'email_ctv', $_POST['email_ctv'], true);
                    add_post_meta($post_id, 'sdt_ctv', $_POST['sdt_ctv'], true);
                    add_post_meta($post_id, 'don_vi_cong_tac_ctv', $_POST['don_vi_cong_tac_ctv'], true);
                    add_post_meta($post_id, 'nick_kh_ctv', $_POST['nick_kh_ctv'], true);
                    add_post_meta($post_id, 'link_fb_kh_ctv', $_POST['link_fb_kh_ctv'], true);
                    add_post_meta($post_id, 'uidfb_kh_ctv', $_POST['uidfb_kh_ctv'], true);
                    add_post_meta($post_id, 'bo_phan_ctv', $_POST['bo_phan_ctv'], true);
                    add_post_meta($post_id, 'ten_ngan_hang_ctv', $_POST['ten_ngan_hang_ctv'], true);
                    add_post_meta($post_id, 'stk_ctv', $_POST['stk_ctv'], true);

                    $alert = "<p class='alert_tk_sucess'>Thêm cộng tác viên thành công !</p>";
                }
            }
            ?>
            <div class="content_admin">
                <div class="giao_dich_moi add_user add_khach_san">
                    <h1>Thêm mới cộng tác viên</h1>
                    <form action="<?php echo home_url('/'); ?>them-moi-cong-tac-vien" method="post"
                          enctype="multipart/form-data">
                        <ul>
                            <li>
                                <label>ID CTV</label>
                                <input type="text" name="id_ctv" class="id_ctv" value="<?php echo get_the_ID(); ?>" required>
                            </li>
                            <li>
                                <label>Mã CTV</label>
                                <input type="text" name="ma_ctv" class="ma_ctv" value="CTV_<?php echo abs( crc32( uniqid() ) ); ?>" required>
                            </li>
                            <li>
                                <label>Tên CTV</label>
                                <input type="text" name="ten_ctv" class="ten_ctv" required>
                            </li>
                            <li>
                                <label>Email CTV</label>
                                <input type="email" name="email_ctv" class="email_ctv" required>
                            </li>
                            <li>
                                <label>SĐT CTV</label>
                                <input type="number" name="sdt_ctv" class="sdt_ctv">
                            </li>
                            <li>
                                <label>Bộ phận CTV</label>
                                <select name="bo_phan_ctv" class="bo_phan_ctv" data-check="<?php echo get_field('bo_phan_ctv'); ?>">
                                    <option value="" selected disabled hidden>Chọn bộ phận</option>
                                    <?php
                                    $query_bp = new WP_Query(array(
                                        'post_type' => 'bo_phan',
                                    ));

                                    if($query_bp->have_posts()) : while ($query_bp->have_posts()) : $query_bp->the_post();
                                        ?>
                                        <option value="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></option>
                                    <?php
                                    endwhile;
                                    endif;
                                    wp_reset_postdata();
                                    ?>
                                </select>
                            </li>
                            <li>
                                <label>Tên ngân hàng CTV</label>
                                <input type="text" name="ten_ngan_hang_ctv" class="ten_ngan_hang_ctv">
                            </li>
                            <li>
                                <label>STK CTV</label>
                                <input type="number" name="stk_ctv" class="stk_ctv">
                            </li>
                            <li>
                                <label>Đơn vị công tác</label>
                                <input type="text" name="don_vi_cong_tac_ctv" class="don_vi_cong_tac_ctv">
                            </li>
                            <li>
                                <label>Nick KH CTV</label>
                                <input type="text" name="nick_kh_ctv" class="nick_kh_ctv">
                            </li>
                            <li>
                                <label>Link FB KH CTV</label>
                                <input type="text" name="link_fb_kh_ctv" class="link_fb_kh_ctv">
                            </li>
                            <li>
                                <label>UIDFB KH CTV</label>
                                <input type="text" name="uidfb_kh_ctv" class="uidfb_kh_ctv">
                            </li>
                            <div class="get_alert" style="text-align: center;"></div>
                            <?php if ($alert) {
                                echo $alert;
                            } ?>
                        </ul>
                        <div class="acf-form-submit">
                            <input type="submit" name="sub_new_ctv" value="Thêm mới">
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
}else{
    ob_start();
    header("Location: ".home_url('/'));
    exit();
}
