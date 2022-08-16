<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo set_value('title') ;
                         if (!empty($data) && empty(set_value('title'))) echo $data['page_title'];?>">
                        <p><?php if (!empty(form_error('title'))) form_error('title') ?></p>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo set_value('slug');
                         if (!empty($data) && empty(set_value('slug'))) echo $data['friendly_url']; ?>">
                        <p><?php if (!empty(form_error('slug'))) form_error('slug') ?></p>
                        <?php if (!empty($_GET['id'])) {
                        ?>
                            <label>Trạng thái</label>
                            <select name="status">
                                <option value="0" <?php if (isset($error['status'])) echo ('selected') ?>>--Trạng thái bài viết --</option>
                                <?php $items = list_status();
                                foreach ($items as $item) {
                                ?>
                                    <option value="<?php echo $item['id'] ?>" <?php if (isset($_POST['status']) && $_POST['status'] == $item['id']) echo ('selected');
                                                                                else    if (!empty($data) && $data['status_id'] == $item['id']) echo ('selected')    ?>>
                                        <?php echo $item['status'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        <?php
                        } ?>
                        <p><?php if (!empty(form_error('status'))) form_error('status') ?></p>

                        <?php if (!empty($_GET['id'])) {
                        ?>
                            <button type="submit" name="btn-edit-page" id="btn-submit">Cập nhật bài viết</button>
                        <?php
                        } else{
                       ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới bài viết</button>
                        <?php  } ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>