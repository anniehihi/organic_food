<?php
    include('config/constants.php');
?>
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Login</title>
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
        <form id="login-form" action="" method="POST">
            <h2 class="login-title">Đăng nhập</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="text" name="username" placeholder="Tên đăng nhập" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="password" placeholder="Mật khẩu">
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label class="ui-checkbox ui-checkbox-info">
                    <!-- <input type="checkbox">
                    <span class="input-span"></span>Remember me</label>
                <a href="forgot_password.html">Forgot password?</a> -->
            </div>
            <div class="form-group">
                <button style="cursor: pointer" class="btn btn-info btn-block" type="submit" name="submit">Đăng nhập</button>
            </div>
            <div class="social-auth-hr">
                <span>Đăng nhập với</span>
            </div>
            <div class="text-center social-auth m-b-20">
                <a class="btn btn-social-icon btn-twitter m-r-5" href="javascript:;"><i class="fa fa-twitter"></i></a>
                <a class="btn btn-social-icon btn-facebook m-r-5" href="javascript:;"><i class="fa fa-facebook"></i></a>
                <a class="btn btn-social-icon btn-google m-r-5" href="javascript:;"><i class="fa fa-google-plus"></i></a>
                <a class="btn btn-social-icon btn-linkedin m-r-5" href="javascript:;"><i class="fa fa-linkedin"></i></a>
                <a class="btn btn-social-icon btn-vk" href="javascript:;"><i class="fa fa-vk"></i></a>
            </div>
            <div class="text-center">Chưa có tài khoản?
                <a class="color-blue" href="register.php">Đăng ký ngay</a>
            </div>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $username = $_POST['username']; 
                $password = md5($_POST['password']); 

                if(strlen($username) < 5){
                    $_SESSION['login'] = "<p class='text-error'>Lỗi tài khoản của bạn quá ngắn</p>";
                }elseif(strlen($username) > 25){
                    $_SESSION['login'] = "<p class='text-error'>Lỗi tài khoản của bạn quá dài</p>";
                }else{
                    $sql = "SELECT * FROM tbl_register WHERE username = '$username' AND password = '$password'"; 
                
                    $res = mysqli_query($conn, $sql); 
    
                    $count = mysqli_num_rows($res); 
                    if($count > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            // tạo sesion lưu thông báo 
                            $_SESSION['login'] = "<p class='text-success'>Đăng nhập thành công</p>";
                            // $_SESSION['login'] = "<div class='success'>Login Successful. </div> ";
                            $_SESSION['id'] = $id;
                            $_SESSION['user'] = $username;
                            if(isset($_GET['action'])){
                                echo("<script>location.href = '".SITEURL."checkout.php'</script>");
                            }else{
                                echo("<script>location.href = '".SITEURL."'</script>");
                            }
                        }
                    }else{
                        // tạo sesion lưu thông báo 
                        $_SESSION['login'] = "<p class='text-error'>Lỗi tài khoản hoặc mật khẩu</p>";
                        // $_SESSION['login'] = "<div class='success'>Login Successful. </div> ";
                        // chuyến hướng đến trang chủ
                        echo("<script>location.href = '".SITEURL."login.php';</script>");
                    }
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
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    username: {
                        required: true,
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