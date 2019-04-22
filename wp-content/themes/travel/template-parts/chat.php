<?php
/*
 * Template Name: Chat*/

if($_SESSION['sucess'] == "sucess") {

    get_header();

    ?>
    <div id="content" class="edit_giao_dich edit_tai_khoan">
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
                                <td align="center" bgcolor="#EAF8FF">Nhập</td>
                            </tr>
                            <tr>
                                <td bgcolor="#EAF8FF">
                                    <div class="date">
                                        <strong>- Thời gian : </strong><span><?php
                                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                                            echo $date = date('d-m-Y H:i:s');
                                            ?></span>
                                    </div>
                                    <div class="mnv">
                                        <strong>- Mã nhân viên : </strong><span><?php
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
                                            ?></span>
                                    </div>
                                    <div class="comment">
                                        <strong>- Nội dung : </strong><span>Lời nhắn mới nhất</span>
                                    </div>
                                </td>
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
                    </div>

                    <div class="my_friend">
                        <h2>Mọi người đang online</h2>
                        <ul>
                            <?php
                                $query = new WP_Query(array(
                                   'post_type' => 'tai_khoan',
                                   'posts_per_page' => 5 ,
                                ));

                                if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                                ?>
                                    <li><span><?php echo get_field('ten_biet_danh_tai_khoan'); ?></span> <?php
                                        if(get_field('check_online') == "off"){
                                            ?><span class="off"></span><?php
                                        }else{
                                            ?><span></span><?php
                                        }
                                    ?></li>
                                <?php
                                endwhile;
                                endif;
                            ?>

                        </ul>
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