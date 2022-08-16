
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
            <h1>ĐĂNG NHẬP</h1>
            <input type="text" name="username" value="<?php echo set_value('username')?>" id="username" placeholder="username">
            <p class="error"> <?php  echo form_error('username') ?></p>
            <input type="password" name="password" id="password" placeholder="password">
            <p class="error"><?php echo form_error('password')?></p>
            <div class="checkbox"> <input type="checkbox" name="remember_me" value="">
                <label for="remember_me"> Ghi nhớ đăng nhập</label>
            </div>
            <input type="submit" name="btn-login" value="Đăng nhập">
            <p class="error"><?php echo form_error('account') ?></p>
            <a href="quen-mat-khau.html">Quên mật khẩu?</a>
            <a href="dang-ky.html">| Đăng ký</a>
        </form>
    </div>

</body>

</html>