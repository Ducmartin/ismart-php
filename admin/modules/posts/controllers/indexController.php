<?php

function construct()
{
   load_model('index');
   load('helper', 'validation_form');
   load('helper', 'string');
}
function check_error_postAction()
{
   global $error, $title, $slug, $desc, $page_id, $post_desc;
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
   if (empty($_POST['desc'])) {
      $error['desc'] = "Không được để trống link dẫn đến trang";
   } else {
      $desc = $_POST['desc'];
   }
   if (empty($_POST['post_desc'])) {
      $error['post_desc'] = "Không được để trống mô tả ngắn về nội dung bài viết";
   } else {
      $post_desc = $_POST['post_desc'];
   }
   if (empty($_POST['page_id'])) {
      $error['page_id'] = "vui lòng chọn thư mục muốn thêm vào";
   } else {
      $page_id = $_POST['page_id'];
   }
  
}
function addAction()
{
   global $error, $title, $slug, $desc, $page_id, $post_desc,$post_avatar;
   if (isset($_POST['btn-submit-post'])) {
      check_error_postAction(); 
      if (isset($_FILES['post_avatar']['name'])) {
      $upload_dir = 'uploads/images/';
      ///tạo đường dẫn lên server
      $upload_file = $upload_dir . $_FILES['post_avatar']['name'];
      // xử lý upload đúng file ảnh
      $type_allow = array('png', 'jpg', 'jpeg', 'gif');
      $type = pathinfo($_FILES['post_avatar']['name'], PATHINFO_EXTENSION);
      if (!in_array(strtolower($type), $type_allow)) {
         $error['post_avatar'] = "file upload phải là file'png', 'jpg', 'jpeg', 'gif'";
      } else {
         //#uploadfile có kích thước <20MB=29kk byte
         $file_size = $_FILES['post_avatar']['size'];
         if ($file_size > 29000000) {
            $error['post_avatar'] = 'file upload phải nhỏ hơn 20MB <br>';
         }
         //#kiểm tra trùng tên file upload
         if (file_exists($upload_file)) {
            $file_name = pathinfo($_FILES['post_avatar']['name'], PATHINFO_FILENAME);
            $new_file_name = $file_name . '-Copy.' . $type;
            $new_upload_file = $upload_dir . $new_file_name;
            $k = 1;
            while (file_exists($new_upload_file)) {
               $new_file_name = $file_name . "-Copy({$k})." . $type;
               $k++;
               $new_upload_file = $upload_dir . $new_file_name;
            }
            $upload_file = $new_upload_file;
         }
         if (empty($error['post_avatar'])) {
            if (move_uploaded_file($_FILES['post_avatar']['tmp_name'], $upload_file)) {
               $post_avatar = $upload_file;
            }
         }
      }
   } else {
      $error['post_avatar'] = "Bạn chưa chọn ảnh đại diện";
   }
      if (empty($error)) {
         $peson_create = get_userid_by_username($_SESSION['user_login']);
         $data = array(
            "friendly_url" => $slug,
            "post_title" => $title,
            'post_content' => $desc,
            'person_create' => $peson_create['id'],
            'created_at' => date('Y-m-d H:m:s', time()),
            'status_id' => 2,
            'soft_delete' => 0,
            'page_id' => $page_id,
            'post_desc' => $post_desc,
         );
         add_posts($data);
         redirect('?mod=posts&action=list_post');
      }
   }

   load_view("add");
}
function list_postAction()
{
   global $error, $search;
   $error = array();

   if (isset($_POST['btn_search_post'])) {
      if (empty($_POST['search'])) {
         $error['search'] = "Vui lòng nhập tiêu đề bài viết";
         $list_posts = '';
      } else {
         $search = $_POST['search'];
         $list_posts = get_list_post_by_search_title($search);
      }
   } else {
      $url = $_SERVER['REQUEST_URI'];
      if (strpos($url, 'tat-ca') == true) {
         $list_posts = get_all_posts();
      } else if (strpos($url, "thung-rac")) {
         $list_posts = get_list_posts_softdelete();
      } else if (strpos($url, "da-dang")) {
         $list_posts = get_list_posts_public();
      } else if (strpos($url, "cho-xet-duyet")) {
         $list_posts = get_list_posts_wait_public();
      } else {
         $list_posts = get_list_posts();
      }
   }
   $data = array(
      'list_posts' => $list_posts,
   );
   load_view("list_post", $data);
}
function editAction()
{
   global $error, $title, $slug, $desc, $page_id, $status, $post_desc;
   $id = $_GET['id'];
   if (isset($_POST['btn-edit-post'])) {
      check_error_postAction();
      if (empty($_POST['status'])) {
         $error['status'] = "Vui lòng chọn trạng thái hiển thị bài viết";
      } else {
         $status = $_POST['status'];
      }
      if (empty($error)) {
         $data = array(
            "friendly_url" => $slug,
            "post_title" => $title,
            'post_desc' => $post_desc,
            'post_content' => $desc,
            'updated_at' => date('Y-m-d H:m:s', time()),
            'status_id' => $status,
            'page_id' => $page_id,
         );
         update_post($id, $data);
         redirect('?mod=posts&action=list_post');
      }
   }
   load_view("add", get_post_by_id($id));
}
function softdeleteAction()
{
   $url = $_GET['id'];
   $data = array(
      'soft_delete' => 1,
      'updated_at' => date('Y-m-d H:m:s', time())
   );
   update_post($url, $data);
   redirect("?mod=posts&action=list_post");
}
function deleteAction()
{
   $id = $_GET['id'];
   delete_post($id);
   redirect('?mod=posts&action=list_post');
}
