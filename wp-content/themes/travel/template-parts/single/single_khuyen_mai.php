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

        $this_id_km = get_field('id_km');
        $this_ten_km = get_field('ten_km');

        if(isset($_POST['sub_edit_km'])){
            $array_user = array(
                'post_type' => 'km',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_field('id_km') == $_POST['id_km'] and $this_id_km != $_POST['id_km']) {
                        $alert = "<p class='alert_tk_fail'>ID khuyến mãi đã tồn tại !</p>";
                    }elseif (get_field('ten_km') == $_POST['ten_km'] and $this_ten_km != $_POST['ten_km']){
                        $alert = "<p class='alert_tk_fail'>Tên khuyến mãi đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if(! isset($alert)){
                $update_user = array(
                    'ID'           => get_the_ID(),
                    'post_title'   => $_POST['ten_km'],
                );

                $post_id = wp_update_post($update_user);

                update_field( 'id_km', $_POST['id_km'], $post_id );
                update_field( 'ten_km', $_POST['ten_km'], $post_id );
                update_field( 'ks_km', $_POST['ks_km'], $post_id );
                update_field( 'mo_tả_km', $_POST['mo_tả_km'], $post_id );
                update_field( 'link_file_km', $_POST['link_file_km'], $post_id );


                $alert = "<p class='alert_tk_sucess'>Cập nhập khuyến mãi thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san edit_khach_san">
                <h1>Sửa khách sạn</h1>
                <form action="<?php echo get_permalink(); ?>" method="post" enctype="multipart/form-data">
                    <ul>
                        <li>
                            <label>ID KM</label>
                            <input type="text" name="id_km" class="id_km" value="<?php echo get_field('id_km'); ?>" required>
                        </li>
                        <li>
                            <label>Tên KM</label>
                            <input type="text" name="ten_km" class="ten_km" value="<?php echo get_field('ten_km'); ?>" required>
                        </li>
                        <li>
                            <label>KS KM</label>
                            <input type="text" name="ks_km" class="ks_km" value="<?php echo get_field('ks_km'); ?>" required>
                        </li>
                        <li>
                            <label>Link file KM</label>
                            <input type="text" name="link_file_km" class="link_file_km" value="<?php echo get_field('link_file_km'); ?>" required>
                        </li>
                        <li>
                            <label>Mô tả KM</label>
                            <textarea type="text" name="mo_tả_km" class="mo_tả_km" required ><?php echo get_field('mo_tả_km'); ?></textarea>
                        </li>
                        <div class="get_alert" style="text-align: center;"></div>
                        <?php if($alert){echo $alert;} ?>
                    </ul>
                    <div class="acf-form-submit">
                        <input type="submit" name="sub_edit_km" value="Cập nhập">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    ?>
