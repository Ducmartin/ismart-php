<?php
if (isset($_POST['btn-login'])) {
    $error = array();
    if (empty($_POST['username'])) {
        $error['username'] = "không được để trống trường username";
    } else {
        if (is_username($_POST['username'])) {
            $username = $_POST['username'];
        } else {
            $error['username'] = 'Tên đăng nhập không đúng định dạng';
        }
    };
    if (empty($_POST['password'])) {
        $error['password'] = "không được để trống trường password";;
    } else {
        if (is_password($_POST['password'])) {
            $password = $_POST['password'];
        } else {
            $error['password'] = 'Mật khẩu không đúng định dạng';
        }
    };
     
    if (empty($error)) {
        if (check_login($username,$password)) {
            if (isset($_POST['remember_me'])) {
                setcookie('is_login', true, time() + 3600);
                setcookie('user_login', $username, time() + 3600);
            };
            $_SESSION['is_login'] = true;
            $_SESSION['user_login'] = $username;
            ///chuyển hướng nếu đăng nhập thành công
            redirect("?");
        } else {
            $error['account'] = 'tên đăng nhập hoặc mật khẩu không hợp lệ';
        }
    }
    // if (isset($_POST['remember_me'])) {
    //     setcookie('is_login', true, time() + 3600);
    //     $is_login = $_COOKIE['is_login'];
    // }
}
?>
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
            <input type="text" name="username" id="username" placeholder="username">
            <p class="error"> <?php if (!empty($error['username'])) echo $error['username'] ?></p>
            <input type="password" name="password" id="password" placeholder="password">
            <p class="error"><?php if (!empty($error['password'])) echo $error['password'] ?></p>
            <div class="checkbox"> <input type="checkbox" name="remember_me" value="">
                <label for="remember_me"> Ghi nhớ đăng nhập</label>
            </div>
            <input type="submit" name="btn-login" value="Đăng nhập">
            <p class="error"><?php if (!empty($error['account'])) echo $error['account'] ?></p>
            <a href="">Quên mật khẩu?</a>
        </form>
    </div>

</body>

</html>