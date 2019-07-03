<tr>
    <td><?php echo get_field('ma_gd_them_booking'); ?></td>
    <td><?php
        echo get_field('ma_gd');
        echo '</br>';
        echo get_field('ma_gd_con');
        ?>
    </td>
    <td><?php echo get_field('ma_xac_nhan'); ?></td>
    <td><?php
        $args = array(
            'p'         => get_field('khach_dai_dien_gd'), // ID of a page, post, or custom type
            'post_type' => 'khach_hang'
        );
        $query_kh = new WP_Query($args);
        if($query_kh->have_posts()) :
            while ($query_kh->have_posts()) : $query_kh->the_post();
                if (!empty(get_field('ten_kgd'))){
                    echo get_field('ten_kgd');
                }else{
                    echo get_field('khach_dai_dien_gd');
                }
            endwhile;
        else :
            echo get_field('khach_dai_dien_gd');
        endif;
        wp_reset_postdata();
        ?>
    </td>
    <td><?php
        if(!empty($ten_khach_san_gd)){
            if ( (int)$ten_khach_san_gd == $ten_khach_san_gd ) {
                $query_name_hotel = new WP_Query(array(
                    'post_type' => 'hotel',
                    'p' => $ten_khach_san_gd,
                    'posts_per_page' => 1,
                ));

                if($query_name_hotel->have_posts()) : while ($query_name_hotel->have_posts()) : $query_name_hotel->the_post();
                    echo get_the_title();
                endwhile;
                else :
                    echo get_field('ten_khach_san_gd');
                endif;
                wp_reset_postdata();
            }else{
                echo get_field('ten_khach_san_gd');
            }
        }
        echo '<br>';
        ?>
    </td>
    <td>
        <?php echo $sl_gd; ?>
    </td>
    <td>
        <?php echo $loai_phong_ban_dt; ?>
    </td>
    <td><?php
        echo $ci_gd;
        echo '<br>';
        echo $co_gd;
        ?>
    </td>
    <td>
        <?php
        echo '<strong>'.$so_dem_gd.'</strong>';
        echo '<br>';
        echo $con_ngay_gd;
        ?>
    </td>
    <td width="12%"><?php
        $arr_chat = array(
            'post_type' => 'chat',
            'posts_per_page' => 1,
            'order' => 'DESC',
            'meta_key'		=> 'id_chat_gd',
            'meta_value' => $ma_gd_them_booking,
        );
        $query_chat = get_posts($arr_chat);
        if( $query_chat ): foreach( $query_chat as $post ):
            setup_postdata( $post );
            echo get_field('tin_nhan_chat');
        endforeach;
        else :
            echo 'Dữ liệu trống !';
        endif;
        wp_reset_postdata();
        ?>
    </td>
    <td><?php
        echo $con_ngay_dt;
        echo '<br>';
        echo $con_ngay_thay_doi_dt;
        ?>
    </td>
    <td><?php
        if(!empty($don_gia_ban_gd)){
            if (strpos($don_gia_ban_gd, ',') === false) {
                echo '<strong>'.number_format($don_gia_ban_gd,'0',',',',').'</strong>';
            }else{
                echo '<strong>'.$don_gia_ban_gd.'</strong>';
            }
        }
        echo '<br>';
        if(!empty($don_gia_ban_dt)){
            if (strpos($don_gia_ban_dt, ',') === false) {
                echo number_format($don_gia_ban_dt,'0',',',',');
            }else{
                echo $don_gia_ban_dt;
            }
        }
        ?>
    </td>
    <td><?php
        if(!empty($tong_gd)){
            if (strpos($tong_gd, ',') === false) {
                echo '<strong>'.number_format($tong_gd,'0',',',',').'</strong>';
            }else{
                echo '<strong>'.$tong_gd.'</strong>';
            }
        }
        echo '<br>';
        if(!empty($tong_dt)){
            if (strpos($tong_dt, ',') === false) {
                echo number_format($tong_dt,'0',',',',');
            }else{
                echo $tong_dt;
            }
        }
        ?>
    </td>
    <td><?php
        if(!empty($tong_pt)){
            if (strpos($tong_pt, ',') === false) {
                echo '<strong>'.number_format($tong_pt,'0',',',',').'</strong>';
            }else{
                echo '<strong>'.$tong_pt.'</strong>';
            }
        }
        echo '<br>';
        if(!empty($tong_pt)){
            if (strpos($tong_pt, ',') === false) {
                echo number_format($tong_pt,'0',',',',');
            }else{
                echo $tong_pt;
            }
        }
        ?>
    </td>
    <td><?php
        if(!empty($tong_gia_tri_khac)){
            if (strpos($tong_gia_tri_khac, ',') === false) {
                echo '<strong>'.number_format($tong_gia_tri_khac,'0',',',',').'</strong>';
            }else{
                echo '<strong>'.$tong_gia_tri_khac.'</strong>';
            }
        }
        echo '<br>';
        if(!empty($tong_gia_tri_khac2)){
            if (strpos($tong_gia_tri_khac2, ',') === false) {
                echo number_format($tong_gia_tri_khac2,'0',',',',');
            }else{
                echo $tong_gia_tri_khac2;
            }
        }
        ?>
    </td>
    <td><?php
        $a = $kh_con_no_khac;
        if(!empty($kh_con_no_khac)){
            if (strpos($a, ',') === false) {
                echo '<strong>'.number_format($kh_con_no_khac,'0',',',',').'</strong>';
            }else{
                echo '<strong>'.$kh_con_no_khac.'</strong>';
            }
        }else{
            echo 0;
        }
        echo '<br>';
        $b = $bct_con_no_khac2;
        if(!empty($bct_con_no_khac2)){
            if (strpos($b, ',') === false) {
                echo number_format($bct_con_no_khac2,'0',',',',');
            }else{
                echo $bct_con_no_khac2;
            }
        }else{
            echo 0;
        }
        ?>
    </td>

    <!-- <td><?php
    /*                                            echo '<strong>'.$trang_thai_bkk_voi_kh_gd.'</strong>';
                                                echo '<br>';
                                                echo $trang_thai_bkk_voi_dt;
                                            */?></td>-->
    <td>
        <a class="edit" href="<?php echo $the_permalink; ?>"><i
                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    </td>
</tr>