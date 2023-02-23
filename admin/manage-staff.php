<?php include('./partials/header.php'); ?>

            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>

            <?php
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            ?>

            <?php
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>

            <?php
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
            ?>

            <?php
                if(isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }
            ?>

            <?php
                if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
            ?>

            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Quản lý nhân viên</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                </ol>
            </div>
            <div class="ibox">
                <div class="ibox-head">
                    <a href="add-staff.php"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Add"><i class="fa fa-plus font-14"></i></button></a>
                </div>
                <div class="page-content fade-in-up">
                    <form action="search_staff.php" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group pl-4">
                                    <label>Tìm kiếm nhân viên</label>
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
                                    <th>Họ và Tên</th>
                                    <th>Hình ảnh</th>
                                    <th>Giới tính</th>
                                    <th>Liên hệ</th>
                                    <th>Năm sinh</th>
                                    <th>Địa chỉ</th>
                                    <th>Chức vụ</th>
                                </tr>
                            </thead>

                            <?php
                                // câu truy vấn để nhận giá trị của tất cả admin
                                $sql = "SELECT * FROM tbl_staff"; 

                                // thực thi truy vấn 
                                $res = mysqli_query($conn, $sql); 

                                // kiểm tra xem truy vấn có thực hiện không
                                if($res == TRUE){
                                    // đếm xem có dữ liệu trong cơ sở dữ liệu hay không 
                                    $rows = mysqli_num_rows($res); // hàm lấy tất cả dữ liệu trong database

                                    $sn = 1;

                                    // kiểm tra số hàng
                                    if($rows > 0){
                                        // có cơ sở dữ liệu trong dữ liệu
                                        while($rows = mysqli_fetch_assoc($res)){
                                            // sử dụng vòng lặp while để lấy tất cả dữ liệu từ cơ sở dữ liệu 
                                            // vòng lặp while chạy khi chúng ta có dữ liệu trong cơ sở dữ liệu

                                            // lấy dữ liệu 
                                            $id = $rows['staff_id']; 
                                            $full_name = $rows['full_name']; 
                                            $image_name = $rows['image_name']; 
                                            $gender = $rows['gender']; 
                                            $contact = $rows['contact']; 
                                            $birthday = $rows['birthday']; 
                                            $address = $rows['address']; 
                                            $position = $rows['position']; 

                                            // hiển thị giá trị trong bảng 
                                            ?>
                                            <tbody>
                                                <tr  class="fecth">
                                                    <td><?php echo $sn++; ?></td>
                                                    <td><?php echo $full_name; ?></td>
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
                                                    <td><?php echo $gender ?></td>
                                                    <td><?php echo $contact ?></td>
                                                    <td><?php echo $birthday ?></td>
                                                    <td><?php echo $address ?></td>
                                                    <td><?php echo $position ?></td>
                                                    <td>
                                                        <a href="<?php echo SITEURL; ?>admin/update-staff.php?id=<?php echo $id;?>"><button class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Update"><i class="fa fa-pencil font-14"></i></button></a> 
                                                        <a href="<?php echo SITEURL; ?>admin/delete-staff.php?id=<?php echo $id;?>"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <p class="fetch">

                                            </p>
                                            <?php
                                        }
                                    }else{

                                    }
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>

            <!-- END PAGE CONTENT-->
        </div>
<?php include('./partials/footer.php') ?>