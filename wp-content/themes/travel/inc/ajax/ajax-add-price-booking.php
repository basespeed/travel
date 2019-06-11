<?php
add_action("wp_ajax_add_price_booking", "add_price_booking");
add_action("wp_ajax_nopriv_add_price_booking", "add_price_booking");

function add_price_booking() {
    $ma_kgd = $_POST['ma_kgd'];
    $ma_dt = $_POST['ma_dt'];
    $ma_ctv = $_POST['ma_ctv'];
    $ma_nv = $_POST['ma_nv'];

    $add_ma_gd_coc = $_POST['add_ma_gd_coc'];
    $add_ma_gd_coc_di = $_POST['add_ma_gd_coc_di'];
    $add_tien_coc = $_POST['add_tien_coc'];
    if(!empty($add_tien_coc)){
        $add_tien_coc = str_replace(',','',$add_tien_coc);
    }else{
        $add_tien_coc = 0;
    }

    $add_ngay_coc = $_POST['add_ngay_coc'];
    $add_tk_coc = $_POST['add_tk_coc'];
    $add_tien_coc_di = $_POST['add_tien_coc_di'];
    if(!empty($add_tien_coc_di)){
        $add_tien_coc_di = str_replace(',','',$add_tien_coc_di);
    }else{
        $add_tien_coc_di = 0;
    }

    $add_ngay_phai_coc_di = $_POST['add_ngay_phai_coc_di'];
    $add_tk_coc_di = $_POST['add_tk_coc_di'];
    $ma_gd_them_booking = $_POST['ma_gd_them_booking'];

    $add_new_giao_dich = array(
        'post_status' => 'publish',
        'post_type' => 'tien',
    );

    $post_id = wp_insert_post($add_new_giao_dich);

    if(!empty($ma_gd_them_booking)){
        add_post_meta($post_id, 'id_gd', $ma_gd_them_booking, true);
    }

    if(!empty($add_ma_gd_coc)){
        add_post_meta($post_id, 'ma_gd_coc', $add_ma_gd_coc, true);
    }

    if(!empty($add_ma_gd_coc_di)){
        add_post_meta($post_id, 'ma_gd_coc_di', $add_ma_gd_coc_di, true);
    }

    if(!empty($add_tien_coc)){
        add_post_meta($post_id, 'tien_coc', $add_tien_coc, true);
    }

    if(!empty($add_tk_coc)){
        add_post_meta($post_id, 'tk_coc', $add_tk_coc, true);
    }

    if(!empty($add_tien_coc_di)){
        add_post_meta($post_id, 'tien_coc_di', $add_tien_coc_di, true);
    }

    if(!empty($add_tk_coc_di)){
        add_post_meta($post_id, 'tk_coc_di', $add_tk_coc_di, true);
    }

    if(!empty($ma_kgd)){
        add_post_meta($post_id, 'id_khach_hang', $ma_kgd, true);
    }

    if(!empty($ma_dt)){
        add_post_meta($post_id, 'id_doi_tac', $ma_dt, true);
    }

    if(!empty($ma_ctv)){
        add_post_meta($post_id, 'id_ctv', $ma_ctv, true);
    }

    if(!empty($ma_nv)){
        add_post_meta($post_id, 'id_nv', $ma_nv, true);
    }

    if(!empty($add_ngay_coc)){
        $date = DateTime::createFromFormat('d/m/Y', $add_ngay_coc);
        $date = $date->format('Ymd');
        update_field('ngay_coc', $date, $post_id);
    }

    if(!empty($add_ngay_phai_coc_di)){
        $date2 = DateTime::createFromFormat('d/m/Y', $add_ngay_phai_coc_di);
        $date2 = $date2->format('Ymd');
        update_field('ngay_phai_coc_di', $date2, $post_id);
    }

    wp_reset_postdata();
    $array_data = array();

    $data1 = '';
    $data1 .= '<div class="item" data-price="'.$add_tien_coc.'" data-id="'.$post_id.'">';
    $data1 .= '<table width="100%" border="1">';
    $data1 .= '<tbody>';
    $data1 .= '<tr>';
    $data1 .= '<td width="25%"><input type="text" name="ma_gd_coc_di" class="ma_gd_coc_di" value="'.$add_ma_gd_coc.'" autocomplete="off" /></td>';
    $data1 .= '<td width="25%"><input type="text" name="tien_coc_di" class="tien_coc_di" value="'.$add_tien_coc.'" autocomplete="off" /></td>';
    $data1 .= '<td width="25%"><input type="text" name="ngay_phai_coc_di" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_phai_coc_di datepicker-here" data-language="en" value="'.$add_ngay_coc.'" autocomplete="off" /></td>';
    $data1 .= '<td width="25%"><input type="number" name="tk_coc_di" class="tk_coc_di" value="'.$add_tk_coc.'" autocomplete="off" /></td>';
    $data1 .= '</tr>';
    $data1 .= '</tbody>';
    $data1 .= '</table>';
    $data1 .= '</div>';

    array_push($array_data,$data1);

    $data2 = '';
    $data2 .= '<div class="item" data-price="'.$add_tien_coc_di.'">';
    $data2 .= '<table width="100%" border="1">';
    $data2 .= '<tbody>';
    $data2 .= '<tr>';
    $data2 .= '<td width="25%"><input type="text" name="ma_gd_coc_di" class="ma_gd_coc_di" value="'.$add_ma_gd_coc_di.'" autocomplete="off" /></td>';
    $data2 .= '<td width="25%"><input type="text" name="tien_coc_di" class="tien_coc_di" value="'.$add_tien_coc_di.'" autocomplete="off" /></td>';
    $data2 .= '<td width="25%"><input type="text" name="ngay_phai_coc_di" data-date-format="dd/mm/yyyy" data-position="top left" class="ngay_phai_coc_di datepicker-here" data-language="en" value="'.$add_ngay_phai_coc_di.'" autocomplete="off" /></td>';
    $data2 .= '<td width="25%"><input type="number" name="tk_coc_di" class="tk_coc_di" value="'.$add_tk_coc_di.'" autocomplete="off" /></td>';
    $data2 .= '</tr>';
    $data2 .= '</tbody>';
    $data2 .= '</table>';
    $data2 .= '</div>';

    array_push($array_data,$data2);

    wp_send_json_success($array_data);

    die();
}

