<?php 
    include('./config/constants.php');
    unset($_SESSION['user']);
    unset($_SESSION['id']);

    // chuyến hướng đến trang manage
    echo("<script>location.href = '".SITEURL."';</script>");
?>