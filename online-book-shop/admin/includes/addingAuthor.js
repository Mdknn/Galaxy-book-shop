
//  for View Categories ("This function is Run When Page Refresh")
$(document).ready(function() {


    // Process Of Authors Start Here


    // let viewCat = document.getElementById('viewCatData');
    function viewAuthorTable(page){
        $.ajax({
          url: "backend/addingInDatabase.php",
          type: "POST",
          data: {page_no :page ,'view_author':true},
          success: function(data) {
              // console.log(data);
              // alert(data);
              $("#viewAuthorData").html(data);
              
          }
        });
      }
      viewAuthorTable();
  
      //Pagination Code
      $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");
  
        viewAuthorTable(page_id);
      })
  
  
  
  
  
  
      // Adding Category 
      // For Adding New Category
      document.getElementById("authorAddBtn").onclick = function(event) {
          event.preventDefault();
          
          let authorName = document.getElementById("author_name").value;
          let authorSlug = document.getElementById("author_slug").value;
         // let authorDesc = document.getElementById("author_desc").value;
          let authorDesc = tinymce.get("author_desc").getContent();
          let authorImage = document.getElementById("author_image").value;
          let form= $("#authorAddForm");
          
          let formdata = new FormData(document.getElementById("authorAddForm"));
          formdata.append('author_add',true);
  
          // console.log(formdata);
          // console.log(form.serialize());
  
          // console.log(authorImage);
          
          if((authorName=="") | (authorSlug=="") | (authorDesc=="") | (authorImage=="")){
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
                          $('#addnewauthor').modal('hide');
                          viewAuthorTable();
                          swal("Congratulations!", "Author Created Successfully!", "success");
                          
                      }else{
                          swal("Try Again!", "Author Not Inserted! Please Try Again...", "error");
                      }
                      form[0].reset();
                      
                  }
              })
          }
          
      }
  
  
  
      // This is for Updating Status of authoregory
  
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
              data: "author_id="+id+"&author_status="+status+"&author_status_change",
              success: function(data) {
                  // console.log(data);
                  if(data == "Status Updated Successfully"){
                      viewAuthorTable(pageno);
                      swal("Congratulations!", "Status Updated Successfully!", "success");
                  }else{
                      swal("Congratulations!", "Status Updatation Failed!", "error");
                  }
                  
              }
            });
  
      });
  
  
      //  This is for Polutaing Data on Update Modal and Functionality Of Update
  
      $(document).on("click","#editAuthor",function() {
  
          let allData = $(this).data("edit");
          let myArray = allData.split('@');
  
          $("#editauthor").modal('show');
  
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
          
          $.ajax({
              url: "backend/addingInDatabase.php",
              type: "POST",
              data: "author_id="+id+"&author_status="+status+"&edit_author",
              success: function(data) {
                  result = JSON.parse(data);
                 //console.log(result[0].author_name);
                 $("#eauthor_name").val(result[0].author_name);
                 console.log(result[0].author_pic);
                 console.log(result[0].author_slug);
                 console.log(result[0].author_desc);
                 $("#eauthor_slug").val(result[0].author_slug);
                 // $("#eauthor_desc").val(result[0].author_desc);
                 tinymce.get("eauthor_desc").setContent(result[0].author_desc)
                 $("#imgsrc").attr("src","Images/AuthorImages/"+result[0].author_pic);
                 
                 
              }
            });
  
  
          // This is for Updating authoregory
          // For Updating authoregory
          document.getElementById("authorUpdateBtn").onclick = function(event) {
          event.preventDefault();
          
          let authorName = document.getElementById("eauthor_name").value;
          let authorSlug = document.getElementById("eauthor_slug").value;
          let authorDesc = document.getElementById("eauthor_desc").value;
          //alert(authorDesc);
          // let authorDesc = tinymce.get("eauthor_desc").getContent();
          let form= $("#authorUpdateForm");
          
          let formdata = new FormData(document.getElementById("authorUpdateForm"));
          formdata.append('author_update',true);
          formdata.append('author_id',id);
          
          if((authorName=="") | (authorSlug=="") | (authorDesc=="") ){
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
                          $("#editauthor").modal('hide');
                          viewAuthorTable(pageno);
                          swal("Congratulations!", "Author Updated Successfully!", "success");
                          
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
  
      $(document).on("click","#delAuthor",function() {
  
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
                      data: "author_id="+id+"&author_status="+status+"&del_author",
                      success: function(data) {
                          
                          if(data=="Delete Successfull"){
                              $("#editauthor").modal('hide');
                              viewAuthorTable(pageno);
                              swal("Congratulations!", "Author Deleted Successfully!", "success");
                              
                          }else{
                              swal("Try Again!", "Author Not Deleted! Please Try Again...", "error");
                          }
                      }
                    });
              }
            });
  
          
  
  
      });







    // Process Of Authors End Here














});
