<?php

use function Aws\load_compiled_json;

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load("helper", "format");
}

function orderAction()
{
}

function addAction()
{
    if (check_user_login() == true) {
        $data = explode('/', $_SERVER['REQUEST_URI']);
        $id = $data[count($data) - 2];
        add_cart($id);
        redirect("gio-hang.html");
    } else {
        redirect('dang-nhap.html');
    }
}
function showAction()
{
    if (check_user_login() == true) {
        $list_buy = get_list_buy();
        $data['list_buy'] = $list_buy;
        load_view("index", $data);
    } else {
        redirect('dang-nhap.html');
    }
}
function updateAction()
{
    $qty = $_POST['qty'];
    $id = $_POST['id'];
    $item = get_info_product($id);
    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        $_SESSION['cart']['buy'][$id]['qty'] = $qty;
        $sub_total = $qty * $item['price'];
        $_SESSION['cart']['buy'][$id]['sub-total'] = $sub_total;
        update_info_cart();
        $total_num_oder = get_num_order_cart();
        $total = get_total_cart();
        $data = array(
            'sub_total' => currency_format($sub_total),
            'total' => currency_format($total),
            'total_num_oder' => $total_num_oder
        );
        echo json_encode($data);
    }
}
// function detailAction()
// {
//     ob_start();
//     show_array($_POST);
// }
function processAction()
{
    $qty = $_POST['qty'];
    $id = $_POST['id'];
    $item = get_info_product($id);
    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        //cập nhật số lượng
        $_SESSION['cart']['buy'][$id]['qty'] = $qty;
        ///cập nhật giỏi hàng
        $sub_total = $qty * (1-$item['discount']/100)*$item['price'];
        $_SESSION['cart']['buy'][$id]['sub-total'] = $sub_total;
        update_info_cart();
        ///lấy toonge giá trị giỏ hàng
        $total_num_oder = get_num_order_cart();
        $total = get_total_cart();
        $data = array(
            'sub_total' => currency_format($sub_total),
            'total' => currency_format($total),
            'total_num_oder' => $total_num_oder
        );
        echo json_encode($data);
    }
}
function deleteAction()
{
    $data = explode('/', $_SERVER['REQUEST_URI']);
    $id = $data[count($data) - 2];
    delete_cart($id);
    redirect("gio-hang.html");
}
