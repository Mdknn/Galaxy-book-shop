<?php
session_start();
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
$order_id = $_REQUEST['order_id'];

$sql = "select * from orders where user_id=$user_id and order_id=$order_id";

$runQuery = mysqli_query($conn,$sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Orders | Galaxy Book Shop</title>
    <link rel="icon" type="image/x-icon" href="gfav.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body onload="myFunction()">

<div id="loadanimation"></div>

<?php include('includes/navbar.php') ?>

<a href="javascript:void(0)" class="btn btn-primary w-100 fs-2 mt-2 mb-2 fw-bolder ftext oneLineTitleClass"> <span class="seeorder text-white">Welcome in Book Store</span> </a>

<div class="container" style="min-height:100vh;">
    <div class="row">
        <div class="col-lg-6">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb ms-2">
                        <li class="breadcrumb-item"><a href="#" class="smallLinkTitle f-w5">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> <span class="smallLinkTitle f-w5 text-success">See All Orders</span></li>
                    </ol>
                </nav>


            <div class="my-4">
                <h2 class="text-primary fw-bolder">Galaxy Book Shop</h2>
                <?php
                    if(mysqli_num_rows($runQuery) > 0){
                        $row = mysqli_fetch_assoc($runQuery);
                        if($row['order_status'] == "request"){
                            echo'<h5 class="mt-4 text-success fw-bolder" >Your Order is Waiting for Confirmation!</h5>';
                        }
                        else if($row['order_status'] == "accept"){
                            echo'<h5 class="mt-4 text-success fw-bolder" >Your Order is Confirmed!</h5>';
                        }
                        else if($row['order_status'] == "packed"){
                            echo'<h5 class="mt-4 text-success fw-bolder" >Your Order is Packed!</h5>';
                        }
                        else if($row['order_status'] == "arrive"){
                            echo'<h5 class="mt-4 text-success fw-bolder" >Your Order is Arrive in Destination!</h5>';
                        }
                        else if($row['order_status'] == "outfordelivery"){
                            echo'<h5 class="mt-4 text-success fw-bolder" >Your Order is Out For Delivery!</h5>';
                        }
                        else if($row['order_status'] == "delivered"){
                            echo'<h5 class="mt-4 text-success fw-bolder" >Your Order is Delivered!</h5>';
                        }
                        else if($row['order_status'] == "cancel"){
                            echo'<h5 class="mt-4 text-danger fw-bolder" >Your Order is Cancelled!</h5>';
                        }

                        echo '<h6 class="mt-3">Hello <span class="fw-bolder text-success"> Vicky  </span>,</h6>';
                        if($row['order_status'] == "cancel"){
                            echo '<h6 class=" mt-2 text-danger ">Your Order is Cancelled!</h6>';
                        }
                        else if($row['order_status'] == "delivered"){
                            echo '<h6 class=" mt-2 text-success ">Your Order has Delivered Successfully!</h6>';
                        }
                        else{
                            echo '<h6 class=" mt-2 text-primary ">Your Order Will be Deliver in '.$row['del_rem_days'].' days</h6>';
                        }
                        

                    }

                ?>
                
                
                
            </div>
        </div>

        <div class="col-lg-6 my-5 ">
            <h4 class="text-success my-3">Track Your Order</h4>
            
            <?php
                $user_id = $_SESSION['user_id'];
                $order_id = $_REQUEST['order_id'];
                
                $sql = "select * from orders where user_id=$user_id and order_id=$order_id";
                
                $runQuery = mysqli_query($conn,$sql);

                if(mysqli_num_rows($runQuery) > 0){
                    $row = mysqli_fetch_assoc($runQuery);

                    if($row['order_status'] == "request"){
                        echo '<div class="progress my-2 " style="height: 33px;" >
                            <div class="progress-bar bg-danger fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">Request</div>
                        </div>';
                    }
                    else if($row['order_status'] == "accept"){
                        echo '<div class="progress my-2 " style="height: 33px;" >
                            <div class="progress-bar bg-danger fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">Request</div>
                            <div class="progress-bar fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Accept</div>
                        </div>';
                    }
                    else if($row['order_status'] == "packed"){
                        echo '<div class="progress my-2 " style="height: 33px;" >
                            <div class="progress-bar bg-danger fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">Request</div>
                            <div class="progress-bar fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Accept</div>
                            <div class="progress-bar bg-warning fs-6 fw-bolder text-dark" role="progressbar" style="width: 16%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Packed</div>
                        </div>';
                    }
                    else if($row['order_status'] == "arrive"){
                        echo '<div class="progress my-2 " style="height: 33px;" >
                            <div class="progress-bar bg-danger fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">Request</div>
                            <div class="progress-bar fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Accept</div>
                            <div class="progress-bar bg-warning fs-6 fw-bolder text-dark" role="progressbar" style="width: 16%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Packed</div>
                            <div class="progress-bar bg-primary fs-6 fw-bolder" role="progressbar" style="width: 17%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Arrive</div>
                        </div>';
                    }
                    else if($row['order_status'] == "outfordelivery"){
                        echo '<div class="progress my-2 " style="height: 33px;" >
                            <div class="progress-bar bg-danger fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">Request</div>
                            <div class="progress-bar  fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Accept</div>
                            <div class="progress-bar bg-warning fs-6 fw-bolder text-dark" role="progressbar" style="width: 16%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Packed</div>
                            <div class="progress-bar bg-primary fs-6 fw-bolder" role="progressbar" style="width: 17%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Arrive</div>
                            <div class="progress-bar bg-warning text-dark fs-6 fw-bolder" role="progressbar" style="width: 22%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Out For Delivery</div>

                        </div>';
                    }
                    else if($row['order_status'] == "delivered"){
                        echo '<div class="progress my-2 " style="height: 33px;" >
                            <div class="progress-bar bg-danger fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">Request</div>
                            <div class="progress-bar fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Accept</div>
                            <div class="progress-bar bg-warning fs-6 fw-bolder text-dark" role="progressbar" style="width: 16%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Packed</div>
                            <div class="progress-bar bg-primary fs-6 fw-bolder" role="progressbar" style="width: 17%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Arrive</div>
                            <div class="progress-bar bg-warning text-dark fs-6 fw-bolder" role="progressbar" style="width: 22%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Out For Delivery</div>
                            <div class="progress-bar bg-success fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Delivered</div>

                        </div>';
                    }
                    else if($row['order_status'] == 'cancel'){
                        echo '<div class="progress my-2 " style="height: 33px;" >
                            <div class="progress-bar bg-warning text-dark fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">Request</div>
                            <div class="progress-bar bg-danger fs-6 fw-bolder" role="progressbar" style="width: 85%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Cancel Successful</div>
                        </div>';
                    }

                    if($row['cancel_by_user'] == 1){
                        echo ' <h6 class="text-danger text-center my-4 fw-bolder">Order Cancel Request By <span class="text-primary"> '.$_SESSION['customer_name'].'</span></h6>';
                    }else if($row['cancel_by_admin'] == 1){
                        echo ' <h6 class="text-danger text-center my-4 fw-bolder">Order Cancel Due To Some Unconditional Reason</h6>';
                    }
                }

                
       
            ?>

            <!-- <div class="progress my-2 " style="height: 33px;" >
                <div class="progress-bar bg-danger fs-6 fw-bolder" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">Request</div>
                
                
                <div class="progress-bar bg-success fs-6 fw-bolder" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Delivered</div>
            </div> -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <div class="card p-0 table-responsive my-4">
                <h4 class="text-success ms-3 mt-2">Order Details</h4>
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>Order Id</th>                                               
                            <th>SubTotal</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Payment Type</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>Date Time</th>
                            <th>Shipping Address</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                    $user_id = $_SESSION['user_id'];
                    $order_id = $_REQUEST['order_id'];

                    $sql = "select * from orders where user_id=$user_id and order_id=$order_id";

                    $runQuery = mysqli_query($conn,$sql);

                    
                    if(mysqli_num_rows($runQuery) > 0){
                        while($row = mysqli_fetch_assoc($runQuery)){
                           
                            ?>

                            <tr class="text-center align-middle">
                                
                                <td class="text-primary fw-bolder"><?= $row['order_id'] ?></td>
                                <td>Rs. <?= $row['subtotal'] ?></td>
                                <td>Rs. <?= $row['tax'] ?></td>
                                <td class="text-success fw-bolder">Rs. <?= $row['total'] ?></td>
                                <td><?= $row['payment_type'] ?></td>
                                <?php
                                    if($row['payment_status'] == "pending"){
                                        echo "<td class='text-danger fw-bolder'>{$row['payment_status']}</td>";
                                    }else{
                                        echo "<td class='text-success fw-bolder'>{$row['payment_status']}</td>";
                                    }
                                    if($row['order_status'] == "delivered"){
                                        echo "<td class='text-success fw-bolder'>{$row['order_status']}</td>";
                                    }
                                    else if($row['order_status'] == "cancel"){
                                        echo "<td class='text-danger fw-bolder'>{$row['order_status']}</td>";
                                    }
                                    else{
                                        echo "<td class='text-primary fw-bolder'>{$row['order_status']}</td>";
                                    }
                                ?>  
                        
                                <td><?= date('m/d/Y H:i:s', strtotime($row['timestamp'])); ?></td>
                                <td>
                                    <?= $row['address'] ?>
                                </td>
                            </tr>

                    <?php
                        }
                    }

                ?>
                        
                        
                    </tbody>
                </table>

            </div>

            <div class="card p-0 table-responsive my-4">
                <h4 class="text-primary ms-3 mt-2">Product Details</h4>
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr class="text-center">
                            <th >S No.</th>
                            <th >Product Name</th>
                            <th >Product Image</th>
                            <th >Unit Mrp</th>
                            <th >Unit Price</th>
                            <th >Discount</th>
                            <th >Qty</th>
                            <th >SubTotal</th>
                            <th>Date Time</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                    $user_id = $_SESSION['user_id'];
                    $order_id = $_REQUEST['order_id'];

                    $sql1 = "select * from order_products where user_id=$user_id and order_id=$order_id";

                    $runQuery1 = mysqli_query($conn,$sql1);

                    $serial_number = 0;
                    if(mysqli_num_rows($runQuery1) > 0){
                        while($rows = mysqli_fetch_assoc($runQuery1)){
                            $serial_number++;
                    ?>
                        <tr class="text-center align-middle">
                            <td><?= $serial_number ?></td>
                            <td class="text-primary fw-bolder"><?= $rows['product_name'] ?></td>
                            <td><img src="admin/Images/ProductImages/<?= $rows['product_thumbnail'] ?>" width="100rem" height="90px" alt=""></td>
                            <td class="text-danger fw-bolder">Rs. <?= $rows['product_mrp'] ?></td>
                            <td class="text-primary fw-bolder">Rs. <?= $rows['product_price'] ?></td>
                            <td class="text-success fw-bolder">Rs. <?= $rows['product_discount'] ?></td>
                            <td class="text-primary fw-bolder"><?= $rows['product_qty'] ?></td>
                            <td class="text-success fw-bolder">Rs. <?= $rows['product_subtotal'] ?></td>
                            <td><?= $rows['timestamp'] ?></td>

                        </tr>
                    <?php
                        }
                        }
                    ?>
                        
                        
                    </tbody>
                </table>

                
            </div>

        </div>


       
    </div>
</div>

<?php include('includes/footer.php') ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- This jQuery cdn is required for Lightbox -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.1/js/lightbox.min.js"></script>

<!-- <script type="text/javascript" src="https://cdn.bootcss.com/typed.js/1.1.4/typed.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.4/typed.min.js"></script>

<script type="text/javascript" src="includes/signup.js"></script>
<script type="text/javascript" src="includes/signout.js"></script>

<script>
    // Hiding and Showing Modal at same time
    $("#signupAgain").on("click", function(){
        $("#loginModal").modal("hide");
        $('#signupModal').modal("show");
    });

    $("#loginAgain").on("click", function(){
        $("#signupModal").modal("hide");
        $('#loginModal').modal("show");
    });

    $(function () {
           
            $(".seeorder").typed({
                strings: ["Welcome in Galaxy Book Shop!","See All Order Details","Track Orders", "Buy Now","Add to Cart Books" ,"Buy Books " ,"Welcome to Book Store!", "See Our All Books", "Go To Books", "See All Authors", "Thanks for visit"],
                typeSpeed: 50,
                loop: true,
                backSpeed: 50,
                startDelay: 1,
                backDelay: 2000
            });
        });

  </script>

    

</body>
</html>