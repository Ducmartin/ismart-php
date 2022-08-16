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
                    <?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $str = str_replace(url_home(), '', $actual_link);
                    $title = explode('/', $str);
                    if (isset($title[1]) && !empty(get_title(list_cat_1(), $title[0]))) { ?>
                        <li>
                            <a href="<?php echo url_home($title[0]) . '/' ?>" title=""><?php echo get_title(list_cat_1(), $title[0]); ?></a>
                        </li>
                    <?php } ?>
                    <?php if (isset($title[1]) && !empty(get_title(list_cat_2($title[0]), $title[1]))) { ?>
                        <li>
                            <a href="<?php echo url_home($title[0] . '/' . $title[1]) . '/' ?>" title=""><?php echo get_title(list_cat_2($title[0]), $title[1]); ?></a>
                        </li>
                    <?php } ?>
                    <?php if (isset($title[2]) && !empty(get_title(list_cat_3($title[0] . '/' . $title[1]), $title[2]))) { ?>
                        <li>
                            <a href="<?php echo url_home($title[0] . '/' . $title[1] . '/' . $title[2]) . '/' ?>" title=""><?php echo get_title(list_cat_3($title[0] . '/' . $title[1]), $title[2]); ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php if (empty($data)) { ?>
            <p style="font-size: 20px;font-weight: lighter;position: absolute;left: 35%;">Không có sản phẩm nào để hiển thị .Ấn vào đây để quay về <a href="<?php echo url_home() ?>">trang chủ</a></p>
        <?php } else { ?>
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left"><?php
                                                            if (count($title) > 0) {
                                                                if (count($title) == 2 && !empty(get_title(list_cat_1(), $title[0]))) echo get_title(list_cat_1(), $title[0]);
                                                                if (count($title) == 3 && !empty(get_title(list_cat_2($title[0]), $title[1]))) echo get_title(list_cat_2($title[0]), $title[1]);
                                                                if (count($title) == 4 && !empty(get_title(list_cat_3($title[0] . '/' . $title[1]), $title[2]))) echo get_title(list_cat_3($title[0] . '/' . $title[1]), $title[2]);
                                                            }
                                                            ?></h3>
                    </div>
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
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php if (!empty($data)) {
                                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                $page = explode('=', $actual_link);
                                if (count($page) == 1) {
                                    $url = $page[0];
                                    $x = str_replace(url_home(), '', $actual_link);
                                    $number = ceil(count_cat_id_1(substr($x, 0, strlen($x) - 1)) / 40);
                                }
                                if (count($page) == 2) {
                                    $x = str_replace(url_home(), '', $actual_link);
                                    $url = substr($page[0], 0, strlen($page[0]) - 5);
                                    $number = ceil(count_cat_id_1(substr($x, 0, strlen($x) - 8)) / 40);
                                }

                                if ($number > 3 && $page[1] < 3) {
                                    for ($i = 1; $i < 3; $i++) { ?>
                                        <li>
                                            <a href="<?php echo $url . 'trang=' . $i ?>" title="" style="<?php if ($page[1] == $i) echo "background:#1e40e3"; ?>"><?php echo $i ?></a>
                                        </li>
                                    <?php
                                    }
                                    if ($i == 3) {
                                    ?>
                                        <li>
                                            <a href="<?php echo $url . 'trang=' . $i ?>" title="" style="<?php if (empty($_GET['page']) && $i == 1) echo "background:#1e40e3";
                                                                                                        if (!empty($_GET['page']) && ($i - 1) == $_GET['page']) echo "background:#1e40e3" ?>">></a>
                                        </li>
                                        <?php
                                    }
                                } else if ($number > 3 && count($page) == 2) {
                                    for ($i = ($page[1] - 1); $i < ($page[1] + 2); $i++) {
                                        if ($i == $page[1] - 1) {
                                        ?>
                                            <li>
                                                <a href="<?php echo $url . 'trang=' . $i ?>">
                                                    << </a>
                                            </li>
                                        <?php
                                        }
                                        if ($i == $page[1]) {
                                        ?>
                                            <li>
                                                <a href="<?php echo $url . 'trang=' . $i ?>" title="" style="background:#1e40e3"><?php echo $i ?></a>
                                            </li>
                                        <?php
                                        }
                                        if ($i == $page[1] + 1 && $i != $number) {
                                        ?>
                                            <li>
                                                <a href="<?php echo $url . 'trang=' . $i ?>" title="">>></a>
                                            </li>
                                        <?php
                                        }
                                        ?>

                                    <?php
                                    }
                                } else if ($number > 1) {
                                    for ($i = 1; $i <= $number; $i++) {
                                    ?>
                                        <li>
                                            <a href="<?php echo $url . 'trang=' . $i ?>" title="" style="<?php if (empty($_GET['page']) && $i == 1) echo "background:#1e40e3";
                                                                                                        if (!empty($_GET['page']) && ($i - 1) == $_GET['page']) echo "background:#1e40e3" ?>"><?php echo $i ?></a>
                                        </li>
                            <?php
                                    }
                                }
                            } ?>
                        </ul>
                    </div>

                </div>
            </div>
        <?php } ?>

        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
?>