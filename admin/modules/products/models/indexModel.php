<?php

function check_product($product_code) {
    $result = db_num_rows("SELECT * FROM `products`WHERE`product_code`='$product_code'");
    if($result==1){
        return true;
    }
}
function check_product_by_id($product_code,$id) {
    $result = db_num_rows("SELECT * FROM `products`WHERE`product_code`='$product_code'AND`id`!={$id}");
    if($result==1){
        return true;
    }
}
function add_product($data) {
    return db_insert('products',$data);
}
function get_list_product($number){
    if($number==1){
        $number=$number*10;
        return db_fetch_array("SELECT * FROM `products`WHERE `soft_delete`= 1 limit 0,$number ");
    }else if($number>1){
        $t=($number-1)*10;
        return db_fetch_array("SELECT * FROM`products`WHERE `soft_delete`= 1 limit $t,10");
    }
}
function paginate_get_all_products($number){
    if($number==1){
        $number=$number*10;
        return db_fetch_array("SELECT * FROM `products` limit 0,$number ");
    }else if($number>1){
        $t=($number-1)*10;
        return db_fetch_array("SELECT * FROM`products` limit $t,10");
    }
}
function paginate_get_list_product_softdelete($number){
    if($number==1){
        $number=$number*10;
        return db_fetch_array("SELECT * FROM `products`WHERE `soft_delete`= 2 limit 0,$number ");
    }else if($number>1){
        $t=($number-1)*10;
        return db_fetch_array("SELECT * FROM`products`WHERE `soft_delete`= 2 limit $t,10");
    }
}
function paginate_get_list_products_public($number){
    if($number==1){
        $number=$number*10;
        return db_fetch_array("SELECT * FROM `products`WHERE `status_id`=1 limit 0,$number ");
    }else if($number>1){
        $t=($number-1)*10;
        return db_fetch_array("SELECT * FROM`products`WHERE `status_id`=1 limit $t,10");
    }
}
function paginate_get_list_products_wait_public($number){
    if($number==1){
        $number=$number*10;
        return db_fetch_array("SELECT * FROM `products`WHERE `status_id`=2 limit 0,$number ");
    }else if($number>1){
        $t=($number-1)*10;
        return db_fetch_array("SELECT * FROM`products`WHERE `status_id`=2 limit $t,10");
    }
}
function get_all_products()
{
    return db_fetch_array("SELECT * FROM `products`");
}
function get_list_product_softdelete()
{
  return      db_fetch_array("SELECT * FROM `products`WHERE `soft_delete`=2");
}
function get_list_products_public()
{
       return    db_fetch_array("SELECT * FROM `products`WHERE `status_id`=1");
   
}
function get_list_products_wait_public()
{
   return   db_fetch_array("SELECT * FROM `products`WHERE `status_id`=2");
        
}
function get_list_cat(){
    return db_fetch_array("SELECT*FROM`cat_products`");
}
function check_cat_post($parent_cat, $child_cat)
{
    $num = db_num_rows("SELECT*FROM`cat_products`WHERE `parent_cat`='{$parent_cat}'AND`child_cat`='{$child_cat}'");
    if ($num == 1) {
        return true;
    }
}
function add_cat_parent($data_parent,$parent_cat)
{
    $t=db_num_rows("SELECT* FROM`cat_products`WHERE `parent_cat`='{$parent_cat}'");
    if($t<1){
          return db_insert('cat_products', $data_parent);
    }
}
function list_status(){
    return db_fetch_array("SELECT* FROM`status`WHERE `status`='Chờ duyệt'OR`status`='Đã duyệt' ");
}
function list_cat_child(){
    return db_fetch_array("SELECT* FROM`cat_products`");
}
function count_list_cat_child(){
    $data = db_fetch_array("SELECT* FROM`cat_products`");
       $k=0;
    foreach ($data as $item) {
        if (count(explode('/', $item['friendly_url'])) > 2||check_child_cat_have_parent($item['child_cat'])==false) {
            $k=$k+1;
        } 
    }
    return $k;
}
function paginate_list_cat_child($number){
    if($number==1){
        $number=$number*10;
        return db_fetch_array("SELECT * FROM `cat_products`limit 0,$number ");
    }else if($number>1){
        $t=($number-1)*10;
        return db_fetch_array("SELECT * FROM`cat_products` limit $t,10");
    }
}
function check_child_cat_have_parent($child_cat){
    if(count(db_fetch_array("SELECT* FROM`cat_products`WHERE `parent_cat`='{$child_cat}'"))==0){
        return false;
    }
    return true;
}
function get_parent_cat($t){
    $item= db_fetch_row("SELECT* FROM`cat_products`WHERE `child_cat`='{$t}'");
    return $item['parent_cat'];
}
function count_product_in_cat($id){
  return   count(db_fetch_array("SELECT* FROM`products`WHERE `parent_id`='{$id}'"));
}
function add_cat($data)
{
    return db_insert('cat_products', $data);
}
function check_cat_parent($cat,$child){
    $item=db_fetch_row("SELECT* FROM`cat_products`WHERE `child_cat`='{$cat}'AND `parent_cat`!='{$child}'");
   return $item;
}
function check_error_cat($cat,$child){
    $item=db_fetch_row("SELECT* FROM`cat_products`WHERE `child_cat`='{$cat}'AND `parent_cat`='{$child}'");
   return  $item;
}
function get_status($status){
    $item=db_fetch_row("SELECT* FROM`cat_products`WHERE `id`='{$status}'");
   return  $item['id'];
}
function get_userid_by_username($username) {
    $item = db_fetch_row("SELECT* FROM `managers` WHERE `username` = '{$username}'");
    return $item['id'];
}
function get_infouser_by_id($id) {
    $item = db_fetch_row("SELECT* FROM `managers` WHERE `id` = '{$id}'");
    return $item['username'];
}
function get_cat_product_by_id($id){
    $item = db_fetch_row("SELECT* FROM `cat_products` WHERE `id` = '{$id}'");
    return $item;
}
function get_product_by_id($id){
    $item = db_fetch_row("SELECT* FROM `products` WHERE `id` = '{$id}'");
    return $item;
}
function update_product($data,$id){
    db_update('products',$data,"`id`=$id");
}
function result_search($query){
    return db_fetch_array("SELECT*FROM`products`WHERE `product_code`LIKE'%$query%' OR `product_name`='%$query%'");
}
function manager_status_product_by_id($id){
    return db_fetch_array("SELECT*FROM`products`WHERE `status_id`={$id} ");
}
function manager_softdelete_product_by_id($id){
    return db_fetch_array("SELECT*FROM`products`WHERE `soft_delete`='{$id}' ");
}
function delete_product($id){
    return db_delete('products',"`id`='{$id}'");
}
