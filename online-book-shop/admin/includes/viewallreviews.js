
//  for View Categories ("This function is Run When Page Refresh")
$(document).ready(function() {


    // Process Of Authors Start Here


    // let viewCat = document.getElementById('viewCatData');
    function viewAllReviews(page){
        $.ajax({
          url: "includes/getAllReviews.php",
          type: "POST",
          data: {page_no :page ,'view_all_reviews':true},
          success: function(data) {
              // console.log(data);
              // alert(data);
              $("#viewAllReviews").html(data);
              
          }
        });
      }
      viewAllReviews();
  
      //Pagination Code
      $(document).on("click","#pagination a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");
  
        viewAllReviews(page_id);
      })
  
  
  
  
  
  
      
  
  
  
      // This is for Updating Status of Reviews
  
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
              url: "includes/getAllReviews.php",
              type: "POST",
              data: "rev_id="+id+"&rev_status="+status+"&review_status_change",
              success: function(data) {
                  // console.log(data);
                  if(data == "Status Updated Successfully"){
                    viewAllReviews(pageno);
                    swal("Congratulations!", "Status Updated Successfully!", "success");
                  }else{
                      swal("Congratulations!", "Status Updatation Failed!", "error");
                  }
                  
              }
            });
  
      });
  
  
      
  
  
      //  Code for Deleting Reviews
  
      $(document).on("click","#delReview",function() {
  
          let allData = $(this).data("delete");
          let myArray = allData.split('@');
  
          let id = myArray[0];
          let status = myArray[1];
          let pageno = myArray[2];
  
  
          swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this Reviews!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                      url: "includes/getAllReviews.php",
                      type: "POST",
                      data: "rev_id="+id+"&rev_status="+status+"&del_rev",
                      success: function(data) {
                          
                          if(data=="Delete Successfull"){
                              viewAllReviews(pageno);
                              swal("Congratulations!", "Review Deleted Successfully!", "success");
                              
                          }else{
                              swal("Try Again!", "Review Not Deleted! Please Try Again...", "error");
                          }
                      }
                    });
              }
            });
  
          
  
  
      });







    // Process Of Reviews End Here














});
