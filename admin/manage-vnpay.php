<?php include('./partials/header.php'); ?>


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

            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Quản lý hình thức thanh toán VNPAY</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                </ol>
            </div>
            <div class="ibox">
            <div class="page-content fade-in-up">
                    <div class="ibox-body">
                        <table class="table" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Số tiền</th>
                                    <th>Ngân hàng</th>
                                    <th>Loại thẻ</th>
                                    <th>Thông tin</th>
                                    <th>Mã đơn</th>
                                </tr>
                            </thead>

                            <?php
                                // câu truy vấn để nhận giá trị của tất cả admin
                                $sql = "SELECT * FROM tbl_vnpay"; 

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
                                            $id = $rows['id']; 
                                            $total = $rows['vnp_amount']; 
                                            $bank = $rows['vnp_bankCode']; 
                                            $card = $rows['vnp_cardtype']; 
                                            $info = $rows['vnp_orderinfo']; 
                                            $code_order = $rows['code_order']; 

                                            // hiển thị giá trị trong bảng 
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $sn++; ?></td>
                                                    <td><?php echo $total; ?></td>
                                                    <td><?php echo $bank; ?></td>
                                                    <td><?php echo $card; ?></td>
                                                    <td><?php echo $info; ?></td>
                                                    <td><?php echo $code_order ?></td>
                                                    <td>
                                                        <a href="<?php echo SITEURL; ?>admin/delete-vnpay.php?id=<?php echo $id;?>"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Xoá"><i class="fa fa-trash font-14"></i></button></a>
                                                    </td>
                                                </tr>
                                            </tbody>
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