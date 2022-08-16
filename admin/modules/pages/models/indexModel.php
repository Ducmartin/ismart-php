<?php

function get_list_pages() {
   $list_pages = db_fetch_array("SELECT * FROM `pages`WHERE `soft_delete`=0");
    return   $list_pages;
}
function get_all_pages()
{
    return db_fetch_array("SELECT * FROM `pages`");
}
function delete_page($id){
    return db_delete('pages',"`id`= {$id}");
}
function get_list_pages_public()
{
    $list_pages = db_fetch_array("SELECT * FROM `pages`WHERE `status_id`=1");
    return     $list_pages;
}
function get_list_pages_wait_public()
{
    $list_pages = db_fetch_array("SELECT * FROM `pages`WHERE `status_id`=2");
    return     $list_pages;
}
function get_list_pages_softdelete()
{
    $list_posts = db_fetch_array("SELECT * FROM `pages`WHERE `soft_delete`=1");
    return     $list_posts;
}
function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `managers` WHERE `id` = {$id}");
    return $item;
}
function get_infouser_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `managers` WHERE `id` = {$id}");
    return $item['username'];
}
function add_pages($data){
    return db_insert('pages',$data);
}
function update_page($data,$id){
    return db_update('pages',$data,"`id`={$id}");
}
function get_userid_by_username($username) {
    $item = db_fetch_row("SELECT* FROM `managers` WHERE `username` = '{$username}'");
    return $item;
}
function get_status($status) {
    $item = db_fetch_row("SELECT`status` FROM `status` WHERE `id` = {$status}");
    echo $item['status'];
}
function check_page($page){
    $data=db_fetch_row("SELECT* FROM `pages` WHERE `page_title` = '{$page}'");
    if(!empty($data)){
        return true;
    }else{
        return false;
    }
}
function get_list_page_by_search_title($search){
    return db_fetch_array("SELECT* FROM`pages`WHERE `page_title` LIKE '%$search%' ");
}
function get_page_by_id($id){
    $item =db_fetch_row("SELECT * FROM `pages`WHERE `id`={$id} ");
     return $item;
}
function list_status(){
    return db_fetch_array("SELECT* FROM`status`WHERE `status`='Chờ duyệt'OR`status`='Đã duyệt' ");
}
function check_slug_page($friendly_url){
    $item =db_fetch_row("SELECT * FROM `pages`WHERE `friendly_url`='{$friendly_url}' ");
  if(!empty( $item)) return true;
}