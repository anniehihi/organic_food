<?php include('./partials/header.php'); ?>
            <?php   
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?> 

            <div class="page-heading">
                <h1 class="page-title">Thêm sản phẩm</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                </ol>
            </div>

            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">SẢN PHẨM</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" action = "" method = "POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên sản phẩm</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Số lượng</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="qty">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Miêu tả</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" ></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Giá tiền</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Thương hiệu</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="trademark">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ảnh sản phẩm</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Danh mục sản phẩm</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="category">
                                        
                                    <?php
                                        $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";

                                        $res2 = mysqli_query($conn, $sql2);

                                        $count2 = mysqli_num_rows($res2);

                                        if($count2>0)
                                        {
                                            while($row2=mysqli_fetch_assoc($res2))
                                            {
                                                $category_id = $row2['category_id'];
                                                $category_title = $row2['title'];
                                                ?>
                                                    <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <option value="0">Không có danh mục sản phẩm</option>
                                            <?php
                                        }
                                    ?>
                                    </select>
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
                // lấy dữ liệu nhập vào từ form 
                $title = $_POST['title']; 
                $description = $_POST['description']; 
                $price = $_POST['price'];
                $qty = $_POST['qty']; 
                $trademark = $_POST['trademark']; 
                $category = $_POST['category']; 
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

                        $image_name = "Product_Name_".rand(0000, 9999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../image/product/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload == false){
                            // tạo sesion lưu thông báo 
                            $_SESSION['upload'] = "<p class='text-success'>Bạn cần chọn ảnh của sản phẩm</p>";
                            // chuyến hướng đến trang manage
                            echo("<script>location.href = '".SITEURL."admin/add-product.php';</script>");
                            die();
                        }
                    }
                }
                else{
                    $image_name = "";
                } 

                if(empty($title) || 
                empty($description) ||
                empty($price) || 
                empty($qty) || 
                empty($trademark) || 
                empty($image_name) || 
                empty($category_id) || 
                empty($featured) || 
                empty($active)){
                    $message = "Bạn phải nhập đầy đủ thông tin";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }else{
                    $sql="INSERT INTO tbl_product SET
                    title = '$title', 
                    description = '$description', 
                    price = '$price', 
                    qty = '$qty',
                    trademark = '$trademark', 
                    image_name = '$image_name',
                    category_id = '$category', 
                    view = 0, 
                    featured = '$featured', 
                    active = '$active'
                ";
                $res = mysqli_query($conn, $sql); 
                if($res == TRUE){
                    // tạo sesion lưu thông báo 
                    $_SESSION['add'] = "<p class='text-success'>Thêm mới sản phẩm thành công</p>";
                    // chuyến hướng đến trang manage
                    echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
                }else{
                    // tạo sesion lưu thông báo 
                    $_SESSION['add'] = "<p class='text-success'>Lỗi thêm sản phẩm</p>";
                    // chuyến hướng đến trang manage
                    echo("<script>location.href = '".SITEURL."admin/manage-product.php';</script>");
                }
                }


            }
        ?>