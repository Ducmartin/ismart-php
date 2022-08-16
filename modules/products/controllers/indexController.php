<?php

function construct()
{
   load_model('index');
}
function showAction()
{
   $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   $page = explode('=', $actual_link);
   if (count($page) == 1) {
      $data = str_replace(url_home(), '', $actual_link);
      $product = get_cat_id_1(substr($data, 0, strlen($data) - 1), 1);
   }
   if (count($page) == 2) {
      $data = str_replace(url_home(), '', $actual_link);
      $product = get_cat_id_1(substr($data, 0, strlen($data) - 8), $page[1]);
   }
   load_view("index", $product);
}
function detailAction()
{
   $data = explode('/', $_SERVER['REQUEST_URI']);
   $product = get_detail($data[count($data) - 1]);
   load_view("detail", $product);
}
