
    var params = new window.URLSearchParams(window.location.search);

    // This is Test for Subjects and Show All Datas
    if(params.get('subject') !=null){
        let subjectValue = params.get('subject');
        // console.log(params.get('subject'));

        // alert(subjectValue);
        
        $("#showName").removeClass('btn-danger');
        $("#showName").html("All Books are Related to \" "+subjectValue + " \"");
        $("#showName").addClass('btn-primary');
        

        //  for View Categories ("This function is Run When Page Refresh")
        $(document).ready(function() {

        function viewSubjectProducts(page){
            $.ajax({
            url: "includes/dropdown/getAllDatas.php",
            type: "POST",
            data: {page_no :page,'subject':subjectValue ,'view_allProducts':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllProducts").html(data);
                
            }
            });
        }

        viewSubjectProducts();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewSubjectProducts(page_id);
        });

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
                viewSubjectProducts(pageno);
                // console.log(data);
                let totalCartProduct = $("#cartNumber").text();
                // console.log(totalCartProduct)
                totalCartProduct++;
                $("#cartNumber").text(totalCartProduct);
            }
            });

        });

        });
    
    }



    // This is Test for book language filter data and Show All Datas
    if(params.get('language') !=null){
        let language = params.get('language');
        // console.log(params.get('subject'));

        // alert(subjectValue);
        
        $("#showName").removeClass('btn-danger');
        $("#showName").html("All Books are Related to \" "+language + " \" Language");
        $("#showName").addClass('btn-primary');
        

        //  for View Categories ("This function is Run When Page Refresh")
        $(document).ready(function() {

        function viewLanguageProducts(page){
            $.ajax({
            url: "includes/dropdown/getAllDatas.php",
            type: "POST",
            data: {page_no :page,'language':language ,'view_allProducts':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllProducts").html(data);
                
            }
            });
        }

        viewLanguageProducts();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewLanguageProducts(page_id);
        });

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
                viewLanguageProducts(pageno);
                // console.log(data);
                let totalCartProduct = $("#cartNumber").text();
                // console.log(totalCartProduct)
                totalCartProduct++;
                $("#cartNumber").text(totalCartProduct);
            }
            });

        });

        });
    
    }







    // This is Test for Author Books filter data and Show All Datas
    if(params.get('author') !=null){
        let author = params.get('author');
        // console.log(params.get('subject'));

        // alert(subjectValue);
        
        $("#showName").removeClass('btn-danger');
        $("#showName").html("All Books are Related to This Author");
        $("#showName").addClass('btn-primary');
        

        //  for View Categories ("This function is Run When Page Refresh")
        $(document).ready(function() {

        function viewAuthorProducts(page){
            $.ajax({
            url: "includes/dropdown/getAllDatas.php",
            type: "POST",
            data: {page_no :page,'author':author ,'view_allProducts':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllProducts").html(data);
                
            }
            });
        }

        viewAuthorProducts();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewAuthorProducts(page_id);
        });

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
                viewAuthorProducts(pageno);
                // console.log(data);
                let totalCartProduct = $("#cartNumber").text();
               // console.log(totalCartProduct)
                totalCartProduct++;
                $("#cartNumber").text(totalCartProduct);
            }
            });

        });
        

        });
    
    }






    // This is Test for Publisher All Books filter data and Show All Datas
    if(params.get('publisher') !=null){
        let publisher = params.get('publisher');
        // console.log(params.get('subject'));

        // alert(subjectValue);
        
        $("#showName").removeClass('btn-danger');
        $("#showName").html("All Books are Related to This Publisher");
        $("#showName").addClass('btn-primary');
        

        //  for View Categories ("This function is Run When Page Refresh")
        $(document).ready(function() {

        function viewPublisherProducts(page){
            $.ajax({
            url: "includes/dropdown/getAllDatas.php",
            type: "POST",
            data: {page_no :page,'publisher':publisher ,'view_allProducts':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllProducts").html(data);
                
            }
            });
        }

        viewPublisherProducts();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewPublisherProducts(page_id);
        });

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
                viewPublisherProducts(pageno);
                // console.log(data);
                let totalCartProduct = $("#cartNumber").text();
                // console.log(totalCartProduct)
                totalCartProduct++;
                $("#cartNumber").text(totalCartProduct);
            }
            });

        });


        });
    
    }






    // This is Test for Recommended Age All Books filter data and Show All Datas
    if(params.get('suitage') !=null){
        let suitage = params.get('suitage');
        // console.log(params.get('subject'));

        // alert(subjectValue);
        
        $("#showName").removeClass('btn-danger');
        $("#showName").html("Recommended Books for Age "+suitage);
        $("#showName").addClass('btn-primary');
        

        //  for View Categories ("This function is Run When Page Refresh")
        $(document).ready(function() {

        function viewSuitageProducts(page){
            $.ajax({
            url: "includes/dropdown/getAllDatas.php",
            type: "POST",
            data: {page_no :page,'suitage':suitage ,'view_allProducts':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllProducts").html(data);
                
            }
            });
        }

        viewSuitageProducts();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewSuitageProducts(page_id);
        });

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
                viewSuitageProducts(pageno);
                // console.log(data);
                let totalCartProduct = $("#cartNumber").text();
                // console.log(totalCartProduct)
                totalCartProduct++;
                $("#cartNumber").text(totalCartProduct);
            }
            });

        });


        });
    
    }






    // This is Test for getting All Books of Related to Product Categories filter data and Show All Datas
    if(params.get('pcategories') !=null){
        let pcategories = params.get('pcategories');
        // console.log(params.get('subject'));

        // alert(subjectValue);
        
        $("#showName").removeClass('btn-danger');
        $("#showName").html("Books Related To This Category ");
        $("#showName").addClass('btn-primary');
        

        //  for View Categories ("This function is Run When Page Refresh")
        $(document).ready(function() {

        function viewPcatProducts(page){
            $.ajax({
            url: "includes/dropdown/getAllDatas.php",
            type: "POST",
            data: {page_no :page,'pcategories':pcategories ,'view_allProducts':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllProducts").html(data);
                
            }
            });
        }

        viewPcatProducts();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewPcatProducts(page_id);
        });

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
                viewPcatProducts(pageno);
                // console.log(data);
                let totalCartProduct = $("#cartNumber").text();
                // console.log(totalCartProduct)
                totalCartProduct++;
                $("#cartNumber").text(totalCartProduct);
            }
            });

        });


        });
    
    }




    // This is Test for getting All Trending Books
    if(params.get('trending') !=null){
        
        
        $("#showName").removeClass('btn-danger');
        $("#showName").html("Trending Books ");
        $("#showName").addClass('btn-primary');
        

        //  for View Categories ("This function is Run When Page Refresh")
        $(document).ready(function() {

        function viewTrendingBooks(page){
            $.ajax({
            url: "includes/dropdown/getAllDatas.php",
            type: "POST",
            data: {page_no :page ,'trending':true ,'view_allProducts':true},
            success: function(data) {
            //  console.log(data);
            //  alert(data);
                $("#GetAllProducts").html(data);
                
            }
            });
        }

        viewTrendingBooks();

        //Pagination Code
        $(document).on("click","#pagination a",function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            viewTrendingBooks(page_id);
        });

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
                viewTrendingBooks(pageno);
                // console.log(data);
                let totalCartProduct = $("#cartNumber").text();
                // console.log(totalCartProduct)
                totalCartProduct++;
                $("#cartNumber").text(totalCartProduct);
            }
            });

        });


        });
    
    }




