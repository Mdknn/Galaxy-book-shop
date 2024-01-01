<?php
session_start();
if(isset($_SESSION['customer_email'])){
    if($_SESSION['customer_email']){

    }else{
        echo "<script>alert('login required to Buy this Product');
        window.location.href='index.php';
        </script>";
    }
}else{
    echo "<script>alert('login required to Buy this Product');
    window.location.href='index.php';</script>";
}


include('frontend/function.php');

$cartArr = getUserFullCart();

$totalCartProduct = count($cartArr);

//print_r($cartArr);


$totalPrice = 0;
foreach($cartArr as $list){
    $totalPrice += $list['price']*$list['qty'];
}
        
$tax = ceil($totalPrice*0.02);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Galaxy Book Shop</title>
    <link rel="icon" type="image/x-icon" href="gfav.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

</head>
<body onload="myFunction()">

<div id="loadanimation"></div>

<?php include('includes/navbar.php') ?>

    <a href="javascript:void(0)" class="btn btn-success w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="checkout text-white">Checkout</span> </a>
    
    <div class="container" style="min-height:100vh;">
        <div class="row">

            <div class="col-lg-6">

                <form action="" method='post' id='checkoutForm'>
                    <div class="row">
                        <div class="form-group my-2 col-lg-6">
                        <label for="cname" class="my-2">Name</label>
                        <input type="text" class="form-control" id="cname" name="cname" placeholder="Enter Your Full Name">
                        </div>
                        
                        <div class="form-group my-2 col-lg-6">
                        <label for="cemail" class="my-2">Email address</label>
                        <input type="email" class="form-control " id="cemail" name="cemail" placeholder="name@example.com" >
                        
                        </div>

                        <div class="form-group my-2 col-lg-6">
                        <label for="state" class="my-2">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Enter Your State Name">
                        </div>

                        <div class="form-group my-2 col-lg-6">
                        <label for="city" class="my-2">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter Your City Name">
                        </div>

                        <div class="form-group my-2 col-lg-12">
                        <label for="address" class="my-2">Address</label>
                        <textarea rows="4" class="form-control" id="address" name="address" placeholder="Enter Your Full Address"></textarea>
                        </div>

                        <div class="form-group my-2 col-lg-6">
                        <label for="pincode" class="my-2">Pincode</label>
                        <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Enter Your Pincode">
                        </div>


                        <div class="form-group my-2 col-lg-6">
                        <label for="pmobile" class="my-2">Primary Mobile Number</label>
                        <input type="number" class="form-control" id="pmobile" name="pmobile" placeholder="Enter Your Personal Mobile Number">
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label for="payment" class="my-2">Select Payment Method</label>
                                <select class="form-select" aria-label="Default select example" id="payMethod" name="payMethod">
                                <option selected vlaue='0' >Select Payment Method</option>
                                <option value='CashOnDelivery' >Cash On Delivery</option>
                                <option value='RazorPay' >By Razorpay</option>
                        
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="subtotal" id="subtotal" value="<?= $totalPrice ?>">
                        <input type="hidden" name="tax" id="tax" value="<?= $tax ?>">
                        <input type="hidden" name="total" id="total" value="<?= $totalPrice+$tax; ?>">

                        <div class="form-group my-2 col-lg-6">
                        <label for="smobile" class="my-2">Secondary Mobile Number</label>
                        <input type="number" class="form-control" id="smobile" name="smobile" placeholder="Enter Your Secondary Mobile Number">
                        </div>

                        
                        <button type="submit" class="btn btn-primary my-3 ms-2 w-25" id="checkoutBtn">Checkout</button>

                       
                
                </div>
            </form>

            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card p-0 table-responsive"  >
                        <table class="table table-borderless table-hover">
                        <thead>
                            <tr class="text-center align-middle">
                                <th >Product</th>
                                <th >Quantity</th>
                                <th >Unit Mrp</th>
                                <th >Discount in %</th>
                                <th >Unit Price</th>
                                <th>SubTotal</th>
                            </tr>
                        </thead>

                    <tbody>
                        <?php

                            foreach($cartArr as $list){
                                echo "<tr class='align-middle'>
                                <td><img src='admin/Images/ProductImages/{$list['thumbnail']}' width='80rem' height='55px' alt=''><span class='ms-3'>{$list['name']}</span></td>
                                <td class='text-center fw-bolder text-danger' > {$list['qty']} </td>
                                <td class='text-center fw-bolder text-danger' ><span >RS.{$list['mrp']} </span></td>
                                <td class='text-center fw-bolder text-success' ><span >{$list['discount']}  %</span></td>
                                <td class='text-center text-primary fw-bolder' ><span >RS. {$list['price']}</span></td>
                                <td class='text-center text-success fw-bolder'><span>RS. {$list['subtotal']}</span></td>
                            </tr>";
                            }
                        ?>
                        <!-- <tr class='align-middle'>
                            <td><img src='admin/Images/ProductImages/1636172699class9bookmath.jpg' width='100rem' height='100px' alt=''><span class='ms-3'>Math</span></td>
                            <td class='text-center fw-bolder text-danger' > 2 </td>
                            <td class='text-center fw-bolder text-danger' ><span >RS.500 </span></td>
                            <td class='text-center fw-bolder text-success' ><span >20  %</span></td>
                            <td class='text-center text-primary fw-bolder' ><span >RS. 400</span></td>
                            <td class='text-center text-success fw-bolder'><span>RS. 1600</span></td>
                        </tr> -->

                    </tbody>
                </table>

            </div>

        </div>

            <div class="col-lg-12 my-3">

                <div class="card d-flex justify-content-between align-items-center w-100">
                    <div class="card-header w-100">
                        <h3>Order Summary</h3>
                    </div>
                    <div class="card-body w-75">
                    <span>
                       
                    </span>
                    <div class="card-title mt-3 mb-2 f-w5">Cart SubTotal <span class="ms-4 text-success">RS. <?= $totalPrice; ?>  </span></div>
                    <div class="card-title mt-3 mb-2 f-w5">TAX <span class="ms-4 text-success">2 % (RS.<?= $tax; ?> )</span></div>
                    <div class="card-title mt-3 mb-2 f-w5">Delivery Charge <span class="ms-4 text-success">FREE </span></div>
                    <hr>
                    <div class="card-title mt-3 mb-2 f-w5">Total Amount <span class="ms-4 text-success">RS. <?= $totalPrice+$tax; ?> </span></div>
                    </div>
                </div>

            </div>


        </div>
    
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

