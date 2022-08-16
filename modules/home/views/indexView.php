<?php
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php foreach (get_slider() as $slider) { ?>
                        <div class="item">
                            <a href="<?php echo $slider['link']?>" title="<?php echo $slider['name']?>">  <img src="<?php echo url($slider['img']) ?>" alt=""></a>
                        </div>
                    <?php  } ?>

                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach (get_product_sale() as $item) { ?>
                            <li>
                                <a href="<?php echo $item['friendly_url'] ?>" title="<?php echo get_name_product($item['product_name'])  ?>" class="thumb">
                                    <img src="<?php echo url($item['avatar']) ?>" style="height:190px">
                                </a>
                                <div class="price" style="  margin-bottom:40px;position: absolute;bottom:0px;right: 1%; left: 1%;">
                                    <a href="<?php echo $item['friendly_url'] ?>" title="" class="product-name"><?php echo get_name_product($item['product_name'])  ?></a>
                                    <?php if ($item['discount'] == 0) {
                                    ?>
                                        <span class="new"><?php echo currency_format($item['price'] * (1 - ($item['discount'] / 100))); ?></span>
                                    <?php
                                    } else { ?>
                                        <span class="new"><?php echo currency_format($item['price'] * (1 - ($item['discount'] / 100))); ?></span>
                                        <span class="old"><?php echo currency_format($item['price']) ?></span>
                                    <?php  } ?>

                                </div>
                                <div class="action" style="position:absolute;bottom:10px;right: 3%;left: 3%;">
                                    <a href="<?php echo url_home($item['id'] . '/them-gio-hang.html')  ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="<?php echo url_home($item['id'] . '/thanh-toan.html')  ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
            <?php
            foreach (list_cat_1() as $cat_1) {
                if (!empty(get_cat_id_1(create_slug($cat_1)))) {
            ?>
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title"><?php echo $cat_1 ?></h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                <?php
                                foreach (get_cat_id_1(create_slug($cat_1)) as $item) {
                                ?>
                                    <li>
                                        <a href="<?php echo $item['friendly_url'] ?>" title="<?php echo get_name_product($item['product_name'])  ?>" class="thumb">
                                            <img src="<?php echo url($item['avatar']) ?>" style="height:190px">
                                        </a>
                                        <div class="price" style="  margin-bottom:40px;position: absolute;bottom:0px;right: 1%; left: 1%;">
                                            <a href="<?php echo $item['friendly_url'] ?>" title="" class="product-name"><?php echo get_name_product($item['product_name'])  ?></a>
                                            <?php if ($item['discount'] == 0) {
                                            ?>
                                                <span class="new"><?php echo currency_format($item['price'] * (1 - ($item['discount'] / 100))); ?></span>
                                            <?php
                                            } else { ?>
                                                <span class="new"><?php echo currency_format($item['price'] * (1 - ($item['discount'] / 100))); ?></span>
                                                <span class="old"><?php echo currency_format($item['price']) ?></span>
                                            <?php  } ?>

                                        </div>
                                        <div class="action" style="position:absolute;bottom:10px;right: 1%;left: 1%;">
                                            <a href="<?php echo url_home($item['id'] . '/them-gio-hang.html')  ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="<?php echo url_home($item['id'] . '/thanh-toan.html')  ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                <?php
                                } ?>

                            </ul>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <?php
        get_sidebar();
        ?>
    </div>
</div>
<?php
get_footer();
?>