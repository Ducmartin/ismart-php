<?php

use Aws\S3\Enum\Status;

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('helper', 'validation_form');
    load('helper', 'string');
}
function check_error_pageAction()
{
    global $error, $title, $slug;
    $error = array();
    if (empty($_POST['title'])) {
        $error['title'] = "Không được để trống tiêu đề trang";
    } else {
        if (check_page($_POST['title'])) {
            $error['title'] = "Trang cùng tiêu đề đã tồn tại";
        } else {
            $title = $_POST['title'];
        }
    }
    if (empty($_POST['slug'])) {
        $error['slug'] = "Không được để trống link dẫn đến trang";
    } else {
        if (!is_slug($_POST['slug'])) {
            $error['slug'] = "link phải chứa ít nhất 6 kí tự.ví dụ tin-tuc ";
        } else if(check_slug_page($_POST['slug'])==true) {
            $error['slug'] = "Slug đã tồn tại.Vui lòng chọn slug khác ";
        } else {
            $slug = $_POST['slug'];
        }
    }
}
function detailAction()
{
    $id = $_GET['id'];
    if ($id == 1) {
        load_view("index");
    } elseif ($id == 2) {
        load_view("contact");
    }
}
function addAction()
{
    global $error, $title, $slug;
    if (isset($_POST['btn-submit'])) {
        check_error_pageAction();
        if (empty($error)) {

            $peson_create = get_userid_by_username($_SESSION['user_login']);
            $data = array(
                "friendly_url" => $slug,
                "page_title" => $title,
                'person_create' => $peson_create['id'],
                'created_at' => date("Y-m-d H:i:s", time()),
                'status_id' => 2,
                'soft_delete' => 0
            );
            add_pages($data);
            redirect('?mod=pages&action=list_page');
        }
    }
    load_view("add");
}
function list_pageAction()
{
    global $error, $search;
    $error = array();

    if (isset($_POST['btn_search_pages'])) {
        if (empty($_POST['search'])) {
            $error['search'] = "Vui lòng nhập tiêu đề bài viết";
            $list_pages = '';
        } else {
            $search = $_POST['search'];
            $list_pages = get_list_page_by_search_title($search);
        }
    } else {
        $url = $_SERVER['REQUEST_URI'];
        if (strpos($url, 'tat-ca') == true) {
            $list_pages = get_all_pages();
        } else if (strpos($url, "thung-rac")) {
            $list_pages = get_list_pages_softdelete();
        } else if (strpos($url, "da-dang")) {
            $list_pages = get_list_pages_public();
        } else if (strpos($url, "cho-xet-duyet")) {
            $list_pages = get_list_pages_wait_public();
        } else {
            $list_pages = get_list_pages();
        }
    }
    $data = array(
        'list_pages' => $list_pages,
    );
    load_view("list_page", $data);
}
function editAction()
{
    global $error, $title, $slug, $status;
    $id = $_GET['id'];
    if (isset($_POST['btn-edit-page'])) {
        $error = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tiêu đề trang";
        } else {
            $title = $_POST['title'];
        }
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống link dẫn đến trang";
        } else {
            if (!is_slug($_POST['slug'])) {
                $error['slug'] = "link phải chứa ít nhất 6 kí tự ";
            } else {
                $slug = $_POST['slug'];
            }
        }
        if (empty($_POST['status'])) {
            $error['status'] = "Vui lòng chọn trạng thái hiển thị";
        } else {
            $status = $_POST['status'];
        }
        if (empty($error)) {
            $data = array(
                "friendly_url" => $slug,
                "page_title" => $title,
                'updated_at' => date("Y-m-d H:i:s", time()),
                'status_id' => $status,
            );
            update_page($data, $id);
            redirect('?mod=pages&action=list_page');
        }
    }
    $page = get_page_by_id($id);
    load_view('add', $page);
}
function softdeleteAction()
{
    $id = $_GET['id'];
    $data = array(
        'updated_at' => date("Y-m-d H:i:s", time()),
        'soft_delete' => 1,
    );
    update_page($data, $id);
    redirect('?mod=pages&action=list_page');
}
function deleteAction()
{
    $id = $_GET['id'];
    delete_page($id);
    redirect('?mod=pages&action=list_page');
}
