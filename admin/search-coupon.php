<?php include('./partials/header.php'); ?>
            <!-- START PAGE CONTENT-->
            <form action="search-coupon.php" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group pl-4">
                                <label>Tìm kiếm mã giảm giá</label>
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
                                    <th>Mã CODE</th>
                                    <th>Phần trăm giảm giá</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                  if(isset($_POST['search'])){
                                    $search = $_POST['search'];
                                    $sql = "SELECT * FROM tbl_coupon WHERE code LIKE '%$search%'";
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
                                            $id = $row['coupon_id']; 
                                            $code = $row['code']; 
                                            $percent = $row['percent']; 
                                            $time = $row['time']; 
                                            $createdAt = $row['createdAt'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $sn++; ?></td>
                                                    <td><?php echo $code; ?></td>
                                                    <td><?php echo $percent; ?></td>
                                                    <td><?php echo $createdAt; ?></td>
                                                    <td><?php echo $time; ?></td>
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
                                                    <div class='text-success'>Không có mã giảm giá.</div>
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