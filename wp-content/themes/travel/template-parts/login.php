<?php
/*
 * Template Name: Login*/

if(! isset($_SESSION['sucess'])) {
    get_header();
    ?>
    <div class="form"
         style="background: url(<?php echo get_template_directory_uri() . '/assets/images/travel.jpg' ?>);">
        <div class="insider">
            <h1>Đăng nhập quản trị</h1>
            <p class="alert"></p>
            <ul>
                <li>
                    <input type="email" class="tai_khoan" placeholder="Email">
                </li>
                <li>
                    <input type="password" class="mat_khau" placeholder="Mật khẩu">
                </li>
            </ul>
            <button type="submit" class="sub_login">Đăng nhập</button>
        </div>
    </div>

    <?php
    get_footer();
}else{
    ob_start();
    header("Location: ".home_url('/giao-dich'));
    exit();
}