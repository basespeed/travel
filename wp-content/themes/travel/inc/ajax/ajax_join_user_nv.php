<?php
add_action("wp_ajax_join_user_nv", "join_user_nv");
add_action("wp_ajax_nopriv_join_user_nv", "join_user_nv");

function join_user_nv() {
    $email_tk = $_POST['email_tk'];

    $posts = array(
        'numberposts'	=> -1,
        'post_type'		=> 'nhan_vien',
        'meta_key'		=> 'email_nv',
        'meta_value' => '^' . preg_quote( $email_tk ),
        'meta_compare' => 'RLIKE',
    );

    $query = new WP_Query($posts);
    $data = [];
    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        array_push($data, get_field('ten_nv'));
        array_push($data, get_field('sdt_nv'));
        array_push($data, get_field('lien_ket_tai_khoan'));
        array_push($data, get_field('bo_phan_nv'));
    endwhile;
    endif;
    wp_reset_postdata();

    wp_send_json_success($data);

    die();
}


