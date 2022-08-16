<?php
function add_posts($data)
{
    return db_insert('posts', $data);
}
function get_list_posts()
{
    $list_posts = db_fetch_array("SELECT * FROM `posts`WHERE `soft_delete`=0");
    return     $list_posts;
}
function get_all_posts()
{
    return db_fetch_array("SELECT * FROM `posts`");
}
function get_list_posts_public()
{
    $list_posts = db_fetch_array("SELECT * FROM `posts`WHERE `status_id`=1");
    return     $list_posts;
}
function get_list_posts_wait_public()
{
    $list_posts = db_fetch_array("SELECT * FROM `posts`WHERE `status_id`=2");
    return     $list_posts;
}
function get_list_posts_softdelete()
{
    $list_posts = db_fetch_array("SELECT * FROM `posts`WHERE `soft_delete`=1");
    return     $list_posts;
}
function get_userid_by_username($username) {
    $item = db_fetch_row("SELECT* FROM `managers` WHERE `username` = '{$username}'");
    return $item;
}
function get_page(){
    $item =db_fetch_array("SELECT * FROM `pages` ");
     return $item;
}
function delete_post($id){
     return db_delete('posts',"`id`={$id}");
}
function add_cat($data)
{
    return db_insert('tbl_cat_post', $data);
}
function get_infouser_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `managers` WHERE `id` = {$id}");
    return $item['username'];
}
function get_status($status) {
    $item = db_fetch_row("SELECT`status` FROM `status` WHERE `id` = {$status}");
    echo $item['status'];
}
function get_page_title($id) {
    $item = db_fetch_row("SELECT* FROM `pages` WHERE `id` = {$id}");
    echo $item['page_title'];
}
function get_post_by_id($id) {
    $item = db_fetch_row("SELECT* FROM `posts` WHERE `id` = {$id}");
    return $item;
}
function list_status(){
    return db_fetch_array("SELECT* FROM`status`WHERE `status`='Chờ duyệt'OR`status`='Đã duyệt' ");
}
function get_list_post_by_search_title($search){
    return db_fetch_array("SELECT* FROM`posts`WHERE `post_title` LIKE '%$search%' ");
}
function update_post($id,$data){
  return  db_update('posts',$data,"`id`='{$id}'");
}
