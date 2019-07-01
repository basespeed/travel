<?php
/*
 * Template Name: Khách hàng*/

if($_SESSION['sucess'] == "sucess") {
    get_header();

    ?>
    <div id="content" class="edit_giao_dich edit_tai_khoan">
        <div class="quantri_admin">
            <?php include 'inc/template_menu.php'; ?>

            <div class="content_admin">
                <div class="giao_dich_moi">
                    <table>
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $arr = array(
                            'post_type' => 'khach_hang',
                            'posts_per_page' => 200,
                            'order' => 'DESC',
                            'paged' => $paged,
                        );

                        $the_query = new WP_Query($arr);
                        $n = 1;
                        if ($the_query->have_posts()) :
                            ?>
                            <tr>
                                <td><strong>Mã khách giao dịch</strong></td>
                                <td><strong>Tên khách giao dịch</strong></td>
                                <td><strong>SĐT Khách giao dịch</strong></td>
                                <td><strong>Email khách giao dịch</strong></td>
                                <td><strong>Nick Zalo</strong></td>
                                <td><strong>Loại tài khoản</strong></td>
                                <td></td>
                            </tr>
                            <?php

                            while ($the_query->have_posts()) : $the_query->the_post();
                                ?>
                                <tr>
                                    <td><?php echo get_field('ma_kgd'); ?></td>
                                    <td><?php echo get_field('ten_kgd'); ?></td>
                                    <td><?php echo get_field('sdt_kgd'); ?></td>
                                    <td><?php echo get_field('email_kgd_duy_nhat'); ?></td>
                                    <td><?php echo get_field('nick_kgd'); ?></td>
                                    <td><?php
                                        echo get_field('loai_tai_khoan_khach_gd');
                                    ?></td>
                                    <td>
                                        <a class="edit" href="<?php the_permalink(); ?>"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a class="delete" href="<?php echo get_delete_post_link(get_the_ID()); ?>"><i
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