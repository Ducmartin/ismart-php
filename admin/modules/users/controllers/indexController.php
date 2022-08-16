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
    global $username;
    setcookie("is_login", "", time()-3600);
    setcookie("user_login", "", time()-3600);
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
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
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'roles' => "admin",
                );
                add_user($data);
                redirect("?mod=users&action=login");
            } else $error['account'] = 'tên đăng nhập hoặc email đã tồn tại trong hệ thống';
        }
    }
    load_view("reg");
}
function resetAction()
{
    global $pass_old, $error;
    if (isset($_POST['btn-update-pass'])) {
        $error = array();
        if (empty($_POST['pass-new'])) {
            $error['pass-new'] = "Vui lòng nhập lại mật khẩu mới";
        } else {
            if (is_password($_POST['pass-new'])) {
                $pass_new = md5($_POST['pass-new']);
            } else {
                $error['pass-new'] = 'Mật khẩu mới không đúng định dạng!';
            }
        };
        if (empty($_POST['confirm-pass'])) {
            $error['confirm-pass'] = "Xác nhận lại mật khẩu mới";
        } else {
            if (is_password($_POST['confirm-pass'])) {
                $confirm_pass = md5($_POST['confirm-pass']);
            } else {
                $error['confirm-pass'] = 'Xác nhận lại mật khẩu mới không đúng';
            }
        };
        if (isset($pass_new) && isset($confirm_pass) && $pass_new != $confirm_pass) {
            $error['update_pass'] = 'Mật khẩu mới và mật khẩu được xác nhận không trùng nhau';
        }

        if (empty($error)) {
            $data = array(
                'password' => $pass_new,
            );
            $username = $_SESSION['user_login'];
            update_info_user($data, $username);
            $data['success'] = "success";
        }
    }
    $info_user = get_info_user(user_login());
    $data['info_user'] = $info_user;
    load_view("reset", $data);
}
function updateAction()
{
    global $username, $email, $fullname, $address, $phone_number, $info_user, $error;
    if (isset($_POST['btn-update'])) {
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
        if (!empty($_POST['address'])) {
            if (is_address($_POST['address'])) {
                $address = $_POST['address'];
            } else {
                $error['address'] = 'address không đúng định dạng';
            }
        };
        if (!empty($_POST['phone_number'])) {
            if (is_phone_number($_POST['phone_number'])) {
                $phone_number = $_POST['phone_number'];
            } else {
                $error['phone_number'] = 'phone_number không đúng định dạng để thay đổi';
            }
        };
        if (empty($error)) {
            $data = array(
                'fullname' => $fullname,
                'email' => $email,
                'update_account' => date("d-m-Y H:i:s", time()),
                'phone_number' => $phone_number,
                'address' => $address,
            );
            update_info_user($data, $username);
        }
    }
    $info_user = get_info_user(user_login());
    $data['info_user'] = $info_user;
    load_view("update", $data);
}
