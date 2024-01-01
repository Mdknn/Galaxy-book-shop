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



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | Galaxy Book Shop</title>
    <link rel="icon" type="image/x-icon" href="gfav.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <style>
        #loadanimation{
        display:flex;
        align-items:center;
        width:100%;
        height:100vh;
        justify-content:center;
        background-color: rgba(244,245,246,255) !important;
        background: rgba(12,12,12,255) url('https://cdn.dribbble.com/users/108183/screenshots/2301400/spinnervlll.gif') no-repeat center;
    }
    </style>
</head>
<body onload="myFunction()">
    
<div class="loadanimation"></div>

<?php include('includes/navbar.php') ?>

<a href="javascript:void(0)" class="btn btn-primary w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="orders text-white" >Welcome in Book Store</span> </a>


<div id="loadanimation"></div>


<div class="container" style="min-height:100vh;">
    <div class="row">
        <div class="col-lg-12">

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
				<ol class="breadcrumb ms-2">
					<li class="breadcrumb-item"><a href="#" class="smallLinkTitle f-w5">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page"> <span class="smallLinkTitle f-w5 text-success">My Orders</span></li>
				</ol>
			</nav>


            <div class="card p-0 table-responsive" id="viewMyOrders">
                

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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


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

    // This javascript code for loading animation
    var loadAnimation = document.getElementById("loadanimation");
    loadAnimation.style.display="none";

    $(function () {
           
            $(".orders").typed({
                strings: ["Welcome in Galaxy Book Shop!","See All Orders","Track Orders","Know Status of Orders" ,"Buy Now","Add to cart Books" ,"Buy Books " ,"Welcome to Book Store!", "See Our All Books", "Go To Books", "See All Authors", "Thanks for visit"],
                typeSpeed: 50,
                loop: true,
                backSpeed: 50,
                startDelay: 1,
                backDelay: 2000
            });
        });

    
    function ViewMyOrders(page){
        $.ajax({
          url: "viewMyOrders.php",
          type: "POST",
          data: {page_no :page ,'view_myorders':true},
          success: function(data) {
              // console.log(data);
              // alert(data);
              $("#viewMyOrders").html(data);
              
          }
        });
    }
      ViewMyOrders();
  
      //Pagination Code
      $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");
  
        ViewMyOrders(page_id);
      })
  
        $(document).on("click","#cancelOrder",function(e) {
            e.preventDefault();

            let allData = $(this).data("id");
            let myArray = allData.split('@');
            order_id = myArray[0];
            pageNo = myArray[1];
           // alert(pageNo);

                swal({
                    title: "Cancel Order?",
                    text: "Are You Sure? You want to cancel the order!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        loadAnimation.style.display="block";
                        jQuery.ajax({
                            type: "POST",
                            url:'viewMyOrders.php',
                            data:{'order_id':order_id,'cancel_order_by_user':true},
                            success:function(data){
                                loadAnimation.style.display="none";
                                if(data=="Cancel Successful"){
                                    ViewMyOrders(pageNo);
                                    swal("Congratulations!", "Cancel Order Successfull!", "success");
                                    
                                }else{
                                    swal("Try Again!", "Cancel Order Failed! Try Again", "error");
                                }

                                    jQuery.ajax({
                                        type: "POST",
                                        url:'viewMyOrders.php',
                                        data:{'order_id':order_id,'cancel_email':true},
                                        success:function(data){

                                        }
                                    });

                            }
                        });
                    } 
                });
            
        })

    
    

  </script>

    

</body>
</html>