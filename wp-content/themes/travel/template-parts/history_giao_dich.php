<?php
    /*Template Name: Lịch sử giao dịch*/

if($_SESSION['sucess'] == "sucess") {
    get_header();

    ?>
    <div id="content">
        <div class="quantri_admin">
            <?php include 'inc/template_menu.php'; ?>

            <div class="content_admin">
                <div class="giao_dich_moi">
                    <table>
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        if(isset($_GET['sort'])){
                            if($_GET['sort'] == 'nick'){
                                $meta_key = 'nick_kgd';
                                $meta_value_num = 'meta_value';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'nick_desc'){
                                $meta_key = 'nick_kgd';
                                $meta_value_num = 'meta_value';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'kdd'){
                                $meta_key = 'khach_dai_dien_gd';
                                $meta_value_num = 'meta_value';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'kdd_desc'){
                                $meta_key = 'khach_dai_dien_gd';
                                $meta_value_num = 'meta_value';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'code'){
                                $meta_key = 'ma_xac_nhan';
                                $meta_value_num = 'meta_value';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'code_desc'){
                                $meta_key = 'ma_xac_nhan';
                                $meta_value_num = 'meta_value';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'tks'){
                                $meta_key = 'ten_khach_san_gd';
                                $meta_value_num = 'meta_value';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'tks_desc'){
                                $meta_key = 'ten_khach_san_gd';
                                $meta_value_num = 'meta_value';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'ci'){
                                $meta_key = 'ci_gd';
                                $meta_value_num = 'meta_value_num';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'ci_desc'){
                                $meta_key = 'ci_gd';
                                $meta_value_num = 'meta_value_num';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'co'){
                                $meta_key = 'co_gd';
                                $meta_value_num = 'meta_value_num';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'co_desc'){
                                $meta_key = 'co_gd';
                                $meta_value_num = 'meta_value_num';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'slp'){
                                $meta_key = 'sl_gd';
                                $meta_value_num = 'meta_value_num';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'slp_desc'){
                                $meta_key = 'sl_gd';
                                $meta_value_num = 'meta_value_num';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'lp'){
                                $meta_key = 'loai_phong_ban_dt';
                                $meta_value_num = 'meta_value';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'lp_desc'){
                                $meta_key = 'loai_phong_ban_dt';
                                $meta_value_num = 'meta_value';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'htb'){
                                $meta_key = 'hinh_thuc_book_gd';
                                $meta_value_num = 'meta_value';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'htb_desc'){
                                $meta_key = 'hinh_thuc_book_gd';
                                $meta_value_num = 'meta_value';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'cnks'){
                                $meta_key = 'kh_con_no_khac';
                                $meta_value_num = 'meta_value_num';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'cnks_desc'){
                                $meta_key = 'kh_con_no_khac';
                                $meta_value_num = 'meta_value_num';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'nptth'){
                                $meta_key = 'ngay_yeu_cau_kh_hoan_tat_tt_khac';
                                $meta_value_num = 'meta_value_num';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'nptth_desc'){
                                $meta_key = 'ngay_yeu_cau_kh_hoan_tat_tt_khac';
                                $meta_value_num = 'meta_value_num';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'tpttcks'){
                                $meta_key = 'tong_gia_tri_khac';
                                $meta_value_num = 'meta_value_num';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'tpttcks_desc'){
                                $meta_key = 'tong_gia_tri_khac';
                                $meta_value_num = 'meta_value_num';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'gc'){
                                $meta_key = $tin_nhan_chat;
                                $meta_value_num = 'meta_value';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'gc_desc'){
                                $meta_key = $tin_nhan_chat;
                                $meta_value_num = 'meta_value';
                                $order = 'DESC';
                            }

                            $arr = array(
                                'post_type' => 'history_giao_dich',
                                'posts_per_page' => 15,
                                'meta_key' => $meta_key,
                                'orderby' => $meta_value_num,
                                'order' => $order,
                                'paged' => $paged,
                            );
                        }else{
                            $arr = array(
                                'post_type' => 'history_giao_dich',
                                'posts_per_page' => 15,
                                'order' => 'DESC',
                                'paged' => $paged,
                            );
                        }

                        $the_query = new WP_Query($arr);
                        $n = 1;
                        if ($the_query->have_posts()) :
                            ?>
                            <tr>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'nick'){echo 'nick_desc'; }else{echo 'nick';}?>">Nick <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'nick'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'nick_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'kdd'){echo 'kdd_desc'; }else{echo 'kdd';}?>">Khách đại diện <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'kdd'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'kdd_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'code'){echo 'code_desc'; }else{echo 'code';}?>">CODE <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'code'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'code_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'tks'){echo 'tks_desc'; }else{echo 'tks';}?>">Tên Khách sạn <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'tks'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'tks_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'ci'){echo 'ci_desc'; }else{echo 'ci';}?>">Check-in <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'ci'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'ci_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'co'){echo 'co_desc'; }else{echo 'co';}?>">Check-out <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'co'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'co_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'slp'){echo 'slp_desc'; }else{echo 'slp';}?>">SLP <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'slp'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'slp_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'lp'){echo 'lp_desc'; }else{echo 'lp';}?>">Loại phòng <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'lp'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'lp_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'htb'){echo 'htb_desc'; }else{echo 'htb';}?>">Hình thức BKK <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'htb'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'htb_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'cnks'){echo 'cnks_desc'; }else{echo 'cnks';}?>">Còn nợ KS (cả PT) <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'cnks'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'cnks'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'nptth'){echo 'nptth_desc'; }else{echo 'nptth';}?>">Ngày phải TT hết <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'nptth'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'nptth_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/lich-su-giao-dich/?sort=<?php if($_GET['sort'] == 'tpttcks'){echo 'tpttcks_desc'; }else{echo 'tpttcks';}?>">Tổng phải TT cho KS cả PT <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'tpttcks'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'tpttcks_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?></a></strong></td>
                                <td><strong>Người sửa</strong></td>
                                <td><strong>Hành động</strong></td>
                                <td><strong>Thời gian sửa</strong></td>
                                <td></td>
                            </tr>
                            <?php

                            while ($the_query->have_posts()) : $the_query->the_post();
                                $nguoi_sua = get_field('nguoi_sua');
                                $hanh_dong = get_field('hanh_dong');
                                $thoi_gian_sua = get_field('thoi_gian_sua');
                                $get_permalink = get_permalink();
                                ?>
                                <tr>
                                    <td><?php echo get_field('nick_kgd'); ?></td>
                                    <td><?php echo get_field('khach_dai_dien_gd'); ?></td>
                                    <td><?php echo get_field('ma_xac_nhan'); ?></td>
                                    <td><?php echo get_field('ten_khach_san_gd'); ?></td>
                                    <td><?php echo get_field('ci_gd'); ?></td>
                                    <td><?php echo get_field('co_gd'); ?></td>
                                    <td><?php echo get_field('sl_gd'); ?></td>
                                    <td><?php echo get_field('loai_phong_ban_dt'); ?></td>
                                    <td><?php echo get_field('hinh_thuc_book_gd'); ?></td>
                                    <td><?php echo get_field('kh_con_no_khac'); ?></td>
                                    <td><?php echo get_field('ngay_yeu_cau_kh_hoan_tat_tt_khac'); ?></td>
                                    <td width="10%"><?php echo get_field('tong_gia_tri_khac'); ?></td>
                                    <td><?php echo $nguoi_sua; ?></td>
                                    <td><?php echo $hanh_dong; ?></td>
                                    <td><?php echo $thoi_gian_sua; ?></td>
                                    <td>
                                        <a class="view" href="<?php echo $get_permalink; ?>"><i class="fa fa-eye"
                                                                                            aria-hidden="true"></i></a>
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