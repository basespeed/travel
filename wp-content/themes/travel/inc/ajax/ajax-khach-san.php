<?php
add_action("wp_ajax_add_type_room", "add_type_room");
add_action("wp_ajax_nopriv_add_type_room", "add_type_room");

function add_type_room() {
    $data_id = $_POST['data_id'];
    $room_name_ks = $_POST['room_name_ks'];
    $gia_tien_kh = $_POST['gia_tien_kh'];
    $gia_tien_dt = $_POST['gia_tien_dt'];

    $add_room = array(
        'post_title' => $room_name_ks.'_'.$data_id,
        'post_status' => 'publish',
        'post_type' => 'room',
    );

    $post_id = wp_insert_post($add_room);

    add_post_meta($post_id, 'ten_phong', $room_name_ks, true);
    add_post_meta($post_id, 'gia_tien_kh', $gia_tien_kh, true);
    add_post_meta($post_id, 'gia_tien_dt', $gia_tien_dt, true);
    add_post_meta($post_id, 'id_khach_san', $data_id, true);

    $query_room = new WP_Query(array(
        'post_type' => 'room',
        'posts_per_page' => 10,
        'meta_key'		=> 'id_khach_san',
        'meta_value'	=> $data_id,
        'order' => 'DESC'
    ));
    //$html = '';
    if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
        $data .= '<div class="room">';
        $data .= '<div class="content">';
        $data .= '<div class="item">';
        $data .= '<input type="text" value="'.get_field('ten_phong').'" class="item_room_name" data-id="'.get_the_ID().'" disabled>';
        $data .= '</div>';
        $data .= '<div class="item">';
        $data .= '<input type="text" value="'.get_field('gia_tien_kh').'" class="gia_tien_kh" disabled>';
        $data .= '</div>';
        $data .= '<div class="item">';
        $data .= '<input type="text" value="'.get_field('gia_tien_dt').'" class="gia_tien_dt" disabled>';
        $data .= '</div>';
        $data .= '</div>';
        $data .= '<div class="btn">';
        $data .= '<span class="save"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>';
        $data .= '<span class="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>';
        $data .= '<span class="del"><i class="fa fa-times-circle" aria-hidden="true"></i></span>';
        $data .= '</div>';
        $data .= '</div>';
    endwhile;
    endif;
    wp_reset_postdata();

    wp_send_json_success($data);

    die();
}

add_action("wp_ajax_add_type_room_edit", "add_type_room_edit");
add_action("wp_ajax_nopriv_add_type_room_edit", "add_type_room_edit");

function add_type_room_edit() {
    $data_id = $_POST['data_id'];
    $item_room_name = $_POST['item_room_name'];
    $gia_tien_kh = $_POST['gia_tien_kh'];
    $gia_tien_dt = $_POST['gia_tien_dt'];

    $update_type_room = array(
        'ID'           => $data_id,
        'post_title' => $item_room_name.'_'.$data_id,
    );

    $post_update = wp_update_post($update_type_room);

    update_field( 'ten_phong', $item_room_name, $post_update );
    update_field( 'gia_tien_kh', $gia_tien_kh, $post_update );
    update_field( 'gia_tien_dt', $gia_tien_dt, $post_update );

    //wp_send_json_success();

    die();
}

add_action("wp_ajax_add_type_room_del", "add_type_room_del");
add_action("wp_ajax_nopriv_add_type_room_del", "add_type_room_del");

