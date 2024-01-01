<?php
session_start();
include('function.php');

if(isset($_POST['login'])){

    
    $email = get_safe($_POST['email']);
    $pass = get_safe($_POST['password']);
    $user_type="admin";

    $sql = "SELECT * FROM `registration` WHERE email='$email' and user_type='$user_type' and reg_status=1";


    $runQuery = mysqli_query($conn , $sql);

    $rows = mysqli_num_rows($runQuery);

    if($rows > 0 ){
        $data = mysqli_fetch_assoc($runQuery);
        if(password_verify($pass,$data['password'])){
            $_SESSION["admin_email"] = $data['email'];
            $_SESSION["user_type"] = $data['user_type'];
            $_SESSION["admin_name"] = $data['name'];
            echo "Login Successfull";
        }else{
            echo "Wrong Password";
        }
    }else{
        echo "Login Failed";
    }


}


if (isset($_POST['logout'])){

    unset($_SESSION['admin_email']);
    unset($_SESSION['admin_name']);
    unset($_SESSION['user_type']);

    echo "Logout Successfull";

}
    
?>