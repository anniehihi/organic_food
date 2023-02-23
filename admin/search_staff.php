<?php include('./partials/header.php'); ?>
            <!-- START PAGE CONTENT-->
            <form action="search_staff.php" method="POST">
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
                                    <th>Họ và tên</th>
                                    <th>Hình ảnh</th>
                                    <th>Giới tính</th>
                                    <th>Liên hệ</th>
                                    <th>Năm sinh</th>
                                    <th>Địa chỉ</th>
                                    <th>Chức vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                  if(isset($_POST['search'])){
                                    $search = $_POST['search'];
                                    $sql = "SELECT * FROM tbl_staff WHERE full_name LIKE '%$search%'";
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
                                            $id = $row['staff_id']; 
                                            $full_name = $row['full_name']; 
                                            $image_name = $row['image_name']; 
                                            $gender = $row['gender']; 
                                            $contact = $row['contact'];
                                            $birthday = $row['birthday']; 
                                            // $image_name_detail = $row['image_name_detail'];
                                            $address = $row['address']; 
                                            $position = $row['position'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $sn++; ?></td>
                                                    <td><?php echo $full_name; ?></td>
                                                    <!-- <td style="width: 200px; height: 100px; maxlength=20"><?php echo $description; ?></td> -->
                                                    <td>
                                                        <?php
                                                            if($image_name != ""){
                                                                ?>
                                                                    <img src="<?php echo SITEURL; ?>image/staff/<?php echo $image_name; ?>"
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


                                                    <td><?php echo $gender; ?></td>
                                                    <td><?php echo $contact; ?></td>
                                                    <td><?php echo $birthday; ?></td>
                                                    <td><?php echo $address; ?></td>
                                                    <td><?php echo $position; ?></td>
                                                    <td>
                                                        <a href="<?php echo SITEURL; ?>admin/update-staff.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>"><button class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Update"><i class="fa fa-pencil font-14"></i></button></a> 
                                                        <a href="<?php echo SITEURL; ?>admin/delete-staff.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button></a> 
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class='text-success'>Không có nhân viên.</div>
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