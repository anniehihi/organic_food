<?php
    include('config/constants.php');
?>
<?php
    // if(isset($_POST['submit'])){
        $codePost = isset($_POST['code']) ? $_POST['code'] : false;

        $sql = "SELECT * FROM tbl_coupon WHERE code = '$codePost'";

        $res = mysqli_query($conn, $sql); 

        $count = mysqli_num_rows($res);

        if($count > 0){
            $row = mysqli_fetch_assoc($res);
            $coupon_id = $row['coupon_id'];
            $percent = $row['percent'];
            $createdAt = $row['createdAt']; 
            $time = $row['time'];
            $exp = strtotime($time);
            $td = strtotime($createdAt);

            if($td < $exp){
                $tam = ($percent / 100) * $_SESSION['total'] ;
                $last = $_SESSION['total']  - $tam;
                $_SESSION['total_percent'] = $last;
                ?>

                <li class='percent'>Giá sau khi giảm <span>
                <?php 
                    if(isset($last)){
                        echo number_format( $last ); 
                    }
                ?> VND</span></span>
                </li>
                <?php
            }else{
                echo 'Mã giảm giá hết thời gian sử dụng hoặc không tồn tại';
            }


        }
    // };
?>