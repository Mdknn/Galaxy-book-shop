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
    <title>Filtered Products | Galaxy Book Shop</title>
    <link rel="icon" type="image/x-icon" href="gfav.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body onload="myFunction()">

<div id="loadanimation"></div>

<?php include('includes/navbar.php') ?>
    <div class="container" style="min-height:100vh;">
        <a href="javascript:void(0)" class="btn btn-primary w-100 fs-2 mt-2 mb-2 fw-bolder ftext oneLineTitleClass" id="filterName"> <span class=" text-white">See All Subject Related Books</span> </a>

        <div class="row" id="GetAllSubjects">
             <!-- First Row Start
            <div class="col-lg-3 col-md-4 col-sm-6 mt-3 ">
            <div class="card d-flex flex-column justify-content-center align-items-center" style="width:100%"  >
            <a href="/"class="img-hover-small" data-lightbox="image-1" data-title="Vk Blogs">
            <img src="https://cdn.dribbble.com/users/846207/screenshots/4533621/flippingbook.gif" class="mt-2 border rounded-circle border-primary border-3 p-1 img-hover1" altclass="card-img-top" width="150px" height="150px" alt="..."></a>
            <div class="card-body p-0 my-3">

            <a href="/" class="card-title smallLinkTitle text-dark text-center" ><h5 class="card-title fw-bolder fwb title">Class Seven</h5></a>


            <a href="authorposts.php" class="btn btn-outline-primary fwb">See All Books</a>
            </div>
            </div>
            </div> -->
    <!-- First Row End -->
 
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



    var params = new window.URLSearchParams(window.location.search);

// This is Test for Subjects and Show All Datas
    if(params.get('allsubject')){

        $('#filterName').html("See All Subjects");
        $('#filterName').addClass('btn-danger');
        // console.log(params.get('allsubject'));
    //  for View Categories ("This function is Run When Page Refresh")
    
        $(document).ready(function() {

        function viewAllSubjects(page){
            $.ajax({
            url: "frontend/getDataDropdown.php",
            type: "POST",
            data: {page_no :page ,'view_datas':true,'view_subjects':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllSubjects").html(data);
                
            }
            });
        }
        viewAllSubjects();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewAllSubjects(page_id);
        });
        


        });
    }



    if(params.get('language')){
       // alert("gazab");

       $('#filterName').html("See All Book Languages");
        $('#filterName').addClass('btn-success');

       $(document).ready(function() {

        function viewAllSubjects(page){
            $.ajax({
            url: "frontend/getDataDropdown.php",
            type: "POST",
            data: {page_no :page ,'view_datas':true,'view_language':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllSubjects").html(data);
                
            }
            });
        }
        viewAllSubjects();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewAllSubjects(page_id);
        });



        });

    }




    if(params.get('author')){
       // alert("gazab");

       $('#filterName').html("See All Authors");
       $('#filterName').addClass('btn-info');


       $(document).ready(function() {

        function viewAllAuthors(page){
            $.ajax({
            url: "frontend/getDataDropdown.php",
            type: "POST",
            data: {page_no :page ,'view_datas':true,'view_author':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllSubjects").html(data);
                
            }
            });
        }
        viewAllAuthors();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewAllAuthors(page_id);
        });



        });

    }




    if(params.get('publisher')){
       // alert("gazab");

       $('#filterName').html("See All Publishers");
       $('#filterName').addClass('btn-warning');


       $(document).ready(function() {

        function viewAllPublishers(page){
            $.ajax({
            url: "frontend/getDataDropdown.php",
            type: "POST",
            data: {page_no :page ,'view_datas':true,'view_publisher':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllSubjects").html(data);
                
            }
            });
        }
        viewAllPublishers();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewAllPublishers(page_id);
        });

        });

    }






    if(params.get('suitage')){
       // alert("gazab");

       $('#filterName').html("See Books By Recommended Age Wise");
       $('#filterName').addClass('btn-primary');


       $(document).ready(function() {

        function viewAllSuitAges(page){
            $.ajax({
            url: "frontend/getDataDropdown.php",
            type: "POST",
            data: {page_no :page ,'view_datas':true,'view_suitage':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllSubjects").html(data);
                
            }
            });
        }
        viewAllSuitAges();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewAllSuitAges(page_id);
        });

        });

    }




    if(params.get('categories')){
       // alert("gazab");

       $('#filterName').html("See All Categories");
       $('#filterName').addClass('btn-success');


       let categories = params.get('categories');

       $(document).ready(function() {

        function viewAllPcategories(page){
            $.ajax({
            url: "frontend/getDataDropdown.php",
            type: "POST",
            data: {page_no :page ,'view_datas':true,'view_pcategories':true , 'cat_id':categories},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllSubjects").html(data);
                
            }
            });
        }
        viewAllPcategories();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewAllPcategories(page_id);
        });

        });

    }




    // This is Test for Subjects and Show All Datas
    if(params.get('discount')){

    $('#filterName').html("See Books Discount Wise");
    $('#filterName').addClass('btn-success');
    // console.log(params.get('allsubject'));
    //  for View Categories ("This function is Run When Page Refresh")

    $(document).ready(function() {

    function viewAllDiscount(page){
        $.ajax({
        url: "frontend/getDataDropdown.php",
        type: "POST",
        data: {page_no :page ,'view_datas':true,'view_discount':true},
        success: function(data) {
        //  console.log(data);
        //  alert(data);
            $("#GetAllSubjects").html(data);
            
        }
        });
    }
    viewAllDiscount();

    //Pagination Code
    $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");

        viewAllDiscount(page_id);
    });



    });
    }



  </script>

    

</body>
</html>