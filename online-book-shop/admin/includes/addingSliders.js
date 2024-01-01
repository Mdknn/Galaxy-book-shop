
//  for View Categories ("This function is Run When Page Refresh")
$(document).ready(function() {


    // Process Of sliders Start Here


    // let viewCat = document.getElementById('viewCatData');
    function viewSliderTable(page){
        $.ajax({
          url: "backend/addingInDatabase.php",
          type: "POST",
          data: {page_no :page ,'view_slider':true},
          success: function(data) {
              // console.log(data);
              // alert(data);
              $("#viewsliderData").html(data);
              
          }
        });
      }
      viewSliderTable();
  
      //Pagination Code
      $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");
  
        viewSliderTable(page_id);
      })
  
  
  
  
  
  
      // Adding Category 
      // For Adding New Category
      document.getElementById("sliderAddBtn").onclick = function(event) {
          event.preventDefault();
          
          
          let sliderUrl = document.getElementById("slider_url").value;
         // let sliderDesc = document.getElementById("slider_desc").value;
          let sliderImage = document.getElementById("slider_image").value;
          let form= $("#sliderAddForm");
          
          let formdata = new FormData(document.getElementById("sliderAddForm"));
          formdata.append('slider_add',true);
  
          // console.log(formdata);
          // console.log(form.serialize());
  
          // console.log(sliderImage);
          
          if((sliderUrl=="") | (sliderImage=="")){
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
                          $('#addnewslider').modal('hide');
                          viewSliderTable();
                          swal("Congratulations!", "Slider Image Added Successfully!", "success");
                          
                      }else{
                          swal("Try Again!", "Slider Image Not Inserted! Please Try Again...", "error");
                      }
                      form[0].reset();
                      
                  }
              })
          }
          
      }
  
  
  
      // This is for Updating Status of slideregory
  
      $(document).on("click","#statusCheck",function() {
  
          let allData = $(this).data("status");
          let myArray = allData.split('@');
          //console.log(myArray);
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
          //let value = $('input[id="slider_id"]').val();
  
          //alert(status);
  
          $.ajax({
              url: "backend/addingInDatabase.php",
              type: "POST",
              data: "slider_id="+id+"&slider_status="+status+"&slider_status_change",
              success: function(data) {
                  // console.log(data);
                  if(data == "Status Updated Successfully"){
                    viewSliderTable(pageno);
                      swal("Congratulations!", "Status Updated Successfully!", "success");
                  }else{
                      swal("Congratulations!", "Status Updatation Failed!", "error");
                  }
                  
              }
            });
  
      });
  
  
      //  This is for Polutaing Data on Update Modal and Functionality Of Update
  
      $(document).on("click","#editSlider",function() {
  
          let allData = $(this).data("edit");
          let myArray = allData.split('@');
  
          $("#editslider").modal('show');
  
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
          
          $.ajax({
              url: "backend/addingInDatabase.php",
              type: "POST",
              data: "slider_id="+id+"&slider_status="+status+"&edit_slider",
              success: function(data) {
                  result = JSON.parse(data);
                 //console.log(result[0].slider_name);
                 $("#eslider_url").val(result[0].slider_url);
                 $("#imgsrc").attr("src","Images/sliderImages/"+result[0].slider_pic);
                 
                 
              }
            });
  
  
          // This is for Updating slideregory
          // For Updating slideregory
          document.getElementById("sliderUpdateBtn").onclick = function(event) {
          event.preventDefault();
          
          let sliderUrl = document.getElementById("eslider_url").value;
         
          let form= $("#sliderUpdateForm");
          
          let formdata = new FormData(document.getElementById("sliderUpdateForm"));
          formdata.append('slider_update',true);
          formdata.append('slider_id',id);
          
          if((sliderUrl=="") ){
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
                          $("#editslider").modal('hide');
                          viewSliderTable(pageno);
                          swal("Congratulations!", "Slider Url Updated Successfully!", "success");
                          
                      }else{
                          swal("Try Again!", "Slider Url Not Updated! Please Try Again...", "error");
                      }
                      form[0].reset();
                      
                  }
              })
          }
          
      }
  
  
            
  
      });  //  Ending Edit and Updating Functionality
  
  
  
  
      //  Code for Deleting slideregory
  
      $(document).on("click","#delSlider",function() {
  
          let allData = $(this).data("delete");
          let myArray = allData.split('@');
  
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
  
  
          swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this Slider Image!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                      url: "backend/addingInDatabase.php",
                      type: "POST",
                      data: "slider_id="+id+"&slider_status="+status+"&del_slider",
                      success: function(data) {
                          
                          if(data=="Delete Successfull"){
                              $("#editslider").modal('hide');
                              viewSliderTable(pageno);
                              swal("Congratulations!", "Slider Deleted Successfully!", "success");
                              
                          }else{
                              swal("Try Again!", "Slider Not Deleted! Please Try Again...", "error");
                          }
                      }
                    });
              }
            });
  
          
  
  
      });







    // Process Of sliders End Here














});
