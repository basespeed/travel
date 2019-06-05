<?php
add_action("wp_ajax_join_user_nv", "join_user_nv");
add_action("wp_ajax_nopriv_join_user_nv", "join_user_nv");

function join_user_nv() {
    $email_tk = $_POST['email_tk'];
    global $wpdb,$data;
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
                    AND $wpdb->posts.post_type = 'nhan_vien'
                    AND postmeta1.meta_key = 'email_nv'
                    AND postmeta1.meta_value LIKE '%$email_tk%'
                    ORDER BY post_date DESC
                    LIMIT 5
                ");

    if($search_query){
        foreach ($search_query as $data) {
            $id = $data->ID;
            $args = array(
                'p'         => $id, // ID of a page, post, or custom type
                'post_type' => 'nhan_vien',
            );

            $query = new WP_Query($args);
            $data = [];
            if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                if($data[0] == get_field('ten_nv')){
                    continue;
                }
                array_push($data, get_field('ten_nv'));
                array_push($data, get_field('sdt_nv'));
                array_push($data, get_field('lien_ket_tai_khoan'));
                array_push($data, get_field('bo_phan_nv'));
                array_push($data, get_field('email_nv'));
            endwhile;
            endif;
            wp_reset_postdata();
        }
    }else{
        echo 'empty';
    }

    wp_send_json_success($data);

    die();
}


