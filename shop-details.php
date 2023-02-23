<?php include('partials-front/header2.php'); ?>
<?php
	if(isset($_SESSION['add'])){
		echo $_SESSION['add'];
		unset($_SESSION['add']);
	}
?>
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <?php
                        if(isset($_GET['id'])){
                            $id = $_GET['id']; 

                            $sql2= "UPDATE tbl_product SET view = view + 1 WHERE product_id= $id";

                            $res2 = mysqli_query($conn, $sql2); 

                            $sql = "SELECT * FROM tbl_product WHERE product_id = $id"; 

                            $res = mysqli_query($conn, $sql); 

                            $count = mysqli_num_rows($res); 


                            if($count  == 1){
                                $row = mysqli_fetch_assoc($res); 
                                // var_dump($row);
                                $title = $row['title']; 
                                $price = $row['price']; 
                                $description = $row['description']; 
                                $author = $row['author']; 
                                $image_name = $row['image_name'];
                            }else{
                                // chuyến hướng đến trang sản phẩm
                                echo("<script>location.href = '".SITEURL."shop.php';</script>");
                            }
                        }else{
                            // chuyến hướng đến trang sản phẩm
                            echo("<script>location.href = '".SITEURL."shop.php';</script>");
                        }
                    ?>
                    <div class="product__details__pic">
                        <?php
                            ?>
                                <div class="product__details__pic__item">
                                    <img class="product__details__pic__item--large"
                                        src="image/product/<?php echo $image_name; ?>" alt="">
                                </div>
                            <?php
                        ?>
                        <!-- <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/product/details/product-details-2.jpg"
                                src="img/product/details/thumb-1.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-3.jpg"
                                src="img/product/details/thumb-2.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-5.jpg"
                                src="img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                src="img/product/details/thumb-4.jpg" alt="">
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $title; ?></h3>
                        <h3>Tác giả: <?php echo $author; ?></h3>
                        <div class="product__details__price"><?php echo number_format($price); ?> VND</div>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <form method="GET" action="cart-action.php">
                                    <div class="pro-qty">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="number" name="quantity" value="1">
                                    </div>
                                    
                                </div>
                            </div>
                            <button class="primary-btn">Thêm vào giỏ hàng</button>
                        </form>
                        <ul>
                            <li><b>Trạng thái</b> <span>Còn hàng</span></li>
                            <li><b>Giao hàng</b> <span>Miễn phí giao hàng toàn quốc</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Miêu tả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Đánh giá <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Mô tả về sản phẩm</h6>
                                    <p><?php echo $description ?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Đánh giá sản phẩm</h6>
                                    <?php
											$sql2 = "SELECT * FROM tbl_reviews where product_id = $id"; 

											$res2 = mysqli_query($conn, $sql2); 

											$count2 = mysqli_num_rows($res2); 

											if($count2>0){
												while($row2 = mysqli_fetch_assoc($res2)){
													$username = $row2['username']; 
													$review = $row2['content'];
													?>
                                                        <p><?php echo $username?>: <?php echo $review ?></p>
													<?php
												}
											}
									   ?>
                                    <form action="" method="POST">
                                        <input type="text" name="content" placeholder="Viết đánh giá ở đây">
                                        <button type="submit" name="submit" class="primary-btn">Xác nhận</button>
                                    </form>
                                    <?php
											if(isset($_POST['submit'])){
												if(isset($_SESSION['user'])){
													$user = $_SESSION['user']; 
													$content = $_POST['content']; 
													
	
													$sql2 = "INSERT INTO tbl_reviews SET
														username = '$user', 
														content = '$content', 
														product_id = '$id'
													";
	
													$res2 = mysqli_query($conn, $sql2); 
	
													if($res2 == TRUE){
														// tạo sesion lưu thông báo 
														$_SESSION['add'] = "<p class='text-success'>Viết đánh giá thành công</p>";
													}else{
														// tạo sesion lưu thông báo 
														$_SESSION['add'] = "<p class='text-success'>Lỗi viết đánh giá</p>";
													}
												}else{											
													echo '<script>alert("Bạn cần đăng nhập để đánh giá sản phẩm này!")</script>';
												}
											}
										?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $cate_id = $_GET['cat_id'];
                    $prouct  = $_GET['id'];

                    $sql2 = "SELECT * FROM tbl_product WHERE featured = 'Yes' AND active = 'Yes' AND category_id = $cate_id LIMIT 4 ";
                    $res2= mysqli_query($conn, $sql2);

                    $count2 = mysqli_num_rows($res2);
                    if($count2>0){
                        while($row2=mysqli_fetch_assoc($res2)){
                            $id = $row2['product_id']; 
                            $title = $row2['title']; 
                            $price = $row2['price']; 
                            $image_name = $row2['image_name'];
                            ?>
                                <?php
                                ?>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="product__item">
                                        <?php
                                            if($image_name == ""){
                                                echo "<div class='error'>Image not Available</div>";
                                            }else{
                                                ?>
                                                <div class="product__item__pic set-bg" data-setbg="image/product/<?php echo $image_name; ?>">
                                                    <ul class="product__item__pic__hover">
                                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                    </ul>
                                                </div>
                                            <?php
                                            }
                                        ?>

                                        <div class="product__item__text">
                                            <h6><a href="#"><?php echo $title; ?></a></h6>
                                            <h5><?php echo number_format($price); ?> VND</h5>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }

                ?>

            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    <?php include('partials-front/footer.php'); ?>