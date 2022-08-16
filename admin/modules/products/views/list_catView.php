<?php
get_header();
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục sản phẩm</h3>
                    <a href="?mod=products&action=add_cat" title="" id="add-new" class="fl-left">Thêm mới danh mục sản phẩm</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Danh mục cha</span></td>
                                    <td><span class="thead-text">Danh mục con</span></td>
                                    <td><span class="thead-text">Ngày tạo</span></td>
                                    <td><span class="thead-text">Số sản phẩm</span></td>
                                    <td><span class="thead-text">Tác vụ</span></td>
                                </tr>
                            </thead>
                            <?php 
                             if (empty($_GET['page'])) {
                                $k = 0;
                            } else {
                                $k = $_GET['page'] * 10;
                            }
                            foreach ($data as $item) {
                                $k++;
                                if (count(explode('/', $item['friendly_url'])) > 2||check_child_cat_have_parent($item['child_cat'])==false) {
                            ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $k ?></h3></span>
                                    <td><span class="tbody-text"><?php if(!empty(get_parent_cat($item['parent_cat']))) echo get_parent_cat($item['parent_cat']) . '->';  echo $item['parent_cat'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['child_cat'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['created_at'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo count_product_in_cat($item['id'] ) ?></span></td>
                                    <td>
                                            <ul class="list-operation">
                                                <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" style="color:#14c131" aria-hidden="true"></i></a></li>
                                                <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" style="color:#14c131" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                </tr>
                            <?php
                            }}
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
                        <?php
                         if (!empty($data)) {
                            $number = ceil(count_list_cat_child()/10);
                            if ($number > 3 && empty($_GET['page'])) {
                                for ($i = 1; $i < 3; $i++) {
                        ?>
                                    <li>
                                        <a href="?mod=products&action=list_cat&page=<?php echo $i - 1 ?>" title="" style="<?php if (empty($_GET['page']) && $i == 1) echo "background:#1e40e3";
                                                                                                                                if (!empty($_GET['page']) && ($i - 1) == $_GET['page']) echo "background:#1e40e3" ?>"><?php echo $i ?></a>
                                    </li>
                                    <?php
                                    }
                                    if ($i == 3) {
                                    ?>
                                        <li>
                                            <a href="?mod=products&action=list_cat&page=<?php echo $i - 1 ?>" title="" style="<?php if (empty($_GET['page']) && $i == 1) echo "background:#1e40e3";
                                                                                                                                    if (!empty($_GET['page']) && ($i - 1) == $_GET['page']) echo "background:#1e40e3" ?>">></a>
                                        </li>
                                <?php
                                    }
                            } else if ($number > 3 && !empty($_GET['page']&&$_GET['page']!=0)) {
                                for ($i = ($_GET['page']-1); $i < ($_GET['page']+2); $i++) {
                                    if($i == $_GET['page']-1){
                                        ?>
                                        <li>
                                            <a href="?mod=products&action=list_cat&page=<?php echo $i ?>" title=""><<</a>
                                        </li>
                                        <?php
                                    }
                                    if($i == $_GET['page']){
                                        ?>
                                        <li>
                                            <a href="?mod=products&action=list_cat&page=<?php echo $i ?>" title="" style="background:#1e40e3" ><?php echo $_GET['page'] ?></a>
                                        </li>
                                        <?php
                                    }
                                    if($i == $_GET['page']+1&&$i!=$number){
                                        ?>
                                        <li>
                                            <a href="?mod=products&action=list_cat&page=<?php echo $i ?>" title="" >>></a>
                                        </li>
                                        <?php
                                    }
                                ?>

                                <?php
                            }} else if($number>1) {
                                for ($i = 1; $i <= $number; $i++) {
                                ?>
                                    <li>
                                        <a href="?mod=products&action=list_cat&page=<?php echo $i - 1 ?>" title="" style="<?php if (empty($_GET['page']) && $i == 1) echo "background:#1e40e3";
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