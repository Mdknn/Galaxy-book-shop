$(document).ready(function() {

    $('#cat_id').on('change', function() {
        // alert( this.value );
        let cat_id = this.value;
        $.ajax({
            url: "backend/getDatas.php",
            type: "POST",
            data: {'cat_id':cat_id ,'get_pcatName':true},
            success: function(data) {
                //console.log(data);
                $("#pcatName").html(data);
            }
          });
      });
    $('#ecat_id').on('change', function() {
        // alert( this.value );
        let cat_id = this.value;
        $("#showPcat").show();
        $.ajax({
            url: "backend/getDatas.php",
            type: "POST",
            data: {'cat_id':cat_id ,'get_pcatName':true},
            success: function(data) {
                //console.log(data);
                $("#epcatName").html(data);
            }
          });
      });


    // This is for create Function for View Products
    function viewProductTable(page){
        $.ajax({
          url: "backend/addingInDatabase.php",
          type: "POST",
          data: {page_no :page ,'view_product':true},
          success: function(data) {
              // console.log(data);
              // alert(data);
              $("#viewProductData").html(data);
              
          }
        });
      }
      viewProductTable();
  
      //Pagination Code
      $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");
  
        viewProductTable(page_id);
      })



    //   This is for Adding Product in Database
    document.getElementById("productAddBtn").onclick = function(event) {
        event.preventDefault();
        //alert("Hello");

        let productName = document.getElementById("product_name").value;
        let productSlug = document.getElementById("product_slug").value;
        let catID = document.getElementById("cat_id").value;
        let pcatID = 0;
        if(catID != 0){
            pcatID = document.getElementById("pcat_id").value;
        }
        
        let authorID = document.getElementById("author_id").value;
        let pubID = document.getElementById("pub_id").value;
        let descID = document.getElementById("desc_id").value;
        let productMrp = document.getElementById("product_mrp").value;
        let productPrice = document.getElementById("product_price").value;
        let productDiscount = document.getElementById("product_discount").value;
        let productSubject = document.getElementById("product_subject").value;
        let productStock = document.getElementById("product_stock").value;
        let productLang = document.getElementById("product_lang").value;
        let productPages = document.getElementById("product_pages").value;
        let productIsbn = document.getElementById("product_isbn").value;
        let productPubdate = document.getElementById("product_pubDate").value;
        let productDeltype = document.getElementById("product_delType").value;
        let productAge = document.getElementById("product_age").value;
        //let productFeatures = tinymce.get("product_features").getContent();
        let productKeywords = document.getElementById("product_keywords").value;
        let productFeatures = document.getElementById("product_features").value;
       // let productKeywords = tinymce.get("product_keywords").getContent();
        // let productTrending = document.getElementById("product_istrending").value;
        let productImage = document.getElementById("product_image").value;
        let form= $("#productAddForm");

        // alert(productFeatures);
        // console.log(productFeatures);
        
        let formdata = new FormData(document.getElementById("productAddForm"));
        formdata.append('product_add',true);

        
        if((productName=="") | (productSlug=="") | (catID==0) | (pcatID==0) | (authorID==0) | (pubID==0) | (descID==0) | (productMrp=="") | (productPrice=="") | (productDiscount=="") | (productSubject=="") | (productStock=="") | (productLang=="") | (productPages=="") | (productIsbn=="") | (productPubdate=="") | (productDeltype=="") | (productAge=="") | (productFeatures=="") | (productKeywords=="") | (productImage=="") ){
            swal("Try Again!", "All Fields are Required*!", "error");
        }

        // console.log(formdata);
        // console.log(form.serialize());

        // console.log(authorImage);


        else{
            
            jQuery.ajax({
                type: 'POST',
                url: 'backend/addingInDatabase.php',
                data: formdata ,
                contentType: false,
                cache: false,
                processData:false,
                success:function(result){
                    if(result=="Adding Successfull"){
                        $('#addnewproduct').modal('hide');
                        viewProductTable();
                        swal("Congratulations!", "Product Created Successfully!", "success");
                        
                    }else{
                        swal("Try Again!", "Product Not Inserted! Please Try Again...", "error");
                    }
                    form[0].reset();
                    
                }
            });
        }
        


    }





    $(document).on("click","#statusCheck",function() {
  
        let allData = $(this).data("status");
        let myArray = allData.split('@');
        //console.log(myArray);
        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];
        //let value = $('input[id="author_id"]').val();

        //alert(status);

        $.ajax({
            url: "backend/addingInDatabase.php",
            type: "POST",
            data: "product_id="+id+"&product_status="+status+"&product_status_change",
            success: function(data) {
                // console.log(data);
                if(data == "Status Updated Successfully"){
                    viewProductTable(pageno);
                    swal("Congratulations!", "Status Updated Successfully!", "success");
                }else{
                    swal("Congratulations!", "Status Updatation Failed!", "error");
                }
                
            }
          });

    });



    //  This is for Polutaing Data on Update Modal and Functionality Of Update
  
    $(document).on("click","#editProduct",function() {
  
        let allData = $(this).data("edit");
        let myArray = allData.split('@');

        $("#editproduct").modal('show');

        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];

        $("#showPcat").hide();
        
        $.ajax({
            url: "backend/addingInDatabase.php",
            type: "POST",
            data: "product_id="+id+"&product_status="+status+"&edit_product",
            success: function(data) {
                result = JSON.parse(data);
                //console.log(result);
                $("#eproduct_name").val(result[0].prod_name);
                $("#eproduct_slug").val(result[0].prod_slug);
                $("#eproduct_mrp").val(result[0].prod_mrp);
                $("#eproduct_price").val(result[0].prod_price);
                $("#eproduct_discount").val(result[0].prod_discount);
                $("#eproduct_stock").val(result[0].prod_stock);
                $("#eproduct_subject").val(result[0].prod_subject);
                $("#eproduct_lang").val(result[0].prod_lang);
                $("#eproduct_isbn").val(result[0].prod_isbn);
                $("#eproduct_pubDate").val(result[0].prod_publication_date);
                $("#eproduct_delType").val(result[0].prod_delivery_type);
                $("#eproduct_age").val(result[0].prod_see_age);
                //$("#eproduct_features").val(result[0].prod_features);
                tinymce.get("eproduct_features").setContent(result[0].prod_features);
                tinymce.get("eproduct_keywords").setContent(result[0].prod_keywords);
                
                $("#eproduct_pages").val(result[0].prod_pages);
               // console.log(result[0].prod_trending);
                if(result[0].prod_trending==0){
                    $("#eproduct_istrending").prop("checked", false);
                }else{
                    $("#eproduct_istrending").prop("checked", true);
                }
                
                $("#imgsrc").attr("src","Images/ProductImages/"+result[0].prod_thumbnail);
                $("#showAuthor").text("Earlier \""+result[1]+"\"" + " Selected");
                $("#showCategory").text("Earlier \""+result[2]+"\"" + " Selected");
                $("#showPcat").text("Earlier \""+result[3]+"\"" + " Selected");        
                $("#showPublisher").text("Earlier \""+result[4]+"\"" + " Selected");
                $("#showDescription").text("Earlier \""+result[5]+"\"" + " Selected");
                $("#showAuthor").text("Earlier \""+result[1]+"\"" + " Selected");
               // console.log(result[3]);
            //    $("#eauthor_name").val(result[0].author_name);
                         
               
            }
          });


        // This is for Updating authoregory
        // For Updating authoregory
        document.getElementById("productUpdateBtn").onclick = function(event) {
        event.preventDefault();


        let eproductName = document.getElementById("eproduct_name").value;
        let eproductSlug = document.getElementById("eproduct_slug").value;
        let ecatID = document.getElementById("ecat_id").value;
        let epcatID = 0;
        if(ecatID != 0){
            epcatID = document.getElementById("pcat_id").value;
        }
        
        let eauthorID = document.getElementById("eauthor_id").value;
        let epubID = document.getElementById("epub_id").value;
        let edescID = document.getElementById("edesc_id").value;
        let eproductMrp = document.getElementById("eproduct_mrp").value;
        let eproductPrice = document.getElementById("eproduct_price").value;
        let eproductDiscount = document.getElementById("eproduct_discount").value;
        let eproductSubject = document.getElementById("eproduct_subject").value;
        let eproductStock = document.getElementById("eproduct_stock").value;
        let eproductLang = document.getElementById("eproduct_lang").value;
        let eproductPages = document.getElementById("eproduct_pages").value;
        let eproductIsbn = document.getElementById("eproduct_isbn").value;
        let eproductPubdate = document.getElementById("eproduct_pubDate").value;
        let eproductDeltype = document.getElementById("eproduct_delType").value;
        let eproductAge = document.getElementById("eproduct_age").value;
        //let eproductFeatures = document.getElementById("eproduct_features").value;
        let eproductKeywords = document.getElementById("eproduct_keywords").value;
        let eproductFeatures = document.getElementById("eproduct_features").value;
        // let eproductFeatures = tinymce.get("eproduct_features").getContent();
        // let eproductKeywords = tinymce.get("eproduct_keywords").getContent();
        // let eproductTrending = document.getElementById("eproduct_istrending").value;
        // let eproductImage = document.getElementById("eproduct_image").value;
        let form= $("#productUpdateForm");

        
        
        let formdata = new FormData(document.getElementById("productUpdateForm"));
        formdata.append('product_update',true);
        formdata.append('product_id',id);


        if((eproductName=="") | (eproductSlug=="") | (ecatID==0) | (epcatID==0) | (eauthorID==0) | (epubID==0) | (edescID==0) | (eproductMrp=="") | (eproductPrice=="") | (eproductDiscount=="") | (eproductSubject=="") | (eproductStock=="") | (eproductLang=="") | (eproductPages=="") | (eproductIsbn=="") | (eproductPubdate=="") | (eproductDeltype=="") | (eproductAge=="") | (eproductFeatures=="") | (eproductKeywords=="") ){
            swal("Try Again!", "All Fields are Required*!", "error");
        }
        
        
        else{
            
            jQuery.ajax({
                type: 'POST',
                url: 'backend/addingInDatabase.php',
                data: formdata ,
                contentType: false,
                cache: false,
                processData:false,
                success:function(result){
                    if(result=="Updating Successfull"){
                        $("#editproduct").modal('hide');
                        viewProductTable(pageno);
                        swal("Congratulations!", "Product Updated Successfully!", "success");
                        
                    }else{
                        swal("Try Again!", "Author Not Updated! Please Try Again...", "error");
                    }
                    form[0].reset();
                    
                }
            })
        }
        
    }


          

    });  //  Ending Edit and Updating Functionality




    //  Code for Deleting authoregory
  
    $(document).on("click","#delProduct",function() {
  
        let allData = $(this).data("delete");
        let myArray = allData.split('@');

        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];


        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this authoregory!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "backend/addingInDatabase.php",
                    type: "POST",
                    data: "product_id="+id+"&product_status="+status+"&del_product",
                    success: function(data) {
                        
                        if(data=="Delete Successfull"){
                            viewProductTable(pageno);
                            swal("Congratulations!", "Product Deleted Successfully!", "success");
                            
                        }else{
                            swal("Try Again!", "Product Not Deleted! Please Try Again...", "error");
                        }
                    }
                  });
            }
          });

        


    });





    

});