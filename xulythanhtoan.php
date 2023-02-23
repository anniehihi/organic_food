<?php
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    }
    $code_order = rand(0,9999);
    $cart_payment = $_POST['payment'];
    
?>  