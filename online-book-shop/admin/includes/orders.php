<?php
if(isset($_SESSION['admin_email'])){
    if($_SESSION['admin_email']){

    }else{
        echo "<script>window.location.href='index.php';</script>";
    }
}else{
    echo "<script>window.location.href='index.php';</script>";
}


include('backend/function.php');

// $cartArr = getUserFullCart();

// $totalCartProduct = count($cartArr);

// //print_r($cartArr);



?>


<a href="/" class="btn btn-primary w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="publisher text-white">View All Orders</span> </a>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
				<ol class="breadcrumb ms-2">
					<li class="breadcrumb-item"><a href="#" class="smallLinkTitle f-w5">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page"> <span class="smallLinkTitle f-w5 text-success">All Orders</span></li>
				</ol>
			</nav>
            <div class="card p-0 table-responsive" id="viewAllOrders">
                

            </div>

        </div>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- This jQuery cdn is required for Lightbox -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.1/js/lightbox.min.js"></script>

<!-- <script type="text/javascript" src="https://cdn.bootcss.com/typed.js/1.1.4/typed.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.4/typed.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

    function ViewAllOrders(page){
        $.ajax({
          url: "includes/getAllOrders.php",
          type: "POST",
          data: {page_no :page ,'view_allOrders':true},
          success: function(data) {
              // console.log(data);
              // alert(data);
              $("#viewAllOrders").html(data);
              
          }
        });
    }
    ViewAllOrders();
  
      //Pagination Code
      $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");
  
        ViewAllOrders(page_id);
      })

        // $('#daysSelect').on('change', function() {
        $(document).on("change","#daysSelect",function(e) {
            loadAnimation.style.display="block";
            dateValue = this.value;
            let allData = $(this).data("id");
            let myArray = allData.split('@');
            order_id = myArray[0];
            pageNo = myArray[1];

            jQuery.ajax({
                type: "POST",
                url:'includes/getAllOrders.php',
                data:{'order_id':order_id,'date_value':dateValue,'order_del_date_change':true},
                success:function(data){
                    loadAnimation.style.display="none";
                    if(data=="Rem Date Change Successfully"){
                        ViewAllOrders(pageNo);
                        swal("Congratulations!", "Delivery Date has Updated!", "success");
                        // window.setTimeout(function () {
                        //     location.reload();
                        // }, 1000)
                    }else{
                        swal("Try Again!", "Delivery Date Could not be Update! Try Again", "error");
                    }
                }
            });

        });
        
        
        $(document).on("change","#orderStatusChange",function(e) {
            // alert( this.value );
            statusValue = this.value;
            let allData = $(this).data("id");
            let myArray = allData.split('@');
            order_id = myArray[0];
            pageNo = myArray[1];

           // alert(statusValue);

            if(statusValue == "cancel"){
                // alert("Hii");
                
                swal({
                    title: "Cancel Order?",
                    text: "Are You Sure? You want to cancel the order!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        loadAnimation.style.display="block";
                        ViewAllOrders(pageNo);
                        jQuery.ajax({
                        type: "POST",
                        url:'includes/getAllOrders.php',
                        data:{'order_id':order_id,'status_value':statusValue,'order_cancel':true},
                        success:function(data){
                            loadAnimation.style.display="none";
                            if(data=="Order Cancel Successfully"){
                                ViewAllOrders(pageNo);
                                swal("Congratulations!", "Order Cancel Successfully!", "success");
                                
                                // For Sending Cancel Email
                                jQuery.ajax({
                                    type: "POST",
                                    url:'includes/getAllOrders.php',
                                    data:{'order_id':order_id,'status_value':statusValue,'sending_mail':true},
                                    success:function(data){

                                    }
                                });
                                
                            }else{
                                swal("Try Again!", "Order Could not be Cancel! Try Again", "error");
                            }
                        }
                    });
                } 
            });

            }else{
                loadAnimation.style.display="block";
                //alert(order_id);
                jQuery.ajax({
                type: "POST",
                url:'includes/getAllOrders.php',
                data:{'order_id':order_id,'status_value':statusValue,'order_status_change':true},
                success:function(data){
                    loadAnimation.style.display="none";
                    if(data=="Status Change Successfully"){
                        ViewAllOrders(pageNo);
                        swal("Congratulations!", "Order Status has Changed!", "success");

                        // For Sending Accept and Delivered Email
                        jQuery.ajax({
                            type: "POST",
                            url:'includes/getAllOrders.php',
                            data:{'order_id':order_id,'status_value':statusValue,'sending_mail':true},
                            success:function(data){

                            }
                        });
                        
                    }else{
                        swal("Try Again!", "Order Status Could not be changed! Try Again", "error");
                    }
                }
            });
            }
        });
        

  </script>

    

</body>
</html>