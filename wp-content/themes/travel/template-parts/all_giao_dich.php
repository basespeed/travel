<?php
/*
 * Template Name: Sửa giao dịch*/

if($_SESSION['sucess'] == "sucess") {
    get_header();

    ?>
    <div id="content" class="edit_giao_dich">
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
                <div class="giao_dich_moi">
                    <table>
                        <?php
                        $this_ID = get_the_ID();
                        $this_user = $_SESSION['mnv'];

                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        //Sắp sắp giao dịch
                        if(isset($_GET['sort'])){
                            if($_GET['sort'] == 'mgd'){
                                $meta_key = 'ma_gd_them_booking';
                                $meta_value_num = 'meta_value';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'mgd_desc'){
                                $meta_key = 'ma_gd_them_booking';
                                $meta_value_num = 'meta_value';
                                $order = 'DESC';
                            }elseif($_GET['sort'] == 'mbk'){
                                $meta_key = 'ma_gd';
                                $meta_value_num = 'meta_value';
                                $order = 'ASC';
                            }elseif($_GET['sort'] == 'mbk_desc'){
                                $meta_key = 'ma_gd';
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
                            }

                            $arr = array(
                                'post_type' => 'giao_dich',
                                'posts_per_page' => 15,
                                'meta_key' => $meta_key,
                                'orderby' => $meta_value_num,
                                'order' => $order,
                                'paged' => $paged,
                            );
                        }else{
                            $arr = array(
                                'post_type' => 'giao_dich',
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
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'code'){echo 'code_desc'; }else{echo 'code';}?>">CODE <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'code'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'code_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'mgd'){echo 'mgd_desc'; }else{echo 'mgd';}?>">MGD <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'mgd'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'mgd_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'mbk'){echo 'mbk_desc'; }else{echo 'mbk';}?>">MBK <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'mbk'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'mbk_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'kdd'){echo 'kdd_desc'; }else{echo 'kdd';}?>">Khách đại diện <?php
                                    if(isset($_GET['sort']) && $_GET['sort'] == 'kdd'){
                                        echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                    }elseif(isset($_GET['sort']) && $_GET['sort'] == 'kdd_desc'){
                                        echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                    }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'tks'){echo 'tks_desc'; }else{echo 'tks';}?>">Tên Khách sạn <?php
                                    if(isset($_GET['sort']) && $_GET['sort'] == 'tks'){
                                        echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                    }elseif(isset($_GET['sort']) && $_GET['sort'] == 'tks_desc'){
                                        echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                    }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'ci'){echo 'ci_desc'; }else{echo 'ci';}?>">Check-in <?php
                                    if(isset($_GET['sort']) && $_GET['sort'] == 'ci'){
                                        echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                    }elseif(isset($_GET['sort']) && $_GET['sort'] == 'ci_desc'){
                                        echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                    }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'co'){echo 'co_desc'; }else{echo 'co';}?>">Check-out <?php
                                    if(isset($_GET['sort']) && $_GET['sort'] == 'co'){
                                        echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                    }elseif(isset($_GET['sort']) && $_GET['sort'] == 'co_desc'){
                                        echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                    }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'slp'){echo 'slp_desc'; }else{echo 'slp';}?>">SLP <?php
                                    if(isset($_GET['sort']) && $_GET['sort'] == 'slp'){
                                        echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                    }elseif(isset($_GET['sort']) && $_GET['sort'] == 'slp_desc'){
                                        echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                    }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'lp'){echo 'lp_desc'; }else{echo 'lp';}?>">Loại phòng <?php
                                    if(isset($_GET['sort']) && $_GET['sort'] == 'lp'){
                                        echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                    }elseif(isset($_GET['sort']) && $_GET['sort'] == 'lp_desc'){
                                        echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                    }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'htb'){echo 'htb_desc'; }else{echo 'htb';}?>">Hình thức BKK <?php
                                    if(isset($_GET['sort']) && $_GET['sort'] == 'htb'){
                                        echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                    }elseif(isset($_GET['sort']) && $_GET['sort'] == 'htb_desc'){
                                        echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                    }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'cnks'){echo 'cnks_desc'; }else{echo 'cnks';}?>">Còn nợ KS (cả PT) <?php
                                    if(isset($_GET['sort']) && $_GET['sort'] == 'cnks'){
                                        echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                    }elseif(isset($_GET['sort']) && $_GET['sort'] == 'cnks'){
                                        echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                    }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'nptth'){echo 'nptth_desc'; }else{echo 'nptth';}?>">Ngày phải TT hết <?php
                                    if(isset($_GET['sort']) && $_GET['sort'] == 'nptth'){
                                        echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                    }elseif(isset($_GET['sort']) && $_GET['sort'] == 'nptth_desc'){
                                        echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                    }
                                ?></a></strong></td>
                                <td><strong><a href="<?php echo get_home_url('/'); ?>/giao-dich/?sort=<?php if($_GET['sort'] == 'tpttcks'){echo 'tpttcks_desc'; }else{echo 'tpttcks';}?>">Tổng phải TT cho KS cả PT <?php
                                    if(isset($_GET['sort']) && $_GET['sort'] == 'tpttcks'){
                                        echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                    }elseif(isset($_GET['sort']) && $_GET['sort'] == 'tpttcks_desc'){
                                        echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                    }
                                ?></a></strong></td>
                                <td><strong>Ghi chú nội bộ</strong></td>
                                <td></td>
                            </tr>
                            <?php

                            while ($the_query->have_posts()) : $the_query->the_post();
                                $this_ID = get_the_ID();
                                $the_permalink = get_permalink();
                                ?>
                                <tr>
                                    <td><?php echo get_field('ma_xac_nhan'); ?></td>
                                    <td><?php echo get_field('ma_gd_them_booking'); ?></td>
                                    <td><?php echo get_field('ma_gd'); ?></td>
                                    <td><?php echo get_field('khach_dai_dien_gd'); ?></td>
                                    <td><?php echo get_field('ten_khach_san_gd'); ?></td>
                                    <td><?php
                                        echo get_field('ci_gd');
                                    ?></td>
                                    <td><?php
                                        echo get_field('co_gd');
                                    ?></td>
                                    <td><?php echo get_field('sl_gd'); ?></td>
                                    <td><?php echo get_field('loai_phong_ban_dt'); ?></td>
                                    <td><?php echo get_field('hinh_thuc_book_gd'); ?></td>
                                    <td><?php echo get_field('kh_con_no_khac'); ?></td>
                                    <td><?php
                                        echo get_field('ngay_yeu_cau_kh_hoan_tat_tt_khac');
                                    ?></td>
                                    <td width="10%"><?php echo get_field('tong_gia_tri_khac'); ?></td>
                                    <td width="12%"><?php
                                        $arr_chat = array(
                                            'post_type' => 'chat',
                                            'posts_per_page' => 1,
                                            'order' => 'DESC',
                                            'meta_key'		=> 'id_chat_gd',
                                            'meta_value' => '^' . preg_quote( $this_ID ),
                                            'meta_compare' => 'RLIKE',
                                        );
                                        $query_chat = get_posts($arr_chat);
                                        if( $query_chat ): foreach( $query_chat as $post ):
                                            setup_postdata( $post );
                                            echo get_field('tin_nhan_chat');
                                        endforeach;
                                        else :
                                            echo 'Dữ liệu trống !';
                                        endif;
                                        wp_reset_postdata();
                                    ?></td>
                                    <td>
                                        <a class="edit" href="<?php echo $the_permalink; ?>"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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