<?php
/*
 * Template Name: Chat*/

if($_SESSION['sucess'] == "sucess") {

    get_header();

    ?>
    <div id="content" class="edit_giao_dich edit_tai_khoan">
        <div class="quantri_admin">
            <?php include 'inc/template_menu.php'; ?>

            <div class="content_admin">
                <div class="chatbox">
                    <div class="show_chat">
                        <table width="100%" border="1">
                            <tbody>
                            <tr>
                                <td width="40%" align="center" bgcolor="#EAF8FF">Ô nhập lời nhắn</td>
                                <td align="center" bgcolor="#EAF8FF">Bộ phận</td>
                                <td align="center" bgcolor="#EAF8FF">Mức độ ưu tiên</td>
                                <td align="center" bgcolor="#EAF8FF">Trạng thái</td>
                                <td align="center" bgcolor="#EAF8FF">Ngày cần nhắc lại</td>
                            </tr>

                            <?php
                            $query_gd_first = new WP_Query(array(
                                'post_type' => 'giao_dich',
                                'posts_per_page' => 1,
                                'order' => 'DESC'
                            ));

                            if($query_gd_first->have_posts()) : while ($query_gd_first->have_posts()) : $query_gd_first->the_post();
                                $ma_gd_first = get_field('ma_gd');
                            endwhile;
                            endif;

                            $query_chat = new WP_Query(array(
                                'post_type' => 'chat',
                                'posts_per_page' => 5,
                                'meta_key'		=> 'id_chat_gd',
                                'meta_value' => '^' . preg_quote( $ma_gd_first ),
                                'meta_compare' => 'RLIKE',
                            ));
                            if($query_chat->have_posts()) {
                                while ($query_chat->have_posts()) : $query_chat->the_post();
                                    ?>
                                    <tr data-count="<?php if(get_field('count_chat') != ""){echo get_field('count_chat');}else{echo '1';} ?>">
                                        <td bgcolor="#EAF8FF">
                                        <span class="date">
                                            <strong>Ngày nhập vào : </strong><span><?php echo get_field('ngay_nhap_vao_chat'); ?> # </span>
                                        </span>
                                            <span class="mnv">
                                            <strong>Mã NV : </strong><span><?php echo get_field('ma_nhan_vien_chat'); ?> # </span>
                                        </span>
                                            <span class="comment">
                                            <strong>Nội dung : </strong><span><?php echo get_field('tin_nhan_chat'); ?></span>
                                        </span>
                                        </td>
                                        <td bgcolor="#EAF8FF"><?php echo get_field('bo_phan_chat'); ?></td>
                                        <td bgcolor="#EAF8FF"><?php echo get_field('muc_do_uu_tien_chat'); ?></td>
                                        <td bgcolor="#EAF8FF"><?php echo get_field('trang_thai_chat'); ?></td>
                                        <td bgcolor="#EAF8FF"><?php echo get_field('ngay_can_nhac_lai_chat'); ?></td>
                                    </tr>
                                <?php
                                endwhile;
                            }else{
                                ?>
                                <tr data-count="0"><td colspan="5" bgcolor="#EAF8FF" style="text-align: center;">Dữ liệu trống !</td></tr>
                                <?php
                            }
                            wp_reset_postdata();
                            ?>
                            </tbody>
                        </table>

                        <div class="form_chat">
                            <h2>Lời nhắn đến : <span>Mã giao dịch : <?php echo $ma_gd_first; ?></span></h2>
                            <div class="cmt_chat">
                                <textarea type="text" class="mess_cmt" placeholder="Nhập tin nhắn chat ..."></textarea>
                                <button class="send_mess">Gửi tin nhắn</button>
                            </div>
                        </div>

                        <div class="setting_chat">
                            <h2>Tùy chọn</h2>

                            <div class="more">
                                <ul>
                                    <li><input type="text" class="search_gd" placeholder="Tìm kiếm giao dịch" data-bp="<?php echo $_SESSION['bo_phan_tai_khoan']; ?>" data-mnv="<?php
                                        if(isset($_SESSION['lien_ket_tai_khoan'])){
                                            $array = array(
                                                'post_type' => 'nhan_vien',
                                                'meta_key'		=> 'lien_ket_tai_khoan',
                                                'meta_value'	=> $_SESSION['lien_ket_tai_khoan']
                                            );
                                            $query = new WP_Query($array);
                                            if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                                                echo get_field('ma_nv');
                                            endwhile;
                                            endif;
                                            wp_reset_postdata();
                                        }
                                        ?>"></li>
                                    <li>
                                        <select name="slt_search_giao_dich" class="slt_search_giao_dich">
                                            <option value="<?php echo $ma_gd_first; ?>"><?php echo $ma_gd_first; ?></option>
                                        </select>
                                    </li>
                                    <li>
                                        <select name="muc_do_uu_tien_chat" class="muc_do_uu_tien_chat">
                                            <option value="" selected disabled hidden>Chọn mức độ ưu tiên</option>
                                            <option value="Luôn và ngay">Luôn và ngay</option>
                                            <option value="Trong ngày">Trong ngày</option>
                                        </select>
                                    </li>
                                    <li>
                                        <input type="text" placeholder="Ngày cần nhắc lại" data-date-format="dd/mm/yyyy" class='datepicker-here ngay_can_nhac_lai_chat' data-language='en'>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="my_friend">
                        <h2>Mọi người đang online</h2>
                        <div class="list_user_on">

                            <?php
                            $query = new WP_Query(array(
                                'post_type' => 'tai_khoan',
                                'posts_per_page' => 14 ,
                                'order' => 'ASC',
                            ));
                            $query2 = new WP_Query(array(
                                'post_type' => 'tai_khoan',
                                'posts_per_page' => 14 ,
                                'order' => 'ASC',
                            ));

                            if($query->have_posts()) :
                                echo '<ul>';
                                echo '<li data-name="Giao dịch"><span><i class="fa fa-users" aria-hidden="true"></i> Giao dịch</span> <span style="background: green !important;"></span></li>';
                                while ($query->have_posts()) : $query->the_post();
                                    if(get_field('ten_biet_danh_tai_khoan') != $_SESSION['name']) {
                                        if(get_field('check_online') == "on"){
                                            ?>
                                            <li data-name="<?php echo get_field("ten_biet_danh_tai_khoan"); ?>">
                                                <?php
                                                if(!empty(get_field('hinh_anh_tai_khoan'))){
                                                    echo '<div class="img"><img src="'.get_field('hinh_anh_tai_khoan').'" alt="Ảnh đại diện" /></div>';
                                                }
                                                ?>
                                                <span><?php echo get_field('ten_biet_danh_tai_khoan'); ?></span>
                                                <?php
                                                if (get_field('check_online') == "off" || get_field('check_online') == "") {
                                                    ?>
                                                    <span class='off'></span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span style='background-color: green !important;'></span>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                            <?php
                                        }
                                    }
                                endwhile;
                                echo '</ul>';

                                echo '<ul>';
                                while ($query2->have_posts()) : $query2->the_post();
                                    if(get_field('ten_biet_danh_tai_khoan') != $_SESSION['name']) {
                                        if(get_field('check_online') != "on"){
                                            ?>
                                            <li data-name="<?php echo get_field("ten_biet_danh_tai_khoan"); ?>">
                                                <?php
                                                if(!empty(get_field('hinh_anh_tai_khoan'))){
                                                    echo '<div class="img"><img src="'.get_field('hinh_anh_tai_khoan').'" alt="Ảnh đại diện" /></div>';
                                                }
                                                ?>
                                                <span><?php echo get_field('ten_biet_danh_tai_khoan'); ?></span>
                                                <?php
                                                if (get_field('check_online') == "off" || get_field('check_online') == "") {
                                                    ?>
                                                    <span class='off'></span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span style='background-color: green !important;'></span>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                            <?php
                                        }
                                    }
                                endwhile;
                                echo '</ul>';
                            endif;
                            wp_reset_postdata();
                            ?>

                        </div>
                        <input type="text" class="search_user_chat" placeholder="Tìm kiếm tài khoản ...">
                    </div>
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