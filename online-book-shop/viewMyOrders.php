<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('frontend/PhpMailer/Exception.php');
require('frontend/PhpMailer/PHPMailer.php');
require('frontend/PhpMailer/SMTP.php');

if(isset($_SESSION['customer_email'])){
    if($_SESSION['customer_email']){

    }else{
        echo "<script>window.location.href='index.php';</script>";
    }
}else{
    echo "<script>window.location.href='index.php';</script>";
}


include('frontend/function.php');

$cartArr = getUserFullCart();

$totalCartProduct = count($cartArr);

//print_r($cartArr);


$user_id = $_SESSION['user_id'];


if(isset($_POST['view_myorders'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM orders where user_id = $user_id LIMIT {$offset},{$limit_per_page}";
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    // print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '<table class="table table-borderless table-hover">
        <thead>
            <tr class="text-center">
                <th >S No.</th>
                <th>Order Id</th>                                               
                <th>SubTotal</th>
                <th>Tax</th>
                <th>Total</th>
                <th>Payment Type</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Date Time</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td class='text-primary fw-bolder'>{$row['order_id']}</td>
            <td>Rs. {$row['subtotal']}</td>
            <td>Rs. {$row['tax']}</td>
            <td class='text-success fw-bolder'>Rs.{$row['total']}</td>
            <td>{$row['payment_type']}</td>";


            
                if($row['payment_status'] == "pending"){
                    $output .= "<td class='text-danger fw-bolder'>{$row['payment_status']}</td>";
                }else{
                    $output .= "<td class='text-success fw-bolder'>{$row['payment_status']}</td>";
                }
                if($row['order_status'] == "delivered"){
                    $output .= "<td class='text-success fw-bolder'>{$row['order_status']}</td>";
                }else{
                    $output .= "<td class='text-primary fw-bolder'>{$row['order_status']}</td>";
                }

            $output .= "<td>". date('m/d/Y H:i:s', strtotime($row['timestamp']))."</td>
            <td>
                <a href='seeorders.php?order_id={$row['order_id']}'><button class='btn btn-primary'>
                    View Status
                </button></a>";
                
                    if($row['order_status'] == "cancel"){
                        $output .= "<button class='btn btn-danger ms-1 me-1' id='orderCancelled' data-id='{$row['order_id']}@{$page}'>
                        Cancelled
                        </button>";
                    }
                    else if($row['order_status'] == "delivered"){
                        $output .= "<button class='btn btn-success ms-1 me-1' id='delivered' data-id='{$row['order_id']}@{$page}'>
                        Delivered
                        </button>";
                    }else{
                        $output .= "<button class='btn btn-warning text-dark ms-1 me-1' id='cancelOrder' data-id='{$row['order_id']}@{$page}'>
                        Cancel Order
                        </button>";
                    }
            $output .='</td>
            </tr>';
             

            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM orders where user_id = $user_id";
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }


}



if(isset($_POST['cancel_order_by_user'])){

    $order_id = $_REQUEST['order_id'];

    $sql = "UPDATE `orders` SET `order_status`='cancel',`cancel_by_user`=1 WHERE order_id=$order_id";

    $runQuery = mysqli_query($conn,$sql);


    $sql1 = "select * from order_products where order_id=$order_id";

    $runQuery1 = mysqli_query($conn,$sql1);

    if(mysqli_num_rows($runQuery1) > 0){
        while($row = mysqli_fetch_assoc($runQuery1)){

            $product_id = $row['product_id'];

            $sql2 = "SELECT * FROM `products` WHERE `prod_id`=$product_id";
            $execute = mysqli_query($conn,$sql2);
            $product_row = mysqli_fetch_assoc($execute);

            $stockValue = $product_row['prod_stock'];

            $updatedStock = $stockValue + $row['product_qty'];

            $updateSql = "UPDATE `products` SET `prod_stock`=$updatedStock WHERE prod_id=$product_id";

            $executeUpdate = mysqli_query($conn,$updateSql);
        }

        
    }

    if($runQuery){
        echo "Cancel Successful";
    }else{
        echo "Cancel Failed";
    }
}








if(isset($_POST['cancel_email'])){


    $order_id = $_REQUEST['order_id'];

    // For Sending Email on Cancellation Order
    $sql4 = mysqli_query($conn,"select * from `orders` where order_id=$order_id");

    $row4 = mysqli_fetch_assoc($sql4);

    $user_name = $row4['customer_name'];
    $user_email = $row4['customer_email'];

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
        $mail->addAddress($user_email);     //Add a recipient
        

        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Order Cancel';
        $mail->Body    = "<h1><strong style='color:blue;'>Gallaxy Book Shop</strong></h1>
        Hey <strong style='color:blue;'>$user_name!</strong> Thank you for Ordering Products from <strong style='color:green;'>Gallaxy Book Shop</strong>
        <br> * Your Order Id is <strong style='color:blue;'>$order_id</strong>.
        <br> * Your Order is <strong style='color:red;'>Cancelled Successfully</strong>. 
        <br> Thank You for Buying Books from <strong style='color:green;'>Galaxy Book Shop!</strong>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo $order_id;
        echo "Sending Order Cancel Email Successfully";

    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        echo "Sending Order Cancel Email Failed";
    }

}



?>