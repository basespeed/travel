<?php
/*
 * Template Name: Import Excel Hotel*/

if($_SESSION['sucess'] == "sucess") {

get_header();

?>
<div id="content">
    <div class="quantri_admin">
        <?php include 'inc/template_menu.php'; ?>

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
