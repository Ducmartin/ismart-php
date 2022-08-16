<?php
get_header();
?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?php echo url_home() ?>" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Tìm kiếm</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php if (empty($data)) { ?>
            <p style="font-size: 20px;font-weight: lighter;position: absolute;left: 35%;">Không có sản phẩm nào để hiển thị .Ấn vào đây để quay về <a href="<?php echo url_home() ?>">trang chủ</a></p>
        <?php } else { ?>
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp">
                    <?php if (!empty($data)) {
                        $t = 0 ?>
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                <?php foreach ($data as $item) {
                                    $t++; ?>
                                    <li>
                                        <a href="<?php echo url_home($item['friendly_url']) ?>" title="" class="thumb">
                                            <img style="height: 190px;margin-left: 10%;margin-right: 20%;box-sizing:border-box" src="<?php echo url($item['avatar']) ?>">
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
                                            <a href="them-gio-hang.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="hinh-thuc-thanh-toan.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                <?php }
                                ?>

                            </ul>
                        </div>
                    <?php  } ?>
                </div>
            </div>
        <?php } ?>

        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
?>