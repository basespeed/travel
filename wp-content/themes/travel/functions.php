<?php
/**
 * Travel functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Travel
 */

if ( ! function_exists( 'travel_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function travel_setup() {
		load_theme_textdomain( 'travel', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'travel' ),
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-background', apply_filters( 'travel_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'travel_setup' );
function travel_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'travel_content_width', 640 );
}
add_action( 'after_setup_theme', 'travel_content_width', 0 );

function travel_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'travel' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'travel' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'travel_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function travel_scripts() {
	wp_enqueue_style( 'travel-style', get_stylesheet_uri() );

	wp_enqueue_script( 'datepicker-js', get_template_directory_uri() . '/assets/js/datepicker.min.js', array(), false, true );
	wp_enqueue_script( 'datepicker-lang-js', get_template_directory_uri() . '/assets/js/i18n/datepicker.en.js', array(), false, true );
	wp_enqueue_script( 'isotope-js', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array(), false, true );
	wp_enqueue_script( 'parallax-js', get_template_directory_uri() . '/assets/js/parallax.js', array(), false, true );
	wp_enqueue_script( 'nicescroll-js', get_template_directory_uri() . '/assets/js/jquery.nicescroll.min.js', array(), false, true );
    //wp_enqueue_script( 'iframehelper-js', get_template_directory_uri() . '/assets/js/jquery.nicescroll.iframehelper.min.js', array(), false, true );
    wp_enqueue_script( 'jquery_form-js', get_template_directory_uri() . '/assets/js/jquery.form.js', array(), false, true );
    wp_enqueue_script( 'picturefill-js', get_template_directory_uri() . '/assets/js/picturefill.min.js', array(), false, true );
    wp_enqueue_script( 'lightgallery-js', get_template_directory_uri() . '/assets/js/lightgallery-all.min.js', array(), false, true );
    wp_enqueue_script( 'mousewheel-js', get_template_directory_uri() . '/assets/js/jquery.mousewheel.min.js', array(), false, true );
    wp_enqueue_script( 'money-js', get_template_directory_uri() . '/assets/js/simple.money.format.js', array(), false, true );

    global $post;
    if( $post->ID == 240) {
        wp_enqueue_script( 'jquery-ui-js',  'https://code.jquery.com/ui/1.12.0/jquery-ui.js', array(), false, true );
    }

	wp_enqueue_script( 'travel-js', get_template_directory_uri() . '/assets/js/js.js', array(), false, true );

    wp_localize_script( 'travel-js', 'my_ajax_object', array( 'ajax_url' => get_template_directory_uri().'/inc/ajax/admin-ajax.php' ) ); //admin_url( 'admin-ajax.php' )

	//wp_enqueue_script( 'travel-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'travel_scripts' );



add_action( 'wp_enqueue_scripts', 'wp_style' );
function wp_style() {
    wp_register_style( 'Roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700', array(), false);
    wp_enqueue_style( 'Roboto' );
    wp_register_style( 'datepicker', get_template_directory_uri() .'/assets/css/datepicker.min.css', array(), false);
    wp_enqueue_style( 'datepicker' );
    wp_register_style( 'lightgallery', get_template_directory_uri() .'/assets/css/lightgallery.min.css', array(), false);
    wp_enqueue_style( 'lightgallery' );
    wp_register_style( 'animate', get_template_directory_uri() .'/assets/css/animate.css', array(), false);
    wp_enqueue_style( 'animate' );
    wp_register_style( 'awesome', get_template_directory_uri() .'/assets/css/font-awesome.min.css', array(), false);
    wp_enqueue_style( 'awesome' );
    wp_register_style( 'style', get_template_directory_uri() .'/assets/css/style.css', array(), false);
    wp_enqueue_style( 'style' );
}

