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
        ];

        $.each(ClassSelect , function(index, val) {
            $('.'+val).val($('.'+val).attr('data-check'));
        });

        $('.ten_khach_san_gd').change(function(){
            var element = $(this).find('option:selected');
            var myID = element.attr("data-id");

            $('.ma_dich_vu_gd').val(myID);
        });
    }

    function CountGetData(){
        setInterval(function () {
            var date_in = $('.ci_gd').val();
            if(typeof date_in !== 'undefined') {
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
                    }
                });
            }
        });
    }

    function checkOnline() {
        setInterval(function () {
            $.ajax({
                type: "post",
                dataType: "json",
                url: my_ajax_object.ajax_url,
                data: {action: "check_online"},
                success: function(response){
                    $('.my_friend ul').html(response.data);
                    //console.log(response);

                    $('.chatbox .my_friend ul li').on('click', function (e) {
                        e.preventDefault();
                        var data_name = $(this).attr('data-name');

                        $('.form_chat h2 span').text(data_name);
                    });
                }
            });
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

    function _init() {
        base();
        Isotope();
        datePicker();
        ajaxDel();
        checkSelect();
        CountGetData();
        uploadFileImage();
        checkLogin();
        checklogout();
        parallax();
        NiceScroll();
        search_email();
        checkOnline();
    }

    _init();

} )( jQuery );

