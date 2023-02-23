<?php
    include('../config/constants.php');

    if(isset($_GET['id']))
    {
        // echo  "oke";
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_vnpay WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            // tạo sesion lưu thông báo 
            $_SESSION['delete'] = "<p class='text-success'>Xoá tài thành công</p>";
            // chuyến hướng đến trang manage
            echo("<script>location.href = '".SITEURL."admin/manage-vnpay.php';</script>");
        }
        else
        {
            // tạo sesion lưu thông báo 
            $_SESSION['delete'] = "<p class='text-success'>Lỗi</p>";
            // chuyến hướng đến trang manage
            echo("<script>location.href = '".SITEURL."admin/manage-vnpay.php';</script>");
        }
    }
    else
    {
        // chuyến hướng đến trang manage
        echo("<script>location.href = '".SITEURL."admin/manage-vnpay.php';</script>");
    }
?>