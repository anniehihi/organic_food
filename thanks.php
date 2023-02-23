<?php include('partials-front/header2.php'); ?>

<?php 
	$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : []; 
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    }
?>
<?php
    if(isset($_GET['vnp_Amount'])){
        $vnp_Amount = $_GET['vnp_Amount']; 
        $vnp_BankCode = $_GET['vnp_BankCode']; 
        $vnp_BankTranNo = $_GET['vnp_BankTranNo']; 
        $vnp_OrderInfo = $_GET['vnp_OrderInfo']; 
        $vnp_PayDate = $_GET['vnp_PayDate']; 
        $vnp_TmnCode = $_GET['vnp_TmnCode']; 
        $vnp_TransactionNo = $_GET['vnp_TransactionNo']; 
        $vnp_CardType = $_GET['vnp_CardType']; 
        $order_id =  $_SESSION['code_cart'];

        $sql = "INSERT INTO tbl_vnpay SET
        vnp_amount = '$vnp_Amount',
        vnp_bankCode='$vnp_BankCode',
        vnp_banktranno = '$vnp_BankTranNo',
        vnp_cardtype = '$vnp_CardType', 
        vnp_orderinfo = '$vnp_OrderInfo', 
        vnp_paydate = '$vnp_PayDate', 
        vnp_tmncode = '$vnp_TmnCode', 
        vnp_transactionno = '$vnp_TransactionNo', 
        code_order = '$order_id'";

        $res = mysqli_query($conn, $sql);

        if($res==true){
            // tạo sesion lưu thông báo 
            echo "<p class='text-success'>Giao dịch thành công</p>";
        }else{
            echo "<p class='text-error'>Giao dịch thất bại</p>";
        }
    }elseif(isset($_GET['partnerCode'])){
        $codeOder = rand(0,9999);
        $partnerCode = $_GET['partnerCode']; 
        $orderId = $_GET['orderId']; 
        $amount = $_GET['amount']; 
        $orderInfo = $_GET['orderInfo']; 
        $orderType = $_GET['orderType']; 
        $transId = $_GET['transId']; 
        $payType = $_GET['payType']; 

        $sql = "INSERT INTO tbl_momo SET
        partnerCode = '$partnerCode',
        orderId='$orderId',
        amount = '$amount',
        orderInfo = '$orderInfo', 
        orderType = '$orderType', 
        transId = '$transId', 
        payType = '$payType', 
        code_order = '$codeOder'";

        $res = mysqli_query($conn, $sql);

        if($res==true){
            ?>
                <?php $price_total = 0 ?>
                <?php foreach ($cart as $key => $value): 
                    $price_total += ($value['price'] * $value['qty']);
                ?>
                <?php endforeach ?>
            <?php
                    $status = 'Chờ xác nhận';

                    $sql = "INSERT INTO tbl_order SET
                    user_id = '$user_id', 
                    status = '$status',
                    code_order = '$codeOder',
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
            // tạo sesion lưu thông báo 
            echo "<p class='text-success'>Giao dịch thành công</p>";
        }else{
            echo "<p class='text-error'>Giao dịch thất bại</p>";
        }
    }
?>

<?php include('partials-front/footer.php'); ?>