<?php

session_start();
include('function.php');

$cartArr = getUserFullCart();

// print_r($cartArr);



// This Code is for Viewing All Datas of Category with Pagination
if(isset($_POST['view_products'])){

    $limit_per_page = 6;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM products Where prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";

    if(isset($_POST['cat_id'])){
        // print_r($_POST);
        $cat_id=get_safe($_POST['cat_id']);
        $sql = "SELECT * FROM products Where prod_status=1 and prod_cat_id=$cat_id ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['pcat_id'])){
        // print_r($_POST);
        $cat_id=get_safe($_POST['cat_id']);
        $pcat_id=get_safe($_POST['pcat_id']);
        $sql = "SELECT * FROM products Where prod_status=1 and prod_cat_id=$cat_id and prod_pcat_id=$pcat_id ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['lowToHighFilter'])){
        // print_r($_POST);
        $sql = "SELECT * FROM products Where prod_status=1 order by prod_price ASC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['highToLowFilter'])){
        // print_r($_POST);
        $sql = "SELECT * FROM products Where prod_status=1 order by prod_price DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['lowToHighDiscount'])){
        // print_r($_POST);
        $sql = "SELECT * FROM products Where prod_status=1 order by prod_discount ASC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['highToLowDiscount'])){
        // print_r($_POST);
        $sql = "SELECT * FROM products Where prod_status=1 order by prod_discount DESC LIMIT {$offset},{$limit_per_page}";
    }
    
    // $result1 = mysqli_query($conn,$sql);

    // For Sending Datas through Pagination anker tag
    if(isset($_POST['cat_id'])){
        $cat_id=($_POST['cat_id']);

        if(isset($_POST['pcat_id'])){
            $pcat_id=($_POST['pcat_id']);
        }else{
            $pcat_id='';
        }
    }else{
        $cat_id='';
        $pcat_id='';
    }

    if(isset($_POST['lowToHighFilter'])){
        $lowFilter = 1;
    }else{
        $lowFilter = '';
    }
    if(isset($_POST['highToLowFilter'])){
        $highFilter = 1;
    }else{
        $highFilter = '';
    }
    if(isset($_POST['lowToHighDiscount'])){
        $lowDiscount = 1;
    }else{
        $lowDiscount = '';
    }
    if(isset($_POST['highToLowDiscount'])){
        $highDiscount = 1;
    }else{
        $highDiscount = '';
    }
    
    $result = mysqli_query($conn,$sql) ;
    //print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '';
        
       // print_r($output);
        while($row = mysqli_fetch_assoc($result)) {
            
            $output .= "<div class='col-lg-4 col-md-6 col-sm-6 my-2 '>
            <div class='card '' style='width: 100%;'>
                <div class='card-header text-center' id='oneLineTitle'>Author : <a href='show-books.php?author={$row['prod_author_id']}' class='smallLinkTitle text-dark'><span class='text-success ms-2 price'>".getAuthorName($row['prod_author_id'])." </span></a></div>
                <div class='img-hover-thumb img-responsive'><img src='admin/Images/ProductImages/{$row['prod_thumbnail']}' height='180px' class='card-img-top' alt='...'></div>
                
                <div class='card-body'>
                    <a href='' class='linkTitle text-dark' id='oneLineTitle'><h5 class='card-title'>{$row['prod_name']}</h5></a>
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
                        <a data-productdata='{$row['prod_id']}@{$page}@{$cat_id}@{$pcat_id}@{$lowFilter}@{$highFilter}@{$lowDiscount}@{$highDiscount}' class='btn btn-primary btn-success ms-1 ownbtnred mb-2' id='addToCart'><i class='fa fa-cart-plus' aria-hidden='true' ></i> Add to cart </a>
                        <a href='product.php?slug={$row['prod_slug']}' class='btn btn-primary ms-1 ownbtn mb-2'><i class='fa fa-eye' aria-hidden='true'></i> View Details</a>
                        </div>
                        </div>
                    </div>";
                    }
                }else{
                    if(array_key_exists($row['prod_id'],$cartArr)){
                        $output .= "<div class='text-center p-0 m-0'>
                        <a href='cart.php' data-productdata='{$row['prod_id']}@{$page}' class='btn btn-primary btn-success ms-1 ownbtnred mb-2' style='background-color:deeppink;' ><i class='fa fa-cart-plus' aria-hidden='true' ></i> Go To Cart</a>
                        <a href='product.php?slug={$row['prod_slug']}' class='btn btn-primary ms-1 ownbtn mb-2'><i class='fa fa-eye' aria-hidden='true'></i> View Details</a>
                        </div>
                    </div>
                </div>";
    
                    }else{
    
                    $output .= "<div class='text-center p-0 m-0'>
                        <a href='javascript:void(0)' data-productdata='{$row['prod_id']}@{$page}@{$cat_id}@{$pcat_id}@{$lowFilter}@{$highFilter}@{$lowDiscount}@{$highDiscount}' class='btn btn-secondary ms-1 ownbtnred mb-2' id='outOfStock'><i class='fa fa-cart-plus' aria-hidden='true' ></i> Out Of Stock </a>
                        <a href='product.php?slug={$row['prod_slug']}' class='btn btn-primary ms-1 ownbtn mb-2'><i class='fa fa-eye' aria-hidden='true'></i> View Details</a>
                        </div>
                        </div>
                    </div>";
                    }
                }
                
            
           $sno++; 
        }
        $output .= "</div>";

        $sql_total = "SELECT * FROM products Where prod_status=1";

        if(isset($_POST['cat_id'])){
            // print_r($_POST);
            $cat_id=get_safe($_POST['cat_id']);
            $sql_total = "SELECT * FROM products Where prod_status=1 and prod_cat_id=$cat_id ORDER BY prod_id DESC";
        }
        if(isset($_POST['pcat_id'])){
            // print_r($_POST);
            $cat_id=get_safe($_POST['cat_id']);
            $pcat_id=get_safe($_POST['pcat_id']);
            $sql_total = "SELECT * FROM products Where prod_status=1 and prod_cat_id=$cat_id and prod_pcat_id=$pcat_id ORDER BY prod_id DESC";
        }
        if(isset($_POST['lowToHighFilter'])){
            $sql_total = "SELECT * FROM products Where prod_status=1 order by prod_price ASC";
        }
        if(isset($_POST['highToLowFilter'])){
            $sql_total = "SELECT * FROM products Where prod_status=1 order by prod_price DESC";
        }
        if(isset($_POST['lowToHighDiscount'])){
            $sql_total = "SELECT * FROM products Where prod_status=1 order by prod_discount ASC";
        }
        if(isset($_POST['highToLowDiscount'])){
            $sql_total = "SELECT * FROM products Where prod_status=1 order by prod_discount DESC";
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
        
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' data-alldata='{$cat_id}@{$pcat_id}@{$lowFilter}@{$highFilter}@{$lowDiscount}@{$highDiscount}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}



if(isset($_POST['get_pcatName'])){

    $cat_id = get_safe($_POST['cat_id']);

    $sql = "select * from product_categories where cat_id=$cat_id and pcat_status=1";

    $runQuery = mysqli_query($conn, $sql);

    $output="";

    

    if(mysqli_num_rows($runQuery) >0){
        $output .='<a href="#" id="filterpName" class="list-group-item list-group-item-action mt-5 f-w5 fs-5 text-white" style="background-color:red;">
            Product Categories
        </a><div class="list-group my-2">';
        while($rows=mysqli_fetch_assoc($runQuery)){
            $output .= "<a href='#' data-pcatdata='{$rows['cat_id']}@{$rows['pcat_id']}@{$rows['pcat_name']}' class='list-group-item list-group-item-action pcategoryFilter oneLineTitleClass'>{$rows['pcat_name']}</a>";   
            
        }
        $output .= '</div>
        </div>';

        echo $output;
    }
    else{
        echo "No Data";
    }
}


?>