add_action("wp_ajax_load_price_booking", "load_price_booking");
add_action("wp_ajax_nopriv_load_price_booking", "load_price_booking");

function load_price_booking() {


    $arr = array(
        'post_status' => 'publish',
        'post_type' => 'tien',
    );

    $query = new WP_Query($arr);

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        $data = get_the_ID();
    endwhile;
    endif;
    wp_reset_postdata();


    wp_send_json_success($data);

    die();
}



add_action("wp_ajax_update_gd_price", "update_gd_price");
add_action("wp_ajax_nopriv_update_gd_price", "update_gd_price");

function update_gd_price() {
    $id = $_POST['id'];
    $update_thanh_toan1 = $_POST['update_thanh_toan1'];
    $update_thanh_toan2 = $_POST['update_thanh_toan2'];
    $kh_con_no_khac = $_POST['kh_con_no_khac'];
    $bct_con_no_khac2 = $_POST['bct_con_no_khac2'];
    $update_giao_dich = array(
        'ID'           => $id,
    );

    $post_update = wp_update_post($update_giao_dich);

    if(!empty($update_thanh_toan1)){
        update_field( 'da_thanh_toan_khac', $update_thanh_toan1, $post_update );
    }

    if(!empty($update_thanh_toan2)){
        update_field( 'da_thanh_toan_khac2', $update_thanh_toan2, $post_update );
    }

    if(!empty($kh_con_no_khac)){
        update_field( 'kh_con_no_khac', $kh_con_no_khac, $post_update );
    }

    if(!empty($bct_con_no_khac2)){
        update_field( 'bct_con_no_khac2', $bct_con_no_khac2, $post_update );
    }


    die();
}




