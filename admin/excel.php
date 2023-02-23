<?php
    include('../config/constants.php');
?>
<?php
    $output = "";
    if(isset($_POST['export_exel'])){
        $sql = "SELECT * FROM tbl_order ORDER BY order_id DESC"; 
         
        $res = mysqli_query($conn, $sql); 

        if(mysqli_num_rows($res) > 0){
            $output .= '
                <table>
                    <tr>
                        <th>ID Đơn hàng</th>
                        <th>ID Người mua</th>
                        <th>Trạng thái</th>
                        <th>Họ và Tên</th>
                        <th>Địa chỉ</th>
                        <th>Thành phố</th>
                        <th>Huyện</th>
                        <th>Xã</th>
                        <th>Số điện thoại</th>
                        <th>Tổng tiền</th>
                        <th>Ngày tạo đơn hàng</th>
                    </tr>
            ';
            while($row = mysqli_fetch_array($res)){
                $output .= '
                    <tr>
                        <td>'.$row['order_id'].'</td>
                        <td>'.$row['user_id'].'</td>
                        <td>'.$row['status'].'</td>
                        <td>'.$row['full_name'].'</td>
                        <td>'.$row['address'].'</td>
                        <td>'.$row['city'].'</td>
                        <td>'.$row['distric'].'</td>
                        <td>'.$row['ward'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>'.$row['total'].'</td>
                        <td>'.$row['order_date'].'</td>
                    </tr>
                ';                
            }
            $output .= '</table>';
            header("Content-Type: application/xls"); 
            header("Content-Disposition:attachment; filename=download.xls"); 
            echo $output;
        }
    }
?>