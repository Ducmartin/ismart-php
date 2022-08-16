<?php

function check_location($location)
{
    $result = db_fetch_array("SELECT * FROM `sliders`WHERE`location`='$location'");
    if (count($result) > 0) {
        return true;
    }
}
function  add_slider($data)
{
    return db_insert('sliders', $data);
}
function update_slider($location)
{
    $item = db_fetch_array("SELECT * FROM `sliders`");
    foreach ($item as $t) {
        if ($t['location'] >= $location) {
            $data = array(
                'location' => $t['location'] + 1
            );
            $id=$t['id'];
            return db_update('sliders', $data,"`id` = $id");
        }
    }
}
function get_list_slider()
{
    $item = db_fetch_array("SELECT * FROM `sliders`ORDER BY `location` ASC");
    return $item;
}
function list_status()
{
    $item = db_fetch_array("SELECT * FROM `status`");
    return $item;
}
function get_status($status)
{
    $item = db_fetch_row("SELECT`status` FROM `status` WHERE `id` = {$status}");
    echo $item['status'];
}
function get_userid_by_username($username)
{
    $item = db_fetch_row("SELECT* FROM `managers` WHERE `username` = '{$username}'");
    return $item;
}
function get_infouser_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `managers` WHERE `id` = {$id}");
    return $item['username'];
}
