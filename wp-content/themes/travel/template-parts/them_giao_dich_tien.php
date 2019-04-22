<?php
/*
 * Template Name: Thêm mới giao dịch tiền*/

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
        if (isset($_POST['sub_new_tien'])) {
            $array_user = array(
                'post_type' => 'tien',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_field('id_tien_gd') == $_POST['id_tien_gd']) {
                        $alert = "<p class='alert_tk_fail'>ID tiền giao dịch đã tồn tại !</p>";
                    } elseif (get_field('id_gd') == $_POST['id_gd']) {
                        $alert = "<p class='alert_tk_fail'>ID giao dịch đã tồn tại !</p>";
                    }elseif (get_field('so_tk_gd') == $_POST['so_tk_gd']) {
                        $alert = "<p class='alert_tk_fail'>Số tài khoản đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if (!isset($alert)) {
                $add_new_giao_dich_tien = array(
                    'post_title' => $_POST['so_tk_gd'],
                    'post_status' => 'publish',
                    'post_type' => 'tien',
                );

                $post_id = wp_insert_post($add_new_giao_dich_tien);

                add_post_meta($post_id, 'id_tien_gd', $_POST['id_tien_gd'], true);
                add_post_meta($post_id, 'id_gd', $_POST['id_gd'], true);
                add_post_meta($post_id, 'tien_giao_dich_gd', $_POST['tien_giao_dich_gd'], true);
                add_post_meta($post_id, 'ngay_gd', $_POST['ngay_gd'], true);
                add_post_meta($post_id, 'so_tk_gd', $_POST['so_tk_gd'], true);
                add_post_meta($post_id, 'ten_tk_gd', $_POST['ten_tk_gd'], true);
                add_post_meta($post_id, 'nội_dung_tt_gd', $_POST['nội_dung_tt_gd'], true);
                add_post_meta($post_id, 'id_kh_gd', $_POST['id_kh_gd'], true);
                add_post_meta($post_id, 'id_ks_gd', $_POST['id_ks_gd'], true);
                add_post_meta($post_id, 'id_dt_gd', $_POST['id_dt_gd'], true);
                add_post_meta($post_id, 'id_nv_gd', $_POST['id_nv_gd'], true);
                add_post_meta($post_id, 'id_ctv_gd', $_POST['id_ctv_gd'], true);

                $alert = "<p class='alert_tk_sucess'>Thêm giao dịch tiền thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san">
                <h1>Thêm mới giao dịch tiền</h1>
                <form action="<?php echo home_url('/'); ?>them-giao-dich-tien" method="post"
                      enctype="multipart/form-data">
                    <ul>
                        <li>
                            <label>ID TIEN</label>
                            <input type="text" name="id_tien_gd" class="id_tien_gd" required>
                        </li>
                        <li>
                            <label>ID GD</label>
                            <input type="text" name="id_gd" class="id_gd" required>
                        </li>
                        <li>
                            <label>Số tiền</label>
                            <input type="number" name="tien_giao_dich_gd" class="tien_giao_dich_gd" required>
                        </li>
                        <li>
                            <label>Ngày GD</label>
                            <input type="text" name="ngay_gd" data-date-format="dd/mm/yyyy"
                                   class='datepicker-here ngay_gd' data-language='en' required>
                        </li>
                        <li>
                            <label>Số TK</label>
                            <input type="number" name="so_tk_gd" class="so_tk_gd" required>
                        </li>
                        <li>
                            <label>Tên TK</label>
                            <input type="text" name="ten_tk_gd" class="ten_tk_gd" required>
                        </li>
                        <li>
                            <label>Nội dung TT</label>
                            <input type="text" name="nội_dung_tt_gd" class="nội_dung_tt_gd" required>
                        </li>
                        <li>
                            <label>ID KH</label>
                            <input type="text" name="id_kh_gd" class="id_kh_gd" required>
                        </li>
                        <li>
                            <label>ID KS</label>
                            <input type="text" name="id_ks_gd" class="id_ks_gd" required>
                        </li>
                        <li>
                            <label>ID DT</label>
                            <input type="text" name="id_dt_gd" class="id_dt_gd" required>
                        </li>
                        <li>
                            <label>ID NV</label>
                            <input type="text" name="id_nv_gd" class="id_nv_gd" required>
                        </li>
                        <li>
                            <label>ID CTV</label>
                            <input type="text" name="id_ctv_gd" class="id_ctv_gd" required>
                        </li>
                        <div class="get_alert" style="text-align: center;"></div>
                        <?php if ($alert) {
                            echo $alert;
                        } ?>
                    </ul>
                    <div class="acf-form-submit">
                        <input type="submit" name="sub_new_tien" value="Thêm mới">
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
