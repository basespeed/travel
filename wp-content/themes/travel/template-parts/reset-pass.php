<?php
/*
 * Template Name: Quên mật khẩu*/

get_header();
?>
    <div class="form get_forget_token"
         style="background: url(<?php echo get_template_directory_uri() . '/assets/images/travel.jpg' ?>);">
        <div class="insider">
            <h1>Quên mật khẩu</h1>
            <p class="alert"></p>
            <ul>
                <li>
                    <input type="email" class="email_forget" placeholder="Nhập email lấy lại mật khẩu" required>
                </li>
            </ul>
            <span class="forget_button">
                <button type="submit" class="sub_forget">Lấy lại</button>
                <button type="button" class="load_forget"><i class="fa fa-spinner" aria-hidden="true"></i></button>
                <button type="button" class="sub_code">Đã có mã</button>
            </span>
            <a class="forget_password" href="<?php echo get_home_url(); ?>">Đăng nhập</a>
        </div>
    </div>

    <div class="form form_forget_password"
         style="background: url(<?php echo get_template_directory_uri() . '/assets/images/travel.jpg' ?>);">
        <div class="insider">
            <h1>Mật khẩu mới</h1>
            <p class="alert">Chúng tôi đã gửi cho bạn một mã vào <a href="https://mail.google.com/mail" target="_blank">email</a> để lấy lại mật khẩu</p>
            <ul>
                <li>
                    <input type="text" class="code_forget" placeholder="Nhập mã" required>
                </li>
                <li>
                    <input type="password" class="pass_forget" placeholder="Nhập mật khẩu mới" required>
                </li>
            </ul>
            <span class="forget_button">
                <button type="submit" class="sub_pass_forget">Lấy lại</button>
                <button type="button" class="load_forget"><i class="fa fa-spinner" aria-hidden="true"></i></button>
                <button type="button" class="sub_not_code">Chưa có mã</button>
            </span>
            <a class="forget_password" href="<?php echo get_home_url(); ?>">Đăng nhập</a>
        </div>
    </div>
<?php
get_footer();