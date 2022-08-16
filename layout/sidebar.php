<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <ul class="list-item">
                <?php foreach (list_cat_1() as $item) {
                ?>
                    <li>
                        <a href="<?php echo url_home().create_slug($item).'/' ?>" title=""><?php echo  $item ?></a>
                        <?php if (!empty(list_cat_2(create_slug($item)))) { ?>
                            <ul class="sub-menu">
                                <?php
                                foreach (list_cat_2(create_slug($item)) as $cat_2) {
                                ?>
                                    <li>
                                        <a href="<?php echo url_home().create_slug($item).'/'.create_slug(($cat_2)).'/' ?>" title=""><?php echo $cat_2 ?></a>
                                        <?php if (!empty(list_cat_3((create_slug($item) . '/' . create_slug($cat_2))))) { ?>
                                            <ul class="sub-menu">
                                                <?php
                                                foreach (list_cat_3((create_slug($item) . '/' . create_slug($cat_2))) as $cat_3) {
                                                ?>
                                                    <li>
                                                        <a href="<?php echo url_home().create_slug($item).'/'.create_slug(($cat_2)).'/'.create_slug(($cat_3)).'/' ?>" title=""><?php echo $cat_3 ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                    </li>

                                <?php } ?>
                            </ul>
                        <?php } ?>

                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                <?php foreach (get_product_sold() as $item) { ?>
                    <li class="clearfix" >
                        <a href="<?php echo url_home($item['friendly_url']) ?>" title="<?php echo $item['product_name'] ?>" class="thumb fl-left">
                            <img src="<?php echo url($item['avatar']) ?>" alt="" style="height:80px;">
                        </a>
                        <div class="info fl-right">
                            <div class="price">
                            <a href="<?php echo url_home($item['friendly_url']) ?>" title="" class="product-name"><?php echo get_name_product($item['product_name']) ?></a>
                                <?php if ($item['discount'] == 0) {
                                ?>
                                    <span class="new"><?php echo currency_format($item['price'] * (1 - ($item['discount'] / 100))); ?></span>
                                <?php
                                } else { ?>
                                    <span class="new"><?php echo currency_format($item['price'] * (1 - ($item['discount'] / 100))); ?></span>
                                    <span class="old"><?php echo currency_format($item['price']) ?></span>
                                <?php  } ?>

                            </div>
                            <a href="<?php echo url_home('hinh-thuc-thanh-toan.html') ?>" title="" class="buy-now">Mua ngay</a>
                        </div>
                    </li>

                <?php      } ?>

            </ul>
        </div>
    </div>
</div>