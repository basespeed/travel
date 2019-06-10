<?php
add_action("wp_ajax_send_mess", "send_mess");
add_action("wp_ajax_nopriv_send_mess", "send_mess");

function send_mess() {
    $tin_nhan_chat = $_POST['tin_nhan_chat'];
    $bo_phan_chat = $_POST['bo_phan_chat'];
    $muc_do_uu_tien_chat = $_POST['muc_do_uu_tien_chat'];
    $trang_thai_chat = $_POST['trang_thai_chat'];
    $ngay_can_nhac_lai_chat = $_POST['ngay_can_nhac_lai_chat'];
    $ma_nhan_vien_chat = $_POST['ma_nhan_vien_chat'];
    $id_chat_gd = $_POST['id_chat_gd'];
    $count_chat = $_POST['count_chat'];
    $reply_chat = $_POST['reply_chat'];
    $id_reply = $_POST['id_reply'];
    $curren_url_chat = $_POST['curren_url_chat'].'#show_chat';

    $update_mess = array(
        'ID'           => $id_chat_gd,
    );

    $post_id_mess = wp_update_post($update_mess);

    update_field( 'trang_thai_chat', 'Đã trả lời', $post_id_mess );

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date('d-m-Y H:i:s');

    //add new chat
    $add_new_chat = array(
        'post_title' => $ma_nhan_vien_chat.'-'.$id_chat_gd,
        'post_status' => 'publish',
        'post_type' => 'chat',
    );

    $post_id = wp_insert_post($add_new_chat);

    add_post_meta($post_id, 'tin_nhan_chat', $tin_nhan_chat, true);
    add_post_meta($post_id, 'id_chat_gd', $id_chat_gd, true);
    add_post_meta($post_id, 'ngay_nhap_vao_chat', $date, true);
    add_post_meta($post_id, 'bo_phan_chat', $bo_phan_chat, true);
    add_post_meta($post_id, 'muc_do_uu_tien_chat', $muc_do_uu_tien_chat, true);
    add_post_meta($post_id, 'button', 'true', true);
    add_post_meta($post_id, 'anh_dai_dien', $_SESSION['avatar'], true);
    if(empty($reply_chat)){
        add_post_meta($post_id, 'trang_thai_chat', $trang_thai_chat, true);
    }else{
        add_post_meta($post_id, 'trang_thai_chat', 'Đã trả lời', true);
    }

    add_post_meta($post_id, 'ngay_can_nhac_lai_chat', $ngay_can_nhac_lai_chat, true);
    add_post_meta($post_id, 'ma_nhan_vien_chat', $ma_nhan_vien_chat, true);
    add_post_meta($post_id, 'count_chat', $count_chat);
    add_post_meta($post_id, 'new_chat_id', $_POST['ma_nhan_vien_chat']);
    add_post_meta($post_id, 'curren_url_chat', $_POST['curren_url_chat']);
    add_post_meta($post_id, 'reply_chat', $reply_chat);
    //add_post_meta($post_id, 'count_chat', $count_chat, true);

    $arr_chat = array(
        'post_type' => 'chat',
        'posts_per_page' => 1,
        'order' => 'DESC'
    );

    $query_chat = new WP_Query($arr_chat);

    if($query_chat->have_posts()) : while ($query_chat->have_posts()) : $query_chat->the_post();
        $count_chat_check = get_field('count_chat');
    endwhile;
    endif;
    wp_reset_postdata();

    //add new chat
    $add_edit_chat = array(
        'post_title' => $ma_nhan_vien_chat,
        'post_status' => 'publish',
        'post_type' => 'note_chat',
    );

    $post_id_note = wp_insert_post($add_edit_chat);

    $url_current = $curren_url_chat;

    $arr_avatar = array(
        'post_type' => 'tai_khoan',
        'posts_per_page' => 6,
        'meta_query'	=> array(
            'relation'		=> 'AND',
            array(
                'key'	 	=> 'email_tai_khoan',
                'value'	  	=> $ma_nhan_vien_chat,
                'compare' 	=> '=',
            ),
        ),
    );

    $query_avatar = new WP_Query($arr_avatar);

    if($query_avatar->have_posts()) : while ($query_avatar->have_posts()) : $query_avatar->the_post();
        $image_avatar = get_field('hinh_anh_tai_khoan');
    endwhile;
    endif;
    wp_reset_postdata();

    add_post_meta($post_id_note, 'email', $ma_nhan_vien_chat, true);
    add_post_meta($post_id_note, 'mess', $tin_nhan_chat, true);
    add_post_meta($post_id_note, 'url', $url_current, true);
    add_post_meta($post_id_note, 'image', $image_avatar, true);

    $data = array();
    array_push($data,$post_id_note);

    $arr_avatar = array(
        'post_type' => 'tai_khoan',
        'posts_per_page' => 6,
        'meta_query'	=> array(
            'relation'		=> 'AND',
            array(
                'key'	 	=> 'email_tai_khoan',
                'value'	  	=> $ma_nhan_vien_chat,
                'compare' 	=> '=',
            ),
        ),
    );

    $query_avatar = new WP_Query($arr_avatar);

    if($query_avatar->have_posts()) : while ($query_avatar->have_posts()) : $query_avatar->the_post();
        $img_a = get_field('hinh_anh_tai_khoan');
        if(!empty($img_a)){
            $img = $img_a;
        }else{
            $img = get_template_directory_uri().'/assets/images/user.jpg';
        }
    endwhile;
    else:
        echo get_template_directory_uri().'/assets/images/user.jpg';
    endif;
    wp_reset_postdata();

    $slt = '';
    $query_bp = get_posts(array(
        'post_type' => 'bo_phan',
    ));
    if( $query_bp ):
        foreach( $query_bp as $bp ):
            $slt .= '<option value="<?php echo $bp->post_title; ?>"><?php echo $bp->post_title; ?></option>';
        endforeach;
    endif;

    $html = '<tr class="show_chat count_chat check_color" data-id="<?php echo $post_id; ?>">';
    $html = '<td width="40%" bgcolor="#EAF8FF">';
    if(!empty($reply_chat)){
        $html = '<span class="reply_chat"><span>'.$reply_chat.'</span></span>';
    }
    $html = '<div class="cmt">';
    $html = '<div class="img"><img src="'.$img.'" alt="avatar"></div>';
    $html = ' <div class="content">Ngày nhập vào :';
    $html = ' <span>'.$date.'</span> # Mã NV :';
    $html = '<span>'.$ma_nhan_vien_chat.'</span> # Lời nhắn :';
    $html = '<span class="tn">'.$tin_nhan_chat.'</span>';
    $html = '</div>';
    $html = '</div>';
    $html = '<p class="edit_mess_tn">';
    $html = '<textarea class="tn" cols="1" rows="1" disabled>'.$tin_nhan_chat.'</textarea>';
    $html = '</p>';
    $html = '</td>';
    $html = '<td width="12%" bgcolor="#EAF8FF">';
    $html = '<select class="bo_phan_chat_mess" data-check="'.$bo_phan_chat.'" disabled>';
    $html = $slt;
    $html = '</select>';
    $html = '</td>';
    $html = '<td width="12%" bgcolor="#EAF8FF">';
    $html = '<select class="muc_do_uu_tien_chat_mess" data-check="'.$muc_do_uu_tien_chat.'" disabled>';
    $html = '<option value="Thông thường" selected>Thông thường</option>';
    $html = '<option value="Luôn và ngay">Luôn và ngay</option>';
    $html = '<option value="Trong ngày">Trong ngày</option>';
    $html = '</select>';
    $html = '</td>';
    $html = '<td width="12%" bgcolor="#EAF8FF"><input type="text" class="trang_thai_chat_mess" value="'.$trang_thai_chat.'" disabled></td>';
    $html = '<td width="12%" bgcolor="#EAF8FF"><input type="text" data-date-format="dd/mm/yyyy" data-position=\'top left\' class="datepicker-here ngay_can_nhac_lai_chat_mess" value="'.$ngay_can_nhac_lai_chat.'" data-language=\'en\' disabled></td>';
    $html = '<td width="12%" bgcolor="#EAF8FF"><p class="change_update_send_mess" data-id="'.get_field('ma_gd_them_booking').'" data-name="'.$ma_nhan_vien_chat.'">';
    $html = '<button type="button" class="btn_edit_chat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>';
    if(empty($reply_chat)){
        $html = '<button type="button" class="reply"><i class="fa fa-reply" aria-hidden="true"></i> Trả lời</button>';
    }
    $html = '</p></td>';
    $html = '</tr>';

    array_push($data,$html);

    wp_send_json_success($data);

    die();
}


