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
            ?>
        </div>

        <div class="content_admin">
            <div class="giao_dich_moi add_user add_khach_san">
                <?php
                    if(isset($_POST['sub_import_excel_hotel'])){
                        if ($_FILES['file_excel']['name'] != '') {
                            $filename = $_FILES['file_excel']['name'];
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                            if ($ext == 'xlsx') {
                                require_once get_template_directory(). '/inc/PHPExel/PHPExcel.php';

                                //Đường dẫn file
                                $file = $_FILES['file_excel']['tmp_name'];
                                //Tiến hành xác thực file
                                $objFile = PHPExcel_IOFactory::identify($file);
                                $objData = PHPExcel_IOFactory::createReader($objFile);

                                //Chỉ đọc dữ liệu
                                $objData->setReadDataOnly(true);

                                // Load dữ liệu sang dạng đối tượng
                                $objPHPExcel = $objData->load($file);

                                //Lấy ra số trang sử dụng phương thức getSheetCount();
                                // Lấy Ra tên trang sử dụng getSheetNames();

                                //Chọn trang cần truy xuất
                                $sheet = $objPHPExcel->setActiveSheetIndex(0);

                                //Lấy ra số dòng cuối cùng
                                $Totalrow = $sheet->getHighestRow();
                                //Lấy ra tên cột cuối cùng
                                $LastColumn = $sheet->getHighestColumn();

                                //Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
                                $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

                                //Tạo mảng chứa dữ liệu
                                $data = [];

                                //Tiến hành lặp qua từng ô dữ liệu
                                //----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
                                for ($i = 2; $i <= $Totalrow; $i++) {
                                    //----Lặp cột
                                    for ($j = 0; $j < $TotalCol; $j++) {
                                        // Tiến hành lấy giá trị của từng ô đổ vào mảng
                                        $data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                                    }
                                }
                                foreach ($data as $item){
                                    echo $item[0];
                                }
                                //Hiển thị mảng dữ liệu
                                echo '<pre>';
                            }else{
                                echo 'Sai định dạng !';
                            }
                        }else{
                            echo 'Chưa có file !';
                        }
                    }
                ?>
                <form action="<?php echo get_home_url('/'); ?>/import-excel-hotel/" method="post" enctype="multipart/form-data">
                    <input type="file" name="file_excel" class="file_excel">
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
