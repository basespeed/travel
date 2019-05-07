<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Travel
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'travel' ); ?></a>

	<header id="masthead" class="site-header">
        <div class="insider" style="background: url(<?php echo get_template_directory_uri().'/assets/images/map.jpg' ?>) no-repeat;">
            <h1>Bách chi travel</h1>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content <?php
        if(isset($_SESSION['loai_quyen_tai_khoan'])){
            if($_SESSION['loai_quyen_tai_khoan'] == "Admin"){
                echo 'check_admin';
            }elseif($_SESSION['loai_quyen_tai_khoan'] == "Quản lý"){
                echo 'check_quan_ly';
            }elseif($_SESSION['loai_quyen_tai_khoan'] == "Nhân viên"){
                echo 'check_nhan_vien';
            }
        }
    ?>">
