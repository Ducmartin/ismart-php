
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
            <input type="text" name="fullname" value="<?php echo set_value('fullname')?>" id="fullname" placeholder="fullname">
            <p class="error"> <?php echo form_error('fullname')?></p>
            <input type="text" name="username" value="<?php echo set_value('username')?>" id="username" placeholder="username">
            <p class="error"> <?php  echo form_error('username') ?></p>
            <input type="text" name="email" value="<?php echo set_value('email') ?>" id="email" placeholder="email">
            <p class="error"> <?php echo form_error('email') ?></p>
            <input type="password" name="password" id="password" placeholder="password">
            <p class="error"><?php echo form_error('password')?></p>
            <input type="submit" name="btn-reg" value="Đăng ký">
            <p class="error"><?php echo form_error('account') ?></p>
            <a href="?mod=users&action=login"> Đăng nhập</a>
        </form>
    </div>

</body>

</html>