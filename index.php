<?php include('partials-front/header2.php'); ?>
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <?php
                        $sql = "SELECT * FROM tbl_category WHERE featured = 'Yes' AND active = 'Yes'  LIMIT 5 ";
                        $res= mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
						if($count>0){
							while($row=mysqli_fetch_assoc($res)){
								$id = $row['category_id']; 
								$title = $row['title']; 
								$image_name = $row['image_name'];
                                ?>
                                    <div class="col-lg-3">
                                        <?php
                                            if($image_name==""){
                                                echo "<div class='error'>Image not Available</div>";
                                            }else{
                                                ?>
                                                    <div class="categories__item set-bg" data-setbg="image/category/<?php echo $image_name; ?>">
                                                
                                                    </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm nổi bật</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php
                    $sql2 = "SELECT * FROM tbl_product WHERE featured = 'Yes' AND active = 'Yes'  LIMIT 8 ";
                    $res2= mysqli_query($conn, $sql2);

                    $count2 = mysqli_num_rows($res2);
                    if($count2>0){
                        while($row2=mysqli_fetch_assoc($res2)){
                            $id = $row2['product_id']; 
                            $title = $row2['title']; 
                            $price = $row2['price']; 
                            $cate_id = $row2['category_id']; 
                            $image_name = $row2['image_name'];
                            ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                                    <div class="featured__item">
                                        <?php
                                            if($image_name == ""){
                                                echo "<div class='error'>Image not Available</div>";
                                            }else{
                                                ?>
                                                    <div class="featured__item__pic set-bg" data-setbg="image/product/<?php echo $image_name; ?>">
                                                        <ul class="featured__item__pic__hover">
                                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="cart-action.php?id=<?php echo $id; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                <?php
                                            }

                                        ?>
                                        <div class="featured__item__text">
                                            <h6><a href="shop-details.php?id=<?php echo $id; ?>&cat_id=<?php echo $cate_id; ?>"><?php echo $title; ?></a></h6>
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
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <!-- <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Mới nhất</h4>
                        <?php
                            $sql3 = "SELECT * FROM tbl_product WHERE featured = 'Yes' AND active = 'Yes'  LIMIT 9 ";
                            $res3 = mysqli_query($conn, $sql3);

                            $count3 = mysqli_num_rows($res3);
                            if($count3>0){
                                while($row3=mysqli_fetch_assoc($res3)){
                                    $id = $row3['product_id']; 
                                    $title = $row3['title']; 
                                    $price = $row3['price']; 
                                    $image_name = $row3['image_name'];
                                    ?>
                                        <div class="latest-product__slider owl-carousel">
                                            <div class="latest-prdouct__slider__item">
                                                    <?php
                                                        if($image_name == ""){
                                                            echo "<div class='error'>Image not Available</div>";
                                                        }else{
                                                            ?>
                                                                <div class="latest-product__item__pic">
                                                                    <img src="image/product/<?php echo $image_name; ?>" alt="">
                                                                </div>
                                                            <?php
                                                        }
                                                    ?>

                                                    <div class="latest-product__item__text">
                                                        <h6><a href="shop-details.php?id=<?php echo $id; ?>&cat_id=<?php echo $cate_id; ?>"><?php echo $title; ?></a></h6>
                                                        <span><?php echo number_format($price); ?> VND</span>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Nhiều lượt xem nhất</h4>
                        <?php
                            $sql3 = "SELECT * FROM tbl_product WHERE featured = 'Yes' AND active = 'Yes' ORDER BY view DESC LIMIT 9 ";
                            $res3 = mysqli_query($conn, $sql3);

                            $count3 = mysqli_num_rows($res3);
                            if($count3>0){
                                while($row3=mysqli_fetch_assoc($res3)){
                                    $id = $row3['product_id']; 
                                    $title = $row3['title']; 
                                    $price = $row3['price']; 
                                    $cate_id = $row3['category_id']; 
                                    $image_name = $row3['image_name'];
                                    ?>
                                        <div class="latest-product__slider owl-carousel">
                                            <div class="latest-prdouct__slider__item">
                                                    <?php
                                                        if($image_name == ""){
                                                            echo "<div class='error'>Image not Available</div>";
                                                        }else{
                                                            ?>
                                                                <div class="latest-product__item__pic">
                                                                    <img src="image/product/<?php echo $image_name; ?>" alt="">
                                                                </div>
                                                            <?php
                                                        }
                                                    ?>

                                                    <div class="latest-product__item__text">
                                                        <h6><a href="shop-details.php?id=<?php echo $id; ?>&cat_id=<?php echo $cate_id; ?>"><?php echo $title; ?></a></h6>
                                                        <span><?php echo number_format($price); ?> VND</span>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div> 
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->


    <?php include('partials-front/footer.php'); ?>