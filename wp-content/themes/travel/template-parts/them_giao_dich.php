<?php
/*
 * Template Name: Giao dịch mới*/

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
                <div class="them_giao_dich">
                    <form action="<?php echo home_url('/'); ?>them-giao-dich" method="post">
                        <?php
                            if (isset($_POST['sub_new_giao_dich'])) {
                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                $date = date('d-m-Y H:i:s');

                                $array_gd = array(
                                    'post_type' => 'giao_dich',
                                    'post_status' => 'publish'
                                );

                                $query = new WP_Query($array_gd);

                                if ($query->have_posts()) {
                                    while ($query->have_posts()) : $query->the_post();
                                        if (get_field('ma_xac_nhan') == $_POST['ma_xac_nhan']) {
                                            $alert = "<p class='alert_tk_fail'>Mã xác nhận đã tồn tại !</p>";
                                        }elseif (get_field('ma_pro_dt') == $_POST['ma_pro_dt']) {
                                            $alert = "<p class='alert_tk_fail'>Mã pro đã tồn tại !</p>";
                                        }elseif (get_field('ma_gd') == $_POST['ma_gd']) {
                                            $alert = "<p class='alert_tk_fail'>Mã giao dịch đã tồn tại !</p>";
                                        }elseif (get_field('ma_kgd') == $_POST['ma_kgd']) {
                                            $alert = "<p class='alert_tk_fail'>Mã khách giao dịch đã tồn tại !</p>";
                                        }elseif (get_field('ma_gd_hoan_tien_1') == $_POST['ma_gd_hoan_tien_1']) {
                                            $alert = "<p class='alert_tk_fail'>Mã giao dịch hoàn tiền khách đã tồn tại !</p>";
                                        }elseif (get_field('ma_gd_hoan_tien_2') == $_POST['ma_gd_hoan_tien_2']) {
                                            $alert = "<p class='alert_tk_fail'>Mã giao dịch hoàn tiền đối tác đã tồn tại !</p>";
                                        }
                                    endwhile;
                                    wp_reset_postdata();
                                }

                                if(! isset($alert)){
                                    $add_new_giao_dich = array(
                                        'post_title' => $_POST['ma_gd'],
                                        'post_status' => 'publish',
                                        'post_type' => 'giao_dich',
                                    );

                                    $post_id = wp_insert_post($add_new_giao_dich);

                                    $group_ID = '6';
                                    $fields = acf_get_fields($group_ID);
                                    foreach ($fields as $field){
                                        if($field['name'] != ""){
                                            add_post_meta($post_id, $field['name'], $_POST[$field['name']], true);
                                        }
                                    }

                                    //lịch sử giao dịch
                                    $add_lich_su_giao_dich = array(
                                        'post_title' => $_POST['ma_gd'],
                                        'post_status' => 'publish',
                                        'post_type' => 'history_giao_dich',
                                    );

                                    $post_lich_su_gd = wp_insert_post($add_lich_su_giao_dich);

                                    $group_ID_ls = '6';
                                    $fields_ls = acf_get_fields($group_ID_ls);
                                    foreach ($fields_ls as $field){
                                        if($field['name'] != ""){
                                            add_post_meta($post_lich_su_gd, $field['name'], $_POST[$field['name']], true);
                                        }
                                    }

                                    add_post_meta($post_lich_su_gd, 'nguoi_sua', $_SESSION['name'], true);
                                    add_post_meta($post_lich_su_gd, 'hanh_dong', 'Thêm giao dịch', true);
                                    add_post_meta($post_lich_su_gd, 'thoi_gian_sua', $date, true);
                                }

                                if(isset($alert)){
                                    echo '<p class="alert">'.$alert.'</p>';
                                    echo '<a href="javascript:history.back()" class="phuc_hoi">Click phục hồi các giá trị vừa nhập để sửa lại !</a>';
                                }else{
                                    echo $alert = "<p class='alert_tk_sucess'>Thêm giao dịch thành công !</p>";
                                }
                            }
                        ?>

                        <table width="100%" border="1">
                            <tbody>
                            <tr>
                                <td width="42%">
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="80%">Tên Khách sạn - Tên dịch vụ</td>
                                            <td>Mã dịch vụ</td>
                                        </tr>
                                        <td align="center"></td>
                                        <tr>
                                            <td width="80%">
                                                <select name="ten_khach_san_gd" class="ten_khach_san_gd" data-check="<?php echo get_field('ten_khach_san_gd'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn tên khách sạn</option>
                                                    <?php
                                                    $query = new WP_Query(array(
                                                        'post_type' => 'khach_san',
                                                    ));

                                                    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                                                        ?>
                                                        <option value="<?php echo get_field('ten_ks'); ?>" data-room="<?php echo $str = get_field('loai_phong_ks');?>" data-id="<?php echo get_field('ma_ks'); ?>"><?php echo get_field('ten_ks'); ?></option>
                                                    <?php
                                                    endwhile;
                                                    endif;
                                                    wp_reset_postdata();
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="ma_dich_vu_gd" class="ma_dich_vu_gd" value="<?php echo get_field('ma_dich_vu_gd'); ?>" required/>
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
                                                <select name="noi_di_gd" class="noi_di_gd" data-check="<?php echo get_field('noi_di_gd'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn nơi đi</option>
                                                    <?php
                                                    $query_khach_san = new WP_Query(array(
                                                        'post_type' => 'dia_diem_local',
                                                        'posts_type' => 15,
                                                    ));
                                                    if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                                        ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                                    endwhile;
                                                    endif;
                                                    wp_reset_postdata();
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="noi_den_gd" class="noi_den_gd" data-check="<?php echo get_field('noi_den_gd'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn nơi đến</option>
                                                    <?php
                                                    $query_khach_san = new WP_Query(array(
                                                        'post_type' => 'dia_diem_local',
                                                        'posts_type' => 15,
                                                    ));
                                                    if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                                        ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                                    endwhile;
                                                    endif;
                                                    wp_reset_postdata();
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;">
                                    MGD LK
                                    <input name="ma_gd_con" class="ma_gd_con" style="background: #FFF;"><?php echo get_field('ma_gd_con'); ?></input>
                                </td>
                                <td width="42%">
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
                                                <select name="ten_dt_gui_book_dt" class="ten_dt_gui_book_dt" data-check="<?php echo get_field('ten_dt_gui_book_dt'); ?>" required/>
                                                <option value="" selected disabled hidden>Chọn đối tác</option>
                                                <?php
                                                $query = new WP_Query(array(
                                                    'post_type' => 'doi_tac',
                                                ));

                                                if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                                                    ?>
                                                    <option value="<?php echo get_field('ten_dt'); ?>" data-room="<?php echo $str = get_field('loai_phong_ks');?>" data-id="<?php echo get_field('ma_dt'); ?>"><?php echo get_field('ten_dt'); ?></option>
                                                <?php
                                                endwhile;
                                                endif;
                                                wp_reset_postdata();
                                                ?>
                                                </select>
                                            </td>
                                            <td><input type="text" name="ma_dt" class="ma_dt" value="<?php echo get_field('ma_dt'); ?>" required /></td>
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
                                                <select name="noi_di_dt" class="noi_di_dt" data-check="<?php echo get_field('noi_di_dt'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn nơi đi</option>
                                                    <?php
                                                    $query_khach_san = new WP_Query(array(
                                                        'post_type' => 'dia_diem_local',
                                                        'posts_type' => 15,
                                                    ));
                                                    if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                                        ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                                    endwhile;
                                                    endif;
                                                    wp_reset_postdata();
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="noi_den_dt" class="noi_den_dt" data-check="<?php echo get_field('noi_den_dt'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn nơi đến</option>
                                                    <?php
                                                    $query_khach_san = new WP_Query(array(
                                                        'post_type' => 'dia_diem_local',
                                                        'posts_type' => 15,
                                                    ));
                                                    if($query_khach_san->have_posts()) : while ($query_khach_san->have_posts()) : $query_khach_san->the_post();
                                                        ?><option value="<?php the_title(); ?>"><?php the_title(); ?></option><?php
                                                    endwhile;
                                                    endif;
                                                    wp_reset_postdata();
                                                    ?>
                                                </select>
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
                                                <input type="text" name="khach_dai_dien_gd" class="khach_dai_dien_gd" value="<?php echo get_field('khach_dai_dien_gd'); ?>" required />
                                                <div class="popup_get_data_list pop_ten">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%">
                                                <input type="number" name="sdt_gd" class="sdt_gd" value="<?php echo get_field('sdt_gd'); ?>" required />
                                                <div class="popup_get_data_list pop_sdt">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <select name="trang_thai_bkk_voi_kh_gd" class="trang_thai_bkk_voi_kh_gd" data-check="<?php echo get_field('trang_thai_bkk_voi_kh_gd'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn trạng thái</option>
                                                    <?php
                                                    $arr = array(
                                                        'post_type' => 'trang_thai',
                                                        'order' => 'ASC',
                                                        'posts_per_page' => 20,
                                                    );

                                                    $query = new WP_Query($arr);
                                                    while ($query->have_posts()) : $query->the_post();
                                                        ?>
                                                        <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                                                    <?php
                                                    endwhile;
                                                    wp_reset_postdata();
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;">
                                    <strong>Mã GD</strong>
                                    <input type="text" name="ma_gd" class="ma_gd" style="background: #FFF;" value="<?php echo get_field('ma_gd'); ?>" required />
                                </td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="40%">Trạng thái BKK với ĐT</td>
                                            <td width="20%">Nick</td>
                                            <td>Tên NV đặt phòng</td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <select name="trang_thai_bkk_voi_dt" class="trang_thai_bkk_voi_dt" data-check="<?php echo get_field('trang_thai_bkk_voi_dt'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn trạng thái</option>
                                                    <?php
                                                    $arr = array(
                                                        'post_type' => 'trang_thai',
                                                        'order' => 'ASC',
                                                        'posts_per_page' => 20,
                                                    );

                                                    $query = new WP_Query($arr);
                                                    while ($query->have_posts()) : $query->the_post();
                                                        ?>
                                                        <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                                                    <?php
                                                    endwhile;
                                                    wp_reset_postdata();
                                                    ?>
                                                </select>
                                            </td>
                                            <td width="20%"><input type="text" name="nick_dt" class="nick_dt" value="<?php echo get_field('nick_dt'); ?>" required /></td>
                                            <td><input type="text" name="ten_nv_dat_phong_dt" class="ten_nv_dat_phong_dt" value="<?php echo get_field('ten_nv_dat_phong_dt'); ?>" required /></td>
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
                                            <td width="40%">Check-in (thứ 6,7 màu xanh, CN màu đỏ)</td>
                                            <td width="10%">Số đêm</td>
                                            <td width="40%">Check-out</td>
                                            <td>Còn ? ngày</td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><input type="text" name="ci_gd" data-date-format="dd/mm/yyyy" class="ci_gd datepicker-here" data-language='en' value="<?php echo get_field('ci_gd'); ?>" required /></td>
                                            <td width="10%"><input type="number" name="so_dem_gd" class="so_dem_gd" value="<?php echo get_field('so_dem_gd'); ?>" required /></td>
                                            <td width="40%"><input type="text" name="co_gd" data-date-format="dd/mm/yyyy" class="co_gd datepicker-here" data-language='en' value="<?php echo get_field('co_gd'); ?>" required /></td>
                                            <td><input type="number" name="con_ngay_gd" class="con_ngay_gd" value="<?php echo get_field('con_ngay_gd'); ?>" required /></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;">
                                    Hình thức book
                                    <input type="text" name="hinh_thuc_book_gd" class="hinh_thuc_book_gd" style="background: #FFF;" value="<?php echo get_field('hinh_thuc_book_gd'); ?>" required/">
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
                                            <td width="40%"><input type="text" name="ngay_duoc_huy" data-date-format="dd/mm/yyyy" class="ngay_duoc_huy datepicker-here" data-language='en' value="<?php echo get_field('ngay_duoc_huy'); ?>" required /></td>
                                            <td width="10%"><input type="number" name="con_ngay_dt" class="con_ngay_dt" value="<?php echo get_field('con_ngay_dt'); ?>" required /></td>
                                            <td width="40%"><input type="text" name="ngay_duoc_thay_doi" data-date-format="dd/mm/yyyy" class="ngay_duoc_thay_doi datepicker-here" data-language='en' value="<?php echo get_field('ngay_duoc_thay_doi'); ?>" required /></td>
                                            <td><input type="number" name="con_ngay_thay_doi_dt" class="con_ngay_thay_doi_dt" value="<?php echo get_field('con_ngay_thay_doi_dt'); ?>" required/></td>
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
                                            <td width="35%">Loại phòng bán</td>
                                            <td width="10%">SL</td>
                                            <td width="15%">Đơn giá bán</td>
                                            <td width="15%">Đơn vị</td>
                                            <td width="20%">Tổng</td>
                                        </tr>
                                        <tr>
                                            <td width="35%">
                                                <select name="loai_phong_ban_gd" class="loai_phong_ban_gd" data-check="<?php echo get_field('loai_phong_ban_gd'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn loại phòng</option>
                                                </select>
                                            </td>
                                            <td width="10%"><input type="number" name="sl_gd" class="sl_gd" value="<?php echo get_field('sl_gd'); ?>" required /></td>
                                            <td width="15%"><input type="number" name="don_gia_ban_gd" class="don_gia_ban_gd" value="<?php echo get_field('don_gia_ban_gd'); ?>" required /></td>
                                            <td width="20%">
                                                <select name="don_vi_gd" class="don_vi_gd" data-check="<?php echo get_field('don_vi_gd'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn đơn vị</option>
                                                    <option value="vnđ/phòng/đêm">vnđ/phòng/đêm</option>
                                                    <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                                    <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                                                </select>
                                            </td>
                                            <td width="20%"><input type="number" name="tong_gd" class="tong_gd" value="<?php echo get_field('tong_gd'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="center">Gói DV - KM bán</td>
                                            <td colspan="2" align="center">Mã PRO</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="center">
                                                <select name="goi_dv_km_ban_gd" class="goi_dv_km_ban_gd" data-check="<?php echo get_field('goi_dv_km_ban_gd'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn gói DV - KM</option>
                                                    <option value="BB - Ăn sáng">BB - Ăn sáng</option>
                                                    <option value="FB - Ăn 3 bữa">FB - Ăn 3 bữa</option>
                                                    <option value="FBV - Ăn 3 bữa + Vui chơi">FBV - Ăn 3 bữa + Vui chơi</option>
                                                    <option value="FBVS - Ăn 3 bữa + Vui chơi + Safari">FBVS - Ăn 3 bữa + Vui chơi + Safari</option>
                                                </select>
                                            </td>
                                            <td colspan="2" align="center"><input type="text" name="ma_pro_gd" class="ma_pro_gd" value="<?php echo get_field('ma_pro_gd'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center">Dịch vụ đi kèm</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center"><textarea name="dich_vu_di_kem_gd" class="dich_vu_di_kem_gd"><?php echo get_field('dich_vu_di_kem_gd'); ?></textarea></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;">
                                    Mã xác nhận
                                    <input type="text" name="ma_xac_nhan" class="ma_xac_nhan" style="background: #FFF;" value="<?php echo get_field('ma_xac_nhan'); ?>" required/>
                                    <p></p>
                                    Lý giải PT
                                    <textarea name="ly_giai_pt" class="ly_giai_pt" style="background: #FFF;"><?php echo get_field('ly_giai_pt'); ?></textarea>
                                </td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="35%">Loại phòng bán</td>
                                            <td width="10%">SL</td>
                                            <td width="15%">Đơn giá bán</td>
                                            <td width="20%">Đơn vị</td>
                                            <td width="20%">Tổng</td>
                                        </tr>
                                        <tr>
                                            <td width="35%">
                                                <select name="loai_phong_ban_dt" class="loai_phong_ban_dt" data-check="<?php echo get_field('loai_phong_ban_dt'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn loại phòng</option>
                                                </select>
                                            </td>
                                            <td width="10%"><input type="number" name="sl_dt" class="sl_dt" value="<?php echo get_field('sl_dt'); ?>" required /></td>
                                            <td width="15%"><input type="number" name="don_gia_ban_dt" class="don_gia_ban_dt" value="<?php echo get_field('don_gia_ban_dt'); ?>" required /></td>
                                            <td width="20%">
                                                <select name="don_vi_dt" class="don_vi_dt" data-check="<?php echo get_field('don_vi_dt'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn đơn vị</option>
                                                    <option value="vnđ/phòng/đêm">vnđ/phòng/đêm</option>
                                                    <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                                    <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                                                </select>
                                            </td>
                                            <td width="20%"><input type="number" name="tong_dt" class="tong_dt" value="<?php echo get_field('tong_dt'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="center">Gói DV - KM bán</td>
                                            <td colspan="2" align="center">Mã PRO</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="center">
                                                <select name="goi_dv_km_ban_dt" class="goi_dv_km_ban_dt" data-check="<?php echo get_field('goi_dv_km_ban_dt'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn gói DV - KM</option>
                                                    <option value="BB - Ăn sáng">BB - Ăn sáng</option>
                                                    <option value="FB - Ăn 3 bữa">FB - Ăn 3 bữa</option>
                                                    <option value="FBV - Ăn 3 bữa + Vui chơi">FBV - Ăn 3 bữa + Vui chơi</option>
                                                    <option value="FBVS - Ăn 3 bữa + Vui chơi + Safari">FBVS - Ăn 3 bữa + Vui chơi + Safari</option>
                                                </select>
                                            </td>
                                            <td colspan="2" align="center"><input type="text" name="ma_pro_dt" class="ma_pro_dt" value="<?php echo get_field('ma_pro_dt'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center">Dịch vụ đi kèm</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center">
                                                <textarea name="dich_vu_di_kem_dt" class="dich_vu_di_kem_dt"><?php echo get_field('dich_vu_di_kem_dt'); ?></textarea>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>

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
                                            <td width="5%"><input type="number" style="background: #fff;" name="sl_nl" class="sl_nl" value="<?php echo get_field('sl_nl'); ?>" required /></td>
                                            <td width="5%"><input type="number" style="background: #fff;" name="gp" class="gp" value="<?php echo get_field('gp'); ?>" required /></td>
                                            <td width="5%"><input type="number" style="background: #fff;" name="sl02" class="sl02" value="<?php echo get_field('sl02'); ?>" required /></td>
                                            <td width="5%"><input type="number" style="background: #fff;" name="sl24" class="sl24" value="<?php echo get_field('sl24'); ?>" required /></td>
                                            <td width="5%"><input type="number" style="background: #fff;" name="sl46" class="sl46" value="<?php echo get_field('sl46'); ?>" required /></td>
                                            <td width="5%"><input type="number" style="background: #fff;" name="sl612" class="sl612" value="<?php echo get_field('sl612'); ?>" required /></td>
                                            <td width="10%"><input type="number" style="background: #fff;" name="pt_nguoi" class="pt_nguoi" value="<?php echo get_field('pt_nguoi'); ?>" required /></td>
                                            <td width="10%"><input type="number" style="background: #fff;" name="pt_giai_doan" class="pt_giai_doan" value="<?php echo get_field('pt_giai_doan'); ?>" required /></td>
                                            <td width="10%"><input type="number" style="background: #fff;" name="pt_cuoi_tuan" class="pt_cuoi_tuan" value="<?php echo get_field('pt_cuoi_tuan'); ?>" required /></td>
                                            <td width="10%"><input type="text" style="background: #fff;" name="bua_an_bat_buoc" class="bua_an_bat_buoc" value="<?php echo get_field('bua_an_bat_buoc'); ?>" required /></td>
                                            <td width="10%"><input type="text" style="background: #fff;" name="dich_vu_khac" class="dich_vu_khac" value="<?php echo get_field('dich_vu_khac'); ?>" required /></td>
                                            <td width="10%"><input type="number" style="background: #fff;" name="tong_pt" class="tong_pt" value="<?php echo get_field('tong_pt'); ?>" required /></td>
                                            <td><input type="text" style="background: #fff;" name="kh_tt_pt_tai" class="kh_tt_pt_tai" value="<?php echo get_field('kh_tt_pt_tai'); ?>" required /></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="1" style="background: #2e75bd63;">
                                        <tbody>
                                        <tr>
                                            <td rowspan="7">
                                                Danh sách đoàn, yêu cầu khác
                                                <textarea name="danh_sach_doan_yeu_cau_khac" class="danh_sach_doan_yeu_cau_khac"><?php echo get_field('danh_sach_doan_yeu_cau_khac'); ?></textarea>
                                            </td>
                                            <td width="25%">Tiền chưa PT</td>
                                            <td width="25%"><input type="number" width="100%" style="height:24px;" name="tien_chua_pt_khac" class="tien_chua_pt_khac" value="<?php echo get_field('tien_chua_pt_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Tổng phụ thu</td>
                                            <td><input type="number" name="tong_phu_thu_khac" style="height:24px;" class="tong_phu_thu_khac" value="<?php echo get_field('tong_phu_thu_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Giảm giá cho KH</td>
                                            <td><input type="number" name="giam_gia_cho_kh_khac" style="height:24px;" class="giam_gia_cho_kh_khac" value="<?php echo get_field('giam_gia_cho_kh_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Tổng giá trị</td>
                                            <td><input type="number" name="tong_gia_tri_khac" style="height:24px;" class="tong_gia_tri_khac" value="<?php echo get_field('tong_gia_tri_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Đã thanh toán</td>
                                            <td><input type="number" name="da_thanh_toan_khac" style="height:24px;" class="da_thanh_toan_khac" value="<?php echo get_field('da_thanh_toan_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>KH còn nợ</td>
                                            <td><input type="number" name="kh_con_no_khac" style="height:24px;" class="kh_con_no_khac" value="<?php echo get_field('kh_con_no_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Ngày yêu cầu KH hoàn tất TT</td>
                                            <td><input type="text" style="height:24px;" name="ngay_yeu_cau_kh_hoan_tat_tt_khac" data-date-format="dd/mm/yyyy" class="ngay_yeu_cau_kh_hoan_tat_tt_khac datepicker-here" data-language='en' value="<?php echo get_field('ngay_yeu_cau_kh_hoan_tat_tt_khac'); ?>" required /></td>
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
                                                        <input type="number" name="lai_lo_khac" class="lai_lo_khac" style="background: #FFF;" value="<?php echo get_field('lai_lo_khac'); ?>" required />
                                                    </li>
                                                    <li>
                                                        Thuế VAT
                                                        <input type="number" name="thue_vat_khac" class="thue_vat_khac" style="background: #FFF;" value="<?php echo get_field('thue_vat_khac'); ?>" required />
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="background-color: #f19315b3;">
                                                <ul class="price_count">
                                                    <li>
                                                        Thuế TNDN
                                                        <input type="number" name="thue_tndn_khac" class="thue_tndn_khac" style="background: #FFF;" value="<?php echo get_field('thue_tndn_khac'); ?>" required />
                                                    </li>
                                                    <li>
                                                        CP marketing
                                                        <input type="text" name="cp_marketing_khac" class="cp_marketing_khac" style="background: #FFF;" value="<?php echo get_field('cp_marketing_khac'); ?>" required />
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="background-color: #f19315b3;">
                                                <ul class="price_count">
                                                    <li>
                                                        CP hậu cần
                                                        <input type="text" name="cp_hau_can_khac" class="cp_hau_can_khac" style="background: #FFF;" value="<?php echo get_field('cp_hau_can_khac'); ?>" required />
                                                    </li>
                                                    <li>
                                                        CP hậu mãi
                                                        <input type="text" name="cp_hau_mai_khac" class="cp_hau_mai_khac" style="background: #FFF;" value="<?php echo get_field('cp_hau_mai_khac'); ?>" required />
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="background-color: #f19315b3;padding-bottom: 10px;">
                                                CP cố định
                                                <input type="text" name="cp_co_dinh_khac" class="cp_co_dinh_khac" style="background: #FFF;" value="<?php echo get_field('cp_co_dinh_khac'); ?>" required />
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="1" style="background: #2e75bd63;">
                                        <tbody>
                                        <tr>
                                            <td width="25%"><input type="number" name="tien_chua_pt_khac2" class="tien_chua_pt_khac2" value="<?php echo get_field('tien_chua_pt_khac2'); ?>" required /></td>
                                            <td width="25%">Tiền chưa PT</td>
                                            <td width="50%" colspan="2" rowspan="7">
                                                Ghi chú của ĐT
                                                <textarea name="ghi_chu_cua_dt_khac2" class="ghi_chu_cua_dt_khac2"><?php echo get_field('ghi_chu_cua_dt_khac2'); ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" name="tong_phu_thu_khac2" style="height:24px;" class="tong_phu_thu_khac2" value="<?php echo get_field('tong_phu_thu_khac2'); ?>" required /></td>
                                            <td>Tổng phụ thu</td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" name="giam_gia_cua_dt_khac2" style="height:24px;" class="giam_gia_cua_dt_khac2" value="<?php echo get_field('giam_gia_cua_dt_khac2'); ?>" required /></td>
                                            <td>Giảm giá của ĐT</td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" name="tong_gia_tri_khac2" style="height:24px;" class="tong_gia_tri_khac2" value="<?php echo get_field('tong_gia_tri_khac2'); ?>" required /></td>
                                            <td>Tổng giá trị</td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" name="da_thanh_toan_khac2" style="height:24px;" class="da_thanh_toan_khac2" value="<?php echo get_field('da_thanh_toan_khac2'); ?>" required /></td>
                                            <td>Đã thanh toán</td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" name="bct_con_no_khac2" style="height:24px;" class="bct_con_no_khac2" value="<?php echo get_field('bct_con_no_khac2'); ?>" required /></td>
                                            <td>BCT còn nợ</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="ngay_phai_hoan_tat_tt_cho_ks_khac2" style="height:24px;" data-date-format="dd/mm/yyyy" class="ngay_phai_hoan_tat_tt_cho_ks_khac2 datepicker-here" data-language='en' value="<?php echo get_field('ngay_phai_hoan_tat_tt_cho_ks_khac2'); ?>" required ></td>
                                            <td>Ngày phải hoàn tất TT cho KS</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <?php
                            $ten_kgd = get_field('ten_kgd');
                            $nick_kgd = get_field('nick_kgd');
                            $sdt_kgd = get_field('sdt_kgd');
                            $email_kgd_duy_nhat = get_field('email_kgd_duy_nhat');
                            $tk_kgd = get_field('tk_kgd');
                            $ma_kgd = get_field('ma_kgd');
                            $xep_hang_kgd = get_field('xep_hang_kgd');
                            $ma_ctv = get_field('ma_ctv');
                            $ma_nv = get_field('ma_nv');
                            $ma_gd_coc_1 = get_field('ma_gd_coc_1');
                            $tien_coc_1 = get_field('tien_coc_1');
                            $ngay_coc_1 = get_field('ngay_coc_1');
                            $tk_coc_1 = get_field('tk_coc_1');
                            $ma_kho_popup_thong_tin_kho = get_field('ma_kho_popup_thong_tin_kho');
                            $ma_gd_coc_di_2 = get_field('ma_gd_coc_di_2');
                            $tien_coc_di_2 = get_field('tien_coc_di_2');
                            $ngay_phai_coc_di_2 = get_field('ngay_phai_coc_di_2');
                            $tk_coc_di_2 = get_field('tk_coc_di_2');
                            $ma_gd_tt_lan_2_1 = get_field('ma_gd_tt_lan_2_1');
                            $tien_tt_lan_2_1 = get_field('tien_tt_lan_2_1');
                            $ngay_tt_lan_2_1 = get_field('ngay_tt_lan_2_1');
                            $tk_tt_lan_2_1 = get_field('tk_tt_lan_2_1');
                            $sl_lay_tu_kho = get_field('sl_lay_tu_kho');
                            $ma_gd_di_lan_2_2 = get_field('ma_gd_di_lan_2_2');
                            $tien_di_lan_2_2 = get_field('tien_di_lan_2_2');
                            $ngay_phai_di_lan_2_2 = get_field('ngay_phai_di_lan_2_2');
                            $tk_di_lan_2_2 = get_field('tk_di_lan_2_2');
                            $ma_gd_tt_lan_3_1 = get_field('ma_gd_tt_lan_3_1');
                            $tien_tt_lan_3_1 = get_field('tien_tt_lan_3_1');
                            $ngay_tt_lan_3_1 = get_field('ngay_tt_lan_3_1');
                            $tk_tt_lan_3_1 = get_field('tk_tt_lan_3_1');
                            $ma_gd_di_lan_3_2 = get_field('ma_gd_di_lan_3_2');
                            $tien_di_lan_3_2 = get_field('tien_di_lan_3_2');
                            $ngay_phai_di_lan_3_2 = get_field('ngay_phai_di_lan_3_2');
                            $tk_di_lan_3_2 = get_field('tk_di_lan_3_2');
                            $tk_kh_1 = get_field('tk_kh_1');
                            $so_tien_hoan_1 = get_field('so_tien_hoan_1');
                            $ngay_hoan_tien_1 = get_field('ngay_hoan_tien_1');
                            $ma_gd_hoan_tien_1 = get_field('ma_gd_hoan_tien_1');
                            $tk_doi_tac_2 = get_field('tk_doi_tac_2');
                            $so_tien_hoan_2 = get_field('so_tien_hoan_2');
                            $ngay_hoan_tien_2 = get_field('ngay_hoan_tien_2');
                            $ma_gd_hoan_tien_2 = get_field('ma_gd_hoan_tien_2');
                            $ghi_chu_thanh_toan_1 = get_field('ghi_chu_thanh_toan_1');
                            $ghi_chu_thanh_toan_2 = get_field('ghi_chu_thanh_toan_2');
                            ?>
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
                                                <input type="text" style="background: #FFF;" name="ten_kgd" class="ten_kgd" value="<?php echo $ten_kgd; ?>" required />
                                                <div class="popup_get_data_list pop_tenkgd">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="8%">
                                                <input type="text" style="background: #FFF;" name="nick_kgd" class="nick_kgd" value="<?php echo $nick_kgd; ?>" required />
                                                <div class="popup_get_data_list pop_nick_kgd">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="8%">
                                                <input type="number" style="background: #FFF;" name="sdt_kgd" class="sdt_kgd" value="<?php echo $sdt_kgd; ?>" required />
                                                <div class="popup_get_data_list pop_sdt_kgd">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="15%">
                                                <input type="email" style="background: #FFF;" name="email_kgd_duy_nhat" class="email_kgd_duy_nhat" value="<?php echo $email_kgd_duy_nhat; ?>" required />
                                                <div class="popup_get_data_list pop_email_kgd_duy_nhat">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="12%">
                                                <input type="number" style="background: #FFF;" name="tk_kgd" class="tk_kgd" value="<?php echo $tk_kgd; ?>" required />
                                                <div class="popup_get_data_list pop_tk_kgd">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="10%">
                                                <input type="text" style="background: #FFF;" name="ma_kgd" class="ma_kgd" value="<?php echo $ma_kgd; ?>" required />
                                                <div class="popup_get_data_list pop_ma_kgd">
                                                    <ul>
                                                        <li>Tên</li>
                                                        <li>SĐT</li>
                                                        <li>Email</li>
                                                        <li>TK</li>
                                                        <li>Link Facebook</li>
                                                    </ul>
                                                    <div class="list_show">
                                                        <p>Không tìm thấy dữ liệu !</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="10%">
                                                <select name="xep_hang_kgd" class="xep_hang_kgd" style="background: #FFF;" data-check="<?php echo $xep_hang_kgd; ?>" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                            </td>
                                            <td width="10%"><input type="text" name="ma_ctv" style="background: #FFF;" class="ma_ctv" value="<?php echo $ma_ctv; ?>" required /></td>
                                            <td><input type="text" name="ma_nv" class="ma_nv" style="background: #FFF;" value="<?php echo $ma_nv; ?>" required /></td>
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
                                            <td width="25%">Mã GD cọc</td>
                                            <td width="25%">Tiền cọc</td>
                                            <td width="25%">Ngày cọc</td>
                                            <td>TK cọc</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_coc_1" class="ma_gd_coc_1" value="<?php echo $ma_gd_coc_1; ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_coc_1" class="tien_coc_1" value="<?php echo $tien_coc_1; ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_coc_1" data-date-format="dd/mm/yyyy" class="ngay_coc_1 datepicker-here" data-language='en' value="<?php echo $ngay_coc_1; ?>" required /></td>
                                            <td><input type="number" name="tk_coc_1" class="tk_coc_1" value="<?php echo $tk_coc_1; ?>" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;padding-top: 5px;">
                                    Mã Kho (popup thông tin kho)
                                    <input type="text" style="background: #FFF;" name="ma_kho_popup_thong_tin_kho" class="ma_kho_popup_thong_tin_kho" value="<?php echo $ma_kho_popup_thong_tin_kho; ?>" required />
                                </td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">Mã GD cọc đi</td>
                                            <td width="25%">Tiền cọc đi</td>
                                            <td width="25%">Ngày phải cọc đi</td>
                                            <td>TK cọc đi</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_coc_di_2" class="ma_gd_coc_di_2" value="<?php echo $ma_gd_coc_di_2; ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_coc_di_2" class="tien_coc_di_2" value="<?php echo $tien_coc_di_2; ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_phai_coc_di_2" data-date-format="dd/mm/yyyy" class="ngay_phai_coc_di_2 datepicker-here" data-language='en' value="<?php echo $ngay_phai_coc_di_2; ?>" required /></td>
                                            <td><input type="number" name="tk_coc_di_2" class="tk_coc_di_2" value="<?php echo $tk_coc_di_2; ?>" required /></td>
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
                                            <td width="25%">Mã GD TT lần 2</td>
                                            <td width="25%">Tiền TT lần 2</td>
                                            <td width="25%">Ngày TT lần 2</td>
                                            <td>TK TT lần 2</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_tt_lan_2_1" class="ma_gd_tt_lan_2_1" value="<?php echo $ma_gd_tt_lan_2_1; ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_tt_lan_2_1" class="tien_tt_lan_2_1" value="<?php echo $tien_tt_lan_2_1; ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_tt_lan_2_1" data-date-format="dd/mm/yyyy" class="ngay_tt_lan_2_1 datepicker-here" data-language='en' value="<?php echo $ngay_tt_lan_2_1; ?>" required /></td>
                                            <td><input type="number" name="tk_tt_lan_2_1" class="tk_tt_lan_2_1" value="<?php echo $tk_tt_lan_2_1; ?>" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;padding-top: 5px;">
                                    SL lấy từ kho
                                    <input type="number" style="background: #FFF;" name="sl_lay_tu_kho" class="sl_lay_tu_kho" value="<?php echo $sl_lay_tu_kho; ?>" required />
                                </td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">Mã GD đi lần 2</td>
                                            <td width="25%">Tiền đi lần 2</td>
                                            <td width="25%">Ngày phải đi lần 2</td>
                                            <td>TK đi lần 2</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_di_lan_2_2" class="ma_gd_di_lan_2_2" value="<?php echo $ma_gd_di_lan_2_2; ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_di_lan_2_2" class="tien_di_lan_2_2" value="<?php echo $tien_di_lan_2_2; ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_phai_di_lan_2_2" data-date-format="dd/mm/yyyy" class="ngay_phai_di_lan_2_2 datepicker-here" data-language='en' value="<?php echo $ngay_phai_di_lan_2_2; ?>" required /></td>
                                            <td><input type="number" name="tk_di_lan_2_2" class="tk_di_lan_2_2" value="<?php echo $tk_di_lan_2_2; ?>" required /></td>
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
                                            <td width="25%">Mã GD TT lần 3</td>
                                            <td width="25%">Tiền TT lần 3</td>
                                            <td width="25%">Ngày TT lần 3</td>
                                            <td>TK TT lần 3</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_tt_lan_3_1" class="ma_gd_tt_lan_3_1" value="<?php echo $ma_gd_tt_lan_3_1; ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_tt_lan_3_1" class="tien_tt_lan_3_1" value="<?php echo $tien_tt_lan_3_1; ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_tt_lan_3_1" data-date-format="dd/mm/yyyy" class="ngay_tt_lan_3_1 datepicker-here" data-language='en' value="<?php echo $ngay_tt_lan_3_1; ?>" required /></td>
                                            <td><input type="number" name="tk_tt_lan_3_1" class="tk_tt_lan_3_1" value="<?php echo $tk_tt_lan_3_1; ?>" required/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;padding-top: 5px;">&nbsp;</td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">Mã GD đi lần 3</td>
                                            <td width="25%">Tiền đi lần 3</td>
                                            <td width="25%">Ngày phải đi lần 3</td>
                                            <td>TK đi lần 3</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="text" name="ma_gd_di_lan_3_2" class="ma_gd_di_lan_3_2" value="<?php echo $ma_gd_di_lan_3_2; ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_di_lan_3_2" class="tien_di_lan_3_2" value="<?php echo $tien_di_lan_3_2; ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_phai_di_lan_3_2" data-date-format="dd/mm/yyyy" class="ngay_phai_di_lan_3_2 datepicker-here" data-language='en' value="<?php echo $ngay_phai_di_lan_3_2; ?>" required /></td>
                                            <td><input type="number" name="tk_di_lan_3_2" class="tk_di_lan_3_2" value="<?php echo $tk_di_lan_3_2; ?>" required /></td>
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
                                            <td width="25%">TK KH</td>
                                            <td width="25%">Số tiền hoàn</td>
                                            <td width="25%">Ngày hoàn tiền</td>
                                            <td>Mã GD hoàn tiền</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="number" name="tk_kh_1" class="tk_kh_1" value="<?php echo $tk_kh_1; ?>" required /></td>
                                            <td width="25%"><input type="number" name="so_tien_hoan_1" class="so_tien_hoan_1" value="<?php echo $so_tien_hoan_1; ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_hoan_tien_1" data-date-format="dd/mm/yyyy" class="ngay_hoan_tien_1 datepicker-here" data-language='en' value="<?php echo $ngay_hoan_tien_1; ?>" required /></td>
                                            <td><input type="text" name="ma_gd_hoan_tien_1" class="ma_gd_hoan_tien_1" value="<?php echo $ma_gd_hoan_tien_1; ?>" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" style="background-color: #f19315b3;padding-top: 5px;">&nbsp;</td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="25%">TK Đối tác</td>
                                            <td width="25%">Số tiền hoàn</td>
                                            <td width="25%">Ngày hoàn tiền</td>
                                            <td>Mã GD hoàn tiền</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><input type="number" name="tk_doi_tac_2" class="tk_doi_tac_2" value="<?php echo $tk_doi_tac_2; ?>" required /></td>
                                            <td width="25%"><input type="number" name="so_tien_hoan_2" class="so_tien_hoan_2" value="<?php echo $so_tien_hoan_2; ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_hoan_tien_2" data-date-format="dd/mm/yyyy" class="ngay_hoan_tien_2 datepicker-here" data-language='en' value="<?php echo $ngay_hoan_tien_2; ?>" required /></td>
                                            <td><input type="text" name="ma_gd_hoan_tien_2" class="ma_gd_hoan_tien_2" value="<?php echo $ma_gd_hoan_tien_2; ?>" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    Ghi chú thanh toán
                                    <textarea name="ghi_chu_thanh_toan_1" class="ghi_chu_thanh_toan_1"><?php echo $ghi_chu_thanh_toan_1; ?></textarea>
                                </td>
                                <td align="center" style="background-color: #f19315b3;padding-top: 5px;">&nbsp;</td>
                                <td align="center">
                                    Ghi chú thanh toán
                                    <textarea name="ghi_chu_thanh_toan_2" class="ghi_chu_thanh_toan_2"><?php echo $ghi_chu_thanh_toan_2; ?></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="acf-form-submit">
                            <input type="submit" name="sub_new_giao_dich" value="Thêm mới">
                        </div>

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