<?php
function is_username($username)
{
    $parttern = "/^[A-Za-z0-9_\.]{6,32}$/";
    if (preg_match($parttern, $username))
        return true;
    else return false;
}
function is_fullname($fullname)
{
    $parttern = "/^[\w\W]{10,32}$/";
    if (preg_match($parttern, $fullname))
        return true;
    else return false;
}
function is_password($password)
{
    $parttern = "/^([\w_\.!@#$%^&*()]+){6,31}$/";
    if (preg_match($parttern, $password))
        return true;
    else return false;
}
function is_email($password)
{
    $parttern =
        "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (preg_match($parttern, $password)) return true;
    else return false;
}
function set_value($label_field)
{
    global $$label_field;
    if (isset($$label_field))
        return $$label_field;
}
function form_error($label_field)
{
    global $error;
    if (isset($error[$label_field])) {
        echo "<span style=\"color:
        red;\">{$error[$label_field]}</span><br/>";
    }
}