<?php

include('../backend/function.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PhpMailer/Exception.php');
require('PhpMailer/PHPMailer.php');
require('PhpMailer/SMTP.php');



if(isset($_POST['view_allOrders'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM orders LIMIT {$offset},{$limit_per_page}";
    
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
                <th>Rem Days</th>
                <th>Status</th>
                <th style="width:140px;">Action</th>
                
            </tr>
        </thead>
        <tbody>';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td class='text-primary fw-bolder'>{$row['order_id']}</td>
            <td>Rs. {$row['subtotal']}</td>
            <td>Rs. {$row['tax']}</td>
            <td class='text-success fw-bolder'>Rs. {$row['total']}</td>
            <td>{$row['payment_type']}</td>";
            
                if($row['payment_status'] == "pending"){
                    $output .= "<td class='text-danger fw-bolder'>{$row['payment_status']}</td>";
                }else{
                    $output .= "<td class='text-success fw-bolder'>{$row['payment_status']}</td>";
                }
                if($row['order_status'] == "outfordelivery"){
                    $output .= "<td class='text-primary fw-bolder'>Out For Delivery</td>";
                }
                else if($row['order_status'] == "delivered"){
                    $output .= "<td class='text-success fw-bolder'>{$row['order_status']}</td>";
                }
                else if($row['order_status'] == "cancel"){
                    $output .= "<td class='text-danger fw-bolder'>{$row['order_status']}</td>";
                }
                else{
                    $output .= "<td class='text-primary fw-bolder'>{$row['order_status']}</td>";
                }
            
                $output .="<td>". date('m/d/Y H:i:s', strtotime($row['timestamp'])) ."</td>
                <td>
                    <select class='form-select' aria-label='Default select example' id='daysSelect' name='daysSelect' data-id='{$row['order_id']}@{$page}''> ";
                           
                                if($row['order_status'] == "cancel" or $row['order_status'] == "delivered"){
                                    $output .= "<option value='{$row['del_rem_days']}' selected>0</option>";
                                }
                                else {
                                    $output .= "<option value='{$row['del_rem_days']}' selected>{$row['del_rem_days']}</option>";
                                
                                    if($row['del_rem_days'] == 5){
                                        $output .= '<option value="4">4</option>
                                        <option value="3">3</option>';
                                    }
                                    else if($row['del_rem_days']==4){
                                        $output .= '<option value="3">3</option>
                                        <option value="2">2</option>';
                                    }
                                    else if($row['del_rem_days']==3){
                                        $output .= '<option value="2">2</option>
                                        <option value="1">1</option>';
                                    }
                                    else if($row['del_rem_days']==2){
                                        $output .= '<option value="1">1</option>';
                                        
                                    }
                                    else if($row['del_rem_days']==1){
                                        
                                    }
                                }

                            
                        
                $output .="</select>
                </td>
                <td>
                    <select class='form-select' aria-label='Default select example' id='orderStatusChange' name='orderStatusChange' data-id='{$row['order_id']}@{$page}'>";

                    
                    if($row['order_status'] == "outfordelivery"){
                        $output .= "<option value={$row['order_status']} selected >Out For Delivery</option>";
                    }else{
                        $output .= "<option value={$row['order_status']} selected >".ucfirst($row['order_status']) ."</option>";
                    }

                    
                    if($row['order_status'] == "cancel" and $row['order_status'] == "delivered"){
                        
                        //   Not Showing Anything
                    }
                    else if($row['order_status'] == "outfordelivery"){
                        $output .= '<option value="delivered">Delivered</option>
                        <option value="cancel">Cancel Order</option>';
                    }
                    else if($row['order_status'] == "arrive"){
                        $output .= '<option value="outfordelivery">Out For Delivery</option>
                        <option value="cancel">Cancel Order</option>';
                        
                    }
                    else if($row['order_status'] == "packed"){
                        $output .= '<option value="arrive">Arrive</option>
                        <option value="cancel">Cancel Order</option>';
                    }
                    else if($row['order_status'] == "accept"){
                        $output .= '<option value="packed">Packed</option>
                        <option value="cancel">Cancel Order</option>';
                    }
                    else if($row['order_status'] == "request"){
                        $output .= '<option value="accept">Accept</option>
                        <option value="cancel">Cancel Order</option>';
                    }
                
                    $output .='</select>
                    </td>
                    <td>
                        <a href="index.php?order_id='.$row['order_id'].'"><button class="btn btn-primary">View Status</button></a>
                        
                    </td>
                </tr>'; 

            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM orders ";
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







if(isset($_POST['order_status_change'])){

    $order_id = $_REQUEST['order_id'];

    $status_value = $_REQUEST['status_value'];

    if($status_value == 'delivered'){
        $sql = "UPDATE `orders` SET `order_status`='$status_value' , `payment_status`='success' WHERE order_id=$order_id"; 
    }else{
        $sql = "UPDATE `orders` SET `order_status`='$status_value' WHERE order_id=$order_id";
    }


   // print_r($sql);

    $runQuery = mysqli_query($conn,$sql);

    if($runQuery){
        echo "Status Change Successfully";
    }else{
        echo "Status Change Failed";
    }
}





if(isset($_POST['order_cancel'])){

    $order_id = $_REQUEST['order_id'];

    $status_value = $_REQUEST['status_value'];

    //print_r($_POST);

    $sql = "UPDATE `orders` SET `order_status`='$status_value' , `cancel_by_admin`=1 WHERE order_id=$order_id";

   // print_r($sql);

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
        echo "Order Cancel Successfully";
    }else{
        echo "Order Cancel Failed";
    }
}





if(isset($_POST['order_del_date_change'])){

    $date_value = $_REQUEST['date_value'];

    $order_id = $_REQUEST['order_id'];

    $sql = "UPDATE `orders` SET `del_rem_days`='$date_value' WHERE order_id=$order_id";

    $runQuery = mysqli_query($conn,$sql);

    if($runQuery){
        echo "Rem Date Change Successfully";
    }else{
        echo "Rem Date Change Failed";
    }
}











// Sending Cancel Mail

if(isset($_POST['sending_mail'])){

    $order_id = $_REQUEST['order_id'];

    $status_value = $_REQUEST['status_value'];

    $sql4 = mysqli_query($conn,"select * from `orders` where order_id=$order_id");

    $row4 = mysqli_fetch_assoc($sql4);

    $user_name = $row4['customer_name'];
    $user_email = $row4['customer_email'];




//  For Sending Accepting Email
    if($status_value == 'accept'){

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
            $mail->Subject = 'Order Confirmation';
            $mail->Body    = "<h1><strong style='color:blue;'>Gallaxy Book Shop</strong></h1>
            Hey <strong style='color:blue;'>$user_name!</strong> Thank you for Ordering Products from <strong style='color:green;'>Gallaxy Book Shop</strong>
            <br> * Your Order Id is <strong style='color:blue;'>$order_id</strong>.
            <br> * Your Order is <strong style='color:green;'>Confirm</strong>. 
            <br> * Your Order is delivered between <strong style='color:blue;'> 1 to 5 days</strong>. 
            <br> Thank You for Buying Books from <strong style='color:green;'>Galaxy Book Shop!</strong>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // echo $order_id;
            echo "Accept Mail Sent Successfully!!";

        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            echo "Accept Mail Sending Failed!!";
        }

    }




//  For Sending Delivered Email
    if($status_value == 'delivered'){

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
            $mail->Subject = 'Order Delivered';
            $mail->Body    = "<h1><strong style='color:blue;'>Gallaxy Book Shop</strong></h1>
            Hey <strong style='color:blue;'>$user_name!</strong> Thank you for Ordering Products from <strong style='color:green;'>Gallaxy Book Shop</strong>
            <br> * Your Order Id is <strong style='color:blue;'>$order_id</strong>.
            <br> * Your Order is <strong style='color:green;'>Successfully Delivered</strong>. 
            <br> Thank You for Buying Books from <strong style='color:green;'>Galaxy Book Shop!</strong>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // echo $order_id;
            echo "Delivered Mail Sent Successfully!!";

        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            echo "Delivered Mail Sending Failed!!";
        }

    }






//  Order Cancel Email
    if($status_value == 'cancel'){

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
            echo "Cancel Mail Sent Successfully!!";

        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            echo "Cancel Mail Sending Failed!!";
        }

    }



}


?>