( function( $ ) {
    "use strict";

    //Thêm thư viện parallax
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

    //tính giá trị gd
    function base_change_count_gd(){
        var pt_nguoi = $('.pt_nguoi').val();
        var pt_giai_doan = $('.pt_giai_doan').val();
        var pt_cuoi_tuan = $('.pt_cuoi_tuan').val();
        var bua_an_bat_buoc = $('.bua_an_bat_buoc').val();
        var dich_vu_khac = $('.dich_vu_khac').val();
        var tien_chua_pt_khac = $('.tien_chua_pt_khac').val();
        var tien_chua_pt_khac2 = $('.tien_chua_pt_khac2').val();
        var giam_gia_cho_kh_khac = $('.giam_gia_cho_kh_khac').val();
        var giam_gia_cua_dt_khac2 = $('.giam_gia_cua_dt_khac2').val();
        var da_thanh_toan_khac = $('.da_thanh_toan_khac').val();
        var da_thanh_toan_khac2 = $('.da_thanh_toan_khac2').val();

        var tong_gd = parseInt($('.tong_gd').val());
        var tong_pt = $('.tong_pt');
        var tong_phu_thu_khac = $('.tong_phu_thu_khac');
        var tong_phu_thu_khac2 = $('.tong_phu_thu_khac2');
        var tong_gia_tri_khac = $('.tong_gia_tri_khac');
        var tong_gia_tri_khac2 = $('.tong_gia_tri_khac2');
        var kh_con_no_khac = $('.kh_con_no_khac');
        var bct_con_no_khac2 = $('.bct_con_no_khac2');
        var lai_lo_khac = $('.lai_lo_khac');
        var total,tong_gia_tri_khac_sale,tong_gia_tri_khac_sale2,tong_gia_tri_khac_total,tong_gia_tri_khac_dt,kh_con_no_khac_count2;
        var kh_con_no_khac_count;

        if(pt_nguoi != undefined || pt_giai_doan != undefined || pt_cuoi_tuan != undefined || bua_an_bat_buoc != undefined || dich_vu_khac != undefined || tien_chua_pt_khac != undefined || giam_gia_cho_kh_khac != undefined || da_thanh_toan_khac != undefined ){
            pt_nguoi = pt_nguoi.replace(',','');
            pt_nguoi = pt_nguoi.replace(',','');
            pt_nguoi = pt_nguoi.replace(',','');
            pt_nguoi = parseInt(pt_nguoi);

            pt_giai_doan = pt_giai_doan.replace(',','');
            pt_giai_doan = pt_giai_doan.replace(',','');
            pt_giai_doan = pt_giai_doan.replace(',','');
            pt_giai_doan = parseInt(pt_giai_doan);

            pt_cuoi_tuan = pt_cuoi_tuan.replace(',','');
            pt_cuoi_tuan = pt_cuoi_tuan.replace(',','');
            pt_cuoi_tuan = pt_cuoi_tuan.replace(',','');
            pt_cuoi_tuan = parseInt(pt_cuoi_tuan);

            bua_an_bat_buoc = bua_an_bat_buoc.replace(',','');
            bua_an_bat_buoc = bua_an_bat_buoc.replace(',','');
            bua_an_bat_buoc = bua_an_bat_buoc.replace(',','');
            bua_an_bat_buoc = parseInt(bua_an_bat_buoc);

            dich_vu_khac = dich_vu_khac.replace(',','');
            dich_vu_khac = dich_vu_khac.replace(',','');
            dich_vu_khac = dich_vu_khac.replace(',','');
            dich_vu_khac = parseInt(dich_vu_khac);

            tien_chua_pt_khac = tien_chua_pt_khac.replace(',','');
            tien_chua_pt_khac = tien_chua_pt_khac.replace(',','');
            tien_chua_pt_khac = tien_chua_pt_khac.replace(',','');
            tien_chua_pt_khac = parseInt(tien_chua_pt_khac);

            tien_chua_pt_khac2 = tien_chua_pt_khac2.replace(',','');
            tien_chua_pt_khac2 = tien_chua_pt_khac2.replace(',','');
            tien_chua_pt_khac2 = tien_chua_pt_khac2.replace(',','');
            tien_chua_pt_khac2 = parseInt(tien_chua_pt_khac2);

            giam_gia_cho_kh_khac = giam_gia_cho_kh_khac.replace(',','');
            giam_gia_cho_kh_khac = giam_gia_cho_kh_khac.replace(',','');
            giam_gia_cho_kh_khac = giam_gia_cho_kh_khac.replace(',','');
            giam_gia_cho_kh_khac = parseInt(giam_gia_cho_kh_khac);

            giam_gia_cua_dt_khac2 = giam_gia_cua_dt_khac2.replace(',','');
            giam_gia_cua_dt_khac2 = giam_gia_cua_dt_khac2.replace(',','');
            giam_gia_cua_dt_khac2 = giam_gia_cua_dt_khac2.replace(',','');
            giam_gia_cua_dt_khac2 = parseInt(giam_gia_cua_dt_khac2);

            da_thanh_toan_khac = da_thanh_toan_khac.replace(',','');
            da_thanh_toan_khac = da_thanh_toan_khac.replace(',','');
            da_thanh_toan_khac = da_thanh_toan_khac.replace(',','');
            da_thanh_toan_khac = parseInt(da_thanh_toan_khac);

            da_thanh_toan_khac2 = da_thanh_toan_khac2.replace(',','');
            da_thanh_toan_khac2 = da_thanh_toan_khac2.replace(',','');
            da_thanh_toan_khac2 = da_thanh_toan_khac2.replace(',','');
            da_thanh_toan_khac2 = parseInt(da_thanh_toan_khac2);

            //Tổng phụ thụ
            total = pt_nguoi + pt_giai_doan + pt_cuoi_tuan + bua_an_bat_buoc + dich_vu_khac;

            tong_pt.val(total.format(0, 3, ','));

            if($('.kh_tt_pt_tai').val() != 'Khách sạn'){
                //Tổng phụ thu khách hàng
                tong_phu_thu_khac.val(total.format(0, 3, ','));
                //Tổng phụ thu đối tác
                tong_phu_thu_khac2.val(total.format(0, 3, ','));
            }else{
                //Tổng phụ thu khách hàng
                tong_phu_thu_khac.val(0);
                //Tổng phụ thu đối tác
                tong_phu_thu_khac2.val(0);
            }

            if($('.kh_tt_pt_tai').val() == 'Khách sạn'){
                tong_gia_tri_khac_sale = 0 + tien_chua_pt_khac;
                tong_gia_tri_khac_sale2 = 0 + tien_chua_pt_khac2;
            }else{
                tong_gia_tri_khac_sale = total + tien_chua_pt_khac;
                tong_gia_tri_khac_sale2 = total + tien_chua_pt_khac2;
            }

            //Tổng giá trị khách hàng
            tong_gia_tri_khac_total = tong_gia_tri_khac_sale - giam_gia_cho_kh_khac;
            tong_gia_tri_khac.val(tong_gia_tri_khac_total.format(0, 3, ','));

            //Tổng giá trị đối tác
            tong_gia_tri_khac_dt = tong_gia_tri_khac_sale2 - giam_gia_cua_dt_khac2;
            tong_gia_tri_khac2.val(tong_gia_tri_khac_dt.format(0, 3, ','));

            //Khách hàng còn nợ
            kh_con_no_khac_count = tong_gia_tri_khac_total - da_thanh_toan_khac;
            kh_con_no_khac.val(kh_con_no_khac_count.format(0, 3, ','));

            //Đối tác còn nợ
            kh_con_no_khac_count2 = tong_gia_tri_khac_dt - da_thanh_toan_khac2;
            bct_con_no_khac2.val(kh_con_no_khac_count2.format(0, 3, ','));

            //Lãi/lỗ
            lai_lo_khac = tong_gia_tri_khac_total - tong_gia_tri_khac_dt;
            $('input.lai_lo_khac').val(lai_lo_khac.format(0, 3, ','));

            //Thuế VAT
            var thue_vat_khac,lai_lo_khac_1,lai_lo_khac_10;
            lai_lo_khac_1 = tong_gia_tri_khac_total/100;
            lai_lo_khac_10 = lai_lo_khac_1 * 10;
            $('.thue_vat_khac').val(lai_lo_khac_10.format(0, 3, ','));

            //Thuế TNDN
            var thue_tndn_khac,thue_tndn_khac_1,thue_tndn_khac_25;
            thue_tndn_khac_1 = tong_gia_tri_khac_total/100;
            thue_tndn_khac_25 = thue_tndn_khac_1 * 25;
            $('.thue_tndn_khac').val(thue_tndn_khac_25.format(0, 3, ','));

            $('.phu_thu_kh_vs_dt').show();
        }
    }

    //base tổng giá phòng trong ? đêm
    function base_total_hotel_tonight(){
        var sl_gd = parseInt($('.sl_gd').val());
        var don_gia_ban_gd = $('.don_gia_ban_gd').val();
        var don_gia_ban_dt = $('.don_gia_ban_dt').val();
        var sl_dt = parseInt($('.sl_dt').val());
        var don_gia_ban_dt = $('.don_gia_ban_dt').val();
        var so_dem_gd = $('.so_dem_gd').val();
        var tong_dt = $('.tong_dt').val();
        var tong_room_gd;

        if($('.page-template').hasClass('page-template-them_giao_dich') || $('.single').hasClass('single-giao_dich') || $('.page-template').hasClass('page-template-them-booking') || $('.page-template').hasClass('page-template-tach-booking')){
            don_gia_ban_gd = don_gia_ban_gd.replace(",", "");
            don_gia_ban_gd = don_gia_ban_gd.replace(",", "");
            don_gia_ban_gd = don_gia_ban_gd.replace(",", "");
            don_gia_ban_gd = don_gia_ban_gd.replace(",", "");
            don_gia_ban_gd = parseInt(don_gia_ban_gd);
            tong_room_gd = sl_gd * don_gia_ban_gd;
            tong_room_gd = tong_room_gd * so_dem_gd;

            if(tong_room_gd !== tong_room_gd){
                $('.tong_gd').val(0);
                $('.tien_chua_pt_khac').val(0);
            }else{
                $('.tong_gd').val(tong_room_gd.format(0, 3, ','));
                $('.tien_chua_pt_khac').val(tong_room_gd.format(0, 3, ','));
            }

            don_gia_ban_dt = don_gia_ban_dt.replace(",", "");
            don_gia_ban_dt = don_gia_ban_dt.replace(",", "");
            don_gia_ban_dt = don_gia_ban_dt.replace(",", "");
            don_gia_ban_dt = don_gia_ban_dt.replace(",", "");
            don_gia_ban_dt = parseInt(don_gia_ban_dt);

            var tong_room_dt = sl_dt * don_gia_ban_dt;
            var tong_room_dt = tong_room_dt * so_dem_gd;

            if(tong_room_dt !== tong_room_dt){
                $('.tong_dt').val(0);
                $('.tien_chua_pt_khac2').val(0);
            }else{
                $('.tong_dt').val(tong_room_dt.format(0, 3, ','));
                $('.tien_chua_pt_khac2').val(tong_room_dt.format(0, 3, ','));
            }

            var mgdc = $('.ma_gd_con').val();
            $('.ma_gd_con_t').val(mgdc);
        }
    }

    function base() {
        var change_label_title =  $('.acf-field--post-title .acf-label label');
        var insert_icon_menu_admin = $('.menu-item-has-children');
        var disable_edit_giao_dich = $( ".single-history_giao_dich input");
        var disable_edit_giao_dich2 = $( ".single-history_giao_dich select");
        var disable_edit_giao_dich3 = $( ".single-history_giao_dich textarea");
        var disable_edit_giao_dich_view = $( ".view_fix input");
        var disable_edit_giao_dich2_view = $( ".view_fix select");
        var disable_edit_giao_dich3_view = $( ".view_fix textarea");

        $('.so_dem_gd').prop('disabled', true);
        $('.con_ngay_gd').prop('disabled', true);
        //$('.don_gia_ban_gd').prop('disabled', true);
        $('.tong_gd').prop('disabled', true);
        //$('.don_gia_ban_dt').prop('disabled', true);
        $('.tong_dt').prop('disabled', true);
        $('.con_ngay_dt').prop('disabled', true);
        $('.con_ngay_thay_doi_dt').prop('disabled', true);

        change_label_title.text('Tiêu đề');
        insert_icon_menu_admin.append('<i class="fa fa-caret-down" aria-hidden="true"></i>');
        disable_edit_giao_dich.prop( "disabled", true );
        disable_edit_giao_dich2.prop( "disabled", true );
        disable_edit_giao_dich3.prop( "disabled", true );

        disable_edit_giao_dich_view.prop( "disabled", true );
        disable_edit_giao_dich2_view.prop( "disabled", true );
        disable_edit_giao_dich3_view.prop( "disabled", true );

        //Check input number empty
        var arr_input_number_class = [
            'so_dem_gd',
            'sl_gd',
            'don_gia_ban_gd',
            'tong_gd',
            'sl_dt',
            'don_gia_ban_dt',
            'tong_dt',
            'pt_nguoi',
            'pt_giai_doan',
            'pt_cuoi_tuan',
            'bua_an_bat_buoc',
            'dich_vu_khac',
            'tong_pt',
            'tien_chua_pt_khac',
            'tong_phu_thu_khac',
            'giam_gia_cho_kh_khac',
            'tong_gia_tri_khac',
            'da_thanh_toan_khac',
            'kh_con_no_khac',
            'lai_lo_khac',
            'thue_vat_khac',
            'thue_tndn_khac',
            'cp_marketing_khac',
            'cp_co_dinh_khac',
            'cp_hau_can_khac',
            'cp_hau_mai_khac',
            'tien_chua_pt_khac2',
            'tong_phu_thu_khac2',
            'giam_gia_cua_dt_khac2',
            'tong_gia_tri_khac2',
            'da_thanh_toan_khac2',
            'bct_con_no_khac2',
            'don_gia_ban_gd',
        ];
        $.each(arr_input_number_class , function(index, val) {
            if($('.'+val).val() == 0 || $('.'+val).val() < 0 || $('.'+val).val() == ''){
                $('.'+val).val(0);
            }
            $('.'+val).on('change', function(){
                if($('.'+val).val() == 0 || $('.'+val).val() < 0 || $('.'+val).val() == ''){
                    $('.'+val).val(0);
                }
            });
            $('.'+val).on('keyup', function(){
                if($('.'+val).val() == 0 || $('.'+val).val() < 0 || $('.'+val).val() == ''){
                    $('.'+val).val(0);
                }
            });
        });

        /*$('.ngay_cập_nhập_giao_dịch_cuối_cung').prop( "disabled", true );
        $('.so_dem_gd').prop( "disabled", true );
        $('.con_ngay_gd').prop( "disabled", true );*/

        //enter login ajax
        $(document).keypress(function(e) {
            if(e.which == 13) {
                $('.sub_login').click();
            }
        });

        if (!$('#lightgallery').is(':empty')){
            $('#lightgallery').lightGallery();

            //click show frame load url website
            $('.view_detail_hotel button').on('click', function () {
                var url = $('.add_hotel .view_detail_hotel input.url').val();
                $('.load_url_iframe .screen').html('<iframe src="'+url+'"></iframe>');
                $('.load_url_iframe').fadeIn();
            });

            $('.btn_close').on('click', function () {
                $('.load_url_iframe').fadeOut();
            });


            //kéo thả gallery hotel
            if($('.giao_dich_moi').hasClass('gallery_hotel')){
                $( "#lightgallery" ).sortable({
                    revert: true,
                    helper: "clone",
                    start: function( event, ui ) {
                        $(ui.item).addClass("active-draggable");
                        $(ui.item).css('transform','rotate(4deg)');
                        ui.item.startPos = ui.item.index();

                    },
                    drag: function( event, ui ) {
                    },
                    stop:function( event, ui ) {
                        $(ui.item).removeClass("active-draggable");
                        $(ui.item).css('transform','rotate(0deg)');
                        /*console.log($.map($(this).find('li'), function(el) {
                            return $(el).attr('class') + ' = ' + $(el).index();
                        }));*/

                        $.map($(this).find('li'), function(el) {
                            var class_item = $(el).attr('class');
                            $('#'+class_item).attr('data-position', $(el).index());
                        });
                    }
                });

                $('.add_hotel .item.gallery ul li i.fa-times').on('click', function (e) {
                    e.stopPropagation(); //stop parent load

                    var img = $(this).attr('data-img');

                    $(this).siblings('.img').css('background', 'url('+img+')');
                    $(this).parents('li').attr('data-src', img);
                    $(this).siblings('.img').find('img').attr('src', img);
                    $(this).siblings('.img').removeClass('active');
                    $(this).siblings('.btn_add_img').show();
                    $(this).hide();
                });

                $('.add_hotel .item.gallery ul li .btn_add_img').on('click', function (e) {
                    e.stopPropagation(); //stop parent load

                    $(this).siblings('input').on('click', function (e) {
                        e.stopPropagation(); //stop parent load
                    });
                });

                $('.add_hotel .item.gallery ul li input').on('click', function (e) {
                    e.stopPropagation(); //stop parent load
                });

                $('.add_hotel .item.gallery ul li input').change(function (e) {
                    var tmppath = URL.createObjectURL(e.target.files[0]);
                    $(this).parents('.btn_add_img').siblings('.img').css('background', 'url('+tmppath+')');
                    $(this).parents('.btn_add_img').siblings('.img').find('img').attr('src', tmppath);
                    $(this).parents('.btn_add_img').parents('li').attr('data-src', tmppath);
                    $(this).parents('.btn_add_img').hide();
                    $(this).parents('.btn_add_img').siblings('i.fa-times').show();
                    $(this).parents('.btn_add_img').siblings('.img').addClass('active');
                });
            }
        }

        /**
         * Number.prototype.format(n, x, s, c)
         *
         * @param integer n: length of decimal
         * @param integer x: length of whole part
         * @param mixed   s: sections delimiter
         * @param mixed   c: decimal delimiter
         */
        Number.prototype.format = function(n, x, s, c) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));

            return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
        };

        //format set input currency price
        $('.don_gia_ban_gd').simpleMoneyFormat();
        $('.tong_gd').simpleMoneyFormat();
        $('.pt_nguoi').simpleMoneyFormat();
        $('.pt_giai_doan').simpleMoneyFormat();
        $('.pt_cuoi_tuan').simpleMoneyFormat();
        $('.bua_an_bat_buoc').simpleMoneyFormat();
        $('.dich_vu_khac').simpleMoneyFormat();
        $('.tong_pt').simpleMoneyFormat();
        $('.don_gia_ban_dt').simpleMoneyFormat();
        $('.tong_dt').simpleMoneyFormat();
        $('.tien_chua_pt_khac').simpleMoneyFormat();
        $('.tong_phu_thu_khac').simpleMoneyFormat();
        $('.giam_gia_cho_kh_khac').simpleMoneyFormat();
        $('.tong_gia_tri_khac').simpleMoneyFormat();
        $('.da_thanh_toan_khac').simpleMoneyFormat();
        $('.kh_con_no_khac').simpleMoneyFormat();
        $('.lai_lo_khac').simpleMoneyFormat();
        $('.thue_vat_khac').simpleMoneyFormat();
        $('.thue_tndn_khac').simpleMoneyFormat();
        $('.cp_marketing_khac').simpleMoneyFormat();
        $('.cp_hau_can_khac').simpleMoneyFormat();
        $('.cp_hau_mai_khac').simpleMoneyFormat();
        $('.cp_co_dinh_khac').simpleMoneyFormat();
        $('.tien_chua_pt_khac2').simpleMoneyFormat();
        $('.tong_phu_thu_khac2').simpleMoneyFormat();
        $('.giam_gia_cua_dt_khac2').simpleMoneyFormat();
        $('.tong_gia_tri_khac2').simpleMoneyFormat();
        $('.da_thanh_toan_khac2').simpleMoneyFormat();
        $('.bct_con_no_khac2').simpleMoneyFormat();
        $('.price_ks').simpleMoneyFormat();
        $('.gia_tien_kh').simpleMoneyFormat();
        $('.gia_tien_dt').simpleMoneyFormat();
        $('.gia_tien_kh_add').simpleMoneyFormat();
        $('.gia_tien_dt_add').simpleMoneyFormat();
        $('.add_tien_coc').simpleMoneyFormat();
        $('.add_tien_coc_di').simpleMoneyFormat();
        $('.tien_coc').simpleMoneyFormat();
        $('.tien_coc_di').simpleMoneyFormat();
        $(document).find('.tien_coc').simpleMoneyFormat();
        $(document).find('.tien_coc_di').simpleMoneyFormat();

        //add price gd
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = dd + '/' + mm + '/' + yyyy;
        $('.add_ngay_coc').val(today);
        $('.add_ngay_phai_coc_di').val(today);

        //Ngày cần nhắc lại chat
        var date_nl = new Date();
        date_nl = new Date(date_nl.getFullYear(), date_nl.getMonth() + 1, date_nl.getDate() + 1);
        var get_month = date_nl.getMonth();
        if(get_month<10){
            get_month = '0'+get_month;
        }
        $('.ngay_can_nhac_lai_chat').val(date_nl.getDate()+'/'+get_month+'/'+date_nl.getFullYear());

        //ngày yêu cầu hoàn tất
        $('.ci_gd').change(function () {
            var formattedDate = new Date("27/05/2019");
            var d = formattedDate.getDate();
            var m =  formattedDate.getMonth();
            d += 1;  // JavaScript months are 0-11
            var y = formattedDate.getFullYear();
        });

        //Select thêm phòng
        $('.loai_phong_ban_gd').on('change', function () {
            var link = $(this).find('option:selected',this).attr('data-link')+'#type_room';
            if($(this).val() == 'link'){
                window.open(link,'_blank');
            }
        });
        $('.loai_phong_ban_dt').on('change', function () {
            var link = $(this).find('option:selected',this).attr('data-link')+'#type_room';
            if($(this).val() == 'link'){
                window.open(link,'_blank');
            }
        });

        $('input.ngay_lock_phong_khach.datepicker-here').on('click', function () {
            $('input.ngay_lock_phong_khach.datepicker-here').datepicker({
                onSelect: function() {
                    var dateFormat = $(this).val();
                    var now = new Date(dateFormat);

                    var first_date = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1);
                    $('.ngay_lock_phong_doi_tac').val(first_date);
                },
            });
        });

        $('.sl_gd,.sl_dt,.pt_nguoi,.pt_giai_doan,.pt_cuoi_tuan,.bua_an_bat_buoc,.dich_vu_khac,.tien_chua_pt_khac,.don_gia_ban_gd,.don_gia_ban_dt,.tien_chua_pt_khac2,.giam_gia_cho_kh_khac,.giam_gia_cua_dt_khac2,.da_thanh_toan_khac,.da_thanh_toan_khac2,.tong_gd,.tong_phu_thu_khac,.tong_phu_thu_khac2,.kh_con_no_khac,.bct_con_no_khac2,.lai_lo_khac,.kh_tt_pt_tai').on('keyup', function(){
            base_total_hotel_tonight();
            base_change_count_gd();
        });
        $('.sl_gd,.sl_dt,.pt_nguoi,.pt_giai_doan,.pt_cuoi_tuan,.bua_an_bat_buoc,.dich_vu_khac,.tien_chua_pt_khac,.don_gia_ban_gd,.don_gia_ban_dt,.tien_chua_pt_khac2,.giam_gia_cho_kh_khac,.giam_gia_cua_dt_khac2,.da_thanh_toan_khac,.da_thanh_toan_khac2,.tong_gd,.tong_phu_thu_khac,.tong_phu_thu_khac2,.kh_con_no_khac,.bct_con_no_khac2,.lai_lo_khac,.kh_tt_pt_tai').on('change', function(){
            base_total_hotel_tonight();
            base_change_count_gd();
        });


        //ngay yeu cau hoan tattong_gd
        $('.ci_gd').on('click', function(){
            $(this).datepicker({
                onSelect: function () {
                    var strDate = $('.ci_gd').val();
                    var dateParts = strDate.split("/");
                    var now = new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
                    var yesterday = new Date(now.getFullYear(), now.getMonth() + 1, now.getDate() - 1);
                    var d = yesterday.getDate();
                    var m = yesterday.getMonth();
                    var y = yesterday.getFullYear();
                    $('.ngay_yeu_cau_kh_hoan_tat_tt_khac').val(d+'/'+m+'/'+y);
                    $('.ngay_phai_hoan_tat_tt_cho_ks_khac2').val(d+'/'+m+'/'+y);
                    alert(1);
                }
            });
        });

    }


    function datePicker() {
        $('.datepicker').data('datepicker');
    }

    //Xóa giao dịch
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

    //Search hotel
    $('.search_hotel .sub_search_hotel').on('click', function (e) {
        e.preventDefault();
        var keyword = $(this).siblings('input').val();
        $.ajax({
            type: "post",
            dataType: "html",
            url: my_ajax_object.ajax_url,
            data: {action: "search_hotel", keyword : keyword},
            success: function(response){
                $('.content_hotel_list').html(response);
                $('.nav').remove();
            }
        });
    });
    $('.search_hotel .sub_search_gd').on('click', function (e) {
        e.preventDefault();
        var keyword = $(this).siblings('input').val();
        $.ajax({
            type: "post",
            dataType: "html",
            url: my_ajax_object.ajax_url,
            data: {action: "search_gd", keyword : keyword},
            success: function(response){
                $('.content_hotel_list').html(response);
                $('.nav').remove();
            }
        });
    });

    //deley search keyup query ajax
    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    //string to slug
    function str_slug(title){

        var slug;

        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        return slug;
    }

    //selected nếu đã có dữ liệu
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
            'noi_den_gd',
            'noi_di_dt',
            'noi_den_dt',
            'loai_tai_khoan_khach_gd',
            'bo_phan_ctv',
            'khu_vuc_ks',
            'khu_vuc_dt',
            'bo_phan_chat',
            'kh_tt_pt_tai',
            'hinh_thuc_book_gd',
        ];

        $.each(ClassSelect , function(index, val) {
            if($('.'+val).attr('data-check') != undefined){
                $('.'+val).val($('.'+val).attr('data-check'));
            }
        });

        $('.noi_di_gd').on('change', function(){
            $('.noi_di_dt').val($(this).val());
        });

        $('.noi_den_gd').on('change', function(){
            $('.noi_den_dt').val($(this).val());
        });

        $('.noi_di_dt').on('change', function(){
            $('.noi_di_gd').val($(this).val());
        });

        $('.noi_den_dt').on('change', function(){
            $('.noi_den_gd').val($(this).val());
        });

        $('.don_vi_gd').on('change', function(){
            $('.don_vi_dt').val($(this).val());
        });

        $('.don_vi_dt').on('change', function(){
            $('.don_vi_gd').val($(this).val());
        });

        /*$('.don_gia_ban_gd').val($('.loai_phong_ban_gd option:selected').attr('data-price1'));
        $('.don_gia_ban_dt').val($('.loai_phong_ban_dt option:selected').attr('data-price2'));*/
        //$('.ma_dt').val($('.ten_dt_gui_book_dt option:selected').attr('data-id'));

        $('.loai_phong_ban_gd').on('change', function(){
            var price1 = $(this).find('option:selected', this).attr('data-price1');
            var price2 = $(this).find('option:selected', this).attr('data-price2');
            $('.don_gia_ban_dt').val(price2);
            $('.don_gia_ban_gd').val(price1);
            $('.loai_phong_ban_dt').val($(this).val());

            base_total_hotel_tonight();
            base_change_count_gd();
        });

        $('.loai_phong_ban_dt').on('change', function(){
            var price = $(this).find('option:selected', this).attr('data-price2');
            $('.don_gia_ban_dt').val(price);
            $('.loai_phong_ban_gd').val($(this).val());

            base_total_hotel_tonight();
            base_change_count_gd();
        });

        $('.sl_gd').on('keyup', function(){
            $('.sl_dt').val($(this).val());
        });

        //Lấy dữ liệu tên và bảng giá phòng theo tên khách sạn giao dịch
        $('.ten_khach_san_gd').change(function(e){
            e.preventDefault();
            var element = $(this).find('option:selected');
            var myID = element.attr("data-id");
            var data_room = element.attr('data-room');
            var loai_phong_ban_gd = $('.loai_phong_ban_gd');
            var loai_phong_ban_dt = $('.loai_phong_ban_dt');

            $('.ma_dich_vu_gd').val(myID);
        });

        $('.ten_khach_san_gd_val').keyup(delay(function (e) {
            var keyword = $(this).val();
            $.ajax({
                type: "post",
                dataType: "html",
                url: my_ajax_object.ajax_url,
                data: {
                    action: "pop_ten_khach_san_gd",
                    keyword:keyword
                },
                success: function (response) {
                    $('.pop_ten_khach_san_gd').show();
                    $('.pop_ten_khach_san_gd .list_show').empty();
                    $('.pop_ten_khach_san_gd .list_show').html(response);
                }
            });


        }, 500));

        $(document).on('click','.pop_ten_khach_san_gd .list_show ul', function () {
            var id_ks_gd = $(this).find('.id_ks_gd').val();
            var hotel_name = $(this).find('.hotel_name').val();

            $('.ten_khach_san_gd').val(id_ks_gd);
            $('.ten_khach_san_gd_val').val(hotel_name);

            $('.ma_dich_vu_gd').val(id_ks_gd);

            var slug = str_slug(hotel_name);
            $('td input.ma_dich_vu_gd_val').val(slug+'-'+id_ks_gd);

            $('.pop_ten_khach_san_gd').hide();

            base_total_hotel_tonight();
            base_change_count_gd();
        });


        $('.ten_dt_gui_book_dt').change(function(){
            var element = $(this).find('option:selected');
            var myID_DT = element.attr("data-id");

            $('.ma_dt').val(myID_DT);
        });

    }

    //Upload file ảnh đại diện
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

        //Auto load thông tin tài khoản real time
        function base_load_info_user(){
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
                $('.add_user .screen_user .item .insider span').text(email.val());
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
        }
        $('.email_tai_khoan,.mat_khau_tai_khoan,.ho_va_ten_tai_khoan,.ten_biet_danh_tai_khoan,.sdt_tai_khoan,.cmt_tai_khoan,.loai_quyen_tai_khoan,.dia_chi_tai_khoan,.anh_dai_dien').on('change',function(){
            base_load_info_user();
        });
        $('.email_tai_khoan,.mat_khau_tai_khoan,.ho_va_ten_tai_khoan,.ten_biet_danh_tai_khoan,.sdt_tai_khoan,.cmt_tai_khoan,.loai_quyen_tai_khoan,.dia_chi_tai_khoan,.anh_dai_dien').on('keyup',function(){
            base_load_info_user();
        });
    }

    //Check login
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

    //Check logout
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

    //edit thanh kéo trượt
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

    //Filter email để thêm tài khoản cho nhân viên
    function search_email() {
        //react on keyup in textbox
        $('.search_email').keyup(function () {
            //var options = $('.email_tai_khoan option').clone();
            var val = $(this).val();
            $('.email_tai_khoan').empty();
            //take only the options containing your filter text or all if empty
            /*options.filter(function (idx, el) {
                return val === '' || $(el).text().indexOf(val) >= 0;
            }).appendTo('.email_tai_khoan');//add it to list*/

            if($('.add_user ul li input').hasClass('search_email')){
                var email_tk = val;
                $('.email_tai_khoan').empty();
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
                        $('.email_tai_khoan').append(new Option(response.data[4], response.data[4]));

                    }
                });
            }
        });

        $('.email_tai_khoan').change(function () {
            if($('.add_user ul li input').hasClass('search_email')){
                var email_tk = $(this).val();
                $('.email_tai_khoan').empty();
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
                        $('.email_tai_khoan').append(new Option(response.data[4], response.data[4]));
                    }
                });
            }
        });
    }

    //Kiểm tra xem tài khoản nào đang online, offline
    /*function checkOnline() {
        if($('.single').hasClass('single-giao_dich') || $('.page-template').hasClass('page-template-tach-booking') || $('.page-template').hasClass('page-template-them-booking')){
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
        }

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
    }*/

    //Gửi tin nhắn giao dịch
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

            if(id_chat_gd != ''){
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

                            $('table#show_chat tbody').append(response.data[1]);
                            console.log(response.data[1]);

                            $('.send_chat td textarea').val();

                            var id_del = response.data[0];

                            setTimeout(function () {
                                $('.muc_do_uu_tien_chat_mess').filter(function () {
                                    $(this).val($(this).attr('data-check'));
                                });
                                $('select.bo_phan_chat_mess').filter(function () {
                                    $(this).val($(this).attr('data-check'));
                                });
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
                            },100);
                        }
                    });
                }
            }else{

            }
        });

        //Hiện các tin nhắn ở phần giao dịch real time
        if($('.single').hasClass('single-giao_dich') || $('.page-template').hasClass('page-template-tach-booking') || $('.page-template').hasClass('page-template-them-booking')){
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
            }, 30000);

            setTimeout(function(){
                $('.muc_do_uu_tien_chat_mess').filter(function () {
                    $(this).val($(this).attr('data-check'));
                });
                $('select.bo_phan_chat_mess').filter(function () {
                    $(this).val($(this).attr('data-check'));
                });
            }, 500);
        }

        //Click update tin nhắn sẽ tạm dừng real time tin nhắn
        $(document).on('click','.btn_edit_chat',function (e) {
            e.preventDefault();
            $(this).parent().html('<button type="button" class="btn_update_chat"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>');
            clearInterval(loadListMess);
        });

        //Trả lời các tin nhắn mới
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

                $('.trang_thai_chat').val('Đang trả lời');
                $('table tfoot tr.send_chat td:nth-child(1) span').html("<span>Trả lời : "+"Ngày nhập vào : "+ngay_chat+" # Mã nhân viên : "+name_chat+" # Lời nhắn : "+chat_mess+"</span> <i class=\"fa fa-times\" aria-hidden=\"true\"></i>");
                $('.reply_chat').val("Trả lời : "+"Ngày nhập vào : "+ngay_chat+" # Mã nhân viên : "+name_chat+" # Lời nhắn : "+chat_mess);
                $('.send_chat td:first-child span i').on('click',function () {
                    $('.send_chat td:first-child span').empty();
                    $('.trang_thai_chat').val('Đang chờ');
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

        //Update tin nhắn giao dịch
        if($('.single').hasClass('single-giao_dich') || $('.page-template').hasClass('page-template-tach-booking') || $('.page-template').hasClass('page-template-them-booking')){
            $(document).on('click', '.btn_update_chat', function (e) {
                e.preventDefault();
                $(this).parent().html('<button type="button" class="btn_edit_chat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button><button type="button" class="reply"><i class="fa fa-reply" aria-hidden="true"></i> Trả lời</button>');
                loadListMess = setInterval(function () {
                    var show_chat_id = $('.them_giao_dich.sua_giao_dich .show_chat_table').attr('data-id');
                    var count_chat = parseInt($('table.show_chat_table tbody .count_chat').attr('data-count'));

                    $.ajax({
                        type: "post",
                        dataType: "html",
                        url: my_ajax_object.ajax_url,
                        data: {
                            action: "load_chat_real_time",
                            show_chat_id: show_chat_id,
                            count_chat: count_chat
                        },
                        success: function (response) {
                            if (response != "stop") {
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
                }, 30000);
            });
        }

        //Không cho nhập thông tin chat nếu người dùng ko ấn vào nút edit chat
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

        //click vào edit chat để sửa phần chat
        $(document).on('click','.show_chat',function (e) {
            e.preventDefault();
            var target = $( e.target );
            if ( target.is( "button.btn_update_chat" ) || target.is( "button.btn_update_chat i" ) ) {
                var chat_mess = $(this).find('textarea.tn').val();
                var bo_phan_chat_mess = $(this).find('.bo_phan_chat_mess').val();
                var muc_do_uu_tien_chat_mess  = $(this).find('.muc_do_uu_tien_chat_mess').val();
                var ngay_can_nhac_lai_chat_mess = $(this).find('.ngay_can_nhac_lai_chat_mess').val();
                var id_chat = $(this).attr('data-id');
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
                        },600);
                    }
                });
            }
            /*$(this).find('.ngay_can_nhac_lai_chat_mess').datepicker({
                language: 'en',
                minDate: new Date() // Now can select only dates, which goes after today
            });*/
        });

        /*//Thông báo tin nhắn
        if($('.single').hasClass('single-giao_dich') || $('.page-template').hasClass('page-template-tach-booking') || $('.page-template').hasClass('page-template-them-booking')){
            setInterval(function () {
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "notifications_edit_chat_showing",
                    },
                    success: function (response) {
                        if (response.data != 'stop') {
                            let notify;
                            if (Notification.permission === 'default') {
                                //alert('Please allow notification before doing this');
                            } else {
                                notify = new Notification(response.data[0] + ' đã sửa tin nhắn', {
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
            }, 1000);
        }*/

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

    //Thêm phòng và giá khách sạn
    function AddTypeRoom() {
        var btn_add_rom = $('.add_rom');
        var btn_room_save = $('.list_room .room .btn .save');
        var btn_room_edit = $('.list_room .room .btn .edit');
        var btn_room_del = $('.list_room .room .btn .del');

        btn_add_rom.on('click',function (e) {
            var room_name_ks = $('.room_name_ks').val();
            var gia_tien_kh = $('.gia_tien_kh_add').val();
            var gia_tien_dt = $('.gia_tien_dt_add').val();
            var data_id = $(this).attr('data-id');
            if(room_name_ks != '' || price_ks != ''){
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "add_type_room",
                        data_id:data_id,
                        room_name_ks:room_name_ks,
                        gia_tien_kh:gia_tien_kh,
                        gia_tien_dt:gia_tien_dt,
                    },
                    success: function (response) {
                        $('.room_name_ks').val('');
                        $('.gia_tien_kh_add').val('');
                        $('.gia_tien_dt_add').val('');
                        $('.list_room').html(response.data);
                    }
                });
            }else{
                alert('Dữ liệu trống !');
            }
        });

        //Get type room in booking
        $(document).on('click','.pop_ten_khach_san_gd .list_show', function () {
            var id = $(('.ten_khach_san_gd')).val();
            var o = new Option("option text", "value");
            $.ajax({
                type: "post",
                dataType: "json",
                url: my_ajax_object.ajax_url,
                data: {
                    action: "add_type_room_booking",
                    id:id,
                },
                success: function (response) {
                    $('.loai_phong_ban_gd').html(response.data);
                    $('.loai_phong_ban_dt').html(response.data);
                    $('.don_gia_ban_gd').val($(document).find('.loai_phong_ban_gd option:selected').attr('data-price1'));
                    $('.don_gia_ban_dt').val($(document).find('.loai_phong_ban_dt option:selected').attr('data-price2'));
                }
            });
        });

        $(document).on('click','.list_room .room .btn .edit', function(){
            $(this).siblings('.save').show();
            $(this).parents('.btn').siblings('.content').find('input').prop( "disabled", false );
            $(this).hide();
        });

        $(document).on('click','.list_room .room .btn .save', function(){
            var item_room_name = $(this).parents('.btn').siblings('.content').find('.item .item_room_name').val();
            var gia_tien_kh = $(this).parents('.btn').siblings('.content').find('.item .gia_tien_kh').val();
            var gia_tien_dt = $(this).parents('.btn').siblings('.content').find('.item .gia_tien_dt').val();
            var data_id = $(this).parents('.btn').siblings('.content').find('.item .item_room_name').attr('data-id');

            $(this).parents('.btn').siblings('.content').find('input').prop( "disabled", true );

            $(this).siblings('.edit').show();
            $(this).hide();

            if(item_room_name != '' || item_price != ''){
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "add_type_room_edit",
                        item_room_name:item_room_name,
                        gia_tien_kh:gia_tien_kh,
                        gia_tien_dt:gia_tien_dt,
                        data_id:data_id,
                    },
                    success: function (response) {

                    }
                });
            }
        });

        $(document).on('click','.list_room .room .btn .del', function(){
            var data_id = $(this).parents('.btn').siblings('.content').find('.item .item_room_name').attr('data-id');
            var id_firt = $('.add_rom').attr('data-id');
            var item_room_name = $(this).parents('.btn').siblings('.content').find('.item .item_room_name').val();
            var check = confirm('Bạn có chắc muốn xóa : '+item_room_name);

            if(check == true){
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {action: "add_type_room_del", data_id : data_id,id_firt:id_firt},
                    success: function(response){
                        $('.list_room').html(response.data);
                    }
                });
            }
        });

        //Loại bỏ các cảnh báo
        var at = function( test ) {
            try {
                if(typeof test === "function") return test();
                else return test || null;
            } catch (e) {
                return null;
            }
        };
    }

    //Lấy dữ liệu khách hàng khi nhập đúng tên khách vào phần nhập giao dịch
    function getDataClient() {
        $('.khach_dai_dien_gd_val').on('keyup', function(){
            $('.khach_dai_dien_gd').val($(this).val());
        });
        $('.sdt_gd_val').on('keyup', function(){
            $('.sdt_gd').val($(this).val());
        });
        $('.ten_kgd_val').on('keyup', function(){
            $('.ten_kgd').val($(this).val());
        });
        $('.nick_kgd_val').on('keyup', function(){
            $('.nick_kgd').val($(this).val());
        });
        $('.sdt_kgd_val').on('keyup', function(){
            $('.sdt_kgd').val($(this).val());
        });
        $('.email_kgd_duy_nhat_val').on('keyup', function(){
            $('.email_kgd_duy_nhat').val($(this).val());
        });
        $('.tk_kgd_val').on('keyup', function(){
            $('.tk_kgd').val($(this).val());
        });
        $('.ma_kgd_val').on('keyup', function(){
            $('.ma_kgd').val($(this).val());
        });
        $('.ten_dt_gui_book_dt_val').on('keyup', function(){
            $('.ten_dt_gui_book_dt').val($(this).val());
        });
        $('.ma_dt_val').on('keyup', function(){
            $('.ma_dt').val($(this).val());
        });

        $('.khach_dai_dien_gd_val').keyup(delay(function (e) {
            var keyword = $(this).val();
            $.ajax({
                type: "post",
                dataType: "html",
                url: my_ajax_object.ajax_url,
                data: {
                    action: "setKhachDaiDien",
                    keyword:keyword
                },
                success: function (response) {
                    $('.pop_ten').show();
                    $('.pop_ten .list_show').empty();
                    $('.pop_ten .list_show').html(response);
                }
            });
        }, 500));

        $('.ten_nguoi_checkin_ho').keyup(delay(function (e) {
            var keyword = $(this).val();
            $.ajax({
                type: "post",
                dataType: "html",
                url: my_ajax_object.ajax_url,
                data: {
                    action: "setKhachDaiDien",
                    keyword:keyword
                },
                success: function (response) {
                    $('.pop_ten_nguoi_checkin_ho').show();
                    $('.pop_ten_nguoi_checkin_ho .list_show').empty();
                    $('.pop_ten_nguoi_checkin_ho .list_show').html(response);
                }
            });
        }, 500));

        $('.sdt_gd_val').keyup(delay(function (e) {
            var keyword = $(this).val();
            if(keyword != ''){
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "setKhachDaiDienSDT",
                        keyword:keyword
                    },
                    success: function (response) {
                        if(response == 'empty'){
                            $('.popup_get_data_list.pop_sdt').hide();
                        }else{
                            $('.popup_get_data_list.pop_sdt').show();
                            $('.popup_get_data_list.pop_sdt .list_show').empty();
                            $('.popup_get_data_list.pop_sdt .list_show').html(response);
                        }
                    }
                });
            }else{
                $('.popup_get_data_list').hide();
            }

        },500));

        $('.ten_kgd_val').keyup(delay(function (e) {
            var keyword = $(this).val();
            if(keyword != ''){
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "setKhachDaiDienTenKgd",
                        keyword:keyword
                    },
                    success: function (response) {
                        $('.popup_get_data_list.pop_tenkgd').show();
                        $('.popup_get_data_list.pop_tenkgd .list_show').empty();
                        $('.popup_get_data_list.pop_tenkgd .list_show').html(response);
                    }
                });
            }else{
                $('.popup_get_data_list').hide();
            }
        },500));

        $('.nick_kgd_val').keyup(delay(function (e) {
            var keyword = $(this).val();
            if(keyword != ''){
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "setNickKgd",
                        keyword:keyword
                    },
                    success: function (response) {
                        if(response == 'empty'){
                            $('.popup_get_data_list.pop_nick_kgd').hide();
                        }else{
                            $('.popup_get_data_list.pop_nick_kgd').show();
                            $('.popup_get_data_list.pop_nick_kgd .list_show').empty();
                            $('.popup_get_data_list.pop_nick_kgd .list_show').html(response);
                        }
                    }
                });
            }else{
                $('.popup_get_data_list').hide();
            }
        },500));

        $('.sdt_kgd_val').keyup(delay(function (e) {
            var keyword = $(this).val();
            if(keyword != ''){
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "setSdtKgd",
                        keyword:keyword
                    },
                    success: function (response) {
                        if(response == 'empty'){
                            $('.popup_get_data_list.pop_sdt_kgd').hide();
                        }else{
                            $('.popup_get_data_list.pop_sdt_kgd').show();
                            $('.popup_get_data_list.pop_sdt_kgd .list_show').empty();
                            $('.popup_get_data_list.pop_sdt_kgd .list_show').html(response);
                        }
                    }
                });
            }else{
                $('.popup_get_data_list').hide();
            }
        },500));

        $('.email_kgd_duy_nhat_val').keyup(delay(function (e) {
            var keyword = $(this).val();
            if(keyword != ''){
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "setEmail_kgd_duy_nhat",
                        keyword:keyword
                    },
                    success: function (response) {
                        if(response == 'empty'){
                            $('.popup_get_data_list.pop_email_kgd_duy_nhat').hide();
                        }else{
                            $('.popup_get_data_list.pop_email_kgd_duy_nhat').show();
                            $('.popup_get_data_list.pop_email_kgd_duy_nhat .list_show').empty();
                            $('.popup_get_data_list.pop_email_kgd_duy_nhat .list_show').html(response);
                        }
                    }
                });
            }else{
                $('.popup_get_data_list').hide();
            }
        },500));

        $('.tk_kgd_val').keyup(delay(function (e) {
            var keyword = $(this).val();
            if(keyword != ''){
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "setTk_kgd",
                        keyword:keyword
                    },
                    success: function (response) {
                        if(response == 'empty'){
                            $('.popup_get_data_list.pop_tk_kgd').hide();
                        }else{
                            $('.popup_get_data_list.pop_tk_kgd').show();
                            $('.popup_get_data_list.pop_tk_kgd .list_show').empty();
                            $('.popup_get_data_list.pop_tk_kgd .list_show').html(response);
                        }
                    }
                });
            }else{
                $('.popup_get_data_list').hide();
            }
        },500));

        $('.ma_kgd').keyup(delay(function (e) {
            var keyword = $(this).val();
            if(keyword != ''){
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "setMa_kgd",
                        keyword:keyword
                    },
                    success: function (response) {
                        if(response == 'empty'){
                            $('.popup_get_data_list.pop_ma_kgd').hide();
                        }else{
                            $('.popup_get_data_list.pop_ma_kgd').show();
                            $('.popup_get_data_list.pop_ma_kgd .list_show').empty();
                            $('.popup_get_data_list.pop_ma_kgd .list_show').html(response);
                        }
                    }
                });
            }else{
                $('.popup_get_data_list').hide();
            }
        },500));

        $('.ten_dt_gui_book_dt_val').keyup(delay(function (e) {
            var keyword = $(this).val();
            $.ajax({
                type: "post",
                dataType: "html",
                url: my_ajax_object.ajax_url,
                data: {
                    action: "set_pop_ten_dt_gui_book_dt",
                    keyword:keyword
                },
                success: function (response) {
                    $('.popup_get_data_list.pop_ten_dt_gui_book_dt').show();
                    $('.popup_get_data_list.pop_ten_dt_gui_book_dt .list_show').empty();
                    $('.popup_get_data_list.pop_ten_dt_gui_book_dt .list_show').html(response);
                }
            });
        },800));

        $(document).on('click','.popup_get_data_list.pop_ten .list_show ul', function () {
            var ma_kgd = $(this).find('.ma_kgd').val();
            var ten = $(this).find('.ten').val();
            var sdt = $(this).find('.sdt').val();
            var id = $(this).find('.id_kh_show').val();

            $('.khach_dai_dien_gd_val').val(ten);
            $('.khach_dai_dien_gd').val(id);
            $('.sdt_gd_val').val(sdt);
            $('.sdt_gd').val(id);

            $('.popup_get_data_list').hide();
        });

        $(document).on('click','.popup_get_data_list.pop_sdt .list_show ul', function () {
            var ma_kgd = $(this).find('.ma_kgd').val();
            var ten = $(this).find('.ten').val();
            var sdt = $(this).find('.sdt').val();
            var id = $(this).find('.id_kh_show').val();

            $('.khach_dai_dien_gd_val').val(ten);
            $('.khach_dai_dien_gd').val(id);
            $('.sdt_gd_val').val(sdt);
            $('.sdt_gd').val(id);

            $('.popup_get_data_list').hide();
        });

        $(document).on('click','.popup_get_data_list.pop_ten_nguoi_checkin_ho .list_show ul', function () {
            var ten = $(this).find('.ten').val();

            $('.ten_nguoi_checkin_ho').val(ten);

            $('.popup_get_data_list').hide();
        });

        $(document).on('click','.popup_get_data_list.pop_tenkgd .list_show ul', function () {
            var ma_kgd = $(this).find('.ma_kgd').val();
            var ten = $(this).find('.ten').val();
            var sdt = $(this).find('.sdt').val();
            var email = $(this).find('.email').val();
            var tk = $(this).find('.tk').val();
            var nick = $(this).find('.nick').val();
            var link = $(this).find('.link').val();
            var id = $(this).find('.id_kh_show').val();

            $('.email_kgd_duy_nhat').val(id);
            $('.email_kgd_duy_nhat_val').val(email);
            $('.sdt_kgd').val(id);
            $('.sdt_kgd_val').val(sdt);
            $('.nick_kgd').val(id);
            $('.nick_kgd_val').val(nick);
            $('.ten_kgd_val').val(ten);
            $('.ten_kgd').val(id);
            $('.tk_kgd').val(id);
            $('.tk_kgd_val').val(tk);
            $('.ma_kgd').val(id);
            $('.ma_kgd_val').val(ma_kgd);

            $('.popup_get_data_list').hide();
        });

        $(document).on('click','.popup_get_data_list.pop_nick_kgd .list_show ul', function () {
            var ma_kgd = $(this).find('.ma_kgd').val();
            var ten = $(this).find('.ten').val();
            var sdt = $(this).find('.sdt').val();
            var email = $(this).find('.email').val();
            var tk = $(this).find('.tk').val();
            var nick = $(this).find('.nick').val();
            var link = $(this).find('.link').val();
            var id = $(this).find('.id_kh_show').val();

            $('.email_kgd_duy_nhat').val(id);
            $('.email_kgd_duy_nhat_val').val(email);
            $('.sdt_kgd_val').val(sdt);
            $('.sdt_kgd').val(id);
            $('.nick_kgd').val(id);
            $('.nick_kgd_val').val(nick);
            $('.ten_kgd_val').val(ten);
            $('.ten_kgd').val(id);
            $('.tk_kgd').val(id);
            $('.tk_kgd_val').val(tk);
            $('.ma_kgd').val(id);
            $('.ma_kgd_val').val(ma_kgd);

            $('.popup_get_data_list').hide();
        });

        $(document).on('click','.popup_get_data_list.pop_sdt_kgd .list_show ul', function () {
            var ma_kgd = $(this).find('.ma_kgd').val();
            var ten = $(this).find('.ten').val();
            var sdt = $(this).find('.sdt').val();
            var email = $(this).find('.email').val();
            var tk = $(this).find('.tk').val();
            var nick = $(this).find('.nick').val();
            var link = $(this).find('.link').val();
            var id = $(this).find('.id_kh_show').val();

            $('.email_kgd_duy_nhat').val(id);
            $('.email_kgd_duy_nhat_val').val(email);
            $('.sdt_kgd').val(id);
            $('.sdt_kgd_val').val(sdt);
            $('.nick_kgd').val(id);
            $('.nick_kgd_val').val(nick);
            $('.ten_kgd').val(ten);
            $('.tk_kgd').val(id);
            $('.tk_kgd_val').val(tk);
            $('.ma_kgd').val(id);
            $('.ma_kgd_val').val(ma_kgd);

            $('.popup_get_data_list').hide();
        });

        $(document).on('click','.pop_ten_dt_gui_book_dt .list_show ul', function () {
            var ten = $(this).find('.ten').val();
            var mdt = $(this).find('.mdt').val();
            var id = $(this).find('.id_kh_show').val();

            $('input.ten_dt_gui_book_dt').val(id);
            $('input.ten_dt_gui_book_dt_val').val(ten);
            $('.ma_dt_val').val(mdt);
            $('.ma_dt').val(id);

            $('.popup_get_data_list').hide();
        });

        //Tính số đêm ở, ngày sắp đến check in, ngày được hủy, ngày đc thay đổi khi chọn lịch
        function CountGetData(){

            if(! $('.page-template-them_giao_dich .them_giao_dich').hasClass('sua_giao_dich')){
                var date_in = $('.ci_gd').val();
                if ($('.datepicker-here').hasClass('ci_gd')) {
                    //Ngày check-in
                    var date_in = $('.ci_gd').val();
                    date_in = date_in.replace('/', "");
                    date_in = date_in.replace('/', "");
                    var d_in = date_in.slice(0, 2);
                    var m_in = date_in.slice(2, 4);
                    var y_in = date_in.slice(4, 8);
                    var join_string_in = parseInt(y_in + m_in + d_in);
                    var date_checkin = new Date(y_in + '-' + m_in + '-' + d_in);

                    //Check out
                    var date_out = $('.co_gd').val();
                    date_out = date_out.replace('/', "");
                    date_out = date_out.replace('/', "");
                    var d_out = date_out.slice(0, 2);
                    var m_out = date_out.slice(2, 4);
                    var y_out = date_out.slice(4, 8);
                    var join_string_out = parseInt(y_out + m_out + d_out);
                    var date_checkout = new Date(y_out + '-' + m_out + '-' + d_out);

                    //Ngày được hủy
                    var date_del = $('.ngay_duoc_huy').val();
                    date_del = date_del.replace('/', "");
                    date_del = date_del.replace('/', "");
                    var d_del = date_del.slice(0, 2);
                    var m_del = date_del.slice(2, 4);
                    var y_del = date_del.slice(4, 8);
                    var join_string_del = parseInt(y_del + m_del + d_del);
                    var date_huy = new Date(y_del + '-' + m_del + '-' + d_del);

                    //Ngày được thay đổi
                    var date_change = $('.ngay_duoc_thay_doi').val();
                    date_change = date_change.replace('/', "");
                    date_change = date_change.replace('/', "");
                    var d_change = date_change.slice(0, 2);
                    var m_change = date_change.slice(2, 4);
                    var y_change = date_change.slice(4, 8);
                    var join_string_change = parseInt(y_change + m_change + d_change);
                    var date_thay_doi = new Date(y_change + '-' + m_change + '-' + d_change);


                    var diff = new Date(date_checkout - date_checkin);
                    var days = diff / 1000 / 60 / 60 / 24;
                    if (date_out != "" && date_in != "") {
                        $('.so_dem_gd').attr('value', Math.floor(days));
                    } else {
                        $('.so_dem_gd').attr('value', 0);
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
                    //Ngày hiện tại
                    var datetime = year + '-' + month + '-' + day;
                    var datetime = new Date(year + '-' + month + '-' + day);

                    //Đến ngày checkin
                    var diff_con_ngay = new Date(date_checkin - datetime);
                    var days_con_ngay = diff_con_ngay / 1000 / 60 / 60 / 24;
                    $('.con_ngay_gd').attr('value', Math.floor(days_con_ngay));
                    if(days_con_ngay !== days_con_ngay){
                        $('.con_ngay_gd_label').text('?');
                    }else{
                        $('.con_ngay_gd_label').text(Math.floor(days_con_ngay));
                    }

                    //Ngày được hủy
                    var diff_con_ngay = new Date(date_huy - datetime);
                    var days_ngay_huy = diff_con_ngay / 1000 / 60 / 60 / 24;
                    $('.con_ngay_dt').attr('value', days_ngay_huy);
                    if(days_ngay_huy !== days_ngay_huy){
                        $('.con_ngay_dt_label').text('?');
                    }else{
                        $('.con_ngay_dt_label').text(Math.floor(days_ngay_huy));
                    }

                    //Ngày được thay đổi
                    var diff_change = new Date(date_thay_doi - datetime);
                    var days_change = diff_change / 1000 / 60 / 60 / 24;
                    $('.con_ngay_thay_doi_dt').attr('value', Math.floor(days_change));
                    if(days_change !== days_change){
                        $('.con_ngay_thay_doi_dt_label').text('?');
                    }else{
                        $('.con_ngay_thay_doi_dt_label').text(Math.floor(days_change));
                    }
                }

            }
        }

        //Ngày check-in
        if(! $('.page-template-them_giao_dich .them_giao_dich').hasClass('sua_giao_dich')) {
            var date_in = $('.ci_gd').val();
            if(date_in != undefined){
                date_in = date_in.replace('/', "");
                date_in = date_in.replace('/', "");
                var d_in = date_in.slice(0, 2);
                var m_in = date_in.slice(2, 4);
                var y_in = date_in.slice(4, 8);
                var join_string_in = parseInt(y_in + m_in + d_in);
                var date_checkin = new Date(y_in + '-' + m_in + '-' + d_in);

                //Check out
                var date_out = $('.co_gd').val();
                date_out = date_out.replace('/', "");
                date_out = date_out.replace('/', "");
                var d_out = date_out.slice(0, 2);
                var m_out = date_out.slice(2, 4);
                var y_out = date_out.slice(4, 8);
                var join_string_out = parseInt(y_out + m_out + d_out);
                var date_checkout = new Date(y_out + '-' + m_out + '-' + d_out);

                //Ngày được hủy
                var date_del = $('.ngay_duoc_huy').val();
                date_del = date_del.replace('/', "");
                date_del = date_del.replace('/', "");
                var d_del = date_del.slice(0, 2);
                var m_del = date_del.slice(2, 4);
                var y_del = date_del.slice(4, 8);
                var join_string_del = parseInt(y_del + m_del + d_del);
                var date_huy = new Date(y_del + '-' + m_del + '-' + d_del);

                //Ngày được thay đổi
                var date_change = $('.ngay_duoc_thay_doi').val();
                date_change = date_change.replace('/', "");
                date_change = date_change.replace('/', "");
                var d_change = date_change.slice(0, 2);
                var m_change = date_change.slice(2, 4);
                var y_change = date_change.slice(4, 8);
                var join_string_change = parseInt(y_change + m_change + d_change);
                var date_thay_doi = new Date(y_change + '-' + m_change + '-' + d_change);


                var diff = new Date(date_checkout - date_checkin);
                var days = diff / 1000 / 60 / 60 / 24;
                if (date_out != "" && date_in != "") {
                    $('.so_dem_gd').attr('value', Math.floor(days));
                } else {
                    $('.so_dem_gd').attr('value', 0);
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
                //Ngày hiện tại
                var datetime = year + '-' + month + '-' + day;
                var datetime = new Date(year + '-' + month + '-' + day);

                //Đến ngày checkin
                var diff_con_ngay = new Date(date_checkin - datetime);
                var days_con_ngay = diff_con_ngay / 1000 / 60 / 60 / 24;
                $('.con_ngay_gd').attr('value', Math.floor(days_con_ngay));
                if (days_con_ngay !== days_con_ngay) {
                    $('.con_ngay_gd_label').text('?');
                } else {
                    $('.con_ngay_gd_label').text(Math.floor(days_con_ngay));
                }

                //Ngày được hủy
                var diff_con_ngay = new Date(date_huy - datetime);
                var days_ngay_huy = diff_con_ngay / 1000 / 60 / 60 / 24;
                $('.con_ngay_dt').attr('value', days_ngay_huy);
                if (days_ngay_huy !== days_ngay_huy) {
                    $('.con_ngay_dt_label').text('?');
                } else {
                    $('.con_ngay_dt_label').text(Math.floor(days_ngay_huy));
                }

                //Ngày được thay đổi
                var diff_change = new Date(date_thay_doi - datetime);
                var days_change = diff_change / 1000 / 60 / 60 / 24;
                $('.con_ngay_thay_doi_dt').attr('value', Math.floor(days_change));
                if (days_change !== days_change) {
                    $('.con_ngay_thay_doi_dt_label').text('?');
                } else {
                    $('.con_ngay_thay_doi_dt_label').text(Math.floor(days_change));
                }

                //hide air datepick onclick this
                $('.datepicker-here').on('click', function () {
                    $(this).datepicker({
                        days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                        minDate: new Date(),
                        weekends: [0, 5, 6],
                        firstDay: 1,
                        onSelect: function (formattedDate, date, inst) {
                            $('.datepicker').removeClass('active');
                            CountGetData();
                            base_total_hotel_tonight();
                            base_change_count_gd();
                        },
                        onRenderCell: function (date, cellType) {
                            if (date.getDay() == 0) {
                                return {
                                    classes: 'sunday',
                                    disabled: false
                                }
                            }
                        }
                    });
                });
            }
        }



        //hide popup search giao dich
        $('.quantri_admin .them_giao_dich input').on('focus', function () {
            $('.popup_get_data_list').hide();
            $('.pop_ten_khach_san_gd').hide();
        });
        $('.quantri_admin .them_giao_dich select').on('focus', function () {
            $('.popup_get_data_list').hide();
            $('.pop_ten_khach_san_gd').hide();
        });
        $('.quantri_admin .them_giao_dich textarea').on('focus', function () {
            $('.popup_get_data_list').hide();
            $('.pop_ten_khach_san_gd').hide();
        });

    }

    function googleSheet() {
        var submit = $("#submit-form");
        submit.click(function()
        {
            var data = $('form#test-form').serialize();
            $.ajax({
                type : 'GET',
                url : 'https://script.google.com/macros/s/AKfycbwWHOx8dLoZTrkVaKXvpYMihR1vJoTqKT3zHrWL9BeNYgtctaFZ/exec',
                dataType:'json',
                crossDomain : true,
                data : data,
                success : function(data)
                {
                    if(data == 'false')
                    {
                        alert('Thêm không thành công, bạn cũng có thể sử dụng để hiển thị Popup hoặc điều hướng');
                    }else{
                        alert('Đã thêm dữ liệu vào Form');
                    }
                }
            });
            return false;
        });
    }

    //Gửi mã code vào email để lấy lại mật khẩu
    function forget_email() {
        var sub_forget = $('.sub_forget');
        var sub_pass_forget = $('.sub_pass_forget');
        var sub_code = $('.sub_code');
        var load_forget = $('.load_forget');
        var sub_not_code = $('.sub_not_code');

        sub_forget.on('click', function (e) {
            e.preventDefault();
            var email_forget = $('.email_forget').val();
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if(email_forget != "") {
                if(regex.test(email_forget)) {
                    $(this).hide();
                    $('button.load_forget').show();
                    $.ajax({
                        type: "post",
                        dataType: "json",
                        url: my_ajax_object.ajax_url,
                        data: {
                            action: "forget_email",
                            email_forget: email_forget
                        },
                        success: function (response) {
                            sub_forget.show();
                            $('button.load_forget').hide();
                            $('.get_forget_token').hide();
                            $('.form_forget_password').show();
                        }
                    });
                    //return false;
                }else{
                    alert('Nhập địa chỉ email không chính xác !');
                }
            }
        });

        sub_pass_forget.on('click', function (e) {
            e.preventDefault();
            var code_forget = $('.code_forget').val();
            var pass_forget = $('.pass_forget').val();

            $(this).hide();
            $('button.load_forget').show();
            $.ajax({
                type: "post",
                dataType: "json",
                url: my_ajax_object.ajax_url,
                data: {
                    action: "forget_pass",
                    code_forget: code_forget,
                    pass_forget: pass_forget,
                },
                success: function (response) {
                    sub_pass_forget.show();
                    $('button.load_forget').hide();
                    if(response.data == 'false'){
                        $('.form_forget_password .alert').html('<span style="color: red;">Mã bị sai !</span>');
                    }else{
                        $('.form_forget_password .alert').html('<span style="color: green;">Lấy lại mật khẩu thành công !</span>');
                    }
                }
            });
        });

        sub_code.on('click', function () {
            $('.get_forget_token').hide();
            $('.form_forget_password').show();
        });

        sub_not_code.on('click', function () {
            $('.get_forget_token').show();
            $('.form_forget_password').hide();
        });
    }

    //import file excel hotel
    function Excel_Hotel() {
        var sub_import_excel_hotel = $('.sub_import_excel_hotel');
        var frm_excel_hotel = $(".frm_excel_hotel");
        var file_excel = $('.file_excel');
        var show_pecent = $('.show_pecent');

        var img_screen = $('.file_excel').val();
        if(typeof img_screen !== 'undefined'){
            $('.file_excel').change(function (e) {
                e.preventDefault();
                var tmppath = URL.createObjectURL(event.target.files[0]);
                var filename = $('.file_excel').val().split('\\').pop();
                $('.btn_upload_excel').text(filename);
            });

            $('.btn_upload_excel').on('click',function (e) {
                e.preventDefault();
                $('.file_excel').click();
            });
        }

        $('.sub_upload_excel_hotel').on('click', function (e) {
            e.preventDefault();
            var file_data = file_excel.prop('files')[0];
            var form_data = new FormData();

            form_data.append('action', 'excel_hotel_count');
            form_data.append('file', file_data);

            $.ajax({
                url: my_ajax_object.ajax_url,
                type: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: form_data,
                success: function (response) {
                    //$('.page-template-import_excel_hotel .progress .total_import').text(response.data);
                    console.log(response.data);
                },
            });
        });

        $('.page-template-import_excel_hotel .frm_excel_hotel').submit(function (e) {
            e.preventDefault();
            var file_data = file_excel.prop('files')[0];
            var form_data = new FormData();
            var number = 1430;

            form_data.append('action', 'excel_hotel');
            form_data.append('file', file_data);
            form_data.append('number', number);

            $.ajax({
                url: my_ajax_object.ajax_url,
                type: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: form_data,
                async:true,
                cache: false,
                success: function (response) {
                    if(response.data == 'error'){
                        alert('Sai định dạng !');
                    }else{
                        console.log(response.data);
                    }
                },
            });
        });


    }

    //calendar change price time hotel
    function Calendar_price_hotel() {
        var d = new Date();
        var month_current = d.getMonth();
        var total_date = new Date(d.getFullYear(), month_current, 0).getDate();

        var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

        var month = $('.calendar_hotel .month_hotel .insider h3 span').text();
        month = parseInt(month);
        for (var i = 1; i <= total_date + 1; i++){
            var a = new Date(month+'/'+i+'/2019');
            var day_last = a.getDay();
            var a_class;
            if(weekday[day_last] == 'Saturday'){
                a_class = 'active';
            }else if(weekday[day_last] == 'Sunday'){
                a_class = 'active';
            }else{
                a_class = 'dis_active';
            }
            $('.calendar_hotel ul.list_date_box').append('<li class="calendar_list '+a_class+'"><div class="scene"><div class="cube"><div class="cube__face cube__face--front"><div class="info"><h4>'+i+'</h4><p>'+weekday[day_last]+'</p><p>5,000,000 vnđ</p></div></div><div class="cube__face cube__face--back">back</div><div class="cube__face cube__face--right">right</div><div class="cube__face cube__face--left">left</div><div class="cube__face cube__face--top"><div class="info"><h4>'+i+'</h4><p>'+weekday[day_last]+'</p><p>5,000,000 vnđ</p></div><div class="cube__face cube__face--bottom">bottom</div></div></div></li>');
        }

        $('.calendar_hotel .btn_close').on('click', function () {
            $('.calendar_hotel').fadeOut();
        });

        $('.calendar_hotel .month_hotel .insider .next').on('click', function () {
            var $n = 1;
            var start = $('.calendar_hotel .month_hotel .insider h3 span').text();
            var now = new Date();
            var month,count_date;
            var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

            start = parseInt(start);
            $n = start + 1;
            if($n > 12){
                $n = 1;
            }
            month = $n;

            $('.calendar_hotel .month_hotel .insider h3 span').text($n);

            count_date = new Date(now.getFullYear(), $n, 0).getDate();
            $('.calendar_hotel ul.list_date_box').empty();

            for (var i = 1; i <= count_date; i++){
                var a = new Date(month+'/'+i+'/2019');
                var day_last = a.getDay();
                var a_class;
                if(weekday[day_last] == 'Saturday'){
                    a_class = 'active';
                }else if(weekday[day_last] == 'Sunday'){
                    a_class = 'active';
                }else{
                    a_class = 'dis_active';
                }
                $('.calendar_hotel ul.list_date_box').append('<li class="calendar_list '+a_class+'"><div class="scene"><div class="cube"><div class="cube__face cube__face--front"><div class="info"><h4>'+i+'</h4><p>'+weekday[day_last]+'</p><p>5,000,000 vnđ</p></div></div><div class="cube__face cube__face--back">back</div><div class="cube__face cube__face--right">right</div><div class="cube__face cube__face--left">left</div><div class="cube__face cube__face--top"><div class="info"><h4>'+i+'</h4><p>'+weekday[day_last]+'</p><p>5,000,000 vnđ</p></div><div class="cube__face cube__face--bottom">bottom</div></div></div></li>');
            }
        });
        $('.calendar_hotel .month_hotel .insider .prev').on('click', function () {
            var $n = 1;
            var start = $('.calendar_hotel .month_hotel .insider h3 span').text();
            var now = new Date();
            var month,count_date;
            var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

            start = parseInt(start);
            $n = start - 1;
            if($n < 1){
                $n = 12;
            }
            month = $n;

            count_date = new Date(now.getFullYear(), $n, 0).getDate();

            $('.calendar_hotel ul.list_date_box').empty();

            for (var i = 1; i <= count_date; i++){
                var a = new Date(month+'/'+i+'/2019');
                var day_last = a.getDay();
                var a_class;
                if(weekday[day_last] == 'Saturday'){
                    a_class = 'active';
                }else if(weekday[day_last] == 'Sunday'){
                    a_class = 'active';
                }else{
                    a_class = 'dis_active';
                }
                $('.calendar_hotel ul.list_date_box').append('<li class="calendar_list '+a_class+'"><div class="scene"><div class="cube"><div class="cube__face cube__face--front"><div class="info"><h4>'+i+'</h4><p>'+weekday[day_last]+'</p><p>5,000,000 vnđ</p></div></div><div class="cube__face cube__face--back">back</div><div class="cube__face cube__face--right">right</div><div class="cube__face cube__face--left">left</div><div class="cube__face cube__face--top"><div class="info"><h4>'+i+'</h4><p>'+weekday[day_last]+'</p><p>5,000,000 vnđ</p></div><div class="cube__face cube__face--bottom">bottom</div></div></div></li>');
            }

            $('.calendar_hotel .month_hotel .insider h3 span').text($n);

        });

        $(document).on('click','.calendar_hotel .scene .cube .cube__face--front', function () {
            $(this).parents('.cube').addClass('show-top');
        });

        $(document).on('click','.calendar_hotel .scene .cube .cube__face--top',function () {
            $(this).parents('.cube').removeClass('show-top');
        });

        //Check all date regular
        $(document).on('click','.check_date_last_week', function(){
            if($(this).attr('checked') == 'checked'){
                $(this).parents('.option_date_hotel').siblings('ul.list_date_box').find('li.calendar_list.active .scene .cube').addClass('show-top');
                $(this).parents('.option_date_hotel').siblings('ul.list_date_box').find('li.calendar_list.dis_active .scene .cube').removeClass('show-top');
            }else{
                $(this).parents('.option_date_hotel').siblings('ul.list_date_box').find('li.calendar_list.active .scene .cube').removeClass('show-top');
            }
        });

        //Check all date last week
        $(document).on('click','.check_date_regular', function(){
            if($(this).attr('checked') == 'checked'){
                $(this).parents('.option_date_hotel').siblings('ul.list_date_box').find('li.calendar_list.dis_active .scene .cube').addClass('show-top');
                $(this).parents('.option_date_hotel').siblings('ul.list_date_box').find('li.calendar_list.active .scene .cube').removeClass('show-top');
            }else{
                $(this).parents('.option_date_hotel').siblings('ul.list_date_box').find('li.calendar_list.dis_active .scene .cube').removeClass('show-top');
            }
        });
    }

    function DisableErrorJavaScript() {
        function silentErrorHandler() {return true;}
        window.onerror=silentErrorHandler;
    }

    //Thêm giao dịch tiền
    function CountAddPriceBooking(){
        var total_price_1 = 0;
        var val_price;
        $('.list_price_1 .content .item').each(function (i,val) {
            val_price = parseInt($(this).attr('data-price'));
            total_price_1 += val_price;
        });

        $('.total_price_1 span').text(total_price_1.format(0, 3, ','));
    }
    function CountAddPriceBooking2(){
        var total_price_2 = 0;
        var val_price;
        $('.list_price_2 .content .item').each(function (i,val) {
            val_price = parseInt($(this).attr('data-price'));
            total_price_2 += val_price;
        });

        $('.total_price_2 span').text(total_price_2.format(0, 3, ','));
    }

    function AddPriceBooking(){
        $(document).on('keyup','.tien_coc,.tien_coc_di', function(){
            var price = $(this).val();
            price = price.replace(',','');
            price = price.replace(',','');

            $(this).parents('.item').attr('data-price',price);
            CountAddPriceBooking();
            CountAddPriceBooking2();
            $('.da_thanh_toan_khac').val($('.total_price_1 span').text());
            $('.da_thanh_toan_khac2').val($('.total_price_2 span').text());
            base_change_count_gd();

        });

        $(document).on('keyup','.tien_coc', function(){
            $('.save_price_1 span').text('Chưa lưu !');
            $('.save_price_1 span').addClass('color');
        });

        $(document).on('keyup','.tien_coc_di', function(){
            $('.save_price_2 span').text('Chưa lưu !');
            $('.save_price_2 span').addClass('color');
        });

        $(document).on('keyup','.ma_gd_coc', function(){
            var code = $(this).val();
            $(this).parents('.item').attr('data-code',code);
            $('.save_price_1 span').text('Chưa lưu !');
            $('.save_price_1 span').addClass('color');
        });
        $(document).on('click','.ngay_coc.datepicker-here', function(){
            var setThis = $(this);
            $(this).datepicker({
                onSelect: function() {
                    var date = setThis.val();
                    setThis.parents('.item').attr('data-date',date);
                    $('.save_price_1 span').text('Chưa lưu !');
                    $('.save_price_1 span').addClass('color');
                },
            });
        });
        $(document).on('keyup','.tk_coc', function(){
            var tk = $(this).val();
            $(this).parents('.item').attr('data-tk',tk);
            $('.save_price_1 span').text('Chưa lưu !');
            $('.save_price_1 span').addClass('color');
        });

        $(document).on('keyup','.ma_gd_coc_di', function(){
            var code = $(this).val();
            $(this).parents('.item').attr('data-code',code);
            $('.save_price_2 span').text('Chưa lưu !');
            $('.save_price_2 span').addClass('color');
        });
        $(document).on('click','.ngay_phai_coc_di.datepicker-here', function(){
            var setThis = $(this);
            $(this).datepicker({
                onSelect: function() {
                    var date = setThis.val();
                    setThis.parents('.item').attr('data-date',date);
                    $('.save_price_2 span').text('Chưa lưu !');
                    $('.save_price_2 span').addClass('color');
                },
            });
        });
        $(document).on('keyup','.tk_coc_di', function(){
            var tk = $(this).val();
            $(this).parents('.item').attr('data-tk',tk);
            $('.save_price_2 span').text('Chưa lưu !');
            $('.save_price_2 span').addClass('color');
        });

        $(document).on('click','.save_price_1', function(){
            $('.save_price_1 span').text('Đã lưu !');
            $('.save_price_1 span').removeClass('color');
        });

        $(document).on('click','.save_price_2', function(){
            $('.save_price_2 span').text('Đã lưu !');
            $('.save_price_2 span').removeClass('color');
        });

        $(document).on('click','.save_price_1, .save_price_2', function(){
            var update_thanh_toan1 = $('.total_price_1 span').text();
            var update_thanh_toan2 = $('.total_price_2 span').text();
            var kh_con_no_khac = $('.kh_con_no_khac').val();
            var bct_con_no_khac2 = $('.bct_con_no_khac2').val();

            var ma_kgd = $('.ma_kgd').val();
            var ma_dt = $('.ma_dt').val();
            var ma_ctv = $('.ma_ctv').val();
            var ma_nv = $('.ma_nv').val();

            $('.list_price_1 .content .item').each(function (i,val) {
                var id = $(this).attr('data-id');
                var add_ma_gd_coc = $(this).attr('data-code');
                var add_tien_coc = $(this).attr('data-price');
                var add_ngay_coc  = $(this).attr('data-date');
                var add_tk_coc  = $(this).attr('data-tk');

                var id_gd = $('.btn_add_price_gd').attr('data-id');
                var update_thanh_toan1 = $('.total_price_1 span').text();
                var update_thanh_toan2 = $('.total_price_2 span').text();
                var kh_con_no_khac = $('.kh_con_no_khac').val();
                var bct_con_no_khac2 = $('.bct_con_no_khac2').val();

                if(id != "" || id != undefined || add_ma_gd_coc != '' || add_tien_coc != '' || add_ngay_coc != '' || add_tk_coc != ''){
                    $.ajax({
                        type: "post",
                        dataType: "json",
                        url: my_ajax_object.ajax_url,
                        data: {
                            action: "update_price_booking",
                            id:id,
                            id_gd:id_gd,
                            add_ma_gd_coc:add_ma_gd_coc,
                            add_tien_coc:add_tien_coc,
                            add_ngay_coc:add_ngay_coc,
                            add_tk_coc:add_tk_coc,
                            update_thanh_toan1: update_thanh_toan1,
                            update_thanh_toan2: update_thanh_toan2,
                            kh_con_no_khac: kh_con_no_khac,
                            bct_con_no_khac2: bct_con_no_khac2,
                            ma_kgd: ma_kgd,
                            ma_dt: ma_dt,
                            ma_ctv: ma_ctv,
                            ma_nv: ma_nv,
                        },
                        success: function (response) {

                        }
                    });
                }

            });

            $('.list_price_2 .content .item').each(function (i,val) {
                var id = $(this).attr('data-id');
                var add_ma_gd_coc_di = $(this).attr('data-code');
                var add_tien_coc_di = $(this).attr('data-price');
                var add_ngay_coc_di  = $(this).attr('data-date');
                var add_tk_coc_di  = $(this).attr('data-tk');

                var id_gd = $('.btn_add_price_gd').attr('data-id');
                var update_thanh_toan1 = $('.total_price_1 span').text();
                var update_thanh_toan2 = $('.total_price_2 span').text();
                var kh_con_no_khac = $('.kh_con_no_khac').val();
                var bct_con_no_khac2 = $('.bct_con_no_khac2').val();

                if(id != "" || id != undefined || add_ma_gd_coc_di != '' || add_tien_coc_di != '' || add_ngay_coc_di != '' || add_tk_coc_di != ''){
                    $.ajax({
                        type: "post",
                        dataType: "json",
                        url: my_ajax_object.ajax_url,
                        data: {
                            action: "update_price_booking",
                            id:id,
                            id_gd:id_gd,
                            add_ma_gd_coc_di:add_ma_gd_coc_di,
                            add_tien_coc_di:add_tien_coc_di,
                            add_ngay_coc_di:add_ngay_coc_di,
                            add_tk_coc_di:add_tk_coc_di,
                            update_thanh_toan1: update_thanh_toan1,
                            update_thanh_toan2: update_thanh_toan2,
                            kh_con_no_khac: kh_con_no_khac,
                            bct_con_no_khac2: bct_con_no_khac2,
                            ma_kgd: ma_kgd,
                            ma_dt: ma_dt,
                            ma_ctv: ma_ctv,
                            ma_nv: ma_nv,
                        },
                        success: function (response) {

                        }
                    });
                }

            });
        });

        $('.btn_add_price_gd').on('click', function(){
            var ma_gd_them_booking = $('.ma_gd_them_booking').val();
            var id = $(this).attr('data-id');

            var add_ma_gd_coc = $('.add_ma_gd_coc').val();
            var add_tien_coc = $('.add_tien_coc').val();
            var add_ngay_coc  = $('.add_ngay_coc ').val();
            var add_tk_coc = $('.add_tk_coc').val();

            var ma_kgd = $('.ma_kgd').val();
            var ma_dt = $('.ma_dt').val();
            var ma_ctv = $('.ma_ctv').val();
            var ma_nv = $('.ma_nv').val();

            if(add_ma_gd_coc == '' || add_tien_coc == '' || add_ngay_coc == '' || add_tk_coc == ''){
                alert('Giá trị bị trống !');
            }else{
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "add_price_booking",
                        add_tien_coc: add_tien_coc,
                        add_ngay_coc: add_ngay_coc,
                        add_tk_coc: add_tk_coc,
                        ma_gd_them_booking: ma_gd_them_booking,
                        add_ma_gd_coc: add_ma_gd_coc,
                        ma_kgd: ma_kgd,
                        ma_dt: ma_dt,
                        ma_ctv: ma_ctv,
                        ma_nv: ma_nv,
                    },
                    success: function (response) {
                        $('.list_price_1 .content').append(response.data[0]);
                        $(document).find('.tien_coc').simpleMoneyFormat();
                        $(document).find('.tien_coc_di').simpleMoneyFormat();
                        CountAddPriceBooking();
                        $('.da_thanh_toan_khac').val($('.total_price_1 span').text());
                        base_change_count_gd();

                        $('.add_ma_gd_coc').val('');
                        $('.add_tien_coc').val('');
                        $('.add_ngay_coc ').val('');
                        $('.add_tk_coc').val('');

                        setTimeout(function(){
                            var update_thanh_toan1 = $('.total_price_1 span').text();
                            var kh_con_no_khac = $('.kh_con_no_khac').val();
                            $.ajax({
                                type: "post",
                                dataType: "json",
                                url: my_ajax_object.ajax_url,
                                data: {
                                    action: "update_gd_price",
                                    id: id,
                                    update_thanh_toan1: update_thanh_toan1,
                                    kh_con_no_khac: kh_con_no_khac,
                                },
                                success: function (response) {

                                }
                            });
                        },100);
                    }
                });
            }
        });

        $('.btn_add_price_gd2').on('click', function(){
            var ma_gd_them_booking = $('.ma_gd_them_booking').val();
            var id = $(this).attr('data-id');

            var add_ma_gd_coc_di = $('.add_ma_gd_coc_di').val();
            var add_tien_coc_di = $('.add_tien_coc_di').val();
            var add_ngay_phai_coc_di  = $('.add_ngay_phai_coc_di ').val();
            var add_tk_coc_di  = $('.add_tk_coc_di ').val();

            if(add_ma_gd_coc_di == '' || add_tien_coc_di == '' || add_ngay_phai_coc_di == '' || add_tk_coc_di == ''){
                alert('Giá trị bị trống !');
            }else{
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: my_ajax_object.ajax_url,
                    data: {
                        action: "add_price_booking",
                        add_tien_coc_di: add_tien_coc_di,
                        add_ngay_phai_coc_di: add_ngay_phai_coc_di,
                        add_tk_coc_di: add_tk_coc_di,
                        ma_gd_them_booking: ma_gd_them_booking,
                        add_ma_gd_coc_di: add_ma_gd_coc_di,
                    },
                    success: function (response) {
                        $('.list_price_2 .content').append(response.data[1]);
                        $(document).find('.tien_coc').simpleMoneyFormat();
                        $(document).find('.tien_coc_di').simpleMoneyFormat();
                        CountAddPriceBooking2();
                        $('.da_thanh_toan_khac2').val($('.total_price_2 span').text());
                        base_change_count_gd();

                        $('.add_ma_gd_coc_di').val('');
                        $('.add_tien_coc_di').val('');
                        $('.add_ngay_phai_coc_di ').val('');
                        $('.add_tk_coc_di ').val('');


                        setTimeout(function(){
                            var update_thanh_toan2 = $('.total_price_2 span').text();
                            var bct_con_no_khac2 = $('.bct_con_no_khac2').val();
                            $.ajax({
                                type: "post",
                                dataType: "json",
                                url: my_ajax_object.ajax_url,
                                data: {
                                    action: "update_gd_price",
                                    id: id,
                                    update_thanh_toan2: update_thanh_toan2,
                                    bct_con_no_khac2: bct_con_no_khac2,
                                },
                                success: function (response) {

                                }
                            });
                        },100);
                    }
                });
            }
        });

        CountAddPriceBooking();
        CountAddPriceBooking2();
    }

    function checkStatusHotel(){
        $('.status_ks').change(function(){
            var status = $(this).prop('checked');
            var id = $(this).attr('data-id');
            $.ajax({
                type: "post",
                dataType: "json",
                url: my_ajax_object.ajax_url,
                data: {
                    action: "checkStatusHotel",
                    id: id,
                    status: status,
                },
                success: function (response) {

                }
            });
        });
    }

    function _init() {
        base();
        datePicker();
        ajaxDel();
        //CountGetData();
        uploadFileImage();
        checkLogin();
        checklogout();
        parallax();
        //NiceScroll();
        search_email();
        //checkOnline();
        SendMessage();
        AddTypeRoom();
        checkSelect();
        getDataClient();
        forget_email();
        Excel_Hotel();
        Calendar_price_hotel();
        AddPriceBooking();
        checkStatusHotel();
        //googleSheet();
        //DisableErrorJavaScript();
    }

    _init();

} )( jQuery );

