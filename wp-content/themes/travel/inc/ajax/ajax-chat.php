<?php
add_action("wp_ajax_check_online", "check_online");
add_action("wp_ajax_nopriv_check_online", "check_online");

function check_online() {
    $query = new WP_Query(array(
        'post_type' => 'tai_khoan',
        'posts_per_page' => 14 ,
        'order' => 'ASC',
    ));

    $query2 = new WP_Query(array(
        'post_type' => 'tai_khoan',
        'posts_per_page' => 14 ,
        'order' => 'ASC',
    ));

    if($query->have_posts()) :
        $html .= '<ul>';
        $html .= '<li data-name="Giao dịch"><span><i class="fa fa-users" aria-hidden="true"></i> Giao dịch</span> <span style="background: green !important;"></span></li>';
        while ($query->have_posts()) : $query->the_post();
            if(get_the_ID() != $_SESSION['user_id']){
                if(get_field('check_online') == "on"){
                    $html .= '<li data-name="'.get_field("ten_biet_danh_tai_khoan").'">';
                    if(!empty(get_field('hinh_anh_tai_khoan'))){
                        $html .= '<div class="img"><img src="'.get_field('hinh_anh_tai_khoan').'" alt="Ảnh đại diện" /></div>';
                    }
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
        $html .= '</ul>';

        $html .= '<ul>';
        while ($query2->have_posts()) : $query2->the_post();
            if(get_the_ID() != $_SESSION['user_id']) {
                if (get_field('check_online') != "on") {
                    $html .= '<li data-name="' . get_field("ten_biet_danh_tai_khoan") . '">';
                    if (!empty(get_field('hinh_anh_tai_khoan'))) {
                        $html .= '<div class="img"><img src="' . get_field('hinh_anh_tai_khoan') . '" alt="Ảnh đại diện" /></div>';
                    }
                    $html .= "<span>" . get_field('ten_biet_danh_tai_khoan') . "</span>";
                    if (get_field('check_online') == "off" || get_field('check_online') == "") {
                        $html .= "<span class='off'></span>";
                    } else {
                        $html .= "<span style='background-color: green !important;'></span>";
                    }
                    $html .= '</li>';
                }
            }
        endwhile;
        $html .= '</ul>';
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

add_action("wp_ajax_search_user_online", "search_user_online");
add_action("wp_ajax_nopriv_search_user_online", "search_user_online");

function search_user_online() {
    $val_user_on = $_POST['val_user_on'];
    if(isset($val_user_on)){
        $query = new WP_Query(array(
            'numberposts'	=> -1,
            'post_type' => 'tai_khoan',
            'posts_per_page' => 14 ,
            'order' => 'ASC',
            'meta_key'		=> 'ten_biet_danh_tai_khoan',
            'meta_value' => '^' . preg_quote( $val_user_on ),
            'meta_compare' => 'RLIKE',
        ));
        $query2 = new WP_Query(array(
            'numberposts'	=> -1,
            'post_type' => 'tai_khoan',
            'posts_per_page' => 14 ,
            'order' => 'ASC',
            'meta_key'		=> 'ten_biet_danh_tai_khoan',
            'meta_value' => '^' . preg_quote( $val_user_on ),
            'meta_compare' => 'RLIKE',
        ));

        if($query->have_posts()) :
            $html .= '<ul>';
            $html .= '<li data-name="Giao dịch"><span><i class="fa fa-users" aria-hidden="true"></i> Giao dịch</span> <span style="background: green !important;"></span></li>';
            while ($query->have_posts()) : $query->the_post();
                if(get_the_ID() != $_SESSION['user_id']){
                    if(get_field('check_online') == "on"){
                        $html .= '<li data-name="'.get_field("ten_biet_danh_tai_khoan").'">';
                        if(!empty(get_field('hinh_anh_tai_khoan'))){
                            $html .= '<div class="img"><img src="'.get_field('hinh_anh_tai_khoan').'" alt="Ảnh đại diện" /></div>';
                        }
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
            $html .= '</ul>';

            $html .= '<ul>';
            while ($query2->have_posts()) : $query2->the_post();
                if(get_the_ID() != $_SESSION['user_id']) {
                    if (get_field('check_online') != "on") {
                        $html .= '<li data-name="' . get_field("ten_biet_danh_tai_khoan") . '">';
                        if (!empty(get_field('hinh_anh_tai_khoan'))) {
                            $html .= '<div class="img"><img src="' . get_field('hinh_anh_tai_khoan') . '" alt="Ảnh đại diện" /></div>';
                        }
                        $html .= "<span>" . get_field('ten_biet_danh_tai_khoan') . "</span>";
                        if (get_field('check_online') == "off" || get_field('check_online') == "") {
                            $html .= "<span class='off'></span>";
                        } else {
                            $html .= "<span style='background-color: green !important;'></span>";
                        }
                        $html .= '</li>';
                    }
                }
            endwhile;
            $html .= '</ul>';
        endif;
        wp_reset_postdata();
    }

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