<?php
get_header();
?>
<div id="content">
    <div class="quantri_admin">
        <?php include get_template_directory(). '/template-parts/inc/template_menu.php'; ?>
        <?php

        $this_hotel_id = get_field('hotel_id');
        $this_hotel_name = get_field('hotel_name');
        $this_ID = get_the_ID();


        if(isset($_POST['sub_edit_khach_san'])){
            $array_user = array(
                'post_type' => 'hotel',
                'post_status' => 'publish'
            );

            $query = new WP_Query($array_user);

            if($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    /*if (get_field('hotel_id') == $_POST['hotel_id'] and $this_hotel_id != $_POST['hotel_id']) {
                        $alert = "<p class='alert_tk_fail'>ID đã tồn tại !</p>";
                    }elseif(get_field('hotel_name') == $_POST['hotel_name'] and $this_hotel_name != $_POST['hotel_name']){
                        $alert = "<p class='alert_tk_fail'>Tên khách sạn đã tồn tại !</p>";
                    }*/
                endwhile;
                wp_reset_postdata();
            }

            if(! isset($alert)){
                $update_user = array(
                    'ID'           => get_the_ID(),
                    //'post_title'   => $_POST['ten_ks'],
                );

                $post_id = wp_update_post($update_user);

                $group_ID = '1555';
                $fields = acf_get_fields($group_ID);
                foreach ($fields as $field){
                    if(!empty($_POST[$field['name']])){
                        if($field['name'] == "photo1"){

                        }elseif ($field['name'] == "photo2"){

                        }elseif ($field['name'] == "photo3"){

                        }elseif ($field['name'] == "photo4"){

                        }elseif ($field['name'] == "photo5"){

                        }else{
                            update_field( $field['name'], $_POST[$field['name']], $post_id );
                        }
                    }
                }

                if ($_FILES['photo1']['name'] != '') {
                    $file_name = $_FILES['photo1']['name'];
                    $array = explode(".", $file_name);
                    $name = $array[0];
                    $ext = $array[1];
                    if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'jpeg') {
                        $dir_base = get_template_directory_uri() . '/template-parts/images/';
                        $unlink_url_first = get_field('photo1');
                        $unlink_name = str_replace($dir_base,"",$unlink_url_first);

                        $dir_base_unfile = get_template_directory() . '/template-parts/images/';
                        $unlink_url = $dir_base_unfile . $unlink_name;
                        if(file_exists($unlink_url)){
                            unlink($unlink_url);
                        }

                        $path = __DIR__ . './../images/';
                        $file_name = "image_" . uniqid() . str_replace("image/", ".", $_FILES['photo1']['type']);
                        $location = $path . $file_name;
                        if (move_uploaded_file($_FILES['photo1']['tmp_name'], $location)) {

                            $check_file_name = $file_name;
                            $location_img = get_template_directory_uri() . '/template-parts/images/' . $check_file_name;
                            update_field('photo1', $location_img, $post_id);

                            $alert = "<p class='alert_tk_sucess'>Cập nhập thành công !</p>";
                        }
                    } else {
                        $alert = "<p class='alert_tk_fail'>Sai định dạng !</p>";
                    }
                }elseif ($_FILES['photo2']['name'] != '') {
                    $file_name = $_FILES['photo2']['name'];
                    $array = explode(".", $file_name);
                    $name = $array[0];
                    $ext = $array[1];
                    if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'jpeg') {
                        $dir_base = get_template_directory_uri() . '/template-parts/images/';
                        $unlink_url_first = get_field('photo2');
                        $unlink_name = str_replace($dir_base,"",$unlink_url_first);

                        $dir_base_unfile = get_template_directory() . '/template-parts/images/';
                        $unlink_url = $dir_base_unfile . $unlink_name;
                        if(file_exists($unlink_url)){
                            unlink($unlink_url);
                        }

                        $path = __DIR__ . './../images/';
                        $file_name = "image_" . uniqid() . str_replace("image/", ".", $_FILES['photo2']['type']);
                        $location = $path . $file_name;
                        if (move_uploaded_file($_FILES['photo2']['tmp_name'], $location)) {

                            $check_file_name = $file_name;
                            $location_img = get_template_directory_uri() . '/template-parts/images/' . $check_file_name;
                            update_field('photo2', $location_img, $post_id);

                            $alert = "<p class='alert_tk_sucess'>Cập nhập thành công !</p>";
                        }
                    } else {
                        $alert = "<p class='alert_tk_fail'>Sai định dạng !</p>";
                    }
                }elseif ($_FILES['photo3']['name'] != '') {
                    $file_name = $_FILES['photo3']['name'];
                    $array = explode(".", $file_name);
                    $name = $array[0];
                    $ext = $array[1];
                    if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'jpeg') {
                        $dir_base = get_template_directory_uri() . '/template-parts/images/';
                        $unlink_url_first = get_field('photo3');
                        $unlink_name = str_replace($dir_base,"",$unlink_url_first);

                        $dir_base_unfile = get_template_directory() . '/template-parts/images/';
                        $unlink_url = $dir_base_unfile . $unlink_name;
                        if(file_exists($unlink_url)){
                            unlink($unlink_url);
                        }

                        $path = __DIR__ . './../images/';
                        $file_name = "image_" . uniqid() . str_replace("image/", ".", $_FILES['photo3']['type']);
                        $location = $path . $file_name;
                        if (move_uploaded_file($_FILES['photo3']['tmp_name'], $location)) {

                            $check_file_name = $file_name;
                            $location_img = get_template_directory_uri() . '/template-parts/images/' . $check_file_name;
                            update_field('photo3', $location_img, $post_id);

                            $alert = "<p class='alert_tk_sucess'>Cập nhập thành công !</p>";
                        }
                    } else {
                        $alert = "<p class='alert_tk_fail'>Sai định dạng !</p>";
                    }
                }elseif ($_FILES['photo4']['name'] != '') {
                    $file_name = $_FILES['photo4']['name'];
                    $array = explode(".", $file_name);
                    $name = $array[0];
                    $ext = $array[1];
                    if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'jpeg') {
                        $dir_base = get_template_directory_uri() . '/template-parts/images/';
                        $unlink_url_first = get_field('photo4');
                        $unlink_name = str_replace($dir_base,"",$unlink_url_first);

                        $dir_base_unfile = get_template_directory() . '/template-parts/images/';
                        $unlink_url = $dir_base_unfile . $unlink_name;
                        if(file_exists($unlink_url)){
                            unlink($unlink_url);
                        }

                        $path = __DIR__ . './../images/';
                        $file_name = "image_" . uniqid() . str_replace("image/", ".", $_FILES['photo4']['type']);
                        $location = $path . $file_name;
                        if (move_uploaded_file($_FILES['photo4']['tmp_name'], $location)) {

                            $check_file_name = $file_name;
                            $location_img = get_template_directory_uri() . '/template-parts/images/' . $check_file_name;
                            update_field('photo4', $location_img, $post_id);

                            $alert = "<p class='alert_tk_sucess'>Cập nhập thành công !</p>";
                        }
                    } else {
                        $alert = "<p class='alert_tk_fail'>Sai định dạng !</p>";
                    }
                }elseif ($_FILES['photo5']['name'] != '') {
                    $file_name = $_FILES['photo5']['name'];
                    $array = explode(".", $file_name);
                    $name = $array[0];
                    $ext = $array[1];
                    if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'jpeg') {
                        $dir_base = get_template_directory_uri() . '/template-parts/images/';
                        $unlink_url_first = get_field('photo5');
                        $unlink_name = str_replace($dir_base,"",$unlink_url_first);

                        $dir_base_unfile = get_template_directory() . '/template-parts/images/';
                        $unlink_url = $dir_base_unfile . $unlink_name;
                        if(file_exists($unlink_url)){
                            unlink($unlink_url);
                        }

                        $path = __DIR__ . './../images/';
                        $file_name = "image_" . uniqid() . str_replace("image/", ".", $_FILES['photo5']['type']);
                        $location = $path . $file_name;
                        if (move_uploaded_file($_FILES['photo5']['tmp_name'], $location)) {

                            $check_file_name = $file_name;
                            $location_img = get_template_directory_uri() . '/template-parts/images/' . $check_file_name;
                            update_field('photo5', $location_img, $post_id);

                            $alert = "<p class='alert_tk_sucess'>Cập nhập thành công !</p>";
                        }
                    } else {
                        $alert = "<p class='alert_tk_fail'>Sai định dạng !</p>";
                    }
                }

                $alert = "<p class='alert_tk_sucess'>Cập nhập khách sạn thành công !</p>";
            }
        }
        ?>
        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san edit_khach_san gallery_hotel">
                <form action="<?php echo get_permalink(); ?>" method="post" enctype="multipart/form-data">
                    <?php if(isset($alert)){
                        echo $alert;
                    } ?>
                    <div class="add_hotel">
                        <div class="item">
                            <h1>Thông tin khách sạn</h1>
                            <ul>
                                <li>
                                    <label>Hotel Id</label>
                                    <input type="text" name="hotel_id" class="hotel_id" value="<?php echo get_the_ID(); ?>" required/>
                                </li>
                                <li>
                                    <label>Chain Id</label>
                                    <input type="text" name="chain_id" class="chain_id" value="<?php echo get_field('chain_id'); ?>"/>
                                </li>
                                <li>
                                    <label>Chain name</label>
                                    <input type="text" name="chain_name" class="chain_name" value="<?php echo get_field('chain_name'); ?>"/>
                                </li>
                                <li>
                                    <label>Brand Id</label>
                                    <input type="text" name="brand_id" class="brand_id" value="<?php echo get_field('brand_id'); ?>"/>
                                </li>
                                <li>
                                    <label>Brand name</label>
                                    <input type="text" name="brand_name" class="brand_name" value="<?php echo get_field('brand_name'); ?>"/>
                                </li>
                                <li>
                                    <label>Hotel name</label>
                                    <input type="text" name="hotel_name" class="hotel_name" value="<?php echo get_field('hotel_name'); ?>" required/>
                                </li>
                                <li>
                                    <label>Hotel formerly name</label>
                                    <input type="text" name="hotel_formerly_name" class="hotel_formerly_name" value="<?php echo get_field('hotel_formerly_name'); ?>"/>
                                </li>
                                <li>
                                    <label>Hotel translated name</label>
                                    <input type="text" name="hotel_translated_name" class="hotel_translated_name" value="<?php echo get_field('hotel_translated_name'); ?>"/>
                                </li>
                                <li>
                                    <label>Addressline1</label>
                                    <input type="text" name="addressline1" class="addressline1" value="<?php echo get_field('addressline1'); ?>"/>
                                </li>
                                <li>
                                    <label>Addressline2</label>
                                    <input type="text" name="addressline2" class="addressline2" value="<?php echo get_field('addressline2'); ?>"/>
                                </li>
                                <li>
                                    <label>Zipcode</label>
                                    <input type="text" name="zipcode" class="zipcode" value="<?php echo get_field('zipcode'); ?>"/>
                                </li>
                                <li>
                                    <label>City</label>
                                    <input type="text" name="city" class="city" value="<?php echo get_field('city'); ?>"/>
                                </li>
                                <li>
                                    <label>State</label>
                                    <input type="text" name="state" class="state" value="<?php echo get_field('state'); ?>"/>
                                </li>
                                <li>
                                    <label>Country</label>
                                    <input type="text" name="country" class="country" value="<?php echo get_field('country'); ?>"/>
                                </li>
                                <li>
                                    <label>Countryisocode</label>
                                    <input type="text" name="countryisocode" class="countryisocode" value="<?php echo get_field('countryisocode'); ?>"/>
                                </li>
                                <li>
                                    <label>Star rating</label>
                                    <input type="text" name="star_rating" class="star_rating" value="<?php echo get_field('star_rating'); ?>"/>
                                </li>
                                <li>
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" class="longitude" value="<?php echo get_field('longitude'); ?>"/>
                                </li>
                                <li>
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" class="latitude" value="<?php echo get_field('latitude'); ?>"/>
                                </li>
                                <li>
                                    <label>Checkin</label>
                                    <input type="text" name="checkin" class="checkin" value="<?php echo get_field('checkin'); ?>"/>
                                </li>
                                <li>
                                    <label>Checkout</label>
                                    <input type="text" name="checkout" class="checkout" value="<?php echo get_field('checkout'); ?>"/>
                                </li>
                                <li>
                                    <label>Numberrooms</label>
                                    <input type="text" name="numberrooms" class="numberrooms" value="<?php echo get_field('numberrooms'); ?>"/>
                                </li>
                                <li>
                                    <label>Numberfloors</label>
                                    <input type="text" name="numberfloors" class="numberfloors" value="<?php echo get_field('numberfloors'); ?>"/>
                                </li>
                                <li>
                                    <label>Yearopened</label>
                                    <input type="text" name="yearopened" class="yearopened" value="<?php echo get_field('yearopened'); ?>"/>
                                </li>
                                <li>
                                    <label>Yearrenovated</label>
                                    <input type="text" name="yearrenovated" class="yearrenovated" value="<?php echo get_field('yearrenovated'); ?>"/>
                                </li>
                                <li>
                                    <label>Overview</label>
                                    <input type="text" name="overview" class="overview" value="<?php echo get_field('overview'); ?>"/>
                                </li>
                                <li>
                                    <label>Rates from</label>
                                    <input type="text" name="rates_from" class=rates_from value="<?php echo get_field('rates_from'); ?>"/>
                                </li>
                                <li>
                                    <label>Continent Id</label>
                                    <input type="text" name="continent_id" class=continent_id value="<?php echo get_field('continent_id'); ?>"/>
                                </li>
                                <li>
                                    <label>Continent name</label>
                                    <input type="text" name="continent_name" class=continent_name value="<?php echo get_field('continent_name'); ?>"/>
                                </li>
                                <li>
                                    <label>City Id</label>
                                    <input type="text" name="city_id" class=city_id value="<?php echo get_field('city_id'); ?>"/>
                                </li>
                                <li>
                                    <label>Country Id</label>
                                    <input type="text" name="country_id" class=country_id value="<?php echo get_field('country_id'); ?>"/>
                                </li>
                                <li>
                                    <label>Number of reviews</label>
                                    <input type="text" name="number_of_reviews" class=number_of_reviews value="<?php echo get_field('number_of_reviews'); ?>"/>
                                </li>
                                <li>
                                    <label>Rating average</label>
                                    <input type="text" name="rating_average" class=rating_average value="<?php echo get_field('rating_average'); ?>"/>
                                </li>
                                <li>
                                    <label>Rates currency</label>
                                    <input type="text" name="rates_currency" class=rates_currency value="<?php echo get_field('rates_currency'); ?>"/>
                                </li>
                            </ul>
                        </div>
                        <div class="item">
                            <div class="view_detail_hotel">
                                <label>URL: </label>
                                <input type="text" name="url" class="url" value="<?php echo get_field('url'); ?>" required/>
                                <button type="button"  data-url="<?php echo get_field('url'); ?>">Xem</button>
                            </div>
                        </div>
                        <div class="item gallery">
                            <h1>Thư viện ảnh</h1>
                            <div>
                                <ul id="lightgallery">
                                    <li id="item" data-src="<?php
                                        if(!empty(get_field('photo1'))){
                                            echo get_field('photo1');
                                        }else{
                                            echo get_template_directory_uri().'/assets/images/empty.gif';
                                        }
                                    ?>" data-position="0">
                                        <div class="img <?php if(!empty(get_field('photo1'))){echo 'active';} ?>" style="background: url(<?php
                                            if(!empty(get_field('photo1'))){
                                                echo get_field('photo1');
                                            }else{
                                                echo get_template_directory_uri().'/assets/images/empty.gif';
                                            }
                                        ?>)">
                                            <img style="display: none;" src="<?php
                                            if(!empty(get_field('photo1'))){
                                                echo get_field('photo1');
                                            }else{
                                                echo get_template_directory_uri().'/assets/images/empty.gif';
                                            }
                                            ?>"/>
                                        </div>

                                        <i class="fa fa-times <?php if(empty(get_field('photo1'))){echo 'hide_edit';} ?>" aria-hidden="true" data-img="<?php echo get_template_directory_uri().'/assets/images/empty.gif'; ?>"></i>

                                        <div class="btn_add_img <?php if(!empty(get_field('photo1'))){echo 'hide_edit';} ?>">
                                            <button type="button" class="btn_add_img">Thêm ảnh</button>
                                            <input type="file" name="photo1" class="photo1" value="chọn ảnh">
                                        </div>
                                    </li>

                                    <li id="item" data-src="<?php
                                    if(!empty(get_field('photo2'))){
                                        echo get_field('photo2');
                                    }else{
                                        echo get_template_directory_uri().'/assets/images/empty.gif';
                                    }
                                    ?>" data-position="0">
                                        <div class="img <?php if(!empty(get_field('photo2'))){echo 'active';} ?>" style="background: url(<?php
                                        if(!empty(get_field('photo2'))){
                                            echo get_field('photo2');
                                        }else{
                                            echo get_template_directory_uri().'/assets/images/empty.gif';
                                        }
                                        ?>)">
                                            <img style="display: none;" src="<?php
                                            if(!empty(get_field('photo2'))){
                                                echo get_field('photo2');
                                            }else{
                                                echo get_template_directory_uri().'/assets/images/empty.gif';
                                            }
                                            ?>"/>
                                        </div>
                                        <i class="fa fa-times <?php if(empty(get_field('photo2'))){echo 'hide_edit';} ?>" aria-hidden="true" data-img="<?php echo get_template_directory_uri().'/assets/images/empty.gif'; ?>"></i>

                                        <div class="btn_add_img <?php if(!empty(get_field('photo2'))){echo 'hide_edit';} ?>">
                                            <button type="button" class="btn_add_img">Thêm ảnh</button>
                                            <input type="file" name="photo2" class="photo2" value="chọn ảnh">
                                        </div>
                                    </li>

                                    <li id="item" data-src="<?php
                                    if(!empty(get_field('photo3'))){
                                        echo get_field('photo3');
                                    }else{
                                        echo get_template_directory_uri().'/assets/images/empty.gif';
                                    }
                                    ?>" data-position="0">
                                        <div class="img <?php if(!empty(get_field('photo3'))){echo 'active';} ?>" style="background: url(<?php
                                        if(!empty(get_field('photo3'))){
                                            echo get_field('photo3');
                                        }else{
                                            echo get_template_directory_uri().'/assets/images/empty.gif';
                                        }
                                        ?>)">
                                            <img style="display: none;" src="<?php
                                            if(!empty(get_field('photo3'))){
                                                echo get_field('photo3');
                                            }else{
                                                echo get_template_directory_uri().'/assets/images/empty.gif';
                                            }
                                            ?>"/>
                                        </div>
                                        <i class="fa fa-times <?php if(empty(get_field('photo3'))){echo 'hide_edit';} ?>" aria-hidden="true" data-img="<?php echo get_template_directory_uri().'/assets/images/empty.gif'; ?>"></i>

                                        <div class="btn_add_img <?php if(!empty(get_field('photo3'))){echo 'hide_edit';} ?>">
                                            <button type="button" class="btn_add_img">Thêm ảnh</button>
                                            <input type="file" name="photo3" class="photo3" value="chọn ảnh">
                                        </div>
                                    </li>

                                    <li id="item" data-src="<?php
                                    if(!empty(get_field('photo4'))){
                                        echo get_field('photo4');
                                    }else{
                                        echo get_template_directory_uri().'/assets/images/empty.gif';
                                    }
                                    ?>" data-position="0">
                                        <div class="img <?php if(!empty(get_field('photo4'))){echo 'active';} ?>" style="background: url(<?php
                                        if(!empty(get_field('photo4'))){
                                            echo get_field('photo4');
                                        }else{
                                            echo get_template_directory_uri().'/assets/images/empty.gif';
                                        }
                                        ?>)">
                                            <img style="display: none;" src="<?php
                                            if(!empty(get_field('photo4'))){
                                                echo get_field('photo4');
                                            }else{
                                                echo get_template_directory_uri().'/assets/images/empty.gif';
                                            }
                                            ?>"/>
                                        </div>
                                        <i class="fa fa-times <?php if(empty(get_field('photo4'))){echo 'hide_edit';} ?>" aria-hidden="true" data-img="<?php echo get_template_directory_uri().'/assets/images/empty.gif'; ?>"></i>

                                        <div class="btn_add_img <?php if(!empty(get_field('photo4'))){echo 'hide_edit';} ?>">
                                            <button type="button" class="btn_add_img">Thêm ảnh</button>
                                            <input type="file" name="photo4" class="photo4" value="chọn ảnh">
                                        </div>
                                    </li>

                                    <li id="item" data-src="<?php
                                        if(!empty(get_field('photo5'))){
                                            echo get_field('photo5');
                                        }else{
                                            echo get_template_directory_uri().'/assets/images/empty.gif';
                                        }
                                    ?>" data-position="0">
                                        <div class="img <?php if(!empty(get_field('photo5'))){echo 'active';} ?>" style="background: url(<?php
                                            if(!empty(get_field('photo5'))){
                                                echo get_field('photo5');
                                            }else{
                                                echo get_template_directory_uri().'/assets/images/empty.gif';
                                            }
                                        ?>)">
                                            <img style="display: none;" src="<?php
                                                if(!empty(get_field('photo5'))){
                                                    echo get_field('photo5');
                                                }else{
                                                    echo get_template_directory_uri().'/assets/images/empty.gif';
                                                }
                                            ?>"/>
                                        </div>
                                        <i class="fa fa-times <?php if(empty(get_field('photo5'))){echo 'hide_edit';} ?>" aria-hidden="true" data-img="<?php echo get_template_directory_uri().'/assets/images/empty.gif'; ?>"></i>

                                        <div class="btn_add_img <?php if(!empty(get_field('photo5'))){echo 'hide_edit';} ?>">
                                            <button type="button" class="btn_add_img">Thêm ảnh</button>
                                            <input type="file" name="photo5" class="photo5" value="chọn ảnh">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="item type_room" id="type_room">
                            <h1>Giá phòng và loại phòng</h1>

                            <ul>
                                <li>
                                    <label>Tên phòng : </label>
                                    <input type="text" class="room_name_ks">
                                </li>
                                <!--<li>
                                    <label>Date : </label>
                                    <input type="text" data-date-format="dd/mm/yyyy" data-position="top left" class="date_price_ks datepicker-here" data-language='en'>
                                </li>-->
                                <li>
                                    <label>Giá bán : </label>
                                    <input type="text" class="gia_tien_kh_add">
                                </li>
                                <li>
                                    <label>Giá mua : </label>
                                    <input type="text" class="gia_tien_dt_add">
                                    <button type="button" class="add_rom" data-id="<?php echo $this_ID; ?>">Thêm</button>
                                </li>
                            </ul>

                            <ul class="show_list_ds">
                                <li>
                                    <strong>Danh sách loại phòng</strong>
                                    <div class="list_room">
                                        <?php
                                            $query_room = new WP_Query(array(
                                                'post_type' => 'room',
                                                'posts_per_page' => 10,
                                                'meta_key'		=> 'id_khach_san',
                                                'meta_value'	=> get_the_ID(),
                                                'order' => 'DESC'
                                            ));

                                            if($query_room->have_posts()) : while ($query_room->have_posts()) : $query_room->the_post();
                                        ?>
                                        <div class="room">
                                            <div class="content">
                                                <div class="item">
                                                    <!--<label>Room name :</label>-->
                                                    <input type="text" value="<?php echo get_field('ten_phong'); ?>" class="item_room_name" data-id="<?php echo get_the_ID(); ?>" disabled>
                                                </div>

                                                <div class="item">
                                                    <!--<label>Price :</label>-->
                                                    <input type="text" value="<?php echo get_field('gia_tien_kh'); ?>" class="gia_tien_kh" disabled>
                                                </div>

                                                <div class="item">
                                                    <!--<label>Price :</label>-->
                                                    <input type="text" value="<?php echo get_field('gia_tien_dt'); ?>" class="gia_tien_dt" disabled>
                                                </div>
                                            </div>

                                            <div class="btn">
                                                <span class="save"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>
                                                <span class="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                                <span class="del"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                        <?php
                                            endwhile;
                                            endif;
                                            wp_reset_postdata();
                                        ?>
                                    </div>
                                </li>
                            </ul>

                            <div class="calendar_hotel" style="display:none !important;">
                                <div class="date_hotel">
                                    <div class="month_hotel">
                                        <div class="insider">
                                            <div class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
                                            <h3 class="animated bounce ">Month <span>5</span></h3>
                                            <div class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                                        </div>
                                        <button type="button" class="btn_close"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </div>
                                    <ul class="list_date_box"></ul>
                                    <div class="option_date_hotel">
                                        <ul>
                                            <li>
                                                <span>Ngày thường</span>
                                                <span><input type="checkbox" name="check_date_regular" class="check_date_regular"/></span>
                                            </li>
                                            <li>
                                                <span>Ngày cuối tuần</span>
                                                <span><input type="checkbox" name="check_date_last_week" class="check_date_regular"/></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="load_url_iframe">
                        <button type="button" class="btn_close"><i class="fa fa-times" aria-hidden="true"></i></button>
                        <div class="screen"></div>
                    </div>

                    <div class="acf-form-submit" style="margin-top: 15px;">
                        <input type="submit" name="sub_edit_khach_san" value="Cập nhập">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    ?>
