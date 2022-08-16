<?php

function construct()
{
    load_model('index');
}

function showAction()
{
    $url = explode('/', $_SERVER['REQUEST_URI']);
    $html = $url[count($url) - 1];
    $slug = explode('.html', $html);
    $page = get_page($slug[0]);
    if (!empty($page)) {
        $data['page'] = $page;
        $data['post'] = get_post_in_page($page['id']);
        load_view('index', $data);
    }else{
        $post=get_post($slug[0]);
        load_view('detail',$post);
    }
}
