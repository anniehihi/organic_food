<?php 
    include('../config/constants.php');
    include('login-check.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Fahasa Admin</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <script src='./jquery-3.6.0.min.js'></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- PAGE LEVEL STYLES-->
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="index.php">
                    <span class="brand">Admin
                        <span class="brand-tip"></span>
                    </span>
                    <span class="brand-mini">AD</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                    <li>
                        <form class="navbar-search" action="javascript:;">
                            <div class="rel">
                                <span class="search-icon"><i class="ti-search"></i></span>
                                <input class="form-control search" placeholder="Search here...">
                            </div>
                        </form>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                <ul class="nav navbar-toolbar">
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <img src="./assets/img/admin-avatar.png" />
                            <span></span><?php echo $_SESSION['user'];?><i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i>Đăng xuất</a>
                        </ul>
                    </li>
                </ul>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="./assets/img/admin-avatar.png" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?php echo $_SESSION['user'];?></div></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="index.php"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Trang chủ</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage-admin.php"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">Admin</span></a>
                    </li>
                    <li>
                        <a href="manage-staff.php"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">Nhân viên</span></a>
                    </li>
                    <li>
                        <a href="manage-category.php"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">Danh mục sản phẩm</span></a>
                    </li>
                    <li>
                        <a href="manage-product.php"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">Sản phẩm</span></a>
                    </li>
                    <li>
                        <a href="manage-customer.php"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">Khách hàng</span></a>
                    </li>
                    <li>
                        <a href="manage-order.php"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">Đơn đặt hàng</span></a>
                    </li>
                    <li>
                        <a href="manage-coupon.php"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">Mã giảm giá</span></a>
                    </li>
                    <li>
                        <a href="manage-vnpay.php"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">VN PAY</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">