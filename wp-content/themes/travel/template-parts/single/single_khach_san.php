<?php
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
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
                'menu' => 'Admin'
            ) );
            ?>
        </div>
        <?php

        $this_ten_ks = get_field('ten_ks');
        $this_stk_ks = get_field('stk_ks');

        if(isset($_POST['sub_edit_khach_san'])){
            $array_user = array(
                'post_type' => 'khach_san',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_the_title() == $_POST['ten_ks'] and $this_ten_ks != $_POST['ten_ks']) {
                        $alert = "<p class='alert_tk_fail'>Tên khách sạn đã tồn tại !</p>";
                    }elseif(get_field('stk_ks') == $_POST['stk_ks'] and $this_stk_ks != $_POST['stk_ks']){
                        $alert = "<p class='alert_tk_fail'>Số tài khoản đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if(! isset($alert)){
                $update_user = array(
                    'ID'           => get_the_ID(),
                    'post_title'   => $_POST['ten_ks'],
                );

                $post_id = wp_update_post($update_user);

                update_field( 'id_khach_sạn', $_POST['id_khach_sạn'], $post_id );
                update_field( 'ma_ks', $_POST['ma_ks'], $post_id );
                update_field( 'ten_ks', $_POST['ten_ks'], $post_id );
                update_field( 'mst_ks', $_POST['mst_ks'], $post_id );
                update_field( 'stk_ks', $_POST['stk_ks'], $post_id );
                update_field( 'khu_vuc_ks', $_POST['khu_vuc_ks'], $post_id );
                update_field( 'dia_chi_ks', $_POST['dia_chi_ks'], $post_id );
                update_field( 'email_sale_ks', $_POST['email_sale_ks'], $post_id );
                update_field( 'sdt_sale_ks', $_POST['sdt_sale_ks'], $post_id );
                update_field( 'email_dat_phong', $_POST['email_dat_phong'], $post_id );
                update_field( 'sdt_dat_phong', $_POST['sdt_dat_phong'], $post_id );
                update_field( 'link_hd_goc', $_POST['link_hd_goc'], $post_id );
                update_field( 'loai_phong_ks', $_POST['loai_phong_ks'], $post_id );


                $alert = "<p class='alert_tk_sucess'>Cập nhập khách sạn thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san edit_khach_san">
                <form action="<?php echo get_permalink(); ?>" method="post" enctype="multipart/form-data">
                    <div class="add_hotel">
                        <div class="item">
                            <h1>Sửa khách sạn</h1>
                            <ul>
                                <li>
                                    <label>ID Khách sạn</label>
                                    <input type="text" name="id_khach_sạn" class="id_khach_sạn" value="<?php echo get_field('id_khach_sạn'); ?>" required>
                                </li>
                                <li>
                                    <label>Mã Khách sạn</label>
                                    <input type="email" name="ma_ks" class="ma_ks" value="<?php echo get_field('ma_ks'); ?>" required>
                                </li>
                                <li>
                                    <label>Tên Khách sạn</label>
                                    <input type="text" name="ten_ks" class="ten_ks" value="<?php echo get_field('ten_ks'); ?>" required>
                                </li>
                                <li>
                                    <label>MST Khách sạn</label>
                                    <input type="text" name="mst_ks" class="mst_ks" value="<?php echo get_field('mst_ks'); ?>" required>
                                </li>
                                <li>
                                    <label>STK Khách sạn</label>
                                    <input type="number" name="stk_ks" class="stk_ks" value="<?php echo get_field('stk_ks'); ?>" required>
                                </li>
                                <li>
                                    <label>Khu vực Khách sạn</label>
                                    <input type="text" name="khu_vuc_ks" class="khu_vuc_ks" value="<?php echo get_field('khu_vuc_ks'); ?>" required>
                                </li>
                                <li>
                                    <label>Địa chỉ</label>
                                    <input type="text" name="dia_chi_ks" class="dia_chi_ks" value="<?php echo get_field('dia_chi_ks'); ?>" required>
                                </li>
                                <li>
                                    <label>Email sale Khách sạn</label>
                                    <input type="email" name="email_sale_ks" class="email_sale_ks" value="<?php echo get_field('email_sale_ks'); ?>" required>
                                </li>
                                <li>
                                    <label>SĐT sale Khách sạn</label>
                                    <input type="text" name="sdt_sale_ks" class="sdt_sale_ks" value="<?php echo get_field('sdt_sale_ks'); ?>" required>
                                </li>
                                <li>
                                    <label>Email đặt phòng</label>
                                    <input type="email" name="email_dat_phong" class="email_dat_phong" value="<?php echo get_field('email_dat_phong'); ?>" required>
                                </li>
                                <li>
                                    <label>SĐT đặt phòng</label>
                                    <input type="number" name="sdt_dat_phong" class="sdt_dat_phong" value="<?php echo get_field('sdt_dat_phong'); ?>" required>
                                </li>
                                <li>
                                    <label>Link HĐ gốc</label>
                                    <input type="text" name="link_hd_goc" class="link_hd_goc" value="<?php echo get_field('link_hd_goc'); ?>" required>
                                </li>
                                <div class="get_alert" style="text-align: center;"></div>
                                <?php if($alert){echo $alert;} ?>
                            </ul>
                            <div class="acf-form-submit">
                                <input type="submit" name="sub_edit_khach_san" value="Cập nhập">
                            </div>
                        </div>
                        <div class="item">
                            <h1>Giá phòng và loại phòng</h1>

                            <ul>
                                <li>
                                    <label>Tên phòng : </label>
                                    <input type="text" class="ten_phong_ks">
                                </li>
                                <li>
                                    <label>Giá phòng : </label>
                                    <input type="text" class="gia_phong_ks">
                                    <button type="button" class="add_rom">Thêm</button>
                                </li>
                                <li>
                                    <strong>Danh sách loại phòng</strong>
                                    <div class="loai_phong">
                                        <?php
                                            $str = get_field('loai_phong_ks');
                                            $arr_lists = explode(",",$str);
                                            foreach ($arr_lists as $list){
                                                echo '<div class="rom">'.$list.' <i class="fa fa-times-circle" aria-hidden="true"></i></div>';
                                            }
                                        ?>
                                    </div>
                                    <input type="hidden" name="loai_phong_ks" class="loai_phong_ks">
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    ?>
