<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" id="upload_multi" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name" value="<?php echo set_value('product_name');
                                                                                        if (!empty($data) && empty(set_value('product_name'))) echo $data['product_name']; ?>">
                        <p><?php if (!empty(form_error('product_name'))) form_error('product_name') ?></p>
                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code" value="<?php echo set_value('product_code');
                                                                                        if (!empty($data)&& empty(set_value('product_code'))) echo $data['product_code'] ?>">
                        <p><?php if (!empty(form_error('product_code'))) form_error('product_code') ?></p>
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price" value="<?php echo set_value('price');
                                                                            if (!empty($data)&& empty(set_value('price'))) echo $data['price'] ?>">
                        <p><?php if (!empty(form_error('price'))) form_error('price') ?></p>
                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="product_desc" id="desc" class="ckeditor"><?php echo set_value('product_desc');
                                                                                    if (!empty($data)&& empty(set_value('product_desc'))) echo $data['product_desc'] ?></textarea>
                        <p><?php if (!empty(form_error('product_desc'))) form_error('product_desc') ?></p>
                        <label for="product_detail">Chi tiết</label>
                        <textarea name="product_detail" id="desc" class="ckeditor"><?php echo set_value('product_detail');
                                                                                    if (!empty($data)&& empty(set_value('product_detail'))) echo $data['product_detail'] ?></textarea>
                        <p><?php if (!empty(form_error('product_detail'))) form_error('product_detail') ?></p>
                        <label><?php if (!empty($data)) echo 'Thay' ?> Ảnh đại diện</label>
                        <input type="file" name="product_avatar" id="product_avatar" value="<?php echo set_value('product_avatar') ?>">
                        <p><?php if (!empty(form_error('product_avatar'))) form_error('product_avatar') ?></p>
                        <?php if (!empty($data)) {
                        ?>
                            <img src="<?php echo $data['avatar'] ?>" alt="" style="width:200px;height: 300px!important;margin-bottom:5%;margin-top:5%">
                        <?php
                        }  ?>
                        <label><?php if (!empty($data)) echo 'Thêm' ?> Thư viện ảnh</label>
                        <input type="file" name="product_file[]" id="product_file" multiple value="<?php echo set_value('product_file') ?>">
                        <p><?php if (!empty(form_error('product_file'))) form_error('product_file') ?></p>
                        <div class="clear-fix" style="display: flex;flex-wrap: wrap">
                            <?php if (!empty($data)) {
                                $items = explode('+', $data['img_file']);
                                foreach ($items as $item) {
                                    if (!empty($item)) {
                            ?>
                                        <img src="<?php echo $item ?>" alt="" style="width:200px;height: 300px!important;margin-bottom:5%;margin-right:5%;margin-top:5%">

                            <?php
                                    }
                                }
                            }  ?>
                        </div>


                        <label>Danh mục sản phẩm</label>
                        <select name="parent_id">
                            <option value=""  <?php if (isset($error['parent_id'])) echo ('selected');?>>-- Chọn danh mục --</option>
                            <?php $items = list_cat_child();
                            foreach ($items as $item) {
                                if (count(explode('/', $item['friendly_url'])) > 2||check_child_cat_have_parent($item['child_cat'])==false) {
                            ?>
                                    <option value="<?php echo $item['id'] ?>" <?php if (isset($_POST['parent_id']) && $_POST['parent_id'] == $item['id']) echo ('selected');
                                                                              else  if (!empty($data) && $data['parent_id'] == $item['id']) echo ('selected') ?>>
                                                                              <?php  if(!empty(get_parent_cat($item['parent_cat']))) echo get_parent_cat($item['parent_cat']). '->'; echo $item['parent_cat'] . '->' . $item['child_cat'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <p><?php if (!empty(form_error('parent_id'))) form_error('parent_id') ?></p>
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="0"  <?php if (isset($error['status'])) echo ('selected');?> >-- Chọn Trạng thái hàng --</option>
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
                        <p><?php if (!empty(form_error('status'))) form_error('status') ?></p>
                        <label for="quatum">Nhập số lượng sản phẩm ở kho:</label>
                        <input type="number" name="quatum" min='0' id="quatum" value="<?php echo set_value('quatum');
                                                                                        if (!empty($data)&& empty(set_value('quatum'))) echo $data['quatum'] ?>">
                        <p><?php if (!empty(form_error('quatum'))) form_error('quatum') ?></p>
                        <label for="discount">Giảm giá theo %:</label>
                        <input type="number" name="discount" min='0' max='100' style="margin-bottom:5%" id="discount" value="<?php echo set_value('discount'); if (!empty($data)&& empty(set_value('discount'))) echo $data['discount'] ?>">      <br>                  
                        <?php if (!empty($data)) { ?>
                            <button type="submit" style="margin-bottom:0px!important" name="btn-update-product" id="btn-submit">Cập nhật</button>
                        <?php   } else {  ?>
                            <button type="submit" style="margin-bottom:0px!important" name="btn-add-product" id="btn-submit">Thêm mới</button>
                        <?php } ?>
                        <p><?php if (!empty(form_error('product'))) form_error('product') ?></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>