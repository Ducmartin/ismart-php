<?php

function construct()
{
    load_model('index');
    load("helper", "validation_form");
    load("lib", 'send_mail');
}

function loginAction()
{
    global $password, $username, $error;
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
            check_login($username, $password);
            $error['account'] = 'tên đăng nhập hoặc mật khẩu không hợp lệ';
        }
    }
    load_view("index");
}

function logoutAction()
{
    setcookie("is_login", "", time()-3600);
    setcookie("user_login", "", time()-3600);
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("");
}
function regAction()
{
    global $email, $fullname, $password, $username, $error;
    if (isset($_POST['btn-reg'])) {
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
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "không được để trống trường fullname";
        } else {
            if (is_fullname($_POST['fullname'])) {
                $fullname = $_POST['fullname'];
            } else {
                $error['fullname'] = 'Họ và tên không đúng định dạng';
            }
        };
        if (empty($_POST['email'])) {
            $error['email'] = "không được để trống trường email";
        } else {
            if (is_email($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $error['email'] = 'Email không đúng định dạng';
            }
        };
        if (empty($_POST['password'])) {
            $error['password'] = "không được để trống trường password";;
        } else {
            if (is_password($_POST['password'])) {
                $password = md5($_POST['password']);
            } else {
                $error['password'] = 'Mật khẩu không đúng định dạng';
            }
        };
        if (empty($error)) {
            if (!check_user_reg()) {
                $active_token = md5($username . time());
                $lock_login = base_url("kich-hoat-tai-khoan/$active_token");
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'is_active' => 0,
                    'active_token' => $active_token,
                    'time_reg' => date('Y-m-d H:m:s', time()),
                );
                add_user($data);
                send_mail($email, $fullname, 'kích hoạt tài khoản', "<a href='$lock_login'>$lock_login</a>");
                redirect("dang-nhap.html");
            } else {
                $error['account'] = 'tên đăng nhập hoặc email đã tồn tại trong hệ thống';
            }
        }
    }
    load_view("reg");
}
function activeAction()
{
    $data = explode('/', $_SERVER['REQUEST_URI']);
    $active_token = $data[count($data) - 1];
    if (check_active_token($active_token)) {
        is_token($active_token);
        $login = base_url("dang-nhap.html");
        echo "Bạn đã kích hoạt thành công! vui lòng click vào đây để đăng nhập:<a href='{$login}'>Đăng nhập</a>";
    } else {
        echo " yêu cầu kích hoạt ko hợp lệ!Hoặc đã được kích hoạt trước đó";
    };
}
function reset_passAction()
{
    global $error, $email;

    if (isset($_GET['reset_token'])) {
        $data = explode('/', $_SERVER['REQUEST_URI']);
        $reset_pass = $data[count($data) - 1];
        if (isset($_POST['btn-resetpassword'])) {
            $error = array();
            if (empty($_POST['password'])) {
                $error['password'] = "không được để trống trường password";;
            } else {
                if (is_password($_POST['password'])) {
                    $password = md5($_POST['password']);
                } else {
                    $error['password'] = 'Mật khẩu không đúng định dạng';
                }
            };
            if (empty($error)) {
                $data = array(
                    'password' => $password,
                );
                update_resetpassword($data, $reset_pass);
                redirect("?mod=login&controller=index&action=success");
            }
        }
        load_view("resetpassword");
    } else {
        if (isset($_POST['btn-reset'])) {
            $error = array();
            if (empty($_POST['email'])) {
                $error['email'] = "không được để trống trường email";
            } else {
                if (is_email($_POST['email'])) {
                    $email = $_POST['email'];
                } else {
                    $error['email'] = 'Email không đúng định dạng';
                }
            }
            if (empty($error)) {
                if (check_email($email)) {
                    $reset_token = md5($email . time());
                    $link = base_url("reset-mat-khau/$reset_token");
                    $content = " <p>Xin chào bạn</p>
                    <p>Nếu bán muốn thay đổi mật khẩu trong PHP.MASTER vui lòng click vào đường link sau:<a href='$link'>$link</a></p>
                    <p>Nếu không phải bạn vui lòng bỏ qua email này!!!</p>";
                    $data = array(
                        'reset_token' => $reset_token,
                    );
                    update_reset_token($data, $email);
                    send_mail($email, '', 'KHôi phục lại mật khẩu', $content);
                    redirect("?mod=login&action=check");
                } else $error['account'] = ' email không tồn tại trong hệ thống';
            }
        }
        load_view("reset_pass");
    };
}
function checkAction()
{
    load_view("check_mail");
}
function successAction()
{
    load_view("resetsuccess");
}
