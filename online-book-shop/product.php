<?php

session_start();
// print_r($_SESSION);

include('frontend/function.php');

$cartArr = getUserFullCart();

$totalCartProduct = count($cartArr);

//print_r($cartArr);
//print_r($_REQUEST);

$slug = $_REQUEST['slug'];

$sql = "SELECT * FROM products WHERE prod_status=1 and prod_slug='$slug'";

$runQuery = mysqli_query($conn,$sql);

if(mysqli_num_rows($runQuery)){
    $row = mysqli_fetch_assoc($runQuery);

    $product_id = $row['prod_id'];
    $product_name = $row['prod_name'];
}else{
    $row = array();
}


if($product_id != ''){
    $sql1 = "SELECT * FROM product_images WHERE image_status=1 and prod_id=$product_id";

    $runQuery1 = mysqli_query($conn,$sql1);
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $product_name; ?> | Galaxy Book Shop</title>
    <link rel="icon" type="image/x-icon" href="gfav.svg">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="singleProduct/singleproductstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body onload="myFunction()">

<div id="loadanimation"></div>

<?php include('includes/navbar.php') ?>

	<a href="javascript:void(0)" class="btn btn-primary m-2 w-100 fs-2 fw-bolder ftext oneLineTitleClass"> <span class=" text-white">Books Of <?= getCategoryName($row['prod_cat_id']); ?></span> </a>

	<div class="container" style="min-height:100vh;">
        <div class="row">
            <div class="col-lg-6 my-4">
            <div class="text-center">
                <div class="d-flex justify-content-center align-items-center img-hover-thumb" id="featuredMain">
                    <img id="featured" src="admin/Images/ProductImages/<?= $row['prod_thumbnail']; ?>" class="rounded p-2 " alt="...">
                </div>
                <div id="slide-wrapper" >
                    <img id="slideLeft" class="arrow" src="singleProduct/images/arrow-left.png">

                    <div id="slider">
                        <img class="thumbnail active" src="admin/Images/ProductImages/<?= $row['prod_thumbnail']; ?>">
                        <?php 
                            if(mysqli_num_rows($runQuery1)){
                            while($rows = mysqli_fetch_assoc($runQuery1)){
                                // print_r($rows);
                                echo '<img class="thumbnail" src="admin/Images/ProductsImages/'.$rows['image'].'" width="100%">';
                            }
                        }

                        ?>
					<!-- <img class="thumbnail" src="https://img.freepik.com/free-psd/white-book-standing-white-surface-mockup_117023-1349.jpg?size=626&ext=jpg">
					<img class="thumbnail" src="https://www.pngfind.com/pngs/m/517-5179417_book-mockup-png-graphic-design-transparent-png.png">
					<img class="thumbnail " src="https://img.freepik.com/free-psd/book-cover-mockup_125540-572.jpg?size=626&ext=jpg">
					<img class="thumbnail" src="https://img.freepik.com/free-psd/white-book-standing-white-surface-mockup_117023-1349.jpg?size=626&ext=jpg">
					<img class="thumbnail" src="https://www.pngfind.com/pngs/m/517-5179417_book-mockup-png-graphic-design-transparent-png.png"> -->
		
                    </div>

                    <img id="slideRight" class="arrow" src="singleProduct/images/arrow-right.png">

			</div>
            </div>

            </div>
            <div class="col-lg-6">
				<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
					<ol class="breadcrumb ms-2">
						<li class="breadcrumb-item"><a href="javascript:void(0)" class="smallLinkTitle f-w5">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page"> <a href="javascript:void(0)" class="smallLinkTitle f-w5"><?= $row['prod_name']; ?></a></li>
					</ol>
				</nav>

               <div class="card">
                   <div class="card-header">
                       Category : <a href="show-books.php?pcategories=<?= $row['prod_pcat_id']; ?>" class="smallLinkTitle ms-2 fw-bolder"><?= getPcatName($row['prod_pcat_id']); ?></a>
                   </div>
                   <div class="card-body">
                       <div class="card-title">
                          <h2 class="fw-bolder"> <?= $row['prod_name']; ?></h2>
                       </div>
                       <div class="my-1">
                       Written By<a href="show-books.php?author=<?= $row['prod_author_id']?>" class="text-success fw-bolder smallLinkTitle ms-4">  <?= getAuthorName($row['prod_author_id']); ?></a>
                       </div>

                       <div class="my-1"> Category : <a href="show-books.php?pcategories=<?= $row['prod_pcat_id']; ?>" class="smallLinkTitle text-success fw-bolder ms-4"><?= getPcatName($row['prod_pcat_id']); ?></a> <span class="text-danger fw-bolder ms-2">For</span> <a href="filter-products.php?categories=<?= $row['prod_cat_id']; ?>" class="smallLinkTitle text-success fw-bolder ms-2"><?= getCategoryName($row['prod_cat_id']); ?></a></div>


                       <div class="my-1"> Publisher : <a href="show-books.php?publisher=<?= $row['prod_publisher_id']; ?>" class="smallLinkTitle text-success fw-bolder ms-4"><?= getPublisherName($row['prod_publisher_id']); ?></a></div>

                       <div class="my-1">
                       Language : <a href="show-books.php?language=<?= $row['prod_lang']?>" class="smallLinkTitle text-success fw-bolder ms-4"> <?= $row['prod_lang']; ?></a></div>
                       <div class="my-1">
                       Total Pages : <span class="text-success fw-bolder ms-4"> <?= $row['prod_pages']; ?> Pages</span></div>

                       <div class="my-1">
                       Belongs to : <a href="show-books.php?subject=<?= $row['prod_subject']; ?> " class="smallLinkTitle text-success fw-bolder ms-4"> <?= $row['prod_subject']; ?> Subject</a></div>

                       <div class="my-1">
                       Product ISBN No. : <span class="text-success fw-bolder ms-4"> <?= $row['prod_isbn']; ?></span></div>

                       <div class="my-1">Availability : 
                           <?php if (($row['prod_stock']) > 0) { 
                               echo '<span class="text-success fw-bolder ms-4">In Stock</span></div>';
                           }else{
                                echo '<span class="text-danger fw-bolder ms-4">Out Of Stock</span></div>';
                           } ?>
                        
                           
                   
                   <div class="card-title my-3">
                   
                        <h4 class="card-text fullprice">Price <span class="price ms-2">RS. <?= $row['prod_price']; ?> <span class="text-success ms-1 mrp"><s>RS. <?= $row['prod_mrp']; ?></s></span></span><span class="text-primary ms-2 priceoff"><?= $row['prod_discount']; ?>% OFF</span></h4>  

                   </div>
                   
                   <div>
                        <?php if (($row['prod_stock']) < 10 and ($row['prod_stock']) > 0) { 
                               echo '<span class="text-danger fw-bolder">Hurry up! Only "'.$row['prod_stock'].'" Items Left</span>';
                           }else if(($row['prod_stock']) == 0 ){
                                echo '<span class="text-danger fw-bolder">Out Of Stock</span>';
                           }
                               
                            else{
                                echo '<span class="text-success fw-bolder">Buy Now! "'.$row['prod_stock'].' "Items Left</span>';
                           } ?>
                       

                       
                           <div class="row mt-3">
                               <div class="col-lg-3 d-flex justify-content-center align-items-center">
                                    <label for="qty" class="form-label fw-bolder">Select Quantity</label>
                               </div>
                               <div class="col-lg-4">
                                    <select class="form-select" aria-label="Default select example" name="qty" id="qty">
                                        <option value=0 selected>Choose Quantity</option>
                                        <?php
                                            if($row['prod_stock'] <=10){
                                                echo"yes";
                                                for($i=1;$i<=$row['prod_stock'];$i++){
                                                    echo"<option  value='{$i}'>{$i}</option>";
                                                }
                                            }else if($row['prod_stock'] > 10){
                                                echo"No";
                                                for($i=1;$i<=10;$i++){
                                                    echo"<option  value='{$i}'>{$i}</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-4 d-flex justify-content-center align-items-center">
                                    Delivery In : <span class="text-success fw-bolder ms-2"> 5 Days
                                </span></div>
                            <div class="text-center mt-4" id="PopulateButton">
                                <!-- <a href="#" class="btn btn-primary btn-success ms-4 me-4 ownbtnred"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</a>
                                <a href="singleproduct.php" class="btn btn-primary ms-4 me-4 ownbtn "><i class="fa fa-eye" aria-hidden="true"></i> Buy Now</a> -->
                            </div>
                            </div>
                       
                   </div>
                   </div>

               </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card my-2">
                        <div class="col-lg-12 mt-3">
                            <button class="btn btn-outline-primary mx-2 f-w5 mt-2 " id="btn1">Description</button>
                            <button class="btn btn-outline-success mx-2 f-w5 mt-2" id="btn2">Features</button>
                            <button class="btn btn-outline-danger mx-2 f-w5 mt-2" id="btn3">Product Discuss</button>
                            <!-- <button class="btn btn-outline-success mx-2 f-w5" id="btn2">Keywords</button>
                            <button class="btn btn-outline-danger mx-2 f-w5" id="btn3">Tags</button> -->
                            <button class="btn btn-outline-primary mx-2 f-w5 mt-2" id="btn4">Reviews</button>
                        </div>
                        
                        <div id="desc1" class="card-body my-2">
                            <?php

                                $prod_desc_id=$row['prod_desc_id'];
                                $descSql = mysqli_query($conn,"SELECT * from product_description where desc_id=$prod_desc_id");

                                if(mysqli_num_rows($descSql) > 0){
                                    $row = mysqli_fetch_assoc($descSql);
                                    echo $row['prod_desc'];
                                }else{
                                    echo "No Description Available";
                                }
                            ?>
                        </div>
                        <div id="desc2"class="card-body my-2">
                            <?php
                                $sql = "SELECT * FROM products WHERE prod_status=1 and prod_slug='$slug'";

                                $runQuery = mysqli_query($conn,$sql);
                                
                                if(mysqli_num_rows($runQuery)){
                                    $row = mysqli_fetch_assoc($runQuery);
                                
                                    $product_id = $row['prod_id'];
                                }else{
                                    $row = array();
                                }

                            ?>
                            <h3 class="text-primary">Features</h3>
                            <?= $row['prod_features']; ?>
                            
                            <h4 class="text-success my-3">Keywords</h4>
                            <?= $row['prod_keywords']; ?>

                            
                        </div>
                        <div id="desc3"class="card-body my-2">
                        <?php

                            $prod_id=$row['prod_id'];
                            $descSql = mysqli_query($conn,"SELECT * from product_discuss where prod_id=$prod_id");

                            if(mysqli_num_rows($descSql) > 0){
                                $serialNumber = 0;
                                echo '<div class="accordion" id="accordionExample">';
                              while($row = mysqli_fetch_assoc($descSql)){
                                  $serialNumber++;
                                  if($serialNumber == 1){
                                      $yes = 'show';
                                  }else{
                                      $yes='';
                                  }
                                  ?>
                            
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?= $row['dis_id']?>">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#open<?= $row['dis_id']?>" aria-expanded="false" aria-controls="open<?= $row['dis_id']?>">
                                               <strong class='fw-bolder fs-6 text-primary'> <?= $row['dis_title']?></strong>
                                    </button>
                                    </h2>
                                    <div id="open<?= $row['dis_id']?>" class="accordion-collapse collapse opensClose <?= $yes ?>" aria-labelledby="heading<?= $row['dis_id']?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong class='fw-bolder fs-6 text-success'><?= $row['dis_desc']?></strong>
                                    </div>
                                    </div>
                                </div>
                                
                            <?php
                                }
                            echo '</div>';
                                
                            }else{
                                echo "No Product Discussion Available";
                            }
                        ?>
                        </div>
                        <div id="desc4"class="card-body my-2">
                            <?php include('reviews.php') ?>
                        </div>
                        
                    </div>
                </div>
            </div>




           
        <a href="/" class="btn btn-secondary w-100 fs-2 mt-2 mb-2 fw-bolder ftext"> <span class=" text-white">See All Related Books</span> </a>

        <div class="row my-2" id="GetDataInRelatedProducts">
            


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
        
        $("#desc2").hide();
        $("#desc3").hide();
        $("#desc4").hide();
        
        $("#btn1").addClass("active");
        $("#btn2").removeClass("active");
        $("#btn3").removeClass("active");
        $("#btn4").removeClass("active");

           
            $(".publisher").typed({
                strings: ["See Publisher All Books","Add to cart Books" ,"Buy Books " ,"Welcome to Book Store!", "See Our All Books", "Go To Books", "See All Authors", "Thanks for visit"],
                typeSpeed: 50,
                loop: true,
                backSpeed: 50,
                startDelay: 1,
                backDelay: 2000
            });

            $("#btn1").on("click", function(){
                $("#btn1").removeClass("active");
                $("#btn1").addClass("active");
                $("#desc1").show();
                $("#desc2").hide();
                $("#desc3").hide();
                $("#desc4").hide();
                $("#btn2").removeClass("active");
                $("#btn3").removeClass("active");
                $("#btn4").removeClass("active");

            });
            $("#btn2").on("click", function(){
                $("#btn2").addClass("active");
                $("#desc1").hide();
                $("#desc2").show();
                $("#desc3").hide();
                $("#desc4").hide();
                $("#btn1").removeClass("active");
                $("#btn3").removeClass("active");
                $("#btn4").removeClass("active");

            });
            $("#btn3").on("click", function(){
                $("#btn3").addClass("active");
                $("#desc1").hide();
                $("#desc2").hide();
                $("#desc3").show();
                $("#desc4").hide();
                $("#btn2").removeClass("active");
                $("#btn1").removeClass("active");
                $("#btn4").removeClass("active");

            });
            $("#btn4").on("click", function(){
                $("#btn4").addClass("active");
                $("#desc1").hide();
                $("#desc2").hide();
                $("#desc3").hide();
                $("#desc4").show();
                $("#btn2").removeClass("active");
                $("#btn3").removeClass("active");
                $("#btn1").removeClass("active");

            });

        
    });



    // for get data which are passing in Url
    var params = new window.URLSearchParams(window.location.search);

    function populateButton(slug){
            
        $.ajax({
        url: "frontend/singleProduct.php",
        type: "POST",
        data: {'slug':slug,'populate_button':true},
        success: function(data) {
        //  console.log(data);
        //  alert(data);
            $("#PopulateButton").html(data);
            
        }
        });
    }

    if(params.get('slug')){

        let slug = params.get('slug');

        // alert("Hello");

        populateButton(slug);

        
    }



    // This function is used for Add to Cart

    $(document).on("click","#addInCart",function() {

        // alert("Add to Cart");
        //  alert($("#qty").val());
        
        let allData = $(this).data("productdata");
        let myArray = allData.split('@');
        let productID = myArray[0];
        let productQty = $("#qty").val();

        let slug = params.get('slug');
        
        
        // console.log(productID);
        // alert(allData);
        if(productQty != 0){
            $.ajax({
            url: "frontend/addToCart.php",
            type: "POST",
            data: "product_id="+productID+"&product_qty="+productQty+"&addToCart",
            success: function(data) {
                swal("Congratulations!", "Added One Item in Cart!", "success");
                populateButton(slug);
                // console.log(data);
                let totalCartProduct = $("#cartNumber").text();
                console.log(totalCartProduct)
                totalCartProduct++;
                $("#cartNumber").text(totalCartProduct);
            }
            });
        }else{
            swal("Choose Quantity!", "Please Select atleast One Quantity!", "info");
        }

    });


    // This function is used for Add to Cart

    $(document).on("click","#addInCartToBuy",function() {

        // alert("Add to Cart");
        //  alert($("#qty").val());
        
        let allData = $(this).data("productdata");
        let myArray = allData.split('@');
        let productID = myArray[0];
        let productQty = $("#qty").val();

        let slug = params.get('slug');
        
        
        // console.log(productID);
        // alert(allData);
        if(productQty != 0){
            $.ajax({
            url: "frontend/addToCart.php",
            type: "POST",
            data: "product_id="+productID+"&product_qty="+productQty+"&addToCart",
            success: function(data) {
               // swal("Congratulations!", "Added One Item in Cart!", "success");
              //  populateButton(slug);
                // console.log(data);
                let totalCartProduct = $("#cartNumber").text();
                console.log(totalCartProduct)
                totalCartProduct++;
                $("#cartNumber").text(totalCartProduct);

                window.location.href = 'checkout.php?cart';
            }
            });
        }else{
            swal("Choose Quantity!", "Please Select atleast One Quantity!", "info");
        }

    });




    // For getting related product data

    function viewAllRelatedProducts(page){
        let slug = params.get('slug');
        $.ajax({
          url: "frontend/getAllRelatedProducts.php",
          type: "POST",
          data: {page_no :page,'slug':slug ,'view_relatedProducts':true},
          success: function(data) {
          //  console.log(data);
          //  alert(data);
              $("#GetDataInRelatedProducts").html(data);
              
          }
        });
    }
        
    viewAllRelatedProducts();

    $(document).on("click","#addToCart",function() {
        
        let allData = $(this).data("productdata");
        let myArray = allData.split('@');
        let productID = myArray[0];
        let productQty = 1;
        let pageno = myArray[1];
        // console.log(productID);
        // alert(allData);

        $.ajax({
          url: "frontend/addToCart.php",
          type: "POST",
          data: "product_id="+productID+"&product_qty="+productQty+"&addToCart",
          success: function(data) {
            swal("Congratulations!", "Added One Item in Cart!", "success");
            viewAllRelatedProducts(pageno);
            console.log(data);
            let totalCartProduct = $("#cartNumber").text();
            console.log(totalCartProduct)
            totalCartProduct++;
            $("#cartNumber").text(totalCartProduct);
          }
        });

      });


    //Pagination Code
    $(document).on("click","#pagination a",function(e) {
      e.preventDefault();
      var page_id = $(this).attr("id");

      viewAllRelatedProducts(page_id);
      
    });


     
  </script>
  <script type="text/javascript" src="singleProduct/singleproductslider.js" ></script>
  <script type="text/javascript" src="singleProduct/singleproduct.js" ></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  <script type="text/javascript" src="includes/signup.js"></script>
  <script type="text/javascript" src="includes/signout.js"></script>



</body>
</html>