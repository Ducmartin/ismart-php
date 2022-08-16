<?php
get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="?mod=posts&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=posts&action=list_post&act=tat-ca">Tất cả <span class="count">(<?php echo count(get_all_posts()) ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=posts&action=list_post&act=da-dang">Đã đăng <span class="count">(<?php echo count(get_list_posts_public()) ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=posts&action=list_post&act=cho-xet-duyet">Chờ xét duyệt <span class="count">(<?php echo count(get_list_posts_wait_public()) ?>)</span> |</a></li>
                            <li class="trash"><a href="?mod=posts&action=list_post&act=thung-rac">Thùng rác <span class="count">(<?php echo count(get_list_posts_softdelete()) ?>)</span></a></li>
                        </ul>
                        <form method="POST" action="?mod=posts&action=list_post" class="form-s fl-right">
                            <input type="text" name="search" id="s" placeholder="Nhập tiêu đề trang ">
                            <input type="submit" name="btn_search_post" value="Tìm kiếm">
                            <p><?php if (!empty(form_error('search'))) form_error('search') ?></p>
                        </form>

                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Danh mục trang</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian tạo</span></td>
                                    <td><span class="thead-text">Chức năng</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($data['list_posts']) && !empty($error['search'])) { ?>
                                    <p style="text-align:center; color:red">Không có bài viết nào .Vui lòng kiểu tra lại</p>
                                <?php } ?>
                                <?php $list_posts = $data['list_posts'];
                                if ($data['list_posts'] != '') {
                                    $k = 0;
                                    foreach ($data['list_posts'] as $item) {
                                        $k++;
                                ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo $k ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $item['post_title'] ?></a>
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo get_page_title($item['page_id']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo get_status($item['status_id']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo get_infouser_by_id($item['person_create']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['created_at'] ?></span></td>
                                            <td>
                                                <ul class="list-operation">
                                                    <li><a href="?mod=posts&action=edit&id=<?php echo $item['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" style="color:#14c131" aria-hidden="true"></i></a></li>
                                                    <?php if (!empty($_GET['act']) && $_GET['act'] == 'thung-rac') {
                                                    ?>
                                                        <li><a href="?mod=posts&action=delete&id=<?php echo $item['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" style="color:#14c131" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li><a href="?mod=posts&action=softdelete&id=<?php echo $item['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" style="color:#14c131" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        
        </div>
    </div>
</div>
<?php
get_footer()
?>