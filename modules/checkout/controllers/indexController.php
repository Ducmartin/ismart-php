<?php

function construct()
{
    load_model('index');
    load("helper", "validation_form");
}
function indexAction()
{
    if (check_user_login() == true) {
        global $fullname, $email, $address, $phone_number, $error, $method;
        if (isset($_POST['btn_order_now'])) {
            $error = array();
            if (empty($_POST['email'])) {
                $error['email'] = "không được để trống trường username";
            } else {
                if (is_email($_POST['email'])) {
                    $email = $_POST['email'];
                } else {
                    $error['email'] = 'Email không đúng định dạng';
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
            if (empty($_POST['address'])) {
                $error['address'] = "không được để trống địa chỉ giao hàng";
            } else {
                $address = $_POST['address'];
            };
            if (empty($_POST['phone_number'])) {
                $error['phone_number'] = "không được để trống số điện thoại";
            } else {
                $phone_number = $_POST['phone_number'];
            };
            if (empty($_POST['payment_method'])) {
                $error['payment_method'] = "không được để trống phương thức thanh toán";
            } else {
                $method = $_POST['payment_method'];
                if ($_POST['payment_method'] == 1) {
                    $method = "thanh toán tại cửa hàng";
                }
                if ($_POST['payment_method'] == 2) {
                    $method = "thanh toán tại nhà";
                }
            };
            if (empty($error)) {
                $data = array(
                    'fullname' => $fullname,
                    'email' => $email,
                    'address' => $address,
                    'phone_number' => $phone_number
                );
                update_customer($data, $_SESSION['user_login']);
                $customer_id = get_customer($_SESSION['user_login']);
                foreach ($_SESSION['cart']['buy'] as $item) {
                    $data = array(
                        'customer_id' => $customer_id['id'],
                        'status_id' => 5,
                        'product_id' => $item['id'],
                        'number_order' => $item['qty'],
                        'total_price' => $item['sub-total'],
                        'payment_method' => $method,
                        'created_at' => date('Y-m-d H:m:s', time()),
                    );
                    add_order($data);
                    $id = $item['id'];
                    delete_cart($id);
                }
                $data = array('success' => 1);
                alert("Bạn đã đặt hàng thành công");
            }
        }
        load_view("index");
    } else {
        redirect('dang-nhap.html');
    }
}
function processAction()
{
    if (check_user_login() == true) {
        global $fullname, $email, $address, $phone_number, $error, $method;
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = $url[count($url) - 2];
        $item = get_product($id);
        if (isset($_POST['btn_order_now'])) {
            $error = array();
            if (empty($_POST['email'])) {
                $error['email'] = "không được để trống trường username";
            } else {
                if (is_email($_POST['email'])) {
                    $email = $_POST['email'];
                } else {
                    $error['email'] = 'Email không đúng định dạng';
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
            if (empty($_POST['address'])) {
                $error['address'] = "không được để trống địa chỉ giao hàng";
            } else {
                $address = $_POST['address'];
            };
            if (empty($_POST['phone_number'])) {
                $error['phone_number'] = "không được để trống số điện thoại";
            } else {
                $phone_number = $_POST['phone_number'];
            };
            if (empty($_POST['payment_method'])) {
                $error['payment_method'] = "không được để trống phương thức thanh toán";
            } else {
                $method = $_POST['payment_method'];
                if ($_POST['payment_method'] == 1) {
                    $method = "thanh toán tại cửa hàng";
                }
                if ($_POST['payment_method'] == 2) {
                    $method = "thanh toán tại nhà";
                }
            };
            if (empty($error)) {
                $data = array(
                    'fullname' => $fullname,
                    'email' => $email,
                    'address' => $address,
                    'phone_number' => $phone_number
                );
                update_customer($data, $_SESSION['user_login']);
                $customer_id = get_customer($_SESSION['user_login']);
                $data = array(
                    'customer_id' => $customer_id['id'],
                    'status_id' => 5,
                    'product_id' => $item['id'],
                    'number_order' => 1,
                    'total_price' => (1 - $item['discount'] / 100) * $item['price'],
                    'payment_method' => $method,
                    'created_at' => date('Y-m-d H:m:s', time()),
                );
                add_order($data);
                alert("Bạn đã đặt hàng thành công");
                $item="";
            }
        }
        load_view("index", $item);
    } else {
        redirect('dang-nhap.html');
    }
}
