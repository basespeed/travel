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


