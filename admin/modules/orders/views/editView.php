<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm danh mục </h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label>Danh mục</label>
                        <input type="text" name="parent_cat" id="parent_cat" value="<?php echo set_value('parent_cat') ?>">
                        <p><?php if (!empty(form_error('parent_cat'))) form_error('parent_cat') ?></p>
                        <label>Hãng sản xuất:</label>
                        <input type="text" name="child_cat" id="child_cat" value="<?php echo set_value('child_cat') ?>">
                        <p><?php if (!empty(form_error('child_cat'))) form_error('child_cat') ?></p>
                        <p><?php if (!empty(form_error('cat'))) form_error('cat') ?></p>
                        <button type="submit" name="btn-submit-add-cat" id="btn-submit">Thêm mới danh mục</button>
                        <p><?php if (!empty(form_error('list_cat_post'))) form_error('list_cat_post') ?></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>