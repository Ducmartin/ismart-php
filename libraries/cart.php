<?php
 function get_num_order_cart(){
    if(isset($_SESSION['cart'])){
        return $_SESSION['cart']['info']['num-order'];
    }
}