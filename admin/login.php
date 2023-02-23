<?php
    include('../config/constants.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="./assets/css/pages/auth-light.css" rel="stylesheet" />
</head>

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }


            ?>
<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link" href="index.html">Admin</a>
        </div>
        <form id="login-form" action="" method="POST">
            <h2 class="login-title">Log in</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Login"></input>
            </div>
        </form>


    <?php
        if(isset($_POST['submit'])){
            $username = $_POST['username']; 
            $password = md5($_POST['password']);
            
            $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    
            $res = mysqli_query($conn, $sql);
    
            $count = mysqli_num_rows($res);
    
            if($count == 1){

                // tạo sesion lưu thông báo 
                $_SESSION['login'] = "<p class='text-success'>Đăng nhập thành công.</p>";
                // $_SESSION['login'] = "<div class='success'>Login Successful. </div> ";
                $_SESSION['user'] = $username;
                // chuyến hướng đến trang manage
                echo("<script>location.href = '".SITEURL."admin/';</script>");
            }else{  
                // tạo sesion lưu thông báo 
                $_SESSION['login'] = "<p class='text-danger'>Tên đăng nhập hoặc mật khẩu không chính xác.</p>";
                // $_SESSION['login'] = "<div class='success'>Login Successful. </div> ";
                // chuyến hướng đến trang manage
                echo("<script>location.href = '".SITEURL."admin/login.php';</script>");
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
    <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    username: {
                        required: true,
                        username: true
                    },
                    password: {
                        required: true
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