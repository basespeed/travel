<?php
get_header();
?>
<div id="content">
    <div class="quantri_admin">
        <?php include get_template_directory(). '/template-parts/inc/template_menu.php'; ?>
        <?php

        $this_id_tien_gd = get_field('id_tien_gd');
        $this_id_gd = get_field('id_gd');
        $this_so_tk_gd = get_field('so_tk_gd');

        if(isset($_POST['sub_edit_tien'])){
            $array_user = array(
                'post_type' => 'tien',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    if (get_field('id_tien_gd') == $_POST['id_tien_gd'] and $this_id_tien_gd != $_POST['id_tien_gd']) {
                        $alert = "<p class='alert_tk_fail'>ID tiền giao dịch đã tồn tại !</p>";
                    }elseif(get_field('id_gd') == $_POST['id_gd'] and $this_id_gd != $_POST['id_gd']){
                        $alert = "<p class='alert_tk_fail'>ID giao dịch đã tồn tại !</p>";
                    }elseif(get_field('so_tk_gd') == $_POST['so_tk_gd'] and $this_so_tk_gd != $_POST['so_tk_gd']){
                        $alert = "<p class='alert_tk_fail'>Số tài khoản đã tồn tại !</p>";
                    }
                endwhile;
                wp_reset_postdata();
            }

            if(! isset($alert)){
                $update_user = array(
                    'ID'           => get_the_ID(),
                    'post_title'   => $_POST['so_tk_gd'],
                );

                $post_id = wp_update_post($update_user);

                update_field( 'id_tien_gd', $_POST['id_tien_gd'], $post_id );
                update_field( 'id_gd', $_POST['id_gd'], $post_id );
                update_field( 'tien_giao_dich_gd', $_POST['tien_giao_dich_gd'], $post_id );
                update_field( 'ngay_gd', $_POST['ngay_gd'], $post_id );
                update_field( 'so_tk_gd', $_POST['so_tk_gd'], $post_id );
                update_field( 'ten_tk_gd', $_POST['ten_tk_gd'], $post_id );
                update_field( 'nội_dung_tt_gd', $_POST['nội_dung_tt_gd'], $post_id );
                update_field( 'id_kh_gd', $_POST['id_kh_gd'], $post_id );
                update_field( 'id_ks_gd', $_POST['id_ks_gd'], $post_id );
                update_field( 'id_dt_gd', $_POST['id_dt_gd'], $post_id );
                update_field( 'id_nv_gd', $_POST['id_nv_gd'], $post_id );
                update_field( 'id_ctv_gd', $_POST['id_ctv_gd'], $post_id );


                $alert = "<p class='alert_tk_sucess'>Cập nhập giao dịch tiền thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san edit_khach_san">
                <h1>Sửa khách sạn</h1>
                <form action="<?php echo get_permalink(); ?>" method="post" enctype="multipart/form-data">
                    <ul>
                        <li>
                            <label>ID TIEN</label>
                            <input type="text" name="id_tien_gd" class="id_tien_gd" value="<?php echo get_field('id_tien_gd'); ?>" required>
                        </li>
                        <li>
                            <label>ID GD</label>
                            <input type="text" name="id_gd" class="id_gd" value="<?php echo get_field('id_gd'); ?>" required>
                        </li>
                        <li>
                            <label>Số tiền</label>
                            <input type="number" name="tien_giao_dich_gd" class="tien_giao_dich_gd" value="<?php echo get_field('tien_giao_dich_gd'); ?>" required>
                        </li>
                        <li>
                            <label>Ngày GD</label>
                            <input type="text" name="ngay_gd" data-date-format="dd/mm/yyyy"
                                   class='datepicker-here ngay_gd' data-language='en' value="<?php echo get_field('ngay_gd'); ?>" required>
                        </li>
                        <li>
                            <label>Số TK</label>
                            <input type="number" name="so_tk_gd" class="so_tk_gd" value="<?php echo get_field('so_tk_gd'); ?>" required>
                        </li>
                        <li>
                            <label>Tên TK</label>
                            <input type="text" name="ten_tk_gd" class="ten_tk_gd" value="<?php echo get_field('ten_tk_gd'); ?>" required>
                        </li>
                        <li>
                            <label>Nội dung TT</label>
                            <input type="text" name="nội_dung_tt_gd" class="nội_dung_tt_gd" value="<?php echo get_field('nội_dung_tt_gd'); ?>" required>
                        </li>
                        <li>
                            <label>ID KH</label>
                            <input type="text" name="id_kh_gd" class="id_kh_gd" value="<?php echo get_field('id_kh_gd'); ?>" required>
                        </li>
                        <li>
                            <label>ID KS</label>
                            <input type="text" name="id_ks_gd" class="id_ks_gd" value="<?php echo get_field('id_ks_gd'); ?>" required>
                        </li>
                        <li>
                            <label>ID DT</label>
                            <input type="text" name="id_dt_gd" class="id_dt_gd" value="<?php echo get_field('id_dt_gd'); ?>" required>
                        </li>
                        <li>
                            <label>ID NV</label>
                            <input type="text" name="id_nv_gd" class="id_nv_gd" value="<?php echo get_field('id_nv_gd'); ?>" required>
                        </li>
                        <li>
                            <label>ID CTV</label>
                            <input type="text" name="id_ctv_gd" class="id_ctv_gd" value="<?php echo get_field('id_ctv_gd'); ?>" required>
                        </li>
                        <div class="get_alert" style="text-align: center;"></div>
                        <?php if($alert){echo $alert;} ?>
                    </ul>
                    <div class="acf-form-submit">
                        <input type="submit" name="sub_edit_tien" value="Cập nhập">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    ?>
