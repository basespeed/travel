<?php
add_action("wp_ajax_join_user_nv", "join_user_nv");
add_action("wp_ajax_nopriv_join_user_nv", "join_user_nv");

function join_user_nv() {
    $email_tk = $_POST['email_tk'];
    global $data;
    if(!empty($email_tk)){
        $search_query = array(
            'post_type'		=> 'nhan_vien',
            'posts_per_page' => 1,
            'order' => 'ASC',
            'meta_key'			=> 'email_nv',
            'orderby'			=> 'meta_value',
            'meta_query'	=> array(
                'relation'		=> 'OR',
                array(
                    'key'		=> 'email_nv',
                    'value'		=> $email_tk,
                    'compare'	=> 'LIKE'
                ),
            )
        );

        $query = new WP_Query($search_query);
        $data = [];
        $n = 1;
        if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            if($n == 1){
                if($data[0] == get_field('ten_nv')){
                    continue;
                }
                array_push($data, get_field('ten_nv'));
                array_push($data, get_field('sdt_nv'));
                array_push($data, get_field('lien_ket_tai_khoan'));
                array_push($data, get_field('bo_phan_nv'));
                array_push($data, get_field('email_nv'));
            }else{
                break;
            }
        endwhile;
        endif;
        wp_reset_postdata();
    }

    wp_send_json_success($data);

    die();
}


