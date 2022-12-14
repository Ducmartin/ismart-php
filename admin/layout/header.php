<!DOCTYPE html>
<html>

<head>
    <title>Quản lý ISMART</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />

    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/app.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div class="wp-inner clearfix">
                    <a href="?page=list_post" title="" id="logo" class="fl-left"><?php if (isset($_SESSION['user_login'])) echo $_SESSION['user_login']; ?></a>
                    <ul id="main-menu" class="fl-left">
                        <li>
                            <a href="?mod=pages&action=list_page" title="">Trang</a>
                            <ul class="sub-menu">
                                <li >
                                    <a href="?mod=pages&action=add" title="" class="nav-link">Thêm mới</a>
                                </li>
                                <li >
                                    <a href="?mod=pages&action=list_page" title="" class="nav-link">Danh sách các trang</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=posts&action=list_post" title="">Bài viết</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=posts&action=add" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?mod=posts&action=list_post" title="">Danh sách bài viết</a>
                                </li>
                                <li>
                                    <a href="?mod=posts&action=list_cat" title="">Danh mục bài viết</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=products&action=list_product" title="">Sản phẩm</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=products&action=add" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?mod=products&action=list_product" title="">Danh sách sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a href="?mod=products&action=add_cat" title="" class="nav-link">Thêm danh mục sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?mod=products&action=list_cat" title="">Danh mục sản phẩm</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=orders&action=list_order" title="">Bán hàng</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=orders&action=list_order" title="">Danh sách đơn hàng</a>
                                </li>
                                <li>
                                    <a href="?mod=orders&action=list_customer" title="">Danh sách khách hàng</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                        <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div id="thumb-circle" class="fl-left">
                                <img src="public/images/img-admin.png">
                            </div>
                            <h3 id="account" class="fl-right"><?php if (isset($_SESSION['user_login'])) echo $_SESSION['user_login']; ?></h3>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="?mod=users&action=update" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                            <li><a href="?mod=users&action=logout" title="Thoát">Thoát</a></li>
                        </ul>
                    </div>
                </div>
            </div>