<?php
    include('config/constants.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Register</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="Admin/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="Admin/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="Admin/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="Admin/assets/css/main.css" rel="stylesheet" />     
    <!-- PAGE LEVEL STYLES-->
    <link href="Admin/assets/css/pages/auth-light.css" rel="stylesheet" />
</head>

<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link" href="index.php">Người dùng</a>
        </div>
        <form id="register-form" action="" method="post">
            <h2 class="login-title">Đăng ký</h2>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="first_name" placeholder="Họ">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="last_name" placeholder="Tên">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="phone" placeholder="Số điện thoại" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="username" placeholder="Tên đăng nhập" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" id="password" type="password" name="password" placeholder="Mật khẩu">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu">
            </div>
            <div class="form-group text-left">
                <!-- <label class="ui-checkbox ui-checkbox-info">
                    <input type="checkbox" name="agree">
                    <span class="input-span"></span>I agree the terms and policy</label> -->
            </div>
            <div class="form-group">
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Đăng ký"></input>
            </div>
            <div class="social-auth-hr">
                <span>Đăng ký với</span>
            </div>
            <div class="text-center social-auth m-b-20">
                <a class="btn btn-social-icon btn-twitter m-r-5" href="javascript:;"><i class="fa fa-twitter"></i></a>
                <a class="btn btn-social-icon btn-facebook m-r-5" href="javascript:;"><i class="fa fa-facebook"></i></a>
                <a class="btn btn-social-icon btn-google m-r-5" href="javascript:;"><i class="fa fa-google-plus"></i></a>
                <a class="btn btn-social-icon btn-linkedin m-r-5" href="javascript:;"><i class="fa fa-linkedin"></i></a>
                <a class="btn btn-social-icon btn-vk" href="javascript:;"><i class="fa fa-vk"></i></a>
            </div>
            <div class="text-center">Đã có tài khoản?
                <a class="color-blue" href="login.php">Đăng nhập ở đây</a>
            </div>
        </form>
        <?php
            if(isset($_POST['submit'])){
                // echo "oke";
                $firt_name = $_POST['first_name']; 
                $last_name = $_POST['last_name']; 
                $email = $_POST['email']; 
                $phone = $_POST['phone']; 
                $username = $_POST['username'];
                $password = md5($_POST['password']); 
                $confirm_password = md5($_POST['password_confirmation']);

                $sql = "INSERT INTO tbl_register SET
                    first_name = '$firt_name',
                    last_name = '$last_name', 
                    phone = '$phone', 
                    email = '$email', 
                    username ='$username',
                    password = '$password'
                ";

                $res = mysqli_query($conn, $sql);


                if($res == TRUE){
                    if($password == $confirm_password){
                        $_SESSION['add'] = "<p class='text-success'>Đăng ký thành công</p>"; 
                        echo("<script>location.href = '".SITEURL."login.php';</script>");
                        $_SESSION['email'] = $email;
                    }
                }else{
                    $_SESSION['add'] = "<p class='text-success'>Đăng ký thất bại</p>";
                    // chuyến hướng đến trang manage
                    echo("<script>location.href = '".SITEURL."register.php';</script>");
                }
            }
        ?>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="Admin/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="Admin/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="Admin/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="Admin/assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="Admin/assets/js/app.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#register-form').validate({
                errorClass: "help-block",
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        confirmed: true
                    },
                    password_confirmation: {
                        equalTo: password
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>

</html>