<?php include('./partials/header.php'); ?>
            <div class="page-heading">
                <h1 class="page-title">Cập nhật danh mục sản phẩm</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                </ol>
            </div>

            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">CATEGORY</div>
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
                            $sql = "SELECT * FROM tbl_category WHERE category_id=$id"; 

                            // thực thi truy vấn
                            $res = mysqli_query($conn, $sql);

                            // kiểm tra xem có dữ liệu hay không 

                            // kiểm tra xem category có dữ liệu không 
                            // lấy thông tin chi tiết
                            $row = mysqli_fetch_assoc($res); 

                            $title = $row['title']; 
                            $current_image = $row['image_name']; 
                            $featured = $row['featured']; 
                            $active = $row['active']; 
                        
                        }else{
                            echo("<script>location.href = '".SITEURL."admin/manage-products.php';</script>");
                        }                    
                    ?>
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên danh mục</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title" value="<?php echo $title; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ảnh hiện tại</label>
                                <div class="col-sm-10">
                                    <?php
                                        if($current_image != ""){
                                            ?>
                                            <img src = "<?php echo SITEURL; ?>/image/category/<?php echo $current_image; ?>" width="200px">
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
                                <label class="col-sm-2 col-form-label">Nổi bật</label>
                                <div class="col-sm-10 ml-sm-auto">
                                    <label class="ui-radio ui-radio-gray">
                                        <input <?php if($featured=="Yes"){echo "checked";} ?>  type="radio" name="featured" value="Yes">
                                        <span class="input-span"></span>Yes
                                    </label>

                                    <label class="ui-radio ui-radio-gray">
                                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">
                                        <span class="input-span"></span>No
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Hoạt động</label>
                                <div class="col-sm-10 ml-sm-auto">
                                    <label class="ui-radio ui-radio-gray">
                                        <input <?php if($active=="Yes"){echo "checked";} ?>  type="radio" name="active" value="Yes">
                                        <span class="input-span"></span>Yes
                                    </label>

                                    <label class="ui-radio ui-radio-gray">
                                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">
                                        <span class="input-span"></span>No
                                    </label>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input  type="hidden" name="current_image" value="<?php echo $current_image; ?>"></input>
                                    <input class="btn btn-info" type="submit" name="submit" value="Cập nhật"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php 
                    if(isset($_POST['submit'])){
                        $id = $_POST['id']; 
                        $title = $_POST['title']; 
                        $current_image = $_POST['current_image'];
                        $featured = $_POST['featured']; 
                        $active = $_POST['active'];

                        if(isset($_FILES['image']['name'])){
                            $image_name = $_FILES['image']['name'];
        
                            if($image_name != ""){
                                $ex = explode('.', $image_name);
                                $ext = end($ex);
        
                                $image_name = "Category_Name_".rand(0000, 9999).'.'.$ext;
        
                                $source_path = $_FILES['image']['tmp_name'];
        
                                $destination_path = "../image/category/".$image_name;
        
                                $upload = move_uploaded_file($source_path, $destination_path);
        
                                if($upload == false){
                                    // tạo sesion lưu thông báo 
                                    $_SESSION['upload'] = "<p class='text-success'>Failed to Upload Image</p>";
                                    // chuyến hướng đến trang manage
                                    echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                                    die();
                                }
        
                                if($current_image !=""){
                                    $remove_path = "../image/category/".$current_image;
                                    $remove = unlink($remove_path);
                                    if($remove == false){
                                        // tạo sesion lưu thông báo 
                                        $_SESSION['failed-remove'] = "<p class='text-success'>Failed to Remove Current Image</p>";
                                        // chuyến hướng đến trang manage
                                        echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                                        die();
                                    }
                                }
                        }
                        else
                        {
                            $image_name = $current_image;
                        }        

                        // tạo câu truy vấn để update 
                        $sql3 = "UPDATE tbl_category SET
                            title = '$title',
                            image_name = '$image_name',
                            featured = '$featured', 
                            active = '$active'
                            WHERE category_id=$id
                        ";

                        // thực thi câu truy vấn 
                        $res3 = mysqli_query($conn, $sql3); 

                        // kiểm tra xem câu truy vấn có thực thi đúng hay không 
                        if($res3 == TRUE){
                            // thực hiện đúng và update admin 
                            $_SESSION['update'] = "<p class='text-success'>Cập nhật danh mục sản phẩm thành công</p>";
                            // chuyến hướng đến trang manage
                            echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                        }else{
                            // thực hiện sai 
                            $_SESSION['update'] = "<p class='text-success'>Lỗi cập nhật danh mục sản phẩm</p>";
                            // chuyến hướng đến trang manage
                            echo("<script>location.href = '".SITEURL."admin/manage-category.php';</script>");
                        }
                    }
                }
                ?>
            </div>
<?php include('./partials/footer.php') ?>

