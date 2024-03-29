<?php
add_action("wp_ajax_excel_hotel", "excel_hotel");
add_action("wp_ajax_nopriv_excel_hotel", "excel_hotel");

function excel_hotel()
{
    $filename = $_FILES['file']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext == 'xlsx') {
        require_once get_template_directory(). '/inc/PHPExel/PHPExcel.php';
        //Đường dẫn file
        $file = $_FILES['file']['tmp_name'];
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
        $n=0;
        $data_check = array();
        foreach ($data as $item){
            if(!empty($item[1])){
                $add_post_kh = array(
                    'post_title' => $item[1],
                    'post_status' => 'publish',
                    'post_type' => 'khach_hang',
                );

                $post_id = wp_insert_post($add_post_kh);
                //19.20
                add_post_meta($post_id, 'ma_kgd', 'MKH_'.$post_id, true);
                add_post_meta($post_id, 'ten_kgd', $item[1], true);
                add_post_meta($post_id, 'sdt_kgd', $item[2], true);
                add_post_meta($post_id, 'email_kgd_duy_nhat', $item[3], true);
                add_post_meta($post_id, 'tk_kgd', $item[7], true);
                add_post_meta($post_id, 'don_vi_cong_tac_kh', $item[8], true);
                add_post_meta($post_id, 'loai_tai_khoan_khach_gd', $item[9], true);
                add_post_meta($post_id, 'nick_kgd', $item[4], true);
                add_post_meta($post_id, 'link_facebook_khach_gd', $item[10], true);
            }
        }

    }elseif ($ext == 'csv'){
        $file = $_FILES['file']['tmp_name'];
        $data = array_map('str_getcsv', file($file));
    }else{
        $data = 'error';
    }

    wp_send_json_success($data_check);

    die();
}