add_action("wp_ajax_check_button_reply", "check_button_reply");
add_action("wp_ajax_nopriv_check_button_reply", "check_button_reply");

function check_button_reply() {
    $data_id = $_POST['data_id'];

    $update_mess = array(
        'ID'           => $data_id,
    );

    $post_id = wp_update_post($update_mess);

    update_field( 'button', 'false', $post_id );
    update_field( 'trang_thai_chat', 'Đang trả lời', $post_id );
}


add_action("wp_ajax_load_chat_real_time", "load_chat_real_time");
add_action("wp_ajax_nopriv_load_chat_real_time", "load_chat_real_time");

function load_chat_real_time() {
    $show_chat_id = $_POST['show_chat_id'];
    $count_chat = $_POST['count_chat'];
    $this_user = $_SESSION['mnv'];

    $arr_chat_check = array(
        'post_type' => 'chat',
        'posts_per_page' => 1,
        'order' => 'DESC',
        'meta_key'		=> 'id_chat_gd',
        'meta_value' => '^' . preg_quote( $show_chat_id ),
        'meta_compare' => 'RLIKE',
    );
    $query_chat_check = new WP_Query($arr_chat_check);

    if($query_chat_check->have_posts()) : while ($query_chat_check->have_posts()) : $query_chat_check->the_post();

        /*if(get_field('count_chat') > $count_chat){

        }else{
            echo 'stop';
        }*/
        $arr_chat = array(
            'post_type' => 'chat',
            'posts_per_page' => 6,
            'meta_key'		=> 'id_chat_gd',
            'meta_value' => '^' . preg_quote( $show_chat_id ),
            'meta_compare' => 'RLIKE',
        );

        $query_chat = new WP_Query($arr_chat);
        $this_ID = $show_chat_id;

        ?>
        <tr class="show_chat">
            <td width="40%" align="center" bgcolor="#EAF8FF">Ô nhập lời nhắn</td>
            <td width="12%" align="center" bgcolor="#EAF8FF">Bộ phận</td>
            <td width="12%" align="center" bgcolor="#EAF8FF">Mức độ ưu tiên</td>
            <td width="12%" align="center" bgcolor="#EAF8FF">Trạng thái</td>
            <td width="12%" align="center" bgcolor="#EAF8FF">Ngày cần nhắc lại</td>
            <td width="12%" align="center" bgcolor="#EAF8FF">Nhập</td>
        </tr>
        <?php
        if($query_chat->have_posts()) : while ($query_chat->have_posts()) : $query_chat->the_post();
            if($this_ID == get_field('id_chat_gd')){
                ?>
                <tr class="show_chat count_chat <?php
                if(get_field('ma_nhan_vien_chat') == $_SESSION['mnv']){
                    echo 'check_color';
                }
                ?>" data-id="<?php echo get_the_ID(); ?>" style="width: 100%;order:<?php echo get_field('count_chat'); ?>;" data-count="<?php if(empty(get_field('count_chat'))){echo 0;}else{echo get_field('count_chat');} ?>">
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
                            $get_the_ID = get_the_ID();
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
                    <td width="12%" bgcolor="#EAF8FF"><p class="change_update_send_mess" data-id="<?php echo $get_the_ID; ?>" data-name="<?php echo $ma_nhan_vien_chat; ?>">
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
        endwhile;

        else :
            ?>
            <tr class="show_chat count_chat" data-count="0"><td bgcolor="#EAF8FF" class="empy" colspan="6">Dữ liệu trống !</td></tr>
        <?php
        endif;
        wp_reset_postdata();
    endwhile;
    else :
        ?>
        <tr class="show_chat count_chat" data-count="0"><td bgcolor="#EAF8FF" class="empy" colspan="6">Dữ liệu trống !</td></tr>
        <?php
    endif;
    wp_reset_postdata();

    die();
}


//notifications chat
add_action("wp_ajax_notifications_edit_chat", "notifications_edit_chat");
add_action("wp_ajax_nopriv_notifications_edit_chat", "notifications_edit_chat");


//Thông báo nếu sửa tin nhắn
function notifications_edit_chat(){
    $id_chat = $_POST['id_chat'];
    $name_chat = $_POST['name_chat'];
    $chat_mess = $_POST['chat_mess'];
    $image_avatar = $_POST['avatar'];
    $url_current = $_POST['currentURL'];

    //add new chat
    $add_edit_chat = array(
        'post_title' => $name_chat,
        'post_status' => 'publish',
        'post_type' => 'note_chat',
    );

    $post_id = wp_insert_post($add_edit_chat);

    add_post_meta($post_id, 'email', $name_chat, true);
    add_post_meta($post_id, 'mess', $chat_mess, true);
    add_post_meta($post_id, 'url', $url_current, true);
    add_post_meta($post_id, 'image', $image_avatar, true);

    $query = new WP_Query(array(
        'post_type' => 'note_chat',
        'posts_per_page' => 1,
        'order' => 'DESC'
    ));

    $data = array();
    $data[] = $post_id;
    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        $data[] = get_field('email');
        $data[] = get_field('mess');
        $data[] = get_field('url');
        $data[] = get_field('image');
    endwhile;
    endif;
    wp_reset_postdata();

    wp_send_json_success($data);
}

add_action("wp_ajax_notifications_edit_chat_del", "notifications_edit_chat_del");
add_action("wp_ajax_nopriv_notifications_edit_chat_del", "notifications_edit_chat_del");

//delete notifications
function notifications_edit_chat_del(){
    $id_del = $_POST['id_del'];

    $allposts= get_posts( array('post_type'=>'note_chat','numberposts'=>-1) );
    foreach ($allposts as $eachpost) {
        wp_delete_post( $eachpost->ID, true );
    }

    wp_send_json_success('Đã xóa id : '.$id_del);
}

//Check isset notifications in showing
add_action("wp_ajax_notifications_edit_chat_showing", "notifications_edit_chat_showing");
add_action("wp_ajax_nopriv_notifications_edit_chat_showing", "notifications_edit_chat_showing");

function notifications_edit_chat_showing(){
    $query = new WP_Query(array(
        'post_type' => 'note_chat',
        'posts_per_page' => 1,
        'order' => 'DESC'
    ));

    $data = array();

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        $data[] = get_field('email');
        $data[] = get_field('mess');
        $data[] = get_field('url');
        $data[] = get_field('image');
    endwhile;
    else :
        $data = "stop";
    endif;
    wp_reset_postdata();

    wp_send_json_success($data);
}

//notifications chat
add_action("wp_ajax_load_chat_notifications", "load_chat_notifications");
add_action("wp_ajax_nopriv_load_chat_notifications", "load_chat_notifications");

function load_chat_notifications()
{
    if(isset($_SESSION['sucess'])){
        $show_chat_id = $_POST['show_chat_id'];
        $count_chat = $_POST['count_chat'];
        $this_user = $_POST['ma_nhan_vien_chat'];

        $arr_chat_check = array(
            'post_type' => 'chat',
            'posts_per_page' => 1,
            'order' => 'DESC',
            'meta_key' => 'id_chat_gd',
            'meta_value' => '^' . preg_quote($show_chat_id),
            'meta_compare' => 'RLIKE',
        );
        $query_chat_check = new WP_Query($arr_chat_check);

        $array = array();

        if ($query_chat_check->have_posts()) : while ($query_chat_check->have_posts()) : $query_chat_check->the_post();
            if(get_field('count_chat') > $count_chat){
                $array[] = $_SESSION['avatar'];
                $array[] = get_field('new_chat_id');
                $array[] = get_field('tin_nhan_chat');
                $array[] = get_field('curren_url_chat');
            }else{
                $array[] = 'stop';
            }
        endwhile;
        else :
            $array[] = 'stop';
        endif;
        wp_reset_postdata();

        wp_send_json_success($array);
    }
}


//update chat
add_action("wp_ajax_update_mess", "update_mess");
add_action("wp_ajax_nopriv_update_mess", "update_mess");

function update_mess() {
    $id_chat = $_POST['id_chat'];
    $name_chat = $_POST['name_chat'];
    $chat_mess = $_POST['chat_mess'];
    $bo_phan_chat_mess = $_POST['bo_phan_chat_mess'];
    $muc_do_uu_tien_chat_mess = $_POST['muc_do_uu_tien_chat_mess'];
    $ngay_can_nhac_lai_chat_mess = $_POST['ngay_can_nhac_lai_chat_mess'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date('d-m-Y H:i:s');

    $update_mess = array(
        'ID'           => $id_chat,
        'post_title'   => $name_chat.'-'.$id_chat,
    );

    $post_id = wp_update_post($update_mess);

    update_field( 'tin_nhan_chat', $chat_mess, $post_id );
    update_field( 'bo_phan_chat', $bo_phan_chat_mess, $post_id );
    update_field( 'ngay_nhap_vao_chat', $date, $post_id );
    update_field( 'muc_do_uu_tien_chat', $muc_do_uu_tien_chat_mess, $post_id );
    update_field( 'ngay_can_nhac_lai_chat', $ngay_can_nhac_lai_chat_mess, $post_id );
}

