<?php include('./partials/header.php'); ?>


            <?php   
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            <?php
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?> 

            <div class="page-heading">
                <h1 class="page-title">Thêm mã giảm giá</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                </ol>
            </div>

            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title"></div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Mã CODE</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Phần trăm giảm giá</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="percent">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Thời gian hoạt động</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" name="time">
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
        </div>
<?php include('./partials/footer.php') ?>

        <?php
            if(isset($_POST['submit'])){
                $code = $_POST['code'];
                $percent = $_POST['percent'];
                $time = $_POST['time'];


                if(empty($code) || 
                empty($percent) ||
                empty($time)){
                    $message = "Bạn phải nhập đầy đủ thông tin";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }else{
                $sql = "INSERT INTO tbl_coupon SET
                    code = '$code',
                    time = '$time',
                    createdAt = CURRENT_TIME(),
                    percent = '$percent'
                ";

                $res = mysqli_query($conn, $sql);

                if($res==true){
                    // tạo sesion lưu thông báo 
                    $_SESSION['add'] = "<p class='text-success'>Thêm mã giảm giá thành công</p>";
                    // chuyến hướng đến trang manage
                    echo("<script>location.href = '".SITEURL."admin/manage-coupon.php';</script>");
                }else{
                    // tạo sesion lưu thông báo 
                    $_SESSION['add'] = "<p class='text-success'>Lỗi thêm mã giảm giá</p>";
                    // chuyến hướng đến trang manage
                    echo("<script>location.href = '".SITEURL."admin/manage-coupon.php';</script>");
                }
            }
            }
        ?>

       