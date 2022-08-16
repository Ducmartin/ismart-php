<?php
get_header();
?>

<div id="main-content-wp" class="info-account-page">

    <div class="wrap clearfix">
        <?php get_sidebar("user") ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
                    </div>
                </div>
                <div class="section-detail">
                    <form method="POST">
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="fullname" value="<?php echo $data['info_user']['fullname'] ?>" id="display-name">
                        <p class="error"> <?php echo form_error('fullname') ?></p>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" value="<?php echo $data['info_user']['username'] ?>" id="username" placeholder="admin" readonly="readonly">
                        <label for="email">Email</label>
                        <input type="email" value="<?php echo $data['info_user']['email'] ?>" name="email" id="email">
                        <p class="error"> <?php echo form_error('email') ?></p>
                        <label for="phone_number">Số điện thoại</label>
                        <input type="tel" value="<?php echo $data['info_user']['phone_number'] ?>" name="phone_number" id="tel">
                        <p class="error"> <?php echo form_error('phone_number') ?></p>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo $data['info_user']['address'] ?></textarea>
                        <p class="error"> <?php echo form_error('address') ?></p>
                        <button type="submit" name="btn-update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>