<?php
/*
 * Template Name: Thêm mới tài khoản*/

if($_SESSION['sucess'] == "sucess") {
    if($_SESSION['loai_quyen_tai_khoan'] == 'Admin') {
        get_header();
        ?>

        <?php
        if (isset($_POST['sub_new_user'])) {
            $array_user = array(
                'post_type' => 'tai_khoan',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_the_title() == $_POST['email_tai_khoan']) {
                        $alert = "<p class='alert_tk_fail'>Địa chỉ email đã có người đăng ký !</p>";
                    } elseif (get_field('sdt_tai_khoan') == $_POST['sdt_tai_khoan']) {
                        $alert = "<p class='alert_tk_fail'>Số điện thoại đã có người đăng ký !</p>";
                    } elseif (get_field('cmt_tai_khoan') == $_POST['cmt_tai_khoan']) {
                        $alert = "<p class='alert_tk_fail'>Chứng minh thư đã có người đăng ký !</p>";
                    } elseif (get_field('ten_biet_danh_tai_khoan') == $_POST['ten_biet_danh_tai_khoan']) {
                        $alert = "<p class='alert_tk_fail'>Tên biệt danh đã có người đăng ký !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if (!isset($alert)) {
                if ($_FILES['anh_dai_dien']['name'] != '') {
                    $file_name = "image_" . uniqid() . str_replace("image/", ".", $_FILES['anh_dai_dien']['type']);
                    $array = explode(".", $file_name);
                    $name = $array[0];
                    $ext = $array[1];
                    if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
                        $path = __DIR__ . '/images/';
                        $location = $path . $file_name;
                        if (move_uploaded_file($_FILES['anh_dai_dien']['tmp_name'], $location)) {
                            $add_new_user = array(
                                'post_title' => $_POST['email_tai_khoan'],
                                'post_status' => 'publish',
                                'post_type' => 'tai_khoan',
                            );

                            $post_id = wp_insert_post($add_new_user);
                            $location_img = get_template_directory_uri() . '/template-parts/images/' . $file_name;

                            add_post_meta($post_id, 'email_tai_khoan', $_POST['email_tai_khoan'], true);
                            add_post_meta($post_id, 'mat_khau_tai_khoan', md5($_POST['mat_khau_tai_khoan']), true);
                            add_post_meta($post_id, 'ten_biet_danh_tai_khoan', $_POST['ten_biet_danh_tai_khoan'], true);
                            add_post_meta($post_id, 'ho_va_ten_tai_khoan', $_POST['ho_va_ten_tai_khoan'], true);
                            add_post_meta($post_id, 'sdt_tai_khoan', $_POST['sdt_tai_khoan'], true);
                            add_post_meta($post_id, 'cmt_tai_khoan', $_POST['cmt_tai_khoan'], true);
                            add_post_meta($post_id, 'bo_phan_tai_khoan', $_POST['bo_phan_tai_khoan'], true);
                            add_post_meta($post_id, 'loai_quyen_tai_khoan', $_POST['loai_quyen_tai_khoan'], true);
                            add_post_meta($post_id, 'dia_chi_tai_khoan', $_POST['dia_chi_tai_khoan'], true);
                            add_post_meta($post_id, 'hinh_anh_tai_khoan', $location_img, true);
                            add_post_meta($post_id, 'ten_anh_tai_khoan', $file_name, true);
                            add_post_meta($post_id, 'lien_ket_tai_khoan', $_POST['lien_ket_tai_khoan'], true);

                            $alert = "<p class='alert_tk_sucess'>Tạo tài khoản thành công !</p>";
                        }
                    } else {
                        $alert = "<p class='alert_tk_fail'>Sai định dạng !</p>";
                    }
                } else {
                    $alert = "<p class='alert_tk_fail'>File ảnh không tồn tại !</p>";
                }
            }
        }
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

            <div class="content_admin">
                <div class="giao_dich_moi add_user">
                    <h1>Thêm mới tài khoản</h1>
                    <form action="<?php echo home_url('/'); ?>them-moi-tai-khoan" method="post"
                          enctype="multipart/form-data">
                        <ul>
                            <li>
                                <label>Tìm kiếm Email</label>
                                <input type="text" class="search_email" placeholder="Tìm kiếm email..">
                            </li>
                            <li>
                                <label>Email</label>
                                <select name="email_tai_khoan" class="email_tai_khoan">
                                    <option value="" selected disabled hidden>Chọn Email</option>
                                    <?php
                                    $array = array(
                                        'post_type' => 'nhan_vien',
                                    );

                                    $query = new WP_Query($array);

                                    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                                        ?>
                                        <option value="<?php echo get_field('email_nv'); ?>"><?php echo get_field('email_nv'); ?></option>
                                    <?php
                                    endwhile;
                                    endif;
                                    wp_reset_postdata();
                                    ?>
                                </select>
                            </li>
                            <li>
                                <label>Mật khẩu</label>
                                <input type="password" name="mat_khau_tai_khoan" class="mat_khau_tai_khoan" required>
                            </li>
                            <li>
                                <label>Tên biệt danh</label>
                                <input type="text" name="ten_biet_danh_tai_khoan" class="ten_biet_danh_tai_khoan"
                                       required>
                            </li>
                            <li>
                                <label>Họ và tên</label>
                                <input type="text" name="ho_va_ten_tai_khoan" class="ho_va_ten_tai_khoan" required>
                            </li>
                            <li>
                                <label>Số điện thoại</label>
                                <input type="number" name="sdt_tai_khoan" class="sdt_tai_khoan" required>
                            </li>
                            <li>
                                <label>Số chứng minh thư</label>
                                <input type="number" name="cmt_tai_khoan" class="cmt_tai_khoan" required>
                            </li>
                            <li>
                                <label>Bộ phận</label>
                                <select name="bo_phan_tai_khoan" class="bo_phan_tai_khoan"
                                        data-check="<?php echo get_field('bo_phan_tai_khoan'); ?>">
                                    <option value="Quản lý">Quản lý</option>
                                    <option value="Sales">Sales</option>
                                    <option value="Booking">Booking</option>
                                    <option value="Kế toán">Kế toán</option>
                                </select>
                            </li>
                            <li>
                                <label>Loại quyền</label>
                                <select name="loai_quyen_tai_khoan" class="loai_quyen_tai_khoan" required>
                                    <option value="Admin">Admin</option>
                                    <option value="Quản lý">Quản lý</option>
                                    <option value="Nhân viên">Nhân viên</option>
                                </select>
                            </li>
                            <li>
                                <label for="file">Ảnh đại diện</label>
                                <input type="file" name="anh_dai_dien" class="anh_dai_dien" required>
                                <button class="btn_upload_image">Chọn ảnh</button>
                            </li>
                            <li>
                                <label>Địa chỉ</label>
                                <textarea type="number" name="dia_chi_tai_khoan" class="dia_chi_tai_khoan"></textarea>
                                <input type="hidden" name="lien_ket_tai_khoan" class="lien_ket_tai_khoan">
                                <div class="get_alert"></div>
                                <?php if ($alert) {
                                    echo $alert;
                                } ?>
                            </li>
                        </ul>

                        <div class="screen_user">
                            <div class="screen">
                                <h2>Tài khoản</h2>
                                <div class="show_info">
                                    <div class="img">
                                        <img src="" alt="Ảnh đại diện">
                                    </div>
                                    <div class="content">
                                        <div class="email_screen item">
                                            <div class="insider">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="pass_screen item">
                                            <div class="insider">
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                                <input type="password" disabled>
                                            </div>
                                        </div>
                                        <div class="biet_danh_screen item">
                                            <div class="insider">
                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="name_screen item">
                                            <div class="insider">
                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="tel_screen item">
                                            <div class="insider">
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="cmt_screen item">
                                            <div class="insider">
                                                <i class="fa fa-address-card" aria-hidden="true"></i>
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="quyen_screen item">
                                            <div class="insider">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="local_screen item">
                                            <div class="insider">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="acf-form-submit">
                            <input type="submit" name="sub_new_user" value="Thêm mới">
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
