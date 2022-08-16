<?php
get_header();
?>
<div id="main-content-wp" class="change-pass-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar("user");
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php if (!empty($data['success']))
                        echo ("<div class='alert alert-success' role='alert' style='font-size:20px'>
           Bạn đã đổi mật khẩu thành công!!!!!
               </div>");
                    ?>
                    <div class="section" id="title-page">
                        <div class="clearfix">
                            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
                        </div>
                    </div>
                    <form method="POST">
                        <label for="old-pass">Mật khẩu cũ</label>
                        <input type="password" name="pass-old" value="<?php echo $data['info_user']['password'] ?>" id="pass-old">
                        <label for="new-pass">Mật khẩu mới</label>
                        <input type="password" name="pass-new" id="pass-new">
                        <p class="error"> <?php echo form_error('pass-new') ?></p>
                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm-pass" id="confirm-pass">
                        <p class="error"> <?php echo form_error('confirm-pass') ?></p>
                        <p class="error"> <?php echo form_error('update_pass') ?></p>
                        <button type="submit" name="btn-update-pass" id="btn-update-pass">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>