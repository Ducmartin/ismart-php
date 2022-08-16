<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction()
{
    if (isset($_SESSION['is_login'])) {
        unset($_SESSION['is_login']);
        unset($_SESSION['user_login']);
    }
}
