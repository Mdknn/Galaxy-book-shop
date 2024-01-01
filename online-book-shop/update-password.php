<?php
session_start();
if(isset($_SESSION['customer_email'])){
    if($_SESSION['customer_email']){
        $user_name = $_SESSION['customer_name'];
    }else{
        echo "<script>alert('login required to Update Password');
        window.location.href='index.php';
        </script>";
    }
}else{
    echo "<script>alert('login required to Update Password');
    window.location.href='index.php';</script>";
}

include('frontend/function.php');

$cartArr = getUserFullCart();

$totalCartProduct = count($cartArr);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password | Galaxy Book Shop</title>
    <link rel="icon" type="image/x-icon" href="gfav.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body onload="myFunction()">

<div id="loadanimation"></div>

<?php include('includes/navbar.php') ?>

<a href="javascript:void(0)" class="btn btn-primary w-100 fs-2 mt-2 mb-2 fw-bolder ftext ms-2 m-1"> <span class=" text-white"> Hello <span class="text-warning fw-bolder me-2"><?= $user_name ?> ,  </span> Update Your Password!</span> </a>
    
    <div class="container" style="min-height:100vh;">

        <div class="row mt-5">
            <div class="col-lg-3">
                
            </div>
            <div class="col-lg-6 col-md-12">
                <form id="updatepass" method="post">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Enter OLD Password</label>
                        <input type="password" class="form-control" id="oldpass" name="oldpass">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Enter New Password</label>
                        <input type="password" class="form-control" id="newpass" name="newpass">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Enter New Confirm Password</label>
                        <input type="password" class="form-control" id="conpass" name="conpass">
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-2" id="submitpass">Update Password</button>
                </form>
            </div>
            <div class="col-lg-3">

            </div>
        </div>
        
    
    

    </div>

    <?php include('includes/footer.php') ?>

    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- This jQuery cdn is required for Lightbox -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.1/js/lightbox.min.js"></script>

<!-- <script type="text/javascript" src="https://cdn.bootcss.com/typed.js/1.1.4/typed.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.4/typed.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript" src="includes/signup.js"></script>
<script type="text/javascript" src="includes/signout.js"></script>
    <script>
    

    $("#submitpass").click(function (e) {
        e.preventDefault();
        let oldPass = $("#oldpass").val();
        let newPass = $("#newpass").val();
        let conPass = $("#conpass").val();

        let form = $("#updatepass");

        if(oldPass=="" || newPass=="" || conPass=="" ){
            swal("Empty Fields!", "All Fields are Required!", "info");
        }else if(newPass != conPass){
            swal("Password Does Not Match!", "Confirm Password Does Not Match! \nPlease Enter Correct Confirm Password", "info");
        }else{
            jQuery.ajax({
            type: "POST",
            url:"frontend/updatePassword.php",
            data: form.serialize() + "&update_password",
            success:function(data){
                if(data=="Update Successfull"){
                    
                    swal("Congratulations!", "Password Updated Successfully!", "success");
                    form[0].reset();
                    window.setTimeout(function () {
                        location.href = "index.php";
                    }, 1000);
                }
                else if(data=="Your Old Password is Wrong"){
                    swal("Wrong Old Password!", "Your Old Password is Wrong! \nPlease Enter Correct Old Password", "error");
                }
                else{
                    swal("Try Again!", "Password Update Failed!", "error");
                }
                
                
            }
        })
        }
    })
        

    </script>

</body>
</html>