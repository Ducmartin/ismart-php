
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
            <h1>Quên mật khẩu</h1>
            <input type="text" name="email" value="<?php echo set_value('email') ?>" id="email" placeholder="email">
            <p class="error"> <?php echo form_error('email') ?></p>
            <input type="submit" name="btn-reset" value="Gửi yêu cầu">
            <p class="error"><?php echo form_error('account') ?></p>
            <a href="dang-nhap.html"> Đăng nhập</a>
            <a href="dang-ky.html">| Đăng ký</a>
        </form>
    </div>

</body>

</html>