<?php

function construct()
{
   //    echo "DÙng chung, load đầu tiên";
   load_model('index');
}

function detail_orderAction()
{
   $id = $_GET['customer_id'];
   $info_order = get_list_order_by_id($id);
   $info_customer = get_customer_by_id($id);
   $info_cart = get_list_cart($id);
   $data['info_cart'] = $info_cart;
   $data['info_order'] = $info_order;
   $data['info_customer'] = $info_customer;
   load_view("detail_order", $data);
}
function list_orderAction()
{
   $confirm = $_GET['confirm'];
   if ($confirm == 0) {
      $list_order = get_list_order(5);
   }
   if ($confirm == 1) {
      $list_order = get_list_order(7);
   }
   if ($confirm == 2) {
      $list_order = get_list_order(8);
   }
   if ($confirm == 3) {
      $list_order = get_list_order(6);
   }
   $data['list_order'] = $list_order;
   load_view("list_order", $data);
}
function list_customerAction()
{
   $list_customer = get_list_customer();
   $data['list_customer'] = $list_customer;
   load_view("list_customer", $data);
}
function confirm_orderAction()
{
   $id = $_POST['id'];
   $confirm = $_POST['confirm'];
   if ($confirm == 0) {
      $data = array(
         'status_id' => 7
      );
   }
   if ($confirm == 1) {
      $data = array(
         'status_id' => 8
      );
   }
   if ($confirm == 2) {
      $data = array(
         'status_id' => 6
      );
   }
   update_status_order($data, $id);
   echo json_encode($data);
}
