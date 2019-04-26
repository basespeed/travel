<div id="content" class="<?php if(isset($_GET['view'])){echo "view_fix";} ?>">
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
                <div class="them_giao_dich">
                    <form action="<?php echo get_the_permalink(); ?>" method="post">
                        <?php
                        if(isset($_POST['sub_edit_giao_dich'])){
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $date = date('d-m-Y H:i:s');

                            $this_ma_dich_vu_gd = get_field('ma_dich_vu_gd');
                            $this_ma_dt = get_field('ma_dt');
                            $this_ma_gd = get_field('ma_gd');
                            $this_ma_xac_nhan = get_field('ma_xac_nhan');
                            $this_ma_pro_dt = get_field('ma_pro_dt');
                            $this_ma_kgd = get_field('ma_kgd');
                            $this_ma_gd_hoan_tien_1 = get_field('ma_gd_hoan_tien_1');
                            $this_ma_gd_hoan_tien_2 = get_field('ma_gd_hoan_tien_2');
                            $this_ID = get_the_ID();

                            $array_gd = array(
                                'post_type' => 'giao_dich',
                                'post_status' => 'publish'
                            );

                            $query = new WP_Query($array_gd);

                            if ($query->have_posts()) {
                                while ($query->have_posts()) : $query->the_post();
                                    if (get_field('ma_gd') == $_POST['ma_gd'] and $this_ma_gd != $_POST['ma_gd']) {
                                        $alert = "<p class='alert_tk_fail'>Mã giao dịch đã tồn tại !</p>";
                                    }elseif (get_field('ma_xac_nhan') == $_POST['ma_xac_nhan'] and $this_ma_xac_nhan != $_POST['ma_xac_nhan']) {
                                        $alert = "<p class='alert_tk_fail'>Mã xác nhận đã tồn tại !</p>";
                                    }elseif (get_field('ma_pro_dt') == $_POST['ma_pro_dt'] and $this_ma_pro_dt != $_POST['ma_pro_dt']) {
                                        $alert = "<p class='alert_tk_fail'>Mã pro đã tồn tại !</p>";
                                    }elseif (get_field('ma_kgd') == $_POST['ma_kgd'] and $this_ma_kgd != $_POST['ma_kgd']) {
                                        $alert = "<p class='alert_tk_fail'>Mã giao dịch hoàn tiền khách đã tồn tại !</p>";
                                    }elseif (get_field('ma_gd_hoan_tien_2') == $_POST['ma_gd_hoan_tien_2'] and $this_ma_gd_hoan_tien_2 != $_POST['ma_gd_hoan_tien_2']) {
                                        $alert = "<p class='alert_tk_fail'>Mã giao dịch hoàn tiền đối tác đã tồn tại !</p>";
                                    }
                                endwhile;
                                wp_reset_postdata();
                            }

                            if(! isset($alert)){
                                $update_giao_dich = array(
                                    'ID'           => $this_ID,
                                    'post_title' => $_POST['ten_khach_san_gd'],
                                );

                                $post_update = wp_update_post($update_giao_dich);

                                $group_ID = '6';
                                $fields = acf_get_fields($group_ID);
                                foreach ($fields as $field){
                                    if($field['name'] != ""){
                                        update_field( $field['name'], $_POST[$field['name']], $post_update );
                                    }
                                }
                            }

                            if(isset($alert)){
                                echo '<p class="alert">'.$alert.'</p>';
                            }else{
                                echo $alert = "<p class='alert_tk_sucess'>Cập nhập giao dịch thành công !</p>";
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
                            add_post_meta($post_lich_su_gd, 'hanh_dong', 'Sửa giao dịch', true);
                            add_post_meta($post_lich_su_gd, 'thoi_gian_sua', $date, true);

                            //echo "<meta http-equiv='refresh' content='0'>";
                        }
                        ?>

                        <table width="100%" border="1">
                            <tbody>
                            <tr>
                                <td width="45%">
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="80%">Tên Khách sạn - Tên dịch vụ</td>
                                            <td>Mã dịch vụ</td>
                                        </tr>
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
                                                        <option value="<?php echo get_field('ten_ks'); ?>" data-id="<?php echo get_field('ma_ks'); ?>"><?php echo get_field('ten_ks'); ?></option>
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
                                            <td width="50%"><input type="text" name="noi_di_gd" class="noi_di_gd" value="<?php echo get_field('noi_di_gd'); ?>" required /></td>
                                            <td><input type="text" name="noi_den_gd" class="noi_den_gd" value="<?php echo get_field('noi_den_gd'); ?>" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center">Các mã GD con hoặc mã GD liên quan: bao gồm tất cả các mã GD hoặc mã
                                    GD con. Khi tìm theo mã thì tìm cả trong cả 2 trường
                                </td>
                                <td width="45%">
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="80%">Tên ĐT gửi book - Đối tác gửi book có thể trùng hoặc khác
                                                với Đối tác cung cấp dịch vụ
                                            </td>
                                            <td>Mã ĐT</td>
                                        </tr>
                                        <tr>
                                            <td width="80%"><input type="text" name="ten_dt_gui_book_dt" class="ten_dt_gui_book_dt" value="<?php echo get_field('ten_dt_gui_book_dt'); ?>" required /></td>
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
                                            <td width="50%"><input type="text" name="noi_di_dt" class="noi_di_dt" value="<?php echo get_field('noi_di_dt'); ?>" required /></td>
                                            <td><input type="text" name="noi_den_dt" class="noi_den_dt" value="<?php echo get_field('noi_den_dt'); ?>" required /></td>
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
                                            <td width="40%"><input type="text" name="khach_dai_dien_gd" class="khach_dai_dien_gd" value="<?php echo get_field('khach_dai_dien_gd'); ?>" required /></td>
                                            <td width="20%"><input type="number" name="sdt_gd" class="sdt_gd" value="<?php echo get_field('sdt_gd'); ?>" required /></td>
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
                                <td align="center">
                                    <strong>Mã GD</strong>
                                    <input type="text" name="ma_gd" class="ma_gd" value="<?php echo get_field('ma_gd'); ?>" required />
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
                                <td align="center">
                                    Hình thức book
                                    <input type="text" name="hinh_thuc_book_gd" class="hinh_thuc_book_gd" value="<?php echo get_field('hinh_thuc_book_gd'); ?>" required/">
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
                                            <td width="40%">Loại phòng bán</td>
                                            <td width="10%">SL</td>
                                            <td width="20%">Đơn giá bán</td>
                                            <td width="10%">Đơn vị</td>
                                            <td>Tổng</td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <select name="loai_phong_ban_gd" class="loai_phong_ban_gd" data-check="<?php echo get_field('loai_phong_ban_gd'); ?>" required>
                                                    <option value="Phòng đơn">Phòng đơn</option>
                                                    <option value="Phòng đôi">Phòng đôi</option>
                                                    <option value="Homestay">Homestay</option>
                                                </select>
                                            </td>
                                            <td width="10%"><input type="number" name="sl_gd" class="sl_gd" value="<?php echo get_field('sl_gd'); ?>" required /></td>
                                            <td width="20%"><input type="number" name="don_gia_ban_gd" class="don_gia_ban_gd" value="<?php echo get_field('don_gia_ban_gd'); ?>" required /></td>
                                            <td width="10%">
                                                <select name="don_vi_gd" class="don_vi_gd" data-check="<?php echo get_field('don_vi_gd'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn đơn vị</option>
                                                    <option value="vnđ/phòng/đêm">vnđ/phòng/đêm</option>
                                                    <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                                    <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                                                </select>
                                            </td>
                                            <td><input type="number" name="tong_gd" class="tong_gd" value="<?php echo get_field('tong_gd'); ?>" required /></td>
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
                                <td align="center">
                                    Mã xác nhận
                                    <input type="text" name="ma_xac_nhan" class="ma_xac_nhan" value="<?php echo get_field('ma_xac_nhan'); ?>" required/>
                                </td>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="40%">Loại phòng bán</td>
                                            <td width="10%">SL</td>
                                            <td width="20%">Đơn giá bán</td>
                                            <td width="10%">Đơn vị</td>
                                            <td>Tổng</td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <select name="loai_phong_ban_dt" class="loai_phong_ban_dt" data-check="<?php echo get_field('loai_phong_ban_dt'); ?>" required>
                                                    <option value="Phòng đơn">Phòng đơn</option>
                                                    <option value="Phòng đôi">Phòng đôi</option>
                                                    <option value="Homestay">Homestay</option>
                                                </select>
                                            </td>
                                            <td width="10%"><input type="number" name="sl_dt" class="sl_dt" value="<?php echo get_field('sl_dt'); ?>" required /></td>
                                            <td width="20%"><input type="number" name="don_gia_ban_dt" class="don_gia_ban_dt" value="<?php echo get_field('don_gia_ban_dt'); ?>" required /></td>
                                            <td width="10%">
                                                <select name="don_vi_dt" class="don_vi_dt" data-check="<?php echo get_field('don_vi_dt'); ?>" required>
                                                    <option value="" selected disabled hidden>Chọn đơn vị</option>
                                                    <option value="vnđ/phòng/đêm">vnđ/phòng/đêm</option>
                                                    <option value="vnđ/căn/đêm">vnđ/căn/đêm</option>
                                                    <option value="vnđ/villa/đêm">vnđ/villa/đêm</option>
                                                </select>
                                            </td>
                                            <td><input type="number" name="tong_dt" class="tong_dt" value="<?php echo get_field('tong_dt'); ?>" required /></td>
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
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
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
                                            <td width="5%"><input type="number" name="sl_nl" class="sl_nl" value="<?php echo get_field('sl_nl'); ?>" required /></td>
                                            <td width="5%"><input type="number" name="gp" class="gp" value="<?php echo get_field('gp'); ?>" required /></td>
                                            <td width="5%"><input type="number" name="sl02" class="sl02" value="<?php echo get_field('sl02'); ?>" required /></td>
                                            <td width="5%"><input type="number" name="sl24" class="sl24" value="<?php echo get_field('sl24'); ?>" required /></td>
                                            <td width="5%"><input type="number" name="sl46" class="sl46" value="<?php echo get_field('sl46'); ?>" required /></td>
                                            <td width="5%"><input type="number" name="sl612" class="sl612" value="<?php echo get_field('sl612'); ?>" required /></td>
                                            <td width="10%"><input type="number" name="pt_nguoi" class="pt_nguoi" value="<?php echo get_field('pt_nguoi'); ?>" required /></td>
                                            <td width="10%"><input type="number" name="pt_giai_doan" class="pt_giai_doan" value="<?php echo get_field('pt_giai_doan'); ?>" required /></td>
                                            <td width="10%"><input type="number" name="pt_cuoi_tuan" class="pt_cuoi_tuan" value="<?php echo get_field('pt_cuoi_tuan'); ?>" required /></td>
                                            <td width="10%"><input type="text" name="bua_an_bat_buoc" class="bua_an_bat_buoc" value="<?php echo get_field('bua_an_bat_buoc'); ?>" required /></td>
                                            <td width="10%"><input type="text" name="dich_vu_khac" class="dich_vu_khac" value="<?php echo get_field('dich_vu_khac'); ?>" required /></td>
                                            <td width="10%"><input type="number" name="tong_pt" class="tong_pt" value="<?php echo get_field('tong_pt'); ?>" required /></td>
                                            <td><input type="text" name="kh_tt_pt_tai" class="kh_tt_pt_tai" value="<?php echo get_field('kh_tt_pt_tai'); ?>" required /></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="100%" align="center">Lý giải PT</td>
                                        </tr>
                                        <tr>
                                            <td width="100%" align="center"><textarea name="ly_giai_pt" class="ly_giai_pt"><?php echo get_field('ly_giai_pt'); ?></textarea></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td rowspan="7">
                                                Danh sách đoàn, yêu cầu khác
                                                <textarea name="danh_sach_doan_yeu_cau_khac" class="danh_sach_doan_yeu_cau_khac"><?php echo get_field('danh_sach_doan_yeu_cau_khac'); ?></textarea>
                                            </td>
                                            <td width="25%">Tiền chưa PT</td>
                                            <td width="25%"><input type="number" name="tien_chua_pt_khac" class="tien_chua_pt_khac" value="<?php echo get_field('tien_chua_pt_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Tổng phụ thu</td>
                                            <td><input type="number" name="tong_phu_thu_khac" class="tong_phu_thu_khac" value="<?php echo get_field('tong_phu_thu_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Giảm giá cho KH</td>
                                            <td><input type="number" name="giam_gia_cho_kh_khac" class="giam_gia_cho_kh_khac" value="<?php echo get_field('giam_gia_cho_kh_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Tổng giá trị</td>
                                            <td><input type="number" name="tong_gia_tri_khac" class="tong_gia_tri_khac" value="<?php echo get_field('tong_gia_tri_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Đã thanh toán</td>
                                            <td><input type="number" name="da_thanh_toan_khac" class="da_thanh_toan_khac" value="<?php echo get_field('da_thanh_toan_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>KH còn nợ</td>
                                            <td><input type="number" name="kh_con_no_khac" class="kh_con_no_khac" value="<?php echo get_field('kh_con_no_khac'); ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Ngày yêu cầu KH hoàn tất TT</td>
                                            <td><input type="text" name="ngay_yeu_cau_kh_hoan_tat_tt_khac" data-date-format="dd/mm/yyyy" class="ngay_yeu_cau_kh_hoan_tat_tt_khac datepicker-here" data-language='en' value="<?php echo get_field('ngay_yeu_cau_kh_hoan_tat_tt_khac'); ?>" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center">
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td align="center">
                                                Lãi/Lỗ
                                                <input type="number" name="lai_lo_khac" class="lai_lo_khac" value="<?php echo get_field('lai_lo_khac'); ?>" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                Thuế VAT
                                                <input type="number" name="thue_vat_khac" class="thue_vat_khac" value="<?php echo get_field('thue_vat_khac'); ?>" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                Thuế TNDN
                                                <input type="number" name="thue_tndn_khac" class="thue_tndn_khac" value="<?php echo get_field('thue_tndn_khac'); ?>" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                CP marketing
                                                <input type="text" name="cp_marketing_khac" class="cp_marketing_khac" value="<?php echo get_field('cp_marketing_khac'); ?>" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                CP hậu cần
                                                <input type="text" name="cp_hau_can_khac" class="cp_hau_can_khac" value="<?php echo get_field('cp_hau_can_khac'); ?>" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                CP hậu mãi
                                                <input type="text" name="cp_hau_mai_khac" class="cp_hau_mai_khac" value="<?php echo get_field('cp_hau_mai_khac'); ?>" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                CP cố định
                                                <input type="text" name="cp_co_dinh_khac" class="cp_co_dinh_khac" value="<?php echo get_field('cp_co_dinh_khac'); ?>" required />
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="1">
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
                                            <td><input type="number" name="tong_phu_thu_khac2" class="tong_phu_thu_khac2" value="<?php echo get_field('tong_phu_thu_khac2'); ?>" required /></td>
                                            <td>Tổng phụ thu</td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" name="giam_gia_cua_dt_khac2" class="giam_gia_cua_dt_khac2" value="<?php echo get_field('giam_gia_cua_dt_khac2'); ?>" required /></td>
                                            <td>Giảm giá của ĐT</td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" name="tong_gia_tri_khac2" class="tong_gia_tri_khac2" value="<?php echo get_field('tong_gia_tri_khac2'); ?>" required /></td>
                                            <td>Tổng giá trị</td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" name="da_thanh_toan_khac2" class="da_thanh_toan_khac2" value="<?php echo get_field('da_thanh_toan_khac2'); ?>" required /></td>
                                            <td>Đã thanh toán</td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" name="bct_con_no_khac2" class="bct_con_no_khac2" value="<?php echo get_field('bct_con_no_khac2'); ?>" required /></td>
                                            <td>BCT còn nợ</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="ngay_phai_hoan_tat_tt_cho_ks_khac2" data-date-format="dd/mm/yyyy" class="ngay_phai_hoan_tat_tt_cho_ks_khac2 datepicker-here" data-language='en' value="<?php echo get_field('ngay_phai_hoan_tat_tt_cho_ks_khac2'); ?>" required ></td>
                                            <td>Ngày phải hoàn tất TT cho KS</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <table width="100%" border="1">
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
                                            <td width="15%"><input type="text" name="ten_kgd" class="ten_kgd" value="<?php echo get_field('ten_kgd'); ?>" required /></td>
                                            <td width="8%"><input type="text" name="nick_kgd" class="nick_kgd" value="<?php echo get_field('nick_kgd'); ?>" required /></td>
                                            <td width="8%"><input type="number" name="sdt_kgd" class="sdt_kgd" value="<?php echo get_field('sdt_kgd'); ?>" required /></td>
                                            <td width="15%"><input type="email" name="email_kgd_duy_nhat" class="email_kgd_duy_nhat" value="<?php echo get_field('email_kgd_duy_nhat'); ?>" required /></td>
                                            <td width="12%"><input type="number" name="tk_kgd" class="tk_kgd" value="<?php echo get_field('tk_kgd'); ?>" required /></td>
                                            <td width="10%"><input type="text" name="ma_kgd" class="ma_kgd" value="<?php echo get_field('ma_kgd'); ?>" required /></td>
                                            <td width="10%">
                                                <select name="xep_hang_kgd" class="xep_hang_kgd" data-check="<?php echo get_field('xep_hang_kgd'); ?>" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                            </td>
                                            <td width="10%"><input type="text" name="ma_ctv" class="ma_ctv" value="<?php echo get_field('ma_ctv'); ?>" required /></td>
                                            <td><input type="text" name="ma_nv" class="ma_nv" value="<?php echo get_field('ma_nv'); ?>" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%" border="1">
                                        <tbody>
                                        <tr>
                                            <td width="40%" align="center" bgcolor="#EAF8FF">Ô nhập lời nhắn</td>
                                            <td align="center" bgcolor="#EAF8FF">Bộ phận</td>
                                            <td align="center" bgcolor="#EAF8FF">Mức độ ưu tiên</td>
                                            <td align="center" bgcolor="#EAF8FF">Trạng thái</td>
                                            <td align="center" bgcolor="#EAF8FF">Ngày cần nhắc lại</td>
                                            <td align="center" bgcolor="#EAF8FF">Nhập</td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#EAF8FF">Ngày nhập vào # Mã NV # Lời nhắn mới nhất</td>
                                            <td bgcolor="#EAF8FF">Bộ phận</td>
                                            <td bgcolor="#EAF8FF">Mức độ ưu tiên</td>
                                            <td bgcolor="#EAF8FF">Đang xử lý</td>
                                            <td bgcolor="#EAF8FF">Ngày cần nhắc lại</td>
                                            <td bgcolor="#EAF8FF"><p>Update</p></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#EAF8FF">...</td>
                                            <td bgcolor="#EAF8FF">...</td>
                                            <td bgcolor="#EAF8FF">...</td>
                                            <td bgcolor="#EAF8FF">...</td>
                                            <td bgcolor="#EAF8FF">...</td>
                                            <td bgcolor="#EAF8FF">Update</td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#EAF8FF">Ngày nhập vào # Mã NV # Lời nhắn cũ nhất</td>
                                            <td bgcolor="#EAF8FF">Bộ phận</td>
                                            <td bgcolor="#EAF8FF">Mức độ ưu tiên</td>
                                            <td bgcolor="#EAF8FF">Đã chờ</td>
                                            <td bgcolor="#EAF8FF">Ngày cần nhắc lại</td>
                                            <td bgcolor="#EAF8FF">Update</td>
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
                                            <td width="25%"><input type="text" name="ma_gd_coc_1" class="ma_gd_coc_1" value="<?php echo get_field('ma_gd_coc_1'); ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_coc_1" class="tien_coc_1" value="<?php echo get_field('tien_coc_1'); ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_coc_1" data-date-format="dd/mm/yyyy" class="ngay_coc_1 datepicker-here" data-language='en' value="<?php echo get_field('ngay_coc_1'); ?>" required /></td>
                                            <td><input type="number" name="tk_coc_1" class="tk_coc_1" value="<?php echo get_field('tk_coc_1'); ?>" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center">
                                    Mã Kho (popup thông tin kho)
                                    <input type="text" name="ma_kho_popup_thong_tin_kho" class="ma_kho_popup_thong_tin_kho" value="<?php echo get_field('ma_kho_popup_thong_tin_kho'); ?>" required />
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
                                            <td width="25%"><input type="text" name="ma_gd_coc_di_2" class="ma_gd_coc_di_2" value="<?php echo get_field('ma_gd_coc_di_2'); ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_coc_di_2" class="tien_coc_di_2" value="<?php echo get_field('tien_coc_di_2'); ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_phai_coc_di_2" data-date-format="dd/mm/yyyy" class="ngay_phai_coc_di_2 datepicker-here" data-language='en' value="<?php echo get_field('ngay_phai_coc_di_2'); ?>" required /></td>
                                            <td><input type="number" name="tk_coc_di_2" class="tk_coc_di_2" value="<?php echo get_field('tk_coc_di_2'); ?>" required /></td>
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
                                            <td width="25%"><input type="text" name="ma_gd_tt_lan_2_1" class="ma_gd_tt_lan_2_1" value="<?php echo get_field('ma_gd_tt_lan_2_1'); ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_tt_lan_2_1" class="tien_tt_lan_2_1" value="<?php echo get_field('tien_tt_lan_2_1'); ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_tt_lan_2_1" data-date-format="dd/mm/yyyy" class="ngay_tt_lan_2_1 datepicker-here" data-language='en' value="<?php echo get_field('ngay_tt_lan_2_1'); ?>" required /></td>
                                            <td><input type="number" name="tk_tt_lan_2_1" class="tk_tt_lan_2_1" value="<?php echo get_field('tk_tt_lan_2_1'); ?>" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center">
                                    SL lấy từ kho
                                    <input type="number" name="sl_lay_tu_kho" class="sl_lay_tu_kho" value="<?php echo get_field('sl_lay_tu_kho'); ?>" required />
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
                                            <td width="25%"><input type="text" name="ma_gd_di_lan_2_2" class="ma_gd_di_lan_2_2" value="<?php echo get_field('ma_gd_di_lan_2_2'); ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_di_lan_2_2" class="tien_di_lan_2_2" value="<?php echo get_field('tien_di_lan_2_2'); ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_phai_di_lan_2_2" data-date-format="dd/mm/yyyy" class="ngay_phai_di_lan_2_2 datepicker-here" data-language='en' value="<?php echo get_field('ngay_phai_di_lan_2_2'); ?>" required /></td>
                                            <td><input type="number" name="tk_di_lan_2_2" class="tk_di_lan_2_2" value="<?php echo get_field('tk_di_lan_2_2'); ?>" required /></td>
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
                                            <td width="25%"><input type="text" name="ma_gd_tt_lan_3_1" class="ma_gd_tt_lan_3_1" value="<?php echo get_field('ma_gd_tt_lan_3_1'); ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_tt_lan_3_1" class="tien_tt_lan_3_1" value="<?php echo get_field('tien_tt_lan_3_1'); ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_tt_lan_3_1" data-date-format="dd/mm/yyyy" class="ngay_tt_lan_3_1 datepicker-here" data-language='en' value="<?php echo get_field('ngay_tt_lan_3_1'); ?>" required /></td>
                                            <td><input type="number" name="tk_tt_lan_3_1" class="tk_tt_lan_3_1" value="<?php echo get_field('tk_tt_lan_3_1'); ?>" required/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center">&nbsp;</td>
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
                                            <td width="25%"><input type="text" name="ma_gd_di_lan_3_2" class="ma_gd_di_lan_3_2" value="<?php echo get_field('ma_gd_di_lan_3_2'); ?>" required /></td>
                                            <td width="25%"><input type="number" name="tien_di_lan_3_2" class="tien_di_lan_3_2" value="<?php echo get_field('tien_di_lan_3_2'); ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_phai_di_lan_3_2" data-date-format="dd/mm/yyyy" class="ngay_phai_di_lan_3_2 datepicker-here" data-language='en' value="<?php echo get_field('ngay_phai_di_lan_3_2'); ?>" required /></td>
                                            <td><input type="number" name="tk_di_lan_3_2" class="tk_di_lan_3_2" value="<?php echo get_field('tk_di_lan_3_2'); ?>" required /></td>
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
                                            <td width="25%"><input type="number" name="tk_kh_1" class="tk_kh_1" value="<?php echo get_field('tk_kh_1'); ?>" required /></td>
                                            <td width="25%"><input type="number" name="so_tien_hoan_1" class="so_tien_hoan_1" value="<?php echo get_field('so_tien_hoan_1'); ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_hoan_tien_1" data-date-format="dd/mm/yyyy" class="ngay_hoan_tien_1 datepicker-here" data-language='en' value="<?php echo get_field('ngay_hoan_tien_1'); ?>" required /></td>
                                            <td><input type="text" name="ma_gd_hoan_tien_1" class="ma_gd_hoan_tien_1" value="<?php echo get_field('ma_gd_hoan_tien_1'); ?>" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center">&nbsp;</td>
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
                                            <td width="25%"><input type="number" name="tk_doi_tac_2" class="tk_doi_tac_2" value="<?php echo get_field('tk_doi_tac_2'); ?>" required /></td>
                                            <td width="25%"><input type="number" name="so_tien_hoan_2" class="so_tien_hoan_2" value="<?php echo get_field('so_tien_hoan_2'); ?>" required /></td>
                                            <td width="25%"><input type="text" name="ngay_hoan_tien_2" data-date-format="dd/mm/yyyy" class="ngay_hoan_tien_2 datepicker-here" data-language='en' value="<?php echo get_field('ngay_hoan_tien_2'); ?>" required /></td>
                                            <td><input type="text" name="ma_gd_hoan_tien_2" class="ma_gd_hoan_tien_2" value="<?php echo get_field('ma_gd_hoan_tien_2'); ?>" required /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    Ghi chú thanh toán
                                    <textarea name="ghi_chu_thanh_toan_1" class="ghi_chu_thanh_toan_1"><?php echo get_field('ghi_chu_thanh_toan_1'); ?></textarea>
                                </td>
                                <td align="center">&nbsp;</td>
                                <td align="center">
                                    Ghi chú thanh toán
                                    <textarea name="ghi_chu_thanh_toan_2" class="ghi_chu_thanh_toan_2"><?php echo get_field('ghi_chu_thanh_toan_2'); ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Nút chia nhỏ một booking để tạo 1 booking mới từ booking gốc</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="acf-form-submit">
                            <input type="submit" name="sub_edit_giao_dich" value="Cập nhập">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
