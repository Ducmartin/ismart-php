<?php
get_header();
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?php echo url_home() ?>" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php if (!empty($_SESSION['cart']['buy']) || !empty($data)) { ?>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <?php $customer = get_customer($_SESSION['user_login']) ?>
                <div class="section-detail">
                    <form method="POST" action="hinh-thuc-thanh-toan.html" name="form-checkout">
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên</label>
                                <input type="text" value="<?php if (!empty(set_value('fullname'))) echo set_value('fullname');
                                                            else echo $customer['fullname'] ?>" name="fullname" id="fullname">
                                <p class="error"><?php echo form_error('fullname') ?></p>
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <input type="email" value="<?php if (!empty(set_value('email'))) echo set_value('email');
                                                            else echo $customer['email'] ?>" name="email" id="email">
                                <p class="error"><?php echo form_error('email') ?></p>

                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="address">Địa chỉ</label>
                                <input type="text" value="<?php if (!empty(set_value('address'))) echo set_value('address');
                                                            else echo $customer['address'] ?>" name="address" id="address">
                                <p class="error"><?php echo form_error('address') ?></p>
                            </div>
                            <div class="form-col fl-right">
                                <label for="phone_number">Số điện thoại</label>
                                <input type="tel" value="<?php if (!empty(set_value('phone_number'))) echo set_value('phone_number');
                                                            else echo $customer['phone_number'] ?>" name="phone_number" id="phone_number">
                                <p class="error"><?php echo form_error('phone_number') ?></p>

                            </div>
                        </div>
                        <div id="payment-checkout-wp">
                            <ul id="payment_methods">
                                <li>
                                    <input type="radio" id="direct-payment" name="payment_method" value="1" <?php if (isset($_POST['payment_method']) && $_POST['payment_method'] == 1)  echo 'checked'; ?>>
                                    <label for="direct-payment">Thanh toán tại cửa hàng</label>
                                </li>
                                <li>
                                    <input type="radio" id="payment-home" name="payment_method" value="2" <?php if (isset($_POST['payment_method']) && $_POST['payment_method'] == 2)  echo 'checked'; ?>>
                                    <label for="payment-home">Thanh toán tại nhà</label>
                                </li>
                            </ul>
                            <p class="error"><?php echo form_error('payment_method') ?></p>
                        </div>
                        <div class="place-order-wp clearfix">
                            <input type="submit" name="btn_order_now" id="order-now" value="Xác nhận thông tin">
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <form method="POST" action="">

                    <div class="section-detail">
                        <table class="shop-table">
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>
                                    <td>Tổng</td>
                                </tr>
                            </thead>
                            <?php if (!empty($data)) { ?>
                                <tbody>
                                    <tr class="cart-item">
                                        <td class="product-name"><?php echo $data['product_name'] ?><strong class="product-quantity">x 1</strong></td>
                                        <td class="product-total"><?php echo currency_format((1-$data['discount']/100)*$data['price']) ?></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="order-total">
                                        <td>Tổng đơn hàng:</td>
                                        <td><strong class="total-price"><?php echo currency_format((1-$data['discount']/100)*$data['price']) ?></strong></td>
                                    </tr>
                                </tfoot>
                                <?php } else {
                                if (isset($_SESSION['cart']['buy'])) {
                                    foreach ($_SESSION['cart']['buy'] as $item) { ?>

                                        <tbody>
                                            <tr class="cart-item">
                                                <td class="product-name"><?php echo $item['product_name'] ?><strong class="product-quantity">x <?php echo $item['qty'] ?></strong></td>
                                                <td class="product-total"><?php echo currency_format($item['sub-total']) ?></td>
                                            </tr>
                                        </tbody>
                                <?php }
                                } ?>
                                <tfoot>
                                    <tr class="order-total">
                                        <td>Tổng đơn hàng:</td>
                                        <td><strong class="total-price"><?php echo currency_format(get_total_cart()) ?></strong></td>
                                    </tr>
                                </tfoot>
                            <?php  } ?>
                        </table>
                    </div>
                </form>

            </div>
        </div>
    <?php }else{ ?>
        <p style="color: red;text-align:center;font-weight:bolder">Không có sản phẩm nào cần được thanh toán </p>
    <?php }  ?>


</div>
<?php
get_footer();
?>