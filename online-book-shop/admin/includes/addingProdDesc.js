
//  for View Categories ("This function is Run When Page Refresh")
$(document).ready(function() {


    // Process Of prods Start Here


    // let viewCat = document.getElementById('viewCatData');
    function viewprodTable(page){
        $.ajax({
          url: "backend/addingInDatabase.php",
          type: "POST",
          data: {page_no :page ,'view_prod':true},
          success: function(data) {
              // console.log(data);
              // alert(data);
              $("#viewprodData").html(data);
              
          }
        });
      }
      viewprodTable();
  
      //Pagination Code
      $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");
  
        viewprodTable(page_id);
      })
  
  
  
  
  
  
      // Adding Category 
      // For Adding New Category
      document.getElementById("prodAddBtn").onclick = function(event) {
          event.preventDefault();
          
         
          let prodDesc = document.getElementById("prod_desc").value;
          let descName = document.getElementById("desc_name").value;
          
          let form= $("#prodAddForm");
          
          let formdata = new FormData(document.getElementById("prodAddForm"));
          formdata.append('prod_add',true);
  
          // console.log(formdaya);
          // console.log(form.serialize());
  
          // console.log(prodImage);
          
          if((descName=="") | (prodDesc=="")){
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
                      if(result=="Adding Successfull"){
                          $('#addnewprod').modal('hide');
                          viewprodTable();
                          swal("Congratulations!", "prod Created Successfully!", "success");
                          
                      }else{
                          swal("Try Again!", "prod Not Inserted! Please Try Again...", "error");
                      }
                      form[0].reset();
                      
                  }
              })
          }
          
      }
  
  
  
      // This is for Updating Status of prodegory
  
      $(document).on("click","#statusCheck",function() {
  
          let allData = $(this).data("status");
          let myArray = allData.split('@');
          //console.log(myArray);
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
          //let value = $('input[id="prod_id"]').val();
  
          //alert(status);
  
          $.ajax({
              url: "backend/addingInDatabase.php",
              type: "POST",
              data: "desc_id="+id+"&prod_status="+status+"&prod_status_change",
              success: function(data) {
                  // console.log(data);
                  if(data == "Status Updated Successfully"){
                      viewprodTable(pageno);
                      swal("Congratulations!", "Status Updated Successfully!", "success");
                  }else{
                      swal("Congratulations!", "Status Updatation Failed!", "error");
                  }
                  
              }
            });
  
      });
  
  
      //  This is for Polutaing Data on Update Modal and Functionality Of Update
  
      $(document).on("click","#editProd",function() {
  
          let allData = $(this).data("edit");
          let myArray = allData.split('@');
  
          $("#editprod").modal('show');
  
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
          
          $.ajax({
              url: "backend/addingInDatabase.php",
              type: "POST",
              data: "desc_id="+id+"&prod_status="+status+"&edit_prod",
              success: function(data) {
                   result = JSON.parse(data);
                  //console.log(data);
                 //console.log(result[0].prod_name);
                 
                 
                 
                 tinymce.get("eprod_desc").setContent(result[0].prod_desc);;
                //  $("#eprod_desc").val(result[0].prod_desc);
                 $("#edesc_name").val(result[0].desc_name);
                 
                 
                 
              }
            });
  
  
          // This is for Updating prodegory
          // For Updating prodegory
          document.getElementById("prodUpdateBtn").onclick = function(event) {
          event.preventDefault();
          
          
          let prodDesc = document.getElementById("eprod_desc").value;
          let descName = document.getElementById("edesc_name").value;
          let form= $("#prodUpdateForm");
          
          let formdata = new FormData(document.getElementById("prodUpdateForm"));
          formdata.append('prod_update',true);
          formdata.append('desc_id',id);
          
          if((prodDesc=="") | (descName=="")){
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
                          $("#editprod").modal('hide');
                          viewprodTable(pageno);
                          swal("Congratulations!", "prod Updated Successfully!", "success");
                          
                      }else{
                          swal("Try Again!", "prod Not Updated! Please Try Again...", "error");
                      }
                      form[0].reset();
                      
                  }
              })
          }
          
      }
  
  
            
  
      });  //  Ending Edit and Updating Functionality
  
  
  
  
      //  Code for Deleting prodegory
  
      $(document).on("click","#delprod",function() {
  
          let allData = $(this).data("delete");
          let myArray = allData.split('@');
  
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
  
  
          swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this prodegory!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                      url: "backend/addingInDatabase.php",
                      type: "POST",
                      data: "desc_id="+id+"&prod_status="+status+"&del_prod",
                      success: function(data) {
                          
                          if(data=="Delete Successfull"){
                              $("#editprod").modal('hide');
                              viewprodTable(pageno);
                              swal("Congratulations!", "prod Deleted Successfully!", "success");
                              
                          }else{
                              swal("Try Again!", "prod Not Deleted! Please Try Again...", "error");
                          }
                      }
                    });
              }
            });
  
          
  
  
      });







    // Process Of prods End Here














});
