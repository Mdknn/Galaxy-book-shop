<?php

session_start();
// print_r($_SESSION);

include('function.php');

$cartArr = getUserFullCart();

$totalCartProduct = count($cartArr);

if(isset($_POST['getcartdata'])){

    
    $output = "";

    if(count($cartArr) != 0){

    $output .= ' <div class="col-lg-9"><div class="card p-0 table-responsive"  ><table class="table table-borderless table-hover">
    <thead>
        <tr class="text-center align-middle">
            <th width="350px" >Product</th>
            <th width="140px" >Quantity</th>
            <th >Unit Mrp</th>
            <th >Discount in %</th>
            <th >Unit Price</th>
            <th>Delete</th>
            <th>SubTotal</th>
        </tr>
    </thead>
    <tbody>';
    
    foreach($cartArr as $key=>$value){

       // print_r($key);

       $output .= "<tr class='align-middle'>
       <td><img src='admin/Images/ProductImages/{$value['thumbnail']}' width='100rem' height='100px' alt=''><span class='ms-3'>{$value['name']}</span></td>
       <td class='text-center'><select class='form-select' aria-label='Default select example' id='qtySelect' data-productid='{$key}'>
       <option value='0'>Choose</option>";
        if($value['stock'] <=10){
            for($i=1;$i<=$value['stock'];$i++){
                if($value['qty'] == $i){
                    $selected = 'selected';
                }else{
                    $selected = '';
                }
                $output .= "<option {$selected} value='{$i}'>{$i}</option>";
            }
        }else if($value['stock'] > 10){
            for($i=1;$i<=10;$i++){
                if($value['qty'] == $i){
                    $selected = 'selected';
                }else{
                    $selected = '';
                }
                $output .= "<option {$selected} value='{$i}'>{$i}</option>";
            }
        }
       
       $output .= "</select></td>
       <td class='text-center fw-bolder text-danger' ><span >RS. {$value['mrp']}</span></td>
       <td class='text-center fw-bolder text-success' ><span >{$value['discount']}  %</span></td>
       <td class='text-center text-primary fw-bolder' ><span >RS. {$value['price']}</span></td>
       <td class='text-center' id='deleteCart' data-productid='{$key}' ><span class='btn btn-sm btn-outline-danger'>Delete</span></td>
       <td class='text-center text-success fw-bolder'><span>RS. {$value['subtotal']}</span></td>
   </tr>";

        
    }
    $totalPrice = 0;
    foreach($cartArr as $list){
        $totalPrice += $list['price']*$list['qty'];
    }

    $tax = ceil($totalPrice*0.02);

    $fullPrice = $totalPrice + $tax ; 

    $output .= '        
        </tbody>
    </table>

    <div class="my-2 d-flex justify-content-between align-items-center mx-2 " id="cartBtn">
        <button class="btn btn-primary"><i class="fas fa-cart-plus m-2"></i>Continue Shopping</button>
        <button id="checkoutBtn" class="btn btn-success" ><i class="fas fa-shopping-cart m-2"></i>Proceed to Checkout</button>
    </div></div>
    </div>

    <div class="col-lg-3">

        <div class="card">
            <div class="card-header">
                <h3>Order Summary</h3>
            </div>
            <div class="card-body">
            <span>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            </span>
            <div class="card-title mt-3 mb-2 f-w5">Cart SubTotal <span class="ms-4 text-success">RS. '.$totalPrice.' </span></div>
            <div class="card-title mt-3 mb-2 f-w5">TAX <span class="ms-4 text-success">2 % (RS. '.$tax.')</span></div>
            <div class="card-title mt-3 mb-2 f-w5">Delivery Charge <span class="ms-4 text-success">FREE </span></div>
            <hr>
            <div class="card-title mt-3 mb-2 f-w5">Total Amount <span class="ms-4 text-success">RS. '.$fullPrice.'</span></div>
            </div>
        </div>

    </div>
    ';

}else{
    $output .= "No Item Found";
}
    
echo $output;


} 


if(isset($_POST['update_qty'])){

    $product_id = get_safe($_POST['product_id']);
    $product_qty = get_safe($_POST['qty']);

    if(isset($_SESSION['customer_email'])){
        $user_id = $_SESSION['user_id'];       
        manageUserCart($user_id , $product_id , $product_qty );
    }else{
        
        $_SESSION['cart'][$product_id]['qty'] = $product_qty;
        
    }
}


if(isset($_POST['delete_cart'])){

    $product_id = get_safe($_POST['product_id']);

    if(isset($_SESSION['customer_email'])){
        $user_id = $_SESSION['user_id'];       
        $query = "select * from cart where user_id=$user_id and prod_id=$product_id";
        $runQuery = mysqli_query($conn,$query);
        if(mysqli_num_rows($runQuery) > 0 ){
            $row = mysqli_fetch_assoc($runQuery);
            $cart_id = $row['cart_id'];
            $delQuery = "delete from cart Where cart_id=$cart_id";
            $runDelquery = mysqli_query($conn,$delQuery);
        } 
    }else{
        
        unset($_SESSION['cart'][$product_id]);
        
    }

}



if(isset($_POST['check_login'])){

    if(isset($_SESSION['customer_email'])){
        if($_SESSION['customer_email']){
            echo "yes"; 
        }else{
            echo "no";
        }
    }else{
        echo "no";
    }
    

}
    


?>