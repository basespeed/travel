<?php
/*
 * Template Name: Tài khoản*/

if($_SESSION['sucess'] == "sucess") {
    if($_SESSION['loai_quyen_tai_khoan'] == 'Admin') {
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
                                'post_type' => 'tai_khoan',
                                'posts_per_page' => 10,
                                'order' => 'DESC',
                                'paged' => $paged,
                            );

                            $the_query = new WP_Query($arr);
                            $n = 1;
                            if ($the_query->have_posts()) :
                                ?>
                                <tr>
                                    <td><strong>ID</strong></td>
                                    <td><strong>Email</strong></td>
                                    <td><strong>Họ và tên</strong></td>
                                    <td><strong>Số điện thoại</strong></td>
                                    <td><strong>Chứng minh thư</strong></td>
                                    <td><strong>Loại quyền</strong></td>
                                    <td><strong>Ảnh đại diện</strong></td>
                                    <td></td>
                                </tr>
                                <?php

                                while ($the_query->have_posts()) : $the_query->the_post();
                                    if(get_field('email_tai_khoan') != 'it.bachchitravel@gmail.com') :
                                    $del = get_delete_post_link(get_the_ID());
                                    ?>
                                    <tr>
                                        <td><?php echo get_the_ID(); ?></td>
                                        <td><?php echo get_field('email_tai_khoan'); ?></td>
                                        <td><?php echo get_field('ho_va_ten_tai_khoan'); ?></td>
                                        <td><?php echo get_field('sdt_tai_khoan'); ?></td>
                                        <td><?php echo get_field('cmt_tai_khoan'); ?></td>
                                        <td><?php echo get_field('loai_quyen_tai_khoan'); ?></td>
                                        <td>
                                            <div class="img"><?php
                                                if (get_field('hinh_anh_tai_khoan')) {
                                                    echo "<img src='" . get_field('hinh_anh_tai_khoan') . "' alt='avatar'>";
                                                }
                                                ?>
                                        <td>
                                            <?php
                                                if(get_field('email_tai_khoan') != $_SESSION['mnv']){
                                                    ?>
                                                    <a class="edit" href="<?php the_permalink(); ?>"><i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    <a class="delete del_user"
                                                       href="<?php echo $del; ?>"
                                                       data-id="<?php echo get_the_ID(); ?>"
                                                       data-email="<?php echo get_field('email_tai_khoan'); ?>"
                                                       data-img="<?php echo get_field('ten_anh_tai_khoan'); ?>"><i
                                                                class="fa fa-times-circle" aria-hidden="true"></i></a>
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                endif;
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
            <?php
            if (isset($_GET['trashed']) and isset($_GET['ids'])) {
                $query = new WP_Query(array(
                    'post_type' => 'giao_dich',
                    'p' => $_GET['ids'],
                ));
                while ($query->have_posts()) : $query->the_post();
                    $path = get_field('hinh_anh_tai_khoan');
                    unlink($path);
                endwhile;
                wp_reset_postdata();
            }
            ?>

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