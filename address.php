<?php include('partials-front/header2.php'); ?>

<?php 
	$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : []; 

	// echo '<pre>'; 
	// print_r($cart);
	
?>	

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Fahasa</h2>
                        <div class="breadcrumb__option">
                            <span>Thanh toán</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Thêm địa chỉ</h4>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>Họ và Tên<span>*</span></p>
                                <input type="text" name="full_name">
                            </div>
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" name="email">
                            </div>
                            <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input type="number" name="phone">
                            </div>
                            <div class="checkout__input">
                                <p>Tỉnh/Thành Phố<span>*</span></p>
                                <input type="text" name="city">
                            </div>
                            <div class="checkout__input">
                                <p>Quận/Huyện<span>*</span></p>
                                <input type="text" name="distric">
                            </div>
                            <div class="checkout__input">
                                <p>Phường/Xã<span>*</span></p>
                                <input type="text" name="ward">
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ nhận hàng<span>*</span></p>
                                <input type="text" name="address">
                            </div>
                            <input type="submit" class="site-btn" name="add_address" value="THEM"></input>
                        </div>
                    </div>
                </form>
                <?php
                    if(isset($_GET['id'])){
                        $user_id = $_GET['id']; 
                    }
			    ?>
                <?php
                    if(isset($_POST['add_address'])){
                        if(isset($_SESSION['user'])){
                            $user_id; 
                            $full_name = $_POST['full_name']; 
                            $email = $_POST['email'];
                            $phone = $_POST['phone']; 
                            $city = $_POST['city']; 
                            $distric = $_POST['distric']; 
                            $ward = $_POST['ward']; 
                            $address = $_POST['address']; 
        
                            $sql = "INSERT INTO tbl_address SET 
                                user_id = '$user_id', 
                                full_name = '$full_name', 
                                email = '$email'
                                phone = '$phone', 
                                city = '$city', 
                                distric = '$distric', 
                                ward = '$ward', 
                                address = '$address', 
                            "; 
        
                            $res = mysqli_query($conn, $sql); 
                            
                            if($res == TRUE){
                                // tạo sesion lưu thông báo 
                                $_SESSION['add_address'] = "<p class='text-success'>Thêm địa chỉ thành công</p>";
                                // chuyến hướng đến trang manage
                                echo("<script>location.href = '".SITEURL."';</script>");
                            }else{
                                // tạo sesion lưu thông báo 
                                $_SESSION['add_address'] = "<p class='text-error'>Lỗi thêm đại chỉ</p>";
                                // chuyến hướng đến trang manage
                                echo("<script>location.href = '".SITEURL."';</script>");
                            }
                        }else{
                            echo '<script>alert("Bạn cần đăng nhập để thêm địa chỉ!")</script>';
                        }
                    }
                ?>


            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    <?php include('partials-front/footer.php'); ?>