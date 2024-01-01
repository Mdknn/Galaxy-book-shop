$(document).ready(function(){
    // Load Tabular forms data of Students table from database
    function loadCartData(){
      $.ajax({
        url : "frontend/getCartData.php",
        type : "POST",
        data : "getcartdata",
        success : function(data){
          $("#allCartProducts").html(data);
        }
      });
    }
    loadCartData(); 


      $(document).on('change','#qtySelect', function() {
          // alert( this.value );
           let qty = this.value;
           let product_id = $(this).data("productid");
          // alert(qty)

           if(qty == 0){
            swal("Warning!", "Atleast Choose One Quantity!", "info");
           }else{
           
              $.ajax({
                  url: "frontend/getCartData.php",
                  type: "POST",
                  data: {'qty':qty ,'product_id':product_id,'update_qty':true},
                  success: function(data) {
                    swal("Congratulations!", "Your Cart is Updated!", "success");
                    loadCartData(); 
                    //console.log(data);
                    
                  }
                });

           }
        });



      $(document).on('click','#deleteCart', function() {
         // alert( this.value );
         let product_id = $(this).data("productid");

         swal({
          title: "Delete One Cart Item",
          text: "Are you sure? You want to Delete this Cart Item ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

            $.ajax({
              url: "frontend/getCartData.php",
              type: "POST",
              data: {'product_id':product_id,'delete_cart':true},
              success: function(data) {
                swal("Congratulations!", "Your One Item is Deleted!", "success");
                loadCartData(); 
                let totalCartProduct = $("#cartNumber").text();
                console.log(totalCartProduct)
                totalCartProduct--;
                $("#cartNumber").text(totalCartProduct);
                //console.log(data);
                
              }
            });
          }
          
  
        });
         
      });


      $(document).on('click','#checkoutBtn', function() {
        
        $.ajax({
          url: "frontend/getCartData.php",
          type: "POST",
          data: {'check_login':true},
          success: function(data) {
            if(data == "yes"){
                window.location.href = 'checkout.php?cart';
            }else{
              swal("Login Mandatory!", "Please Login to Buy These Products!", "error");
            }
            
            
            
          }
        });
      

      });




});