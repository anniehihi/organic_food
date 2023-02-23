<?php
    include('../config/constants.php');

    if(isset($_GET['id']))
    {
        // echo  "oke";
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_register WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            // tạo sesion lưu thông báo 
            $_SESSION['delete'] = "<p class='text-success'>Xoá tài khoản khách hàng thành công</p>";
            // chuyến hướng đến trang manage
            echo("<script>location.href = '".SITEURL."admin/manage-customer.php';</script>");
        }
        else
        {
            // tạo sesion lưu thông báo 
            $_SESSION['delete'] = "<p class='text-success'>Lỗi xoá tài khoản</p>";
            // chuyến hướng đến trang manage
            echo("<script>location.href = '".SITEURL."admin/manage-customer.php';</script>");
        }
    }
    else
    {
        // chuyến hướng đến trang manage
        echo("<script>location.href = '".SITEURL."admin/manage-customer.php';</script>");
    }
?>