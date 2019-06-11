<?php
$ma_gd_them_booking = get_field('ma_gd_them_booking');
?>
<table width="100%" border="1">
    <tbody>
    <tr>
        <td width="43%">
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td width="50%">Tên Khách sạn - Tên dịch vụ</td>
                    <td>Mã dịch vụ</td>
                </tr>
                <td align="center"></td>
                <tr>
                    <td width="50%">
                        <?php
                        $ten_khach_san_gd = get_field('ten_khach_san_gd');
                        $ma_gd_them_booking = get_field('ma_gd_them_booking');
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ten_khach_san_gd = $_POST['ten_khach_san_gd'];
                            ?>
                            <input type="text" name="ten_khach_san_gd_val" class="ten_khach_san_gd_val"  value="<?php
                            if(!empty($ten_khach_san_gd)){
                                if ( (int)$ten_khach_san_gd == $ten_khach_san_gd ) {
                                    $query_name_hotel = new WP_Query(array(
                                        'post_type' => 'hotel',
                                        'p' => $_POST['ten_khach_san_gd'],
                                        'posts_per_page' => 1,
                                    ));

                                    if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                                        echo get_the_title();
                                    endwhile;
                                    else :
                                        echo $_POST['ten_khach_san_gd'];
                                    endif;
                                    wp_reset_postdata();
                                }else{
                                    echo $_POST['ten_khach_san_gd'];
                                }
                            }
                            ?>" required autocomplete="off">
                            <input type="hidden" value="<?php
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
                                        echo $ten_khach_san_gd;
                                    endif;
                                    wp_reset_postdata();
                                }else{
                                    echo $ten_khach_san_gd;
                                }
                            }
                            ?>" class="title_new_post" />
                            <input type="hidden" name="ten_khach_san_gd" class="ten_khach_san_gd" value="<?php echo $ten_khach_san_gd; ?>" autocomplete="off">
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ten_khach_san_gd_val" class="ten_khach_san_gd_val"  value="<?php
                            if(!empty(get_field('ten_khach_san_gd'))){
                                $ten_khach_san_gd = get_field('ten_khach_san_gd');
                                if ( (int)$ten_khach_san_gd == $ten_khach_san_gd ) {
                                    $query_name_hotel = new WP_Query(array(
                                        'post_type' => 'hotel',
                                        'p' => get_field('ten_khach_san_gd'),
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
                            ?>" required autocomplete="off">
                            <input type="hidden" value="<?php
                            if(!empty(get_field('ten_khach_san_gd'))){
                                $ten_khach_san_gd = get_field('ten_khach_san_gd');
                                if ( (int)$ten_khach_san_gd == $ten_khach_san_gd ) {
                                    $query_name_hotel = new WP_Query(array(
                                        'post_type' => 'hotel',
                                        'p' => get_field('ten_khach_san_gd'),
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
                            ?>" class="title_new_post" />
                            <input type="hidden" name="ten_khach_san_gd" class="ten_khach_san_gd" value="<?php echo get_field('ten_khach_san_gd'); ?>" autocomplete="off">
                            <?php
                        }
                        ?>

                        <div class="pop_ten_khach_san_gd">
                            <ul>
                                <li>Hotel name</li>
                                <li>Numberrooms</li>
                                <li>Numberfloors</li>
                                <li>State</li>
                            </ul>
                            <div class="list_show">
                                <p>Không tìm thấy dữ liệu !</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            ?>
                            <input type="text" name="ma_dich_vu_gd_val" class="ma_dich_vu_gd_val" value="<?php
                            $ma_dich_vu_gd = $_POST['ma_dich_vu_gd'];
                            if(!empty($ma_dich_vu_gd)){
                                if ( (int)$ma_dich_vu_gd == $ma_dich_vu_gd ) {
                                    $query_name_hotel = new WP_Query(array(
                                        'post_type' => 'hotel',
                                        'p' => $ma_dich_vu_gd,
                                        'posts_per_page' => 1,
                                    ));

                                    if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                                        //echo get_the_title();
                                        echo to_slug(get_the_title()).'-'.get_the_ID();
                                    endwhile;
                                    else :
                                        echo $ma_dich_vu_gd;
                                    endif;
                                    wp_reset_postdata();
                                }else{
                                    echo $ma_dich_vu_gd;
                                }
                            }
                            ?>" required autocomplete="off"/>
                            <input type="hidden" name="ma_dich_vu_gd" class="ma_dich_vu_gd" value="<?php echo $ma_dich_vu_gd; ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ma_dich_vu_gd_val" class="ma_dich_vu_gd_val" value="<?php
                            if(!empty(get_field('ma_dich_vu_gd'))){
                                $ma_dich_vu_gd = get_field('ma_dich_vu_gd');
                                if ( (int)$ma_dich_vu_gd == $ma_dich_vu_gd ) {
                                    $query_name_hotel = new WP_Query(array(
                                        'post_type' => 'hotel',
                                        'p' => get_field('ma_dich_vu_gd'),
                                        'posts_per_page' => 1,
                                    ));

                                    if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                                        //echo get_the_title();
                                        echo to_slug(get_the_title()).'-'.get_the_ID();
                                    endwhile;
                                    else :
                                        echo get_field('ma_dich_vu_gd');
                                    endif;
                                    wp_reset_postdata();
                                }else{
                                    echo get_field('ma_dich_vu_gd');
                                }
                            }
                            ?>" required autocomplete="off"/>
                            <input type="hidden" name="ma_dich_vu_gd" class="ma_dich_vu_gd" value="<?php echo get_field('ma_dich_vu_gd'); ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td width="50%">Nơi đi (Hiển thị nếu chọn loại dịch vụ là VMB hoặc Xe)</td>
                    <td>Nơi đến</td>
                </tr>
                <tr>
                    <td width="50%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $noi_di_gd = $_POST['noi_di_gd'];
                            ?>
                            <select name="noi_di_gd" class="noi_di_gd" data-check="<?php echo $noi_di_gd; ?>" required autocomplete="off">
                                <?php
                                //List các địa điểm đi và đến
                                $query_khach_san = new WP_Query(array(
                                    'post_type' => 'dia_diem_local',
                                    'posts_per_page' => 64,
                                ));
                                if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                    ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            $noi_di_gd = $_POST['noi_di_gd'];
                            ?>
                            <select name="noi_di_gd" class="noi_di_gd" required autocomplete="off">
                                <?php
                                //List các địa điểm đi và đến
                                $query_khach_san = new WP_Query(array(
                                    'post_type' => 'dia_diem_local',
                                    'posts_per_page' => 64,
                                ));
                                if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                    ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="noi_di_gd" class="noi_di_gd" data-check="<?php echo get_field('noi_di_gd'); ?>" required autocomplete="off">
                                <?php
                                //List các địa điểm đi và đến
                                $query_khach_san = new WP_Query(array(
                                    'post_type' => 'dia_diem_local',
                                    'posts_per_page' => 64,
                                ));
                                if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                    ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $noi_den_gd = $_POST['noi_den_gd'];
                            ?>
                            <select name="noi_den_gd" class="noi_den_gd" data-check="<?php echo $noi_den_gd; ?>" required >
                                <?php
                                //List các địa điểm đi và đến
                                $query_khach_san = new WP_Query(array(
                                    'post_type' => 'dia_diem_local',
                                    'posts_per_page' => 64,
                                ));
                                if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                    ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            $noi_den_gd = $_POST['noi_den_gd'];
                            ?>
                            <select name="noi_den_gd" class="noi_den_gd" required >
                                <?php
                                //List các địa điểm đi và đến
                                $query_khach_san = new WP_Query(array(
                                    'post_type' => 'dia_diem_local',
                                    'posts_per_page' => 64,
                                ));
                                if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                    ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="noi_den_gd" class="noi_den_gd" data-check="<?php echo get_field('noi_den_gd'); ?>" required >
                                <?php
                                //List các địa điểm đi và đến
                                $query_khach_san = new WP_Query(array(
                                    'post_type' => 'dia_diem_local',
                                    'posts_per_page' => 64,
                                ));
                                if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                    ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }
                        ?>

                    </td>
                </tr>
                </tbody>
            </table>
        </td>
        <td align="center" style="background-color: #f19315b3;">
            MLK
            <?php
            if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                $ma_gd_con = $_POST['ma_gd_con'];
                ?>
                <input name="ma_gd_con" class="ma_gd_con" value="<?php echo $ma_gd_con; ?>" style="background: #FFF;" required autocomplete="off"/>
                <?php
            }elseif(is_page(213)){
                ?>
                <input name="ma_gd_con" class="ma_gd_con" value="MLK_ ..." style="background: #FFF;" required autocomplete="off"/>
                <?php
            }else{
                ?>
                <input name="ma_gd_con" class="ma_gd_con" value="<?php echo get_field('ma_gd_con'); ?>" style="background: #FFF;" required autocomplete="off" required/>
                <?php
            }
            ?>

            Mã giao dịch
            <?php
            if(isset($_POST['add_edit_giao_dich'])){
                $ma_gd_them_booking = $_POST['ma_gd_them_booking'];
                ?><input name="ma_gd_them_booking" class="ma_gd_them_booking" style="background: #FFF;" value="<?php echo $ma_gd_them_booking; ?>" required autocomplete="off"/><?php
            }elseif(isset($_POST['sub_tach_giao_dich'])){
                ?>
                <input name="ma_gd_them_booking" class="ma_gd_them_booking" style="background: #FFF;" value="<?php echo 'BTC_ ...'; ?>" required autocomplete="off"/>
                <?php
            }elseif(is_page(213)){
                ?>
                <input name="ma_gd_them_booking" class="ma_gd_them_booking" style="background: #FFF;" value="<?php echo 'BTC_ ...'; ?>" required autocomplete="off"/>
                <?php
            }else{
                ?>
                <input name="ma_gd_them_booking" class="ma_gd_them_booking" style="background: #FFF;" value="<?php echo get_field('ma_gd_them_booking'); ?>" required autocomplete="off"/>
                <?php
            }
            ?>

        </td>
        <td width="43%">
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td width="80%">Tên ĐT gửi book - Đối tác gửi book có thể trùng hoặc khác
                        với Đối tác cung cấp dịch vụ
                    </td>
                    <td>Mã ĐT</td>
                </tr>
                <tr>
                    <td width="80%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ten_dt_gui_book_dt = $_POST['ten_dt_gui_book_dt'];
                            ?>
                            <input type="text" name="ten_dt_gui_book_dt_val" class="ten_dt_gui_book_dt_val" value="<?php
                                if((int)$ten_dt_gui_book_dt){
                                    $query_name_hotel = new WP_Query(array(
                                        'post_type' => 'doi_tac',
                                        'p' => $ten_dt_gui_book_dt,
                                        'posts_per_page' => 1,
                                    ));

                                    if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                                        //echo get_the_title();
                                        echo get_field('ten_dt');
                                    endwhile;
                                    else :
                                        echo $ten_dt_gui_book_dt;
                                    endif;
                                    wp_reset_postdata();
                                }else{
                                    echo $ten_dt_gui_book_dt;
                                }
                            ?>" autocomplete="off"/>
                            <input type="hidden" name="ten_dt_gui_book_dt" class="ten_dt_gui_book_dt" value="<?php echo $ten_dt_gui_book_dt; ?>" autocomplete="off"/>
                            <div class="popup_get_data_list pop_ten_dt_gui_book_dt">
                                <ul>
                                    <li>Tên</li>
                                    <li>SĐT</li>
                                    <li>Email</li>
                                    <li>Nick Zalo</li>
                                    <li>Đơn vị công tác</li>
                                </ul>
                                <div class="list_show">
                                    <p>Không tìm thấy dữ liệu !</p>
                                </div>
                            </div>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ten_dt_gui_book_dt_val" class="ten_dt_gui_book_dt_val" value="<?php
                                if((int)get_field('ten_dt_gui_book_dt')){
                                    $query_name_hotel = new WP_Query(array(
                                        'post_type' => 'doi_tac',
                                        'p' => get_field('ten_dt_gui_book_dt'),
                                        'posts_per_page' => 1,
                                    ));

                                    if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                                        //echo get_the_title();
                                        echo get_field('ten_dt');
                                    endwhile;
                                    else :
                                        echo get_field('ten_dt_gui_book_dt');
                                    endif;
                                    wp_reset_postdata();
                                }else{
                                    echo get_field('ten_dt_gui_book_dt');
                                }
                            ?>" autocomplete="off"/>
                            <input type="hidden" name="ten_dt_gui_book_dt" class="ten_dt_gui_book_dt" value="<?php echo get_field('ten_dt_gui_book_dt'); ?>" autocomplete="off"/>
                            <div class="popup_get_data_list pop_ten_dt_gui_book_dt">
                                <ul>
                                    <li>Tên</li>
                                    <li>SĐT</li>
                                    <li>Email</li>
                                    <li>Nick Zalo</li>
                                    <li>Đơn vị công tác</li>
                                </ul>
                                <div class="list_show">
                                    <p>Không tìm thấy dữ liệu !</p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ma_dt = $_POST['ma_dt'];
                            ?>
                            <input type="text" name="ma_dt_val" class="ma_dt_val" value="<?php
                                if((int)$ma_dt){
                                    $query_name_hotel = new WP_Query(array(
                                        'post_type' => 'doi_tac',
                                        'p' => $ma_dt,
                                        'posts_per_page' => 1,
                                    ));

                                    if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                                        //echo get_the_title();
                                        echo get_field('sdt_dt');
                                    endwhile;
                                    else :
                                        echo $ma_dt;
                                    endif;
                                    wp_reset_postdata();
                                }else{
                                    echo $ma_dt;
                                }
                            ?>" autocomplete="off"/>
                            <input type="hidden" name="ma_dt" class="ma_dt" value="<?php echo $ma_dt; ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ma_dt_val" class="ma_dt_val" value="<?php
                                if((int)get_field('ma_dt')){
                                    $query_name_hotel = new WP_Query(array(
                                        'post_type' => 'doi_tac',
                                        'p' => get_field('ma_dt'),
                                        'posts_per_page' => 1,
                                    ));

                                    if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                                        //echo get_the_title();
                                        echo get_field('sdt_dt');
                                    endwhile;
                                    else :
                                        echo get_field('ma_dt');
                                    endif;
                                    wp_reset_postdata();
                                }else{
                                    echo get_field('ma_dt');
                                }
                            ?>" autocomplete="off"/>
                            <input type="hidden" name="ma_dt" class="ma_dt" value="<?php echo get_field('ma_dt'); ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>

                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td width="40%">Khách đại diện</td>
                    <td width="20%">SĐT</td>
                    <td>Trạng thái BKK với KH</td>
                </tr>
                <tr>
                    <td width="40%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $khach_dai_dien_gd = $_POST['khach_dai_dien_gd'];
                            ?>
                            <input type="text" name="khach_dai_dien_gd_val" class="khach_dai_dien_gd_val" value="<?php
                                $args = array(
                                    'p'         => $khach_dai_dien_gd, // ID of a page, post, or custom type
                                    'post_type' => 'khach_hang'
                                );
                                $query_kh = new WP_Query($args);
                                if($query_kh->have_posts()) :
                                while ($query_kh->have_posts()) : $query_kh->the_post();
                                    if (!empty(get_field('ten_kgd'))){
                                        echo get_field('ten_kgd');
                                    }else{
                                        echo $khach_dai_dien_gd;
                                    }
                                endwhile;
                                else :
                                    echo $khach_dai_dien_gd;
                                endif;
                                wp_reset_postdata();
                            ?>" required autocomplete="off"/>
                            <input type="hidden" name="khach_dai_dien_gd" class="khach_dai_dien_gd" value="<?php echo $khach_dai_dien_gd; ?>" required autocomplete="off"/>
                            <div class="popup_get_data_list pop_ten">
                                <ul>
                                    <li>Tên</li>
                                    <li>SĐT</li>
                                    <li>Email</li>
                                    <li>Nick Zalo</li>
                                    <li>FB</li>
                                </ul>
                                <div class="list_show">
                                    <p>Không tìm thấy dữ liệu !</p>
                                </div>
                            </div>
                            <?php
                        }elseif(is_page(213)){
                            ?>
                            <input type="text" name="khach_dai_dien_gd_val" class="khach_dai_dien_gd_val" value="" required autocomplete="off"/>
                            <input type="hidden" name="khach_dai_dien_gd" class="khach_dai_dien_gd" value="" required autocomplete="off"/>
                            <div class="popup_get_data_list pop_ten">
                                <ul>
                                    <li>Tên</li>
                                    <li>SĐT</li>
                                    <li>Email</li>
                                    <li>Nick Zalo</li>
                                    <li>FB</li>
                                </ul>
                                <div class="list_show">
                                    <p>Không tìm thấy dữ liệu !</p>
                                </div>
                            </div>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="khach_dai_dien_gd_val" class="khach_dai_dien_gd_val" value="<?php
                                if((int)get_field('khach_dai_dien_gd')){
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
                                }else{
                                    echo get_field('khach_dai_dien_gd');
                                }
                                wp_reset_postdata();
                            ?>" required autocomplete="off"/>
                            <input type="hidden" name="khach_dai_dien_gd" class="khach_dai_dien_gd" value="<?php echo get_field('khach_dai_dien_gd'); ?>" required autocomplete="off"/>
                            <div class="popup_get_data_list pop_ten">
                                <ul>
                                    <li>Tên</li>
                                    <li>SĐT</li>
                                    <li>Email</li>
                                    <li>Nick Zalo</li>
                                    <li>FB</li>
                                </ul>
                                <div class="list_show">
                                    <p>Không tìm thấy dữ liệu !</p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="20%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $sdt_gd = $_POST['sdt_gd'];
                            ?>
                            <input type="number" name="sdt_gd_val" class="sdt_gd_val" value="<?php
                                $args = array(
                                    'p'         => $sdt_gd, // ID of a page, post, or custom type
                                    'post_type' => 'khach_hang'
                                );
                                $query_kh = new WP_Query($args);
                                if($query_kh->have_posts()) :
                                while ($query_kh->have_posts()) : $query_kh->the_post();
                                    if (!empty(get_field('sdt_kgd'))){
                                        echo get_field('sdt_kgd');
                                    }else{
                                        echo $sdt_gd;
                                    }
                                endwhile;
                                else :
                                    echo $sdt_gd;
                                endif;
                                wp_reset_postdata();
                            ?>" autocomplete="off"/>
                            <input type="hidden" name="sdt_gd" class="sdt_gd" value="<?php echo get_field('sdt_gd'); ?>" autocomplete="off"/>
                            <div class="popup_get_data_list pop_sdt">
                                <ul>
                                    <li>Tên</li>
                                    <li>SĐT</li>
                                    <li>Email</li>
                                    <li>Nick Zalo</li>
                                    <li>FB</li>
                                </ul>
                                <div class="list_show">
                                    <p>Không tìm thấy dữ liệu !</p>
                                </div>
                            </div>
                            <?php
                        }elseif(is_page(213)){
                            ?>
                            <input type="number" name="sdt_gd_val" class="sdt_gd_val" value="" autocomplete="off"/>
                            <input type="hidden" name="sdt_gd" class="sdt_gd" value="" autocomplete="off"/>
                            <div class="popup_get_data_list pop_sdt">
                                <ul>
                                    <li>Tên</li>
                                    <li>SĐT</li>
                                    <li>Email</li>
                                    <li>Nick Zalo</li>
                                    <li>FB</li>
                                </ul>
                                <div class="list_show">
                                    <p>Không tìm thấy dữ liệu !</p>
                                </div>
                            </div>
                            <?php
                        }else{
                            ?>
                            <input type="number" name="sdt_gd_val" class="sdt_gd_val" value="<?php
                                $args = array(
                                    'p'         => get_field('sdt_gd'), // ID of a page, post, or custom type
                                    'post_type' => 'khach_hang'
                                );
                                $query_kh = new WP_Query($args);
                                if($query_kh->have_posts()) :
                                while ($query_kh->have_posts()) : $query_kh->the_post();
                                    if (!empty(get_field('sdt_kgd'))){
                                        echo get_field('sdt_kgd');
                                    }else{
                                        echo get_field('sdt_gd');
                                    }
                                endwhile;
                                else :
                                    echo get_field('sdt_gd');
                                endif;
                                wp_reset_postdata();
                            ?>" autocomplete="off"/>
                            <input type="hidden" name="sdt_gd" class="sdt_gd" value="<?php echo get_field('sdt_gd'); ?>" autocomplete="off"/>
                            <div class="popup_get_data_list pop_sdt">
                                <ul>
                                    <li>Tên</li>
                                    <li>SĐT</li>
                                    <li>Email</li>
                                    <li>Nick Zalo</li>
                                    <li>FB</li>
                                </ul>
                                <div class="list_show">
                                    <p>Không tìm thấy dữ liệu !</p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $trang_thai_bkk_voi_kh_gd = $_POST['trang_thai_bkk_voi_kh_gd'];
                            ?>
                            <select name="trang_thai_bkk_voi_kh_gd" class="trang_thai_bkk_voi_kh_gd" data-check="<?php echo $trang_thai_bkk_voi_kh_gd; ?>" required>
                                <option value="BKK - Tiềm năng" selected>BKK - Tiềm năng</option>
                                <option value="BKK - Chuẩn bị cọc">BKK - Chuẩn bị cọc</option>
                                <option value="BKK - Đã cọc">BKK - Đã cọc</option>
                                <option value="BKK - Đã trả XN">BKK - Đã trả XN</option>
                                <option value="Thay đổi - lần 1">Thay đổi - lần 1</option>
                                <option value="Thay đổi - lần 2">Thay đổi - lần 2</option>
                                <option value="Thay đổi - lần 3">Thay đổi - lần 3</option>
                                <option value="Thay đổi - Đã trả XN">Thay đổi - Đã trả XN</option>
                                <option value="VC - Chưa gửi, VC - Đã gửi KH">VC - Chưa gửi, VC - Đã gửi KH</option>
                                <option value="VC - Đã gửi KS">VC - Đã gửi KS</option>
                                <option value="VC - KH đã nhận">VC - KH đã nhận</option>
                                <option value="VC - KS đã nhận">VC - KS đã nhận</option>
                                <option value="TL">TL</option>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            $trang_thai_bkk_voi_kh_gd = $_POST['trang_thai_bkk_voi_kh_gd'];
                            ?>
                            <select name="trang_thai_bkk_voi_kh_gd" class="trang_thai_bkk_voi_kh_gd" required>
                                <option value="BKK - Tiềm năng" selected>BKK - Tiềm năng</option>
                                <option value="BKK - Chuẩn bị cọc">BKK - Chuẩn bị cọc</option>
                                <option value="BKK - Đã cọc">BKK - Đã cọc</option>
                                <option value="BKK - Đã trả XN">BKK - Đã trả XN</option>
                                <option value="Thay đổi - lần 1">Thay đổi - lần 1</option>
                                <option value="Thay đổi - lần 2">Thay đổi - lần 2</option>
                                <option value="Thay đổi - lần 3">Thay đổi - lần 3</option>
                                <option value="Thay đổi - Đã trả XN">Thay đổi - Đã trả XN</option>
                                <option value="VC - Chưa gửi, VC - Đã gửi KH">VC - Chưa gửi, VC - Đã gửi KH</option>
                                <option value="VC - Đã gửi KS">VC - Đã gửi KS</option>
                                <option value="VC - KH đã nhận">VC - KH đã nhận</option>
                                <option value="VC - KS đã nhận">VC - KS đã nhận</option>
                                <option value="TL">TL</option>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="trang_thai_bkk_voi_kh_gd" class="trang_thai_bkk_voi_kh_gd" data-check="<?php echo get_field('trang_thai_bkk_voi_kh_gd'); ?>" required>
                                <option value="BKK - Tiềm năng" selected>BKK - Tiềm năng</option>
                                <option value="BKK - Chuẩn bị cọc">BKK - Chuẩn bị cọc</option>
                                <option value="BKK - Đã cọc">BKK - Đã cọc</option>
                                <option value="BKK - Đã trả XN">BKK - Đã trả XN</option>
                                <option value="Thay đổi - lần 1">Thay đổi - lần 1</option>
                                <option value="Thay đổi - lần 2">Thay đổi - lần 2</option>
                                <option value="Thay đổi - lần 3">Thay đổi - lần 3</option>
                                <option value="Thay đổi - Đã trả XN">Thay đổi - Đã trả XN</option>
                                <option value="VC - Chưa gửi, VC - Đã gửi KH">VC - Chưa gửi, VC - Đã gửi KH</option>
                                <option value="VC - Đã gửi KS">VC - Đã gửi KS</option>
                                <option value="VC - KH đã nhận">VC - KH đã nhận</option>
                                <option value="VC - KS đã nhận">VC - KS đã nhận</option>
                                <option value="TL">TL</option>
                            </select>
                            <?php
                        }
                        ?>

                    </td>
                </tr>
                </tbody>
            </table>
        </td>
        <td align="center" style="background-color: #f19315b3;">
            <strong>Mã Booking</strong>
            <?php
            if(isset($_POST['add_edit_giao_dich'])){
                $ma_gd = $_POST['ma_gd'];
                ?>
                <input type="text" name="ma_gd" class="ma_gd" style="background: #FFF;" value="MBK_ ..." required autocomplete="off"/>
                <?php
            }elseif(isset($_POST['sub_tach_giao_dich'])){
                ?>
                <input type="text" name="ma_gd" class="ma_gd" style="background: #FFF;" value="<?php echo 'MBK_ ...'; ?>" required autocomplete="off"/>
                <?php
            }elseif(is_page(213)){
                ?>
                <input type="text" name="ma_gd" class="ma_gd" style="background: #FFF;" value="<?php echo 'MBK_ ...'; ?>" required autocomplete="off"/>
                <?php
            }else{
                ?>
                <input type="text" name="ma_gd" class="ma_gd" style="background: #FFF;" value="<?php echo get_field('ma_gd'); ?>" required autocomplete="off"/>
                <?php
            }
            ?>

        </td>
        <td>
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td width="40%">Trạng thái BKK với ĐT</td>
                    <td width="20%">Nick</td>
                    <td>Tên NV đặt phòng</td>
                    <td>SĐT BPĐP</td>
                </tr>
                <tr>
                    <td width="40%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $trang_thai_bkk_voi_dt = $_POST['trang_thai_bkk_voi_dt'];
                            ?>
                            <select name="trang_thai_bkk_voi_dt" class="trang_thai_bkk_voi_dt" data-check="<?php echo $trang_thai_bkk_voi_dt; ?>" required>
                                <option value="BKK - Yêu cầu gửi" selected>BKK - Yêu cầu gửi</option>
                                <option value="BKK - Đang gửi">BKK - Đang gửi</option>
                                <option value="BKK - Đang chờ XN">BKK - Đang chờ XN</option>
                                <option value="BKK - Đã có XN">BKK - Đã có XN</option>
                                <option value="Thay đổi - Đang gửi">Thay đổi - Đang gửi</option>
                                <option value="Thay đổi - Đang chờ XN">Thay đổi - Đang chờ XN</option>
                                <option value="Thay đổi - Đã có XN">Thay đổi - Đã có XN</option>
                                <option value="Hủy - Yêu cầu gửi">Hủy - Yêu cầu gửi</option>
                                <option value="Hủy - Đang gửi">Hủy - Đang gửi</option>
                                <option value="Hủy - Đang chờ XN hủy">Hủy - Đang chờ XN hủy</option>
                                <option value="Hủy - Đã có XN hủy">Hủy - Đã có XN hủy</option>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            ?>
                            <select name="trang_thai_bkk_voi_dt" class="trang_thai_bkk_voi_dt" required>
                                <option value="BKK - Yêu cầu gửi" selected>BKK - Yêu cầu gửi</option>
                                <option value="BKK - Đang gửi">BKK - Đang gửi</option>
                                <option value="BKK - Đang chờ XN">BKK - Đang chờ XN</option>
                                <option value="BKK - Đã có XN">BKK - Đã có XN</option>
                                <option value="Thay đổi - Đang gửi">Thay đổi - Đang gửi</option>
                                <option value="Thay đổi - Đang chờ XN">Thay đổi - Đang chờ XN</option>
                                <option value="Thay đổi - Đã có XN">Thay đổi - Đã có XN</option>
                                <option value="Hủy - Yêu cầu gửi">Hủy - Yêu cầu gửi</option>
                                <option value="Hủy - Đang gửi">Hủy - Đang gửi</option>
                                <option value="Hủy - Đang chờ XN hủy">Hủy - Đang chờ XN hủy</option>
                                <option value="Hủy - Đã có XN hủy">Hủy - Đã có XN hủy</option>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="trang_thai_bkk_voi_dt" class="trang_thai_bkk_voi_dt" data-check="<?php echo get_field('trang_thai_bkk_voi_dt'); ?>" required>
                                <option value="BKK - Yêu cầu gửi" selected>BKK - Yêu cầu gửi</option>
                                <option value="BKK - Đang gửi">BKK - Đang gửi</option>
                                <option value="BKK - Đang chờ XN">BKK - Đang chờ XN</option>
                                <option value="BKK - Đã có XN">BKK - Đã có XN</option>
                                <option value="Thay đổi - Đang gửi">Thay đổi - Đang gửi</option>
                                <option value="Thay đổi - Đang chờ XN">Thay đổi - Đang chờ XN</option>
                                <option value="Thay đổi - Đã có XN">Thay đổi - Đã có XN</option>
                                <option value="Hủy - Yêu cầu gửi">Hủy - Yêu cầu gửi</option>
                                <option value="Hủy - Đang gửi">Hủy - Đang gửi</option>
                                <option value="Hủy - Đang chờ XN hủy">Hủy - Đang chờ XN hủy</option>
                                <option value="Hủy - Đã có XN hủy">Hủy - Đã có XN hủy</option>
                            </select>
                            <?php
                        }
                        ?>

                    </td>
                    <td width="20%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $nick_dt = $_POST['nick_dt'];
                            ?>
                            <input type="text" name="nick_dt" class="nick_dt" value="<?php echo $nick_dt; ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="nick_dt" class="nick_dt" value="<?php echo get_field('nick_dt'); ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ten_nv_dat_phong_dt = $_POST['ten_nv_dat_phong_dt'];
                            ?>
                            <input type="text" name="ten_nv_dat_phong_dt" class="ten_nv_dat_phong_dt" value="<?php echo $ten_nv_dat_phong_dt; ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ten_nv_dat_phong_dt" class="ten_nv_dat_phong_dt" value="<?php echo get_field('ten_nv_dat_phong_dt'); ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $sdt_bpdp = $_POST['sdt_bpdp'];
                            ?>
                            <input type="text" name="sdt_bpdp" class="sdt_bpdp" value="<?php echo $sdt_bpdp; ?>"  autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="sdt_bpdp" class="sdt_bpdp" value="<?php echo get_field('sdt_bpdp'); ?>"  autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td width="35%">Check-in</td>
                    <td width="10%">Số đêm</td>
                    <td width="35%">Check-out</td>
                    <td width="15%"></td>
                </tr>
                <tr>
                    <td width="35%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ci_gd = $_POST['ci_gd'];
                            ?>
                            <input type="text" name="ci_gd" data-date-format="dd/mm/yyyy" class="ci_gd datepicker-here" data-language='en' value="<?php echo $ci_gd; ?>" required autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ci_gd" data-date-format="dd/mm/yyyy" class="ci_gd datepicker-here" data-language='en' value="<?php echo get_field('ci_gd'); ?>" required autocomplete="off"/>
                            <?php
                        }
                        ?>

                    </td>
                    <td width="10%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $so_dem_gd = $_POST['so_dem_gd'];
                            ?>
                            <input type="number" name="so_dem_gd" class="so_dem_gd" value="<?php echo $so_dem_gd; ?>" required autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="number" name="so_dem_gd" class="so_dem_gd" value="<?php echo get_field('so_dem_gd'); ?>" required autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="35%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $co_gd = $_POST['co_gd'];
                            ?>
                            <input type="text" name="co_gd" data-date-format="dd/mm/yyyy" class="co_gd datepicker-here" data-language='en' value="<?php echo $co_gd; ?>" required autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="co_gd" data-date-format="dd/mm/yyyy" class="co_gd datepicker-here" data-language='en' value="<?php echo get_field('co_gd'); ?>" required autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="15%" style="text-align: center;">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $con_ngay_gd = $_POST['con_ngay_gd'];
                            ?>
                            Còn <span class="con_ngay_gd_label">?</span> ngày<input type="hidden" name="con_ngay_gd" class="con_ngay_gd" value="<?php echo $con_ngay_gd; ?>" required autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            Còn <span class="con_ngay_gd_label">?</span> ngày<input type="hidden" name="con_ngay_gd" class="con_ngay_gd" value="<?php echo get_field('con_ngay_gd'); ?>" required autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                </tr>

                </tbody>
            </table>
        </td>
        <td align="center" style="background-color: #f19315b3;">
            Hình thức book
            <?php
            if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                $hinh_thuc_book_gd = $_POST['hinh_thuc_book_gd'];
                ?>
                <select name="hinh_thuc_book_gd" class="hinh_thuc_book_gd" data-check="<?php echo $hinh_thuc_book_gd; ?>">
                    <option value="CODE">CODE</option>
                    <option value="VC">VC</option>
                    <option value="HĐ" selected>HĐ</option>
                    <option value="BK">BK</option>
                    <option value="AG">AG</option>
                    <option value="SERIES">SERIES</option>
                    <option value="HARDLOCK">HARDLOCK</option>
                </select>
                <?php
            }elseif(is_page(213) || is_page()){
                ?>
                <select name="hinh_thuc_book_gd" class="hinh_thuc_book_gd">
                    <option value="CODE">CODE</option>
                    <option value="VC">VC</option>
                    <option value="HĐ" selected>HĐ</option>
                    <option value="BK">BK</option>
                    <option value="AG">AG</option>
                    <option value="SERIES">SERIES</option>
                    <option value="HARDLOCK">HARDLOCK</option>
                </select>
                <?php
            }else{
                ?>
                <select name="hinh_thuc_book_gd" class="hinh_thuc_book_gd" data-check="<?php echo get_field('hinh_thuc_book_gd'); ?>">
                    <option value="CODE">CODE</option>
                    <option value="VC">VC</option>
                    <option value="HĐ" selected>HĐ</option>
                    <option value="BK">BK</option>
                    <option value="AG">AG</option>
                    <option value="SERIES">SERIES</option>
                    <option value="HARDLOCK">HARDLOCK</option>
                </select>
                <?php
            }
            ?>
        </td>
        <td>
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td width="40%">Ngày được hủy (hoàn tiền 100%)</td>
                    <td width="10%">Còn ? ngày</td>
                    <td width="40%">Ngày được thay đổi</td>
                    <td>Còn ? ngày</td>
                </tr>
                <tr>
                    <td width="40%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ngay_duoc_huy = $_POST['ngay_duoc_huy'];
                            ?>
                            <input type="text" name="ngay_duoc_huy" data-date-format="dd/mm/yyyy" class="ngay_duoc_huy datepicker-here" data-language='en' value="<?php echo $ngay_duoc_huy; ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ngay_duoc_huy" data-date-format="dd/mm/yyyy" class="ngay_duoc_huy datepicker-here" data-language='en' value="<?php echo get_field('ngay_duoc_huy'); ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="10%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $con_ngay_dt = $_POST['con_ngay_dt'];
                            ?>
                            <input type="number" name="con_ngay_dt" class="con_ngay_dt" value="<?php echo $con_ngay_dt; ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="number" name="con_ngay_dt" class="con_ngay_dt" value="<?php echo get_field('con_ngay_dt'); ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="40%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $con_ngay_dt = $_POST['ngay_duoc_thay_doi'];
                            ?>
                            <input type="text" name="ngay_duoc_thay_doi" data-date-format="dd/mm/yyyy" class="ngay_duoc_thay_doi datepicker-here" data-language='en' value="<?php echo $con_ngay_dt; ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ngay_duoc_thay_doi" data-date-format="dd/mm/yyyy" class="ngay_duoc_thay_doi datepicker-here" data-language='en' value="<?php echo get_field('ngay_duoc_thay_doi'); ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $con_ngay_thay_doi_dt = $_POST['con_ngay_thay_doi_dt'];
                            ?>
                            <input type="number" name="con_ngay_thay_doi_dt" class="con_ngay_thay_doi_dt" value="<?php echo $con_ngay_thay_doi_dt; ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="number" name="con_ngay_thay_doi_dt" class="con_ngay_thay_doi_dt" value="<?php echo get_field('con_ngay_thay_doi_dt'); ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>

                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td width="32%">Loại phòng bán</td>
                    <td width="6%">SL</td>
                    <td width="17%">Đơn giá bán</td>
                    <td width="25%">Đơn vị</td>
                    <td width="20%">Tổng</td>
                </tr>
                <tr>
                    <td width="32%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich'])){
                            $loai_phong_ban_gd = $_POST['loai_phong_ban_gd'];
                            $ten_khach_san_gd = $_POST['ten_khach_san_gd'];
                            ?>
                            <select name="loai_phong_ban_gd" class="loai_phong_ban_gd" data-check="<?php echo $loai_phong_ban_gd; ?>">
                                <?php
                                $query_room = new WP_Query(array(
                                    'post_type' => 'room',
                                    'posts_per_page' => 10,
                                    'meta_key'		=> 'id_khach_san',
                                    'meta_value'	=> $ten_khach_san_gd,
                                    'order' => 'DESC'
                                ));

                                if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
                                    ?>
                                    <option value="<?php echo get_field('ten_phong'); ?>" data-price1="<?php echo get_field('gia_tien_kh'); ?>" data-price2="<?php echo get_field('gia_tien_dt'); ?>"><?php echo get_field('ten_phong'); ?></option>
                                <?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            $loai_phong_ban_gd = $_POST['loai_phong_ban_gd'];
                            $ten_khach_san_gd = $_POST['ten_khach_san_gd'];
                            ?>
                            <select name="loai_phong_ban_gd" class="loai_phong_ban_gd">
                                <?php
                                $query_room = new WP_Query(array(
                                    'post_type' => 'room',
                                    'posts_per_page' => 10,
                                    'meta_key'		=> 'id_khach_san',
                                    'meta_value'	=> $ten_khach_san_gd,
                                    'order' => 'DESC'
                                ));

                                if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
                                    ?>
                                    <option value="<?php echo get_field('ten_phong'); ?>" data-price1="<?php echo get_field('gia_tien_kh'); ?>" data-price2="<?php echo get_field('gia_tien_dt'); ?>"><?php echo get_field('ten_phong'); ?></option>
                                <?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="loai_phong_ban_gd" class="loai_phong_ban_gd" data-check="<?php echo get_field('loai_phong_ban_gd'); ?>">
                                <?php
                                $query_room2 = new WP_Query(array(
                                    'post_type' => 'room',
                                    'posts_per_page' => 10,
                                    'meta_key'		=> 'id_khach_san',
                                    'meta_value'	=> $ten_khach_san_gd,
                                    'order' => 'DESC'
                                ));
                                if($query_room2->have_posts()) : while ($query_room2->have_posts()) : $query_room2->the_post();
                                    ?>
                                    <option value="<?php echo get_field('ten_phong'); ?>" data-price1="<?php echo get_field('gia_tien_kh'); ?>" data-price2="<?php echo get_field('gia_tien_dt'); ?>"><?php echo get_field('ten_phong'); ?></option>
                                <?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="6%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $sl_gd = $_POST['sl_gd'];
                            ?>
                            <input type="text" name="sl_gd" class="sl_gd" value="<?php echo $sl_gd; ?>" required autocomplete="off"/>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            $sl_gd = $_POST['sl_gd'];
                            ?>
                            <input type="text" name="sl_gd" class="sl_gd" value="1" required autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="sl_gd" class="sl_gd" value="<?php echo get_field('sl_gd'); ?>" required autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="17%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $don_gia_ban_gd = $_POST['don_gia_ban_gd'];
                            $ten_khach_san_gd = $_POST['ten_khach_san_gd'];
                            $loai_phong_ban_gd = $_POST['loai_phong_ban_gd'];
                            ?>
                            <input type="text" name="don_gia_ban_gd" class="don_gia_ban_gd" value="<?php
                            if(empty($don_gia_ban_gd)){
                                $query_room = new WP_Query(array(
                                    'post_type' => 'room',
                                    'posts_per_page' => 1,
                                    'meta_query'	=> array(
                                        'relation'		=> 'AND',
                                        array(
                                            'key'	 	=> 'id_khach_san',
                                            'value'	  	=> $ten_khach_san_gd,
                                            'compare' 	=> '=',
                                        ),
                                        array(
                                            'key'	  	=> 'ten_phong',
                                            'value'	  	=> $loai_phong_ban_gd,
                                            'compare' 	=> '=',
                                        ),
                                    ),
                                    'order' => 'DESC'
                                ));

                                if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
                                    echo get_field('gia_tien_kh');
                                endwhile;
                                endif;
                                wp_reset_postdata();
                            }else{
                                echo $don_gia_ban_gd;
                            }
                            ?>"  autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="don_gia_ban_gd" class="don_gia_ban_gd" value="<?php
                            if(empty($don_gia_ban_gd)){
                                $query_room = new WP_Query(array(
                                    'post_type' => 'room',
                                    'posts_per_page' => 1,
                                    'meta_query'	=> array(
                                        'relation'		=> 'AND',
                                        array(
                                            'key'	 	=> 'id_khach_san',
                                            'value'	  	=> get_field('ten_khach_san_gd'),
                                            'compare' 	=> '=',
                                        ),
                                        array(
                                            'key'	  	=> 'ten_phong',
                                            'value'	  	=> get_field('loai_phong_ban_gd'),
                                            'compare' 	=> '=',
                                        ),
                                    ),
                                    'order' => 'DESC'
                                ));

                                if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
                                    echo get_field('gia_tien_kh');
                                endwhile;
                                endif;
                                wp_reset_postdata();
                            }else{
                                echo $don_gia_ban_gd;
                            }
                            ?>"  autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="25%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $don_vi_gd = $_POST['don_vi_gd'];
                            ?>
                            <select name="don_vi_gd" class="don_vi_gd" data-check="<?php echo $don_vi_gd; ?>" required >
                                <option value="" selected disabled hidden>Chọn đơn vị</option>
                                <option value="vnđ/phòng/đêm">vnđ/phòng/đêm</option>
                                <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            $don_vi_gd = $_POST['don_vi_gd'];
                            ?>
                            <select name="don_vi_gd" class="don_vi_gd" required >
                                <option value="vnđ/phòng/đêm" selected>vnđ/phòng/đêm</option>
                                <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="don_vi_gd" class="don_vi_gd" data-check="<?php echo get_field('don_vi_gd'); ?>" required >
                                <option value="" selected disabled hidden>Chọn đơn vị</option>
                                <option value="vnđ/phòng/đêm">vnđ/phòng/đêm</option>
                                <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                            </select>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="20%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $tong_gd = $_POST['tong_gd'];
                            ?>
                            <input type="text" name="tong_gd" class="tong_gd" value="<?php echo $tong_gd; ?>" required autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="tong_gd" class="tong_gd" value="<?php echo get_field('tien_chua_pt_khac'); ?>" required autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" align="center">Ngày lock phòng</td>
                    <td colspan="3" align="center">Gói DV - KM bán</td>
                    <td colspan="1" align="center">Mã KM</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ngay_lock_phong_khach = $_POST['ngay_lock_phong_khach'];
                            ?>
                            <input type="text" data-date-format="dd/mm/yyyy" name="ngay_lock_phong_khach" class="ngay_lock_phong_khach datepicker-here" data-language='en' value="<?php echo $ngay_lock_phong_khach; ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" data-date-format="dd/mm/yyyy" name="ngay_lock_phong_khach" class="ngay_lock_phong_khach datepicker-here" data-language='en' value="<?php echo get_field('ngay_lock_phong_khach'); ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td colspan="3" align="center">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $goi_dv_km_ban_gd = $_POST['goi_dv_km_ban_gd'];
                            ?>
                            <select name="goi_dv_km_ban_gd" class="goi_dv_km_ban_gd" data-check="<?php echo $goi_dv_km_ban_gd; ?>" required>
                                <option value="" selected disabled hidden>Chọn gói DV - KM</option>
                                <option value="BB - Ăn sáng">BB - Ăn sáng</option>
                                <option value="FB - Ăn 3 bữa">FB - Ăn 3 bữa</option>
                                <option value="FBV - Ăn 3 bữa + Vui chơi">FBV - Ăn 3 bữa + Vui chơi</option>
                                <option value="FBVS - Ăn 3 bữa + Vui chơi + Safari">FBVS - Ăn 3 bữa + Vui chơi + Safari</option>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            $goi_dv_km_ban_gd = $_POST['goi_dv_km_ban_gd'];
                            ?>
                            <select name="goi_dv_km_ban_gd" class="goi_dv_km_ban_gd" required>
                                <option value="BB - Ăn sáng" selected>BB - Ăn sáng</option>
                                <option value="FB - Ăn 3 bữa">FB - Ăn 3 bữa</option>
                                <option value="FBV - Ăn 3 bữa + Vui chơi">FBV - Ăn 3 bữa + Vui chơi</option>
                                <option value="FBVS - Ăn 3 bữa + Vui chơi + Safari">FBVS - Ăn 3 bữa + Vui chơi + Safari</option>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="goi_dv_km_ban_gd" class="goi_dv_km_ban_gd" data-check="<?php echo get_field('goi_dv_km_ban_gd'); ?>" required>
                                <option value="" selected disabled hidden>Chọn gói DV - KM</option>
                                <option value="BB - Ăn sáng">BB - Ăn sáng</option>
                                <option value="FB - Ăn 3 bữa">FB - Ăn 3 bữa</option>
                                <option value="FBV - Ăn 3 bữa + Vui chơi">FBV - Ăn 3 bữa + Vui chơi</option>
                                <option value="FBVS - Ăn 3 bữa + Vui chơi + Safari">FBVS - Ăn 3 bữa + Vui chơi + Safari</option>
                            </select>
                            <?php
                        }
                        ?>
                    </td>
                    <td colspan="1" align="center">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ma_pro_gd = $_POST['ma_pro_gd'];
                            ?>
                            <input type="text" name="ma_pro_gd" class="ma_pro_gd" value="<?php echo $ma_pro_gd; ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ma_pro_gd" class="ma_pro_gd" value="<?php echo get_field('ma_pro_gd'); ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" align="center">Dịch vụ đi kèm</td>
                </tr>
                <tr>
                    <td colspan="5" align="center">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $dich_vu_di_kem_gd = $_POST['dich_vu_di_kem_gd'];
                            ?>
                            <textarea name="dich_vu_di_kem_gd" class="dich_vu_di_kem_gd"><?php echo $dich_vu_di_kem_gd; ?></textarea>
                            <?php
                        }else{
                            ?>
                            <textarea name="dich_vu_di_kem_gd" class="dich_vu_di_kem_gd"><?php echo get_field('dich_vu_di_kem_gd'); ?></textarea>
                            <?php
                        }
                        ?>
                    </td>
                </tr>

                </tbody>
            </table>
        </td>
        <td align="center" style="background-color: #f19315b3;">
            Mã xác nhận
            <?php
            if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                $ma_xac_nhan = $_POST['ma_xac_nhan'];
                ?>
                <input type="text" name="ma_xac_nhan" class="ma_xac_nhan" style="background: #FFF;" value="<?php echo $ma_xac_nhan; ?>" autocomplete="off"/>
                <?php
            }else{
                ?>
                <input type="text" name="ma_xac_nhan" class="ma_xac_nhan" style="background: #FFF;" value="<?php echo get_field('ma_xac_nhan'); ?>" autocomplete="off"/>
                <?php
            }
            ?>
            <p></p>
            Lý giải PT
            <?php
            if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                $ly_giai_pt = $_POST['ly_giai_pt'];
                ?>
                <textarea name="ly_giai_pt" class="ly_giai_pt" style="background: #FFF;"><?php echo $ly_giai_pt; ?></textarea>
                <?php
            }else{
                ?>
                <textarea name="ly_giai_pt" class="ly_giai_pt" style="background: #FFF;"><?php echo get_field('ly_giai_pt'); ?></textarea>
                <?php
            }
            ?>
        </td>
        <td>
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td width="32%">Loại phòng mua</td>
                    <td width="6%">SL</td>
                    <td width="17%">Đơn giá mua</td>
                    <td width="25%">Đơn vị</td>
                    <td width="20%">Tổng</td>
                </tr>
                <tr>
                    <td width="32%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $loai_phong_ban_dt = $_POST['loai_phong_ban_dt'];
                            $ten_khach_san_gd = $_POST['ten_khach_san_gd'];
                            ?>
                            <select name="loai_phong_ban_dt" class="loai_phong_ban_dt" data-check="<?php echo $loai_phong_ban_dt; ?>">
                                <?php
                                $query_room = new WP_Query(array(
                                    'post_type' => 'room',
                                    'posts_per_page' => 10,
                                    'meta_key'		=> 'id_khach_san',
                                    'meta_value'	=> $ten_khach_san_gd,
                                    'order' => 'DESC'
                                ));

                                if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
                                    ?>
                                    <option value="<?php echo get_field('ten_phong'); ?>" data-price1="<?php echo get_field('gia_tien_kh'); ?>" data-price2="<?php echo get_field('gia_tien_dt'); ?>"><?php echo get_field('ten_phong'); ?></option>
                                <?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            $loai_phong_ban_dt = $_POST['loai_phong_ban_dt'];
                            $ten_khach_san_gd = $_POST['ten_khach_san_gd'];
                            ?>
                            <select name="loai_phong_ban_dt" class="loai_phong_ban_dt">
                                <?php
                                $query_room = new WP_Query(array(
                                    'post_type' => 'room',
                                    'posts_per_page' => 10,
                                    'meta_key'		=> 'id_khach_san',
                                    'meta_value'	=> $ten_khach_san_gd,
                                    'order' => 'DESC'
                                ));

                                if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
                                    ?>
                                    <option value="<?php echo get_field('ten_phong'); ?>" data-price1="<?php echo get_field('gia_tien_kh'); ?>" data-price2="<?php echo get_field('gia_tien_dt'); ?>"><?php echo get_field('ten_phong'); ?></option>
                                <?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="loai_phong_ban_dt" class="loai_phong_ban_dt" data-check="<?php echo get_field('loai_phong_ban_dt'); ?>">
                                <?php
                                $query_room = new WP_Query(array(
                                    'post_type' => 'room',
                                    'posts_per_page' => 10,
                                    'meta_key'		=> 'id_khach_san',
                                    'meta_value'	=> get_field('ten_khach_san_gd'),
                                    'order' => 'DESC'
                                ));

                                if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
                                    ?>
                                    <option value="<?php echo get_field('ten_phong'); ?>" data-price1="<?php echo get_field('gia_tien_kh'); ?>" data-price2="<?php echo get_field('gia_tien_dt'); ?>"><?php echo get_field('ten_phong'); ?></option>
                                <?php
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </select>
                            <?php
                        }
                        ?>

                    </td>
                    <td width="6%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $sl_dt = $_POST['sl_dt'];
                            ?>
                            <input type="number" name="sl_dt" class="sl_dt" value="<?php echo $sl_dt; ?>" required autocomplete="off"/>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            $sl_dt = $_POST['sl_dt'];
                            ?>
                            <input type="number" name="sl_dt" class="sl_dt" value="1" required autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="number" name="sl_dt" class="sl_dt" value="<?php echo get_field('sl_dt'); ?>" required autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="17%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $don_gia_ban_dt = $_POST['don_gia_ban_dt'];
                            $ten_khach_san_gd = $_POST['ten_khach_san_gd'];
                            $loai_phong_ban_gd = $_POST['loai_phong_ban_gd'];
                            ?>
                            <input type="text" name="don_gia_ban_dt" class="don_gia_ban_dt" value="<?php
                            if(empty($don_gia_ban_dt)){
                                $query_room = new WP_Query(array(
                                    'post_type' => 'room',
                                    'posts_per_page' => 1,
                                    'meta_query'	=> array(
                                        'relation'		=> 'AND',
                                        array(
                                            'key'	 	=> 'id_khach_san',
                                            'value'	  	=> $ten_khach_san_gd,
                                            'compare' 	=> '=',
                                        ),
                                        array(
                                            'key'	  	=> 'ten_phong',
                                            'value'	  	=> $loai_phong_ban_gd,
                                            'compare' 	=> '=',
                                        ),
                                    ),
                                    'order' => 'DESC'
                                ));

                                if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
                                    echo get_field('gia_tien_dt');
                                endwhile;
                                endif;
                                wp_reset_postdata();
                            }else{
                                echo $don_gia_ban_dt;
                            }
                            ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="don_gia_ban_dt" class="don_gia_ban_dt" value="<?php
                            if(empty($don_gia_ban_dt)){
                                $query_room = new WP_Query(array(
                                    'post_type' => 'room',
                                    'posts_per_page' => 1,
                                    'meta_query'	=> array(
                                        'relation'		=> 'AND',
                                        array(
                                            'key'	 	=> 'id_khach_san',
                                            'value'	  	=> get_field('ten_khach_san_gd'),
                                            'compare' 	=> '=',
                                        ),
                                        array(
                                            'key'	  	=> 'ten_phong',
                                            'value'	  	=> get_field('loai_phong_ban_gd'),
                                            'compare' 	=> '=',
                                        ),
                                    ),
                                    'order' => 'DESC'
                                ));

                                if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
                                    echo get_field('gia_tien_dt');
                                endwhile;
                                endif;
                                wp_reset_postdata();
                            }else{
                                echo $don_gia_ban_dt;
                            }
                            ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="25%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $don_vi_dt = $_POST['don_vi_dt'];
                            ?>
                            <select name="don_vi_dt" class="don_vi_dt" data-check="<?php echo $don_vi_dt; ?>" required >
                                <option value="" selected disabled hidden>Chọn đơn vị</option>
                                <option value="vnđ/phòng/đêm">vnđ/phòng/đêm</option>
                                <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            ?>
                            <select name="don_vi_dt" class="don_vi_dt" required >
                                <option value="vnđ/phòng/đêm" selected>vnđ/phòng/đêm</option>
                                <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="don_vi_dt" class="don_vi_dt" data-check="<?php echo get_field('don_vi_dt'); ?>" required >
                                <option value="" selected disabled hidden>Chọn đơn vị</option>
                                <option value="vnđ/phòng/đêm">vnđ/phòng/đêm</option>
                                <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                            </select>
                            <?php
                        }
                        ?>

                    </td>
                    <td width="20%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $tong_dt = $_POST['tong_dt'];
                            ?>
                            <input type="text" name="tong_dt" class="tong_dt" value="<?php echo $tong_dt; ?>" required autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="tong_dt" class="tong_dt" value="<?php echo get_field('tien_chua_pt_khac2'); ?>" required autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" align="center">Ngày lock phòng</td>
                    <td colspan="3" align="center">Gói DV - KM mua</td>
                    <td colspan="1" align="center">Mã KM</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ngay_lock_phong_doi_tac = $_POST['ngay_lock_phong_doi_tac'];
                            ?>
                            <input type="text" data-date-format="dd/mm/yyyy" name="ngay_lock_phong_doi_tac" class="ngay_lock_phong_doi_tac datepicker-here" data-language='en' value="<?php echo $ngay_lock_phong_doi_tac; ?>" autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" data-date-format="dd/mm/yyyy" name="ngay_lock_phong_doi_tac" class="ngay_lock_phong_doi_tac datepicker-here" data-language='en' value="<?php echo get_field('ngay_lock_phong_doi_tac'); ?>" autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td colspan="3" align="center">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $goi_dv_km_ban_dt = $_POST['goi_dv_km_ban_dt'];
                            ?>
                            <select name="goi_dv_km_ban_dt" class="goi_dv_km_ban_dt" data-check="<?php echo $goi_dv_km_ban_dt; ?>" required>
                                <option value="" selected disabled hidden>Chọn gói DV - KM</option>
                                <option value="BB - Ăn sáng">BB - Ăn sáng</option>
                                <option value="FB - Ăn 3 bữa">FB - Ăn 3 bữa</option>
                                <option value="FBV - Ăn 3 bữa + Vui chơi">FBV - Ăn 3 bữa + Vui chơi</option>
                                <option value="FBVS - Ăn 3 bữa + Vui chơi + Safari">FBVS - Ăn 3 bữa + Vui chơi + Safari</option>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            $goi_dv_km_ban_dt = $_POST['goi_dv_km_ban_dt'];
                            ?>
                            <select name="goi_dv_km_ban_dt" class="goi_dv_km_ban_dt" required>
                                <option value="BB - Ăn sáng" selected>BB - Ăn sáng</option>
                                <option value="FB - Ăn 3 bữa">FB - Ăn 3 bữa</option>
                                <option value="FBV - Ăn 3 bữa + Vui chơi">FBV - Ăn 3 bữa + Vui chơi</option>
                                <option value="FBVS - Ăn 3 bữa + Vui chơi + Safari">FBVS - Ăn 3 bữa + Vui chơi + Safari</option>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="goi_dv_km_ban_dt" class="goi_dv_km_ban_dt" data-check="<?php echo get_field('goi_dv_km_ban_dt'); ?>" required>
                                <option value="" selected disabled hidden>Chọn gói DV - KM</option>
                                <option value="BB - Ăn sáng">BB - Ăn sáng</option>
                                <option value="FB - Ăn 3 bữa">FB - Ăn 3 bữa</option>
                                <option value="FBV - Ăn 3 bữa + Vui chơi">FBV - Ăn 3 bữa + Vui chơi</option>
                                <option value="FBVS - Ăn 3 bữa + Vui chơi + Safari">FBVS - Ăn 3 bữa + Vui chơi + Safari</option>
                            </select>
                            <?php
                        }
                        ?>
                    </td>
                    <td colspan="1" align="center">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ma_pro_dt = $_POST['ma_pro_dt'];
                            ?>
                            <input type="text" name="ma_pro_dt" class="ma_pro_dt" value="<?php echo $ma_pro_dt; ?>" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ma_pro_dt" class="ma_pro_dt" value="<?php echo get_field('ma_pro_dt'); ?>" />
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" align="center">Dịch vụ đi kèm</td>
                </tr>
                <tr>
                    <td colspan="5" align="center">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $dich_vu_di_kem_dt = $_POST['dich_vu_di_kem_dt'];
                            ?>
                            <textarea name="dich_vu_di_kem_dt" class="dich_vu_di_kem_dt"><?php echo $dich_vu_di_kem_dt; ?></textarea>
                            <?php
                        }else{
                            ?>
                            <textarea name="dich_vu_di_kem_dt" class="dich_vu_di_kem_dt"><?php echo get_field('dich_vu_di_kem_dt'); ?></textarea>
                            <?php
                        }
                        ?>
                    </td>
                </tr>

                </tbody>
            </table>
        </td>
    </tr>

    <?php
        if( !is_page(213)) :
    ?>
    <tr>
        <td colspan="3"><table width="100%" border="1" id="show_chat" class="show_chat_table" data-id="<?php echo $ma_gd_them_booking; ?>">
                <tbody>
                <tr class="show_chat" style="order: -9999;">
                    <td width="40%" align="center" bgcolor="#EAF8FF">Ô nhập lời nhắn</td>
                    <td width="12%" align="center" bgcolor="#EAF8FF">Bộ phận</td>
                    <td width="12%" align="center" bgcolor="#EAF8FF">Mức độ ưu tiên</td>
                    <td width="12%" align="center" bgcolor="#EAF8FF">Trạng thái</td>
                    <td width="12%" align="center" bgcolor="#EAF8FF">Ngày cần nhắc lại</td>
                    <td width="12%" align="center" bgcolor="#EAF8FF">Nhập</td>
                </tr>
                <?php
                //list chat
                $arr_chat = array(
                    'post_type' => 'chat',
                    'posts_per_page' => 6,
                    'meta_key'		=> 'id_chat_gd',
                    'meta_value' => $ma_gd_them_booking,
                );

                $query_chat = get_posts($arr_chat);
                $this_ID = 'BTC_'.get_the_ID();
                $this_user = $_SESSION['mnv'];
                $data_count = 0;
                if( $query_chat ): foreach( $query_chat as $post ):
                    setup_postdata( $post );
                    $muc_do_uu_tien_chat = get_field('muc_do_uu_tien_chat');
                    $trang_thai_chat = get_field('trang_thai_chat');
                    $ngay_can_nhac_lai_chat = get_field('ngay_can_nhac_lai_chat');
                    $reply_chat = get_field('reply_chat');
                    if($this_ID == get_field('id_chat_gd')){
                        ?>
                        <tr class="show_chat count_chat <?php
                        if($this_user == get_field('ma_nhan_vien_chat')){
                            echo 'check_color';
                        }
                        ?>" data-id="<?php echo get_the_ID(); ?>" style="order:<?php echo $data_count--; ?>;">
                            <td width="40%" bgcolor="#EAF8FF">
                                <?php
                                if(!empty(get_field('reply_chat'))){
                                    ?>
                                    <span class="reply_chat"><span><?php echo get_field('reply_chat'); ?></span></span>
                                    <?php
                                }
                                ?>
                                <?php
                                $ngay_nhap_vao_chat = get_field('ngay_nhap_vao_chat');
                                $ma_nhan_vien_chat = get_field('ma_nhan_vien_chat');
                                $tin_nhan_chat = get_field('tin_nhan_chat');
                                $bo_phan_chat = get_field('bo_phan_chat');
                                $muc_do_uu_tien_chat = get_field('muc_do_uu_tien_chat');
                                $trang_thai_chat = get_field('trang_thai_chat');
                                $ngay_can_nhac_lai_chat = get_field('ngay_can_nhac_lai_chat');
                                $button = get_field('button');
                                $reply_chat = get_field('reply_chat');
                                ?>
                                <div class="cmt">
                                    <div class="img"><img src="<?php
                                        $arr_avatar = array(
                                            'post_type' => 'tai_khoan',
                                            'posts_per_page' => 6,
                                            'meta_query'	=> array(
                                                'relation'		=> 'AND',
                                                array(
                                                    'key'	 	=> 'email_tai_khoan',
                                                    'value'	  	=> get_field('ma_nhan_vien_chat'),
                                                    'compare' 	=> '=',
                                                ),
                                            ),
                                        );

                                        $query_avatar = new WP_Query($arr_avatar);

                                        if($query_avatar->have_posts()) : while ($query_avatar->have_posts()) : $query_avatar->the_post();
                                            $img_a = get_field('hinh_anh_tai_khoan');
                                            if(!empty($img_a)){
                                                echo $img_a;
                                            }else{
                                                echo get_template_directory_uri().'/assets/images/user.jpg';
                                            }
                                        endwhile;
                                        else:
                                            echo get_template_directory_uri().'/assets/images/user.jpg';
                                        endif;
                                        wp_reset_postdata();
                                        ?>" alt="avatar"></div>
                                    <div class="content">Ngày nhập vào :
                                        <span><?php echo $ngay_nhap_vao_chat; ?></span> # Mã NV :
                                        <span><?php echo $ma_nhan_vien_chat; ?></span> # Lời nhắn :
                                        <span class="tn"><?php echo $tin_nhan_chat; ?></span>
                                    </div>
                                </div>
                                <p class="edit_mess_tn">
                                    <textarea class="tn" cols="1" rows="1" disabled><?php echo $tin_nhan_chat; ?></textarea>
                                </p>
                            </td>
                            <td width="12%" bgcolor="#EAF8FF">
                                <select class="bo_phan_chat_mess" data-check="<?php echo $bo_phan_chat; ?>" disabled>
                                    <option value="" selected disabled hidden>Chọn bộ phận</option>
                                    <?php
                                    $query_bp = get_posts(array(
                                        'post_type' => 'bo_phan',
                                    ));
                                    if( $query_bp ):
                                        foreach( $query_bp as $bp ):
                                            ?>
                                            <option value="<?php echo $bp->post_title; ?>"><?php echo $bp->post_title; ?></option>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </td>
                            <td width="12%" bgcolor="#EAF8FF">
                                <select class="muc_do_uu_tien_chat_mess" data-check="<?php echo $muc_do_uu_tien_chat; ?>" disabled>
                                    <option value="Thông thường" selected>Thông thường</option>
                                    <option value="Luôn và ngay">Luôn và ngay</option>
                                    <option value="Trong ngày">Trong ngày</option>
                                </select>
                            </td>
                            <td width="12%" bgcolor="#EAF8FF"><input type="text" class="trang_thai_chat_mess" value="<?php echo $trang_thai_chat; ?>" disabled></td>
                            <td width="12%" bgcolor="#EAF8FF"><input type="text" data-date-format="dd/mm/yyyy" data-position='top left' class="datepicker-here ngay_can_nhac_lai_chat_mess" value="<?php echo $ngay_can_nhac_lai_chat; ?>" data-language='en' disabled></td>
                            <td width="12%" bgcolor="#EAF8FF"><p class="change_update_send_mess" data-id="<?php echo get_field('ma_gd_them_booking'); ?>" data-name="<?php echo $ma_nhan_vien_chat; ?>">
                                    <?php
                                    if($this_user == $ma_nhan_vien_chat && $button == 'true'){
                                        ?>
                                        <button type="button" class="btn_edit_chat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if(empty($reply_chat)){
                                        ?><button type="button" class="reply"><i class="fa fa-reply" aria-hidden="true"></i> Trả lời</button><?php
                                    }
                                    ?>
                                </p></td>
                        </tr>
                        <?php
                    }
                endforeach;
                else :
                    ?>
                    <tr class="show_chat count_chat" data-count="0"><td bgcolor="#EAF8FF" class="empy" colspan="6">Dữ liệu trống !</td></tr>
                <?php
                endif;
                ?>
                </tbody>

                <tfoot>
                <tr class="send_chat">
                    <td>
                        <span></span>
                        <input type="hidden" class="reply_chat" value="" />
                        <textarea class="tin_nhan_chat" cols="30" rows="1" placeholder="Nhập lời nhắn"></textarea>
                    </td>
                    <td>
                        <label>Bộ phận</label>
                        <select class="bo_phan_chat" data-check="Booking">
                            <?php
                            $query_bp = new WP_Query(array(
                                'post_type' => 'bo_phan',
                            ));

                            while ($query_bp->have_posts()) : $query_bp->the_post();
                                ?>
                                <option value="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></option>
                            <?php
                            endwhile;
                            ?>
                        </select>
                    </td>
                    <td>
                        <label>Mức độ ưu tiên</label>
                        <select class="muc_do_uu_tien_chat" data-check="Thông thường">
                            <option value="Thông thường" selected>Thông thường</option>
                            <option value="Luôn và ngay">Luôn và ngay</option>
                            <option value="Trong ngày">Trong ngày</option>
                        </select>
                    </td>
                    <td>
                        <label>Trạng thái</label>
                        <input type="text" value="Đã chờ" class="trang_thai_chat" disabled>
                    </td>
                    <td>
                        <label>Ngày cần nhắc lại</label>
                        <input type="text" data-date-format="dd/mm/yyyy" data-position='top left' class="datepicker-here ngay_can_nhac_lai_chat" placeholder="27/04/2019" data-language='en'>
                    </td>
                    <td>
                        <label>Nhập</label>
                        <input type="hidden" class="ma_nhan_vien_chat" value="<?php if(isset($_SESSION['mnv'])){echo $_SESSION['mnv'];} ?>">
                        <input type="hidden" class="id_chat_gd" value="<?php echo $ma_gd_them_booking; ?>">
                        <input type="hidden" class="id_reply" value="">
                        <input type="submit" class="btn_send_chat" value="Gửi tin nhắn">
                    </td>
                </tr>
                </tfoot>
            </table></td>
    </tr>
    <?php
        endif;
    ?>

    <tr>
        <td colspan="3">
            <table width="100%" border="1" style="background: #9bb552a6">
                <tbody style="padding: 5px;">
                <tr style="margin-top: 5px;">
                    <td width="5%">SL NL</td>
                    <td width="5%">GP</td>
                    <td width="5%">0 - 2</td>
                    <td width="5%">2 - 4</td>
                    <td width="5%">4 - 6</td>
                    <td width="5%">6 - 12</td>
                    <td width="10%">PT người</td>
                    <td width="10%">PT giai đoạn</td>
                    <td width="10%">PT cuối tuần</td>
                    <td width="10%">Bữa ăn bắt buộc</td>
                    <td width="10%">Dịch vụ khác</td>
                    <td width="10%">Tổng PT</td>
                    <td> KH TT PT tại?</td>
                </tr>
                <tr>
                    <td width="5%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $sl_nl = $_POST['sl_nl'];
                            ?>
                            <input type="number" style="background: #fff;" name="sl_nl" class="sl_nl" value="<?php if(!empty($sl_nl)){echo $sl_nl;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }elseif (is_page(213)){
                            ?>
                            <input type="number" style="background: #fff;" name="sl_nl" class="sl_nl" value="2" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="number" style="background: #fff;" name="sl_nl" class="sl_nl" value="<?php if(!empty($sl_nl)){echo $sl_nl;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="5%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $gp = $_POST['gp'];
                            ?>
                            <input type="number" style="background: #fff;" name="gp" class="gp" value="<?php if(!empty($gp)){echo $gp;}else{echo 0;} ?>"  autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="number" style="background: #fff;" name="gp" class="gp" value="<?php if(!empty($gp)){echo $gp;}else{echo 0;} ?>"  autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="5%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $sl02 = $_POST['sl02'];
                            ?>
                            <input type="number" style="background: #fff;" name="sl02" class="sl02" value="<?php if(!empty($sl02)){echo $sl02;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="number" style="background: #fff;" name="sl02" class="sl02" value="<?php if(!empty($sl02)){echo $sl02;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="5%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $sl24 = $_POST['sl24'];
                            ?>
                            <input type="number" style="background: #fff;" name="sl24" class="sl24" value="<?php if(!empty($sl24)){echo $sl24;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="number" style="background: #fff;" name="sl24" class="sl24" value="<?php if(!empty($sl24)){echo $sl24;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="5%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $sl46 = $_POST['sl46'];
                            ?>
                            <input type="number" style="background: #fff;" name="sl46" class="sl46" value="<?php if(!empty($sl46)){echo $sl46;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="number" style="background: #fff;" name="sl46" class="sl46" value="<?php if(!empty($sl46)){echo $sl46;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="5%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $sl612 = $_POST['sl612'];
                            ?>
                            <input type="number" style="background: #fff;" name="sl612" class="sl612" value="<?php if(!empty($sl612)){echo $sl612;}else{echo 0;} ?>"  autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="number" style="background: #fff;" name="sl612" class="sl612" value="<?php if(!empty($sl612)){echo $sl612;}else{echo 0;} ?>"  autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="10%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $pt_nguoi = $_POST['pt_nguoi'];
                            ?>
                            <input type="text" style="background: #fff;" name="pt_nguoi" class="pt_nguoi" value="<?php if(!empty($pt_nguoi)){echo $pt_nguoi;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" style="background: #fff;" name="pt_nguoi" class="pt_nguoi" value="<?php if(!empty($pt_nguoi)){echo $pt_nguoi;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="10%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $pt_giai_doan = $_POST['pt_giai_doan'];
                            ?>
                            <input type="text" style="background: #fff;" name="pt_giai_doan" class="pt_giai_doan" value="<?php if(!empty($pt_giai_doan)){echo $pt_giai_doan;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" style="background: #fff;" name="pt_giai_doan" class="pt_giai_doan" value="<?php if(!empty($pt_giai_doan)){echo $pt_giai_doan;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="10%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $pt_cuoi_tuan = $_POST['pt_cuoi_tuan'];
                            ?>
                            <input type="text" style="background: #fff;" name="pt_cuoi_tuan" class="pt_cuoi_tuan" value="<?php if(!empty($pt_cuoi_tuan)){echo $pt_cuoi_tuan;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" style="background: #fff;" name="pt_cuoi_tuan" class="pt_cuoi_tuan" value="<?php if(!empty($pt_cuoi_tuan)){echo $pt_cuoi_tuan;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="10%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $bua_an_bat_buoc = $_POST['bua_an_bat_buoc'];
                            ?>
                            <input type="text" style="background: #fff;" name="bua_an_bat_buoc" class="bua_an_bat_buoc" value="<?php if(!empty($bua_an_bat_buoc)){echo $bua_an_bat_buoc;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" style="background: #fff;" name="bua_an_bat_buoc" class="bua_an_bat_buoc" value="<?php if(!empty($bua_an_bat_buoc)){echo $bua_an_bat_buoc;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="10%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $dich_vu_khac = $_POST['dich_vu_khac'];
                            ?>
                            <input type="text" style="background: #fff;" name="dich_vu_khac" class="dich_vu_khac" value="<?php if(!empty($dich_vu_khac)){echo $dich_vu_khac;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" style="background: #fff;" name="dich_vu_khac" class="dich_vu_khac" value="<?php if(!empty($dich_vu_khac)){echo $dich_vu_khac;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="10%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $tong_pt = $_POST['tong_pt'];
                            ?>
                            <input type="text" style="background: #fff;" name="tong_pt" class="tong_pt" value="<?php if(!empty($tong_pt)){echo $tong_pt;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" style="background: #fff;" name="tong_pt" class="tong_pt" value="<?php if(!empty($tong_pt)){echo $tong_pt;}else{echo 0;} ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $kh_tt_pt_tai = $_POST['kh_tt_pt_tai'];
                            ?>
                            <select name="kh_tt_pt_tai" style="background: #fff;" class="kh_tt_pt_tai" data-check="<?php echo $kh_tt_pt_tai; ?>">
                                <option value="BTC">BTC</option>
                                <option value="Khách sạn">Khách sạn</option>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            $kh_tt_pt_tai = $_POST['kh_tt_pt_tai'];
                            ?>
                            <select name="kh_tt_pt_tai" style="background: #fff;" class="kh_tt_pt_tai">
                                <option value="BTC" selected>BTC</option>
                                <option value="Khách sạn">Khách sạn</option>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="kh_tt_pt_tai" style="background: #fff;" class="kh_tt_pt_tai" data-check="<?php echo $kh_tt_pt_tai; ?>">
                                <option value="BTC">BTC</option>
                                <option value="Khách sạn">Khách sạn</option>
                            </select>
                            <?php
                        }
                        ?>
                    </td>
                </tr>

                </tbody>
            </table>
        </td>
    </tr>
    <tr class="phu_thu_kh_vs_dt">
        <td>
            <table width="100%" border="1" style="background: #2e75bd63;">
                <tbody>
                <tr>
                    <td rowspan="7">
                        Danh sách đoàn, yêu cầu khác
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $danh_sach_doan_yeu_cau_khac = $_POST['danh_sach_doan_yeu_cau_khac'];
                            ?>
                            <textarea name="danh_sach_doan_yeu_cau_khac" class="danh_sach_doan_yeu_cau_khac"><?php echo $danh_sach_doan_yeu_cau_khac; ?></textarea>
                            <?php
                        }else{
                            ?>
                            <textarea name="danh_sach_doan_yeu_cau_khac" class="danh_sach_doan_yeu_cau_khac"><?php echo $danh_sach_doan_yeu_cau_khac; ?></textarea>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="25%">Tiền chưa PT</td>
                    <td width="25%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $tien_chua_pt_khac = $_POST['tien_chua_pt_khac'];
                            ?>
                            <input type="text" width="100%" style="height:24px;" name="tien_chua_pt_khac" class="tien_chua_pt_khac" value="<?php echo $tien_chua_pt_khac; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" width="100%" style="height:24px;" name="tien_chua_pt_khac" class="tien_chua_pt_khac" value="<?php echo $tien_chua_pt_khac; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Tổng phụ thu</td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $tong_phu_thu_khac = $_POST['tong_phu_thu_khac'];
                            ?>
                            <input type="text" name="tong_phu_thu_khac" style="height:24px;" class="tong_phu_thu_khac" value="<?php echo $tong_phu_thu_khac; ?>"  autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="tong_phu_thu_khac" style="height:24px;" class="tong_phu_thu_khac" value="<?php echo $tong_phu_thu_khac; ?>"  autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Giảm giá cho KH</td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $giam_gia_cho_kh_khac = $_POST['giam_gia_cho_kh_khac'];
                            ?>
                            <input type="text" name="giam_gia_cho_kh_khac" style="height:24px;" class="giam_gia_cho_kh_khac" value="<?php echo $giam_gia_cho_kh_khac; ?>"  autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="giam_gia_cho_kh_khac" style="height:24px;" class="giam_gia_cho_kh_khac" value="<?php echo $giam_gia_cho_kh_khac; ?>"  autocomplete="off"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Tổng giá trị</td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $tong_gia_tri_khac = $_POST['tong_gia_tri_khac'];
                            ?>
                            <input type="text" name="tong_gia_tri_khac" style="height:24px;" class="tong_gia_tri_khac" value="<?php echo $tong_gia_tri_khac; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="tong_gia_tri_khac" style="height:24px;" class="tong_gia_tri_khac" value="<?php echo $tong_gia_tri_khac; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Đã thanh toán</td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $da_thanh_toan_khac = $_POST['da_thanh_toan_khac'];
                            ?>
                            <input type="text" name="da_thanh_toan_khac" style="height:24px;" class="da_thanh_toan_khac" value="<?php echo $da_thanh_toan_khac; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="da_thanh_toan_khac" style="height:24px;" class="da_thanh_toan_khac" value="<?php echo $da_thanh_toan_khac; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>KH còn nợ</td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $kh_con_no_khac = $_POST['kh_con_no_khac'];
                            ?>
                            <input type="text" name="kh_con_no_khac" style="height:24px;" class="kh_con_no_khac" value="<?php echo $kh_con_no_khac; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="kh_con_no_khac" style="height:24px;" class="kh_con_no_khac" value="<?php echo $kh_con_no_khac; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Ngày yêu cầu KH hoàn tất TT</td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ngay_yeu_cau_kh_hoan_tat_tt_khac = $_POST['ngay_yeu_cau_kh_hoan_tat_tt_khac'];
                            ?>
                            <input type="text" style="height:24px;" name="ngay_yeu_cau_kh_hoan_tat_tt_khac" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_yeu_cau_kh_hoan_tat_tt_khac datepicker-here" data-language='en' value="<?php echo $ngay_yeu_cau_kh_hoan_tat_tt_khac; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" style="height:24px;" name="ngay_yeu_cau_kh_hoan_tat_tt_khac" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_yeu_cau_kh_hoan_tat_tt_khac datepicker-here" data-language='en' value="<?php echo $ngay_yeu_cau_kh_hoan_tat_tt_khac; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
        <td>
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td align="center" style="background-color: #f19315b3;padding-top: 5px;">
                        <ul class="price_count">
                            <li>
                                Lãi/Lỗ
                                <?php
                                if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                                    $lai_lo_khac = $_POST['lai_lo_khac'];
                                    ?>
                                    <input type="text" name="lai_lo_khac" class="lai_lo_khac" style="background: #FFF;" value="<?php echo $lai_lo_khac; ?>" autocomplete="off" />
                                    <?php
                                }else{
                                    ?>
                                    <input type="text" name="lai_lo_khac" class="lai_lo_khac" style="background: #FFF;" value="<?php echo $lai_lo_khac; ?>" autocomplete="off" />
                                    <?php
                                }
                                ?>
                            </li>
                            <li>
                                Thuế VAT
                                <?php
                                if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                                    $thue_vat_khac = $_POST['thue_vat_khac'];
                                    ?>
                                    <input type="text" name="thue_vat_khac" class="thue_vat_khac" style="background: #FFF;" value="<?php echo $thue_vat_khac; ?>" autocomplete="off" />
                                    <?php
                                }else{
                                    ?>
                                    <input type="text" name="thue_vat_khac" class="thue_vat_khac" style="background: #FFF;" value="<?php echo $thue_vat_khac; ?>" autocomplete="off" />
                                    <?php
                                }
                                ?>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="background-color: #f19315b3;">
                        <ul class="price_count">
                            <li>
                                Thuế TNDN
                                <?php
                                if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                                    $thue_tndn_khac = $_POST['thue_tndn_khac'];
                                    ?>
                                    <input type="text" name="thue_tndn_khac" class="thue_tndn_khac" style="background: #FFF;" value="<?php echo $thue_tndn_khac; ?>" autocomplete="off" />
                                    <?php
                                }else{
                                    ?>
                                    <input type="text" name="thue_tndn_khac" class="thue_tndn_khac" style="background: #FFF;" value="<?php echo $thue_tndn_khac; ?>" autocomplete="off" />
                                    <?php
                                }
                                ?>
                            </li>
                            <li>
                                CP marketing
                                <?php
                                if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                                    $cp_marketing_khac = $_POST['cp_marketing_khac'];
                                    ?>
                                    <input type="text" name="cp_marketing_khac" class="cp_marketing_khac" style="background: #FFF;" value="<?php echo $cp_marketing_khac; ?>" autocomplete="off" />
                                    <?php
                                }else{
                                    ?>
                                    <input type="text" name="cp_marketing_khac" class="cp_marketing_khac" style="background: #FFF;" value="<?php echo $cp_marketing_khac; ?>" autocomplete="off" />
                                    <?php
                                }
                                ?>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="background-color: #f19315b3;">
                        <ul class="price_count">
                            <li>
                                CP hậu cần
                                <?php
                                if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                                    $cp_hau_can_khac = $_POST['cp_hau_can_khac'];
                                    ?>
                                    <input type="text" name="cp_hau_can_khac" class="cp_hau_can_khac" style="background: #FFF;" value="<?php echo $cp_hau_can_khac; ?>" autocomplete="off" />
                                    <?php
                                }else{
                                    ?>
                                    <input type="text" name="cp_hau_can_khac" class="cp_hau_can_khac" style="background: #FFF;" value="<?php echo $cp_hau_can_khac; ?>" autocomplete="off" />
                                    <?php
                                }
                                ?>
                            </li>
                            <li>
                                CP hậu mãi
                                <?php
                                if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                                    $cp_hau_mai_khac = $_POST['cp_hau_mai_khac'];
                                    ?>
                                    <input type="text" name="cp_hau_mai_khac" class="cp_hau_mai_khac" style="background: #FFF;" value="<?php echo $cp_hau_mai_khac; ?>" autocomplete="off" />
                                    <?php
                                }else{
                                    ?>
                                    <input type="text" name="cp_hau_mai_khac" class="cp_hau_mai_khac" style="background: #FFF;" value="<?php echo $cp_hau_mai_khac; ?>" autocomplete="off" />
                                    <?php
                                }
                                ?>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="background-color: #f19315b3;padding-bottom: 10px;">
                        CP cố định
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $cp_co_dinh_khac = $_POST['cp_co_dinh_khac'];
                            ?>
                            <input type="text" name="cp_co_dinh_khac" class="cp_co_dinh_khac" style="background: #FFF;" value="<?php echo $cp_co_dinh_khac; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="cp_co_dinh_khac" class="cp_co_dinh_khac" style="background: #FFF;" value="<?php echo $cp_co_dinh_khac; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
        <td>
            <table width="100%" border="1" style="background: #2e75bd63;">
                <tbody>
                <tr>
                    <td width="25%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $tien_chua_pt_khac2 = $_POST['tien_chua_pt_khac2'];
                            ?>
                            <input type="text" name="tien_chua_pt_khac2" class="tien_chua_pt_khac2" value="<?php echo $tien_chua_pt_khac2; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="tien_chua_pt_khac2" class="tien_chua_pt_khac2" value="<?php echo $tien_chua_pt_khac2; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="25%">Tiền chưa PT</td>
                    <td width="50%" colspan="2" rowspan="7">
                        Ghi chú của ĐT
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ghi_chu_cua_dt_khac2 = $_POST['ghi_chu_cua_dt_khac2'];
                            ?>
                            <textarea name="ghi_chu_cua_dt_khac2" class="ghi_chu_cua_dt_khac2"><?php echo $ghi_chu_cua_dt_khac2; ?></textarea>
                            <?php
                        }else{
                            ?>
                            <textarea name="ghi_chu_cua_dt_khac2" class="ghi_chu_cua_dt_khac2"><?php echo $ghi_chu_cua_dt_khac2; ?></textarea>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $tong_phu_thu_khac2 = $_POST['tong_phu_thu_khac2'];
                            ?>
                            <input type="text" name="tong_phu_thu_khac2" style="height:24px;" class="tong_phu_thu_khac2" value="<?php echo $tong_phu_thu_khac2; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="tong_phu_thu_khac2" style="height:24px;" class="tong_phu_thu_khac2" value="<?php echo $tong_phu_thu_khac2; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td>Tổng phụ thu</td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $giam_gia_cua_dt_khac2 = $_POST['giam_gia_cua_dt_khac2'];
                            ?>
                            <input type="text" name="giam_gia_cua_dt_khac2" style="height:24px;" class="giam_gia_cua_dt_khac2" value="<?php echo $giam_gia_cua_dt_khac2; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="giam_gia_cua_dt_khac2" style="height:24px;" class="giam_gia_cua_dt_khac2" value="<?php echo $giam_gia_cua_dt_khac2; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td>Giảm giá của ĐT</td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $tong_gia_tri_khac2 = $_POST['tong_gia_tri_khac2'];
                            ?>
                            <input type="text" name="tong_gia_tri_khac2" style="height:24px;" class="tong_gia_tri_khac2" value="<?php echo $tong_gia_tri_khac2; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="tong_gia_tri_khac2" style="height:24px;" class="tong_gia_tri_khac2" value="<?php echo $tong_gia_tri_khac2; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td>Tổng giá trị</td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $da_thanh_toan_khac2 = $_POST['da_thanh_toan_khac2'];
                            ?>
                            <input type="text" name="da_thanh_toan_khac2" style="height:24px;" class="da_thanh_toan_khac2" value="<?php echo $da_thanh_toan_khac2; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="da_thanh_toan_khac2" style="height:24px;" class="da_thanh_toan_khac2" value="<?php echo $da_thanh_toan_khac2; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td>Đã thanh toán</td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $bct_con_no_khac2 = $_POST['bct_con_no_khac2'];
                            ?>
                            <input type="text" name="bct_con_no_khac2" style="height:24px;" class="bct_con_no_khac2" value="<?php echo $bct_con_no_khac2; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="bct_con_no_khac2" style="height:24px;" class="bct_con_no_khac2" value="<?php echo $bct_con_no_khac2; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td>BCT còn nợ</td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ngay_phai_hoan_tat_tt_cho_ks_khac2 = $_POST['ngay_phai_hoan_tat_tt_cho_ks_khac2'];
                            ?>
                            <input type="text" name="ngay_phai_hoan_tat_tt_cho_ks_khac2" style="height:24px;" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_phai_hoan_tat_tt_cho_ks_khac2 datepicker-here" data-language='en' value="<?php echo $ngay_phai_hoan_tat_tt_cho_ks_khac2; ?>" autocomplete="off" >
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ngay_phai_hoan_tat_tt_cho_ks_khac2" style="height:24px;" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_phai_hoan_tat_tt_cho_ks_khac2 datepicker-here" data-language='en' value="<?php echo $ngay_phai_hoan_tat_tt_cho_ks_khac2; ?>" autocomplete="off" >
                            <?php
                        }
                        ?>
                    </td>
                    <td>Ngày phải hoàn tất TT cho KS</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <table width="100%" border="1" style="background: #9bb552a6">
                <tbody>
                <tr>
                    <td width="15%">Tên KGD</td>
                    <td width="8%">Nick KGD</td>
                    <td width="8%">SĐT KGD</td>
                    <td width="15%">Email KGD (duy nhất)</td>
                    <td width="12%">TK KGD</td>
                    <td width="10%">Mã KGD</td>
                    <td width="10%">Xếp hạng KGD</td>
                    <td width="10%">Mã CTV</td>
                    <td>Mã NV</td>
                </tr>
                <tr>
                    <td width="15%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ten_kgd = $_POST['ten_kgd'];
                            ?>
                            <input type="text" style="background: #FFF;" name="ten_kgd_val" class="ten_kgd_val" value="<?php
                                if((int)$ten_kgd){
                                    $args = array(
                                        'p'         => $ten_kgd, // ID of a page, post, or custom type
                                        'post_type' => 'khach_hang'
                                    );
                                    $query_kh = new WP_Query($args);
                                    if($query_kh->have_posts()) :
                                        while ($query_kh->have_posts()) : $query_kh->the_post();
                                            echo get_field('ten_kgd');
                                        endwhile;
                                    else :
                                        echo $ten_kgd;
                                    endif;
                                    wp_reset_postdata();
                                }
                            ?>"  autocomplete="off"/>
                            <input type="hidden" style="background: #FFF;" name="ten_kgd" class="ten_kgd" value="<?php echo $ten_kgd; ?>"  autocomplete="off"/>
                            <?php
                        }elseif(is_page(213)){
                            ?>
                            <input type="text" style="background: #FFF;" name="ten_kgd_val" class="ten_kgd_val" value=""  autocomplete="off"/>
                            <input type="hidden" style="background: #FFF;" name="ten_kgd" class="ten_kgd" value=""  autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" style="background: #FFF;" name="ten_kgd_val" class="ten_kgd_val" value="<?php
                                if((int)$ten_kgd){
                                    $args = array(
                                        'p'         => $ten_kgd, // ID of a page, post, or custom type
                                        'post_type' => 'khach_hang'
                                    );
                                    $query_kh = new WP_Query($args);
                                    if($query_kh->have_posts()) :
                                        while ($query_kh->have_posts()) : $query_kh->the_post();
                                            echo get_field('ten_kgd');
                                        endwhile;
                                    else :
                                        echo $ten_kgd;
                                    endif;
                                }else{
                                    echo $ten_kgd;
                                }

                                wp_reset_postdata();
                            ?>"  autocomplete="off"/>
                            <input type="hidden" style="background: #FFF;" name="ten_kgd" class="ten_kgd" value="<?php echo $ten_kgd; ?>"  autocomplete="off"/>
                            <?php
                        }
                        ?>
                        <div class="popup_get_data_list pop_tenkgd">
                            <ul>
                                <li>Tên</li>
                                <li>SĐT</li>
                                <li>Email</li>
                                <li>Nick Zalo</li>
                                <li>FB</li>
                            </ul>
                            <div class="list_show">
                                <p>Không tìm thấy dữ liệu !</p>
                            </div>
                        </div>
                    </td>
                    <td width="8%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $nick_kgd = $_POST['nick_kgd'];
                            ?>
                            <input type="text" style="background: #FFF;" name="nick_kgd_val" class="nick_kgd_val" value="<?php
                                if((int)$nick_kgd){
                                    $args = array(
                                        'p'         => $nick_kgd, // ID of a page, post, or custom type
                                        'post_type' => 'khach_hang'
                                    );
                                    $query_kh = new WP_Query($args);
                                    if($query_kh->have_posts()) :
                                        while ($query_kh->have_posts()) : $query_kh->the_post();
                                            echo get_field('nick_kgd');
                                        endwhile;
                                    else :
                                        echo $nick_kgd;
                                    endif;
                                    wp_reset_postdata();
                                }
                            ?>"  autocomplete="off"/>
                            <input type="hidden" style="background: #FFF;" name="nick_kgd" class="nick_kgd" value="<?php echo $nick_kgd; ?>"  autocomplete="off"/>
                            <?php
                        }elseif(is_page(213)){
                            ?>
                            <input type="text" style="background: #FFF;" name="nick_kgd_val" class="nick_kgd_val" value=""  autocomplete="off"/>
                            <input type="hidden" style="background: #FFF;" name="nick_kgd" class="nick_kgd" value=""  autocomplete="off"/>
                            <?php
                        }else{
                            ?>
                            <input type="text" style="background: #FFF;" name="nick_kgd_val" class="nick_kgd_val" value="<?php
                                if((int)get_field('nick_kgd')){
                                    $args = array(
                                        'p'         => get_field('nick_kgd'), // ID of a page, post, or custom type
                                        'post_type' => 'khach_hang'
                                    );
                                    $query_kh = new WP_Query($args);
                                    if($query_kh->have_posts()) :
                                        while ($query_kh->have_posts()) : $query_kh->the_post();
                                            echo get_field('nick_kgd');
                                        endwhile;
                                    else :
                                        echo get_field('nick_kgd');
                                    endif;
                                }else{
                                    echo get_field('nick_kgd');
                                }
                                wp_reset_postdata();
                            ?>"  autocomplete="off"/>
                            <input type="hidden" style="background: #FFF;" name="nick_kgd" class="nick_kgd" value="<?php echo get_field('nick_kgd'); ?>"  autocomplete="off"/>
                            <?php
                        }
                        ?>
                        <div class="popup_get_data_list pop_nick_kgd">
                            <ul>
                                <li>Tên</li>
                                <li>SĐT</li>
                                <li>Email</li>
                                <li>Nick Zalo</li>
                                <li>FB</li>
                            </ul>
                            <div class="list_show">
                                <p>Không tìm thấy dữ liệu !</p>
                            </div>
                        </div>
                    </td>
                    <td width="8%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $sdt_kgd = $_POST['sdt_kgd'];
                            ?>
                            <input type="number" style="background: #FFF;" name="sdt_kgd_val" class="sdt_kgd_val" value="<?php
                                if((int)$sdt_kgd){
                                    $args = array(
                                        'p'         => $sdt_kgd, // ID of a page, post, or custom type
                                        'post_type' => 'khach_hang'
                                    );
                                    $query_kh = new WP_Query($args);
                                    if($query_kh->have_posts()) :
                                        while ($query_kh->have_posts()) : $query_kh->the_post();
                                            echo get_field('sdt_kgd');
                                        endwhile;
                                    else :
                                        echo $sdt_kgd;
                                    endif;
                                    wp_reset_postdata();
                                }
                            ?>" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="sdt_kgd" class="sdt_kgd" value="<?php echo $sdt_kgd; ?>" autocomplete="off" />
                            <?php
                        }elseif(is_page(213)){
                            ?>
                            <input type="number" style="background: #FFF;" name="sdt_kgd_val" class="sdt_kgd_val" value="" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="sdt_kgd" class="sdt_kgd" value="" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="number" style="background: #FFF;" name="sdt_kgd_val" class="sdt_kgd_val" value="<?php
                                if(!empty(get_field('sdt_kgd'))){
                                    $args = array(
                                        'p'         => get_field('sdt_kgd'), // ID of a page, post, or custom type
                                        'post_type' => 'khach_hang'
                                    );
                                    $query_kh = new WP_Query($args);
                                    if($query_kh->have_posts()) :
                                        while ($query_kh->have_posts()) : $query_kh->the_post();
                                            echo get_field('sdt_kgd');
                                        endwhile;
                                    else :
                                        echo get_field('sdt_kgd');
                                    endif;
                                    wp_reset_postdata();
                                }else{
                                    echo get_field('sdt_kgd');
                                }

                            ?>" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="sdt_kgd" class="sdt_kgd" value="<?php echo get_field('sdt_kgd'); ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                        <div class="popup_get_data_list pop_sdt_kgd">
                            <ul>
                                <li>Tên</li>
                                <li>SĐT</li>
                                <li>Email</li>
                                <li>Nick Zalo</li>
                                <li>FB</li>
                            </ul>
                            <div class="list_show">
                                <p>Không tìm thấy dữ liệu !</p>
                            </div>
                        </div>
                    </td>
                    <td width="15%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $email_kgd_duy_nhat = $_POST['email_kgd_duy_nhat'];
                            ?>
                            <input type="email" style="background: #FFF;" name="email_kgd_duy_nhat_val" class="email_kgd_duy_nhat" value="<?php
                                if((int)$email_kgd_duy_nhat){
                                    $args = array(
                                        'p'         => $email_kgd_duy_nhat, // ID of a page, post, or custom type
                                        'post_type' => 'khach_hang'
                                    );
                                    $query_kh = new WP_Query($args);
                                    if($query_kh->have_posts()) :
                                        while ($query_kh->have_posts()) : $query_kh->the_post();
                                            echo get_field('email_kgd_duy_nhat');
                                        endwhile;
                                    else :
                                        echo $email_kgd_duy_nhat;
                                    endif;
                                    wp_reset_postdata();
                                }
                            ?>" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="email_kgd_duy_nhat" class="email_kgd_duy_nhat" value="<?php echo $email_kgd_duy_nhat; ?>" autocomplete="off" />
                            <?php
                        }elseif(is_page(213)){
                            ?>
                            <input type="email" style="background: #FFF;" name="email_kgd_duy_nhat_val" class="email_kgd_duy_nhat_val" value="" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="email_kgd_duy_nhat" class="email_kgd_duy_nhat" value="" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="email" style="background: #FFF;" name="email_kgd_duy_nhat_val" class="email_kgd_duy_nhat_val" value="<?php
                                if((int)get_field('email_kgd_duy_nhat')){
                                    $args = array(
                                        'p'         => get_field('email_kgd_duy_nhat'), // ID of a page, post, or custom type
                                        'post_type' => 'khach_hang'
                                    );
                                    $query_kh = new WP_Query($args);
                                    if($query_kh->have_posts()) :
                                        while ($query_kh->have_posts()) : $query_kh->the_post();
                                            echo get_field('email_kgd_duy_nhat');
                                        endwhile;
                                    else :
                                        echo get_field('email_kgd_duy_nhat');
                                    endif;
                                }else{
                                    echo get_field('email_kgd_duy_nhat');
                                }
                                wp_reset_postdata();
                            ?>" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="email_kgd_duy_nhat" class="email_kgd_duy_nhat" value="<?php echo get_field('email_kgd_duy_nhat'); ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="12%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $tk_kgd = $_POST['tk_kgd'];
                            ?>
                            <input type="number" style="background: #FFF;" name="tk_kgd_val" class="tk_kgd_val" value="<?php
                                if((int)$tk_kgd){
                                    $args = array(
                                        'p'         => $tk_kgd, // ID of a page, post, or custom type
                                        'post_type' => 'khach_hang'
                                    );
                                    $query_kh = new WP_Query($args);
                                    if($query_kh->have_posts()) :
                                        while ($query_kh->have_posts()) : $query_kh->the_post();
                                            echo get_field('email_kgd_duy_nhat');
                                        endwhile;
                                    else :
                                        echo $tk_kgd;
                                    endif;
                                    wp_reset_postdata();
                                }
                            ?>" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="tk_kgd" class="tk_kgd" value="<?php echo $tk_kgd; ?>" autocomplete="off" />
                            <?php
                        }elseif(is_page(213)){
                            ?>
                            <input type="number" style="background: #FFF;" name="tk_kgd_val" class="tk_kgd_val" value="" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="tk_kgd" class="tk_kgd" value="" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="number" style="background: #FFF;" name="tk_kgd_val" class="tk_kgd_val" value="<?php
                                $args = array(
                                    'p'         => get_field('tk_kgd'), // ID of a page, post, or custom type
                                    'post_type' => 'khach_hang'
                                );
                                $query_kh = new WP_Query($args);
                                if($query_kh->have_posts()) :
                                while ($query_kh->have_posts()) : $query_kh->the_post();
                                    echo get_field('tk_kgd');
                                endwhile;
                                else :
                                    echo get_field('tk_kgd');
                                endif;
                                wp_reset_postdata();
                            ?>" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="tk_kgd" class="tk_kgd" value="<?php echo get_field('tk_kgd'); ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="10%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ma_kgd = $_POST['ma_kgd'];
                            ?>
                            <input type="text" style="background: #FFF;" name="ma_kgd_val" class="ma_kgd_val" value="<?php
                                if((int)$ma_kgd){
                                    $args = array(
                                        'p'         => $ma_kgd, // ID of a page, post, or custom type
                                        'post_type' => 'khach_hang'
                                    );
                                    $query_kh = new WP_Query($args);
                                    if($query_kh->have_posts()) :
                                        while ($query_kh->have_posts()) : $query_kh->the_post();
                                            echo get_field('ma_kgd');
                                        endwhile;
                                    else :
                                        echo $ma_kgd;
                                    endif;
                                    wp_reset_postdata();
                                }
                            ?>" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="ma_kgd" class="ma_kgd" value="<?php echo $ma_kgd; ?>" autocomplete="off" />
                            <?php
                        }elseif(is_page(213)){
                            ?>
                            <input type="text" style="background: #FFF;" name="ma_kgd_val" class="ma_kgd_val" value="" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="ma_kgd" class="ma_kgd" value="" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" style="background: #FFF;" name="ma_kgd_val" class="ma_kgd_val" value="<?php
                                if(!empty(get_field('ma_kgd'))){
                                    $args = array(
                                        'p'         => get_field('ma_kgd'), // ID of a page, post, or custom type
                                        'post_type' => 'khach_hang'
                                    );
                                    $query_kh = new WP_Query($args);
                                    if($query_kh->have_posts()) :
                                        while ($query_kh->have_posts()) : $query_kh->the_post();
                                            echo get_field('ma_kgd');
                                        endwhile;
                                    else :
                                        echo get_field('ma_kgd');
                                    endif;
                                    wp_reset_postdata();
                                }else{

                                }
                            ?>" autocomplete="off" />
                            <input type="hidden" style="background: #FFF;" name="ma_kgd" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td width="10%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $xep_hang_kgd = $_POST['xep_hang_kgd'];
                            ?>
                            <select name="xep_hang_kgd" class="xep_hang_kgd" style="background: #FFF;" data-check="<?php echo $xep_hang_kgd; ?>" autocomplete="off" >
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <?php
                        }elseif(is_page(213) || is_page()){
                            ?>
                            <select name="xep_hang_kgd" class="xep_hang_kgd" style="background: #FFF;" autocomplete="off" >
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5" selected>5</option>
                            </select>
                            <?php
                        }else{
                            ?>
                            <select name="xep_hang_kgd" class="xep_hang_kgd" style="background: #FFF;" data-check="<?php echo $xep_hang_kgd; ?>" autocomplete="off" >
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <?php
                        }
                        ?>
                    </td>
                    <td width="10%">
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ma_ctv = $_POST['ma_ctv'];
                            ?>
                            <input type="text" name="ma_ctv" style="background: #FFF;" class="ma_ctv" value="<?php echo $ma_ctv; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ma_ctv" style="background: #FFF;" class="ma_ctv" value="<?php echo $ma_ctv; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])){
                            $ma_nv = $_POST['ma_nv'];
                            ?>
                            <input type="text" name="ma_nv" class="ma_nv" style="background: #FFF;" value="<?php echo $ma_nv; ?>" autocomplete="off" />
                            <?php
                        }else{
                            ?>
                            <input type="text" name="ma_nv" class="ma_nv" style="background: #FFF;" value="<?php echo $ma_nv; ?>" autocomplete="off" />
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <?php
        if(!empty($ma_gd_them_booking)) {
            ?>
            <tr class="gd_price">
                <td class="td_fix">
                    <div class="list_price_1">
                        <div class="item">
                            <table>
                                <tbody>
                                <tr class="first">
                                    <td width="25%">Mã tiền đến</td>
                                    <td width="25%">Tiền đến</td>
                                    <td width="25%">Ngày đến</td>
                                    <td width="25%">TK đến</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="content">
                            <?php
                            $query_gd_tien = new WP_Query(array(
                                'post_type' => 'tien',
                                'order' => 'DESC',
                                'posts_per_page' => 50,
                                'meta_key' => 'id_gd',
                                'meta_value' => $ma_gd_them_booking
                            ));

                            $order = 0;
                            $data_count_list = 0;

                            if ($query_gd_tien->have_posts()) : while ($query_gd_tien->have_posts()) : $query_gd_tien->the_post();
                                $data_count_list++;
                                if(!empty(get_field('ma_gd_coc')) || !empty(get_field('tien_coc')) || !empty(get_field('ngay_coc')) || !empty(get_field('tk_coc'))) {
                                    $post_count = $query_gd_tien->post_count;
                                    ?>
                                    <div class="item" style="order:<?php echo $order--; ?>;"
                                         data-price="<?php echo get_field('tien_coc'); ?>" data-id="<?php the_ID(); ?>">
                                        <table width="100%" border="1">
                                            <tbody>
                                            <tr>
                                                <td width="25%">
                                                    <input type="text" name="ma_gd_coc" class="ma_gd_coc"
                                                           value="<?php echo get_field('ma_gd_coc'); ?>"
                                                           autocomplete="off"/>
                                                </td>
                                                <td width="25%">
                                                    <input type="text" name="tien_coc" class="tien_coc"
                                                           value="<?php echo get_field('tien_coc'); ?>" autocomplete="off"/>
                                                </td>
                                                <td width="25%">
                                                    <input type="text" name="ngay_coc" data-date-format="dd/mm/yyyy"
                                                           data-position="top left" class="ngay_coc datepicker-here"
                                                           data-language='en' value="<?php echo get_field('ngay_coc'); ?>"
                                                           autocomplete="off"/>
                                                </td>
                                                <td>
                                                    <input type="number" name="tk_coc" class="tk_coc"
                                                           value="<?php echo get_field('tk_coc'); ?>" autocomplete="off"/>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                }
                                ?>
                            <?php
                            endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>

                    <div class="total_price_1">
                        <strong>Tổng : </strong><span>21321321231</span>
                    </div>
                    <div class="save_price_1">
                        <span></span>
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </div>
                </td>
                <td align="center" style="background-color: #f19315b3;padding-top: 5px;">
                    Mã Kho (popup thông tin kho)
                    <?php
                    if (isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])) {
                        $ma_kho_popup_thong_tin_kho = $_POST['ma_kho_popup_thong_tin_kho'];
                        ?>
                        <input type="text" style="background: #FFF !important;" name="ma_kho_popup_thong_tin_kho"
                               class="ma_kho_popup_thong_tin_kho" value="<?php echo $ma_kho_popup_thong_tin_kho; ?>"
                               autocomplete="off"/>
                        <?php
                    } else {
                        ?>
                        <input type="text" style="background: #FFF !important;" name="ma_kho_popup_thong_tin_kho"
                               class="ma_kho_popup_thong_tin_kho" value="<?php echo $ma_kho_popup_thong_tin_kho; ?>"
                               autocomplete="off"/>
                        <?php
                    }
                    ?>

                    SL lấy từ kho
                    <?php
                    if (isset($_POST['add_edit_giao_dich']) || isset($_POST['sub_tach_giao_dich'])) {
                        $sl_lay_tu_kho = $_POST['sl_lay_tu_kho'];
                        ?>
                        <input type="number" style="background: #FFF !important;" name="sl_lay_tu_kho"
                               class="sl_lay_tu_kho" value="<?php echo $sl_lay_tu_kho; ?>" autocomplete="off"/>
                        <?php
                    } else {
                        ?>
                        <input type="number" style="background: #FFF !important;" name="sl_lay_tu_kho"
                               class="sl_lay_tu_kho" value="<?php echo $sl_lay_tu_kho; ?>" autocomplete="off"/>
                        <?php
                    }
                    ?>
                    <br>
                </td>
                <td class="td_fix">
                    <div class="list_price_2">
                        <div class="item">
                            <table>
                                <tbody>
                                <tr class="first">
                                    <td width="25%">Mã tiền đi</td>
                                    <td width="25%">Tiền đi</td>
                                    <td width="25%">Ngày đi</td>
                                    <td width="25%">TK đi</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="content">
                            <?php
                            $order = 0;
                            $data_count_list2 = 0;
                            if ($query_gd_tien->have_posts()) : while ($query_gd_tien->have_posts()) : $query_gd_tien->the_post();
                                $tien_coc_di = get_field('tien_coc_di');
                                $data_count_list2++;
                                if(!empty(get_field('ma_gd_coc_di')) || !empty(get_field('tien_coc_di')) || !empty(get_field('ngay_phai_coc_di')) || !empty(get_field('tk_coc_di'))) {
                                    ?>
                                    <div class="item" style="order:<?php echo $order--; ?>;"
                                         data-price="<?php echo get_field('tien_coc_di'); ?>" data-id="<?php the_ID(); ?>">
                                        <table width="100%" border="1">
                                            <tbody>
                                            <?php
                                            if ($data_count_list2 == $post_count) {
                                                ?>
                                                <tr class="first">
                                                    <td width="25%">Mã GD cọc đi</td>
                                                    <td width="25%">Tiền cọc đi</td>
                                                    <td width="25%">Ngày phải cọc đi</td>
                                                    <td width="25%">TK cọc đi</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td width="25%">
                                                    <input type="text" name="ma_gd_coc_di" class="ma_gd_coc_di"
                                                           value="<?php echo get_field('ma_gd_coc_di'); ?>"
                                                           autocomplete="off"/>
                                                </td>
                                                <td width="25%">
                                                    <input type="text" name="tien_coc_di" class="tien_coc_di"
                                                           value="<?php echo get_field('tien_coc_di'); ?>"
                                                           autocomplete="off"/>
                                                </td>
                                                <td width="25%">
                                                    <input type="text" name="ngay_phai_coc_di" data-date-format="dd/mm/yyyy"
                                                           data-position="top left" class="ngay_phai_coc_di datepicker-here"
                                                           data-language='en'
                                                           value="<?php echo get_field('ngay_phai_coc_di'); ?>"
                                                           autocomplete="off"/>
                                                </td>
                                                <td>
                                                    <input type="number" name="tk_coc_di" class="tk_coc_di"
                                                           value="<?php echo get_field('tk_coc_di'); ?>"
                                                           autocomplete="off"/>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                }
                                ?>
                            <?php
                            endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <div class="total_price_2">
                        <strong>Tổng : </strong><span>213231213</span>
                    </div>
                    <div class="save_price_2">
                        <span></span>
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </div>
                </td>
            </tr>
            <?php
        }
    ?>
    </tbody>
