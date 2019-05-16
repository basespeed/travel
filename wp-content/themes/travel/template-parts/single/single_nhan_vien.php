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
            <a href="<?php echo home_url('/') ?>ho-so" class="ho_so"><span class="dashicons dashicons-id"></span> Hồ sơ</a>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
                'menu' => 'Admin'
            ) );
            ?>
        </div>
        <?php

        $this_ma_nv = get_field('ma_nv');
        $this_id_nhan_vien = get_field('id_nhan_vien');
        $this_email_nv = get_field('email_nv');
        $this_sdt_nv = get_field('sdt_nv');
        $this_nick_nv = get_field('nick_nv');
        $this_link_fb_nv = get_field('link_fb_nv');
        $this_uidfb_nv = get_field('uidfb_nv');
        $tk_nv = get_field('tk_nv');

        if(isset($_POST['sub_edit_nhan_vien'])){
            $array_user = array(
                'post_type' => 'nhan_vien',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_field('ma_nv') == $_POST['ma_nv'] and $this_ma_nv != $_POST['ma_nv']) {
                        $alert = "<p class='alert_tk_fail'>Mã nhân viên đã tồn tại !</p>";
                    }elseif(get_field('id_nhan_vien') == $_POST['id_nhan_vien'] and $this_id_nhan_vien != $_POST['id_nhan_vien']){
                        $alert = "<p class='alert_tk_fail'>Email đã tồn tại !</p>";
                    }elseif(get_field('email_nv') == $_POST['email_nv'] and $this_email_nv != $_POST['email_nv']){
                        $alert = "<p class='alert_tk_fail'>Email đã tồn tại !</p>";
                    }elseif(get_field('sdt_nv') == $_POST['sdt_nv'] and $this_sdt_nv != $_POST['sdt_nv']){
                        $alert = "<p class='alert_tk_fail'>Số điện thoại đã tồn tại !</p>";
                    }elseif(get_field('nick_nv') == $_POST['nick_nv'] and $this_nick_nv != $_POST['nick_nv']){
                        $alert = "<p class='alert_tk_fail'>Nick đã tồn tại !</p>";
                    }elseif(get_field('link_fb_nv') == $_POST['link_fb_nv'] and $this_link_fb_nv != $_POST['link_fb_nv']){
                        $alert = "<p class='alert_tk_fail'>Link đã tồn tại !</p>";
                    }elseif(get_field('uidfb_nv') == $_POST['uidfb_nv'] and $this_uidfb_nv != $_POST['uidfb_nv']){
                        $alert = "<p class='alert_tk_fail'>Uidfb đã tồn tại !</p>";
                    }elseif(get_field('tk_nv') == $_POST['tk_nv'] and $tk_nv != $_POST['tk_nv']){
                        $alert = "<p class='alert_tk_fail'>Số tài khoản đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if(! isset($alert)){
                $update_nv = array(
                    'ID'           => get_the_ID(),
                    'post_title'   => $_POST['email_nv'],
                );

                $post_id = wp_update_post($update_nv);

                update_field( 'id_nhan_vien', $_POST['id_nhan_vien'], $post_id );
                update_field( 'ma_nv', $_POST['ma_nv'], $post_id );
                update_field( 'ten_nv', $_POST['ten_nv'], $post_id );
                update_field( 'email_nv', $_POST['email_nv'], $post_id );
                update_field( 'sdt_nv', $_POST['sdt_nv'], $post_id );
                update_field( 'muc_do_uu_tien', $_POST['muc_do_uu_tien'], $post_id );
                update_field( 'bo_phan_nv', $_POST['bo_phan_nv'], $post_id );
                update_field( 'ten_ngan_hang_nv', $_POST['ten_ngan_hang_nv'], $post_id );
                update_field( 'tk_nv', $_POST['tk_nv'], $post_id );
                update_field( 'don_vi_cong_tac_nv', $_POST['don_vi_cong_tac_nv'], $post_id );
                update_field( 'nick_nv', $_POST['nick_nv'], $post_id );
                update_field( 'link_fb_nv', $_POST['link_fb_nv'], $post_id );
                update_field( 'uidfb_nv', $_POST['uidfb_nv'], $post_id );


                $alert = "<p class='alert_tk_sucess'>Cập nhập nhân viên thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san edit_nv">
                <h1>Sửa nhân viên</h1>
                <form action="<?php echo get_permalink(); ?>" method="post" enctype="multipart/form-data">
                    <ul>
                        <li>
                            <label>ID Nhân viên</label>
                            <input type="text" name="id_nhan_vien" class="id_nhan_vien" value="<?php echo get_field('id_nhan_vien'); ?>" required>
                        </li>
                        <li>
                            <label>Mã NV</label>
                            <input type="email" name="ma_nv" class="ma_nv" value="<?php echo get_field('ma_nv'); ?>" required>
                        </li>
                        <li>
                            <label>Tên NV</label>
                            <input type="text" name="ten_nv" class="ten_nv" value="<?php echo get_field('ten_nv'); ?>" required>
                        </li>
                        <li>
                            <label>Email NV</label>
                            <input type="email" name="email_nv" class="email_nv" value="<?php echo get_field('email_nv'); ?>" required>
                        </li>
                        <li>
                            <label>SĐT NV</label>
                            <input type="number" name="sdt_nv" class="sdt_nv" value="<?php echo get_field('sdt_nv'); ?>">
                        </li>
                        <li>
                            <label>Bộ phận NV</label>
                            <select name="bo_phan_nv" class="bo_phan_nv" data-check="<?php echo get_field('bo_phan_nv'); ?>" required>
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
                            <label>Tên ngân hàng</label>
                            <input type="text" name="ten_ngan_hang_nv" class="ten_ngan_hang_nv" value="<?php echo get_field('ten_ngan_hang_nv'); ?>">
                        </li>
                        <li>
                            <label>STK NV</label>
                            <input type="text" name="tk_nv" class="tk_nv" value="<?php echo get_field('tk_nv'); ?>">
                        </li>
                        <li>
                            <label>Nick NV</label>
                            <input type="text" name="nick_nv" class="nick_nv" value="<?php echo get_field('nick_nv'); ?>">
                        </li>
                        <li>
                            <label>Đơn vị công tác</label>
                            <input type="text" name="don_vi_cong_tac_nv" class="don_vi_cong_tac_nv" value="<?php echo get_field('don_vi_cong_tac_nv'); ?>">
                        </li>
                        <li>
                            <label>Link FB NV</label>
                            <input type="text" name="link_fb_nv" class="link_fb_nv" value="<?php echo get_field('link_fb_nv'); ?>">
                        </li>
                        <li>
                            <label>UIDFB NV</label>
                            <input type="text" name="uidfb_nv" class="uidfb_nv" value="<?php echo get_field('uidfb_nv'); ?>">
                        </li>
                        <div class="get_alert" style="text-align: center;"></div>
                        <?php if($alert){echo $alert;} ?>
                    </ul>
                    <div class="acf-form-submit">
                        <input type="submit" name="sub_edit_nhan_vien" value="Cập nhập">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    ?>
