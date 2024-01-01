
//  for View Categories ("This function is Run When Page Refresh")
$(document).ready(function() {


    // Process Of users Start Here


    // let viewCat = document.getElementById('viewCatData');
    function viewUsersTable(page){
        $.ajax({
          url: "backend/addingInDatabase.php",
          type: "POST",
          data: {page_no :page ,'view_user':true},
          success: function(data) {
              // console.log(data);
              // alert(data);
              $("#viewuserData").html(data);
              
          }
        });
      }
      viewUsersTable();
  
      //Pagination Code
      $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");
  
        viewUsersTable(page_id);
      })
  
  
  
  
  
  
      // Adding Category 
      // For Adding New Category
      document.getElementById("userAddBtn").onclick = function(event) {
          event.preventDefault();


        let name = document.getElementById("name").value;
        let email = document.getElementById("email").value;
        let mobile = document.getElementById("mobile").value;
        let job = document.getElementById("job").value;
        let user_type = document.getElementById("user_type").value;
        let pass1 = document.getElementById("pass1").value;
        let pass2 = document.getElementById("pass2").value;

        let form= $("#userAddForm");
          
          
        let formdata = new FormData(document.getElementById("userAddForm"));
        formdata.append('user_add',true);

        if((name=="") | (email=="") | (mobile=="") | (job=="0") | (user_type=="0") | (pass1=="") | (pass2=="")){
            swal("Try Again!", "All Fields are Required*!", "error");
        }
        else if((pass1 != pass2)){
            swal("Try Again!", "Confirm Password Does not match*!", "error");
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
                    if(result == "Email Already Exist"){
                        swal("Email Already Exist!", "Please Enter Another Email", "error");
                    }
                    else if(result=="Registration Successful"){
                        $('#addNewUser').modal('hide');
                        viewUsersTable();
                        swal("Congratulations!", "Staff Registration Successfully!", "success");
                        form[0].reset();
                        
                    }else{
                        swal("Try Again!", "Staff Registration Failed! Please Try Again...", "error");
                    }
                    
                    
                }
            })
        }
          
        

    
          
          
          
      }
  
  
  
      // This is for Updating Status of useregory
  
      $(document).on("click","#statusCheck",function() {
  
          let allData = $(this).data("status");
          let myArray = allData.split('@');
          //console.log(myArray);
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
          //let value = $('input[id="user_id"]').val();
  
          //alert(status);
  
          $.ajax({
              url: "backend/addingInDatabase.php",
              type: "POST",
              data: "user_id="+id+"&user_status="+status+"&user_status_change",
              success: function(data) {
                  // console.log(data);
                  if(data == "Status Updated Successfully"){
                      viewUsersTable(pageno);
                      swal("Congratulations!", "Status Updated Successfully!", "success");
                  }else{
                      swal("Congratulations!", "Status Updatation Failed!", "error");
                  }
                  
              }
            });
  
      });
  
  
      //  This is for Polutaing Data on Update Modal and Functionality Of Update
  
      $(document).on("click","#edituser",function() {
  
          let allData = $(this).data("edit");
          let myArray = allData.split('@');
  
          $("#edituser").modal('show');
  
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
          
          $.ajax({
              url: "backend/addingInDatabase.php",
              type: "POST",
              data: "user_id="+id+"&user_status="+status+"&edit_user",
              success: function(data) {
                  result = JSON.parse(data);
                 //console.log(result[0].user_name);
                 $("#euser_name").val(result[0].user_name);
                 console.log(result[0].user_pic);
                 console.log(result[0].user_slug);
                 console.log(result[0].user_desc);
                 $("#euser_slug").val(result[0].user_slug);
                 // $("#euser_desc").val(result[0].user_desc);
                 tinymce.get("euser_desc").setContent(result[0].user_desc)
                 $("#imgsrc").attr("src","Images/userImages/"+result[0].user_pic);
                 
                 
              }
            });
  
  
          // This is for Updating useregory
          // For Updating useregory
          document.getElementById("userUpdateBtn").onclick = function(event) {
          event.preventDefault();
          
          let userName = document.getElementById("euser_name").value;
          let userSlug = document.getElementById("euser_slug").value;
          let userDesc = document.getElementById("euser_desc").value;
          //alert(userDesc);
          // let userDesc = tinymce.get("euser_desc").getContent();
          let form= $("#userUpdateForm");
          
          let formdata = new FormData(document.getElementById("userUpdateForm"));
          formdata.append('user_update',true);
          formdata.append('user_id',id);
          
          if((userName=="") | (userSlug=="") | (userDesc=="") ){
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
                          $("#edituser").modal('hide');
                          viewUsersTable(pageno);
                          swal("Congratulations!", "user Updated Successfully!", "success");
                          
                      }else{
                          swal("Try Again!", "user Not Updated! Please Try Again...", "error");
                      }
                      form[0].reset();
                      
                  }
              })
          }
          
      }
  
  
            
  
      });  //  Ending Edit and Updating Functionality
  
  
  
  
      //  Code for Deleting useregory
  
      $(document).on("click","#deluser",function() {
  
          let allData = $(this).data("delete");
          let myArray = allData.split('@');
  
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
  
  
          swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this useregory!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                      url: "backend/addingInDatabase.php",
                      type: "POST",
                      data: "user_id="+id+"&user_status="+status+"&del_user",
                      success: function(data) {
                          
                          if(data=="Delete Successfull"){
                              $("#edituser").modal('hide');
                              viewUsersTable(pageno);
                              swal("Congratulations!", "user Deleted Successfully!", "success");
                              
                          }else{
                              swal("Try Again!", "user Not Deleted! Please Try Again...", "error");
                          }
                      }
                    });
              }
            });
  
          
  
  
      });







    // Process Of users End Here














});
