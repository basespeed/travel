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
    $data = '';
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
    $data = '';
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

    $data = '';

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
                    }?>">Tên Khách sạn</a>/
                    <a href="<?php
                    echo get_home_url('/');
                    ?>/giao-dich/?sort=<?php
                    if($_GET['sort'] == 'slp'){
                        echo 'slp_desc';
                    }else{
                        echo 'slp';
                    }?>">SLP</a>
                    &ensp;-&ensp;
                    <a href="<?php
                    echo get_home_url('/');
                    ?>/giao-dich/?sort=<?php
                    if($_GET['sort'] == 'lp'){
                        echo 'lp_desc';
                    }else{
                        echo 'lp';
                    }?>"> Loại phòng <?php
                        if(isset($_GET['sort']) && $_GET['sort'] == 'tks'){
                            echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                        }elseif(isset($_GET['sort']) && $_GET['sort'] == 'tks_desc'){
                            echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                        }elseif(isset($_GET['sort']) && $_GET['sort'] == 'slp'){
                            echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                        }elseif(isset($_GET['sort']) && $_GET['sort'] == 'slp_desc'){
                            echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                        }elseif(isset($_GET['sort']) && $_GET['sort'] == 'lp'){
                            echo '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>';
                        }elseif(isset($_GET['sort']) && $_GET['sort'] == 'lp_desc'){
                            echo '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>';
                        }
                        ?>
                    </a>
                </strong>
            </td>
            <td>
                <strong>
                    Gói DV - KM - DV đi kèm
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
            <td><strong>TT BKK KH/ĐT</strong></td>
            <td></td>
        </tr>
    <?php

    global $data;
    $key_mgd = $_POST['key_mgd'];
    $key_mbk = $_POST['key_mbk'];
    $key_mlk = $_POST['key_mlk'];
    $key_code = $_POST['key_code'];
    $key_tks = $_POST['key_tks'];

    $key_day = $_POST['key_day'];

    $key_month = $_POST['key_month'];

    $key_year = $_POST['key_year'];

    $key_check_date = $_POST['key_check_date'];

    if($key_check_date == 'Check-in'){
        $check_date = 'ci_gd';
    }elseif($key_check_date == 'Check-out'){
        $check_date = 'co_gd';
    }

    var_dump($key_year.$key_month.$key_day);

    $day_current = date('d');
    $month_current = date('m');
    $year_current = date('Y');

    if(!empty($key_mgd) || !empty($key_mbk) || !empty($key_mlk) || !empty($key_code) || !empty($key_tks) || !empty($key_day) || !empty($key_month) || !empty($key_year)){
        $posts = new WP_Query(array(
            'numberposts'	=> -1,
            'post_type'		=> 'hotel',
            'meta_query'	=> array(
                'relation'		=> 'OR',
                array(
                    'key'		=> 'hotel_name',
                    'value'		=> $key_tks,
                    'compare'	=> 'LIKE'
                ),
            )
        ));

        while ($posts->have_posts()) : $posts->the_post();
            $hotel_id = get_the_ID();
        endwhile;
        wp_reset_postdata();

        if(!empty($key_mgd)){
            $meta_query = array(
                'relation'		=> 'OR',
                array(
                    'key'		=> 'ma_gd_them_booking',
                    'value'		=> $key_mgd,
                    'compare'	=> 'LIKE'
                ),
            ) ;
        }elseif(!empty($key_mbk)){
            $meta_query = array(
                'relation'		=> 'OR',
                array(
                    'key'		=> 'ma_gd',
                    'value'		=> $key_mbk,
                    'compare'	=> 'LIKE'
                ),
            ) ;
        }elseif(!empty($key_mlk)){
            $meta_query = array(
                'relation'		=> 'OR',
                array(
                    'key'		=> 'key_mlk',
                    'value'		=> $key_mlk,
                    'compare'	=> 'LIKE'
                ),
            ) ;
        }elseif(!empty($key_code)){
            $meta_query = array(
                'relation'		=> 'OR',
                array(
                    'key'		=> 'ma_xac_nhan',
                    'value'		=> $key_code,
                    'compare'	=> 'LIKE'
                ),
            ) ;
        }elseif(!empty($key_tks)){
            $meta_query = array(
                'relation'		=> 'OR',
                array(
                    'key'		=> 'ten_khach_san_gd',
                    'value'		=> $hotel_id,
                    'compare'	=> '='
                ),
            ) ;
        }elseif(!empty($key_day)){
            $meta_query = array(
                'relation'		=> 'AND',
                array(
                    'key' => $check_date,
                    'value' => '201901'.$key_day,
                    'compare' => '>=',
                ),
                array(
                    'key' => $check_date,
                    'value' => '205012'.$key_day,
                    'compare' => '<=',
                ),
            ) ;
        }elseif(!empty($key_month)){
            $meta_query = array(
                'relation'		=> 'AND',
                array(
                    'key' => $check_date,
                    'value' => '2019'.$key_month.'01',
                    'compare' => '>=',
                ),
                array(
                    'key' => $check_date,
                    'value' => '2050'.$key_month.'12',
                    'compare' => '<=',
                ),
            );
        }elseif(!empty($key_year)){
            $meta_query = array(
                'relation'		=> 'AND',
                array(
                    'key' => $check_date,
                    'value' => $key_year.'0101',
                    'compare' => '>=',
                ),
                array(
                    'key' => $check_date,
                    'value' => $key_year.'1231',
                    'compare' => '<=',
                ),
            ) ;
        }elseif(!empty($key_year) && !empty($key_month)){
            $meta_query = array(
                'relation'		=> 'AND',
                array(
                    'key' => $check_date,
                    'value' => $key_year.$key_month.'01',
                    'compare' => '>=',
                ),
                array(
                    'key' => $check_date,
                    'value' => $key_year.$key_month.'31',
                    'compare' => '<=',
                ),
            ) ;
        }elseif(!empty($key_year) && !empty($key_day)){
            $meta_query = array(
                'relation'		=> 'AND',
                array(
                    'key' => $check_date,
                    'value' => $key_year.'01'.$key_day,
                    'compare' => '>=',
                ),
                array(
                    'key' => $check_date,
                    'value' => $key_year.'12'.$key_day,
                    'compare' => '<=',
                ),
            ) ;
        }elseif(!empty($key_month) && !empty($key_day)){
            $meta_query = array(
                'relation'		=> 'AND',
                array(
                    'key' => $check_date,
                    'value' => '20190816',
                    'compare' => '>=',
                ),
                array(
                    'key' => $check_date,
                    'value' => '20190831',
                    'compare' => '<=',
                ),
            ) ;
        }elseif(!empty($key_month) && !empty($key_day) && !empty($key_year)){
            $meta_query = array(
                'relation'		=> 'OR',
                array(
                    'key' => 'co_gd',
                    'value' => $key_year.$key_month.$key_day,
                    'compare' => '=',
                ),
            ) ;
        }else{
            $meta_query = array(
                'relation'		=> 'OR',
                array(
                    'key'		=> 'ma_gd_them_booking',
                    'value'		=> $key_mgd,
                    'compare'	=> 'LIKE'
                ),
                array(
                    'key'		=> 'ma_gd',
                    'value'		=> $key_mbk,
                    'compare'	=> 'LIKE'
                ),
                array(
                    'key'		=> 'key_mlk',
                    'value'		=> $key_mlk,
                    'compare'	=> 'LIKE'
                ),
                array(
                    'key'		=> 'ma_xac_nhan',
                    'value'		=> $key_code,
                    'compare'	=> 'LIKE'
                ),
                array(
                    'key'		=> 'ten_khach_san_gd',
                    'value'		=> $hotel_id,
                    'compare'	=> '='
                ),
                array(
                    'key' => $check_date,
                    'value' => $key_year.$key_month.$key_day,
                    'compare' => '=',
                ),
            );
        }

        $args = array(
            'post_type' => 'giao_dich',
            'order' => 'DESC',
            'posts_per_page' => 50,
            'meta_query'	=> $meta_query
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

                    echo '<strong>'.$sl_gd.'</strong> - '.$loai_phong_ban_dt;
                    ?>
                </td>
                <td><?php echo $goi_dv_km_ban_gd; ?></td>
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

                <td><?php
                    echo '<strong>'.$trang_thai_bkk_voi_kh_gd.'</strong>';
                    echo '<br>';
                    echo $trang_thai_bkk_voi_dt;
                    ?></td>
                <td>
                    <a class="edit" href="<?php echo $the_permalink; ?>"><i
                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </td>
            </tr>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
        </table>
        <?php
    }

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

