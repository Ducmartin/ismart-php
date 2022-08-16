<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">

                            <li class="publish" <?php if ($_GET['confirm'] == 0) echo "style='background:#4fa327'" ?>><a href="?mod=orders&action=list_order&confirm=0" <?php if ($_GET['confirm'] == 0) echo "style='color:#fff'" ?>>Chờ xác nhận<span class="count" <?php if ($_GET['confirm'] == 0) echo "style='color:#fff'" ?>>(<?php echo count(get_list_order(5)) ?>)</span></a> |</li>
                            <li class="pending" <?php if ($_GET['confirm'] == 1) echo "style='background:#4fa327'" ?>><a href="?mod=orders&action=list_order&confirm=1" <?php if ($_GET['confirm'] == 1) echo "style='color:#fff'" ?>>Đang đóng hàng<span class="count" <?php if ($_GET['confirm'] == 1) echo "style='color:#fff'" ?>>(<?php echo count(get_list_order(7)) ?>)</span> |</a></li>
                            <li class="all" <?php if ($_GET['confirm'] == 2) echo "style='background:#4fa327'" ?>><a href="?mod=orders&action=list_order&confirm=2" <?php if ($_GET['confirm'] == 2) echo "style='color:#fff'" ?>>Đang giao<span class="count" <?php if ($_GET['confirm'] == 2) echo "style='color:#fff'" ?>>(<?php echo count(get_list_order(8)) ?>)</span></a> |</li>
                            <li class="pending" <?php if ($_GET['confirm'] == 3) echo "style='background:#4fa327'" ?>><a href="?mod=orders&action=list_order&confirm=3" <?php if ($_GET['confirm'] == 3) echo "style='color:#fff'" ?>>Đơn hàng thành công<span class="count" <?php if ($_GET['confirm'] == 3) echo "style='color:#fff'" ?>>(<?php echo count(get_list_order(6)) ?>)</span></a></li>
                        </ul>
                    </div>

                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn</span></td>
                                    <td><span class="thead-text">Người nhận</span></td>
                                    <td><span class="thead-text">Tên Sản Phẩm</span></td>
                                    <td><span class="thead-text">Sl</span></td>
                                    <td><span class="thead-text">Tổng giá</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Xác nhận</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $t = 0;
                                foreach ($data['list_order'] as $item) {
                                    $t++
                                ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                        <td><span class="tbody-text"><?php echo $t ?></h3></span>
                                        <td><span class="tbody-text"><?php echo $item['id'] ?></span>
                                        <td>
                                            <?php $name = get_customer_by_id($item['customer_id']);
                                            echo $name['fullname']; ?>
                                        </td>

                                        <td><span class="tbody-text"> <?php $product = get_product_by_id($item['product_id']);
                                                                        echo $product['product_name']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['number_order'] ?></span></td>
                                        <td><span class="tbody-text"><?php echo currency_format($item['total_price']) ?></span></td>
                                        <td><span class="tbody-text"> <?php $name = get_status_order($item['status_id']);
                                                                        echo $name['status']; ?></span></span></td>
                                        <td><span class="tbody-text"><?php echo $item['created_at'] ?></span></td>
                                        <?php if ($_GET['confirm'] == 0) { ?>
                                            <td><button id="btn_check_<?php echo $item['id'] ?>" data-id="<?php echo $item['id'] ?>" data-confirm="<?php echo $_GET['confirm'] ?>" class="btn_check btn btn-warning" style="color:aliceblue">Xác nhận đơn hàng</button></td>
                                        <?php } ?>
                                        <?php if ($_GET['confirm'] == 1) { ?>
                                            <td><button id="btn_check_<?php echo $item['id'] ?>" data-id="<?php echo $item['id'] ?>" data-confirm="<?php echo $_GET['confirm'] ?>" class="btn_check btn btn-warning" style="color:aliceblue">Đơn hàng đã đóng</button></td>
                                        <?php } ?>
                                        <?php if ($_GET['confirm'] == 2) { ?>
                                            <td><button id="btn_check_<?php echo $item['id'] ?>" data-id="<?php echo $item['id'] ?>" data-confirm="<?php echo $_GET['confirm'] ?>" class="btn_check btn btn-warning" style="color:aliceblue">Xác nhận đã giao</button></td>
                                        <?php } ?>
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