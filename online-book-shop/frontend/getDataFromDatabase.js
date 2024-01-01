//  for View Categories ("This function is Run When Page Refresh")
$(document).ready(function() {


    // Process Of pubs Start Here


    // let viewCat = document.getElementById('viewCatData');
    function viewAllProducts(page){
        $.ajax({
          url: "frontend/getDataFromDatabase.php",
          type: "POST",
          data: {page_no :page ,'view_products':true},
          success: function(data) {
          //  console.log(data);
          //  alert(data);
              $("#GetDataInHome").html(data);
              
          }
        });
    }
        
        viewAllProducts();
  
    
      

      // This function is used for Add to Cart

      $(document).on("click","#addToCart",function() {
        
        let allData = $(this).data("productdata");
        let myArray = allData.split('@');
        let productID = myArray[0];
        let productQty = 1;
        let pageno = myArray[1];
        // console.log(productID);
        // alert(allData);

        $.ajax({
          url: "frontend/addToCart.php",
          type: "POST",
          data: "product_id="+productID+"&product_qty="+productQty+"&addToCart",
          success: function(data) {
            swal("Congratulations!", "Added One Item in Cart!", "success");
            viewAllProducts(pageno);
            // console.log(data);
            let totalCartProduct = $("#cartNumber").text();
            // console.log(totalCartProduct)
            totalCartProduct++;
            $("#cartNumber").text(totalCartProduct);
          }
        });

      });
      
     





    // This function is used for getting all Authors Data
    function viewAllAuthors(page){
      $.ajax({
        url: "frontend/getDataFromDatabase.php",
        type: "POST",
        data: {page_no :page ,'view_authors':true},
        success: function(data) {
        //  console.log(data);
        //  alert(data);
            $("#AllAuthors").html(data);
            
        }
      });
  }
      
      viewAllAuthors();

    


    // This function is used for getting all Publishers Data
    function viewAllPublishers(page){
      $.ajax({
        url: "frontend/getDataFromDatabase.php",
        type: "POST",
        data: {page_no :page ,'view_publishers':true},
        success: function(data) {
        //  console.log(data);
        //  alert(data);
            $("#AllPulishers").html(data);
            
        }
      });
  }
      
      viewAllPublishers();

    //Pagination Code
    $(document).on("click","#pagination a",function(e) {
      e.preventDefault();
      var page_id = $(this).attr("id");

      let allData = $(this).data("check");
      let myArray = allData.split('@');
     //  alert(allData);

      let allProducts = myArray[0];
      let allAuthors = myArray[1];
      let allPublishers = myArray[2];

      if(allProducts != '' && allAuthors == '' && allPublishers == ''){
        viewAllProducts(page_id);
      }
      else if(allProducts == '' && allAuthors != '' && allPublishers == ''){
        viewAllAuthors(page_id);
      }
      else if(allProducts == '' && allAuthors == '' && allPublishers != ''){
        viewAllPublishers(page_id);
      }

      
    });

      


});