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
    add_post_meta($post_id, 'trang_thai_chat', $trang_thai_chat, true);
    add_post_meta($post_id, 'ngay_can_nhac_lai_chat', $ngay_can_nhac_lai_chat, true);
    add_post_meta($post_id, 'ma_nhan_vien_chat', $ma_nhan_vien_chat, true);
    add_post_meta($post_id, 'count_chat', $count_chat);
    add_post_meta($post_id, 'new_chat_id', $_POST['ma_nhan_vien_chat']);
    add_post_meta($post_id, 'curren_url_chat', $_POST['curren_url_chat']);

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

    die();
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
            'posts_per_page' => 3,
            'meta_key'		=> 'id_chat_gd',
            'meta_value' => '^' . preg_quote( $show_chat_id ),
            'meta_compare' => 'RLIKE',
        );

        $query_chat = new WP_Query($arr_chat);
        $this_ID = $show_chat_id;

        if($query_chat->have_posts()) : while ($query_chat->have_posts()) : $query_chat->the_post();
            if($this_ID == get_field('id_chat_gd')){
                ?>
                <tr class="show_chat count_chat" data-count="<?php if(empty(get_field('count_chat'))){echo 0;}else{echo get_field('count_chat');} ?>">
                    <td bgcolor="#EAF8FF">Ngày nhập vào : <span><?php echo get_field('ngay_nhap_vao_chat'); ?></span> # Mã NV :  <span><?php echo get_field('ma_nhan_vien_chat'); ?></span> # Lời nhắn mới nhất : <span class="tn"><?php echo get_field('tin_nhan_chat'); ?></span>
                        <p class="edit_mess_tn"><textarea class="tn" cols="1" rows="1" disabled><?php echo get_field('tin_nhan_chat'); ?></textarea></p>
                    </td>
                    <td bgcolor="#EAF8FF">
                        <select class="bo_phan_chat_mess" data-check="<?php echo get_field('bo_phan_chat'); ?>" disabled>
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
                    <td bgcolor="#EAF8FF">
                        <select class="muc_do_uu_tien_chat_mess" data-check="<?php echo get_field('muc_do_uu_tien_chat'); ?>" disabled>
                            <option value="" selected disabled hidden>Chọn mức độ ưu tiên</option>
                            <option value="Luôn và ngay">Luôn và ngay</option>
                            <option value="Trong ngày">Trong ngày</option>
                        </select>
                    </td>
                    <td bgcolor="#EAF8FF"><input type="text" class="trang_thai_chat_mess" value="<?php echo get_field('trang_thai_chat'); ?>" disabled></td>
                    <td bgcolor="#EAF8FF"><input type="text" data-date-format="dd/mm/yyyy" data-position='top left' class="datepicker-here ngay_can_nhac_lai_chat_mess" value="<?php echo get_field('ngay_can_nhac_lai_chat'); ?>" data-language='en' disabled></td>
                    <td bgcolor="#EAF8FF"><p class="change_update_send_mess" data-id="<?php echo get_the_ID(); ?>" data-name="<?php echo get_field('ma_nhan_vien_chat'); ?>">
                            <?php
                            if($this_user == get_field('ma_nhan_vien_chat')){
                                ?>
                                <button type="button" class="btn_edit_chat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                <?php
                            }
                            ?>
                        </p></td>
                </tr>
                <?php
            }
        endwhile;

            $arr_chat_count = array(
                'post_type' => 'chat',
                'posts_per_page' => 1,
                'order' => 'DESC',
                'meta_key'		=> 'id_chat_gd',
                'meta_value' => '^' . preg_quote( $show_chat_id ),
                'meta_compare' => 'RLIKE',
            );
            $query_chat_count = new WP_Query($arr_chat_count);
            if($query_chat_count->have_posts()) : while ($query_chat_count->have_posts()) : $query_chat_count->the_post();
                if(get_field('count_chat') > 3){
                    ?>
                    <tr class="show_chat">
                        <td bgcolor="#EAF8FF">...</td>
                        <td bgcolor="#EAF8FF">...</td>
                        <td bgcolor="#EAF8FF">...</td>
                        <td bgcolor="#EAF8FF">...</td>
                        <td bgcolor="#EAF8FF">...</td>
                        <td bgcolor="#EAF8FF">...</td>
                    </tr>
                    <?php
                    $arr_chat_late = array(
                        'post_type' => 'chat',
                        'posts_per_page' => 1,
                        'order' => 'ASC',
                        'meta_key'		=> 'id_chat_gd',
                        'meta_value' => '^' . preg_quote( $show_chat_id ),
                        'meta_compare' => 'RLIKE',
                    );

                    $query_chat_late = new WP_Query($arr_chat_late);

                    if($query_chat_late->have_posts()) : while ($query_chat_late->have_posts()) : $query_chat_late->the_post();
                        if($this_ID == get_field('id_chat_gd')){
                            ?>
                            <tr class="show_chat count_chat" data-count="<?php if(empty(get_field('count_chat'))){echo 0;}else{echo get_field('count_chat');} ?>">
                                <td bgcolor="#EAF8FF">Ngày nhập vào : <span><?php echo get_field('ngay_nhap_vao_chat'); ?></span> # Mã NV :  <span><?php echo get_field('ma_nhan_vien_chat'); ?></span> # Lời nhắn cũ nhất : <span class="tn"><?php echo get_field('tin_nhan_chat'); ?></span>
                                    <p class="edit_mess_tn"><textarea class="tn" cols="1" rows="1" disabled><?php echo get_field('tin_nhan_chat'); ?></textarea></p>
                                </td>
                                <td bgcolor="#EAF8FF">
                                    <select class="bo_phan_chat_mess" data-check="<?php echo get_field('bo_phan_chat'); ?>" disabled>
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
                                <td bgcolor="#EAF8FF">
                                    <select class="muc_do_uu_tien_chat_mess" data-check="<?php echo get_field('muc_do_uu_tien_chat'); ?>" disabled>
                                        <option value="" selected disabled hidden>Chọn mức độ ưu tiên</option>
                                        <option value="Luôn và ngay">Luôn và ngay</option>
                                        <option value="Trong ngày">Trong ngày</option>
                                    </select>
                                </td>
                                <td bgcolor="#EAF8FF"><input type="text" class="trang_thai_chat_mess" value="<?php echo get_field('trang_thai_chat'); ?>" disabled></td>
                                <td bgcolor="#EAF8FF"><input type="text" data-date-format="dd/mm/yyyy" data-position='top left' class="datepicker-here ngay_can_nhac_lai_chat_mess" value="<?php echo get_field('ngay_can_nhac_lai_chat'); ?>" data-language='en' disabled></td>
                                <td bgcolor="#EAF8FF"><p class="change_update_send_mess" data-id="<?php echo get_the_ID(); ?>" data-name="<?php echo get_field('ma_nhan_vien_chat'); ?>">
                                        <?php
                                        if($this_user == get_field('ma_nhan_vien_chat')){
                                            ?>
                                            <button type="button" class="btn_edit_chat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                            <?php
                                        }
                                        ?>
                                    </p></td>
                            </tr>
                            <?php
                        }
                    endwhile;
                    endif;
                    wp_reset_postdata();
                }
            endwhile;
            endif;
            wp_reset_postdata();

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

