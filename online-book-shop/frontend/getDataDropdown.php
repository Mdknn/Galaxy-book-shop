<?php

session_start();
include('function.php');

$cartArr = getUserFullCart();

// print_r($cartArr);



// This Code is for Viewing All Datas of Category with Pagination
if(isset($_POST['view_datas'])){

    $limit_per_page = 4;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;
    if(isset($_POST['view_subjects'])){
        $sql = "SELECT DISTINCT prod_subject from products where prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['view_language'])){
        $sql = "SELECT DISTINCT prod_lang from products where prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['view_author'])){
        $sql = "SELECT * from authors where author_status=1 ORDER BY author_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['view_publisher'])){
        $sql = "SELECT * from publishers where pub_status=1 ORDER BY pub_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['view_suitage'])){
        $sql = "SELECT DISTINCT prod_see_age from products where prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['view_pcategories'])){
        $cat_id = get_safe($_POST['cat_id']);
        $sql = "SELECT * from product_categories where pcat_status=1 and cat_id=$cat_id ORDER BY pcat_id DESC LIMIT {$offset},{$limit_per_page}";
    }
    if(isset($_POST['view_discount'])){
        $sql = "SELECT DISTINCT prod_discount from products where prod_status=1 ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
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

            if(isset($_POST['view_language'])){
                $data = $row['prod_lang'];
                $value = $data ." Language Books";
                $urlValue="language";
                $image="https://cdn.dribbble.com/users/846207/screenshots/4533621/flippingbook.gif";
                $desc="";
            }else if(isset($_POST['view_subjects'])){
                $data = $row['prod_subject'];
                $value = $data ." Subject";
                $urlValue="subject";
                $image="https://cdn.dribbble.com/users/846207/screenshots/4533621/flippingbook.gif";
                $desc="";
            }
            else if(isset($_POST['view_author'])){
                $data = $row['author_id'];
                $value = $row['author_name'] ;
                $urlValue="author";
                $image="admin/Images/AuthorImages/". $row['author_pic'];
                $desc="$row[author_desc]";
            }
            else if(isset($_POST['view_publisher'])){
                $data = $row['pub_id'];
                $value = $row['pub_name'] ;
                $urlValue="publisher";
                $image="admin/Images/PublisherImages/". $row['pub_pic'];
                $desc="$row[pub_desc]";
            }
            else if(isset($_POST['view_suitage'])){
                $data = $row['prod_see_age'];
                $value = "Recommended Books for Age ". $data ;
                $urlValue="suitage";
                $image="https://cdn.dribbble.com/users/846207/screenshots/4533621/flippingbook.gif";
                $desc="";
            }
            else if(isset($_POST['view_pcategories'])){
                $data = $row['pcat_id'];
                $value =  $row['pcat_name'] . " Books" ;
                $urlValue="pcategories";
                $image="admin/Images/ProdCategoryImages/". $row['pcat_pic'];
                $desc=$row['pcat_desc'];
            }
            else if(isset($_POST['view_discount'])){
                $data = $row['prod_discount'];
                $value = $data ." % Off";
                $urlValue="discount";
                $image="https://cdn.dribbble.com/users/846207/screenshots/4533621/flippingbook.gif";
                $desc="Big Sale Discount";
            }
            else{
                $data='';
                $value='';
                $urlValue ='';
                $image="";
                $desc="";
            }

            $output .= "<div class='col-lg-3 col-md-4 col-sm-6 mt-3 '>
            <div class='card d-flex flex-column justify-content-center align-items-center' style='width:100%'  >
               
                <img src='{$image}' class='mt-2 border rounded-circle border-primary img-hover-small border-3 p-1 img-hover1' altclass='card-img-top' width='150px' height='150px' alt='...'>
                <div class='card-body p-0 my-2 d-flex flex-column justify-content-center align-items-center'>
    
                    <a href='show-books.php?{$urlValue}={$data}' class='card-title smallLinkTitle text-dark text-center' id='twoLineTitle' ><h4 class='card-title fw-bolder fwb title'>{$value}</h4></a>
                    <span class='p-0' id='oneLineTitle'>{$desc}</span>
                            
                            
                    <a href='show-books.php?{$urlValue}={$data}' class='btn btn-outline-primary mt-1 fwb'>See All Books</a>
                </div>
            </div>
        </div>";
                  

       
           $sno++; 
        }
        // $output .= "</div>";
        if(isset($_POST['view_subjects'])){
            $sql_total = "SELECT DISTINCT prod_subject from products where prod_status=1 ORDER BY prod_id DESC";
        }
        if(isset($_POST['view_language'])){
            $sql_total = "SELECT DISTINCT prod_lang from products where prod_status=1 ORDER BY prod_id DESC";
        }
        if(isset($_POST['view_author'])){
            $sql_total = "SELECT * from authors where author_status=1 ORDER BY author_id DESC";
        }
        if(isset($_POST['view_publisher'])){
            $sql_total = "SELECT * from publishers where pub_status=1 ORDER BY pub_id DESC";
        }
        if(isset($_POST['view_suitage'])){
            $sql_total = "SELECT DISTINCT prod_see_age from products where prod_status=1 ORDER BY prod_id DESC";
        }
        if(isset($_POST['view_pcategories'])){
            $cat_id = get_safe($_POST['cat_id']);
            $sql_total = "SELECT * from product_categories where pcat_status=1 and cat_id=$cat_id ORDER BY pcat_id DESC";
        }
        if(isset($_POST['view_discount'])){
            $sql_total = "SELECT DISTINCT prod_discount from products where prod_status=1 ORDER BY prod_id DESC";
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