</table>
<?php
    if(!empty($ma_gd_them_booking)) {
        ?>
        <div class="add_list_price_booking">
            <div class="list_price">
                <div class="content">
                    <div class="item">
                        <input type="text" class="add_ma_gd_coc" placeholder="Mã GD cọc">
                    </div>
                    <div class="item">
                        <input type="text" class="add_tien_coc" placeholder="Tiền cọc">
                    </div>
                    <div class="item">
                        <input type="text" class="add_ngay_coc datepicker-here" data-position='top left'
                               data-date-format="dd/mm/yyyy" data-language='en' placeholder="Ngày cọc">
                    </div>
                    <div class="item">
                        <input type="text" class="add_tk_coc" placeholder="TK cọc">
                    </div>
                </div>
                <button type="button" class="btn_add_price_gd" data-id="<?php echo get_the_ID(); ?>">Thêm tiền đến</button>
            </div>
            <div class="list_price">
                <div class="item">
                    <i class="fa fa-exchange" aria-hidden="true"></i>
                </div>
            </div>
            <div class="list_price">
                <div class="content">
                    <div class="item">
                        <input type="text" class="add_ma_gd_coc_di" placeholder="Mã GD cọc đi">
                    </div>
                    <div class="item">
                        <input type="text" class="add_tien_coc_di" placeholder="Tiền cọc đi">
                    </div>
                    <div class="item">
                        <input type="text" class="add_ngay_phai_coc_di datepicker-here" data-position='top left'
                               data-date-format="dd/mm/yyyy" data-language='en' placeholder="Ngày phải cọc đi">
                    </div>
                    <div class="item">
                        <input type="text" class="add_tk_coc_di" placeholder="TK cọc đi">
                    </div>
                </div>
                <button type="button" class="btn_add_price_gd2" data-id="<?php echo get_the_ID(); ?>">Thêm tiền đi</button>
            </div>
        </div>
        <?php
    }
?>