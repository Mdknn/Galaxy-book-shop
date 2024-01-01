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
    <title>Category Wise Books | Galaxy Book Shop</title>
    <link rel="icon" type="image/x-icon" href="gfav.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body onload="myFunction()">

<div id="loadanimation"></div>

<?php include('includes/navbar.php') ?>
    <div class="container" style="min-height:100vh;">
        <a href="javascript:void(0)" class="btn btn-primary w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="publisher text-white">See All Subject Related Books</span> </a>

        <div class="row" id="GetCategoriesData">
            
 
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

    $(function () {
           
            $(".publisher").typed({
                strings: ["See Publisher All Books","Add to cart Books" ,"Buy Books " ,"Welcome to Book Store!", "See Our All Books", "Go To Books", "See All Authors", "Thanks for visit"],
                typeSpeed: 50,
                loop: true,
                backSpeed: 50,
                startDelay: 1,
                backDelay: 2000
            });
        });


    //  for View Categories ("This function is Run When Page Refresh")
$(document).ready(function() {


// Process Of pubs Start Here


// let viewCat = document.getElementById('viewCatData');
function viewAllCategories(page){
    $.ajax({
      url: "frontend/categories.php",
      type: "POST",
      data: {page_no :page ,'view_categories':true},
      success: function(data) {
      //  console.log(data);
      //  alert(data);
          $("#GetCategoriesData").html(data);
          
      }
    });
}
viewAllCategories();

  //Pagination Code
  $(document).on("click","#pagination a",function(e) {
    e.preventDefault();
    var page_id = $(this).attr("id");

    viewAllCategories(page_id);
  });

  
});
    


  </script>

    

</body>
</html>