function add_type_room_del() {
    $data_id = $_POST['data_id'];
    $id_firt = $_POST['id_firt'];

    $args = array (
        'post_type' => 'room',
        'nopaging' => true,
        'p' => $data_id
    );
    $query = new WP_Query ($args);
    while ($query->have_posts ()) {
        $query->the_post ();
        $id = $data_id;
        wp_delete_post ($id, true);
    }
    wp_reset_postdata ();

    $query_room = new WP_Query(array(
        'post_type' => 'room',
        'posts_per_page' => 10,
        'order' => 'DESC',
        'meta_key'		=> 'id_khach_san',
        'meta_value'	=> $id_firt
    ));
    //$html = '';
    if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
        $data .= '<div class="room">';
        $data .= '<div class="content">';
        $data .= '<div class="item">';
        $data .= '<input type="text" value="'.get_field('ten_phong').'" class="item_room_name" data-id="'.get_the_ID().'" disabled>';
        $data .= '</div>';
        $data .= '<div class="item">';
        $data .= '<input type="text" value="'.get_field('gia_tien_kh').'" class="gia_tien_kh" disabled>';
        $data .= '</div>';
        $data .= '<div class="item">';
        $data .= '<input type="text" value="'.get_field('gia_tien_dt').'" class="gia_tien_dt" disabled>';
        $data .= '</div>';
        $data .= '</div>';
        $data .= '<div class="btn">';
        $data .= '<span class="save"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>';
        $data .= '<span class="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>';
        $data .= '<span class="del"><i class="fa fa-times-circle" aria-hidden="true"></i></span>';
        $data .= '</div>';
        $data .= '</div>';
    endwhile;
    endif;
    wp_reset_postdata();

    wp_send_json_success($data);

    die();
}


add_action("wp_ajax_add_type_room_booking", "add_type_room_booking");
add_action("wp_ajax_nopriv_add_type_room_booking", "add_type_room_booking");

function add_type_room_booking() {
    $id = $_POST['id'];

    $query_room = new WP_Query(array(
        'post_type' => 'room',
        'meta_key'		=> 'id_khach_san',
        'meta_value'	=> $id,
        'posts_per_page' => 10,
        'order' => 'DESC',
    ));
    //$html = '';
    $count = 1;
    if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
        if($count == 1){
            $data .= '<option value="'.get_field('ten_phong').'" data-price1="'.get_field('gia_tien_kh').'" data-price2="'.get_field('gia_tien_dt').'" selected>'.get_field('ten_phong').'</option>';
        }else{
            $data .= '<option value="'.get_field('ten_phong').'" data-price1="'.get_field('gia_tien_kh').'" data-price2="'.get_field('gia_tien_dt').'" >'.get_field('ten_phong').'</option>';
        }

        $count++;
    endwhile;
    else :
        $data .= '<option>Phòng trống !</option>';
        $data .= '<option value="link" data-link="'.get_permalink($id).'">Thêm phòng</option>';
    endif;
    wp_reset_postdata();

    wp_send_json_success($data);

    die();
}



add_action("wp_ajax_search_hotel", "search_hotel");
add_action("wp_ajax_nopriv_search_hotel", "search_hotel");

function search_hotel() {
    $keyword = $_POST['keyword'];

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'hotel'
                    AND postmeta1.meta_key = 'hotel_name'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 200
                ");

    if($search_query){
        ?>
        <table>
        <tr class="header_edit_hotel_list">
            <td><strong>Status</strong></td>
            <td><strong>Hotel ID</strong></td>
            <td><strong>Hotel name</strong></td>
            <td><strong>Brand name</strong></td>
            <td><strong>Addressline 1</strong></td>
            <td><strong>Zipcode</strong></td>
            <td><strong>City</strong></td>
            <td><strong>State</strong></td>
            <td><strong>Country</strong></td>
            <td><strong>Countryisocode</strong></td>
            <td><strong>Numberrooms</strong></td>
            <td></td>
        </tr>
        <?php
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'hotel'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
                ?>
                <tr>
                    <td><input type="checkbox" name="status_ks" class="status_ks" <?php if(get_field('status_ks') == true){echo 'checked';} ?> data-id="<?php echo get_the_ID(); ?>"></td>
                    <td><?php echo get_field('hotel_id'); ?></td>
                    <td><a class="title"
                           href="<?php the_permalink(); ?>"><?php echo get_field('hotel_name'); ?></a></td>
                    <td><?php echo get_field('brand_name'); ?></td>
                    <td><?php echo get_field('addressline1'); ?></td>
                    <td><?php echo get_field('zipcode'); ?></td>
                    <td><?php echo get_field('city'); ?></td>
                    <td><?php echo get_field('state'); ?></td>
                    <td><?php echo get_field('country'); ?></td>
                    <td><?php echo get_field('countryisocode'); ?></td>
                    <td><?php echo get_field('numberrooms'); ?></td>
                    <td>
                        <a class="edit" href="<?php the_permalink(); ?>"><i
                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a onclick="return confirm('Bạn có chắc muốn xóa nó');" class="delete" href="<?php echo get_delete_post_link(get_the_ID()); ?>"><i
                                class="fa fa-times-circle" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php
            endwhile;
            wp_reset_postdata();
        }
        ?>
        </table>
        <?php
    }else{
        echo 'empty';
    }

    die();
}




