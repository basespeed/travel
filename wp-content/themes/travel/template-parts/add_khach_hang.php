<?php
/*
 * Template Name: Thêm khách hàng*/

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
        if (isset($_POST['sub_new_khach_hang'])) {
            $array_user = array(
                'post_type' => 'khach_hang',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_field('email_kgd_duy_nhat') == $_POST['email_kgd_duy_nhat']) {
                        $alert = "<p class='alert_tk_fail'>Email khách hàng đã tồn tại !</p>";
                    }elseif (get_field('sdt_kgd') == $_POST['sdt_kgd']) {
                        $alert = "<p class='alert_tk_fail'>Số điện thoại đã tồn tại !</p>";
                    }elseif (get_field('tk_kgd') == $_POST['tk_kgd']) {
                        $alert = "<p class='alert_tk_fail'>Số tài khoản đã tồn tại !</p>";
                    }elseif (get_field('ma_kgd') == $_POST['ma_kgd']) {
                        $alert = "<p class='alert_tk_fail'>Mã khách giao dịch đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if (!isset($alert)) {
                $add_new_khach_san = array(
                    'post_title' => $_POST['ten_ks'],
                    'post_status' => 'publish',
                    'post_type' => 'khach_hang',
                );

                $post_id = wp_insert_post($add_new_khach_san);

                $group_ID = '679';
                $fields = acf_get_fields($group_ID);
                foreach ($fields as $field){
                    if($field['name'] != ""){
                        add_post_meta($post_id, $field['name'], $_POST[$field['name']], true);
                    }
                }

                $alert = "<p class='alert_tk_sucess'>Thêm khách hàng thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san">
                <form action="<?php echo home_url('/'); ?>them-khach-hang" method="post" enctype="multipart/form-data">
                    <div class="add_hotel">
                        <div class="item">
                            <h1>Thêm mới khách hàng</h1>
                            <ul>
                                <li>
                                    <label>Mã khách giao dịch</label>
                                    <input type="text" name="ma_kgd" class="ma_kgd" required>
                                </li>
                                <li>
                                    <label>Tên khách giao dịch</label>
                                    <input type="text" name="ten_kgd" class="ten_kgd" required>
                                </li>
                                <li>
                                    <label>Nick khách giao dịch</label>
                                    <input type="text" name="nick_kgd" class="nick_kgd" required>
                                </li>
                                <li>
                                    <label>SĐT Khách giao dịch</label>
                                    <input type="number" name="sdt_kgd" class="sdt_kgd" required>
                                </li>
                                <li>
                                    <label>Email khách giao dịch</label>
                                    <input type="email" name="email_kgd_duy_nhat" class="email_kgd_duy_nhat" required>
                                </li>
                                <li>
                                    <label>TK khách giao dịch</label>
                                    <input type="number" name="tk_kgd" class="tk_kgd" required>
                                </li>
                                <li>
                                    <label>Nơi đi</label>
                                    <select name="noi_di_gd" class="noi_di_gd" required>
                                        <option value="Hà Nội">Hà Nội</option>
                                        <?php
                                        $query_khach_san = new WP_Query(array(
                                            'post_type' => 'dia_diem_local',
                                            'posts_type' => 15,
                                        ));
                                        if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                            ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                        endwhile;
                                        endif;
                                        wp_reset_postdata();
                                        ?>
                                    </select>
                                </li>
                                <li>
                                    <label>Nơi đến</label>
                                    <select name="noi_den_gd" class="noi_den_gd" required>
                                        <?php
                                        $query_khach_san = new WP_Query(array(
                                            'post_type' => 'dia_diem_local',
                                            'posts_type' => 15,
                                        ));
                                        if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                            ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                        endwhile;
                                        endif;
                                        wp_reset_postdata();
                                        ?>
                                    </select>
                                </li>
                                <li>
                                    <label>Check-in</label>
                                    <input type="text" name="ci_gd" data-date-format="dd/mm/yyyy" class="ci_gd datepicker-here" data-language='en' required>
                                </li>
                                <li>
                                    <label>Check-out</label>
                                    <input type="text" name="co_gd" class="co_gd datepicker-here" data-date-format="dd/mm/yyyy" data-language='en' required>
                                </li>
                                <li>
                                    <label>Số đêm</label>
                                    <input type="number" name="so_dem_gd" class="so_dem_gd" disabled required>
                                </li>
                                <li>
                                    <label>Còn lại ?</label>
                                    <input type="number" name="con_ngay_gd" class="con_ngay_gd" disabled required>
                                </li>
                                <li>
                                    <label>Loại phòng</label>
                                    <select name="loai_phong_ban_gd" class="loai_phong_ban_gd">
                                        <option value="" selected disabled hidden>Chọn loại phòng</option>
                                        <?php
                                        $query_khach_san = new WP_Query(array(
                                            'post_type' => 'khach_san',
                                            'posts_type' => 15,
                                        ));
                                        if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                        $str = get_field('loai_phong_ks');
                                        $arr_lists = explode(",",$str);
                                        foreach ($arr_lists as $list){
                                            $list_explode  = $list;
                                            $list_explode = explode(":", $list_explode);
                                            echo '<option value="'.$list_explode[0].'" data-price="'.preg_replace('/\s+/', '', $list_explode[1]).'">'.$list_explode[0].'</option>';
                                        }
                                        endwhile;
                                        endif;
                                        wp_reset_postdata();
                                        ?>
                                    </select>
                                </li>
                                <li>
                                    <label>Số lượng</label>
                                    <input type="number" name="sl_gd" class="sl_gd">
                                </li>
                                <li>
                                    <label>Đơn giá bán</label>
                                    <input type="text" name="don_gia_ban_gd" class="don_gia_ban_gd">
                                </li>
                                <li>
                                    <label>Đơn vị bán</label>
                                    <select name="don_vi_gd" class="don_vi_gd" data-check="<?php echo get_field('don_vi_gd'); ?>" required>
                                        <option value="" selected disabled hidden>Chọn đơn vị</option>
                                        <option value="vnđ/phòng/đêm">vnđ/phòng/đêm</option>
                                        <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                        <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                                    </select>
                                </li>
                                <li>
                                    <label>Tổng</label>
                                    <input type="text" name="tong_gd" class="tong_gd">
                                </li>
                                <li>
                                    <label>Mã pro</label>
                                    <input type="text" name="ma_pro_gd" class="ma_pro_gd">
                                </li>
                                <div class="get_alert" style="text-align: center;"></div>
                                <?php if ($alert) {
                                    echo $alert;
                                } ?>
                            </ul>
                            <div class="acf-form-submit">
                                <input type="submit" name="sub_new_khach_hang" value="Thêm mới">
                            </div>
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
?>