<script type="text/javascript" src="frontend/getDataFromDatabase.js"></script>

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
            $(".checkout").typed({
                strings: ["Welcome in Checkout Page","Place Order","Buy Products!","Welcome to Galaxy Book Shop!", "See Our All Books", "Go To Books", "Thanks for visit"],
                typeSpeed: 50,
                loop: true,
                backSpeed: 50,
                startDelay: 1,
                backDelay: 2000
            });
            
        });



    document.getElementById("checkoutBtn").onclick = function(event) {
        event.preventDefault();

        let name = $("#cname").val();
        let email = $("#cemail").val();
        let state = $("#state").val();
        let city = $("#city").val();
        let address = $("#address").val();
        let pmobile = $("#pmobile").val();
        let smobile = $("#smobile").val();
        let payMethod = $("#payMethod").val();

        // alert(payment) ;

        let form= $("#checkoutForm");
          
       // alert(payMethod);
       // console.log(payMethod);

        if(name=='' || email=='' || state=='' || city=='' || address=='' || pmobile=='' || smobile=='' || payMethod== 'Select Payment Method'){
            swal("Empty Fields!", "All Fields are Required!", "info");

        }
        else if( payMethod == "CashOnDelivery"){
            document.getElementById("checkoutBtn").disabled = true;
            let formdata = new FormData(document.getElementById("checkoutForm"));
            formdata.append('checkout',true);

                $.ajax({
                url: "frontend/checkouts.php",
                type: "POST",
                data: formdata ,
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) {
                //  console.log(data);
                //  alert(data);
                swal({
                    title: "Processing Please Wait.....",
                    text: "Your Order Request is Processing ! Please Wait.....\n\nDon't Try To Refresh The Page!",
                    icon: "info",
                    button: "Don't Refresh The Page",
                });

                window.location.href = "seeorders.php?order_id="+data;

                formdata.delete('checkout');
                formdata.append('order_request_email',true);
                formdata.append('order_id',data);
                    $.ajax({
                        url: "frontend/checkouts.php",
                        type: "POST",
                        data: formdata ,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){

                        }
                    });
            
                }
            });
        }
        else if( payMethod == "RazorPay"){
            document.getElementById("checkoutBtn").disabled = true;
            let total = document.getElementById("total").value;
            let subtotal = document.getElementById("subtotal").value;
            let tax = document.getElementById("tax").value;
           // alert(total);

            var options = {
                "key": "rzp_test_LatTwKYMCxI0X6", // Enter the Key ID generated from the Dashboard
                "amount": total*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": "Galaxy Book Shop" ,
                "description": "Buying Books",
                "image": "https://w7.pngwing.com/pngs/881/104/png-transparent-book-the-da-vinci-code-book-angle-text-logo.png",
                // "order_id": "order_Ef80WJDPBmAeNt", //Pass the `id` obtained in the previous step
                // "account_id": "acc_Ef7ArAsdU5t0XL",
                "handler": function (response){
                    // alert(response.razorpay_payment_id);
                    // alert(response.razorpay_order_id);
                    // alert(response.razorpay_signature);

                    //console.log(response);

                    let formdata = new FormData(document.getElementById("checkoutForm"));
                    formdata.append('payment_id',response.razorpay_payment_id);
                    formdata.append('checkout',true);

                        $.ajax({
                        url: "frontend/checkouts.php",
                        type: "POST",
                        data: formdata ,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data) {
                        //  console.log(data);
                        //  alert(data);
                        //  swal("Congratulations!", "Your Order Id is "+data, "success");

                        swal({
                            title: "Processing Please Wait.....",
                            text: "Your Order Request is Processing ! Please Wait.....\n\nDon't Try To Refresh The Page!",
                            icon: "info",
                            button: "Don't Refresh The Page",
                        });

                        window.location.href = "seeorders.php?order_id="+data;

                        formdata.delete('checkout');
                        formdata.append('order_request_email',true);
                        formdata.append('order_id',data);
                            $.ajax({
                                url: "frontend/checkouts.php",
                                type: "POST",
                                data: formdata ,
                                contentType: false,
                                cache: false,
                                processData:false,
                                success: function(data){

                                }
                            });
                
                        }
                    });
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
               
            
        }
        
    }
    
    

  </script>

</body>
</html>


