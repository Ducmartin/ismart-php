
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
    <div id="wp-form-login">
        <form action="" method="POST" id="form-login">
            <h1>Mật khẩu mới</h1>
            <input type="password" name="password" value="<?php echo set_value('password') ?>" id="password" placeholder="password">
            <p class="error"> <?php echo form_error('password') ?></p>
            <input type="submit" name="btn-resetpassword" value="Lưu mật khẩu ">
            <p class="error"><?php echo form_error('account') ?></p>
        </form>
    </div>

</body>

</html>