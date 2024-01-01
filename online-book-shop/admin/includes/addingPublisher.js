
//  for View Categories ("This function is Run When Page Refresh")
$(document).ready(function() {


    // Process Of pubs Start Here


    // let viewCat = document.getElementById('viewCatData');
    function viewpubTable(page){
        $.ajax({
          url: "backend/addingInDatabase.php",
          type: "POST",
          data: {page_no :page ,'view_pub':true},
          success: function(data) {
              // console.log(data);
              // alert(data);
              $("#viewpubData").html(data);
              
          }
        });
      }
      viewpubTable();
  
      //Pagination Code
      $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");
  
        viewpubTable(page_id);
      })
  
  
  
  
  
  
      // Adding Category 
      // For Adding New Category
      document.getElementById("pubAddBtn").onclick = function(event) {
          event.preventDefault();
          
          let pubName = document.getElementById("pub_name").value;
          let pubSlug = document.getElementById("pub_slug").value;
          let pubDesc = document.getElementById("pub_desc").value;
          let pubImage = document.getElementById("pub_image").value;
          let form= $("#pubAddForm");
          
          let formdata = new FormData(document.getElementById("pubAddForm"));
          formdata.append('pub_add',true);
  
          // console.log(formdata);
          // console.log(form.serialize());
  
          // console.log(pubImage);
          
          if((pubName=="") | (pubSlug=="") | (pubDesc=="") | (pubImage=="")){
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
                          $('#addnewpub').modal('hide');
                          viewpubTable();
                          swal("Congratulations!", "pub Created Successfully!", "success");
                          
                      }else{
                          swal("Try Again!", "pub Not Inserted! Please Try Again...", "error");
                      }
                      form[0].reset();
                      
                  }
              })
          }
          
      }
  
  
  
      // This is for Updating Status of pubegory
  
      $(document).on("click","#statusCheck",function() {
  
          let allData = $(this).data("status");
          let myArray = allData.split('@');
          //console.log(myArray);
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
          //let value = $('input[id="pub_id"]').val();
  
          //alert(status);
  
          $.ajax({
              url: "backend/addingInDatabase.php",
              type: "POST",
              data: "pub_id="+id+"&pub_status="+status+"&pub_status_change",
              success: function(data) {
                  // console.log(data);
                  if(data == "Status Updated Successfully"){
                      viewpubTable(pageno);
                      swal("Congratulations!", "Status Updated Successfully!", "success");
                  }else{
                      swal("Congratulations!", "Status Updatation Failed!", "error");
                  }
                  
              }
            });
  
      });
  
  
      //  This is for Polutaing Data on Update Modal and Functionality Of Update
  
      $(document).on("click","#editPub",function() {
  
          let allData = $(this).data("edit");
          let myArray = allData.split('@');
  
          $("#editpub").modal('show');
  
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
          
          $.ajax({
              url: "backend/addingInDatabase.php",
              type: "POST",
              data: "pub_id="+id+"&pub_status="+status+"&edit_pub",
              success: function(data) {
                  result = JSON.parse(data);
                 //console.log(result[0].pub_name);
                 $("#epub_name").val(result[0].pub_name);
                //  console.log(result[0].pub_pic);
                //  console.log(result[0].pub_slug);
                //  console.log(result[0].pub_desc);
                 $("#epub_slug").val(result[0].pub_slug);
                 tinymce.get("epub_desc").setContent(result[0].pub_desc);
                //  $("#epub_desc").val(result[0].pub_desc);
                 $("#imgsrc").attr("src","Images/PublisherImages/"+result[0].pub_pic);
                 
                 
              }
            });
  
  
          // This is for Updating pubegory
          // For Updating pubegory
          document.getElementById("pubUpdateBtn").onclick = function(event) {
          event.preventDefault();
          
          let pubName = document.getElementById("epub_name").value;
          let pubSlug = document.getElementById("epub_slug").value;
          let pubDesc = document.getElementById("epub_desc").value;
          let form= $("#pubUpdateForm");
          
          let formdata = new FormData(document.getElementById("pubUpdateForm"));
          formdata.append('pub_update',true);
          formdata.append('pub_id',id);
          
          if((pubName=="") | (pubSlug=="") | (pubDesc=="") ){
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
                          $("#editpub").modal('hide');
                          viewpubTable(pageno);
                          swal("Congratulations!", "pub Updated Successfully!", "success");
                          
                      }else{
                          swal("Try Again!", "pub Not Updated! Please Try Again...", "error");
                      }
                      form[0].reset();
                      
                  }
              })
          }
          
      }
  
  
            
  
      });  //  Ending Edit and Updating Functionality
  
  
  
  
      //  Code for Deleting pubegory
  
      $(document).on("click","#delPub",function() {
  
          let allData = $(this).data("delete");
          let myArray = allData.split('@');
  
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
  
  
          swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this pubegory!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                      url: "backend/addingInDatabase.php",
                      type: "POST",
                      data: "pub_id="+id+"&pub_status="+status+"&del_pub",
                      success: function(data) {
                          
                          if(data=="Delete Successfull"){
                              $("#editpub").modal('hide');
                              viewpubTable(pageno);
                              swal("Congratulations!", "pub Deleted Successfully!", "success");
                              
                          }else{
                              swal("Try Again!", "pub Not Deleted! Please Try Again...", "error");
                          }
                      }
                    });
              }
            });
  
          
  
  
      });







    // Process Of pubs End Here














});
