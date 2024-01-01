<?php

session_start();
include('function.php');

$cartArr = getUserFullCart();

// print_r($cartArr);



// This Code is for Viewing All Datas of Category with Pagination
if(isset($_POST['populate_button'])){

    $slug = get_safe($_POST['slug']);

    $sql = "SELECT * FROM products where prod_status=1 and prod_slug='$slug'";

    $runQuery = mysqli_query($conn,$sql);

    if(mysqli_num_rows($runQuery)){
       
        $output = '';
       // print_r($output);
        while($row = mysqli_fetch_assoc($runQuery)) {

                if($row['prod_stock'] >0) {
                
                    if(array_key_exists($row['prod_id'],$cartArr)){
                        $output .= "
                        <a href='cart.php' data-productdata='{$row['prod_id']}' class='btn btn-primary btn-success ms-1 ownbtnred mb-2' style='background-color:deeppink;' ><i class='fa fa-cart-plus' aria-hidden='true' ></i> Go To Cart</a>
                        <a data-productdata='{$row['prod_id']}@{$row['prod_name']}' id='addInCartToBuy' class='btn btn-primary ms-1 ownbtn mb-2'><i class='fa fa-eye' aria-hidden='true'></i> Buy Product</a>
                        ";

                    }else{

                    $output .= "
                        <a data-productdata='{$row['prod_id']}@{$row['prod_name']}' class='btn btn-primary btn-success ms-1 ownbtnred mb-2' id='addInCart'><i class='fa fa-cart-plus' aria-hidden='true' ></i> Add to cart </a>
                        <a  data-productdata='{$row['prod_id']}@{$row['prod_name']}' class='btn btn-primary ms-1 ownbtn mb-2' id='addInCartToBuy'><i class='fa fa-eye' aria-hidden='true'></i> Buy Product</a>
                    ";
                    }
                }else{
                    if(array_key_exists($row['prod_id'],$cartArr)){
                        $output .= "
                        <a href='cart.php' data-productdata='{$row['prod_id']}' class='btn btn-primary btn-success ms-1 ownbtnred mb-2' style='background-color:deeppink;' ><i class='fa fa-cart-plus' aria-hidden='true' ></i> Go To Cart</a>
                        <a href='javascript:void(0)'  class='btn btn-primary ms-1 disable ownbtn mb-2'><i class='fa fa-eye' aria-hidden='true'></i> Out Of Stock</a>
                        ";

                    }else{

                    $output .= "
                        <a href='javascript:void(0)' data-productdata='{$row['prod_id']}@{$row['prod_name']}' class='btn btn-secondary ms-1 ownbtnred mb-2' id='outOfStock'><i class='fa fa-cart-plus' aria-hidden='true' ></i> Out Of Stock </a>
                        <a href='javascript:void(0)' class='btn btn-primary disable ms-1 ownbtn mb-2'><i class='fa fa-eye' aria-hidden='true'></i> Out Of Stock</a>
                    ";
                    }
                }
            
           
        }
        
        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}






?>