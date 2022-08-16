<?php
get_header();
?>
<?php
$list_buy=$data['list_buy'];
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <h3 class="title">Giỏ hàng</h3>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <?php
        if (!empty($list_buy)) {
        ?>
            <div class="section" id="info-cart-wp">
                <form action="" method="POST">
                    <div class="section-detail table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>Ảnh sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Giá sản phẩm</td>
                                    <td>Số lượng</td>
                                    <td colspan="2">Thành tiền</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_buy as $item) {
                                ?>
                                    <tr>
                                        <td><?php echo $item['code'] ?></td>
                                        <td>
                                            <a href="<?php echo $item['url'] ?>" title="" class="thumb">
                                                <img src="<?php echo url($item['avatar']) ?>" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo $item['url'] ?>" title="" class="name-product"><?php echo $item['product_name'] ?></a>
                                        </td>
                                        <td id="price"><?php echo currency_format($item['price']) ?></td>
                                        <td>
                                            <input type="number" data-id="<?php echo $item['id'] ?>" class="num_order" name="qty[<?php echo $item['id'] ?>]" min="1" max="100" value="<?php echo $item['qty'] ?>" class="num-order">
                                        </td>
                                        <td id="sub-total-<?php echo $item['id']?>"><?php  echo currency_format($item['sub-total']) ?></td>
                                        <td>
                                            <a href="<?php echo url_home($item['id'].'/xoa-gio-hang.html') ?>" title="xóa sản phẩm" class="del-product"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <p id="total_price" class="fl-right">Tổng giá: <span><?php echo currency_format(get_total_cart()) ?></span></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <div class="fl-right">
                                                <!-- <input type="submit" id="update-cart" name="btn-update" value="Cập nhật giỏ hàng"> -->
                                                <a href="hinh-thuc-thanh-toan.html" title="" id="checkout-cart">Thanh toán</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                    <a href="?" title="" id="buy-more">Mua tiếp</a><br />
                    <a href="?mod=cart&act=delete_all" title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div style="min-height: 500px;text-align:center;">
                <p>Không có sản phẩm nào trong giỏ hàng click <a href="?">vào đây</a> để quay lại trang chủ!</p>
            </div>
        <?php
        }
        ?>

    </div>
</div>
<?php
get_footer();
?>