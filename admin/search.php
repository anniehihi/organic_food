<?php include('./partials/header.php'); ?>
            <!-- START PAGE CONTENT-->
            <form action="search.php" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group pl-4">
                                <label>Tìm kiếm sản phẩm</label>
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
                </form>
                <div class="ibox">
                    <div class="ibox-body">
                        <table class="table" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Số lượng</th>
                                    <th>Giá tiền</th>
                                    <th>Hình ảnh</th>
                                    <th>Đặc sắc</th>
                                    <th>Trạng thái</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                  if(isset($_POST['search'])){
                                    $search = $_POST['search'];
                                    $sql = "SELECT * FROM tbl_product WHERE title LIKE '%$search%'";
                                                                        // câu truy vấn để lấy dữ liệu 
                                    // $sql = "SELECT * FROM tbl_product"; 

                                    // thực thi câu truy vấn
                                    $res = mysqli_query($conn, $sql); 

                                    // kiểm tra xem có dữ liệu hay không 
                                    $count = mysqli_num_rows($res); 

                                    $sn = 1; 

                                    if($count > 0){
                                        while($row = mysqli_fetch_assoc($res)){
                                            // var_dump($row); 
                                            // die();
                                            $id = $row['product_id']; 
                                            $title = $row['title']; 
                                            $qty = $row['qty']; 
                                            $price = $row['price']; 
                                            $description = $row['description'];
                                            $image_name = $row['image_name']; 
                                            // $image_name_detail = $row['image_name_detail'];
                                            $featured = $row['featured']; 
                                            $active = $row['active'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $sn++; ?></td>
                                                    <td><?php echo $title; ?></td>
                                                    <td><?php echo $qty; ?></td>
                                                    <td><?php echo number_format($price); ?></td>
                                                    <!-- <td style="width: 200px; height: 100px; maxlength=20"><?php echo $description; ?></td> -->
                                                    <td>
                                                        <?php
                                                            if($image_name != ""){
                                                                ?>
                                                                    <img src="<?php echo SITEURL; ?>image/product/<?php echo $image_name; ?>"
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
                                                        <a href="<?php echo SITEURL; ?>admin/update-product.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>"><button class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Update"><i class="fa fa-pencil font-14"></i></button></a> 
                                                        <a href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button></a> 
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class='text-success'>Không tìm thấy sản phẩm.</div>
                                                </td>
                                            </tr>
                                        <?php
                                    }
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