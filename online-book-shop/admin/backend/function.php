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
  // print_r($data);
  return $data ;
}

function getCategoryName($cat_id){
  global $conn;
  $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
  $run = mysqli_query($conn , $query);
  $data = mysqli_fetch_array($run);
    
    
  return $data['cat_name'] ;
}

function getPcatName($pcat_id){
  global $conn;
  $query = "SELECT * FROM product_categories WHERE pcat_id = $pcat_id";
  $run = mysqli_query($conn , $query);
  $data = mysqli_fetch_array($run);
    
    
  return $data['pcat_name'] ;
}

function getAuthorName($author_id){
  global $conn;
  $query = "SELECT * FROM authors WHERE author_id = $author_id";
  $run = mysqli_query($conn , $query);
  $data = mysqli_fetch_array($run);
    
    
  return $data['author_name'] ;
}

function getPublisherName($pub_id){
  global $conn;
  $query = "SELECT * FROM publishers WHERE pub_id = $pub_id";
  $run = mysqli_query($conn , $query);
  $data = mysqli_fetch_array($run);
    
    
  return $data['pub_name'] ;
}
function getDescriptionName($desc_id){
  global $conn;
  $query = "SELECT * FROM product_description WHERE desc_id = $desc_id";
  $run = mysqli_query($conn , $query);
  $data = mysqli_fetch_array($run);
    
    
  return $data['desc_name'] ;
}
function getProductName($prod_id){
  global $conn;
  $query = "SELECT * FROM products WHERE prod_id = $prod_id";
  $run = mysqli_query($conn , $query);
  $data = mysqli_fetch_array($run);
    
    
  return $data['prod_name'] ;
}




// Getting All Total Numbers
function getAllNumberAuthors(){
  global $conn;
  $query = "SELECT * FROM authors";
  $run = mysqli_query($conn , $query);
  
  $number = mysqli_num_rows($run);
  
  return $number ;
}
function getAllNumberPublishers(){
  global $conn;
  $query = "SELECT * FROM publishers";
  $run = mysqli_query($conn , $query);
  
  $number = mysqli_num_rows($run);
  
  return $number ;
}
function getAllNumberProducts(){
  global $conn;
  $query = "SELECT * FROM products";
  $run = mysqli_query($conn , $query);
  
  $number = mysqli_num_rows($run);
  
  return $number ;
}
function getAllNumberUsers(){
  global $conn;
  $query = "SELECT * FROM registration";
  $run = mysqli_query($conn , $query);
  
  $number = mysqli_num_rows($run);
  
  return $number ;
}

?>