add_action("wp_ajax_update_price_booking", "update_price_booking");
add_action("wp_ajax_nopriv_update_price_booking", "update_price_booking");

function update_price_booking() {
    $id_gd = $_POST['id_gd'];

    $ma_kgd = $_POST['ma_kgd'];
    $ma_dt = $_POST['ma_dt'];
    $ma_ctv = $_POST['ma_ctv'];
    $ma_nv = $_POST['ma_nv'];

    $update_thanh_toan1 = $_POST['update_thanh_toan1'];
    $update_thanh_toan2 = $_POST['update_thanh_toan2'];
    $kh_con_no_khac = $_POST['kh_con_no_khac'];
    $bct_con_no_khac2 = $_POST['bct_con_no_khac2'];

    $id = $_POST['id'];
    $add_ma_gd_coc = $_POST['add_ma_gd_coc'];
    $add_tien_coc = $_POST['add_tien_coc'];
    $add_ngay_coc = $_POST['add_ngay_coc'];
    $add_tk_coc = $_POST['add_tk_coc'];

    $add_ma_gd_coc_di = $_POST['add_ma_gd_coc_di'];
    $add_tien_coc_di = $_POST['add_tien_coc_di'];
    $add_ngay_coc_di = $_POST['add_ngay_coc_di'];
    $add_tk_coc_di = $_POST['add_tk_coc_di'];

    $update_price = array(
        'ID'           => $id,
    );

    $post_update = wp_update_post($update_price);

    if(!empty($add_ma_gd_coc)){
        update_field( 'ma_gd_coc', $add_ma_gd_coc, $post_update );
    }

    if(!empty($add_tien_coc)){
        update_field( 'tien_coc', $add_tien_coc, $post_update );
    }

    if(!empty($add_ngay_coc)){
        $date = DateTime::createFromFormat('d/m/Y', $add_ngay_coc);
        $date = $date->format('Ymd');
        update_field( 'ngay_coc', $date, $post_update );
    }

    if(!empty($add_tk_coc)){
        update_field( 'tk_coc', $add_tk_coc, $post_update );
    }

    if(!empty($add_ma_gd_coc_di)){
        update_field( 'ma_gd_coc_di', $add_ma_gd_coc_di, $post_update );
    }

    if(!empty($add_tien_coc_di)){
        update_field( 'tien_coc_di', $add_tien_coc_di, $post_update );
    }

    if(!empty($ma_kgd)){
        update_field( 'id_khach_hang', $ma_kgd, $post_update );
    }

    if(!empty($ma_dt)){
        update_field( 'id_doi_tac', $ma_dt, $post_update );
    }

    if(!empty($ma_ctv)){
        update_field( 'id_ctv', $ma_ctv, $post_update );
    }

    if(!empty($ma_nv)){
        update_field( 'id_nv', $ma_nv, $post_update );
    }

    if(!empty($add_ngay_coc_di)){
        $date = DateTime::createFromFormat('d/m/Y', $add_ngay_coc_di);
        $date = $date->format('Ymd');
        update_field( 'ngay_phai_coc_di', $date, $post_update );
    }

    if(!empty($add_tk_coc_di)){
        update_field( 'tk_coc_di', $add_tk_coc_di, $post_update );
    }


    $update_giao_dich = array(
        'ID'           => $id_gd,
    );

    $post_update_gd = wp_update_post($update_giao_dich);

    update_field( 'da_thanh_toan_khac', $update_thanh_toan1, $post_update_gd );
    update_field( 'da_thanh_toan_khac2', $update_thanh_toan2, $post_update_gd );
    update_field( 'kh_con_no_khac', $kh_con_no_khac, $post_update_gd );
    update_field( 'bct_con_no_khac2', $bct_con_no_khac2, $post_update_gd );

    die();
}


