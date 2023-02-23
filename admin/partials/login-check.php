<?php
    if(!isset($_SESSION['user'])){

        // tạo sesion lưu thông báo 
        $_SESSION['no-login-message'] = "<p class='text-danger'>Please login to access Admin Panel.</p>";
        // $_SESSION['login'] = "<div class='success'>Login Successful. </div> ";
        // chuyến hướng đến trang manage
        echo("<script>location.href = '".SITEURL."admin/login.php';</script>");
    }  
?>