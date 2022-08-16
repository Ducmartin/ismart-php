<?php
 function url($url = "")
 {
     return "http://localhost/backend-PHP/project/ismart.com/admin/" . $url;
 }
 function url_home($url = "")
 {
     return "http://localhost/backend-PHP/project/ismart.com/" . $url;
 }
 function get_name_product($name)
 {
     $str = "";
     foreach (explode('-', $name) as $key => $val) {
         if ($key < 2) {
             if($key==0){
                  $str =$val.'-';
             }
             if($key==1){
                 $str=$str.$val;
             }
         }
     }
     return   $str;
 }
