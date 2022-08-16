<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Chương trình khuyến mại:</label>
                        <input type="text" name="name" id="title" value="<?php if (isset($_POST['name'])) echo set_value('name'); ?>">
                        <p><?php if (!empty(form_error('name'))) echo form_error('name') ?></p>
                        <label for="title">Link liên kết đến chương trình đã tạo</label>
                        <input type="text" name="link" id="slug" value=<?php if (isset($_POST['link'])) echo set_value('link')?>>
                        <p><?php if (!empty(form_error('link'))) echo form_error('link')?></p>
                        <label for="title">Thứ tự</label>
                        <input type="text" name="location" id="num-order" value="<?php if (isset($_POST['location'])) echo set_value('location'); ?>">
                        <p><?php if (!empty(form_error('location'))) echo form_error('location') ?></p>
                        <label>Hình ảnh</label>
                        <input type="file" name="slider" id="upload-thumb" value="<?php echo set_value('slider') ?>">
                        <p><?php if (!empty(form_error('slider'))) echo form_error('slider') ?></p>
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn trạng thái --</option>
                            <?php $items = list_status();
                            foreach ($items as $item) {
                            ?>
                                <option value="<?php echo $item['id'] ?>" <?php if (isset($_POST['status']) && $_POST['status'] == $item['id']) echo 'selected' ?>><?php echo $item['status'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <p><?php if (!empty(form_error('status'))) echo form_error('status') ?></p>
                        <button type="submit" name="btn_add_slider" id="btn-submit">THÊM SLIDER</button>
                        <p><?php if (!empty(form_error('check'))) echo form_error('check') ?></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>