<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('helper', 'validation_form');
    load('helper', 'string');
}

function addAction()
{
    global $error, $name, $link, $location, $slider, $status;
    $error = array();
    if (isset($_POST['btn_add_slider'])) {
        if (empty($_POST['name'])) {
            $error['name'] = "Vui lòng nhập tên slider";
        } else {
            $name = $_POST['name'];
        }
        if (empty($_POST['link'])) {
            $error['link'] = "Vui lòng nhập tên link liên kết";
        } else {
            $link = $_POST['link'];
        }
        if (empty($_POST['location'])) {
            $error['location'] = "Vui lòng nhập thứ tự slider";
        } else {
            $location = $_POST['location'];
        }
        if (empty($_POST['status'])) {
            $error['status'] = "Vui lòng chọn trạng thái";
        } else {
           
            $status=$_POST['status'];
        }
        if ($_FILES['slider']['name'] != NULL) {
            $upload_dir = 'uploads/slider/';
            ///tạo đường dẫn lên server
            $upload_file = $upload_dir . $_FILES['slider']['name'];
            // xử lý upload đúng file ảnh
            $type_allow = array('png', 'jpg', 'jpeg', 'gif');
            $type = pathinfo($_FILES['slider']['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($type), $type_allow)) {
                $error['slider'] = "file upload phải là file'png', 'jpg', 'jpeg', 'gif'";
            } else {
                //#uploadfile có kích thước <20MB=29kk byte
                $file_size = $_FILES['slider']['size'];
                if ($file_size > 29000000) {
                    $error['slider'] = 'file upload phải nhỏ hơn 20MB <br>';
                }
                //#kiểm tra trùng tên file upload
                if (file_exists($upload_file)) {
                    $file_name = pathinfo($_FILES['slider']['name'], PATHINFO_FILENAME);
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
                if (empty($error['slider'])) {
                    if (move_uploaded_file($_FILES['slider']['tmp_name'], $upload_file)) {
                        $slider = $upload_file;
                    }
                }
            }
        } else {
            $error['slider'] = "Bạn chưa chọn ảnh slider";
        }
        if (empty($error)) {
            if (check_location($location)==true) {
               update_slider($location) ;
            }
            $peson_create=get_userid_by_username($_SESSION['user_login']);
            $data = array(
                'name' => $name,
                'link' => $link,
                'location' => $location,
                'status_id' => $status,
                'img' => $slider,
                'person_create' => $peson_create['id'],
                'created_at'=>date('Y-m-d H:m:s',time()),
            );
            add_slider($data);
            redirect("?mod=sliders&action=list_slider");
        }
    }
    load_view("add");
}
function list_sliderAction()
{
    $list_slider=get_list_slider();
    $data['list_slider']=$list_slider;
    load_view("list_slider",$data);
}
