<?php
function logout()
{
  session_start();
      if(isset($_SESSION['is_login'])){
        unset($_SESSION['is_login']);
        unset($_SESSION['user_login']);
      }
}
