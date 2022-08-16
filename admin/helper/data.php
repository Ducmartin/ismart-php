<?php

function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}
function check_user_login(){
    if(isset($_SESSION['user_login'])){
        return true;
    }
    return false;
}

