<?php include('./partials/header.php'); ?>

            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>

            <div class="page-heading">
                <h1 class="page-title">Thêm tài khoản</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                </ol>
            </div>

            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">ADMIN</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Họ và Tên</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="full_name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên đăn nhập</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Mật khẩu</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <input class="btn btn-info" type="submit" name="submit" value="Thêm"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


<?php include('./partials/footer.php') ?>

<?php
    // xử lý giá trị từ form và lưu vào databse 
    // kiểm tra xem có click vào nút button hay không 
    if(isset($_POST['submit'])){
        // 1. Lấy dữ liệu nhập vào từ form
        $full_name = $_POST['full_name']; 
        $username = $_POST['username']; 
        $password = md5($_POST['password']);

        // 2. câu truy vấn để lưu vào database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name', 
            username = '$username', 
            password = '$password'
        ";
        // 3. thực thi câu truy vấn và lưu dữ liệu trong cơ sở dữ liệu 
        $res = mysqli_query($conn, $sql) or die(mysqli_error()); 

        // 4. kiểm tra xem dữ liệu được thêm vào hay không và hiển thị thông tin 
        if($res == TRUE){
            // echo "Data oke";
            // tạo sesion lưu thông báo 
            $_SESSION['add'] = "<p class='text-success'>Thêm tài khoản thành công</p>";
            // chuyến hướng đến trang manage
            echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");
        }else{
            // echo "data not oke";
            // tạo sesion lưu thông báo 
            $_SESSION['add'] = "<p class='text-danger'>Lỗi thêm tài khoản</p>";
            // chuyển hướng đến trang manage
            echo("<script>location.href = '".SITEURL."admin/manage-admin.php';</script>");
        }
    }
?>        
</div>