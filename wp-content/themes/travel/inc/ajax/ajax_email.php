<?php
add_action("wp_ajax_forget_email", "forget_email");
add_action("wp_ajax_nopriv_forget_email", "forget_email");

function forget_email() {
    global $token;
    $email_forget = $_POST['email_forget'];
    $token = abs(crc32(uniqid()));
    $token = $token;

    $query = new WP_Query(array(
        'post_type' => 'tai_khoan',
        'meta_query'	=> array(
            'relation'		=> 'AND',
            array(
                'key'	 	=> 'email_tai_khoan',
                'value'	  	=> $email_forget,
                'compare' 	=> '=',
            ),
        ),
    ));

    if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        $id_token = get_the_ID();



        $update_token_forget = array(
            'ID'           => $id_token,
        );

        $post_id_token_forget = wp_update_post($update_token_forget);

        update_field( 'token_user', $token, $post_id_token_forget );
    endwhile;
    endif;
    wp_reset_postdata();


    require get_template_directory(). '/inc/PHPMailer/PHPMailerAutoload.php';

    //#1
    $to_id = $email_forget;
    $message = 'Mã lấy lại mật khẩu : <strong style="color: red;">'.$token.'</strong>';
    $subject = 'Lấy lại mật khẩu email : '.$to_id;
    $subject = "=?utf-8?b?".base64_encode($subject)."?=";

    //#2
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'it.bachchitravel@gmail.com';
    $mail->Password = 'Bachchi1q2w3e4r';
    $mail->FromName = "Bách Chi Travel";

    //#3
    $mail->addAddress($to_id);
    $mail->Subject = $subject;
    $mail->msgHTML($message);
    $mail->CharSet = "UTF-8";

    //#4
    if (!$mail->send()) {
        $alert = "Lỗi: " . $mail->ErrorInfo;
    }
    else {
        $alert = 'Đã gửi!';
    }

    //wp_send_json_success($token);

    die();
}

add_action("wp_ajax_forget_pass", "forget_pass");
add_action("wp_ajax_nopriv_forget_pass", "forget_pass");

function forget_pass() {
    $code_forget = $_POST['code_forget'];
    $pass_forget = $_POST['pass_forget'];

    if(!empty($code_forget) && !empty($pass_forget)){
        $query = new WP_Query(array(
            'numberposts'	=> -1,
            'post_type' => 'tai_khoan',
            'meta_key'		=> 'token_user',
            'meta_value'	=> $code_forget
        ));

        if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            $token = "true";

            $update_token_forget = array(
                'ID'           => get_the_ID(),
            );

            $post_id_token_forget = wp_update_post($update_token_forget);

            update_field( 'mat_khau_tai_khoan', md5($pass_forget), $post_id_token_forget );
            update_field( 'token_user', '', $post_id_token_forget );
        endwhile;
        else :
            $error = "false";
        endif;
        wp_reset_postdata();
    }else{
        $error = 'false';
    }


    wp_send_json_success($error);

    die();
}


