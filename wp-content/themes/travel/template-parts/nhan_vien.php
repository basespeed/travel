<?php
/*
 * Template Name: Sửa nhân viên*/

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
                                'post_type' => 'nhan_vien',
                                'posts_per_page' => 10,
                                'order' => 'DESC',
                                'paged' => $paged,
                            );

                            $the_query = new WP_Query($arr);
                            $n = 1;
                            if ($the_query->have_posts()) :
                                ?>
                                <tr>
                                    <td><strong>Mã NV</strong></td>
                                    <td><strong>Tên NV</strong></td>
                                    <td><strong>Email NV</strong></td>
                                    <td><strong>SĐT NV</strong></td>
                                    <td><strong>TK NV</strong></td>
                                    <td><strong>Liên kết tài khoản</strong></td>
                                    <td></td>
                                </tr>
                                <?php

                                while ($the_query->have_posts()) : $the_query->the_post();
                                    ?>
                                    <tr>
                                        <td><?php echo get_field('ma_nv'); ?></td>
                                        <td><a class="title"
                                               href="<?php the_permalink(); ?>"><?php echo get_field('ten_nv'); ?></a>
                                        </td>
                                        <td><?php echo get_field('email_nv'); ?></td>
                                        <td><?php echo get_field('sdt_nv'); ?></td>
                                        <td><?php echo get_field('tk_nv'); ?></td>
                                        <td><?php
                                            $lien_ket_tai_khoan_nv = get_field('lien_ket_tai_khoan');

                                            $query = new WP_Query(array(
                                                'post_type' => 'tai_khoan',
                                                "s" => get_the_title()
                                            ));

                                            if ($query->have_posts()) {
                                                while ($query->have_posts()) : $query->the_post();
                                                    if (get_field('lien_ket_tai_khoan') != $lien_ket_tai_khoan_nv) {
                                                        echo '<span class="hide_active"></span>';
                                                    } else {
                                                        echo '<span class="show_active"></span>';
                                                    }
                                                endwhile;
                                            } else {
                                                echo '<span class="hide_active"></span>';
                                            }

                                            ?></td>
                                        <td>
                                            <a class="edit" href="<?php the_permalink(); ?>"><i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a onclick="return confirm('Bạn có chắc muốn xóa nó');" class="delete"
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
?>