add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
function load_admin_styles() {
    wp_enqueue_style( 'admin_css_foo', get_template_directory_uri() . '/assets/css/admin.css', false, false );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/custom-post-types/giao_dich.php';
require get_template_directory() . '/inc/custom-post-types/history_giao_dich.php';
require get_template_directory() . '/inc/custom-post-types/khach_san.php';
require get_template_directory() . '/inc/custom-post-types/room.php';
require get_template_directory() . '/inc/custom-post-types/nhan_vien.php';
require get_template_directory() . '/inc/custom-post-types/ctv.php';
require get_template_directory() . '/inc/custom-post-types/user.php';
require get_template_directory() . '/inc/custom-post-types/doi_tac.php';
require get_template_directory() . '/inc/custom-post-types/khach_hang.php';
require get_template_directory() . '/inc/custom-post-types/giao_dich_tien.php';
require get_template_directory() . '/inc/custom-post-types/km.php';
require get_template_directory() . '/inc/custom-post-types/trang_thai.php';
require get_template_directory() . '/inc/custom-post-types/chat.php';
require get_template_directory() . '/inc/custom-post-types/bo_phan.php';
require get_template_directory() . '/inc/custom-post-types/dia_diem.php';
require get_template_directory() . '/inc/custom-post-types/note_chat.php';
/**
 * Ajax
 */
require get_template_directory() . '/inc/ajax/ajax-delete-giao-dich.php';
require get_template_directory() . '/inc/ajax/ajax-delete-tai-khoan.php';
require get_template_directory() . '/inc/ajax/ajax-login.php';
require get_template_directory() . '/inc/ajax/ajax-logout.php';
require get_template_directory() . '/inc/ajax/ajax_join_user_nv.php';
require get_template_directory() . '/inc/ajax/ajax-chat.php';
require get_template_directory() . '/inc/ajax/ajax-send-mess.php';
require get_template_directory() . '/inc/ajax/ajax-khach-hang.php';
require get_template_directory() . '/inc/ajax/ajax_email.php';
require get_template_directory() . '/inc/ajax/excel_hotel.php';
require get_template_directory() . '/inc/ajax/ajax-khach-san.php';
require get_template_directory() . '/inc/ajax/ajax-add-price-booking.php';
require get_template_directory() . '/inc/ajax/ajax_google_sheets.php';

/**
 * ACF.
 */
require get_template_directory() . '/inc/acf/random-field.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

//paginate
function Pagination(){
    $total_pages = $the_query->max_num_pages;

    $current_page = max(1, get_query_var('paged'));

    echo paginate_links(array(
        'base' => get_pagenum_link(1) . '%_%',
        'format' => '/page/%#%',
        'current' => $current_page,
        'total' => $total_pages,
        'prev_text'    => __('<i class="fa fa-angle-left" aria-hidden="true"></i>'),
        'next_text'    => __('<i class="fa fa-angle-right" aria-hidden="true"></i>'),
    ));
}

//Session
add_action('init', 'myStartSession', 1);
function myStartSession() {

    if(!session_id()) {

        session_start();

    }

}


// remove version from head
remove_action('wp_head', 'wp_generator');

// remove version from rss
add_filter('the_generator', '__return_empty_string');

// remove version from scripts and styles
function remove_version_scripts_styles($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'remove_version_scripts_styles', 9999);



//Check ip connect to network
/*$localIP = getHostByName(getHostName());
echo $localIP;*/

//Get MAC
/*function get_mac(){
    ob_start(); // Turn on output buffering
    system('ipconfig /all'); //Execute external program to display output
    $mycom=ob_get_contents(); // Capture the output into a variable
    ob_clean(); // Clean the output buffer

    $find_word = "Physical";
    $pmac = strpos($mycom, $find_word); // Find the position of Physical text in array
    $mac=substr($mycom,($pmac+36),17); // Get Physical Address

    return $mac;
}

echo get_mac();*/

//create table mysql
/*function jal_install () {
    global $wpdb;

    $table_name = $wpdb->prefix . "chat_online";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      name text NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

add_action('init','jal_install');*/

if ( !current_user_can( $post_type_object->cap->delete_post, $post->ID ) )
    return;

function to_slug($str) {
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}

add_action('init', function() {
    add_rewrite_rule('(/page/?([0-9]{1,})/?$', 'index.php?pagename=$matches[1]&paged=$matches[2]', 'top');
});

class AutoActivator {

    const ACTIVATION_KEY = 'youractivationkeyhere';

    /**
     * AutoActivator constructor.
     * This will update the license field option on acf
     * Works only on backend to not attack performance on frontend
     */
    public function __construct() {
        if (
            function_exists( 'acf' ) &&
            is_admin() &&
            !acf_pro_get_license_key()
        ) {
            acf_pro_update_license(self::ACTIVATION_KEY);
        }
    }

}

new AutoActivator();