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
        $email_kgd_duy_nhat = get_field('email_kgd_duy_nhat');
        $sdt_kgd = get_field('sdt_kgd');
        $tk_kgd = get_field('tk_kgd');
        $ma_kgd = get_field('ma_kgd');

        if(isset($_POST['edit_khach_hang'])){
            $array_user = array(
                'post_type' => 'khach_san',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);


            if(! isset($alert)){
                $update_user = array(
                    'ID'           => get_the_ID(),
                    'post_title'   => $_POST['email_kgd_duy_nhat'],
                );

                $post_id = wp_update_post($update_user);

                $group_ID = '679';
                $fields = acf_get_fields($group_ID);
                foreach ($fields as $field){
                    if($field['name'] != ""){
                        update_field( $field['name'], $_POST[$field['name']], $post_id );
                    }
                }
                $alert = "<p class='alert_tk_sucess'>Cập nhập khách hàng thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san">
                <form action="<?php echo get_permalink(); ?>" method="post" enctype="multipart/form-data">
                    <div class="add_hotel">
                        <div class="item">
                            <h1>Thêm mới khách hàng</h1>
                            <ul>
                                <li>
                                    <label>Mã khách giao dịch</label>
                                    <input type="text" name="ma_kgd" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>"/>
                                </li>
                                <li>
                                    <label>Tên khách giao dịch</label>
                                    <input type="text" name="ten_kgd" class="ten_kgd" value="<?php echo get_field('ten_kgd'); ?>"/>
                                </li>
                                <li>
                                    <label>SĐT Khách giao dịch</label>
                                    <input type="number" name="sdt_kgd" class="sdt_kgd" value="<?php echo get_field('sdt_kgd'); ?>"/>
                                </li>
                                <li>
                                    <label>Email khách giao dịch</label>
                                    <input type="email" name="email_kgd_duy_nhat" class="email_kgd_duy_nhat" value="<?php echo get_field('email_kgd_duy_nhat'); ?>"/>
                                </li>
                                <li>
                                    <label>TK khách giao dịch</label>
                                    <input type="number" name="tk_kgd" class="tk_kgd" value="<?php echo get_field('tk_kgd'); ?>"/>
                                </li>
                                <li>
                                    <label>Đơn vị công tác</label>
                                    <input type="text" name="don_vi_cong_tac_kh" class="don_vi_cong_tac_kh" value="<?php echo get_field('don_vi_cong_tac_kh'); ?>"/>
                                </li>
                                <li>
                                    <label>Loại tài khoản</label>
                                    <select name="loai_tai_khoan_khach_gd" class="loai_tai_khoan_khach_gd" data-check="<?php echo get_field('loai_tai_khoan_khach_gd'); ?>">
                                        <option value="" selected disabled hidden>Chọn loại tài khoản</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </li>
                                <li>
                                    <label>Nick khách giao dịch</label>
                                    <input type="text" name="nick_kgd" class="nick_kgd" value="<?php echo get_field('nick_kgd'); ?>"/>
                                </li>
                                <li>
                                    <label>Link facebook</label>
                                    <input type="text" name="link_facebook_khach_gd" class="link_facebook_khach_gd" value="<?php echo get_field('link_facebook_khach_gd'); ?>">
                                </li>
                                <div class="get_alert" style="text-align: center;"></div>
                                <?php if ($alert) {
                                    echo $alert;
                                } ?>
                            </ul>
                            <div class="acf-form-submit">
                                <input type="submit" name="edit_khach_hang" value="Cập nhật">
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
