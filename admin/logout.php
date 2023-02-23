<?php 
    include('../config/constants.php');
    session_destroy();

    // chuyến hướng đến trang manage
    echo("<script>location.href = '".SITEURL."admin/login.php';</script>");
?>