add_action("wp_ajax_search_gd", "search_gd");
add_action("wp_ajax_nopriv_search_gd", "search_gd");

function search_gd() {
    $keyword = $_POST['keyword'];

    ?>
    <table>
    <tr>
        <td><strong><a href="#">CODE</a></strong></td>
        <td><strong>MLK</strong></td>
        <td><strong>MGD</strong></td>
        <td><strong>MBK</strong></td>
        <td><strong>Khách đại diện</strong></td>
        <td><strong>Tên Khách sạn</a></strong></td>
        <td><strong>Check-in</strong></td>
        <td><strong>Check-out</strong></td>
        <td><strong>SLP</strong></td>
        <td><strong>Loại phòng</strong></td>
        <td><strong>Hình thức BKK</strong></td>
        <td><strong>Còn nợ KS (cả PT)</strong></td>
        <td><strong>Ngày phải TT hết</strong></td>
        <td><strong>Ghi chú nội bộ</strong></td>
        <td></td>
    </tr>
    <?php

    global $wpdb,$data;
    $keyword = $_POST['keyword'];
    $search_query = $wpdb->get_results("
                SELECT
                    $wpdb->posts.post_title,
                    $wpdb->posts.ID,
                    $wpdb->posts.post_content
                FROM
                    $wpdb->posts,
                    $wpdb->postmeta AS postmeta1
                WHERE
                    $wpdb->posts.ID = postmeta1.post_id
                    AND $wpdb->posts.post_type = 'giao_dich'
                    AND postmeta1.meta_key = 'ma_gd_con'
                    AND postmeta1.meta_value LIKE '%$keyword%'
                    ORDER BY post_date DESC
                    LIMIT 200
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'giao_dich'
            );
            $query_hotel = new WP_Query($args);
            while ($query_hotel->have_posts()) : $query_hotel->the_post();
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
                ?>
                <tr>
                    <td><?php echo get_field('ma_xac_nhan'); ?></td>
                    <td><?php echo get_field('ma_gd_con'); ?></td>
                    <td><?php echo get_field('ma_gd_them_booking'); ?></td>
                    <td><?php echo get_field('ma_gd'); ?></td>
                    <td><?php echo get_field('khach_dai_dien_gd'); ?></td>
                    <td><?php
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
                        ?></td>
                    <td><?php
                        echo $ci_gd;
                        ?></td>
                    <td><?php
                        echo $co_gd;
                        ?></td>
                    <td><?php echo $sl_gd; ?></td>
                    <td><?php echo $loai_phong_ban_dt; ?></td>
                    <td><?php echo $hinh_thuc_book_gd; ?></td>
                    <td><?php
                        $a = $kh_con_no_khac;

                        if (strpos($a, ',') === false) {
                            echo number_format($kh_con_no_khac,'0',',',',');
                        }else{
                            echo $kh_con_no_khac;
                        }
                        ?></td>
                    <td width="10%"><?php echo $ngay_phai_hoan_tat_tt_cho_ks_khac2; ?></td>
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
            wp_reset_postdata();
        }
    }else{
        $search_query = $wpdb->get_results("
                                SELECT
                                    $wpdb->posts.post_title,
                                    $wpdb->posts.ID,
                                    $wpdb->posts.post_content
                                FROM
                                    $wpdb->posts,
                                    $wpdb->postmeta AS postmeta1
                                WHERE
                                    $wpdb->posts.ID = postmeta1.post_id
                                    AND $wpdb->posts.post_type = 'giao_dich'
                                    AND postmeta1.meta_key = 'ma_gd_them_booking'
                                    AND postmeta1.meta_value LIKE '%$keyword%'
                                    ORDER BY post_date DESC
                                    LIMIT 200
                                ");

        if($search_query){
            foreach ($search_query as $data) {
                $id = $data->ID;
                $args = array(
                    'p'         => $id, // ID of a page, post, or custom type
                    'post_type' => 'giao_dich'
                );
                $query_hotel = new WP_Query($args);
                while ($query_hotel->have_posts()) : $query_hotel->the_post();
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
                    ?>
                    <tr>
                        <td><?php echo get_field('ma_xac_nhan'); ?></td>
                        <td><?php echo get_field('ma_gd_con'); ?></td>
                        <td><?php echo get_field('ma_gd_them_booking'); ?></td>
                        <td><?php echo get_field('ma_gd'); ?></td>
                        <td><?php echo get_field('khach_dai_dien_gd'); ?></td>
                        <td><?php
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
                            ?></td>
                        <td><?php
                            echo $ci_gd;
                            ?></td>
                        <td><?php
                            echo $co_gd;
                            ?></td>
                        <td><?php echo $sl_gd; ?></td>
                        <td><?php echo $loai_phong_ban_dt; ?></td>
                        <td><?php echo $hinh_thuc_book_gd; ?></td>
                        <td><?php
                            $a = $kh_con_no_khac;

                            if (strpos($a, ',') === false) {
                                echo number_format($kh_con_no_khac,'0',',',',');
                            }else{
                                echo $kh_con_no_khac;
                            }
                            ?></td>
                        <td width="10%"><?php echo $ngay_phai_hoan_tat_tt_cho_ks_khac2; ?></td>
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
                wp_reset_postdata();
            }
        }else{
            $search_query = $wpdb->get_results("
                            SELECT
                                $wpdb->posts.post_title,
                                $wpdb->posts.ID,
                                $wpdb->posts.post_content
                            FROM
                                $wpdb->posts,
                                $wpdb->postmeta AS postmeta1
                            WHERE
                                $wpdb->posts.ID = postmeta1.post_id
                                AND $wpdb->posts.post_type = 'giao_dich'
                                AND postmeta1.meta_key = 'ma_gd'
                                AND postmeta1.meta_value LIKE '%$keyword%'
                                ORDER BY post_date DESC
                                LIMIT 200
                            ");

            if($search_query){
                foreach ($search_query as $data) {
                    $id = $data->ID;
                    $args = array(
                        'p'         => $id, // ID of a page, post, or custom type
                        'post_type' => 'giao_dich'
                    );
                    $query_hotel = new WP_Query($args);
                    while ($query_hotel->have_posts()) : $query_hotel->the_post();
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
                        ?>
                        <tr>
                            <td><?php echo get_field('ma_xac_nhan'); ?></td>
                            <td><?php echo get_field('ma_gd_con'); ?></td>
                            <td><?php echo get_field('ma_gd_them_booking'); ?></td>
                            <td><?php echo get_field('ma_gd'); ?></td>
                            <td><?php echo get_field('khach_dai_dien_gd'); ?></td>
                            <td><?php
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
                                ?></td>
                            <td><?php
                                echo $ci_gd;
                                ?></td>
                            <td><?php
                                echo $co_gd;
                                ?></td>
                            <td><?php echo $sl_gd; ?></td>
                            <td><?php echo $loai_phong_ban_dt; ?></td>
                            <td><?php echo $hinh_thuc_book_gd; ?></td>
                            <td><?php
                                $a = $kh_con_no_khac;

                                if (strpos($a, ',') === false) {
                                    echo number_format($kh_con_no_khac,'0',',',',');
                                }else{
                                    echo $kh_con_no_khac;
                                }
                                ?></td>
                            <td><?php
                                echo $kh_con_no_khac;
                                ?></td>
                            <td width="10%"><?php echo $ngay_phai_hoan_tat_tt_cho_ks_khac2; ?></td>
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
                    wp_reset_postdata();
                }
            }else{
                $search_query = $wpdb->get_results("
                                        SELECT
                                            $wpdb->posts.post_title,
                                            $wpdb->posts.ID,
                                            $wpdb->posts.post_content
                                        FROM
                                            $wpdb->posts,
                                            $wpdb->postmeta AS postmeta1
                                        WHERE
                                            $wpdb->posts.ID = postmeta1.post_id
                                            AND $wpdb->posts.post_type = 'giao_dich'
                                            AND postmeta1.meta_key = 'khach_dai_dien_gd'
                                            AND postmeta1.meta_value LIKE '%$keyword%'
                                            ORDER BY post_date DESC
                                            LIMIT 200
                                        ");

                if($search_query){
                    foreach ($search_query as $data) {
                        $id = $data->ID;
                        $args = array(
                            'p'         => $id, // ID of a page, post, or custom type
                            'post_type' => 'giao_dich'
                        );
                        $query_hotel = new WP_Query($args);
                        while ($query_hotel->have_posts()) : $query_hotel->the_post();
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
                            ?>
                            <tr>
                                <td><?php echo get_field('ma_xac_nhan'); ?></td>
                                <td><?php echo get_field('ma_gd_con'); ?></td>
                                <td><?php echo get_field('ma_gd_them_booking'); ?></td>
                                <td><?php echo get_field('ma_gd'); ?></td>
                                <td><?php echo get_field('khach_dai_dien_gd'); ?></td>
                                <td><?php
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
                                    ?></td>
                                <td><?php
                                    echo $ci_gd;
                                    ?></td>
                                <td><?php
                                    echo $co_gd;
                                    ?></td>
                                <td><?php echo $sl_gd; ?></td>
                                <td><?php echo $loai_phong_ban_dt; ?></td>
                                <td><?php echo $hinh_thuc_book_gd; ?></td>
                                <td><?php
                                    $a = $kh_con_no_khac;

                                    if (strpos($a, ',') === false) {
                                        echo number_format($kh_con_no_khac,'0',',',',');
                                    }else{
                                        echo $kh_con_no_khac;
                                    }
                                    ?></td>
                                <td><?php
                                    echo $kh_con_no_khac;
                                    ?></td>
                                <td width="10%"><?php echo $ngay_phai_hoan_tat_tt_cho_ks_khac2; ?></td>
                                <td width="12%"><?php
                                    $arr_chat = array(
                                        'post_type' => 'chat',
                                        'posts_per_page' => 1,
                                        'order' => 'DESC',
                                        'meta_key'		=> 'id_chat_gd',
                                        'meta_value' => '^' . preg_quote( $id ),
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
                        wp_reset_postdata();
                    }
                }
            }
        }
    }


    ?>
    </table>
    <?php

    die();
}

add_action("wp_ajax_checkStatusHotel", "checkStatusHotel");
add_action("wp_ajax_nopriv_checkStatusHotel", "checkStatusHotel");

function checkStatusHotel() {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $update_ks = array(
        'ID'           => $id,
    );

    $post_update = wp_update_post($update_ks);

    update_field( 'status_ks', $status, $post_update );
    //wp_send_json_success();

    die();
}

