<?php
    /*Template Name: Lịch sử giao dịch*/

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

            <div class="content_admin">
                <div class="giao_dich_moi">
                    <table>
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $arr = array(
                            'post_type' => 'history_giao_dich',
                            'posts_per_page' => 10,
                            'order' => 'DESC',
                            'paged' => $paged,
                        );

                        $the_query = new WP_Query($arr);
                        $n = 1;
                        if ($the_query->have_posts()) :
                            ?>
                            <tr>
                                <td><strong>Mã giao dịch</strong></td>
                                <td><strong>Tên khách giao dịch</strong></td>
                                <td><strong>Tên khách sạn</strong></td>
                                <td><strong>Tên đối tác gửi đặt</strong></td>
                                <td><strong>Người sửa</strong></td>
                                <td><strong>Hành động</strong></td>
                                <td><strong>Thời gian sửa</strong></td>
                                <td></td>
                            </tr>
                            <?php

                            while ($the_query->have_posts()) : $the_query->the_post();
                                ?>
                                <tr>
                                    <td><?php echo get_field('ma_gd'); ?></td>
                                    <td><?php echo get_field('ten_kgd'); ?></td>
                                    <td><?php echo get_field('ten_khach_san_gd'); ?></td>
                                    <td><?php echo get_field('ten_dt_gui_book_dt'); ?></td>
                                    <td><?php echo get_field('nguoi_sua'); ?></td>
                                    <td><?php echo get_field('hanh_dong'); ?></td>
                                    <td><?php echo get_field('thoi_gian_sua'); ?></td>
                                    <td>
                                        <a class="view" href="<?php the_permalink(); ?>"><i class="fa fa-eye"
                                                                                            aria-hidden="true"></i></a>
                                        <a class="delete"
                                           onclick="return confirm('Bạn có chắc muốn xóa : <?php echo get_the_title() ?> ?')"
                                           href="<?php echo get_delete_post_link(get_the_ID()); ?>"><i
                                                    class="fa fa-times-circle" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php
                            endwhile;
                            $total_pages = $the_query->max_num_pages;
                            $current_page = max(1, get_query_var('paged'));
                        else :
                            echo "<td colspan='7'>Dữ liệu trống !</td>";
                        endif;
                        wp_reset_query();
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