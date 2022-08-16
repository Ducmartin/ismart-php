<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    // load_model('index');
}

function indexAction() {
    if(check_user_login()==true){
            load_view("index");
    }else{
        redirect("?mod=users&action=login");
    }

}
