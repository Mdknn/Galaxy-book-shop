<?php

session_start();
include('function.php');

$cartArr = getUserFullCart();

// print_r($cartArr);

if(isset($_POST['view_products'])){
    $allProducts = 1;
}else{
    $allProducts = '';
}
if(isset($_POST['view_authors'])){
    $allAuthors = 1;
}else{
    $allAuthors = '';
}
if(isset($_POST['view_publishers'])){
    $allPublishers = 1;
}else{
    $allPublishers = '';
}


// This Code is for Viewing All Datas of Category with Pagination
if(isset($_POST['view_products'])){

    $limit_per_page = 8;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM products where prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    
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
                <div id='oneLineTitle' class='card-header text-center'>Author : <a href='show-books.php?author={$row['prod_author_id']}' class='smallLinkTitle text-dark' ><span class='text-success ms-2 price'>".getAuthorName($row['prod_author_id'])." </span></a></div>
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

        $sql_total = "SELECT * FROM products where prod_status=1 ORDER BY prod_id DESC";
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
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' data-check='{$allProducts}@{$allAuthors}@{$allPublishers}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}





if(isset($_POST['view_authors'])){

    $limit_per_page = 4;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM authors where author_status=1 ORDER BY author_id DESC LIMIT {$offset},{$limit_per_page}";
    
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
            <div class='card d-flex flex-column justify-content-center align-items-center' style='width:100%'  >
                
                <img src='admin/Images/AuthorImages/{$row['author_pic']}' class='mt-2 img-hover-small border rounded-circle border-primary border-3 p-1 img-hover1' altclass='card-img-top' width='150px' height='150px' alt='...'>
                <div class='card-body p-0 my-3 d-flex flex-column justify-content-center align-items-center'>
    
                    <a href='show-books.php?author={$row['author_id']}' class='card-title smallLinkTitle text-dark text-center' id='oneLineTitle' ><h4 class='card-title fw-bolder fwb title'>{$row['author_name']}</h4></a>
                    <span class='p-0' id='oneLineTitle'>{$row['author_desc']}</span>
                            
                            
                    <a href='show-books.php?author={$row['author_id']}' class='btn btn-outline-primary fwb'>See All Books</a>
                </div>
            </div>
        </div>";

      
           $sno++; 
        }
        $output .= "</div>";

        $sql_total = "SELECT * FROM authors where author_status=1 ORDER BY author_id DESC";
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
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' data-check='{$allProducts}@{$allAuthors}@{$allPublishers}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }


}







if(isset($_POST['view_publishers'])){

    $limit_per_page = 4;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM publishers where pub_status=1 ORDER BY pub_id DESC LIMIT {$offset},{$limit_per_page}";
    
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
            <div class='card d-flex flex-column justify-content-center align-items-center' style='width:100%'  >
                
                <img src='admin/Images/PublisherImages/{$row['pub_pic']}' class='mt-2 border img-hover-small rounded-circle border-primary border-3 p-1 img-hover1' altclass='card-img-top' width='150px' height='150px' alt='...'>
                <div class='card-body p-0 my-3 d-flex flex-column justify-content-center align-items-center'>
    
                    <a href='show-books.php?publisher={$row['pub_id']}' class='card-title smallLinkTitle text-dark text-center' id='oneLineTitle' ><h4 class='card-title fw-bolder fwb title'>{$row['pub_name']}</h4></a>
                    <span class='p-0' id='oneLineTitle'>{$row['pub_desc']}</span>
                            
                            
                    <a href='show-books.php?publisher={$row['pub_id']}' class='btn btn-outline-primary fwb'>See All Books</a>
                </div>
            </div>
        </div>";

      
           $sno++; 
        }
        $output .= "</div>";

        $sql_total = "SELECT * FROM publishers where pub_status=1 ORDER BY pub_id DESC";
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
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' data-check='{$allProducts}@{$allAuthors}@{$allPublishers}' href=''>{$i}</a>
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