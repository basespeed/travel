<?php
/*
 * Template Name: Sửa giao dịch*/

if($_SESSION['sucess'] == "sucess") {
    get_header();

    ?>
    <div id="content" class="edit_giao_dich">
        <div class="quantri_admin">
            <?php include 'inc/template_menu.php'; ?>

            <div class="content_admin">
                <div class="giao_dich_moi">
                    <?php include get_template_directory().'/template-parts/inc/template_search_bk.php'; ?>
                    <div class="total_room">
                        <span>Giao dịch : <?php
                            echo '<strong>'.$count_posts = wp_count_posts( 'giao_dich' )->publish.'</strong>';
                            ?></span>
                        <strong> | </strong>
                        <span>Số phòng : <?php
                            $total_room = new WP_Query(array(
                                'post_type' => 'giao_dich',
                                'posts_per_page' => -1,
                                'order' => 'DESC'
                            ));
                            $count_room = 0;
                            if($total_room->have_posts()) : while ($total_room->have_posts()) : $total_room->the_post();
                                if(get_field('trang_thai_tach_booking') != 'true'){
                                    $sl_gd = (int)get_field('sl_gd');
                                    $count_room += $sl_gd;
                                }
                            endwhile;
                            endif;
                            wp_reset_postdata();
                            echo '<strong>'.$count_room.'</strong>';
                            ?></span>
                    </div>
                    <div class="menu_link_bk">
                        <ul>
                            <li><a href="<?php echo get_home_url(); ?>/giao-dich?check=all" class="<?php if($_GET['check'] == 'all'){echo 'active';} ?>">Tất cả</a></li>
                            <li>|</li>
                            <li><a href="<?php echo get_home_url(); ?>/giao-dich?check=warehouse" class="<?php if($_GET['check'] == 'warehouse'){echo 'active';} ?>">Kho</a></li>
                            <li>|</li>
                            <li><a href="<?php echo get_home_url(); ?>/giao-dich?check=buy" class="<?php if($_GET['check'] == 'buy'){echo 'active';} ?>">Đã bán</a></li>
                            <li>|</li>
                            <li><a href="<?php echo get_home_url(); ?>/giao-dich?check=debt" class="<?php if($_GET['check'] == 'debt'){echo 'active';} ?>">Còn nợ</a></li>
                            <li>|</li>
                            <li><a href="<?php echo get_home_url(); ?>/giao-dich?check=success_buy" class="<?php if($_GET['check'] == 'success_buy'){echo 'active';} ?>">Hoàn tất</a></li>
                        </ul>
                    </div>
                    <div class="content_hotel_list">
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
                                }elseif($_GET['sort'] == 'mlk'){
                                    $meta_key = 'ma_gd_con';
                                    $meta_value_num = 'meta_value';
                                    $order = 'ASC';
                                }elseif($_GET['sort'] == 'mlk_desc'){
                                    $meta_key = 'ma_gd_con';
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
                                }elseif($_GET['sort'] == 'huy'){
                                    $meta_key = 'con_ngay_dt';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'ASC';
                                }elseif($_GET['sort'] == 'huy_desc'){
                                    $meta_key = 'con_ngay_dt';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'DESC';
                                }elseif($_GET['sort'] == 'doi'){
                                    $meta_key = 'con_ngay_thay_doi_dt';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'ASC';
                                }elseif($_GET['sort'] == 'doi_desc'){
                                    $meta_key = 'con_ngay_thay_doi_dt';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'DESC';
                                }elseif($_GET['sort'] == 'ban'){
                                    $meta_key = 'don_gia_ban_gd';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'ASC';
                                }elseif($_GET['sort'] == 'ban_desc'){
                                    $meta_key = 'don_gia_ban_gd';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'DESC';
                                }elseif($_GET['sort'] == 'mua'){
                                    $meta_key = 'don_gia_ban_dt';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'ASC';
                                }elseif($_GET['sort'] == 'mua_desc'){
                                    $meta_key = 'don_gia_ban_dt';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'DESC';
                                }elseif($_GET['sort'] == 'tt_ban'){
                                    $meta_key = 'tong_gd';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'ASC';
                                }elseif($_GET['sort'] == 'tt_ban_desc'){
                                    $meta_key = 'tong_gd';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'DESC';
                                }elseif($_GET['sort'] == 'tt_mua'){
                                    $meta_key = 'tong_dt';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'ASC';
                                }elseif($_GET['sort'] == 'tt_mua_desc'){
                                    $meta_key = 'tong_dt';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'DESC';
                                }elseif($_GET['sort'] == 'pt_mua'){
                                    $meta_key = 'tong_pt';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'ASC';
                                }elseif($_GET['sort'] == 'pt_mua_desc'){
                                    $meta_key = 'tong_pt';
                                    $meta_value_num = 'meta_value_num';
                                    $order = 'DESC';
                                }

                                $arr = array(
                                    'post_type' => 'giao_dich',
                                    'posts_per_page' => 15,
                                    'meta_key' => $meta_key,
                                    'orderby' => $meta_value_num,
                                    'meta_query' => array(
                                        'relation' => 'AND',
                                        'sort_list_booking' => array(
                                            'key' => $meta_key,
                                            'compare' => 'EXISTS',
                                        ),
                                        'sort_list_booking' => array(
                                            'key' => 'ma_gd_them_booking',
                                            'compare' => 'EXISTS',
                                        ),
                                    ),
                                    'orderby' => 'sort_list_booking',
                                    'order' => $order,
                                    'paged' => $paged,
                                );
                            }else{
                                $arr = array(
                                    'post_type' => 'giao_dich',
                                    'posts_per_page' => 200,
                                    'order' => 'ASC',
                                    'meta_key' => 'ma_gd_them_booking',
                                    'orderby' => 'meta_value',
                                    'paged' => $paged,
                                );
                            }

                            $the_query = new WP_Query($arr);
                            $n = 1;
                            if ($the_query->have_posts()) :
                                ?>
                                <tr>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                                echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                                if($_GET['sort'] == 'mgd'){
                                                    echo 'mgd_desc';
                                                }else{
                                                    echo 'mgd';
                                                }?>">MGD <?php
                                                if(isset($_GET['sort']) && $_GET['sort'] == 'mgd'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'mgd_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }
                                                ?>
                                            </a>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'mbk'){
                                                echo 'mbk_desc';
                                            }else{
                                                echo 'mbk';
                                            }?>">MBK</a>/
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'mlk'){
                                                echo 'mlk_desc';
                                            }else{
                                                echo 'mlk';
                                            }?>">MLK <?php
                                                if(isset($_GET['sort']) && $_GET['sort'] == 'mlk'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'mlk_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'mbk'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'mbk_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }
                                                ?>
                                            </a>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'code'){
                                                echo 'code_desc';
                                            }else{
                                                echo 'code';
                                            }?>">CODE <?php
                                                if(isset($_GET['sort']) && $_GET['sort'] == 'code'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'code_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }
                                                ?>
                                            </a>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'kdd'){
                                                echo 'kdd_desc';
                                            }else{
                                                echo 'kdd';
                                            }?>">Khách đại diện <?php
                                                if(isset($_GET['sort']) && $_GET['sort'] == 'kdd'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'kdd_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }
                                                ?>
                                            </a>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'tks'){
                                                echo 'tks_desc';
                                            }else{
                                                echo 'tks';
                                            }?>">Tên Khách sạn</a>
                                             <?php
                                                if(isset($_GET['sort']) && $_GET['sort'] == 'tks'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'tks_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }
                                                ?>
                                            </a>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'slp'){
                                                echo 'slp_desc';
                                            }else{
                                                echo 'slp';
                                            }?>">SLP</a>
                                            <?php
                                            if(isset($_GET['sort']) && $_GET['sort'] == 'slp'){
                                                echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                            }elseif(isset($_GET['sort']) && $_GET['sort'] == 'slp_desc'){
                                                echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                            }
                                            ?>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'lp'){
                                                echo 'lp_desc';
                                            }else{
                                                echo 'lp';
                                            }?>"> Loại phòng <?php
                                                if(isset($_GET['sort']) && $_GET['sort'] == 'lp'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'lp_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }
                                                ?>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'ci'){
                                                echo 'ci_desc';
                                            }else{
                                                echo 'ci';
                                            }?>">CI</a> /
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'co'){
                                                echo 'co_desc';
                                            }else{
                                                echo 'co';
                                            }?>">CO <?php
                                                if(isset($_GET['sort']) && $_GET['sort'] == 'ci'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'ci_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'co'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'co_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }
                                                ?>
                                            </a>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            Đến <br>CI-CO
                                        </strong>
                                    </td>
                                    <td><strong>Nội dung chat cuối</strong></td>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'huy'){
                                                echo 'huy_desc';
                                            }else{
                                                echo 'huy';
                                            }?>">HH</a> /
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'doi'){
                                                echo 'doi_desc';
                                            }else{
                                                echo 'doi';
                                            }?>">Đổi <?php
                                                if(isset($_GET['sort']) && $_GET['sort'] == 'huy'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'huy_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'doi'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'doi_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }
                                                ?>
                                            </a>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'ban'){
                                                echo 'ban_desc';
                                            }else{
                                                echo 'ban';
                                            }?>">Đơn giá bán</a> /
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'mua'){
                                                echo 'mua_desc';
                                            }else{
                                                echo 'mua';
                                            }?>">Mua <?php
                                                if(isset($_GET['sort']) && $_GET['sort'] == 'ban'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'ban_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'mua'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'mua_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }
                                                ?>
                                            </a>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'tt_ban'){
                                                echo 'tt_ban_desc';
                                            }else{
                                                echo 'tt_ban';
                                            }?>">Thành tiền <?php
                                                if(isset($_GET['sort']) && $_GET['sort'] == 'tt_ban'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'tt_ban_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }
                                                ?>
                                            </a>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <a href="<?php
                                            echo get_home_url('/');
                                            ?>/giao-dich/?sort=<?php
                                            if($_GET['sort'] == 'pt_mua'){
                                                echo 'pt_mua_desc';
                                            }else{
                                                echo 'pt_mua';
                                            }?>">Phụ thu <?php
                                                if(isset($_GET['sort']) && $_GET['sort'] == 'pt_mua'){
                                                    echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                                                }elseif(isset($_GET['sort']) && $_GET['sort'] == 'pt_mua_desc'){
                                                    echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                                                }
                                                ?>
                                            </a>
                                        </strong>
                                    </td>
                                    <td><strong>Tổng cả PT</strong></td>
                                    <td><strong>KH nợ/BCT nợ</strong></td>
                                    <!--<td><strong>TT BKK KH/ĐT</strong></td>-->
                                    <td></td>
                                </tr>
                                <?php

                                $stt = 1;
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    $this_ID = get_the_ID();
                                    $the_permalink = get_permalink();
                                    $ten_khach_san_gd = get_field('ten_khach_san_gd');
                                    $ci_gd = get_field('ci_gd');
                                    $co_gd = get_field('co_gd');
                                    $sl_gd = get_field('sl_gd');
                                    $loai_phong_ban_dt = get_field('loai_phong_ban_dt');
                                    $hinh_thuc_book_gd = get_field('hinh_thuc_book_gd');
                                    $kh_con_no_khac = get_field('kh_con_no_khac');
                                    $tong_gia_tri_khac = get_field('tong_gia_tri_khac');
                                    $ngay_phai_hoan_tat_tt_cho_ks_khac2 = get_field('ngay_phai_hoan_tat_tt_cho_ks_khac2');
                                    $ma_gd_them_booking = get_field('ma_gd_them_booking');
                                    $goi_dv_km_ban_gd = get_field('goi_dv_km_ban_gd');
                                    $so_dem_gd = get_field('so_dem_gd');
                                    $con_ngay_gd = get_field('con_ngay_gd');
                                    $con_ngay_dt = get_field('con_ngay_dt');
                                    $con_ngay_thay_doi_dt = get_field('con_ngay_thay_doi_dt');
                                    $don_gia_ban_gd = get_field('don_gia_ban_gd');
                                    $don_gia_ban_dt = get_field('don_gia_ban_dt');
                                    $tong_gd = get_field('tong_gd');
                                    $tong_dt = get_field('tong_dt');
                                    $tong_pt = get_field('tong_pt');
                                    $tong_gia_tri_khac = get_field('tong_gia_tri_khac');
                                    $tong_gia_tri_khac2 = get_field('tong_gia_tri_khac2');
                                    $kh_con_no_khac = get_field('kh_con_no_khac');
                                    $bct_con_no_khac2 = get_field('bct_con_no_khac2');
                                    $trang_thai_bkk_voi_kh_gd = get_field('trang_thai_bkk_voi_kh_gd');
                                    $trang_thai_bkk_voi_dt = get_field('trang_thai_bkk_voi_dt');

                                    //count debt check
                                    $tong_gia_tri_khac = get_field('tong_gia_tri_khac');
                                    if (strpos($tong_gia_tri_khac, ',') === false) {
                                        $tong_gia_tri_khac = get_field('tong_gia_tri_khac');
                                    }else{
                                        $tong_gia_tri_khac = get_field('tong_gia_tri_khac');
                                        $tong_gia_tri_khac = str_replace(',','',$tong_gia_tri_khac);
                                        $tong_gia_tri_khac = str_replace(',','',$tong_gia_tri_khac);
                                        $tong_gia_tri_khac = str_replace(',','',$tong_gia_tri_khac);
                                    }
                                    $da_thanh_toan_khac = get_field('da_thanh_toan_khac');
                                    if (strpos($da_thanh_toan_khac, ',') === false) {
                                        $da_thanh_toan_khac = get_field('da_thanh_toan_khac');
                                    }else{
                                        $da_thanh_toan_khac = get_field('da_thanh_toan_khac');
                                        $da_thanh_toan_khac = str_replace(',','',$da_thanh_toan_khac);
                                        $da_thanh_toan_khac = str_replace(',','',$da_thanh_toan_khac);
                                        $da_thanh_toan_khac = str_replace(',','',$da_thanh_toan_khac);
                                    }

                                    $check_debt1 = $tong_gia_tri_khac - $da_thanh_toan_khac;

                                    $tong_gia_tri_khac2 = get_field('tong_gia_tri_khac2');
                                    if (strpos($tong_gia_tri_khac2, ',') === false) {
                                        $tong_gia_tri_khac2 = get_field('tong_gia_tri_khac2');
                                    }else{
                                        $tong_gia_tri_khac2 = get_field('tong_gia_tri_khac2');
                                        $tong_gia_tri_khac2 = str_replace(',','',$tong_gia_tri_khac2);
                                        $tong_gia_tri_khac2 = str_replace(',','',$tong_gia_tri_khac2);
                                        $tong_gia_tri_khac2 = str_replace(',','',$tong_gia_tri_khac2);
                                    }
                                    $da_thanh_toan_khac2 = get_field('da_thanh_toan_khac2');
                                    if (strpos($da_thanh_toan_khac2, ',') === false) {
                                        $da_thanh_toan_khac2 = get_field('da_thanh_toan_khac2');
                                    }else{
                                        $da_thanh_toan_khac2 = get_field('da_thanh_toan_khac2');
                                        $da_thanh_toan_khac2 = str_replace(',','',$da_thanh_toan_khac2);
                                        $da_thanh_toan_khac2 = str_replace(',','',$da_thanh_toan_khac2);
                                        $da_thanh_toan_khac2 = str_replace(',','',$da_thanh_toan_khac2);
                                    }

                                    $check_debt2 = $tong_gia_tri_khac2 - $da_thanh_toan_khac2;

                                    if($_GET['check'] == 'warehouse'){
                                        if(get_field('trang_thai_tach_booking') != 'true' || get_field('check_buy') == 'true'){
                                            if(!empty(get_field('ten_khach_san_gd'))){
                                                include get_template_directory().'/template-parts/inc/template_all_bk.php';
                                            }else{
                                                ?>
                                                <tr><td colspan="17"><p><strong>Dữ liệu trống !</strong></p></td></tr>
                                                <?php
                                                break;
                                            }
                                        }
                                    }elseif($_GET['check'] == 'buy'){
                                        if(get_field('check_buy') == 'true'){
                                            if(!empty(get_field('ten_khach_san_gd'))){
                                                include get_template_directory().'/template-parts/inc/template_all_bk.php';
                                            }else{
                                                ?>
                                                <tr><td colspan="17"><p><strong>Dữ liệu trống !</strong></p></td></tr>
                                                <?php
                                                break;
                                            }
                                        }
                                    }elseif($_GET['check'] == 'debt'){
                                        if($check_debt1 > 0 and $check_debt2 > 0){
                                            if(!empty(get_field('ten_khach_san_gd'))){
                                                include get_template_directory().'/template-parts/inc/template_all_bk.php';
                                            }else{
                                                ?>
                                                <tr><td colspan="17"><p><strong>Dữ liệu trống !</strong></p></td></tr>
                                                <?php
                                                break;
                                            }
                                        }
                                    }elseif($_GET['check'] == 'success_buy'){

                                        if($check_debt1 <= 0 and $check_debt2 <= 0){
                                            if(!empty(get_field('ten_khach_san_gd'))){
                                                include get_template_directory().'/template-parts/inc/template_all_bk.php';
                                            }else{
                                                ?>
                                                <tr><td colspan="17"><p><strong>Dữ liệu trống !</strong></p></td></tr>
                                                <?php
                                                break;
                                            }
                                        }
                                    }else{
                                        ?>
                                        <tr>
                                            <td><?php echo get_field('ma_gd_them_booking'); ?></td>
                                            <td><?php
                                                echo get_field('ma_gd');
                                                echo '</br>';
                                                echo get_field('ma_gd_con');
                                                ?>
                                            </td>
                                            <td><?php echo get_field('ma_xac_nhan'); ?></td>
                                            <td><?php
                                                $args = array(
                                                    'p'         => get_field('khach_dai_dien_gd'), // ID of a page, post, or custom type
                                                    'post_type' => 'khach_hang'
                                                );
                                                $query_kh = new WP_Query($args);
                                                if($query_kh->have_posts()) :
                                                    while ($query_kh->have_posts()) : $query_kh->the_post();
                                                        if (!empty(get_field('ten_kgd'))){
                                                            echo get_field('ten_kgd');
                                                        }else{
                                                            echo get_field('khach_dai_dien_gd');
                                                        }
                                                    endwhile;
                                                else :
                                                    echo get_field('khach_dai_dien_gd');
                                                endif;
                                                wp_reset_postdata();
                                                ?>
                                            </td>
                                            <td><?php
                                                if(!empty($ten_khach_san_gd)){
                                                    if ( (int)$ten_khach_san_gd == $ten_khach_san_gd ) {
                                                        $query_name_hotel = new WP_Query(array(
                                                            'post_type' => 'hotel',
                                                            'p' => $ten_khach_san_gd,
                                                            'posts_per_page' => 1,
                                                        ));

                                                        if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                                                            echo get_the_title();
                                                        endwhile;
                                                        else :
                                                            echo get_field('ten_khach_san_gd');
                                                        endif;
                                                        wp_reset_postdata();
                                                    }else{
                                                        echo get_field('ten_khach_san_gd');
                                                    }
                                                }
                                                echo '<br>';
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $sl_gd; ?>
                                            </td>
                                            <td>
                                                <?php echo $loai_phong_ban_dt; ?>
                                            </td>
                                            <td><?php
                                                echo $ci_gd;
                                                echo '<br>';
                                                echo $co_gd;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo '<strong>'.$so_dem_gd.'</strong>';
                                                echo '<br>';
                                                echo $con_ngay_gd;
                                                ?>
                                            </td>
                                            <td width="12%"><?php
                                                $arr_chat = array(
                                                    'post_type' => 'chat',
                                                    'posts_per_page' => 1,
                                                    'order' => 'DESC',
                                                    'meta_key'		=> 'id_chat_gd',
                                                    'meta_value' => $ma_gd_them_booking,
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
                                                ?>
                                            </td>
                                            <td><?php
                                                echo $con_ngay_dt;
                                                echo '<br>';
                                                echo $con_ngay_thay_doi_dt;
                                                ?>
                                            </td>
                                            <td><?php
                                                if(!empty($don_gia_ban_gd)){
                                                    if (strpos($don_gia_ban_gd, ',') === false) {
                                                        echo '<strong>'.number_format($don_gia_ban_gd,'0',',',',').'</strong>';
                                                    }else{
                                                        echo '<strong>'.$don_gia_ban_gd.'</strong>';
                                                    }
                                                }
                                                echo '<br>';
                                                if(!empty($don_gia_ban_dt)){
                                                    if (strpos($don_gia_ban_dt, ',') === false) {
                                                        echo number_format($don_gia_ban_dt,'0',',',',');
                                                    }else{
                                                        echo $don_gia_ban_dt;
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><?php
                                                if(!empty($tong_gd)){
                                                    if (strpos($tong_gd, ',') === false) {
                                                        echo '<strong>'.number_format($tong_gd,'0',',',',').'</strong>';
                                                    }else{
                                                        echo '<strong>'.$tong_gd.'</strong>';
                                                    }
                                                }
                                                echo '<br>';
                                                if(!empty($tong_dt)){
                                                    if (strpos($tong_dt, ',') === false) {
                                                        echo number_format($tong_dt,'0',',',',');
                                                    }else{
                                                        echo $tong_dt;
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><?php
                                                if(!empty($tong_pt)){
                                                    if (strpos($tong_pt, ',') === false) {
                                                        echo '<strong>'.number_format($tong_pt,'0',',',',').'</strong>';
                                                    }else{
                                                        echo '<strong>'.$tong_pt.'</strong>';
                                                    }
                                                }
                                                echo '<br>';
                                                if(!empty($tong_pt)){
                                                    if (strpos($tong_pt, ',') === false) {
                                                        echo number_format($tong_pt,'0',',',',');
                                                    }else{
                                                        echo $tong_pt;
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><?php
                                                if(!empty($tong_gia_tri_khac)){
                                                    if (strpos($tong_gia_tri_khac, ',') === false) {
                                                        echo '<strong>'.number_format($tong_gia_tri_khac,'0',',',',').'</strong>';
                                                    }else{
                                                        echo '<strong>'.$tong_gia_tri_khac.'</strong>';
                                                    }
                                                }
                                                echo '<br>';
                                                if(!empty($tong_gia_tri_khac2)){
                                                    if (strpos($tong_gia_tri_khac2, ',') === false) {
                                                        echo number_format($tong_gia_tri_khac2,'0',',',',');
                                                    }else{
                                                        echo $tong_gia_tri_khac2;
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><?php
                                                $a = $kh_con_no_khac;
                                                if(!empty($kh_con_no_khac)){
                                                    if (strpos($a, ',') === false) {
                                                        echo '<strong>'.number_format($kh_con_no_khac,'0',',',',').'</strong>';
                                                    }else{
                                                        echo '<strong>'.$kh_con_no_khac.'</strong>';
                                                    }
                                                }
                                                echo '<br>';
                                                $b = $bct_con_no_khac2;
                                                if(!empty($bct_con_no_khac2)){
                                                    if (strpos($b, ',') === false) {
                                                        echo number_format($bct_con_no_khac2,'0',',',',');
                                                    }else{
                                                        echo $bct_con_no_khac2;
                                                    }
                                                }
                                                ?>
                                            </td>

                                            <!-- <td><?php
                                            /*                                            echo '<strong>'.$trang_thai_bkk_voi_kh_gd.'</strong>';
                                                                                        echo '<br>';
                                                                                        echo $trang_thai_bkk_voi_dt;
                                                                                    */?></td>-->
                                            <td>
                                                <a class="edit" href="<?php echo $the_permalink; ?>"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
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
                    </div>
                    <?php
                    if ($total_pages) :
                        echo '<nav class="nav">';
                        $permalink_nav = get_pagenum_link(1);
                        $permalink = get_permalink();
                        $permalink_re = str_replace($permalink,"",$permalink_nav);
                        echo paginate_links(array(
                            'base' => $permalink . '%_%' .$permalink_re,
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