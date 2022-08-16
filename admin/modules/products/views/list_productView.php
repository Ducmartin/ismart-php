<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=products&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=products&action=list_product&act=tat-ca">Tất cả <span class="count">(<?php echo count(get_all_products()) ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=products&action=list_product&act=da-dang">Đã đăng <span class="count">(<?php echo count(get_list_products_public()) ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=products&action=list_product&act=cho-xet-duyet">Chờ xét duyệt <span class="count">(<?php echo count(get_list_products_wait_public()) ?>)</span> |</a></li>
                            <li class="trash"><a href="?mod=products&action=list_product&act=thung-rac">Thùng rác <span class="count">(<?php echo count(get_list_product_softdelete()) ?>)</span></a></li>
                        </ul>
                        <form method="POST" action="?mod=products&action=search" class="form-s fl-right">
                            <input type="text" placeholder="Nhập mã hoặc tên sản phẩm" name="search" id="s">
                            <input type="submit" name="btn-search-product" value="Tìm kiếm">
                            <p><?php if (!empty(form_error('search'))) form_error('search') ?></p>
                        </form>

                    </div>
                    <div class="actions">
                        <form method="POST" action="?mod=products&action=manage" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1" <?php if (!empty($_GET['act']) && $_GET['act'] == 1) echo "selected" ?>>Đã duyệt</option>
                                <option value="2" <?php if (!empty($_GET['act']) && $_GET['act'] == 2) echo "selected" ?>>Chờ duyệt</option>
                                <option value="3" <?php if (!empty($_GET['act']) && $_GET['act'] == 3) echo "selected" ?>>Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian tạo</span></td>
                                    <td><span class="thead-text">Tác Vụ</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($data['list_product'])) {
                                    if (empty($_GET['page'])) {
                                        $v = 0;
                                    } else {
                                        $v = $_GET['page'] * 10;
                                    }
                                    foreach ($data['list_product'] as $item) {
                                        $v++;
                                ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo $v ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['product_code'] ?></h3></span>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="<?php echo $item['avatar'] ?>" alt="">
                                                </div>
                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $item['product_name'] ?></a>
                                                </div>

                                            </td>
                                            <td><span class="tbody-text"><?php echo  currency_format($item['price']) ?></span></td>
                                            <td><span class="tbody-text"><?php $t = get_cat_product_by_id($item['parent_id']);
                                                                            echo get_parent_cat($t['parent_cat']) . '->' . $t['parent_cat'] . '->' . $t['child_cat']  ?></span></td>
                                            <td><span class="tbody-text"><?php echo get_infouser_by_id($item['person_create']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['created_at'] ?></span></td>
                                            <td>
                                                <ul class="list-operation">
                                                    <li><a href="?mod=products&action=edit&id=<?php echo $item['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" style="color:#14c131" aria-hidden="true"></i></a></li>
                                                    <?php if (!empty($_GET['act']) && $_GET['act'] == 3) {
                                                    ?>
                                                        <li><a href="?mod=products&action=delete&id=<?php echo $item['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" style="color:#14c131" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li><a href="?mod=products&action=softdelete&id=<?php echo $item['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" style="color:#14c131" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    if (!empty($error['search'])) {
                                    ?>
                                        <p style="text-align:center; color:red">Không có sản phẩm nào mã hoặc tên sản phẩm đã tìm kiếm .Vui lòng kiểu tra lại</p>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <?php if (!empty($data['list_product'])&&empty($_GET['query'])) {
                             $url = $_SERVER['REQUEST_URI'];
                            if (strpos($url, 'tat-ca') == true) {
                                $url='tat-ca';
                                $list_product = get_all_products();
                             } else if (strpos($url, "thung-rac")) {
                                $url='thung-rac';
                                $list_product = get_list_product_softdelete();
                             } else if (strpos($url, "da-dang")) {
                                 $url='da-dang';
                                $list_product = get_list_products_public();
                             } else if (strpos($url, "cho-xet-duyet")) {
                                $url='cho-xet-duyet';
                                $list_product = get_list_products_wait_public();
                             }else{
                                $url="";
                             }
                            $number = ceil(count($list_product) / 10);
                            if ($number > 3 && empty($_GET['page'])) {
                                for ($i = 1; $i < 3; $i++) {
                        ?>
                                    <li>
                                        <a href="?mod=products&action=list_product&<?php if(!empty($url)) echo "act"."$url"."&" ?>page=<?php echo $i - 1 ?>" title="" style="<?php if (empty($_GET['page']) && $i == 1) echo "background:#1e40e3";
                                                                                                                                if (!empty($_GET['page']) && ($i - 1) == $_GET['page']) echo "background:#1e40e3" ?>"><?php echo $i ?></a>
                                    </li>
                                    <?php
                                    }
                                    if ($i == 3) {
                                    ?>
                                        <li>
                                            <a href="?mod=products&action=list_product&<?php if(!empty($url)) echo "act"."$url"."&" ?>page=<?php echo $i - 1 ?>" title="" style="<?php if (empty($_GET['page']) && $i == 1) echo "background:#1e40e3";
                                                                                                                                    if (!empty($_GET['page']) && ($i - 1) == $_GET['page']) echo "background:#1e40e3" ?>">></a>
                                        </li>
                                <?php
                                    }
                            } else if ($number > 3 && !empty($_GET['page']&&$_GET['page']!=0)) {
                                for ($i = ($_GET['page']-1); $i < ($_GET['page']+2); $i++) {
                                    if($i == $_GET['page']-1){
                                        ?>
                                        <li>
                                            <a href="?mod=products&action=list_product&<?php if(!empty($url)) echo "act="."$url"."&" ?>page=<?php echo $i ?>" title=""><<</a>
                                        </li>
                                        <?php
                                    }
                                    if($i == $_GET['page']){
                                        ?>
                                        <li>
                                            <a href="?mod=products&action=list_product&<?php if(!empty($url)) echo "act="."$url"."&" ?>page=<?php echo $i ?>" title="" style="background:#1e40e3" ><?php echo $_GET['page'] ?></a>
                                        </li>
                                        <?php
                                    }
                                    if($i == $_GET['page']+1&&$i!=$number){
                                        ?>
                                        <li>
                                            <a href="?mod=products&action=list_product&<?php if(!empty($url)) echo "act="."$url"."&" ?>page=<?php echo $i ?>" title="" >>></a>
                                        </li>
                                        <?php
                                    }
                                ?>

                                <?php
                            }} else if($number>1) {
                                for ($i = 1; $i <= $number; $i++) {
                                ?>
                                    <li>
                                        <a href="?mod=products&action=list_product&<?php if(!empty($url)) echo "act="."$url"."&" ?>page=<?php echo $i - 1 ?>" title="" style="<?php if (empty($_GET['page']) && $i == 1) echo "background:#1e40e3";
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
    </div>
</div>
<?php
get_footer();
?>