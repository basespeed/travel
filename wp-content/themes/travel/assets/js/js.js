( function( $ ) {
    "use strict";

    var testMobile;
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    var parallax = function() {
        testMobile = isMobile.any();
        if (testMobile == null) {
            $(".parallax").parallax("50%", 0.3);
        }
    };

    function base() {
        var change_label_title =  $('.acf-field--post-title .acf-label label');
        var insert_icon_menu_admin = $('.menu-item-has-children');
        var disable_edit_giao_dich = $( ".single-history_giao_dich input");
        var disable_edit_giao_dich2 = $( ".single-history_giao_dich select");
        var disable_edit_giao_dich3 = $( ".single-history_giao_dich textarea");
        var disable_edit_giao_dich_view = $( ".view_fix input");
        var disable_edit_giao_dich2_view = $( ".view_fix select");
        var disable_edit_giao_dich3_view = $( ".view_fix textarea");

        change_label_title.text('Tiêu đề');
        insert_icon_menu_admin.append('<i class="fa fa-caret-down" aria-hidden="true"></i>');
        disable_edit_giao_dich.prop( "disabled", true );
        disable_edit_giao_dich2.prop( "disabled", true );
        disable_edit_giao_dich3.prop( "disabled", true );

        disable_edit_giao_dich_view.prop( "disabled", true );
        disable_edit_giao_dich2_view.prop( "disabled", true );
        disable_edit_giao_dich3_view.prop( "disabled", true );

        /*$('.ngay_cập_nhập_giao_dịch_cuối_cung').prop( "disabled", true );
        $('.so_dem_gd').prop( "disabled", true );
        $('.con_ngay_gd').prop( "disabled", true );*/


    }

    function datePicker() {
        $('.datepicker').data('datepicker');
    }

    function Isotope() {
        $('.giao_dich_news .khach_hang').isotope({
            // set itemSelector so .grid-sizer is not used in layout
            itemSelector: '.item',
            percentPosition: true,
            masonry: {
                // use element for option
                columnWidth: '.item-sizer'
            }
        });
        $('.giao_dich_news .doi_tac').isotope({
            // set itemSelector so .grid-sizer is not used in layout
            itemSelector: '.item',
            percentPosition: true,
            masonry: {
                // use element for option
                columnWidth: '.item-sizer'
            }
        });
        $('.giao_dich_edits .khach_hang').isotope({
            // set itemSelector so .grid-sizer is not used in layout
            itemSelector: '.item',
            percentPosition: true,
            masonry: {
                // use element for option
                columnWidth: '.item-sizer'
            }
        });
        $('.giao_dich_edits .doi_tac').isotope({
            // set itemSelector so .grid-sizer is not used in layout
            itemSelector: '.item',
            percentPosition: true,
            masonry: {
                // use element for option
                columnWidth: '.item-sizer'
            }
        });
    }

    function ajaxDel() {
        var btn_del = $('.giao_dich_moi .del_edit');

        btn_del.on('click', function () {
            var data_title = $(this).attr('data-title');
            var data_id = $(this).attr('data-id');

            var check = confirm('Bạn có chắc muốn xóa : '+data_title);
            if(check == true){
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {action: "delete_giao_dich", data_id : data_id, data_title: data_title},
                    success: function(response){

                    }
                });
            }else{
                return false;
            }
        });

        var btn_del_user = $('.giao_dich_moi .del_user');
        btn_del_user.on('click',function () {
            var data_email = $(this).attr('data-email');
            var data_img = $(this).attr('data-img');
            var data_id = $(this).attr('data-id');

            var check = confirm('Bạn có chắc muốn xóa : '+data_email);
            if(check == true){
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {action: "delete_tai_khoan", data_id : data_id, data_img: data_img},
                    success: function(response){

                    }
                });
                //return false;
            }else{
                return false;
            }
        });
    }

    function checkSelect() {
        var ClassSelect = [
            'ten_khach_san_gd',
            'ten_dt_gui_book_dt',
            'trang_thai_bkk_voi_kh_gd',
            'trang_thai_bkk_voi_dt',
            'loai_phong_ban_gd',
            'loai_phong_ban_dt',
            'goi_dv_km_ban_dt',
            'goi_dv_km_ban_gd',
            'xep_hang_kgd',
            'don_vi_gd',
            'don_vi_dt',
            'email_tai_khoan',
            'bo_phan_tai_khoan',
            'bo_phan_nv',
            'muc_do_uu_tien_chat',
            'muc_do_uu_tien_chat_mess',
            'bo_phan_chat_mess',
            'loai_quyen_tai_khoan',
            'noi_di_gd',
            'noi_den_gd'
        ];

        $.each(ClassSelect , function(index, val) {
            $('.'+val).val($('.'+val).attr('data-check'));
        });

        $('.ten_khach_san_gd').change(function(e){
            e.preventDefault();
            var element = $(this).find('option:selected');
            var myID = element.attr("data-id");
            var data_room = element.attr('data-room');
            var loai_phong_ban_gd = $('.loai_phong_ban_gd');
            var loai_phong_ban_dt = $('.loai_phong_ban_dt');

            $('.ma_dich_vu_gd').val(myID);

            var array_room = data_room.split(",");

            loai_phong_ban_gd.empty();
            loai_phong_ban_dt.empty();

            loai_phong_ban_gd.append(' <option value="" selected disabled hidden>Chọn loại phòng</option>');
            loai_phong_ban_dt.append(' <option value="" selected disabled hidden>Chọn loại phòng</option>');

            $.each(array_room , function(index, val) {
                var array_room_data  = val.split(":");
                loai_phong_ban_gd.append('<option value="'+array_room_data[0]+'" data-price="'+array_room_data[1]+'">'+array_room_data[0]+'</option>');
                loai_phong_ban_dt.append('<option value="'+array_room_data[0]+'" data-price="'+array_room_data[1]+'">'+array_room_data[0]+'</option>');
            });

        });

        $('.loai_phong_ban_gd').on('change', function (e) {
            e.preventDefault();
            var element = $(this).find('option:selected');
            var price = element.attr("data-price");

            $('input.don_gia_ban_gd').attr('value', parseInt(price));
        });

        $('.loai_phong_ban_dt').on('change', function (e) {
            e.preventDefault();
            var element = $(this).find('option:selected');
            var price = element.attr("data-price");

            $('input.don_gia_ban_dt').attr('value', parseInt(price));
        });

        $('.sl_gd').attr('value', parseInt(1));
        $('.sl_dt').attr('value', parseInt(1));

        setInterval(function () {
            var sl_gd = $('.sl_gd').val();
            var don_gia_ban_gd = $('.don_gia_ban_gd').val();
            var sl_dt = $('.sl_dt').val();
            var don_gia_ban_dt = $('.don_gia_ban_dt').val();

            $('.tong_gd').val(sl_gd * don_gia_ban_gd);
            $('.tong_dt').val(sl_dt * don_gia_ban_dt);
        },1000);

        $('.ten_dt_gui_book_dt').change(function(){
            var element = $(this).find('option:selected');
            var myID_DT = element.attr("data-id");

            $('.ma_dt').val(myID_DT);
        });
    }

    function CountGetData(){
        if(! $('.them_giao_dich').hasClass('sua_giao_dich')){
            if($('.datepicker-here').hasClass('ci_gd')){
                setInterval(function () {
                    var date_in = $('.ci_gd').val();
                    if(typeof date_in !== 'undefined' || date_in != "") {
                        date_in = date_in.replace('/', "");
                        date_in = date_in.replace('/', "");
                        var d_in = date_in.slice(0, 2);
                        var m_in = date_in.slice(2, 4);
                        var y_in = date_in.slice(4, 8);
                        var join_string_in = parseInt(y_in + m_in + d_in);


                        var date_out = $('.co_gd').val();
                        date_out = date_out.replace('/', "");
                        date_out = date_out.replace('/', "");
                        var d_out = date_out.slice(0, 2);
                        var m_out = date_out.slice(2, 4);
                        var y_out = date_out.slice(4, 8);
                        var join_string_out = parseInt(y_out + m_out + d_out);

                        if (date_out != "" && date_in != "") {
                            $('.so_dem_gd').attr('value', join_string_out - join_string_in);
                        }

                        var now = new Date();
                        var year = now.getFullYear();
                        var month = now.getMonth() + 1;
                        var day = now.getDate();
                        var hour = now.getHours();
                        var minute = now.getMinutes();
                        var second = now.getSeconds();
                        if (month.toString().length == 1) {
                            var month = '0' + month;
                        }
                        if (day.toString().length == 1) {
                            var day = '0' + day;
                        }
                        if (hour.toString().length == 1) {
                            var hour = '0' + hour;
                        }
                        if (minute.toString().length == 1) {
                            var minute = '0' + minute;
                        }
                        if (second.toString().length == 1) {
                            var second = '0' + second;
                        }
                        var datetime = year + '/' + month + '/' + day;
                        datetime = datetime.replace('/', "");
                        datetime = datetime.replace('/', "");

                        $('.con_ngay_gd').attr('value', parseInt(join_string_in) - parseInt(datetime));
                    }
                },1);
            }
        }
    }

    function uploadFileImage() {
        var img_screen = $('.anh_dai_dien').val();
        if(typeof img_screen !== 'undefined'){
            $('.anh_dai_dien').change(function (e) {
                e.preventDefault();
                var tmppath = URL.createObjectURL(event.target.files[0]);
                $('.screen_user .img img').attr('src',tmppath);
                $('.screen_user .img img').fadeIn();
                var filename = $('.anh_dai_dien').val().split('\\').pop();
                $('.btn_upload_image').text(filename);
            });

            $('.btn_upload_image').on('click',function (e) {
                e.preventDefault();
                $('.anh_dai_dien').click();
            });
        }

        setInterval(function () {
            var email = $('.email_tai_khoan');
            var pass = $('.mat_khau_tai_khoan');
            var name = $('.ho_va_ten_tai_khoan');
            var bietdanh = $('.ten_biet_danh_tai_khoan');
            var sdt = $('.sdt_tai_khoan');
            var cmt = $('.cmt_tai_khoan');
            var quyen = $('.loai_quyen_tai_khoan');
            var local = $('.dia_chi_tai_khoan');
            var img_screen = $('.anh_dai_dien').val();
            var img_screen_check_src = $('.screen_user .img img').attr('src');

            if(typeof img_screen !== 'undefined'){
                var filePath = img_screen;
                var file_ext = filePath.substr(filePath.lastIndexOf('.')+1,filePath.length);
                if(file_ext == "png" || file_ext == "jpg" || file_ext == "gif"){
                    if(img_screen){
                        $('.screen_user').fadeIn();
                    }else{
                        $('.screen_user').fadeOut();
                    }
                }else if(img_screen_check_src != ""){
                    $('.screen_user').fadeIn();
                    $('.screen_user .img img').fadeIn();
                }else{
                    $('.screen_user').fadeOut();
                }
            }

            if(typeof email.val() !== 'undefined') {
                $('.screen_user .email_screen span').text(email.val());
                if(email.val() != ""){
                    $('.screen_user .email_screen').fadeIn();
                }else{
                    $('.screen_user .email_screen').fadeOut();
                }
            }
            if(typeof pass.val() !== 'undefined') {
                $('.screen_user .pass_screen input').val(pass.val());
                if(pass.val() != ""){
                    $('.screen_user .pass_screen').fadeIn();
                }else{
                    $('.screen_user .pass_screen').fadeOut();
                }
            }
            if(typeof bietdanh.val() !== 'undefined') {
                $('.screen_user .biet_danh_screen span').text('Biệt danh: '+bietdanh.val());
                if(bietdanh.val() != ""){
                    $('.screen_user .biet_danh_screen').fadeIn();
                }else{
                    $('.screen_user .biet_danh_screen').fadeOut();
                }
            }
            if(typeof name.val() !== 'undefined') {
                $('.screen_user .name_screen span').text('Họ và tên: '+name.val());
                if(name.val() != ""){
                    $('.screen_user .name_screen').fadeIn();
                }else{
                    $('.screen_user .name_screen').fadeOut();
                }
            }
            if(typeof sdt.val() !== 'undefined') {
                $('.screen_user .tel_screen span').text(sdt.val());
                if(sdt.val() != ""){
                    $('.screen_user .tel_screen').fadeIn();
                }else{
                    $('.screen_user .tel_screen').fadeOut();
                }
            }
            if(typeof cmt.val() !== 'undefined') {
                $('.screen_user .cmt_screen span').text(cmt.val());
                if(cmt.val() != ""){
                    $('.screen_user .cmt_screen').fadeIn();
                }else{
                    $('.screen_user .cmt_screen').fadeOut();
                }
            }
            if(typeof quyen.val() !== 'undefined') {
                $('.screen_user .quyen_screen span').text(quyen.val());
                if(quyen.val() != ""){
                    $('.screen_user .quyen_screen').fadeIn();
                }else{
                    $('.screen_user .quyen_screen').fadeOut();
                }
            }
            if(typeof local.val() !== 'undefined') {
                $('.screen_user .local_screen span').text(local.val());
                if(local.val() != ""){
                    $('.screen_user .local_screen').fadeIn();
                }else{
                    $('.screen_user .local_screen').fadeOut();
                }
            }
        },500);
    }

    function checkLogin() {
        var btn_login = $('.sub_login');

        btn_login.on('click',function () {
            var check_user = $('.form .insider .tai_khoan').val();
            var check_pass = $('.form .insider .mat_khau').val();

            $.ajax({
                type: "post",
                dataType: "json",
                url: my_ajax_object.ajax_url,
                data: {action: "check_login", check_user : check_user, check_pass: check_pass},
                success: function(response){
                    if(response.data == "fail"){
                        $('.form .insider .alert').html("<span class='fail'>Tài khoản hoặc mật khẩu không đúng !</span>");
                    }else if(response.data == "empty"){
                        $('.form .insider .alert').html("<span class='fail'>Hệ thống bảo trì !</span>");
                    }else if(response.data == "sucess"){
                        $('.form .insider .alert').html("<span class='sucess'>Đăng nhập thành công !</span>");
                        setTimeout(function () {
                            $('.form .insider .alert').html("<span class='sucess'>Đang chuyển đến trang quản trị ! Vui lòng đợi...</span>");
                        },1000);

                        setTimeout(function () {
                            window.location.replace(response.data);
                        },2000);
                    }
                }
            });
        });
    }

    function checklogout() {
        var BtnLogout = $('.logout');
        BtnLogout.on('click',function () {
            $.ajax({
                type: "post",
                dataType: "json",
                url: my_ajax_object.ajax_url,
                data: {action: "check_logout"},
                success: function(response){
                    window.location.replace(response.data);
                }
            });
        });
    }

    function NiceScroll() {
        $("body,html").niceScroll({
            cursorcolor:"#23262B",
            cursorwidth: "10px",
            cursorborderradius: "5px",
            cursorminheight: 32,
            cursorborder: "1px solid #23262B",
            scrollspeed: 60,
        });
        $(".content_admin").niceScroll({
            cursorcolor:"#23262B",
            cursorwidth: "10px",
            cursorborderradius: "5px",
            cursorminheight: 32,
            cursorborder: "1px solid #23262B",
            scrollspeed: 60,
        });
        $(".quantri_admin .menu_admin ul .sub-menu").niceScroll({
            cursorcolor:"#23262B",
            cursorwidth: "10px",
            cursorborderradius: "5px",
            cursorminheight: 32,
            cursorborder: "1px solid #23262B",
            scrollspeed: 60,
        });
        $(".quantri_admin .my_friend").niceScroll({
            cursorcolor:"#23262B",
            cursorwidth: "10px",
            cursorborderradius: "5px",
            cursorminheight: 32,
            cursorborder: "1px solid #23262B",
            scrollspeed: 60,
        });
        $(".select2-results__options").niceScroll({
            cursorcolor:"#23262B",
            cursorwidth: "10px",
            cursorborderradius: "5px",
            cursorminheight: 32,
            cursorborder: "1px solid #23262B",
            scrollspeed: 60,
        });
    }

    function search_email() {
        var options = $('.email_tai_khoan option').clone();
        //react on keyup in textbox
        $('.search_email').keyup(function () {
            var val = $(this).val();
            $('.email_tai_khoan').empty();
            //take only the options containing your filter text or all if empty
            options.filter(function (idx, el) {
                return val === '' || $(el).text().indexOf(val) >= 0;
            }).appendTo('.email_tai_khoan');//add it to list

            if($('.add_user ul li input').hasClass('search_email')){
                var email_tk = $('.email_tai_khoan').val();
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {action: "join_user_nv",email_tk : email_tk},
                    success: function(response){
                        $('.ho_va_ten_tai_khoan').val(response.data[0]);
                        $('.sdt_tai_khoan').val(response.data[1]);
                        $('.lien_ket_tai_khoan').val(response.data[2]);
                        $('.bo_phan_tai_khoan').val(response.data[3]);
                    }
                });
            }
        });

        $('.email_tai_khoan').change(function () {
            if($('.add_user ul li input').hasClass('search_email')){
                var email_tk = $(this).val();
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {action: "join_user_nv",email_tk : email_tk},
                    success: function(response){
                        $('.ho_va_ten_tai_khoan').val(response.data[0]);
                        $('.sdt_tai_khoan').val(response.data[1]);
                        $('.lien_ket_tai_khoan').val(response.data[2]);
                        $('.bo_phan_tai_khoan').val(response.data[3]);
                    }
                });
            }
        });
    }

    function checkOnline() {
        setInterval(function () {
            var search_user_chat = $('.search_user_chat');
            if(search_user_chat.val() == ""){
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {action: "check_online"},
                    success: function(response){
                        var input_gd = $('input.search_gd');
                        var slt_search_giao_dich = $(".slt_search_giao_dich");

                        $('.my_friend .list_user_on').html(response.data);
                        //console.log(response);

                        $('.chatbox .my_friend ul li').on('click', function (e) {
                            e.preventDefault();
                            var data_name = $(this).attr('data-name');

                            $('.form_chat h2 span').text(data_name);
                        });
                    }
                });
            }else{
                var val_user_on = search_user_chat.val();
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {action: "search_user_online",val_user_on:val_user_on},
                    success: function(response){
                        $('.my_friend .list_user_on').html(response.data);

                        $('.chatbox .my_friend ul li').on('click', function (e) {
                            e.preventDefault();
                            var data_name = $(this).attr('data-name');

                            $('.form_chat h2 span').text(data_name);
                        });
                    }
                });
            }
        },3000);

        window.addEventListener('beforeunload', function (e) {
            // Cancel the event
            e.preventDefault();
            // Chrome requires returnValue to be set
            $.ajax({
                type: "post",
                dataType: "json",
                url: my_ajax_object.ajax_url,
                data: {action: "check_offline"},
                success: function(response){
                    e.returnValue = '';
                }
            });
        });
    }

    function SendMessage() {
        var btn_send_chat = $('.btn_send_chat');

        btn_send_chat.on('click',function (e) {
           e.preventDefault();
            var tin_nhan_chat = $('.tin_nhan_chat').val();
            var bo_phan_chat = $('.bo_phan_chat').val();
            var muc_do_uu_tien_chat = $('.muc_do_uu_tien_chat').val();
            var trang_thai_chat = $('.trang_thai_chat').val();
            var ngay_can_nhac_lai_chat = $('.ngay_can_nhac_lai_chat').val();
            var ma_nhan_vien_chat = $('.ma_nhan_vien_chat').val();
            var id_chat_gd = $('.id_chat_gd').val();
            var curren_url_chat = $(location).attr("href");
            var reply_chat = $('input.reply_chat').val();
            var id_reply = $('.id_reply').val();

            if(tin_nhan_chat == ""){
                alert('Nhập lời nhắn trống !');
            }else if(bo_phan_chat == ""){
                alert('Bộ phận trống !');
            }else if(muc_do_uu_tien_chat == ""){
                alert('Mức độ ưu tiên trống !');
            }else if(ngay_can_nhac_lai_chat == ""){
                alert('Ngày cần nhắc lại trống !');
            }else if(ma_nhan_vien_chat == ""){
                alert('Mã nhân viên trống !');
            }else{
                var count_chat = parseInt($('.count_chat').attr('data-count'));

                count_chat += 1;

                //alert(reply_chat);

                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "send_mess",
                        tin_nhan_chat:tin_nhan_chat,
                        bo_phan_chat:bo_phan_chat,
                        muc_do_uu_tien_chat:muc_do_uu_tien_chat,
                        trang_thai_chat:trang_thai_chat,
                        ngay_can_nhac_lai_chat:ngay_can_nhac_lai_chat,
                        ma_nhan_vien_chat:ma_nhan_vien_chat,
                        id_chat_gd:id_chat_gd,
                        count_chat:count_chat,
                        curren_url_chat:curren_url_chat,
                        reply_chat:reply_chat,
                        id_reply:id_reply
                    },
                    success: function(response){
                        $('.send_chat td textarea').val();
                    }
                });
            }
        });

        if($('.them_giao_dich').hasClass('sua_giao_dich')) {
            var loadListMess = setInterval(function () {
                var show_chat_id = $('.them_giao_dich.sua_giao_dich .show_chat_table').attr('data-id');
                var count_chat = parseInt($('table.show_chat_table tbody .count_chat').attr('data-count'));
                var ma_nhan_vien_chat = $('.ma_nhan_vien_chat').val();

                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "load_chat_real_time",
                        show_chat_id:show_chat_id,
                        count_chat:count_chat
                    },
                    success: function (response) {
                        if(response != "stop"){
                            $('.them_giao_dich.sua_giao_dich .show_chat_table tbody').html(response);
                            $('.muc_do_uu_tien_chat_mess').filter(function () {
                                $(this).val($(this).attr('data-check'));
                            });
                            $('select.bo_phan_chat_mess').filter(function () {
                                $(this).val($(this).attr('data-check'));
                            });
                        }
                    }
                });
            }, 3000);

            var selectCheck = setInterval(function () {
                $('.muc_do_uu_tien_chat_mess').filter(function () {
                    $(this).val($(this).attr('data-check'));
                });
                $('select.bo_phan_chat_mess').filter(function () {
                    $(this).val($(this).attr('data-check'));
                });
            },500);

            setInterval(function () {
                var show_chat_id = $('.them_giao_dich.sua_giao_dich .show_chat_table').attr('data-id');
                var count_chat = parseInt($('table.show_chat_table tbody .count_chat').attr('data-count'));
                var ma_nhan_vien_chat = $('.ma_nhan_vien_chat').val();

                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "load_chat_notifications",
                        show_chat_id:show_chat_id,
                        count_chat:count_chat,
                        ma_nhan_vien_chat:ma_nhan_vien_chat
                    },
                    success: function (response) {
                        //console.log(response.data[1] + '--' + ma_nhan_vien_chat);
                        if(response.data[0] != 'stop'){
                            if(response.data[1] == ma_nhan_vien_chat){

                            }else{

                                //console.log(response.data[0] + '---' + response.data[1] + '---' + ma_nhan_vien_chat);
                            }

                            let notify;
                            if(Notification.permission === 'default'){
                                //alert('Please allow notification before doing this');
                            }else {
                                notify = new Notification('Tin nhắn mới của '+response.data[1], {
                                    body: response.data[2],
                                    icon: response.data[0],
                                    image: $('.acf-form-submit').attr('data-img'),
                                });

                                notify.onclick = function (ev) {
                                    //console.log(this);
                                    var url_current = response.data[3]+'#show_chat';
                                    window.open(url_current, '_blank');
                                }
                            }
                        }else{
                            //console.log(response.data[0] + '---' + ma_nhan_vien_chat);
                        }
                    }
                });
            },3000);
        }

        $(document).on('click','.btn_edit_chat',function (e) {
            e.preventDefault();
            $(this).parent().html('<button type="button" class="btn_update_chat"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>');
            clearInterval(loadListMess);
            clearInterval(selectCheck);
        });

        $(document).on('click','.show_chat',function (e) {
            e.preventDefault();
            var target = $( e.target );
            if ( target.is( "button.reply" ) || target.is( "button.reply i" ) ) {
                var chat_mess = $(this).find('textarea.tn').val();
                var bo_phan_chat_mess = $(this).find('.bo_phan_chat_mess').val();
                var muc_do_uu_tien_chat_mess = $(this).find('.muc_do_uu_tien_chat_mess').val();
                var ngay_chat = $(this).find('td:nth-child(1) span:nth-child(1)').text();
                var name_chat = $(this).find('.change_update_send_mess').attr('data-name');
                var data_id = $(this).attr('data-id');

                $('.trang_thai_chat').val('Đang xử lý');
                $('table tfoot tr.send_chat td:nth-child(1) span').html("<span>Trả lời : "+"Ngày nhập vào : "+ngay_chat+" # Mã nhân viên : "+name_chat+" # Lời nhắn : "+chat_mess+"</span> <i class=\"fa fa-times\" aria-hidden=\"true\"></i>");
                $('.reply_chat').val("Trả lời : "+"Ngày nhập vào : "+ngay_chat+" # Mã nhân viên : "+name_chat+" # Lời nhắn : "+chat_mess);
                $('.send_chat td:first-child span i').on('click',function () {
                    $('.send_chat td:first-child span').empty();
                    $('.trang_thai_chat').val('Đã chờ');
                });
                $('.id_reply').val(data_id);

                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "check_button_reply",
                        data_id:data_id,
                    },
                    success: function (response) {

                    }
                });

                //alert('Trả lời: "'+ngay_chat +'---'+ name_chat +'---'+ chat_mess+'"');

            }
        });

        $(document).on('click','.btn_update_chat',function (e) {
            e.preventDefault();
            $(this).parent().html('<button type="button" class="btn_edit_chat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>');
            loadListMess = setInterval(function () {
                var show_chat_id = $('.them_giao_dich.sua_giao_dich .show_chat_table').attr('data-id');
                var count_chat = parseInt($('table.show_chat_table tbody .count_chat').attr('data-count'));

                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "load_chat_real_time",
                        show_chat_id:show_chat_id,
                        count_chat:count_chat
                    },
                    success: function (response) {
                        if(response != "stop"){
                            $('.them_giao_dich.sua_giao_dich .show_chat_table tbody').html(response);
                            $('.muc_do_uu_tien_chat_mess').filter(function () {
                                $(this).val($(this).attr('data-check'));
                            });
                            $('select.bo_phan_chat_mess').filter(function () {
                                $(this).val($(this).attr('data-check'));
                            });
                        }
                    }
                });
            }, 3000);

            selectCheck = setInterval(function () {
                $('.muc_do_uu_tien_chat_mess').filter(function () {
                    $(this).val($(this).attr('data-check'));
                });
                $('select.bo_phan_chat_mess').filter(function () {
                    $(this).val($(this).attr('data-check'));
                });
            },500);
        });

        $(document).on('click','.show_chat',function (e) {
            e.preventDefault();
            var target = $( e.target );
            if ( target.is( "button.btn_edit_chat" ) || target.is( "button.btn_edit_chat i" ) ) {
                $(this).find('td input').prop('disabled', false);
                $(this).find('td select').prop('disabled', false);
                $(this).find('td textarea.tn').prop('disabled', false);
                $(this).find('td textarea.tn').slideDown();
                $(this).find('td input').addClass('border_edit');
                $(this).find('td select').addClass('border_edit');
                $(this).find('td textarea').addClass('border_edit');
                $(this).find('td input.trang_thai_chat_mess').prop('disabled', true);
            }
        });

        $(document).on('click','.show_chat',function (e) {
            e.preventDefault();
            var target = $( e.target );
            if ( target.is( "button.btn_update_chat" ) || target.is( "button.btn_update_chat i" ) ) {
                var chat_mess = $(this).find('textarea.tn').val();
                var bo_phan_chat_mess = $(this).find('.bo_phan_chat_mess').val();
                var muc_do_uu_tien_chat_mess  = $(this).find('.muc_do_uu_tien_chat_mess').val();
                var ngay_can_nhac_lai_chat_mess = $(this).find('.ngay_can_nhac_lai_chat_mess').val();
                var id_chat = $(this).find('.change_update_send_mess').attr('data-id');
                var name_chat = $(this).find('.change_update_send_mess').attr('data-name');
                var avatar = $('.info_user .avatar img').attr('src');
                var currentURL = window.location.href+'#show_chat';

                $(this).find('td input').prop('disabled', true);
                $(this).find('td select').prop('disabled', true);
                $(this).find('td textarea.tn').prop('disabled', true);
                $(this).find('td textarea.tn').slideUp();
                $(this).find('td input').removeClass('border_edit');
                $(this).find('td select').removeClass('border_edit');
                $(this).find('td textarea').removeClass('border_edit');
                $(this).find('span.tn').text(chat_mess);

                $('.muc_do_uu_tien_chat_mess').filter(function () {
                    $(this).val($(this).attr('data-check'));
                });
                $('select.bo_phan_chat_mess').filter(function () {
                    $(this).val($(this).attr('data-check'));
                });

                //update post chat
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "update_mess",
                        id_chat:id_chat,
                        name_chat:name_chat,
                        chat_mess:chat_mess,
                        bo_phan_chat_mess:bo_phan_chat_mess,
                        muc_do_uu_tien_chat_mess:muc_do_uu_tien_chat_mess,
                        ngay_can_nhac_lai_chat_mess:ngay_can_nhac_lai_chat_mess,
                    },
                    success: function (response) {

                    }
                });

                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "notifications_edit_chat",
                        name_chat:name_chat,
                        chat_mess:chat_mess,
                        avatar:avatar,
                        currentURL:currentURL,
                    },
                    success: function (response) {
                        var id_del = response.data[0];
                        //console.log(response.data);

                        setTimeout(function () {
                            $.ajax({
                                type: "post",
                                dataType: "json",
                                url: my_ajax_object.ajax_url,
                                data: {
                                    action: "notifications_edit_chat_del",
                                    id_del:id_del,
                                },
                                success: function (response) {
                                    //console.log(response.data);
                                }
                            });
                        },500);
                    }
                });
            }
            $(this).find('.ngay_can_nhac_lai_chat_mess').datepicker({
                language: 'en',
                minDate: new Date() // Now can select only dates, which goes after today
            });
        });

        setInterval(function () {
            $.ajax({
                type: "post",
                dataType: "json",
                url: my_ajax_object.ajax_url,
                data: {
                    action: "notifications_edit_chat_showing",
                },
                success: function (response) {
                    if(response.data != 'stop'){
                        let notify;
                        if(Notification.permission === 'default'){
                            //alert('Please allow notification before doing this');
                        }else {
                            notify = new Notification(response.data[0]+' đã sửa tin nhắn', {
                                body: response.data[1],
                                image: $('.acf-form-submit').attr('data-img'),
                                icon: response.data[3]
                            });

                            notify.onclick = function (ev) {
                                //console.log(this);
                                var url_current = response.data[2];
                                window.open(url_current, '_blank');
                            }
                        }
                    }
                }
            });
        },1500);

        $('.show_chat').filter(function () {
            $('select.muc_do_uu_tien_chat_mess').on('change', function () {
                $(this).attr('data-check',$(this).val());
            });
            $('select.bo_phan_chat_mess').on('change', function () {
                $(this).attr('data-check',$(this).val());
            });
            $(this).find('p.edit_mess_tn textarea.tn').on('keyup',function () {
                var txt_tn = $(this).val();
                $(this).parent().siblings('span.tn').text(txt_tn);
            });
            $(this).find('.bo_phan_chat_mess').val($(this).find('.bo_phan_chat_mess').attr('data-check'));
        });
    }
    
    function AddTypeRoom() {
        var btn_add_rom = $('.add_rom');
        var ten_phong_ks = $('.ten_phong_ks');
        var gia_phong_ks = $('.gia_phong_ks');
        var loai_phong = $('.add_hotel .item:nth-child(2) li .loai_phong');
        var remove_rom = $('.add_hotel .item:nth-child(2) li .loai_phong .rom i');
        var loai_phong_ks = $('.loai_phong_ks');

        btn_add_rom.on('click',function (e) {
            var lenght = $('.loai_phong').find(".rom").length;

            e.preventDefault();

            if(ten_phong_ks.val() == ""){
                alert('Tên phòng trống !');
            }else if(gia_phong_ks.val() == ""){
                alert('Giá phòng trống !');
            }else{
                loai_phong.append('<div class="rom">'+ten_phong_ks.val()+':'+gia_phong_ks.val()+' <i class="fa fa-times-circle" aria-hidden="true"></i></div>');
                if(lenght > 0){
                    for (var i = 0; i <= lenght+1; i++){
                        var add_data = $('.add_hotel .item:nth-child(2) li .loai_phong .rom:nth-child('+i+')').text();
                    }
                    loai_phong_ks.val(loai_phong_ks.val()+','+add_data);

                }else{
                    for (var i = 0; i <= lenght+1; i++){
                        var add_data = $('.add_hotel .item:nth-child(2) li .loai_phong .rom:nth-child('+i+')').text();

                    }
                    loai_phong_ks.val(add_data);

                }
            }
        });

        $(document).on('click', ".rom i", function() {
            $(this).parent().remove();

        });

        setInterval(function () {
            var lenght = $('.loai_phong').find(".rom").length;
            loai_phong_ks.val('');
            if(lenght > 0){
                for (var i = 1; i <= lenght; i++){
                    if(i == 1){
                        var add_data = $('.add_hotel .item:nth-child(2) li .loai_phong .rom:nth-child('+i+')').text();
                        loai_phong_ks.val(loai_phong_ks.val()+add_data);
                    }else{
                        var add_data = $('.add_hotel .item:nth-child(2) li .loai_phong .rom:nth-child('+i+')').text();
                        loai_phong_ks.val(loai_phong_ks.val()+','+add_data);
                    }

                }
            }


        },1000);

        var at = function( test ) {
            try {
                if(typeof test === "function") return test();
                else return test || null;
            } catch (e) {
                return null;
            }
        };
    }

    function _init() {
        base();
        Isotope();
        datePicker();
        ajaxDel();
        CountGetData();
        uploadFileImage();
        checkLogin();
        checklogout();
        parallax();
        NiceScroll();
        search_email();
        checkOnline();
        SendMessage();
        AddTypeRoom();
        checkSelect();
    }

    _init();

} )( jQuery );

