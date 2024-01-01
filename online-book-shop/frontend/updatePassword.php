<?php

session_start();
include('function.php');
if(isset($_SESSION['customer_email'])){
    if($_SESSION['customer_email']){
        $user_id = $_SESSION['user_id'];
    }
}

if(isset($_POST['update_password'])){

    $oldpass = get_safe($_POST['oldpass']);
    $newpass = get_safe($_POST['newpass']);
    $conpass = get_safe($_POST['conpass']);

    $sql = mysqli_query($conn,"select * from registration where auth_id=$user_id");

    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);

        // print_r(password_hash(123,PASSWORD_BCRYPT));
        // echo "<br>";
        // print_r(password_hash(123,PASSWORD_BCRYPT));

        if(password_verify($oldpass,$row['password'])){

            $newPassword = password_hash($newpass,PASSWORD_BCRYPT);

            $updateSql = "UPDATE `registration` SET `password`='$newPassword' WHERE auth_id = $user_id";

            $runQuery = mysqli_query($conn , $updateSql);

            if($runQuery){
                echo "Update Successfull";
            }else{
                echo "Update Failed";
            }

        }else{
            echo "Your Old Password is Wrong";
        }


    }else{
        echo "Update Failed";
    }
    

}



?>