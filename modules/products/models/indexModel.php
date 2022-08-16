<?php
function list_cat_1()
{
    $data = db_fetch_array("SELECT*FROM`cat_products`");
    $cat_1 = array();
    foreach ($data as $item) {
        if (count(explode('/', $item['friendly_url'])) == 2) {
            $cat_1[] = $item['parent_cat'];
        }
    }
    return array_unique($cat_1);
}
function get_title($cats, $slug)
{
    foreach ($cats as $item) {
        if (create_slug($item) == $slug) {
            return $item;
        }
    }
}
function list_cat_2($slug)
{
    $data = db_fetch_array("SELECT*FROM`cat_products`WHERE `friendly_url`LIKE '%$slug%'");
    $cat_1 = array();
    foreach ($data as $item) {
        if (count(explode('/', $item['friendly_url'])) == 2) {
            $cat_1[] = $item['child_cat'];
        }
    }
    return array_unique($cat_1);
}
function list_cat_3($slug)
{
    $data = db_fetch_array("SELECT*FROM`cat_products`WHERE `friendly_url`LIKE '%$slug%'");
    $cat_1 = array();
    foreach ($data as $item) {
        if (count(explode('/', $item['friendly_url'])) == 3) {
            $cat_1[] = $item['child_cat'];
        }
    }
    return array_unique($cat_1);
}
function create_slug($string)
{
    $search = array(
        '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
        '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
        '#(ì|í|ị|ỉ|ĩ)#',
        '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
        '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
        '#(ỳ|ý|ỵ|ỷ|ỹ)#',
        '#(đ)#',
        '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
        '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
        '#(Ì|Í|Ị|Ỉ|Ĩ)#',
        '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
        '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
        '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
        '#(Đ)#',
        "/[^a-zA-Z0-9\-\_]/",
    );
    $replace = array(
        'a',
        'e',
        'i',
        'o',
        'u',
        'y',
        'd',
        'A',
        'E',
        'I',
        'O',
        'U',
        'Y',
        'D',
        '-',
    );
    $string = preg_replace($search, $replace, $string);
    $string = preg_replace('/(-)+/', '-', $string);
    $string = strtolower($string);
    return $string;
}
function get_product_same_category($category)
{
    return db_fetch_array("SELECT*FROM`products`WHERE`parent_id`='{$category}'");
}
function get_detail($url)
{
    return db_fetch_row("SELECT*FROM`products`WHERE`friendly_url`='{$url}'");
}
function get_status_product($url)
{
    return db_fetch_row("SELECT*FROM`products`WHERE`friendly_url`='{$url}' limit 0,10");
}
function get_product_sold()
{
    return db_fetch_array("SELECT*FROM`products` order by `sold` desc limit 0,20");
}
function get_cat_id_1($slug,$page)
{
    $data = db_fetch_array("SELECT*FROM`cat_products`WHERE`friendly_url`LIKE '%$slug%'");
    $str = "`parent_id`=";
    $query = "";
    $i = 0;
    $j = count($data);
    if ($j > 0) {
        foreach ($data as $item) {
            $i++;
            if ($i > 0 && $i < $j) {
                $query = $query . $str . $item['id'] . "||";
            } else if ($i == count($data)) {
                $query = $query . $str . $item['id'];
            }
        }
    }
    $start=($page-1)*40;
    $item = db_fetch_array("SELECT*FROM`products`WHERE $query limit $start,40 " );
    return $item;
}
function count_cat_id_1($slug)
{
    $data = db_fetch_array("SELECT*FROM`cat_products`WHERE`friendly_url`LIKE '%$slug%'");
    $str = "`parent_id`=";
    $query = "";
    $i = 0;
    $j = count($data);
    if ($j > 0) {
        foreach ($data as $item) {
            $i++;
            if ($i > 0 && $i < $j) {
                $query = $query . $str . $item['id'] . "||";
            } else if ($i == count($data)) {
                $query = $query . $str . $item['id'];
            }
        }
    }
    $item = db_fetch_array("SELECT*FROM`products`WHERE $query" );
    return count($item);
}
