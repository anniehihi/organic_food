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
                <h1 class="page-title">Thêm nhân viên</h1>
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
                                <label class="col-sm-2 col-form-label">Tên nhân viên</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="full_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ảnh</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Giới tính</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="gender">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Liên hệ</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="contact">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Năm sinh</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" name="birthday">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Địa chỉ</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Chức vụ</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="position">
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
                $full_name = $_POST['full_name'];
                $gender = $_POST['gender'];
                $contact = $_POST['contact'];
                $birthday = $_POST['birthday'];
                $address = $_POST['address'];
                $position = $_POST['position'];

                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];

                    if($image_name != ""){
                        

                        $ext = end(explode('.', $image_name));

                        $image_name = "Staff_Image_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../image/staff/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload == false){
                            // tạo sesion lưu thông báo 
                            $_SESSION['upload'] = "<p class='text-success'>Lỗi tải ảnh lên</p>";
                            // chuyến hướng đến trang manage
                            echo("<script>location.href = '".SITEURL."admin/add-staff.php';</script>");
                            die();
                        }
                    }
                }
                else{
                    $image_name = "";
                }             

                // print_r($_FILES['image']);

                // die();

                if(empty($full_name) || 
                empty($image_name) ||
                empty($gender) || 
                empty($contact) || 
                empty($birthday) || 
                empty($address) || 
                empty($position)){
                    $_SESSION['add'] = "<p class='text-success'>Bạn phải nhập đầy đủ thông tin</p>";
                    echo("<script>location.href = '".SITEURL."admin/add-staff.php';</script>");
                }else{
                    $sql = "INSERT INTO tbl_staff SET
                    full_name = '$full_name',
                    image_name='$image_name',
                    gender = '$gender',
                    contact = '$contact',
                    birthday = '$birthday',
                    address = '$address',
                    position = '$position'
                ";

                $res = mysqli_query($conn, $sql);

                if($res==true){
                    // tạo sesion lưu thông báo 
                    $_SESSION['add'] = "<p class='text-success'>Thêm nhân viên thành công</p>";
                    // chuyến hướng đến trang manage
                    echo("<script>location.href = '".SITEURL."admin/manage-staff.php';</script>");
                }else{
                    // tạo sesion lưu thông báo 
                    $_SESSION['add'] = "<p class='text-success'>Lỗi thêm nhân viên</p>";
                    // chuyến hướng đến trang manage
                    echo("<script>location.href = '".SITEURL."admin/manage-staff.php';</script>");
                }
                }


            }
        ?>

       