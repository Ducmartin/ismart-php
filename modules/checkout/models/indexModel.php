<?php
function get_product($id){
    return db_fetch_row("SELECT*FROM`products`WHERE `id`={$id}");
}
function get_customer($username){
    return db_fetch_row("SELECT*FROM`users` WHERE `username`='{$username}'");
}
function update_customer($data,$username){
    return db_update('users',$data,"`username`='{$username}'");
}
function add_order($data){
return db_insert('orders',$data);
}
function delete_cart($id){
    if(isset($_SESSION['cart'])){
        unset($_SESSION['cart']['buy'][$id]);
             update_info_cart(); 
    }
}
function update_info_cart()
{
    if (isset($_SESSION['cart'])) {
        $num_oder = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_oder += $item['qty'];
            $total += $item['sub-total'];
        }
        $_SESSION['cart']['info'] = array(
            'num-order' => $num_oder,
            'total' => $total,
        );
    }
}
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>