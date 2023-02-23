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
                <h1 class="page-title">Thêm danh mục sản phẩm</h1>
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
                                <label class="col-sm-2 col-form-label">Tên danh mục</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ảnh</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Đặc sắc</label>
                                <div class="col-sm-10 ml-sm-auto">
                                    <label class="ui-radio ui-radio-gray">
                                        <input type="radio" name="featured" value="Yes">
                                        <span class="input-span"></span>Yes
                                    </label>

                                    <label class="ui-radio ui-radio-gray">
                                        <input type="radio" name="featured" value="No">
                                        <span class="input-span"></span>No
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Trạng thái</label>
                                <div class="col-sm-10 ml-sm-auto">
                                    <label class="ui-radio ui-radio-gray">
                                        <input type="radio" name="active" value="Yes">
                                        <span class="input-span"></span>Yes
                                    </label>

                                    <label class="ui-radio ui-radio-gray">
                                        <input type="radio" name="active" value="No">
                                        <span class="input-span"></span>No
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <label class="ui-checkbox ui-checkbox-gray">
                                        <input type="checkbox">
                                        <span class="input-span"></span>Remamber me</label>
                                </div>
                            </div> -->
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
                $title = $_POST['title'];

                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No";
                }
                
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "No";
                }

                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];

                    if($image_name != ""){
                        

                        $ext = end(explode('.', $image_name));

                        $image_name = "Oganic_Category_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../image/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload == false){
                            // tạo sesion lưu thông báo 
                            $_SESSION['upload'] = "<p class='text-success'>Lỗi tải ảnh lên</p>";
                            // chuyến hướng đến trang manage
                            echo("<script>location.href = '".SITEURL."admin/add-cateogry.php';</script>");
                            die();
                        }
                    }
                }
                else{
                    $image_name = "";
                }             

                // print_r($_FILES['image']);

                // die();

                $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name='$image_name',
                    featured = '$featured',
                    active = '$active'
                ";

                $res = mysqli_query($conn, $sql);

                if($res==true){
                    // tạo sesion lưu thông báo 
                    $_SESSION['add'] = "<p class='text-success'>Thêm danh mục sản phẩm thành công</p>";
                    // chuyến hướng đến trang manage
                    echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                }else{
                    // tạo sesion lưu thông báo 
                    $_SESSION['add'] = "<p class='text-success'>Lỗi thêm danh mục sản phẩm</p>";
                    // chuyến hướng đến trang manage
                    echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                }
            }
        ?>

       