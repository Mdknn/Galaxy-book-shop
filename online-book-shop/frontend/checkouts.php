<?php

session_start();
include('function.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PhpMailer/Exception.php');
require('PhpMailer/PHPMailer.php');
require('PhpMailer/SMTP.php');

$cartArr = getUserFullCart();

$countCart = count($cartArr);




if(isset($_POST['checkout'])){

    $name = get_safe($_POST['cname']);
    $email = get_safe($_POST['cemail']);
    $state = get_safe($_POST['state']);
    $city = get_safe($_POST['city']);
    $address = get_safe($_POST['address']);
    $pincode = get_safe($_POST['pincode']);
    $pmobile = get_safe($_POST['pmobile']);
    $smobile = get_safe($_POST['smobile']);
    $payMethod = get_safe($_POST['payMethod']);
    $subtotal = get_safe($_POST['subtotal']);
    $tax = get_safe($_POST['tax']);
    $total = get_safe($_POST['total']);
    
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
    
    if(isset($_POST['payment_id'])){
        $payment_id = get_safe($_POST['payment_id']);
    }else{
        $payment_id = "Not Available";
    }

    if($payMethod == "CashOnDelivery"){
        $payment_status = "pending";
    }else if($payMethod == "RazorPay"){
        $payment_status = "success";
    }else{
        $payment_status = "pending";
    }

    // print_r($_POST);
    // die();

    $sql = "INSERT INTO `orders`(`user_id`, `customer_name`, `customer_email`, `state`, `city`, `address`, `pincode`, `pmobile`, `smobile`, `subtotal`, `tax`, `total`, `payment_type`, `payment_id`, `payment_status`) VALUES ($user_id,'$name','$email','$state','$city','$address','$pincode','$pmobile','$smobile','$subtotal','$tax','$total','$payMethod','$payment_id','$payment_status')";


    $runQuery = mysqli_query($conn,$sql);



    $order_id = mysqli_insert_id($conn);

    foreach($cartArr as $key => $value){

        $product_id = $key;
        $product_name = $value['name'];
        $product_mrp = $value['mrp'];
        $product_price = $value['price'];
        $product_qty = $value['qty'];
        $product_discount = $value['discount'];
        $product_thumbnail = $value['thumbnail'];
        $product_subtotal = $value['subtotal'];


        $product_stock = $value['stock'];
        $current_product_stock = ($product_stock-$product_qty);

        // print_r($product_stock);
        // print_r($product_qty);
        // print_r($current_product_stock);


        $product_sql = "INSERT INTO `order_products`(`order_id`, `user_id`, `product_id`, `product_name`, `product_mrp`, `product_price`, `product_qty`, `product_discount`, `rem_stock` , `product_thumbnail`, `product_subtotal`) VALUES ($order_id , $user_id , $product_id , '$product_name' , '$product_mrp' , '$product_price' , '$product_qty' , '$product_discount', '$current_product_stock' , '$product_thumbnail' , '$product_subtotal' )";

        $product_runQuery = mysqli_query($conn, $product_sql);


        $product_stock_update_sql = "UPDATE `products` SET `prod_stock`='$current_product_stock' where prod_id=$product_id";

        $product_stock_runQuery = mysqli_query($conn,$product_stock_update_sql);


    }
    

    echo $order_id;

}









if(isset($_POST['order_request_email'])){

    $name = get_safe($_POST['cname']);
    $email = get_safe($_POST['cemail']);
    $state = get_safe($_POST['state']);
    $city = get_safe($_POST['city']);
    $address = get_safe($_POST['address']);
    $pincode = get_safe($_POST['pincode']);
    $pmobile = get_safe($_POST['pmobile']);
    $smobile = get_safe($_POST['smobile']);
    $payMethod = get_safe($_POST['payMethod']);
    $subtotal = get_safe($_POST['subtotal']);
    $tax = get_safe($_POST['tax']);
    $total = get_safe($_POST['total']);

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
    
    if(isset($_POST['payment_id'])){
        $payment_id = get_safe($_POST['payment_id']);
    }else{
        $payment_id = "Not Available";
    }

    if($payMethod == "CashOnDelivery"){
        $payment_status = "pending";
    }else if($payMethod == "RazorPay"){
        $payment_status = "success";
    }else{
        $payment_status = "pending";
    }

    $order_id = get_safe($_POST['order_id']);

    $mail = new PHPMailer(true);
   
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'vktest2535@gmail.com';                     //SMTP username
        $mail->Password   = 'Test@123';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('vktest2535@gmail.com', 'Galaxy Book Shop');
        $mail->addAddress($email);     //Add a recipient
        

        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Order Confirmation';
        $mail->Body    = "<h1><strong style='color:blue;'>Gallaxy Book Shop</strong></h1>
        Hey <strong style='color:blue;'>$name!</strong> Thank you for Ordering Products from <strong style='color:green;'>Gallaxy Book Shop</strong> <br> * Your Order Id is <strong style='color:blue;'>$order_id</strong>.
        <br> * Your Order is <strong style='color:blue;'>Waiting for Confirmation</strong>.
        <br> * Your Total Amount is <strong style='color:green;'>Rs. $total</strong>.
        <br> * You Buy <strong style='color:green;'>$countCart Book</strong>.
        <br> * You Choose Pay Method is <strong style='color:blue;'>$payMethod</strong>.
        <br> * Your Payment Status is <strong style='color:blue;'> $payment_status</strong>.
        <br> * Your Payment ID is <strong style='color:green;'> $payment_id</strong>.
        <br> * Your Shipping Address is <strong style='color:blue;'>$address</strong>.
        <br> * Your Primary Mobile Number is <strong style='color:blue;'>+91 $pmobile</strong>.
        <br> Thank You for Buying Books from <strong style='color:green;'>Galaxy Book Shop!</strong>.";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo $order_id;
        echo "Order Request Email Sent Successfully";

    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


    $cart_delete_query = "delete from cart where user_id=$user_id";

    $car_runQuery = mysqli_query($conn,$cart_delete_query);



}



?>