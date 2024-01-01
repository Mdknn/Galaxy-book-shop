<?php
session_start();
// print_r($_SESSION);

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
    <title>All Products | Galaxy Book Shop</title>
    <link rel="icon" type="image/x-icon" href="gfav.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<body onload="myFunction()">

<div id="loadanimation"></div>

<?php include('includes/navbar.php') ?>

    <div class="container mt-4" style="min-height:100vh;">
        <div class="row">
            <div class="col-lg-3 col-md-4">

            <a href="#" class="list-group-item list-group-item-action f-w5 fs-5 text-white" style="background-color:green;" >
                        All Categories
                    </a>


                <div class="list-group my-2">
                    <?php $getAllCategories = getAllCategories(); 
                    
                        foreach($getAllCategories as $getCategoryNames){ ?>
                            <a href="#"  data-catid="<?=$getCategoryNames['cat_id']?>@<?=$getCategoryNames['cat_name']?>" class="list-group-item list-group-item-action categoryFilter oneLineTitleClass"><?=$getCategoryNames['cat_name']?></a>
                       <?php }
                    
                    ?>
                    <!-- <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                        The current link item
                    </a> -->
                    
                </div>

                <!-- This div is for Product Categories -->
                <div id="epcatName"> 
                
                </div>
                
                

                <div id="prodFilter"> 
                    <a href="#" class="list-group-item list-group-item-action mt-5 f-w5 fs-5 text-white" style="background-color:blue;">
                                Filter By Price
                    </a>

                    <div class="list-group my-2">
                        <a href="#" class="list-group-item list-group-item-action oneLineTitleClass" id="lowFilter">Low To High</a>
                        <a href="#" class="list-group-item list-group-item-action oneLineTitleClass" id="highFilter">High To Low</a>
                    </div>
                </div> 



                <div id="prodDiscountFilter"> 
                    <a href="#" class="list-group-item list-group-item-action mt-5 f-w5 fs-5 text-white" style="background-color:#e27010;">
                                Filter By Discount (Offer)
                    </a>

                    <div class="list-group my-2">
                        <a href="#" class="list-group-item list-group-item-action oneLineTitleClass" id="lowDiscount">Low Discount</a>
                        <a href="#" class="list-group-item list-group-item-action oneLineTitleClass" id="highDiscount">High Discount</a>
                    </div>
                </div> 


                
            </div>


            <div class="col-lg-9 col-md-8">

            <a href="javascript:void(0)" class="btn btn-danger w-100 fs-2 mb-2 fw-bolder ftext oneLineTitleClass" id="filterName"> <span class="author text-white allBooks" >Welcome in Book Store</span> </a>

                <div class="row" id="GetProductsData">

                    <div class="col-lg-4 col-md-6 my-2">

                        <div class="card " style="width: 100%;">
                            <div class="card-header text-center">Author : <a href="" class="smallLinkTitle text-dark"><span class="text-success ms-2 price"> Vicky Kumar</span></a></div>
                            <div class="img-hover-thumb"><img src="https://img.freepik.com/free-psd/book-cover-mockup_125540-572.jpg?size=626&ext=jpg" height="160px" class="card-img-top" alt="..."></div>
                            
                            <div class="card-body">
                                <a href="" class="linkTitle text-dark"><h5 class="card-title">Lorem ipsum dolor sit amet consectetur.</h5></a>
                                <p class="card-text fullprice">Price <span class="price ms-2">INR 100 <span class="text-success ms-1 mrp"><s>INR 300</s></span></span><span class="text-primary ms-2 priceoff">40% OFF</span></p>  
                            </div>
                            <div class="text-center p-0 m-0">
                                <a href="#" class="btn btn-primary btn-success ms-1 ownbtnred mb-2"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</a>
                                <a href="#" class="btn btn-primary ms-1 ownbtn mb-2"><i class="fa fa-eye" aria-hidden="true"></i> View Details</a>
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

<script src="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.1/js/lightbox.min.js"></script>

<!-- <script type="text/javascript" src="https://cdn.bootcss.com/typed.js/1.1.4/typed.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.4/typed.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script type="text/javascript" src="frontend/getAllProducts.js"></script>



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
           
            $(".allBooks").typed({
                strings: ["See Our All Latest Books","Welcome to Galaxy Book Shop!","Add to cart Books" ,"Buy Books " ,"Welcome to Book Store!", "See Our All Books", "Go To Books", "See All Authors", "Thanks for visit"],
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