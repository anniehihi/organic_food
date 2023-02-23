<?php
    include('../config/constants.php');

    if(isset($_GET['id']))
    {
        // echo  "oke";
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_order WHERE order_id=$id";

        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            // tạo sesion lưu thông báo 
            $_SESSION['delete'] = "<p class='text-success'>Xoá đơn hàng thành công</p>";
            // chuyến hướng đến trang manage
            echo("<script>location.href = '".SITEURL."admin/manage-order.php';</script>");
        }
        else
        {
            // tạo sesion lưu thông báo 
            $_SESSION['delete'] = "<p class='text-success'>Xoá đơn hàng lỗi</p>";
            // chuyến hướng đến trang manage
            echo("<script>location.href = '".SITEURL."admin/manage-order.php';</script>");
        }
    }
    else
    {
        // chuyến hướng đến trang manage
        echo("<script>location.href = '".SITEURL."admin/manage-order.php';</script>");
    }
?>