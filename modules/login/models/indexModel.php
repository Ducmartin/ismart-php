<?php

use Symfony\Component\HttpFoundation\Session\Session;

function check_login($username, $password)
{
    $password = md5($password);
    $item = db_fetch_row("SELECT * FROM `users` WHERE `username`='{$username}'AND`password` = '$password'");
    if (!empty($item)) {
        if (isset($_POST['remember_me'])) {
            setcookie('is_login', true, time() + 3600);
            setcookie('user_login', $username, time() + 3600);
        };
        $_SESSION['is_login'] = true;
        $_SESSION['user_login'] =$username;
        redirect("");
    };
}

function check_user_reg()
{
    global $username, $email;
    $user_reg = db_num_rows("SELECT*FROM`users`WHERE`username`='{$username}'OR`email`='{$email}'");
    if ($user_reg > 0) {
        return true;
    }
    return false;
}
function add_user($data)
{
    return db_insert('users', $data);
}
function check_active_token($active_token)
{
    $check = db_num_rows("SELECT*FROM`users`WHERE`active_token`='{$active_token}'AND`is_active`='0'");

    if ($check > 0)
        return true;
    return false;
}
function is_token($active_token)
{
    return db_update('users', array('is_active' => 1), "`active_token`='{$active_token}'");
}
function delete_user_not_active($time, $active_token)
{
    return db_delete('users', "`active_token`='{$active_token}'AND`is_active`='0'AND`time_reg`=<{$time}");
}
function check_reset_token($reset_token)
{
    $check = db_num_rows("SELECT*FROM`users`WHERE`reset_token`='{$reset_token}'");
    if ($check > 0)
        return true;
    return false;
}
function check_email($email)
{
    $check = db_num_rows("SELECT*FROM`users`WHERE`email`='{$email}'");
    if ($check > 0)
        return true;
    return false;
}
function update_reset_token($data, $email)
{
    return db_update('users', $data, "`email`='{$email}'");
}
function update_resetpassword($data, $reset_token)
{
    return db_update('users', $data, "`reset_token`='{$reset_token}'");
}
