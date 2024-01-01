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








function getUserCart(){
  global $conn;
  $arr = array();
  $user_id = $_SESSION['user_id'];
  $res = mysqli_query($conn , "SELECT * FROM cart where user_id=$user_id");
  while($row = mysqli_fetch_assoc($res)){
    $arr[] = $row;
  }
  return $arr;
}


function manageUserCart($user_id , $product_id , $product_qty ){
  global $conn;
  $checkQuery = "select * from cart where user_id=$user_id and prod_id=$product_id";
  $res = mysqli_query($conn,$checkQuery);
  if(mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);
    $cart_id = $row['cart_id'];
    $updateQuery = "UPDATE `cart` SET `prod_qty`=$product_qty WHERE cart_id=$cart_id";
    mysqli_query($conn,$updateQuery);
  }else{
    $insertQuery = "INSERT INTO `cart`( `user_id`, `prod_id`, `prod_qty`) VALUES ($user_id ,$product_id ,$product_qty)";
    mysqli_query($conn,$insertQuery);
            
  }
}


function getUserFullCart(){
  $cartArr = array();
  if(isset($_SESSION['customer_email'])){
    $getUserCart = getUserCart();

    foreach ($getUserCart as $list){
        $cartArr[$list['prod_id']]['qty'] = $list['prod_qty'];
        $productDeatils = getProductDetailsById($list['prod_id']);
        //print_r($productDeatils);
        $cartArr[$list['prod_id']]['name'] = $productDeatils['prod_name'];
        $cartArr[$list['prod_id']]['mrp'] = $productDeatils['prod_mrp'];
        $cartArr[$list['prod_id']]['price'] = $productDeatils['prod_price'];
        $cartArr[$list['prod_id']]['subtotal'] = $productDeatils['prod_price']*$list['prod_qty'];
        $cartArr[$list['prod_id']]['discount'] = $productDeatils['prod_discount'];
        $cartArr[$list['prod_id']]['thumbnail'] = $productDeatils['prod_thumbnail'];
        $cartArr[$list['prod_id']]['stock'] = $productDeatils['prod_stock'];
    }
}else{
    if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
      foreach ($_SESSION['cart'] as $key=>$value){
        $cartArr[$key]['qty'] = $value['qty'];
        $productDeatils = getProductDetailsById($key);
        $cartArr[$key]['name'] = $productDeatils['prod_name'];
        $cartArr[$key]['mrp'] = $productDeatils['prod_mrp'];
        $cartArr[$key]['price'] = $productDeatils['prod_price'];
        $cartArr[$key]['subtotal'] = $productDeatils['prod_price']*$value['qty'];
        $cartArr[$key]['discount'] = $productDeatils['prod_discount'];
        $cartArr[$key]['thumbnail'] = $productDeatils['prod_thumbnail'];
        $cartArr[$key]['stock'] = $productDeatils['prod_stock'];
      } 
    }
}
// echo"<pre>";
// print_r($cartArr);
// echo "</pre>";

return $cartArr;
}


function getProductDetailsById($prod_id){
  global $conn;
  
  // $user_id = $_SESSION['user_id'];
  $res = mysqli_query($conn , "SELECT * FROM products where prod_id=$prod_id");
  $row = mysqli_fetch_assoc($res);
  return $row;
}

?>