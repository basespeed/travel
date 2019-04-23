<?php
add_action("wp_ajax_check_login", "check_login");
add_action("wp_ajax_nopriv_check_login", "check_login");

function check_login() {
    $user = $_POST['check_user'];
    $pass = $_POST['check_pass'];
    $pass = md5($pass);

    // args
    $args = array(
        'numberposts'	=> -1,
        'post_type'		=> 'tai_khoan',
        'meta_query'	=> array(
            'relation'		=> 'AND',
            array(
                'key'		=> 'email_tai_khoan',
                'value'		=> $user,
                'compare'	=> '='
            ),
            array(
                'key'		=> 'mat_khau_tai_khoan',
                'value'		=> $pass,
                'compare'	=> '='
            )
        )
    );
    // query
    $the_query = new WP_Query( $args );
    if($the_query->have_posts()){
        while ($the_query->have_posts()) : $the_query->the_post();
            if($user == get_field('email_tai_khoan') and $pass == get_field('mat_khau_tai_khoan')){
                $_SESSION['sucess'] = "sucess";
                $_SESSION['avatar'] = get_field('hinh_anh_tai_khoan');
                $_SESSION['name'] = get_field('ten_biet_danh_tai_khoan');
                $_SESSION['lien_ket_tai_khoan'] = get_field('lien_ket_tai_khoan');
                $_SESSION['user_id'] = get_the_ID();
                $alert = $_SESSION['sucess'];
            }else{
                $alert = "fail";
            }
        endwhile;
    }else{
        $alert = "fail";
    }

    wp_send_json_success($alert);

    die();
}


add_action("wp_ajax_check_online", "check_online");
add_action("wp_ajax_nopriv_check_online", "check_online");

function check_online() {
    $query = new WP_Query(array(
        'post_type' => 'tai_khoan',
        'posts_per_page' => 5 ,
        'order' => 'ASC',
    ));

    $html .= '<li data-name="Tất cả"><span>Tất cả</span> <span style="background: green !important;"></span></li>';

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        if(get_the_ID() != $_SESSION['user_id']){
            if(get_field('check_online') == "on"){
                $html .= '<li data-name="'.get_field("ten_biet_danh_tai_khoan").'">';
                $html .= "<span>".get_field('ten_biet_danh_tai_khoan')."</span>";
                if(get_field('check_online') == "off" || get_field('check_online') == ""){
                    $html .= "<span class='off'></span>";
                }else{
                    $html .= "<span style='background-color: green !important;'></span>";
                }
                $html .= '</li>';
            }else{
                $html .= '<li data-name="'.get_field("ten_biet_danh_tai_khoan").'">';
                $html .= "<span>".get_field('ten_biet_danh_tai_khoan')."</span>";
                if(get_field('check_online') == "off" || get_field('check_online') == ""){
                    $html .= "<span class='off'></span>";
                }else{
                    $html .= "<span style='background-color: green !important;'></span>";
                }
                $html .= '</li>';
            }
        }
        ?>

    <?php
    endwhile;
    endif;
    wp_reset_postdata();

    if(isset($_SESSION['user_id'])){
        $update_ctv = array(
            'ID'           => $_SESSION['user_id'],
        );
        $post_id = wp_update_post($update_ctv);
        update_field( 'check_online', 'on', $post_id );
    }

    wp_send_json_success($html);
    die();

}


add_action("wp_ajax_check_offline", "check_offline");
add_action("wp_ajax_nopriv_check_offline", "check_offline");

function check_offline() {
    if(isset($_SESSION['user_id'])){
        $update_ctv = array(
            'ID'           => $_SESSION['user_id'],
        );
        $post_id = wp_update_post($update_ctv);
        update_field( 'check_online', 'off', $post_id );
    }

    die();
}