// This is Test for getting All Search Books 
if(params.get('search') !=null){
    let search = params.get('search');
    // console.log(params.get('subject'));

    // alert(subjectValue);
    
    $("#showName").removeClass('btn-danger');
    $("#showName").html("You Search like ''"+ search + "''");
    $("#showName").addClass('btn-primary');
    

    //  for View Categories ("This function is Run When Page Refresh")
    $(document).ready(function() {

    function viewSearchProducts(page){
        $.ajax({
        url: "includes/dropdown/getAllDatas.php",
        type: "POST",
        data: {page_no :page,'search':search ,'view_allProducts':true},
        success: function(data) {
        //  console.log(data);
        //  alert(data);
            $("#GetAllProducts").html(data);
            
        }
        });
    }

    viewSearchProducts();

    //Pagination Code
    $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");

        viewSearchProducts(page_id);
    });

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
            viewSearchProducts(pageno);
            // console.log(data);
            let totalCartProduct = $("#cartNumber").text();
            // console.log(totalCartProduct)
            totalCartProduct++;
            $("#cartNumber").text(totalCartProduct);
        }
        });

    });


    });

}







// This is Test for getting All Books based on Discounts
if(params.get('discount') !=null){
    let discount = params.get('discount');
    // console.log(params.get('subject'));

    // alert(subjectValue);
    
    $("#showName").removeClass('btn-danger');
    $("#showName").html("Books Based on "+discount+" % Discount");
    $("#showName").addClass('btn-primary');
    

    //  for View Categories ("This function is Run When Page Refresh")
    $(document).ready(function() {

    function viewDiscountProducts(page){
        $.ajax({
        url: "includes/dropdown/getAllDatas.php",
        type: "POST",
        data: {page_no :page,'discount':discount ,'view_allProducts':true},
        success: function(data) {
        //  console.log(data);
        //  alert(data);
            $("#GetAllProducts").html(data);
            
        }
        });
    }

    viewDiscountProducts();

    //Pagination Code
    $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");

        viewDiscountProducts(page_id);
    });

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
            viewDiscountProducts(pageno);
            // console.log(data);
            let totalCartProduct = $("#cartNumber").text();
            // console.log(totalCartProduct)
            totalCartProduct++;
            $("#cartNumber").text(totalCartProduct);
        }
        });

    });


    });

}




