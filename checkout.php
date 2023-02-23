<?php include('partials-front/header2.php'); ?>

<?php
    require('./mail/sendmail.php');
    require_once('./config_vnpay.php');
?>

<?php 
	$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : []; 

	// echo '<pre>'; 
	// print_r($cart);
	
?>	
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Có phiếu giảm giá? <a href="#">Bấm vào đây</a> để nhập mã giảm giá
                    </h6>
                </div>
            </div>

            <?php
		if(isset($_SESSION['id'])){
			$user_id = $_SESSION['id'];
		}

        ?>
            <?php $price_total = 0 ?>
            <?php foreach ($cart as $key => $value): 
                $price_total += ($value['price'] * $value['qty']);
            ?>
            <?php endforeach ?>
        <?php
		
		if(isset($_POST['redirect'])){
			if(isset($_SESSION['user'])){
				$user_id; 
				$status = 'Chờ xác nhận';		
                $code_order = rand(0, 99999);	
				$full_name = $_POST['full_name']; 
				$address = $_POST['address']; 
				$city = $_POST['city'];
				$distric = $_POST['distric'];
				$ward = $_POST['ward'];
				$phone = $_POST['phone'];
                $email = $_POST['email'];
                $order_date = date("Y-m-d h:i:sa"); 
                if(isset($_POST['payment'])&&$_POST['payment'] == 'COD'){
                    $pay_method = 'COD'; 
                }elseif(isset($_POST['payment'])&&$_POST['payment'] == 'VN_PAY'){
                    $pay_method = 'VN PAY';
                    $vnp_TxnRef = $code_order; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
                    $vnp_OrderInfo = 'Thanh toán đơn hàng của Fahasa';
                    $vnp_OrderType = 'billpayment';
                    $vnp_Amount = $price_total * 100;
                    $vnp_Locale = 'vn';
                    $vnp_BankCode = 'NCB';
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                    //Add Params of 2.0.1 Version
                    $vnp_ExpireDate = $expire;

                    $inputData = array(
                        "vnp_Version" => "2.1.0",
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => $vnp_Locale,
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => $vnp_OrderType,
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TxnRef" => $vnp_TxnRef,
                        "vnp_ExpireDate"=>$vnp_ExpireDate
                    );

                    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                        $inputData['vnp_BankCode'] = $vnp_BankCode;
                    }
                    ksort($inputData);
                    $query = "";
                    $i = 0;
                    $hashdata = "";
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) {
                            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                        } else {
                            $hashdata .= urlencode($key) . "=" . urlencode($value);
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }

                    $vnp_Url = $vnp_Url . "?" . $query;
                    if (isset($vnp_HashSecret)) {
                        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                    }
                    $returnData = array('code' => '00'
                        , 'message' => 'success'
                        , 'data' => $vnp_Url);
                        if (isset($_POST['redirect'])) {

                            $_SESSION['code_cart'] = $code_order;

                            ?>
                                <?php $price_total = 0 ?>
                                <?php foreach ($cart as $key => $value): 
                                    $price_total += ($value['price'] * $value['qty']);
                                ?>
                                <?php endforeach ?>
                            <?php

                            $sql = "INSERT INTO tbl_order SET
                                user_id = '$user_id', 
                                status = '$status',
                                code_order = '$code_order',
                                full_name ='$full_name', 
                                address = '$address', 
                                city = '$city', 
                                distric = '$distric', 
                                ward = '$ward',
                                phone = '$phone',
                                email = '$email',
                                total = '$price_total',
                                pay_method = '$pay_method',
                                order_date = '$order_date'
                            ";

                            $res = mysqli_query($conn, $sql);
                            if($res==TRUE){
                                // $id = mysqli_insert_id($conn);
                                ?>
                                    <?php
                                        $sql2 = "SELECT * FROM tbl_order"; 
                                        $res2 = mysqli_query($conn, $sql2); 
                                        if($res2 == TRUE){
                                            $rows2 = mysqli_num_rows($res2);
                                            while($rows2 = mysqli_fetch_assoc($res2)){
                                                $order_id = $rows2['order_id'];
                                                $_SESSION['order_id'] = $order_id;
                                            }
                                        }
                                    ?>
                                <?php
                                foreach($cart as $value){
                                    mysqli_query($conn, "INSERT INTO tbl_order_detail(order_id, product_id, product_name, image_name, qty, price) VALUES ('$order_id','$value[id]','$value[title]', '$value[image_name]', '$value[qty]', '$value[price]')");
                                }
                                $tieude = 'Fahasa đã nhận đơn hàng '.$order_id; 
                                foreach($cart as $val){
                                    $noidung =  "
                                        <ul style='list-style: none'>
                                            <li>Xin chào $full_name</li>
                                            <li>Fahasa đã nhận được yêu cầu của bạn và đang xử lý nhé. Bạn sẽ nhận được thông báo tiếp theo
                                            khi đơn hàng được giao.</li>
            
                                            <li>Đơn hàng được giao đến</li>
                                            <li>Tên: $full_name</li>
                                            <li>Địa chỉ: $address, $ward, $distric, $city</li>
                                            <li>Điện thoại: $phone</li>
                                            <li>Email: $email</li>
            
                                            <li>Kiện hàng</li>
                                            <li>Được bán bởi: Fahasa</li>
                                            <li>Tên sản phẩm: ".$val['title']."</li>
                                            <li>Giá tiền: ". number_format($val['price'])." VNĐ</li>
                                            <li>Số lượng: ".$val['qty']."</li>
                                        </ul>
                                    ";
                                }
            
                                $maildathang = $email;
                                $mail = new Mailer();
                                $mail->dathangmail($tieude, $noidung, $maildathang);
                                unset($_SESSION['cart']);
                                unset($_SESSION['total']);
                                unset($_SESSION['total_percent']);
                            }
                            echo("<script>location.href = '".$vnp_Url."';</script>");
                            die();
                        } else {
                            echo json_encode($returnData);
                        }
                }

				?>
					<?php $price_total = 0 ?>
					<?php 
                        if(isset(($_SESSION['total_percent']))){
                            $price_total = $_SESSION['total_percent'];
                        }else{
                            $price_total = $_SESSION['total_percent'];
                        }
					?>
				<?php
	
				$sql = "INSERT INTO tbl_order SET
					user_id = '$user_id', 
					status = '$status',
                    code_order = '$code_order',
					full_name ='$full_name', 
					address = '$address', 
					city = '$city', 
					distric = '$distric', 
					ward = '$ward',
					phone = '$phone',
                    email = '$email',
					total = '$price_total',
                    pay_method = '$pay_method',
					order_date = '$order_date'
				";
	
				$res = mysqli_query($conn, $sql);
	
				if($res==TRUE){
					?>
						<?php
							$sql2 = "SELECT * FROM tbl_order"; 
							$res2 = mysqli_query($conn, $sql2); 
							if($res2 == TRUE){
								$rows2 = mysqli_num_rows($res2);
								while($rows2 = mysqli_fetch_assoc($res2)){
									$order_id = $rows2['order_id'];
                                    $_SESSION['order_id'] = $order_id;
								}
							}
						?>
					<?php
					foreach($cart as $value){
						mysqli_query($conn, "INSERT INTO tbl_order_detail(order_id, product_id, product_name, image_name, qty, price) VALUES ('$order_id','$value[id]','$value[title]', '$value[image_name]', '$value[qty]', '$value[price]')");
					}
                    $tieude = 'Fahasa đã nhận đơn hàng '.$order_id; 
                    foreach($cart as $val){
                        $noidung =  "
                            <ul style='list-style: none'>
                                <li>Xin chào $full_name</li>
                                <li>Fahasa đã nhận được yêu cầu của bạn và đang xử lý nhé. Bạn sẽ nhận được thông báo tiếp theo
                                khi đơn hàng được giao.</li>

                                <li>Đơn hàng được giao đến</li>
                                <li>Tên: $full_name</li>
                                <li>Địa chỉ: $address, $ward, $distric, $city</li>
                                <li>Điện thoại: $phone</li>
                                <li>Email: $email</li>

                                <li>Kiện hàng</li>
                                <li>Được bán bởi: Fahasa</li>
                                <li>Tên sản phẩm: ".$val['title']."</li>
                                <li>Giá tiền: ".number_format($val['price'])." VNĐ</li>
                                <li>Số lượng: ".$val['qty']."</li>
                            </ul>
                        ";
                    }

                    $maildathang = $email;
                    $mail = new Mailer();
                    $mail->dathangmail($tieude, $noidung, $maildathang);
					unset($_SESSION['cart']);
                    unset($_SESSION['total']);
                    unset($_SESSION['total_percent']);
					echo("<script>location.href = '".SITEURL."index.php';</script>");
				}
			}else{
				echo '<script>alert("Bạn cần đăng nhập để mua hàng!")</script>';				
			}
			
		}
	?>
            <div class="checkout__form">
                <h4>Chi tiết thanh toán</h4>
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
                            <div class="checkout__input">
                                <p>Ghi chú<span>*</span></p>
                                <input type="text"
                                    placeholder="Ghi chú về đơn đặt hàng VD: thời gian giao hàng,...">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Giá</span></div>
                                <ul>
                                    <?php
                                        foreach($cart as $key => $item){
                                            ?>
                                                <li><?php echo $item['title'] ?><span><?php echo number_format($item['price']); ?> VND</span></li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                                <!-- <div class="checkout__order__total">Giá gốc <span><?php if(isset($_SESSION['total'])){echo number_format($_SESSION['total']);}else{echo '0';}?> VND</span></div> -->
                                <div class="checkout__order__subtotal">Tổng <span>
                                    <?php 
                                        if(isset($_SESSION['total'])){
                                            echo number_format($_SESSION['total']);
                                        }
                                    ?> VND</span></div>
                                <div class="checkout__order__subtotal">Giá sau khi giảm <span>
                                    <?php 
                                        if(isset($_SESSION['total_percent'])){
                                            echo number_format($_SESSION['total_percent']);
                                        }
                                    ?> VND</span></div>
                                <div class="checkout__input__checkbox">
                                    <label for="cod">
                                        Thanh toán khi nhận hàng
                                        <input type="checkbox" id="cod" name="payment" value="COD">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="vn_pay">
                                        VN PAY
                                        <input type="checkbox" id="vn_pay" name="payment" value="VN_PAY">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox"></div>
                                <input type="submit" class="site-btn" name="redirect" id="redirect" value="ĐẶT HÀNG"></input>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    <?php include('partials-front/footer.php'); ?>