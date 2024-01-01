<?php
session_start();
include('function.php');

if(isset($_POST['addToCart'])){

    //print_r($_POST);
    $product_id = get_safe($_POST['product_id']);
    $product_qty = get_safe($_POST['product_qty']);


    if(isset($_SESSION['customer_email'])){
        $user_id = $_SESSION['user_id'];       
        manageUserCart($user_id , $product_id , $product_qty );
    }else{
        
        $_SESSION['cart'][$product_id]['qty'] = $product_qty;
        
    }

    

}





?>