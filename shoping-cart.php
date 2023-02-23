<?php include('partials-front/header2.php'); ?>
<?php 
	$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : []; 

	// echo '<pre>'; 
	// print_r($cart);
	
?>	

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_price = 0; ?>
                                <?php foreach ($cart as $key => $value): 
									$total_price += ($value['price'] * $value['qty']);
                                    $_SESSION['total'] = $total_price;
								?>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="image/product/<?php echo $value['image_name']; ?> " width="170px" alt="">
                                        <h5><?php echo $value['title']; ?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?php echo number_format($value['price']); ?> VND
                                    </td>
                                    <form action="cart-action.php">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" name="quantity" value="<?php echo $value['qty']; ?>">
                                                </div>
                                            </div>
                                            <input type="submit"  value="Cập nhật"  class="cart-btn"></input>
                                        </td>
                                    </form>
                                    <td class="shoping__cart__total">
                                        <?php echo number_format($value['price'] * $value['qty']); ?> VND
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span><a href="cart-action.php?id=<?php echo $value['id']; ?>&action=delete" class="icon_close"></a></span>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Mã giảm giá</h5>
                            <input type="text" id='code'>
                            <button type="button" name="clickme" id="clickme" onclick="load_ajax()">Xác nhận</button>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Tổng đơn hàng</h5>
                        <ul>
                            <li>Tạm tính <span><?php echo number_format( $total_price ); ?> VND</span></li>
                            <li>Tổng <span><?php echo number_format( $total_price ); ?> VND</span></span></li>
                            <li id='ketqua'></li>
                        </ul>
                        <a href="checkout.php" class="primary-btn">Tiến hành thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
    <?php include('partials-front/footer.php'); ?>