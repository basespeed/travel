<?php
/*
 * Template Name: Sửa đối tác*/

if($_SESSION['sucess'] == "sucess") {
    if($_SESSION['loai_quyen_tai_khoan'] == 'Admin') {
        get_header();

        ?>
        <div id="content" class="edit_giao_dich edit_tai_khoan">
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
                    <div class="giao_dich_moi">
                        <table>
                            <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $arr = array(
                                'post_type' => 'doi_tac',
                                'posts_per_page' => 10,
                                'order' => 'DESC',
                                'paged' => $paged,
                            );

                            $the_query = new WP_Query($arr);
                            $n = 1;
                            if ($the_query->have_posts()) :
                                ?>
                                <tr>
                                    <td><strong>Mã ĐT</strong></td>
                                    <td><strong>Tên ĐT</strong></td>
                                    <td><strong>Email ĐT</strong></td>
                                    <td><strong>SĐT ĐT</strong></td>
                                    <td><strong>Cấp bậc DT</strong></td>
                                    <td></td>
                                </tr>
                                <?php

                                while ($the_query->have_posts()) : $the_query->the_post();
                                    ?>
                                    <tr>
                                        <td><?php echo get_field('ma_dt'); ?></td>
                                        <td><a class="title"
                                               href="<?php the_permalink(); ?>"><?php echo get_field('ten_dt'); ?></a>
                                        </td>
                                        <td><?php echo get_field('email_dt'); ?></td>
                                        <td><?php echo get_field('sdt_dt'); ?></td>
                                        <td><?php echo get_field('cap_bac_dt'); ?></td>
                                        <td>
                                            <a class="edit" href="<?php the_permalink(); ?>"><i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a class="delete"
                                               href="<?php echo get_delete_post_link(get_the_ID()); ?>"><i
                                                        class="fa fa-times-circle" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                endwhile;
                                $total_pages = $the_query->max_num_pages;
                                $current_page = max(1, get_query_var('paged'));
                            else:
                                echo "<td colspan='3'>Dữ liệu trống !</td>";
                            endif;
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
}else{
    ob_start();
    header("Location: ".home_url('/'));
    exit();
}