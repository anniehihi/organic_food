<?php include('partials-front/header2.php'); ?>
<section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Lọc</span>
                                    <select name="fetch" id="fetch">
                                        <option value="" disabled="" selected="">Chọn mục</option>
                                        <option value="Giá tăng dần">Giá tăng dần</option>
                                        <option value="Giá giảm dần">Giá giảm dần</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row fetch-cate">
					<?php
						if(isset($_POST['search'])){
							$search = $_POST['search'];
                            $sql2 = "SELECT * FROM tbl_product WHERE title LIKE '%$search%'";

							$res2 = mysqli_query($conn, $sql2);

							$count2 = mysqli_num_rows($res2);

							// $limit = 8;

							// $page = ceil($count2/$limit); 

							// $current_page = (isset($_GET['page']) ? $_GET['page']:1); 

							// $start = ($current_page - 1) * $limit;
	
							if($count2>0){
								while($row2=mysqli_fetch_assoc($res2)){
									$id = $row2['product_id']; 
									$title = $row2['title'];
									$price = $row2['price']; 
									$image_name = $row2['image_name'];
                                    
                                    ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product__item">
                                                <?php
														if($image_name == ""){
															echo "<div class='error'>Lỗi ảnh</div>";
														}else{
															?>
                                                                <div class="product__item__pic set-bg" data-setbg="<?php echo SITEURL; ?>image/product/<?php echo $image_name; ?>">
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
							}else{
							echo "Không có sản phẩm cần tìm !"; 
						}
						}
					?>
                    </div>
                    <!-- <div class="product__pagination">
                        <?php
							if($current_page - 1> 0){
								?>
		                			<a href="shop-grid.php?<?php if(isset($_GET['id'])){
										?>
											id=<?php echo $category_id; ?>&
										<?php
									}?>page=<?php echo $current_page - 1; ?>">&lt;</a>
								<?php
							}
						?>

                        
						<?php
							for($i = 1; $i<=$page; $i++){
								?>
		                			<a <?php echo ($current_page == $i)? 'active':'' ?> href="shop-grid.php?<?php if(isset($_GET['id'])){
										?>
											id=<?php echo $category_id; ?>&
										<?php
									}?>page=<?php echo $i; ?>"><?php echo $i; ?></a>
								<?php
							}
						?>

                        <?php
							if($current_page + 1 <= $page){
								?>
									<a href="shop-grid.php?<?php if(isset($_GET['id'])){
										?>
											id=<?php echo $category_id; ?>&
										<?php
									}?>page=<?php echo $current_page + 1; ?>">&gt;</a>
								<?php
							}
						?>
                        <!-- <a href="#"><i class="fa fa-long-arrow-right"></i></a> -->
                    </div> -->
                </div>
            </div>
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>