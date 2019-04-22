<?php
/*
 * Template Name: Thêm mới khuyến mãi*/

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
        if (isset($_POST['sub_new_km'])) {
            $array_user = array(
                'post_type' => 'km',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_field('id_km') == $_POST['id_km']) {
                        $alert = "<p class='alert_tk_fail'>ID khuyến mãi đã tồn tại !</p>";
                    }elseif (get_field('ten_km') == $_POST['ten_km']){
                        $alert = "<p class='alert_tk_fail'>Tên khuyến mãi đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if (!isset($alert)) {
                $add_new_giao_dich_tien = array(
                    'post_title' => $_POST['ten_km'],
                    'post_status' => 'publish',
                    'post_type' => 'km',
                );

                $post_id = wp_insert_post($add_new_giao_dich_tien);

                add_post_meta($post_id, 'id_km', $_POST['id_km'], true);
                add_post_meta($post_id, 'ten_km', $_POST['ten_km'], true);
                add_post_meta($post_id, 'ks_km', $_POST['ks_km'], true);
                add_post_meta($post_id, 'mo_tả_km', $_POST['mo_tả_km'], true);
                add_post_meta($post_id, 'link_file_km', $_POST['link_file_km'], true);

                $alert = "<p class='alert_tk_sucess'>Thêm khuyến mãi thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san">
                <h1>Thêm mới khuyến mãi</h1>
                <form action="<?php echo home_url('/'); ?>them-khuyen-mai" method="post"
                      enctype="multipart/form-data">
                    <ul>
                        <li>
                            <label>ID KM</label>
                            <input type="text" name="id_km" class="id_km" required>
                        </li>
                        <li>
                            <label>Tên KM</label>
                            <input type="text" name="ten_km" class="ten_km" required>
                        </li>
                        <li>
                            <label>KS KM</label>
                            <input type="text" name="ks_km" class="ks_km" required>
                        </li>
                        <li>
                            <label>Link file KM</label>
                            <input type="text" name="link_file_km" class="link_file_km" required>
                        </li>
                        <li>
                            <label>Mô tả KM</label>
                            <textarea type="text" name="mo_tả_km" class="mo_tả_km" required>
                                <?php echo get_field('mo_tả_km'); ?>
                            </textarea>
                        </li>
                        <div class="get_alert" style="text-align: center;"></div>
                        <?php if ($alert) {
                            echo $alert;
                        } ?>
                    </ul>
                    <div class="acf-form-submit">
                        <input type="submit" name="sub_new_km" value="Thêm mới">
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
