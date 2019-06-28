<div class="menu_admin animated fadeIn">
    <div class="toggle_menu_setting">
        <i class="fa fa-cog" aria-hidden="true"></i>
    </div>
    <div class="toggle_menu_setting2">
        <i class="fa fa-cog" aria-hidden="true"></i>
    </div>
    <div class="info_user">
        <div class="avatar">
            <?php
            if(isset($_SESSION['avatar'])){
                echo '<img src="'.$_SESSION['avatar'].'" alt="Ảnh đại diện">';
            }else{
                echo '<img src="'.get_template_directory_uri().'/assets/images/user.png" alt="Ảnh đại diện">';
            }
            ?>

        </div>
        <div class="info">
            <p><strong>Hi: </strong><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?> !</p>
            <button class="logout">Logout</button>
        </div>
    </div>
    <a href="<?php echo home_url('/') ?>ho-so" class="ho_so"><span class="dashicons dashicons-id"></span> Hồ sơ</a>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'menu-1',
        'menu_id' => 'primary-menu',
        'menu' => 'Admin'
    ));
    ?>
</div>