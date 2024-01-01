<?php
session_start();
include('function.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PhpMailer/Exception.php');
require('PhpMailer/PHPMailer.php');
require('PhpMailer/SMTP.php');


if(isset($_POST['check_email'])){

    $email = get_safe($_POST['email']);

    $emailCheck = mysqli_query($conn,"SELECT * FROM registration where email='$email'");

    if(mysqli_num_rows($emailCheck) > 0){
        echo "Email Already Exists";

    }else{
        echo "Email Not Exists";
    }

}


if(isset($_POST['send_email']))
{
    $email = get_safe($_POST['email']);
    // $six_digit_random_number = random_int(100000, 999999);
    // echo $six_digit_random_number;

    $four_digit_random_number = random_int(1000, 9999);


    $emailCheck = mysqli_query($conn,"SELECT * FROM registration where email='$email'");

    
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
        $mail->Subject = 'Email Verification';
        $mail->Body    = "<h1><strong style='color:blue;'>Gallaxy Book Shop</strong></h1>
        Hey <strong style='color:blue;'>!</strong> Thank you for Register with Us <strong style='color:green;'>Gallaxy Book Shop</strong><br>
        <br> * Your Email Verification Code is  <strong style='color:blue;'>$four_digit_random_number</strong>.
        <br><br> Thank you for Register with Us <strong style='color:green;'>Galaxy Book Shop!</strong>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo $four_digit_random_number;

    } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
   

}




if(isset($_POST['register'])){

    $name = get_safe($_POST['name']);
    $email = get_safe($_POST['emailvalue']);
    $mobile = get_safe($_POST['mobile']);
    $pass = password_hash(get_safe($_POST['pass1']),PASSWORD_BCRYPT);
    $job="customer";
    $user_type="user";

    $sql = "INSERT INTO `registration`(`name`, `email`, `password`, `mobile`, `job`,`user_type`) VALUES ('$name','$email','$pass','$mobile','$job','$user_type')";

    $runQuery = mysqli_query($conn , $sql);

    if($runQuery){
        echo "Registration Successfull";
    }else{
        echo "Registration Failed";
    }


}
if(isset($_POST['login'])){

    
    $email = get_safe($_POST['lemail']);
    $pass = get_safe($_POST['password']);
    $user_type="user";

    $sql = "SELECT * FROM `registration` WHERE email='$email' and user_type='$user_type'";


    $runQuery = mysqli_query($conn , $sql);

    

    $rows = mysqli_num_rows($runQuery);

    if($rows > 0 ){
        $data = mysqli_fetch_assoc($runQuery);
        //print_r($data['password']);

        if(password_verify($pass,$data['password'])){
                        
            if($data['reg_status']==1){
                
                $_SESSION["customer_email"] = $data['email'];
                $_SESSION["user_type"] = $data['user_type'];
                $_SESSION["user_id"] = $data['auth_id'];
                $_SESSION["customer_name"] = $data['name'];
        
        
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                    foreach($_SESSION['cart'] as $key => $value){
                        // echo $key;
                        // echo $value['qty'];
                        manageUserCart($_SESSION["user_id"],$key , $value['qty']);
                    }
                }
        
        
                unset($_SESSION['cart']);
        
        
                echo "Login Successfull";
            }
            else{
                echo "Your Account is Temporary Deactivated";
            }
        }
        else{
            echo "Password is Wrong";
        }
    }
    else{
        echo "Login Failed";
    }
       


}


if (isset($_POST['logout'])){

    unset($_SESSION['customer_email']);
    unset($_SESSION['customer_name']);
    unset($_SESSION['user_type']);
    unset($_SESSION['user_id']);

    echo "Logout Successfull";

}
    
?>