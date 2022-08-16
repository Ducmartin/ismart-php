<?php

function construct() {
    load_model('index');
}

function indexAction() {
    if(!empty($_GET['search'])){
        $search=$_GET['search'];
      $data=get_product_search(create_slug($search));
     load_view('search',$data);
    }
    load_view("index");
}
