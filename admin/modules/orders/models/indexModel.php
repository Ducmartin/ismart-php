<?php

function get_list_order($status_id) {
    $result = db_fetch_array("SELECT * FROM `orders`WHERE`status_id`=$status_id");
    return $result;
}
function get_list_order_by_id($id) {
    $result = db_fetch_row("SELECT * FROM `orders`WHERE`customer_id`='{$id}'");
    return $result;
}
function get_product_by_id($id){
    return   db_fetch_row("SELECT * FROM `products`WHERE`id`='{$id}'");
}
function get_list_customer() {
    $result = db_fetch_array("SELECT * FROM `users`");
    return $result;
}
function get_customer_by_id($id) {
    $result = db_fetch_row("SELECT * FROM `users`WHERE`id`='{$id}'");
    return $result;
}
function get_list_cart($id) {
    $result = db_fetch_array("SELECT * FROM `tbl_carts`WHERE`customer_id`='{$id}'");
    return $result;
}
function get_status_order($id) {
  return   db_fetch_row("SELECT * FROM `status`WHERE`id`='{$id}'");
  
}
function get_list_order_by_user_id($id) {
    $result = db_fetch_array("SELECT * FROM `orders`WHERE`customer_id`='{$id}' AND `status_id`='6' ");
    return $result;
}
function get_sum_money($id){
    $total=0;
    foreach(get_list_order_by_user_id($id) as $item) {
      $total+=$item['total_price'];
    }
    return $total;
}
function update_status_order($data,$id){
    return db_update('orders',$data,"`id`=$id");
}