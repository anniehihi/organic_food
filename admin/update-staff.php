<?php include('./partials/header.php'); ?>
            <div class="page-heading">
                <h1 class="page-title">Cập nhật nhân viên</h1>
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


                    <?php
                        if(isset($_GET['id'])){
                            // 1.lấy id của category được update 
                            $id = $_GET['id']; 

                            // 2. tạo câu truy vấn 
                            $sql = "SELECT * FROM tbl_staff WHERE staff_id=$id"; 

                            // thực thi truy vấn
                            $res = mysqli_query($conn, $sql);

                            // kiểm tra xem có dữ liệu hay không 

                            // kiểm tra xem category có dữ liệu không 
                            // lấy thông tin chi tiết
                            $row = mysqli_fetch_assoc($res); 

                            $full_name = $row['full_name']; 
                            $current_image = $row['image_name']; 
                            $gender = $row['gender']; 
                            $contact = $row['contact']; 
                            $birthday = $row['birthday']; 
                            $address = $row['address']; 
                            $position = $row['position']; 
                        
                        }else{
                            echo("<script>location.href = '".SITEURL."admin/manage-staff.php';</script>");
                        }                    
                    ?>
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên nhân viên</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="full_name" value="<?php echo $full_name; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ảnh hiện tại</label>
                                <div class="col-sm-10">
                                    <?php
                                        if($current_image != ""){
                                            ?>
                                            <img src = "<?php echo SITEURL; ?>/image/staff/<?php echo $current_image; ?>" width="200px">
                                            <?php
                                        }else{
                                            echo "<p class='text-success'>Products Not Found</p>";
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ảnh mới</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="image">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Giới tính</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="gender" value="<?php echo $gender; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Liên hệ</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="contact" value="<?php echo $contact; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Năm sinh</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="birthday" value="<?php echo $birthday; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Địa chỉ</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="address" value="<?php echo $address; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Chức vụ</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="position" value="<?php echo $position; ?>">
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input  type="hidden" name="current_image" value="<?php echo $current_image; ?>"></input>
                                    <input class="btn btn-info" type="submit" name="submit" value="Xác nhận"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php 
                    if(isset($_POST['submit'])){
                        $id = $_POST['id']; 
                        $full_name = $_POST['full_name']; 
                        $current_image = $_POST['current_image'];
                        $gender = $_POST['gender']; 
                        $contact = $_POST['contact']; 
                        $birthday = $_POST['birthday']; 
                        $address = $_POST['address']; 
                        $position = $_POST['position']; 

                        if(isset($_FILES['image']['name'])){
                            $image_name = $_FILES['image']['name'];
        
                            if($image_name != ""){
                                $ex = explode('.', $image_name);
                                $ext = end($ex);
        
                                $image_name = "Staff_Name_".rand(0000, 9999).'.'.$ext;
        
                                $source_path = $_FILES['image']['tmp_name'];
        
                                $destination_path = "../image/staff/".$image_name;
        
                                $upload = move_uploaded_file($source_path, $destination_path);
        
                                if($upload == false){
                                    // tạo sesion lưu thông báo 
                                    $_SESSION['upload'] = "<p class='text-success'>Failed to Upload Image</p>";
                                    // chuyến hướng đến trang manage
                                    echo("<script>location.href = '".SITEURL."admin/manage-staff.php';</script>");
                                    die();
                                }
        
                                if($current_image !=""){
                                    $remove_path = "../image/staff/".$current_image;
                                    $remove = unlink($remove_path);
                                    if($remove == false){
                                        // tạo sesion lưu thông báo 
                                        $_SESSION['failed-remove'] = "<p class='text-success'>Failed to Remove Current Image</p>";
                                        // chuyến hướng đến trang manage
                                        echo("<script>location.href = '".SITEURL."admin/manage-staff.php';</script>");
                                        die();
                                    }
                                }
                        }
                        else
                        {
                            $image_name = $current_image;
                        }        

                        if(empty($full_name) || 
                        empty($image_name) ||
                        empty($gender) || 
                        empty($contact) || 
                        empty($birthday) || 
                        empty($address) || 
                        empty($position)){
                            $message = "Bạn phải nhập đầy đủ thông tin";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                        }else{
                        // tạo câu truy vấn để update 
                        $sql3 = "UPDATE tbl_staff SET
                            full_name = '$full_name',
                            image_name = '$image_name',
                            gender = '$gender', 
                            contact = '$contact',
                            birthday = '$birthday',
                            address = '$address', 
                            position = '$position'
                            WHERE staff_id=$id
                        ";

                        // thực thi câu truy vấn 
                        $res3 = mysqli_query($conn, $sql3); 

                        // kiểm tra xem câu truy vấn có thực thi đúng hay không 
                        if($res3 == TRUE){
                            // thực hiện đúng và update admin 
                            $_SESSION['update'] = "<p class='text-success'>Cập nhật nhân viên thành công</p>";
                            // chuyến hướng đến trang manage
                            echo("<script>location.href = '".SITEURL."admin/manage-staff.php';</script>");
                        }else{
                            // thực hiện sai 
                            $_SESSION['update'] = "<p class='text-success'>Lỗi cập nhật nhân viên</p>";
                            // chuyến hướng đến trang manage
                            echo("<script>location.href = '".SITEURL."admin/manage-staff.php';</script>");
                        }
                    }
                }
                }
                ?>
            </div>
<?php include('./partials/footer.php') ?>

