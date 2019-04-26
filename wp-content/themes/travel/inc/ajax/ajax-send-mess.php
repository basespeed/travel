<?php
add_action("wp_ajax_search_gd", "search_gd");
add_action("wp_ajax_nopriv_search_gd", "search_gd");

function search_gd() {
    if(isset($_POST['input_gd_val'])){
        $input_gd_val = $_POST['input_gd_val'];

        $query = new WP_Query(array(
            'post_type' => 'giao_dich',
            'posts_per_page' => 5,
            'meta_key'		=> 'ma_gd',
            'meta_value' => '^' . preg_quote( $input_gd_val ),
            'meta_compare' => 'RLIKE',
        ));

        if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            $data[] = get_field('ma_gd');
            $data[] = get_the_ID();
        endwhile;
        endif;
        wp_reset_postdata();

        wp_send_json_success($data);
    }
    die();
}


add_action("wp_ajax_send_mess", "send_mess");
add_action("wp_ajax_nopriv_send_mess", "send_mess");

function send_mess() {
    $slt_search_giao_dich = $_POST['slt_search_giao_dich'];
    $muc_do_uu_tien_chat = $_POST['muc_do_uu_tien_chat'];
    $ngay_can_nhac_lai_chat = $_POST['ngay_can_nhac_lai_chat'];
    $slt_search_giao_dich_attr = $_POST['slt_search_giao_dich_attr'];
    $mess_cmt = $_POST['mess_cmt'];
    $mnv = $_POST['mnv'];
    $count_chat_number = $_POST['count_chat_number'];

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date('d-m-Y H:i:s');

    //add new chat
    $add_new_chat = array(
        'post_title' => $slt_search_giao_dich,
        'post_status' => 'publish',
        'post_type' => 'chat',
    );

    $post_id = wp_insert_post($add_new_chat);

    add_post_meta($post_id, 'tin_nhan_chat', $mess_cmt, true);
    add_post_meta($post_id, 'id_chat_gd', $slt_search_giao_dich, true);
    add_post_meta($post_id, 'ngay_nhap_vao_chat', $date, true);
    add_post_meta($post_id, 'bo_phan_chat', $_SESSION['bo_phan_tai_khoan'], true);
    add_post_meta($post_id, 'muc_do_uu_tien_chat', $muc_do_uu_tien_chat, true);
    add_post_meta($post_id, 'trang_thai_chat', 'Đang chờ', true);
    add_post_meta($post_id, 'ngay_can_nhac_lai_chat', $ngay_can_nhac_lai_chat, true);
    add_post_meta($post_id, 'ma_nhan_vien_chat', $mnv, true);
    add_post_meta($post_id, 'count_chat', $count_chat_number, true);

    die();
}

add_action("wp_ajax_screen_gd_chat", "screen_gd_chat");
add_action("wp_ajax_nopriv_screen_gd_chat", "screen_gd_chat");

function screen_gd_chat() {
    $id_gd = $_POST['id_gd'];
    $mnv = $_POST['mnv'];

    $query = new WP_Query(array(
        'post_type' => 'chat',
        'posts_per_page' => 10,
        'meta_key'		=> 'id_chat_gd',
        'meta_value' => '^' . preg_quote( $mnv ),
        'meta_compare' => 'RLIKE',
    ));

    $data_count = $query->post_count;

    $html .= '<tbody>';
    $html .= '<tr>';
    $html .= '<td width="40%" align="center" bgcolor="#EAF8FF">Ô nhập lời nhắn</td>';
    $html .= '<td align="center" bgcolor="#EAF8FF">Bộ phận</td>';
    $html .= '<td align="center" bgcolor="#EAF8FF">Mức độ ưu tiên</td>';
    $html .= '<td align="center" bgcolor="#EAF8FF">Trạng thái</td>';
    $html .= '<td align="center" bgcolor="#EAF8FF">Ngày cần nhắc lại</td>';
    $html .= '</tr>';

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        $html .= '<tr data-count="'.get_field('count_chat').'">';
            $html .= '<td bgcolor="#EAF8FF">';
                $html .= '<span class="date">';
                    $html .= '<strong>Ngày nhập vào : </strong><span>'.get_field('ngay_nhap_vao_chat').' # </span>';

                    $html .= '<span class="mnv">';
                        $html .= '<strong>Mã NV : </strong><span>'.get_field('ma_nhan_vien_chat').' # </span>';
                    $html .= '</span>';

                    $html .= '<span class="comment">';
                        $html .= '<strong>Nội dung : </strong><span>'.get_field('tin_nhan_chat').'</span>';
                    $html .= '</span>';
                $html .= '</span>';
            $html .= '</td>';

            $html .= '<td bgcolor="#EAF8FF">'.get_field('bo_phan_chat').'</td>';
            $html .= '<td bgcolor="#EAF8FF">'.get_field('muc_do_uu_tien_chat').'</td>';
            $html .= '<td bgcolor="#EAF8FF">'.get_field('trang_thai_chat').'</td>';
            $html .= '<td bgcolor="#EAF8FF">'.get_field('ngay_can_nhac_lai_chat').'</td>';
        $html .= '</tr>';
    endwhile;
    else:
        $html .= '<tr data-count="0"><td colspan="5" bgcolor="#EAF8FF" style="text-align: center;">Dữ liệu trống !</td></tr>';
    endif;
    wp_reset_postdata();

    $html .= '</tbody>';

    wp_send_json_success($html);

    die();
}



