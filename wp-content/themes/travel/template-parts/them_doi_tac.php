<?php
/*
 * Template Name: Thêm mới đối tác*/

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
        if (isset($_POST['sub_new_doi_tac'])) {
            $array_user = array(
                'post_type' => 'doi_tac',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_field('id_dt') == $_POST['id_dt']) {
                        $alert = "<p class='alert_tk_fail'>ID đã tồn tại !</p>";
                    } elseif (get_field('ma_dt') == $_POST['ma_dt']) {
                        $alert = "<p class='alert_tk_fail'>Mã đã tồn tại !</p>";
                    }elseif (get_field('email_dt') == $_POST['email_dt']) {
                        $alert = "<p class='alert_tk_fail'>Email đã tồn tại !</p>";
                    }elseif (get_field('stk_dt') == $_POST['stk_dt']) {
                        $alert = "<p class='alert_tk_fail'>STK đã tồn tại !</p>";
                    }elseif (get_field('sdt_dt') == $_POST['sdt_dt']) {
                        $alert = "<p class='alert_tk_fail'>SĐT đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

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
                            <input type="text" name="id_dt" class="id_dt" required>
                        </li>
                        <li>
                            <label>Mã DT</label>
                            <input type="email" name="ma_dt" class="ma_dt" required>
                        </li>
                        <li>
                            <label>Tên DT</label>
                            <input type="text" name="ten_dt" class="ten_dt" required>
                        </li>
                        <li>
                            <label>Email DT</label>
                            <input type="email" name="email_dt" class="email_dt" required>
                        </li>
                        <li>
                            <label>STK DT</label>
                            <input type="number" name="stk_dt" class="stk_dt" required>
                        </li>
                        <li>
                            <label>Khu vực DT</label>
                            <input type="text" name="khu_vuc_dt" class="khu_vuc_dt" required>
                        </li>
                        <li>
                            <label>Miêu tả DT</label>
                            <input type="text" name="mieu_ta_dt" class="mieu_ta_dt" required>
                        </li>
                        <li>
                            <label>Cấp bậc DT</label>
                            <input type="text" name="cap_bac_dt" class="cap_bac_dt" required>
                        </li>
                        <li>
                            <label>MST DT</label>
                            <input type="text" name="mst_dt" class="mst_dt" required>
                        </li>
                        <li>
                            <label>SĐT DT</label>
                            <input type="number" name="sdt_dt" class="sdt_dt" required>
                        </li>
                        <li>
                            <label>Địa chỉ DT</label>
                            <input type="text" name="dia_chi_dt" class="dia_chi_dt" required>
                        </li>
                        <div class="get_alert" style="text-align: center;"></div>
                        <?php if ($alert) {
                            echo $alert;
                        } ?>
                    </ul>
                    <div class="acf-form-submit">
                        <input type="submit" name="sub_new_doi_tac" value="Thêm mới">
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
