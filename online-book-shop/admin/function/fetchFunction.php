<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "online_book_shop";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function get_safe($data){
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

function getAllCategories(){
    global $conn;
    $query = "SELECT * FROM categories WHERE cat_status = 1";
    $run = mysqli_query($conn , $query);
    $data = array();
    
    while($d = mysqli_fetch_assoc($run)){
        $data[] = $d ;
    }
    //print_r($data);
    return $data ;
}
// getAllCategories();

function getAllAuthors(){
    global $conn;
    $query = "SELECT * FROM authors WHERE author_status = 1";
    $run = mysqli_query($conn , $query);
    $data = array();
    
    while($d = mysqli_fetch_assoc($run)){
        $data[] = $d ;
    }
    //print_r($data);
    return $data ;
}

function getAllPublishers(){
    global $conn;
    $query = "SELECT * FROM publishers WHERE pub_status = 1";
    $run = mysqli_query($conn , $query);
    $data = array();
    
    while($d = mysqli_fetch_assoc($run)){
        $data[] = $d ;
    }
    //print_r($data);
    return $data ;
}
function getAllProductDescription(){
    global $conn;
    $query = "SELECT * FROM product_description WHERE prod_status = 1";
    $run = mysqli_query($conn , $query);
    $data = array();
    
    while($d = mysqli_fetch_assoc($run)){
        $data[] = $d ;
    }
    //print_r($data);
    return $data ;
}

function getAllProducts(){
    global $conn;
    $query = "SELECT * FROM products WHERE prod_status = 1";
    $run = mysqli_query($conn , $query);
    $data = array();
    
    while($d = mysqli_fetch_assoc($run)){
        $data[] = $d ;
    }
    //print_r($data);
    return $data ;
}


?>