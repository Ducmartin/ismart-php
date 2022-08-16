<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left"><?php if (!empty($_GET['id'])) echo "Chỉnh sửa";
                                                    else echo "Thêm mới " ?> bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo set_value('title');
                                                                            if (!empty($data) && empty(set_value('title'))) echo $data['post_title']; ?>">
                        <p><?php if (!empty(form_error('title'))) form_error('title');  ?></p>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo set_value('slug');
                                                                        if (!empty($data) && empty(set_value('slug'))) echo $data['friendly_url']; ?>">
                        <p><?php if (!empty(form_error('slug'))) form_error('slug') ?></p>
                        <label for="post_desc">Mô tả ngắn</label>
                        <input type="text" name="post_desc" id="post_desc" value="<?php echo set_value('post_desc');
                                                                                    if (!empty($data) && empty(set_value('post_desc'))) echo $data['post_desc']; ?>">
                        <p><?php if (!empty(form_error('post_desc'))) form_error('post_desc') ?></p>
                        <?php if ($_GET['id'] == 0) { ?>
                            <label>Ảnh đại diện bào viết:</label>
                            <input type="file" name="post_avatar" id="post_avatar" value="<?php echo set_value('post_avatar') ?>">
                            <p><?php if (!empty(form_error('post_avatar'))) form_error('post_avatar') ?></p>
                        <?php  } ?>

                        <label for="desc">Nội dung bài viết:</label>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo set_value('desc');
                                                                            if (!empty($data) && empty(set_value('desc'))) echo $data['post_content']; ?></textarea>
                        <p><?php if (!empty(form_error('desc'))) form_error('desc') ?></p>
                        <label>Danh mục cha</label>
                        <select name="page_id">
                            <option value="" <?php if (isset($error['page_id'])) echo ('selected'); ?>>-- Chọn danh mục --</option>
                            <?php $items = get_page();
                            foreach ($items as $item) {
                            ?>
                                <option value="<?php echo $item['id'] ?>" <?php if (isset($_POST['page_id']) && $_POST['page_id'] == $item['id']) echo ('selected');
                                                                            else    if (!empty($data) && $data['page_id'] == $item['id']) echo ('selected'); ?>><?php echo $item['page_title'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <p><?php if (!empty(form_error('page_id'))) form_error('page_id') ?></p>
                        <?php if (!empty($_GET['id'])) {
                        ?>
                            <label>Trạng thái</label>
                            <select name="status">
                                <option value="0" <?php if (isset($error['status'])) echo ('selected') ?>>-- Chọn Trạng thái bài viết --</option>
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
                            <button type="submit" name="btn-edit-post" id="btn-submit">Cập nhật bài viết</button>
                        <?php
                        } else {
                        ?>
                            <button type="submit" name="btn-submit-post" id="btn-submit">Thêm mới bài viết</button>
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