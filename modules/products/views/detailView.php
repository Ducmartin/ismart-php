<?php get_header() ?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <?php get_sidebar() ?>
        <?php if (!empty($data)) { ?>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <img id="main-imgages" src="<?php echo url($data['avatar']) ?>" title="<?php echo $data['product_name'] ?>" />
                            <div id="list-thumb">
                                <?php $images = explode('+', $data['img_file']);
                                foreach ($images as $item) {
                                    if (!empty($item)) { ?>
                                        <img style="cursor:pointer" src="<?php echo url($item) ?>" />
                                <?php }
                                } ?>
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="<?php echo url($data['avatar']) ?>" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name"><?php echo $data['product_name'] ?></h3>
                            <div class="desc">
                                <?php echo $data['product_desc'] ?>
                            </div>
                            <div class="num-product">
                                <?php if ($data['quatum'] > 0) { ?>
                                    <span class="status" style="background: #008000;color:#fff">Còn hàng</span>
                                <?php  } else { ?>
                                    <span class="title" style="background: orange;color:#fff">>Hết hàng</span>
                                <?php } ?>


                            </div>
                            <p class="price"><?php echo currency_format($data['price'] * (1 - ($data['discount'] / 100))); ?></p>
                            <div id="num-order-wp">
                                <!-- <a title="" id="minus"><i class="fa fa-minus"></i></a> -->
                                <label for="num-order">Số lượng:</label>
                                <input type="text" name="num-order" style="cursor:not-allowed" value="1" id="num-order">
                                <!-- <a title="" id="plus"><i class="fa fa-plus"></i></a> -->
                            </div>
                            <a href="<?php echo url_home($data['id'].'/them-gio-hang.html')  ?>" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        <?php echo $data['product_detail'] ?>
                    </div>
                </div>
                <div class="section" id="same-category-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php foreach (get_product_same_category(23) as $item) { ?>
                                <li>
                                    <a href="<?php echo $item['friendly_url'] ?>" title="<?php echo $item['product_name'] ?>" class="thumb">
                                        <img src="<?php echo url($item['avatar']) ?>">
                                    </a>
                                    <div class="price" style=" margin-bottom:40px;position: absolute;bottom:0px;right: 1%; left: 1%;">
                                    <a href="" title="" class="product-name"><?php echo get_name_product($item['product_name'])  ?></a>
                                       <?php if ($item['discount'] == 0) {
                                        ?>
                                            <span class="new"><?php echo currency_format($item['price'] * (1 - ($item['discount'] / 100))); ?></span>
                                        <?php
                                        } else { ?>
                                            <span class="new"><?php echo currency_format($item['price'] * (1 - ($item['discount'] / 100))); ?></span>
                                            <span class="old"><?php echo currency_format($item['price']) ?></span>
                                        <?php  } ?>
                                    </div>
                                    <div class="action clearfix" style="position:absolute;bottom:10px;right: 3%;left: 3%;">
                                    <a href="them-gio-hang.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="hinh-thuc-thanh-toan" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php  } ?>
    </div>
</div>
<?php get_footer() ?>