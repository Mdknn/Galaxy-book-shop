<?php

session_start();
include('../../frontend/function.php');

$cartArr = getUserFullCart();

// print_r($cartArr);



// This Code is for Viewing All Datas of Category with Pagination
if(isset($_POST['view_allProducts'])){

    if(isset($_POST['subject'])){
        $subject = get_safe($_POST["subject"]);
    }
    
    //print_r($_POST);

    $limit_per_page = 8;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;
    if(isset($_POST['subject'])){
        $sql = "SELECT * FROM products where prod_subject='$subject' and prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }

    if(isset($_POST['language'])){
        $language = get_safe($_POST["language"]);
        $sql = "SELECT * FROM products where prod_lang='$language' and prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['author'])){
        $author = get_safe($_POST["author"]);
        $sql = "SELECT * FROM products where prod_author_id='$author' and prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['publisher'])){
        $publisher = get_safe($_POST["publisher"]);
        $sql = "SELECT * FROM products where prod_publisher_id='$publisher' and prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['suitage'])){
        $suitage = get_safe($_POST["suitage"]);
        $sql = "SELECT * FROM products where prod_see_age='$suitage' and prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['pcategories'])){
        $pcategories = get_safe($_POST["pcategories"]);
        $sql = "SELECT * FROM products where prod_pcat_id='$pcategories' and prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['trending'])){
        $sql = "SELECT * FROM products where prod_trending=1 and prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['discount'])){
        $discount = get_safe($_POST["discount"]);
        $sql = "SELECT * FROM products where prod_discount='$discount' and prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }

    if(isset($_POST['search'])){
        $search = get_safe($_POST["search"]);
        $sql = "SELECT * FROM products where prod_name LIKE '%$search%' or prod_slug LIKE '%$search%' or prod_mrp LIKE '%$search%' or prod_price LIKE '%$search%' or prod_discount LIKE '%$search%' or prod_keywords LIKE '%$search%' or prod_features LIKE '%$search%' or prod_subject LIKE '%$search%' or prod_stock LIKE '%$search%' or prod_lang LIKE '%$search%' or prod_pages LIKE '%$search%' or prod_isbn LIKE '%$search%' or prod_publication_date LIKE '%$search%' or prod_see_age LIKE '%$search%' and prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    //print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '';
        
       // print_r($output);
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<div class='col-lg-3 col-md-4 col-sm-6 mt-3 '>
            <div class='card '' style='width: 100%;'>
                <div class='card-header text-center' id='oneLineTitle'>Author : <a href='show-books.php?author={$row['prod_author_id']}' class='smallLinkTitle text-dark'><span class='text-success ms-2 price'>".getAuthorName($row['prod_author_id'])." </span></a></div>
                <div class='img-hover-thumb img-responsive'><img src='admin/Images/ProductImages/{$row['prod_thumbnail']}' class='card-img-top' height='200px' alt='...'></div>
                
                <div class='card-body'>
                    <a href='product.php?slug={$row['prod_slug']}' class='linkTitle text-dark' id='oneLineTitle'><h5 class='card-title'>{$row['prod_name']}</h5></a>
                    <p class='card-text fullprice'>Price <span class='price ms-2'>INR {$row['prod_price']} <span class='text-success ms-1 mrp'><s>INR {$row['prod_mrp']}</s></span></span><span class='text-primary ms-2 priceoff'>{$row['prod_discount']}% OFF</span></p>  
                </div>";
                
                if($row['prod_stock'] >= 1){
                    if(array_key_exists($row['prod_id'],$cartArr)){
                        $output .= "<div class='text-center p-0 m-0'>
                        <a href='cart.php' data-productdata='{$row['prod_id']}@{$page}' class='btn btn-primary btn-success ms-1 ownbtnred mb-2' style='background-color:deeppink;' ><i class='fa fa-cart-plus' aria-hidden='true' ></i> Go To Cart</a>
                        <a href='product.php?slug={$row['prod_slug']}' class='btn btn-primary ms-1 ownbtn mb-2'><i class='fa fa-eye' aria-hidden='true'></i> View Details</a>
                        </div>
                        </div>
                    </div>";

                    }else{

                    $output .= "<div class='text-center p-0 m-0'>
                        <a data-productdata='{$row['prod_id']}@{$page}' class='btn btn-primary btn-success ms-1 ownbtnred mb-2' id='addToCart'><i class='fa fa-cart-plus' aria-hidden='true' ></i> Add to cart </a>
                        <a href='product.php?slug={$row['prod_slug']}' class='btn btn-primary ms-1 ownbtn mb-2'><i class='fa fa-eye' aria-hidden='true'></i> View Details</a>
                        </div>
                        </div>
                    </div>";
                    }
                }
                else{
                    if(array_key_exists($row['prod_id'],$cartArr)){
                        $output .= "<div class='text-center p-0 m-0'>
                        <a href='cart.php' data-productdata='{$row['prod_id']}@{$page}' class='btn btn-primary btn-success ms-1 ownbtnred mb-2' style='background-color:deeppink;' ><i class='fa fa-cart-plus' aria-hidden='true' ></i> Go To Cart</a>
                        <a href='product.php?slug={$row['prod_slug']}' class='btn btn-primary ms-1 ownbtn mb-2'><i class='fa fa-eye' aria-hidden='true'></i> View Details</a>
                        </div>
                        </div>
                    </div>";

                    }else{

                    $output .= "<div class='text-center p-0 m-0'>
                        <a href='javascript:void(0)' data-productdata='{$row['prod_id']}@{$page}' class='btn btn-secondary ms-1 ownbtnred mb-2' id='outOfStock'><i class='fa fa-cart-plus' aria-hidden='true' ></i> Out Of Stock </a>
                        <a href='product.php?slug={$row['prod_slug']}' class='btn btn-primary ms-1 ownbtn mb-2'><i class='fa fa-eye' aria-hidden='true'></i> View Details</a>
                        </div>
                        </div>
                    </div>";
                    }
                }

           $sno++; 
        }
        $output .= "</div>";

        if(isset($_POST['subject'])){
            $sql_total = "SELECT * FROM products where prod_subject='$subject' and prod_status=1 ORDER BY prod_id DESC";
        }
        if(isset($_POST['language'])){
            $language = get_safe($_POST["language"]);
            $sql_total = "SELECT * FROM products where prod_lang='$language' and prod_status=1 ORDER BY prod_id DESC";
        }
        if(isset($_POST['author'])){
            $author = get_safe($_POST["author"]);
            $sql_total = "SELECT * FROM products where prod_author_id='$author' and prod_status=1 ORDER BY prod_id DESC";
        }
        if(isset($_POST['publisher'])){
            $publisher = get_safe($_POST["publisher"]);
            $sql_total = "SELECT * FROM products where prod_publisher_id='$publisher' and prod_status=1 ORDER BY prod_id DESC";
        }
        if(isset($_POST['suitage'])){
            $suitage = get_safe($_POST["suitage"]);
            $sql_total = "SELECT * FROM products where prod_see_age='$suitage' and prod_status=1 ORDER BY prod_id DESC";
        }
        if(isset($_POST['pcategories'])){
            $pcategories = get_safe($_POST["pcategories"]);
            $sql_total = "SELECT * FROM products where prod_pcat_id='$pcategories' and prod_status=1 ORDER BY prod_id DESC";
        }
        if(isset($_POST['trending'])){
            
            $sql_total = "SELECT * FROM products where prod_trending=1 and prod_status=1 ORDER BY prod_id DESC";
        }
        if(isset($_POST['discount'])){
            $discount = get_safe($_POST["discount"]);
            $sql_total = "SELECT * FROM products where prod_discount='$discount' and prod_status=1 ORDER BY prod_id DESC";
        }
        if(isset($_POST['search'])){
            $search = get_safe($_POST["search"]);
            $sql_total = "SELECT * FROM products where prod_name LIKE '%$search%' or prod_slug LIKE '%$search%' or prod_mrp LIKE '%$search%' or prod_price LIKE '%$search%' or prod_discount LIKE '%$search%' or prod_keywords LIKE '%$search%' or prod_features LIKE '%$search%' or prod_subject LIKE '%$search%' or prod_stock LIKE '%$search%' or prod_lang LIKE '%$search%' or prod_pages LIKE '%$search%' or prod_isbn LIKE '%$search%' or prod_publication_date LIKE '%$search%' or prod_see_age LIKE '%$search%' and prod_status=1 ORDER BY prod_id DESC ";
        }
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}


?>