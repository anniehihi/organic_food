<?php include('./partials/header.php'); ?>

            <?php
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['no-category-found'])){
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
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
                <h1 class="page-title">Quản lý mã giảm giá</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                </ol>
            </div>


            <div class="page-content fade-in-up">
                <div class="ibox">
                <div class="ibox-head">
                    <a href="add-coupon.php"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Thêm"><i class="fa fa-plus font-14"></i></button></a>  
                </div>
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
                                    // if(isset($_GET['from_date']) && isset($_GET['to_date'])){
                                    //     $from_date = $_GET['from_date']; 
                                    //     $to_date = $_GET['to_date'];
                                    //     $sql = "SELECT * FROM tbl_coupon WHERE createdAt BETWEEN '$from_date' AND '$to_date'";
                                    // }else{
                                        $sql = "SELECT * FROM tbl_coupon";
                                    // }
                                        
                                        $res = mysqli_query($conn, $sql); 
                                        $count = mysqli_num_rows($res); 
                                        $sn = 1; 
    
                                        if($count > 0){
                                            while($row = mysqli_fetch_assoc($res)){
                                                $id = $row['coupon_id']; 
                                                $code = $row['code']; 
                                                $percent = $row['percent']; 
                                                $time = $row['time'];
                                                $createdAt = $row['createdAt'];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sn++; ?></td>
                                                        <td><?php echo $code; ?></td>
                                                        <td><?php echo $percent;  ?>%</td>
                                                        <td><?php echo $createdAt; ?></td>
                                                        <td><?php echo $time; ?></td>
                                                        <td>
                                                            <a href="<?php echo SITEURL; ?>admin/update-coupon.php?id=<?php echo $id;?>"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Update"><i class="fa fa-pencil font-14"></i></button></a> 
                                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class='text-success'>Không có mã giảm giá</div>
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
    </div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="example-table_info" role="status" aria-live="polite"></div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        



    <!-- BEGIN THEME CONFIG PANEL-->

    <?php include('./partials/footer.php') ?>