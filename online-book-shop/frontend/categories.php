<?php

session_start();
include('function.php');

$cartArr = getUserFullCart();

// print_r($cartArr);



// This Code is for Viewing All Datas of Category with Pagination
if(isset($_POST['view_categories'])){

    $limit_per_page = 2;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM categories ORDER BY cat_id DESC LIMIT {$offset},{$limit_per_page}";
    
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
                
                <img src='admin/Images/CategoryImages/{$row['cat_pic']}' class='mt-2 border rounded-circle border-primary border-3 p-1 img-hover1' altclass='card-img-top' width='150px' height='150px' alt='...'>
                <div class='card-body p-0 my-3 d-flex flex-column justify-content-center align-items-center'>
    
                    <a href='filter-products.php?categories={$row['cat_id']}' class='card-title smallLinkTitle text-dark text-center' id='oneLineTitle' ><h4 class='card-title fw-bolder fwb title'>{$row['cat_name']}</h4></a>
                    <span class='p-0' id='oneLineTitle'>{$row['cat_desc']}</span>
                            
                            
                    <a href='filter-products.php?categories={$row['cat_id']}' class='btn btn-outline-primary fwb'>See All Books</a>
                </div>
            </div>
        </div>";

      
           $sno++; 
        }
        $output .= "</div>";

        $sql_total = "SELECT * FROM categories ORDER BY cat_id DESC";
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