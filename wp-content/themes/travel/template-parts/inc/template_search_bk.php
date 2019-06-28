<div class="search_hotel">
    <form action="<?php echo get_home_url() ?>/tim-kiem-khach-san" method="post">
        <input type="text" name="key_mgd" class="key_mgd" placeholder="MGD...">
        <input type="text" name="key_mbk" class="key_mbk" placeholder="MBK...">
        <input type="text" name="key_mlk" class="key_mlk" placeholder="MLK...">
        <input type="text" name="key_code" class="key_code" placeholder="CODE...">
        <input type="text" name="key_tks" class="key_tks" placeholder="Tên khách sạn...">
        <select name="key_day" class="key_day">
            <option value="Chọn ngày" selected disabled>Chọn ngày</option>
            <?php
            $y_m = '2019-6';

            $list = array();
            $d = date('d', strtotime('last day of this month', strtotime($y_m))); // get max date of current month: 28, 29, 30 or 31.

            for ($i = 1; $i <= $d; $i++) {
                ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
            }
            ?>
        </select>
        <select name="key_month" class="key_month">
            <option value="Chọn tháng" disabled selected>Chọn tháng</option>
            <?php
                $month = 1;
                for($month; $month <= 12; $month++) {
                    ?>
                    <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                    <?php
                }
            ?>
        </select>
        <select name="key_year" class="key_year">
            <option value="Chọn năm" selected disabled>Chọn năm</option>
            <?php
                for($year = 2019; $year <= 2050; $year++){
                    ?>
                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php
                }
            ?>
        </select>
        <button type="submit" name="sub_search_gd" class="sub_search_gd"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
</div>