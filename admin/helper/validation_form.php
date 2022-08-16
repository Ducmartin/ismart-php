<?php
function is_username($username)
{
    $parttern = "/^[\w\W]{6,32}$/";
    if (preg_match($parttern, $username))
        return true;
    else return false;
}
function is_slug($slug)
{
    $parttern = "/^[\w\W]{6,150}$/";
    if (preg_match($parttern, $slug))
        return true;
    else return false;
}
function is_fullname($fullname)
{
    $parttern = "/^[\w\W]{10,62}$/";
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
function is_phone_number($phone_number)
{
    $parttern =
        "/^[0]{1}[0-9_.]{9,12}$/";
    if (preg_match($parttern, $phone_number)) return true;
    else return false;
}
function is_address($address)
{
    $parttern =
        "/^[0-9_\w\W]{10,100}$/";
    if (preg_match($parttern, $address)) return true;
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