<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Đơn đã mua</span></td>
                                    <td><span class="thead-text">Tổng Giá trị:</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $t = 0;
                                foreach ($data['list_customer'] as $item) {
                                    $t++;
                                ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                        <td><span class="tbody-text"><?php echo $t ?></h3></span>
                                        <td>
                                            <div class="tb-title fl-left">
                                              <?php echo $item['fullname'] ?>
                                            </div>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $item['phone_number'] ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['address'] ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['time_reg'] ?></span></td>
                                        <td><span class="tbody-text"><?php echo count(get_list_order_by_user_id($item['id'])) ?></span></td>
                                        <td><span class="tbody-text"><?php echo currency_format(get_sum_money($item['id'])) ?></span></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>
<?php
get_footer();
?>