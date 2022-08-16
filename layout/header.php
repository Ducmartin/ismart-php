<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo url_home('public/css/bootstrap/bootstrap-theme.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo url_home('public/css/bootstrap/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo url_home('public/reset.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo url_home('public/css/carousel/owl.carousel.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo url_home('public/css/carousel/owl.theme.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo url_home('public/css/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo url_home('public/style.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo url_home('public/responsive.css') ?>" rel="stylesheet" type="text/css" />

    <script src="<?php echo url_home('public/js/jquery-2.2.4.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo url_home('public/js/elevatezoom-master/jquery.elevatezoom.js') ?>" type="text/javascript"></script>
    <script src="<?php echo url_home('public/js/bootstrap/bootstrap.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo url_home('public/js/carousel/owl.carousel.js') ?>" type="text/javascript"></script>
    <script src="<?php echo url_home('public/js/main.js') ?>" type="text/javascript"></script>
    <script src="<?php echo url_home('public/js/app.js') ?>" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="hinh-thuc-thanh-toan.html" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="http://localhost/backend-PHP/project/ismart.com/" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="dang-ky.html" title="">Đăng ký</a>
                                </li>
                                <?php if (!empty(get_list_page())) {
                                    foreach (get_list_page() as $item) { ?>
                                        <li>
                                            <a href="<?php echo url_home($item['friendly_url'].'.html') ?>" title=""><?php echo $item['page_title'] ?></a>
                                        </li>
                                <?php }
                                } ?>
                                <li>
                                    <?php if (isset($_SESSION['is_login'])) {
                                    ?>
                                        <a href="dang-xuat.html" title=""><?php echo ucfirst($_SESSION['user_login']) ?> <strong>( Đăng xuất )</strong> </a>
                                    <?php } else { ?>
                                        <a href="dang-nhap.html" title="">Đăng nhập</a>
                                    <?php  } ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="http://localhost/backend-PHP/project/ismart.com/" title="" id="logo" class="fl-left"><img src="<?php echo url_home('public/images/logo.png') ?>" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="GET" action="<?php echo url_home() ?>">
                                <input type="text" name="search" value="<?php if (!empty($_GET['search'])) echo $_GET['search'] ?>" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button type="submit" id="header-search">Tìm kiếm</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']['buy']) > 0 && isset($_SESSION['is_login'])) { ?>
                                        <span id="num"><?php echo count($_SESSION['cart']['buy']) ?></span>
                                    <?php  } ?>
                                </div>
                                <div id="dropdown">
                                    <?php if (isset($_SESSION['is_login'])) { ?>
                                        <p class="desc">Có <span><?php if (isset($_SESSION['cart'])) echo count($_SESSION['cart']['buy']);
                                                                    else echo "0" ?> sản phẩm</span> trong giỏ hàng</p>
                                        <ul class="list-cart">
                                            <?php if (isset($_SESSION['cart']['buy'])) {
                                                foreach ($_SESSION['cart']['buy'] as $item) {
                                            ?>
                                                    <li class="clearfix">
                                                        <a href="" title="" class="thumb fl-left">
                                                            <img src="<?php echo url($item['avatar']) ?>" alt="">
                                                        </a>
                                                        <div class="info fl-right">
                                                            <a href="" title="" class="product-name"><?php echo $item['product_name'] ?></a>
                                                            <p class="price"><?php echo currency_format($item['price'])  ?></p>
                                                            <p class="qty">Số lượng: <span><?php echo $item['qty'] ?></span></p>
                                                        </div>
                                                    </li>
                                            <?php }
                                            } ?>

                                        </ul>
                                        <?php if (isset($_SESSION['cart']['buy'])) { ?>
                                            <div class="total-price clearfix">
                                                <p class="title fl-left">Tổng:</p>
                                                <p class="price fl-right"><?php echo currency_format(get_total_cart()); ?></p>
                                            </div>
                                        <?php }  ?>
                                        <dic class="action-cart clearfix">
                                            <a href="gio-hang.html" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="hinh-thuc-thanh-toan.html" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </dic>
                                    <?php   } else { ?>
                                        <p style="color: red;">Bạn chưa đăng nhập.Vui lòng đăng nhập để mua hàng </p>
                                    <?php  } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>