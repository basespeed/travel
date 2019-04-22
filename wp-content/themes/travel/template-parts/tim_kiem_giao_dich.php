<?php
/*
 * Template Name: Tìm kiếm giao dịch*/

if($_SESSION['sucess'] == "sucess") {
    get_header();

    ?>
    <?php
    if (isset($_POST['btn_tk_giao_dich'])) {
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
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-1',
                        'menu_id' => 'primary-menu',
                        'menu' => 'Admin'
                    ));
                    ?>
                </div>

                <div class="content_admin">
                    <div class="nav_filter">
                        <div class="filter">
                            <form action="<?php echo home_url('/'); ?>tim-kiem-giao-dich" method="post">
                                <label for="Tìm kiếm giao dịch"><strong>Tìm kiếm giao dịch : </strong></label>
                                <input type="text" name="tk_giao_dich" placeholder="Nhập từ khóa tìm kiếm ...">
                                <button type="submit" name="btn_tk_giao_dich"><i class="fa fa-search"
                                                                                 aria-hidden="true"></i></button>
                            </form>
                        </div>
                        <div class="sort">
                            <form action="<?php echo home_url('/'); ?>" method="get">
                                <select name="slt_sort">
                                    <option value="desc">Giao dịch mới nhất</option>
                                    <option value="asc">Giao dịch cũ nhất</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="giao_dich_moi">
                        <table>
                            <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $arr = array(
                                'post_type' => 'giao_dich',
                                'posts_per_page' => 10,
                                'order' => 'DESC',
                                'paged' => $paged,
                                'meta_query' => array(
                                    'relation' => 'OR',
                                    array(
                                        'key' => 'ten_khach_san',
                                        'value' => $_POST['tk_giao_dich'],
                                        'compare' => '='
                                    ),
                                    array(
                                        'key' => 'khach_dai_dien',
                                        'value' => $_POST['tk_giao_dich'],
                                        'compare' => '='
                                    ),
                                    array(
                                        'key' => 'ten_doi_tac_gui_dat',
                                        'value' => $_POST['tk_giao_dich'],
                                        'compare' => '='
                                    ),
                                    array(
                                        'key' => 'ma_doi_tac',
                                        'value' => $_POST['tk_giao_dich'],
                                        'compare' => '='
                                    )
                                ),
                            );

                            $the_query = new WP_Query($arr);
                            $n = 1;
                            if ($the_query->have_posts()) :
                                ?>
                                <tr>
                                    <td><strong>ID</strong></td>
                                    <td><strong>Mã giao dịch</strong></td>
                                    <td><strong>Tiêu đề</strong></td>
                                    <td><strong>Tên khách sạn</strong></td>
                                    <td><strong>Khách đại diện</strong></td>
                                    <td><strong>Tên đối tác gửi đặt</strong></td>
                                    <td><strong>Mã đối tác</strong></td>
                                    <td><strong>Hình thức booking</strong></td>
                                    <td></td>
                                </tr>
                                <?php

                                while ($the_query->have_posts()) : $the_query->the_post();
                                    ?>
                                    <tr>
                                        <td><?php echo get_the_ID(); ?></td>
                                        <td><?php echo get_field('ma_giao_dich'); ?></td>
                                        <td class="title"><?php echo get_field('tieu_de'); ?></td>
                                        <td><?php echo get_field('ten_khach_san'); ?></td>
                                        <td><?php echo get_field('khach_dai_dien'); ?></td>
                                        <td><?php echo get_field('ten_doi_tac_gui_dat'); ?></td>
                                        <td><?php echo get_field('ma_doi_tac'); ?></td>
                                        <td><?php echo get_field('hinh_thuc_booking'); ?></td>
                                        <td><a class="view" href="<?php the_permalink(); ?>"><i class="fa fa-eye"
                                                                                                aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                endwhile;
                                $total_pages = $the_query->max_num_pages;
                                $current_page = max(1, get_query_var('paged'));
                            else :
                                echo "<td colspan='7'>Dữ liệu trống !</td>";
                            endif;
                            wp_reset_query();
                            ?>
                        </table>
                        <?php
                        if ($total_pages) :
                            echo '<nav class="nav">';
                            echo paginate_links(array(
                                'base' => get_pagenum_link(1) . '%_%',
                                'format' => 'giao-dich/page/%#%',
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

        </div>

        <?php
    } else {
        ?>
        <div id="content">
            <div class="quantri_admin">
                <div class="menu_admin">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-1',
                        'menu_id' => 'primary-menu',
                        'menu' => 'Admin'
                    ));
                    ?>
                </div>

                <div class="content_admin">
                    <div class="nav_filter">
                        <div class="filter">
                            <form action="<?php echo home_url('/'); ?>tim-kiem-giao-dich" method="post">
                                <label for="Tìm kiếm giao dịch"><strong>Tìm kiếm giao dịch : </strong></label>
                                <input type="text" name="tk_giao_dich" placeholder="Nhập từ khóa tìm kiếm ...">
                                <button type="submit" name="btn_tk_giao_dich"><i class="fa fa-search"
                                                                                 aria-hidden="true"></i></button>
                            </form>
                        </div>
                        <div class="sort">
                            <form action="<?php echo home_url('/'); ?>" method="get">
                                <select name="slt_sort">
                                    <option value="desc">Giao dịch mới nhất</option>
                                    <option value="asc">Giao dịch cũ nhất</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="giao_dich_moi">
                        <table>
                            <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $arr = array(
                                'post_type' => 'giao_dich',
                                'posts_per_page' => 10,
                                'order' => 'DESC',
                                'paged' => $paged,
                            );

                            $the_query = new WP_Query($arr);
                            $n = 1;
                            if ($the_query->have_posts()) :
                                ?>
                                <tr>
                                    <td><strong>ID</strong></td>
                                    <td><strong>Mã giao dịch</strong></td>
                                    <td><strong>Tiêu đề</strong></td>
                                    <td><strong>Tên khách sạn</strong></td>
                                    <td><strong>Khách đại diện</strong></td>
                                    <td><strong>Tên đối tác gửi đặt</strong></td>
                                    <td><strong>Mã đối tác</strong></td>
                                    <td><strong>Hình thức booking</strong></td>
                                    <td></td>
                                </tr>
                                <?php

                                while ($the_query->have_posts()) : $the_query->the_post();
                                    ?>
                                    <tr>
                                        <td><?php echo get_the_ID(); ?></td>
                                        <td><?php echo get_field('ma_giao_dich'); ?></td>
                                        <td class="title"><?php the_title(); ?></td>
                                        <td><?php echo get_field('ten_khach_san'); ?></td>
                                        <td><?php echo get_field('khach_dai_dien'); ?></td>
                                        <td><?php echo get_field('ten_doi_tac_gui_dat'); ?></td>
                                        <td><?php echo get_field('ma_doi_tac'); ?></td>
                                        <td><?php echo get_field('hinh_thuc_booking'); ?></td>
                                        <td><a class="view" href="<?php the_permalink(); ?>"><i class="fa fa-eye"
                                                                                                aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                endwhile;
                                $total_pages = $the_query->max_num_pages;
                                $current_page = max(1, get_query_var('paged'));
                            else :
                                echo "<td colspan='7'>Dữ liệu trống !</td>";
                            endif;
                            wp_reset_query();
                            ?>
                        </table>
                        <?php
                        if ($total_pages) :
                            echo '<nav class="nav">';
                            echo paginate_links(array(
                                'base' => get_pagenum_link(1) . '%_%',
                                'format' => 'giao-dich/page/%#%',
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

        </div>
        <?php
    }
    get_footer();
}else{
    ob_start();
    header("Location: ".home_url('/'));
    exit();
}