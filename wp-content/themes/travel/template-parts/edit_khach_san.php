<?php
/*
 * Template Name: Sửa khách sạn*/

if($_SESSION['sucess'] == "sucess") {
get_header();
    ?>
    <div id="content" class="edit_giao_dich edit_tai_khoan">
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
                ?>
            </div>

            <div class="content_admin">
                <div class="giao_dich_moi">
                    <div class="search_hotel">
                        <form action="<?php echo get_home_url() ?>/tim-kiem-khach-san" method="post">
                            <input type="text" name="keyword" placeholder="Tìm kiếm khách sạn...">
                            <button type="submit" name="sub_search_hotel" class="sub_search_hotel"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>

                    </div>
                    <div class="content_hotel_list">
                        <table>
                            <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $arr = array(
                                'post_type' => 'hotel',
                                'posts_per_page' => 200,
                                'order' => 'DESC',
                                'paged' => $paged,
                            );

                            $the_query = new WP_Query($arr);
                            $n = 1;
                            if ($the_query->have_posts()) :
                                ?>
                                <tr class="header_edit_hotel_list">
                                    <td><strong>Hotel ID</strong></td>
                                    <td><strong>Hotel name</strong></td>
                                    <td><strong>Brand name</strong></td>
                                    <td><strong>Addressline 1</strong></td>
                                    <td><strong>Zipcode</strong></td>
                                    <td><strong>City</strong></td>
                                    <td><strong>State</strong></td>
                                    <td><strong>Country</strong></td>
                                    <td><strong>Countryisocode</strong></td>
                                    <td><strong>Numberrooms</strong></td>
                                    <td></td>
                                </tr>
                                <?php
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    ?>
                                    <tr class="list_hotel">
                                        <td><?php echo get_field('hotel_id'); ?></td>
                                        <td><a class="title"
                                               href="<?php the_permalink(); ?>"><?php echo get_field('hotel_name'); ?></a></td>
                                        <td><?php echo get_field('brand_name'); ?></td>
                                        <td><?php echo get_field('addressline1'); ?></td>
                                        <td><?php echo get_field('zipcode'); ?></td>
                                        <td><?php echo get_field('city'); ?></td>
                                        <td><?php echo get_field('state'); ?></td>
                                        <td><?php echo get_field('country'); ?></td>
                                        <td><?php echo get_field('countryisocode'); ?></td>
                                        <td><?php echo get_field('numberrooms'); ?></td>
                                        <td>
                                            <a class="edit" href="<?php the_permalink(); ?>"><i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a onclick="return confirm('Bạn có chắc muốn xóa nó');" class="delete" href="<?php echo get_delete_post_link(get_the_ID()); ?>"><i
                                                        class="fa fa-times-circle" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                endwhile;
                                $total_pages = $the_query->max_num_pages;
                                $current_page = max(1, get_query_var('paged'));
                            else:
                                echo "<td colspan='3'>Dữ liệu trống !</td>";
                            endif;
                            wp_reset_postdata();
                            ?>
                        </table>
                    </div>
                    <?php
                    if ($total_pages) :
                        echo '<nav class="nav">';
                        echo paginate_links(array(
                            'base' => get_pagenum_link(1) . '%_%',
                            'format' => '/page/%#%',
                            'current' => $current_page,
                            'total' => $total_pages,
                            'prev_text' => __('<i class="fa fa-angle-left" aria-hidden="true"></i>'),
                            'next_text' => __('<i class="fa fa-angle-right" aria-hidden="true"></i>'),
                        ));
                        echo '</nav>';
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['trashed']) and isset($_GET['ids'])) {
            $query = new WP_Query(array(
                'post_type' => 'giao_dich',
                'p' => $_GET['ids'],
            ));
            while ($query->have_posts()) : $query->the_post();
                $path = get_field('hinh_anh_tai_khoan');
                unlink($path);
            endwhile;
            wp_reset_postdata();
        }
        ?>

    </div>
    <?php
    get_footer();
}else{
    ob_start();
    header("Location: ".home_url('/'));
    exit();
}
