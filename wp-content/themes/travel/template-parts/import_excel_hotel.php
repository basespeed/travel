<?php
/*
 * Template Name: Import Excel Hotel*/

if($_SESSION['sucess'] == "sucess") {

get_header();

?>
<div id="content">
    <div class="quantri_admin">
        <div class="menu_admin">
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

            /*$allposts= get_posts( array('post_type'=>'khach_hang','numberposts'=>-1) );
            foreach ($allposts as $eachpost) {
                wp_delete_post( $eachpost->ID, true );
            }*/
            ?>
        </div>

        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san">
                <form action="<?php echo get_home_url('/'); ?>/inc/ajax/excel_hotel.php" method="post" class="frm_excel_hotel" enctype="multipart/form-data">
                    <input type="file" name="file_excel" class="file_excel" required>
                    <button class="btn_upload_excel">Chọn file</button>
                    <button type="button" class="load_upload_excel"><i class="fa fa-spinner" aria-hidden="true"></i></button>
                    <button type="submit" name="sub_import_excel_hotel" class="sub_import_excel_hotel">Import Excel</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    }else{
        ob_start();
        header("Location: ".home_url('/'));
        exit();
    }
    ?>
