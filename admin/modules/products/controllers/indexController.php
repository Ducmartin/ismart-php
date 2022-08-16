<?php

function construct()
{
   //    echo "DÙng chung, load đầu tiên";
   load_model('index');
   load("helper", "validation_form");
   load("helper", "string");

}
function check_error_addaction(){
   global $error, $product_name, $product_code, $product_desc, $product_detail, $price, $parent_id, $status,$quatum,$discount;
   $error = array();
   if (empty($_POST['product_name'])) {
      $error['product_name'] = "Vui lòng nhập tên sản phẩm";
   } else {
      $product_name = $_POST['product_name'];
   }
   if (empty($_POST['price'])) {
      $error['price'] = "Vui lòng nhập giá sản phẩm";
   } else {
      $price = $_POST['price'];
   }
   if (empty($_POST['product_desc'])) {
      $error['product_desc'] = "Vui lòng nhập mô tả ngắn về sản phẩm";
   } else {
      $product_desc = $_POST['product_desc'];
   }
   if (empty($_POST['product_detail'])) {
      $error['product_detail'] = "Vui lòng nhập mô tả chi tiết về sản phẩm";
   } else {
      $product_detail = $_POST['product_detail'];
   }
   if (!empty($_POST['discount'])) {
      $discount = $_POST['discount'];
   }else{
      $discount ='Nhập số lượng hàng nếu hết hàng vui lòng nhập 0';
   }
   if (empty($_POST['parent_id'])) {
      $error['parent_id'] = "Vui lòng chọn danh mục sản phẩm";
   } else {
      $parent_id = $_POST['parent_id'];
   }
   if (empty($_POST['status'])) {
      $error['status'] = "Vui lòng chọn trạng thái sản phẩm ";
   } else {
      $status = $_POST['status'];
   }
   if (empty($_POST['quatum'])) {
      $error['quatum'] = "Vui lòng nhập số lượng sản phẩm ";
   } else {
      $quatum = $_POST['quatum'];
   }
}
function addAction()
{
   global $error, $product_name, $product_code, $product_desc, $product_detail, $price, $parent_id, $status,$quatum,$discount ;
   if (isset($_POST['btn-add-product'])) {
      check_error_addaction();
      if (empty($_POST['product_code'])) {
         $error['product_code'] = "Vui lòng nhập mã code sản phẩm";
      } else {
         $product_code = $_POST['product_code'];
         if (check_product($product_code)) {
            $error['product'] = "sản phẩm đã tồn tại trên hệ thống";
         }
      }
      if ($_FILES['product_avatar']['name'] != NULL) {
         $upload_dir = 'uploads/';
         ///tạo đường dẫn lên server
         $upload_file = $upload_dir . $_FILES['product_avatar']['name'];
         // xử lý upload đúng file ảnh
         $type_allow = array('png', 'jpg', 'jpeg', 'gif');
         $type = pathinfo($_FILES['product_avatar']['name'], PATHINFO_EXTENSION);
         if (!in_array(strtolower($type), $type_allow)) {
            $error['product_avatar'] = "file upload phải là file'png', 'jpg', 'jpeg', 'gif'";
         } else {
            //#uploadfile có kích thước <20MB=29kk byte
            $file_size = $_FILES['product_avatar']['size'];
            if ($file_size > 29000000) {
               $error['product_avatar'] = 'file upload phải nhỏ hơn 20MB <br>';
            }
            //#kiểm tra trùng tên file upload
            if (file_exists($upload_file)) {
               $file_name = pathinfo($_FILES['product_avatar']['name'], PATHINFO_FILENAME);
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
            if (empty($error['product_avatar'])) {
               if (move_uploaded_file($_FILES['product_avatar']['tmp_name'], $upload_file)) {
                  $product_avatar = $upload_file;
               }
            }
         }
      } else {
         $error['product_avatar'] = "Bạn chưa chọn ảnh đại diện";
      }
      if ($_FILES['product_file']['name'] != NULL) {
         $upload_dir = 'uploads/files/';
         ///tạo đường dẫn lên server
         $upload_file = array();
         $product_file = array();
         $t = 0;
         foreach ($_FILES['product_file']['name'] as $file) {
            if (!file_exists($upload_dir . $file)) {
               $upload_file[] = $upload_dir . $file;
            }
            // xử lý upload đúng file ảnh
            $t++;
            $type_allow = array('png', 'jpg', 'jpeg', 'gif');
            $type = pathinfo($file, PATHINFO_EXTENSION);
            if (!in_array(strtolower($type), $type_allow)) {
               $error['product_file'] = "file upload phải là file'png', 'jpg', 'jpeg', 'gif'";
            } else {
               if (file_exists($upload_dir . $file)) {
                  $file_name = pathinfo($file, PATHINFO_FILENAME);
                  $new_file_name = $file_name . '-Copy.' . $type;
                  $new_upload_file = $upload_dir . $new_file_name;
                  $k = 1;
                  while (file_exists($new_upload_file)) {
                     $new_file_name = $file_name . "-Copy({$k})." . $type;
                     $k++;
                     $new_upload_file = $upload_dir . $new_file_name;
                  }
                  $upload_file[] = $new_upload_file;
               }
            }
         }
         $tmp_name = array();
         foreach ($_FILES['product_file']['tmp_name'] as $item) {

            $tmp_name[] = $item;
         }
         if (empty($error['product_file'])) {
            for ($i = 0; $i < $t; $i++) {
               if (move_uploaded_file($tmp_name[$i], $upload_file[$i])) {
                  $product_file []=  $upload_file[$i];
               }
            }
         }
      } else {
         $error['product_file'] = "Bạn chưa chọn thư viện ảnh cho sản phẩm";
      }
      if (empty($error)) { 
         $img="";
          foreach($product_file as $item){
            $img= $img.'+'.$item;
          } 
         
         $url=create_slug($product_name);
         $data = array(
            'product_name' => $product_name,
            'product_code' => $product_code,
            'price' => $price,
            'product_desc' => $product_desc,
            'product_detail' => $product_detail,
            'parent_id' => $parent_id,
            'status_id' => $status,
            'discount'=>$discount,
            'friendly_url'=>$url,
            'quatum'=>$quatum,
            'avatar'=>$product_avatar,
            'img_file'=>$img,
            'soft_delete'=>1,
            'person_create'=>get_userid_by_username($_SESSION['user_login']),
            'created_at'=>date('Y-m-d H:m:s',time())
         );
         add_product($data);
         redirect("?mod=products&action=list_product");
      }
   }
   load_view("add");
}
function list_productAction()
{  
   $url = $_SERVER['REQUEST_URI'];
   if(empty($_GET['page'])||$_GET['page']==0){
      $number=1;
   }else {
      $number=$_GET['page']+1;
   }
   if (strpos($url, 'tat-ca') == true) {
      $list_product = paginate_get_all_products($number);
   } else if (strpos($url, "thung-rac")) {
      $list_product = paginate_get_list_product_softdelete($number);
   } else if (strpos($url, "da-dang")) {
      $list_product = paginate_get_list_products_public($number);
   } else if (strpos($url, "cho-xet-duyet")) {
      $list_product = paginate_get_list_products_wait_public($number);
   } else {
     $list_product = get_list_product($number);
   }
    $data['list_product']=$list_product;
   load_view("list_product",$data); 
}
function list_catAction()
{
   if(empty($_GET['page'])||$_GET['page']==0){
      $number=1;
   }else {
      $number=$_GET['page']+1;
   }
   $data=paginate_list_cat_child($number);
   load_view("list_cat",$data);
}
function manageAction()
{
   global $error,$search; 
   if (isset($_POST['sm_action'])) {
      $error=array();
      if (empty($_POST['actions'])) {
          $error['actions'] = "Vui lòng nhập mã code hoặc tên sản phẩm";
      } else {
         $search = $_POST['actions']; 
         redirect("?mod=products&action=manage&act={$search}");
        
      }
   }else{
      $search=$_GET['act'];
      if($search==1){
         $data['list_product']=manager_status_product_by_id($search);
         }else if($search==2){
         $data['list_product']=manager_status_product_by_id($search);
         }else if($search==3){
         $data['list_product']=manager_softdelete_product_by_id(2);
      }
        load_view("list_product",$data);
   }
}
function editAction()
{
    global $error, $product_name, $product_code, $product_desc, $product_detail, $price, $parent_id, $status,$quatum,$discount ;
   $url = $_SERVER['REQUEST_URI'];
   $data=get_product_by_id(preg_replace('/[^0-9]/', '', $url));
    if (isset($_POST['btn-update-product'])) {
      check_error_addaction();
      if (empty($_POST['product_code'])) {
         $error['product_code'] = "Vui lòng nhập mã code sản phẩm";
      } else {
         $product_code = $_POST['product_code'];
         if(check_product_by_id( $product_code,$data['id'])==true){
            $error['product_code'] = "Đã có sản phẩm cùng mã code";
         }
      }
      if ($_FILES['product_avatar']['name'] != NULL) {
         $upload_dir = 'uploads/';
        ///tạo đường dẫn lên server
         $upload_file = $upload_dir . $_FILES['product_avatar']['name'];
         // xử lý upload đúng file ảnh
         $type_allow = array('png', 'jpg', 'jpeg', 'gif');
         $type = pathinfo($_FILES['product_avatar']['name'], PATHINFO_EXTENSION);
         if (!in_array(strtolower($type), $type_allow)) {
            $error['product_avatar'] = "file upload phải là file'png', 'jpg', 'jpeg', 'gif'";
         } else {
            //#uploadfile có kích thước <20MB=29kk byte
            $file_size = $_FILES['product_avatar']['size'];
            if ($file_size > 29000000) {
               $error['product_avatar'] = 'file upload phải nhỏ hơn 20MB <br>';
            }
            //#kiểm tra trùng tên file upload
            if (file_exists($upload_file)) {
               $file_name = pathinfo($_FILES['product_avatar']['name'], PATHINFO_FILENAME);
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
            if (empty($error['product_avatar'])) {
               if (move_uploaded_file($_FILES['product_avatar']['tmp_name'], $upload_file)) {
                  $product_avatar = $upload_file;
               }
            }
         }
      }else{
         $product_avatar=$data['avatar'];
      }
      if ($_FILES['product_file']['name']!= NULL ) {
        $k=$_FILES['product_file']['name'];
        if( $k[0]!=Null){
           $upload_dir = 'uploads/files/';
         ///tạo đường dẫn lên server
         $upload_file = array();
         $product_file = array();
         $t = 0;
         foreach ($_FILES['product_file']['name'] as $file) {
            if (!file_exists($upload_dir . $file)) {
               $upload_file[] = $upload_dir . $file;
            }
            // xử lý upload đúng file ảnh
            $t++;
            $type_allow = array('png', 'jpg', 'jpeg', 'gif');
            $type = pathinfo($file, PATHINFO_EXTENSION);
            if (!in_array(strtolower($type), $type_allow)) {
               $error['product_file'] = "file upload phải là file'png', 'jpg', 'jpeg', 'gif'";
            } else {
               if (file_exists($upload_dir . $file)) {
                  $file_name = pathinfo($file, PATHINFO_FILENAME);
                  $new_file_name = $file_name . '-Copy.' . $type;
                  $new_upload_file = $upload_dir . $new_file_name;
                  $k = 1;
                  while (file_exists($new_upload_file)) {
                     $new_file_name = $file_name . "-Copy({$k})." . $type;
                     $k++;
                     $new_upload_file = $upload_dir . $new_file_name;
                  }
                  $upload_file[] = $new_upload_file;
               }
            }
         }
         $tmp_name = array();
         foreach ($_FILES['product_file']['tmp_name'] as $item) {

            $tmp_name[] = $item;
         }
         if (empty($error['product_file'])) {
            for ($i = 0; $i < $t; $i++) {
               if (move_uploaded_file($tmp_name[$i], $upload_file[$i])) {
                  $product_file []=  $upload_file[$i];
               }
            }
         }
        }
       
      }else{
         $product_file="";
      }
      if (empty($error)) { 
           $img=$data['img_file']; 
         foreach($product_file as $item){
            $img= $img.'+'.$item;
          } 
         $url=create_slug($product_name);
         $k = array(
            'product_name' => $product_name,
            'product_code' => $product_code,
            'price' => $price,
            'product_desc' => $product_desc,
            'product_detail' => $product_detail,
            'parent_id' => $parent_id,
            'status_id' => $status,
            'discount'=>$discount,
            'friendly_url'=>$url,
            'quatum'=>$quatum,
            'avatar'=>$product_avatar,
            'img_file'=>$img,
            'person_create'=>get_userid_by_username($_SESSION['user_login']),
            'updated_at'=>date('Y-m-d H:m:s',time())
         );
         update_product($k,$data['id']);
         redirect("?mod=products&action=list_product");
      }
   }
   load_view('add',$data); 
}
function softdeleteAction()
{
   $url = $_GET['id'];
   $product=get_product_by_id($url);
   $data=array(
      'soft_delete'=>2,
      'updated_at'=>date('Y-m-d H:m:s',time())
   );
   update_product($data,$product['id']);
   redirect("?mod=products&action=list_product");
}
function deleteAction()
{
   $url = $_GET['id'];
   delete_product($url);
   redirect("?mod=products&action=list_product");
}

function add_catAction()
{
   global $error,$child_cat,$parent_cat;
   if (isset($_POST['btn-submit-add-cat'])) {
      $error = array();
      if (empty($_POST['child_cat'])) {
         $error['parent_cat'] = "vui lòng điền danh mục muốn thêm vào";
      } else {
         $child_cat =ucfirst(strtolower($_POST['child_cat'])) ;
      }
      if (empty($_POST['parent_cat'])) {
         $error['parent_cat'] = "vui lòng chọn danh mục muốn thêm vào";
      } else {
         $parent_cat=ucfirst(strtolower($_POST['parent_cat']))  ; 
      }
      if(check_cat_post($parent_cat,$child_cat)){
         $error['list_cat_post'] = "Đã tồn tại danh mục cha và thư mục con trên ";  
      }
      if($parent_cat==$child_cat){
         $error['cat']="Danh mục cha bị trùng với danh mục con ";
      } 
      if(!empty(check_error_cat($parent_cat,$child_cat))){
            $error['parent_cat'] = "Danh mục con và danh mục cha này đã tồn tại";
         }
      if (empty($error)) {
      //  show_array(check_error_cat($parent_cat,$child_cat));
         $cat=check_cat_parent($parent_cat,$child_cat);
          if(empty($cat)){
            $url=create_slug($parent_cat).'/'.create_slug($child_cat);
            $data = array(
            'parent_cat' =>$parent_cat,
            "child_cat" => $child_cat,
            'created_at'=>date('Y-m-d H:m:s',time()),
            'friendly_url'=>   $url
            );
         }else{
            $url=$cat['friendly_url'].'/'.create_slug($child_cat);
            $data = array(
               'parent_cat' =>$parent_cat ,
               "child_cat" =>$child_cat,
               'created_at'=>date('Y-m-d H:m:s',time()),
               'friendly_url'=> $url
               );
         } 
         add_cat($data);
         redirect('?mod=products&action=list_cat');
      }
   }
   load_view("addcat");
}
function searchAction(){
   global $error,$search; 
   if(empty($_GET['query'])) {
      if (isset($_POST['btn-search-product'])) {
      $error=array();
      if (empty($_POST['search'])) {
          $error['search'] = "Vui lòng nhập mã code hoặc tên sản phẩm";
      } else {
         $search = $_POST['search']; 
      $items=explode(' ',$search);
      $str="+";
      $query="";
      foreach($items as $item){
         $query= $query.$str.$item;
      }
      $slug=substr($query,1);
      redirect("?mod=products&action=search&query={$slug}");
      }
   } 
    list_productAction();
  }else{
   $data['list_product']=result_search($_GET['query']);
 load_view('list_product',$data);
  }
}
