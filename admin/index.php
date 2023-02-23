<?php 
    include('./partials/header.php');
?>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-success color-white widget-stat">
                            <div class="ibox-body">
                                <?php
                                    $sql2 = "SELECT * FROM tbl_order";
                                    $res2 = mysqli_query($conn, $sql2); 
                                    $count2 = mysqli_num_rows($res2);
                                ?>
                                <h2 class="m-b-5 font-strong"><?php echo $count2 ?></h2>
                                <div class="m-b-5">ĐƠN ĐẶT HÀNG</div><i class="ti-shopping-cart widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-info color-white widget-stat">
                            <div class="ibox-body">
                                <?php
                                    $sql = "SELECT * FROM tbl_category";
                                    $res = mysqli_query($conn, $sql); 
                                    $count = mysqli_num_rows($res);
                                ?>
                                <h2 class="m-b-5 font-strong"><?php echo $count; ?></h2>
                                <div class="m-b-5">DANH MỤC SẢN PHẨM</div><i class="ti-bar-chart widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-warning color-white widget-stat">
                            <div class="ibox-body">
                                <?php
                                    $sql3 = "SELECT * FROM tbl_product";
                                    $res3 = mysqli_query($conn, $sql3); 
                                    $count3 = mysqli_num_rows($res3);
                                ?>
                                <h2 class="m-b-5 font-strong"><?php echo $count3 ?></h2>
                                <div class="m-b-5">SẢN PHẨM</div><i class="fa fa-money widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-warning color-white widget-stat">
                            <div class="ibox-body">
                                <?php
                                    $sql5 = "SELECT * FROM tbl_coupon";
                                    $res5 = mysqli_query($conn, $sql5); 
                                    $count5 = mysqli_num_rows($res5);
                                ?>
                                <h2 class="m-b-5 font-strong"><?php echo $count3 ?></h2>
                                <div class="m-b-5">MÃ GIẢM GIÁ</div><i class="fa fa-money widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-danger color-white widget-stat">
                            <div class="ibox-body">
                                <?php
                                    $sql4 = "SELECT * FROM tbl_register";
                                    $res4 = mysqli_query($conn, $sql4); 
                                    $count4 = mysqli_num_rows($res4);
                                ?>
                                <h2 class="m-b-5 font-strong"><?php echo $count4 ?></h2>
                                <div class="m-b-5">NGƯỜI DÙNG MỚI</div><i class="ti-user widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <!-- END THEME CONFIG PANEL-->
    <?php include('./partials/footer.php') ?>