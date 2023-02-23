 <?php
    include('config/constants.php');
    if(isset($_POST['request'])){
        $request = $_POST['request'];
        if($request == 'Giá tăng dần'){
            $sql = "SELECT * FROM tbl_product ORDER BY price ASC";
        }else{
            $sql = "SELECT * FROM tbl_product ORDER BY price DESC";
        }
        $res = mysqli_query($conn, $sql); 
        $count = mysqli_num_rows($res); 
        if($count>0){
            while($row=mysqli_fetch_assoc($res)){
                $id = $row['product_id']; 
                $title = $row['title'];
                $price = $row['price']; 
                $image_name = $row['image_name'];
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                        <?php
                            if($image_name == ""){
                                echo "<div class='error'>Lỗi ảnh</div>";
                            }else{
                                ?>
                                    <div class="product__item__pic set-bg">
                                        <img src="<?php echo SITEURL; ?>image/product/<?php echo $image_name; ?>"d alt="">
                                
                                <?php
                            }
                        ?>

                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="cart-action.php?id=<?php echo $id; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#"><?php echo $title; ?></a></h6>
                                <h5><?php echo number_format($price); ?> VND</h5>
                            </div>
                        </div>
                    </div>
                <?php
            }
        }
    }


?>