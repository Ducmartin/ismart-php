<?php
function get_info_product($id){
    $item= db_fetch_row("SELECT * FROM `products`WHERE `id`='{$id}'");
            $item['url']=url_home($item['friendly_url']);
           return $item;
  }
function add_cart($id)
{
    session_start();
    $item = get_info_product($id);
    $qty = 1;
    if (isset($_SESSION['cart']) && isset($_SESSION['cart']['buy'][$id])) {
        $qty += $_SESSION['cart']['buy'][$id]['qty'];
    }
    $_SESSION['cart']['buy'][$id] = array(
        'id' => $id,
        'url'=>$item['url'],
        'product_name' => $item['product_name'],
        'avatar' => $item['avatar'],
        'price' =>(1-($item['discount']/100))*$item['price'],
        'code' => $item['product_code'],
        'qty' => $qty,
        'sub-total' => $qty * (1-$item['discount']/100)*$item['price'],
    );
    //cập nhật giỏ hàng
    update_info_cart();

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
function get_list_buy(){
    if(isset($_SESSION['cart'])){
       return $_SESSION['cart']['buy'];
    }
}

function update_cart($qty){
    foreach ($qty as $id => $new_qty) {
        $_SESSION['cart']['buy'][$id]['qty']=$new_qty;
        $_SESSION['cart']['buy'][$id]['sub-total']=$new_qty*$_SESSION['cart']['buy'][$id]['price'];
    }
    update_info_cart();
}
function delete_cart($id){
    if(isset($_SESSION['cart'])){
        unset($_SESSION['cart']['buy'][$id]);
             update_info_cart(); 
    }
}
function checkoutAction(){
    load_view("checkout");
}