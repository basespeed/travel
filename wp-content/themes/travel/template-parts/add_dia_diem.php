<?php
/*
 * Template Name: Địa điểm*/

if($_SESSION['sucess'] == "sucess") {

    get_header();

    ?>
    <div id="content" class="edit_giao_dich edit_tai_khoan">
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

            <div class="content_admin">
                <div class="giao_dich_moi trang_thai_bbk">

                    <?php
                    $array_tt = array(
                        'post_type' => 'dia_diem_local',
                    );

                    $query_check = new WP_Query($array_tt);

                    if (isset($_POST['add_sub_dia_diem'])) {
                        if ($query_check->have_posts()) {
                            while ($query_check->have_posts()) : $query_check->the_post();
                                if (get_the_title() == $_POST['dia_diem']) {
                                    $alert = "<p class='alert_tk_fail'>Trạng thái đã tồn tại !</p>";
                                }
                            endwhile;
                            wp_reset_postdata();
                        }

                        if (isset($alert) ) {

                        }else{
                            $add_new_dia_diem = array(
                                'post_title' => $_POST['dia_diem'],
                                'post_status' => 'publish',
                                'post_type' => 'dia_diem_local',
                            );

                            $post_id = wp_insert_post($add_new_dia_diem);
                        }
                    }
                    ?>

                    <h2>Danh sách địa điểm</h2>

                    <table>
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $arrays = array(
                            'post_type' => 'dia_diem_local',
                            'posts_per_page' => 20,
                            'order' => 'DESC',
                            'paged' => $paged,
                        );

                        $query = new WP_Query($arrays);
                        if($query->have_posts()) {
                            ?>
                            <tr>
                                <td>ID</td>
                                <td>Địa điểm</td>
                                <td></td>
                            </tr>
                            <?php
                            while ($query->have_posts()) : $query->the_post();
                                ?>
                                <tr>
                                    <td><?php echo get_the_ID(); ?></td>
                                    <td><?php the_title(); ?></td>
                                    <td>
                                        <a onclick="return confirm('Bạn có chắc muốn xóa nó');" class="delete"
                                           href="<?php echo get_delete_post_link(get_the_ID()); ?>"><i
                                                class="fa fa-times-circle" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php
                            endwhile;
                            $total_pages = $query->max_num_pages;
                            $current_page = max(1, get_query_var('paged'));
                        }else{
                            ?>
                            <tr><td>Dữ liệu trống !</td></tr>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </table>
                    <?php
                    if ($total_pages) :
                        echo '<nav class="nav">';
                        echo paginate_links(array(
                            'base' => get_pagenum_link(1) . '%_%',
                            'format' => '/page/%#%',
                            'current' => $current_page,
                            'total' => $total_pages,
                            'prev_text' => __('<i class="fa fa-angle-left" aria-hidden="true"></i>'),
                            'next_text' => __('<i class="fa fa-angle-right" aria-hidden="true"></i>'),
                        ));
                        echo '</nav>';
                    endif;
                    ?>

                    <h2>Thêm địa điểm</h2>
                    <form action="<?php echo home_url('/'); ?>dia-diem/" method="post">
                        <input type="text" name="dia_diem" placeholder="Nhập trạng thái ..." required/>
                        <button type="submit" name="add_sub_dia_diem">Thêm mới</button>
                        <div class="alert"><?php if(isset($alert)){echo $alert;} ?></div>
                    </form>
                </div>
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