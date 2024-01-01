//  for View Categories ("This function is Run When Page Refresh")
$(document).ready(function() {


    // Process Of pubs Start Here


    // let viewCat = document.getElementById('viewCatData');
    function viewAllProducts(page){
        $.ajax({
          url: "frontend/getAllProducts.php",
          type: "POST",
          data: {page_no :page ,'view_products':true},
          success: function(data) {
          //  console.log(data);
          //  alert(data);
              $("#GetProductsData").html(data);
              
          }
        });
    }

    viewAllProducts();

  
      // //Pagination Code  
      
      $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        //alert($(this).data("alldata"));
        var page_id = $(this).attr("id");

        let allData = $(this).data("alldata");
        let myArray = allData.split('@');

        var cat_id_filter = myArray[0];
        var pcat_id_filter = myArray[1];

        var low_filter = myArray[2];
        var high_filter = myArray[3];

        var low_discount = myArray[4];
        var high_discount = myArray[5];

        if(cat_id_filter != ''){
            if(pcat_id_filter != ''){
              viewPcatFilterProducts(cat_id_filter,pcat_id_filter,page_id);
            }else{
              viewCatFilterProducts(cat_id_filter,page_id);
            }
          
        }else if(low_filter != ''){
          viewLowFilterProducts(page_id);
        }
        else if(high_filter != ''){
          viewHighFilterProducts(page_id);
        }
        else if(low_discount != ''){
          viewLowDiscountProducts(page_id);
        }
        else if(high_discount != ''){
          viewHighDiscountProducts(page_id);
        }
        else{
          viewAllProducts(page_id);
        }
        
      });
    




      // Function For ViewCatFilterProducts
      function viewCatFilterProducts(cat_id,page){
        $.ajax({
          url: "frontend/getAllProducts.php",
          type: "POST",
          data: {page_no :page ,'cat_id':cat_id,'view_products':true},
          success: function(data) {
          //  console.log(data);
          //  alert(data);
              $("#GetProductsData").html(data);
              
              
          }
        });
      }

      // Function For ViewCatFilterProducts
      function viewPcatFilterProducts(cat_id,pcat_id,page){
        $.ajax({
          url: "frontend/getAllProducts.php",
          type: "POST",
          data: {page_no :page ,'cat_id':cat_id,'pcat_id':pcat_id,'view_products':true},
          success: function(data) {
          //  console.log(data);
          //  alert(data);
              $("#GetProductsData").html(data);
  
          }
        });
      }


      // Function For Price LowToHighFilter
      function viewLowFilterProducts(page){
        $.ajax({
          url: "frontend/getAllProducts.php",
          type: "POST",
          data: {page_no :page ,'lowToHighFilter':true,'view_products':true},
          success: function(data) {
          //  console.log(data);
          //  alert(data);
              $("#GetProductsData").html(data);
  
          }
        });
      }


      // Function For Price HighToLowFilter
      function viewHighFilterProducts(page){
        $.ajax({
          url: "frontend/getAllProducts.php",
          type: "POST",
          data: {page_no :page ,'highToLowFilter':true,'view_products':true},
          success: function(data) {
          //  console.log(data);
          //  alert(data);
              $("#GetProductsData").html(data);
  
          }
        });
      }
    //viewCatFilterProducts();



      // Function For Discount in Price LowToHighDiscount
      function viewLowDiscountProducts(page){
        $.ajax({
          url: "frontend/getAllProducts.php",
          type: "POST",
          data: {page_no :page ,'lowToHighDiscount':true,'view_products':true},
          success: function(data) {
          //  console.log(data);
          //  alert(data);
              $("#GetProductsData").html(data);
  
          }
        });
      }


      // Function For Discount in Price HighToLowDiscount
      function viewHighDiscountProducts(page){
        $.ajax({
          url: "frontend/getAllProducts.php",
          type: "POST",
          data: {page_no :page ,'highToLowDiscount':true,'view_products':true},
          success: function(data) {
          //  console.log(data);
          //  alert(data);
              $("#GetProductsData").html(data);
  
          }
        });
      }
  
      



      $(".categoryFilter").click(function(){
        let allData = $(this).data("catid");
        let myArray = allData.split('@');
        let cat_id = myArray[0];
        let cat_name = myArray[1];
        //alert(allData);
        $(".categoryFilter").removeClass("active");
        $(this).addClass("active");

        viewCatFilterProducts(cat_id);

        $("#filterName").html(cat_name+" All Books");
        $("#filterName").removeClass("btn-danger");
        
        $("#filterName").removeClass("btn-success");
        $("#filterName").addClass("btn-primary");
        $("#highFilter").removeClass("active");
        $("#lowDiscount").removeClass("active");
        $("#highDiscount").removeClass("active");
        $("#lowFilter").removeClass("active");

        $.ajax({
          url: "frontend/getAllProducts.php",
          type: "POST",
          data: {'cat_id':cat_id ,'get_pcatName':true},
          success: function(data) {
              //console.log(data);
              $("#epcatName").html(data);
          }
        });
     
      });
     

      $(document).on("click",".pcategoryFilter",function() {

        let allData = $(this).data("pcatdata");
        let myArray = allData.split('@');
        let cat_id = myArray[0];
        let pcat_id = myArray[1];
        let pcat_name = myArray[2];
        // alert(allData);
        $(".pcategoryFilter").removeClass("active");
        $(this).addClass("active");
        //console.log($("#filterpName").html());
        $("#filterName").html(pcat_name+" All Books");
        $("#filterName").removeClass("btn-primary");
        $("#filterName").removeClass("btn-success");
        $("#filterName").addClass("btn-danger");

        $("#highFilter").removeClass("active");
        $("#lowDiscount").removeClass("active");
        $("#highDiscount").removeClass("active");
        $("#lowFilter").removeClass("active");

        viewPcatFilterProducts(cat_id,pcat_id);
      });    


      //  Filter By Price Low and High
      $("#lowFilter").click(function(){
        //alert("Low")
        $(".categoryFilter").removeClass("active");
        $(".pcategoryFilter").removeClass("active");

        $("#highFilter").removeClass("active");
        $("#lowDiscount").removeClass("active");
        $("#highDiscount").removeClass("active");
        $("#lowFilter").removeClass("active");
        $(this).addClass("active");

        viewLowFilterProducts();

        $("#filterName").html("Filter By Price --  Low To High");
        $("#filterName").removeClass("btn-primary");
        $("#filterName").removeClass("btn-danger");
        $("#filterName").removeClass("btn-success");
        $("#filterName").addClass("btn-primary");

      });




      $("#highFilter").click(function(){
        //alert("High")
        $(".categoryFilter").removeClass("active");
        $(".pcategoryFilter").removeClass("active");

        $("#lowFilter").removeClass("active");
        $("#lowDiscount").removeClass("active");
        $("#highDiscount").removeClass("active");
        $("#highFilter").removeClass("active");
        $(this).addClass("active");

        viewHighFilterProducts();

        $("#filterName").html("Filter By Price --  High To Low");
        $("#filterName").removeClass("btn-primary");
        $("#filterName").removeClass("btn-danger");
        $("#filterName").addClass("btn-success");

      });

      
      // Start for Low and High Discount
      $("#lowDiscount").click(function(){
        //alert("Low")
        $(".categoryFilter").removeClass("active");
        $(".pcategoryFilter").removeClass("active");

        $("#highDiscount").removeClass("active");
        $("#lowFilter").removeClass("active");
        $("#highFilter").removeClass("active");
        $("#lowDiscount").removeClass("active");
        $(this).addClass("active");

        viewLowDiscountProducts();

        $("#filterName").html("Filter By Discount (Offer) --  Low To High");
        $("#filterName").removeClass("btn-primary");
        $("#filterName").removeClass("btn-danger");
        $("#filterName").removeClass("btn-success");
        $("#filterName").addClass("btn-primary");

      });




      $("#highDiscount").click(function(){
        //alert("High")
        $(".categoryFilter").removeClass("active");
        $(".pcategoryFilter").removeClass("active");

        $("#lowDiscount").removeClass("active");
        $("#lowFilter").removeClass("active");
        $("#highFilter").removeClass("active");
        $("#highDiscount").removeClass("active");
        $(this).addClass("active");

        viewHighDiscountProducts();

        $("#filterName").html("Filter By Discount (Offer) --  High To Low");
        $("#filterName").removeClass("btn-primary");
        $("#filterName").removeClass("btn-success");
        $("#filterName").removeClass("btn-danger");
        $("#filterName").addClass("btn-danger");

      });


      

      // This function is used for Add to Cart

      $(document).on("click","#addToCart",function() {
        
        let allData = $(this).data("productdata");
        let myArray = allData.split('@');
        let productID = myArray[0];
        let productQty = 1;
        let pageno = myArray[1];
        let cat_id_filter = myArray[2];
        let pcat_id_filter = myArray[3];
        let low_filter = myArray[4];
        let high_filter = myArray[5];
        let low_discount = myArray[6];
        let high_discount = myArray[7];
        // console.log(productID);
        //alert(cat_id_filter);

        $.ajax({
          url: "frontend/addToCart.php",
          type: "POST",
          data: "product_id="+productID+"&product_qty="+productQty+"&addToCart",
          success: function(data) {
            swal("Congratulations!", "Added One Item in Cart!", "success");
              if(cat_id_filter != ''){
                //console.log("Yes")
                  if(pcat_id_filter != ''){
                    viewPcatFilterProducts(cat_id_filter,pcat_id_filter,pageno);
                  }
                  else{
                    viewCatFilterProducts(cat_id_filter , pageno);
                  }
                
              }
              else if(low_filter != ''){
                viewLowFilterProducts(pageno);
              }
              else if(high_filter != ''){
                viewHighFilterProducts(pageno);
              }
              else if(low_discount != ''){
                viewLowDiscountProducts(pageno);
              }
              else if(high_discount != ''){
                viewHighDiscountProducts(pageno);
              }
              else{
                //console.log("No")
                viewAllProducts(pageno);
              }
            
            // console.log(data);
            let totalCartProduct = $("#cartNumber").text();
            // console.log(totalCartProduct)
            totalCartProduct++;
            $("#cartNumber").text(totalCartProduct);
          }
        });

      });


      


      


});