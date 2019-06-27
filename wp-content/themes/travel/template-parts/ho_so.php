<?php
    /*
     * Template Name: Hồ sơ*/

if($_SESSION['sucess'] == "sucess") {
    get_header();
?>
<?php
    $posts = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'tai_khoan',
        'meta_key' => 'email_tai_khoan',
        'meta_value' => '^' . preg_quote($_SESSION['mnv']),
        'meta_compare' => 'RLIKE',
    ));
    if($posts->have_posts()) : while ($posts->have_posts()) : $posts->the_post();
        $ten_biet_danh_tai_khoan = get_field('ten_biet_danh_tai_khoan');
        $ho_va_ten_tai_khoan = get_field('ho_va_ten_tai_khoan');
        $sdt_tai_khoan = get_field('sdt_tai_khoan');
        $cmt_tai_khoan = get_field('cmt_tai_khoan');
        $bo_phan_tai_khoan = get_field('bo_phan_tai_khoan');
        $dia_chi_tai_khoan = get_field('dia_chi_tai_khoan');
        $email_tai_khoan = get_field('email_tai_khoan');
        $hinh_anh_tai_khoan = get_field('hinh_anh_tai_khoan');
        $ten_anh_tai_khoan = get_field('ten_anh_tai_khoan');

        if (isset($_POST['sub_update_user'])) {
            $array_user = array(
                'post_type' => 'tai_khoan',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            $this_email = get_field('email_tai_khoan');
            $this_tel = get_field('sdt_tai_khoan');
            $this_cmt = get_field('cmt_tai_khoan');
            $this_ten_biet_danh_tai_khoan = get_field('ten_biet_danh_tai_khoan');
            $this_ID = get_the_ID();
            //Hiển thị lỗi
            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_field('sdt_tai_khoan') == $_POST['sdt_tai_khoan'] and $this_tel != $_POST['sdt_tai_khoan']) {
                        $alert = "<p class='alert_tk_fail'>Số điện thoại đã có người đăng ký !</p>";
                    } elseif (get_field('cmt_tai_khoan') == $_POST['cmt_tai_khoan'] and $this_cmt != $_POST['cmt_tai_khoan']) {
                        $alert = "<p class='alert_tk_fail'>Chứng minh thư đã có người đăng ký !</p>";
                    } elseif (get_field('ten_biet_danh_tai_khoan') == $_POST['ten_biet_danh_tai_khoan'] and $this_ten_biet_danh_tai_khoan != $_POST['ten_biet_danh_tai_khoan']) {
                        $alert = "<p class='alert_tk_fail'>Tên biệt danh đã có người đăng ký !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            //Check có lỗi ko thì cho update dữ liệu
            if (!isset($alert)) {
                if ($_FILES['anh_dai_dien']['name'] != '') {

                    $file_name = $_FILES['anh_dai_dien']['name'];
                    $array = explode(".", $file_name);
                    $name = $array[0];
                    $ext = $array[1];
                    if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
                        $dir_base = get_template_directory() . '/template-parts/images';
                        $name_file_img = $ten_anh_tai_khoan;
                        $unlink_url = $dir_base . '/' . $name_file_img;
                        unlink($unlink_url);

                        $path = __DIR__ . '/images/';
                        $file_name = "image_" . uniqid() . str_replace("image/", ".", $_FILES['anh_dai_dien']['type']);
                        $location = $path . $file_name;
                        if (move_uploaded_file($_FILES['anh_dai_dien']['tmp_name'], $location)) {

                            $update_user = array(
                                'ID' => $this_ID,
                                'post_title' => $this_email,
                            );

                            $post_id = wp_update_post($update_user);
                            $check_file_name = $file_name;
                            $location_img = get_template_directory_uri() . '/template-parts/images/' . $check_file_name;

                            if (!empty($_POST['mat_khau_tai_khoan'])) {
                                update_field('mat_khau_tai_khoan', md5($_POST['mat_khau_tai_khoan']), $post_id);
                            }
                            update_field('ten_biet_danh_tai_khoan', $_POST['ten_biet_danh_tai_khoan'], $post_id);
                            update_field('ho_va_ten_tai_khoan', $_POST['ho_va_ten_tai_khoan'], $post_id);
                            update_field('sdt_tai_khoan', $_POST['sdt_tai_khoan'], $post_id);
                            update_field('cmt_tai_khoan', $_POST['cmt_tai_khoan'], $post_id);
                            //update_field('bo_phan_tai_khoan', $_POST['bo_phan_tai_khoan'], $post_id);
                            update_field('dia_chi_tai_khoan', $_POST['dia_chi_tai_khoan'], $post_id);
                            update_field('hinh_anh_tai_khoan', $location_img, $post_id);
                            update_field('ten_anh_tai_khoan', $check_file_name, $post_id);

                            $_SESSION['avatar'] = $location_img;

                            //update lại ảnh avatar được thay đổi
                            $query_avatar = new WP_Query(array(
                                'post_type' => 'tai_khoan',
                                'meta_key'		=> 'sdt_tai_khoan',
                                'meta_value' => '^' . preg_quote( $sdt_tai_khoan ),
                                'meta_compare' => 'RLIKE',
                            ));

                            if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                                $avatar_id = get_the_ID();
                            endwhile;
                            endif;
                            wp_reset_postdata();

                            $alert = "<p class='alert_tk_sucess'>Cập nhập tài khoản thành công !</p>";
                            echo '<meta http-equiv="refresh" content="0">';
                        }
                    } else {
                        $alert = "<p class='alert_tk_fail'>Sai định dạng !</p>";
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                } else {
                    $update_user = array(
                        'ID' => $this_ID,
                        'post_title' => $this_email,
                    );

                    $post_id = wp_update_post($update_user);

                    if (!empty($_POST['mat_khau_tai_khoan'])) {
                        update_field('mat_khau_tai_khoan', md5($_POST['mat_khau_tai_khoan']), $post_id);
                    }
                    update_field('ten_biet_danh_tai_khoan', $_POST['ten_biet_danh_tai_khoan'], $post_id);
                    update_field('ho_va_ten_tai_khoan', $_POST['ho_va_ten_tai_khoan'], $post_id);
                    update_field('sdt_tai_khoan', $_POST['sdt_tai_khoan'], $post_id);
                    update_field('cmt_tai_khoan', $_POST['cmt_tai_khoan'], $post_id);
                    update_field('bo_phan_tai_khoan', $_POST['bo_phan_tai_khoan'], $post_id);
                    update_field('loai_quyen_tai_khoan', $_POST['loai_quyen_tai_khoan'], $post_id);
                    update_field('dia_chi_tai_khoan', $_POST['dia_chi_tai_khoan'], $post_id);
                    add_post_meta($post_id, 'ten_anh_tai_khoan', $file_name, true);

                    $alert = "<p class='alert_tk_sucess'>Cập nhập tài khoản thành công !</p>";
                    echo '<meta http-equiv="refresh" content="0">';
                }
            }
        }

        ?>

        <div id="content">
        <div class="quantri_admin">
            <?php include 'inc/template_menu.php'; ?>

            <div class="content_admin">
                <div class="giao_dich_moi add_user edit_user">
                    <h1>Hồ sơ</h1>
                    <form action="<?php echo get_home_url('/') ?>/ho-so" method="post" enctype="multipart/form-data">
                        <div class="all">
                            <ul class="list_ho_so">
                                <li>
                                    <label>Tên biệt danh</label>
                                    <input type="text" name="ten_biet_danh_tai_khoan" class="ten_biet_danh_tai_khoan"
                                           value="<?php echo $ten_biet_danh_tai_khoan; ?>" required>
                                </li>
                                <li>
                                    <label>Họ và tên</label>
                                    <input type="text" name="ho_va_ten_tai_khoan" class="ho_va_ten_tai_khoan"
                                           value="<?php echo $ho_va_ten_tai_khoan; ?>" required>
                                </li>
                                <li>
                                    <label>Số điện thoại</label>
                                    <input type="number" name="sdt_tai_khoan" class="sdt_tai_khoan"
                                           value="<?php echo $sdt_tai_khoan; ?>" required>
                                </li>
                                <li>
                                    <label>Số chứng minh thư</label>
                                    <input type="number" name="cmt_tai_khoan" class="cmt_tai_khoan"
                                           value="<?php echo $cmt_tai_khoan; ?>" required>
                                </li>
                                <li>
                                    <label>Bộ phận</label>
                                    <select name="bo_phan_tai_khoan" class="bo_phan_tai_khoan"
                                            data-check="<?php echo $bo_phan_tai_khoan; ?>" disabled>
                                        <option value="Quản lý">Quản lý</option>
                                        <option value="Sales">Sales</option>
                                        <option value="Booking">Booking</option>
                                        <option value="Kế toán">Kế toán</option>
                                    </select>
                                </li>
                                <li>
                                    <label>Đổi mật khẩu</label>
                                    <input type="password" name="mat_khau_tai_khoan" class="mat_khau_tai_khoan" value="">
                                </li>
                                <li>
                                    <label for="file">Ảnh đại diện</label>
                                    <input type="file" name="anh_dai_dien" class="anh_dai_dien"
                                           value="<?php the_post_thumbnail_url(); ?>">
                                    <button class="btn_upload_image">Chọn ảnh</button>
                                </li>
                                <li>
                                    <label>Địa chỉ</label>
                                    <textarea type="number" name="dia_chi_tai_khoan"
                                              class="dia_chi_tai_khoan"><?php echo $dia_chi_tai_khoan; ?></textarea>
                                    <div class="get_alert"></div>
                                    <?php if ($alert) {
                                        echo $alert;
                                    } ?>
                                    <div class="acf-form-submit">
                                        <input type="submit" name="sub_update_user" value="Cập nhập">
                                    </div>
                                </li>
                            </ul>
                        </div>


                        <div class="screen_user">
                            <div class="screen">
                                <h2>Tài khoản</h2>
                                <div class="show_info">
                                    <div class="img">
                                        <?php
                                        if ($hinh_anh_tai_khoan) {
                                            echo "<img src='" . $hinh_anh_tai_khoan . "' alt='avatar'>";
                                        }
                                        ?>
                                    </div>
                                    <div class="content">
                                        <div class="email_screen item">
                                            <div class="insider">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                                <span><?php echo $email_tai_khoan; ?></span>
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
                                                <span><?php echo get_field('ten_biet_danh_tai_khoan'); ?></span>
                                            </div>
                                        </div>
                                        <div class="name_screen item">
                                            <div class="insider">
                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                <span><?php echo get_field('ho_va_ten_tai_khoan'); ?></span>
                                            </div>
                                        </div>
                                        <div class="tel_screen item">
                                            <div class="insider">
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                                <span><?php echo get_field('sdt_tai_khoan'); ?></span>
                                            </div>
                                        </div>
                                        <div class="cmt_screen item">
                                            <div class="insider">
                                                <i class="fa fa-address-card" aria-hidden="true"></i>
                                                <span><?php echo get_field('cmt_tai_khoan'); ?></span>
                                            </div>
                                        </div>
                                        <div class="quyen_screen item">
                                            <div class="insider">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                                <span><?php echo get_field('loai_quyen_tai_khoan'); ?></span>
                                            </div>
                                        </div>
                                        <div class="local_screen item">
                                            <div class="insider">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                <span><?php echo get_field('dia_chi_tai_khoan'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        ?>

        <?php
        get_footer();

        endwhile;
        endif;
        wp_reset_postdata();
    }
?>