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
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['failed-remove'])){
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
            ?> 
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Quản lý danh mục sản phẩm</h1>                    
                <!-- <form action="search.php" method="POST">
                        <div>
                            <input class="form-control search" name="search" placeholder="Tìm kiếm...">
                            <span>
                                <button type="submit" name="submit" class="site-btn">Tìm</button>
                            </span>
                        </div>
                </form> -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php"><i class="la la-home font-20"></i></a>
                    </li>
                </ol>
            </div>

                <div class="ibox">
                <div class="ibox-head">
                    <form action="import_excel.php" method="POST">
                        <!-- <a href="excel.php"><button type="submit" name="export_exel"  class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Xuất excel"><i class="fa fa-file-excel-o font-14"></i></button></a>   -->
                        <a href="import_excel.php"><button type="submit" name="export_exel"  class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Nhập dữ liệu từ excel"><i class="fa fa-file-excel-o font-14"></i></button></a>  
                    </form>
                </div>  
                <div class="ibox-head">
                    <a href="<?php echo SITEURL; ?>admin/add-category.php"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Thêm mới"><i class="fa fa-plus font-14"></i></button></a>
                </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group pl-4">
                                <label>Tìm kiếm danh mục</label>
                                <input type="text" name="search" class="form-control">
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <div class="form-group pl-4">
                                <label>Bấm vào để tìm kiếm</label> <br>
                                <button type="submit" class="btn btn-primary">Tìm</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <table class="table" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Hình ảnh</th>
                                    <th>Đặc sắc</th>
                                    <th>Trạng thái</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    // câu truy vấn để lấy dữ liệu 
                                    $sql = "SELECT * FROM tbl_category"; 

                                    // thực thi câu truy vấn
                                    $res = mysqli_query($conn, $sql); 

                                    // kiểm tra xem có dữ liệu hay không 
                                    $count = mysqli_num_rows($res); 

                                    $sn = 1; 

                                    if($count > 0){
                                        while($row = mysqli_fetch_assoc($res)){
                                            // var_dump($row); 
                                            // die();
                                            $id = $row['category_id']; 
                                            $title = $row['title']; 
                                            $image_name = $row['image_name']; 
                                            $featured = $row['featured']; 
                                            $active = $row['active'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $sn++; ?></td>
                                                    <td><?php echo $title; ?></td>
                                                    <td>
                                                        <?php
                                                            if($image_name != ""){
                                                                ?>
                                                                    <img src="<?php echo SITEURL; ?>image/category/<?php echo $image_name; ?>"
                                                                    width = "150px">
                                                                <?php
                                                            }else{
                                                                echo "<p class='text-success'>Lỗi thêm mới ảnh.</p>";
                                                            }
                                                        ?>
                                                    </td>
                                                    
                                                    <!-- <td>
                                                        <?php
                                                            if($image_name_detail != ""){
                                                                ?>
                                                                    <img src="<?php echo SITEURL; ?>img/product_detail/<?php echo $image_name_detail; ?>"
                                                                    width = "150px">
                                                                <?php
                                                            }else{
                                                                echo "<p class='text-success'>Lỗi thêm mới ảnh.</p>";
                                                            }
                                                        ?>
                                                    </td> -->


                                                    <td><?php echo $featured; ?></td>
                                                    <td><?php echo $active; ?></td>
                                                    <td>
                                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>"><button class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Update"><i class="fa fa-pencil font-14"></i></button></a> 
                                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button></a> 
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class='text-success'>Chưa có sản phẩm.</div>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- END PAGE CONTENT-->
        </div>



    <!-- BEGIN THEME CONFIG PANEL-->

    <?php include('./partials/footer.php') ?>