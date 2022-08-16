<?php
function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}
function currency_format($number, $suffix = 'đ'){
    return number_format($number,'0','.','.').$suffix;
}
function check_user_login(){
    if(isset($_SESSION['is_login'])){
        return true;
    }
    return false;
}
function get_total_cart(){
    if(isset($_SESSION['cart'])){
        return $_SESSION['cart']['info']['total'];
    }
}
function get_list_page(){
    return db_fetch_array("SELECT*FROM`pages`");
}