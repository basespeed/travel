<?php
/*
 * Template Name: Thêm mới nhân viên*/

if($_SESSION['sucess'] == "sucess") {
    if($_SESSION['loai_quyen_tai_khoan'] == 'Admin') {
        get_header();
        ?>
        <div id="content">
        <div class="quantri_admin">
            <?php include 'inc/template_menu.php'; ?>
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
                    add_post_meta($post_id, 'ten_ngan_hang_nv', $_POST['ten_ngan_hang_nv'], true);
                    add_post_meta($post_id, 'tk_nv', $_POST['tk_nv'], true);
                    add_post_meta($post_id, 'bo_phan_nv', $_POST['bo_phan_nv'], true);
                    add_post_meta($post_id, 'don_vi_cong_tac_nv', $_POST['don_vi_cong_tac_nv'], true);
                    add_post_meta($post_id, 'link_fb_nv', $_POST['link_fb_nv'], true);
                    add_post_meta($post_id, 'uidfb_nv', $_POST['uidfb_nv'], true);
                    add_post_meta($post_id, 'lien_ket_tai_khoan', abs(crc32(uniqid())), true);

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
                                <input type="text" name="id_nhan_vien" class="id_nhan_vien" value="<?php echo get_the_ID(); ?>" required>
                            </li>
                            <li>
                                <label>Mã NV</label>
                                <input type="text" name="ma_nv" class="ma_nv" value="NV_<?php echo abs( crc32( uniqid() ) ); ?>" required>
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
                                <input type="number" name="sdt_nv" class="sdt_nv">
                            </li>
                            <li>
                                <label>Bộ phận NV</label>
                                <select name="bo_phan_nv" class="bo_phan_nv" required>
                                    <option value="" selected disabled hidden>Chọn bộ phận</option>
                                    <?php
                                    $query_bp = new WP_Query(array(
                                        'post_type' => 'bo_phan',
                                    ));

                                    if ($query_bp->have_posts()) : while ($query_bp->have_posts()) : $query_bp->the_post();
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
                                <label>Tên ngân hàng</label>
                                <input type="text" name="ten_ngan_hang_nv" class="ten_ngan_hang_nv">
                            </li>
                            <li>
                                <label>STK NV</label>
                                <input type="text" name="tk_nv" class="tk_nv">
                            </li>
                            <li>
                                <label>Đơn vị công tác</label>
                                <input type="text" name="don_vi_cong_tac_nv" class="don_vi_cong_tac_nv">
                            </li>
                            <li>
                                <label>Nick NV</label>
                                <input type="text" name="nick_nv" class="nick_nv">
                            </li>
                            <li>
                                <label>Link FB NV</label>
                                <input type="text" name="link_fb_nv" class="link_fb_nv">

                                <div class="acf-form-submit" style="margin-top: 15px;">
                                    <input type="submit" name="sub_new_nv" value="Thêm mới">
                                </div>
                            </li>
                            <li>
                                <label>UIDFB NV</label>
                                <input type="text" name="uidfb_nv" class="uidfb_nv">
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
