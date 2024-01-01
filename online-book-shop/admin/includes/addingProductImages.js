
//  for View Product Images ("This function is Run When Page Refresh")
$(document).ready(function() {

    // let viewpimages = document.getElementById('viewpimagesData');
    function viewpimagesTable(page){
      $.ajax({
        url: "backend/addingInDatabase.php",
        type: "POST",
        data: {page_no :page ,'view_pimages':true},
        success: function(data) {
            // console.log(data);
            // alert(data);
            $("#viewpimagesData").html(data);
            
        }
      });
    }
    viewpimagesTable();

    //Pagination Code
    $(document).on("click","#pagination a",function(e) {
      e.preventDefault();
      var page_id = $(this).attr("id");

      viewpimagesTable(page_id);
    })






    // Adding Product Images 
    // For Adding New Product Image
    document.getElementById("pimagesAddBtn").onclick = function(event) {
        event.preventDefault();
        
        let pimages = document.getElementById("pimages").value;               
        let product_id = document.getElementById("product_id").value;
        let form= $("#pimagesAddForm");
        
        let formdata = new FormData(document.getElementById("pimagesAddForm"));
        formdata.append('pimages_add',true);

        // console.log(formdata);
        // console.log(form.serialize());

        // console.log(pimagesImage);
        
        if((pimages=="") | (product_id=="Select Any Product")){
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
                        $('#addnewpimages').modal('hide');
                        viewpimagesTable();
                        swal("Congratulations!", "Product Image Created Successfully!", "success");
                        
                    }else{
                        swal("Try Again!", "Product Image Not Inserted! Please Try Again...", "error");
                    }
                    form[0].reset();
                    
                }
            })
        }
        
    }



    // This is for Updating Status of Product Image

    $(document).on("click","#statusCheck",function() {

        let allData = $(this).data("status");
        let myArray = allData.split('@');
        //console.log(myArray);
        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];
        //let value = $('input[id="pimages_id"]').val();

        //alert(status);

        $.ajax({
            url: "backend/addingInDatabase.php",
            type: "POST",
            data: "pimages_id="+id+"&pimages_status="+status+"&pimages_status_change",
            success: function(data) {
                // console.log(data);
                if(data == "Status Updated Successfully"){
                    viewpimagesTable(pageno);
                    swal("Congratulations!", "Status Updated Successfully!", "success");
                }else{
                    swal("Congratulations!", "Status Updatation Failed!", "error");
                }
                
            }
          });

    });

    //  Code for Deleting pimagesegory

    $(document).on("click","#delpimages",function() {

        let allData = $(this).data("delete");
        let myArray = allData.split('@');

        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];


        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Image!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "backend/addingInDatabase.php",
                    type: "POST",
                    data: "pimages_id="+id+"&pimages_status="+status+"&del_pimages",
                    success: function(data) {
                        
                        if(data=="Delete Successfull"){
                            
                            viewpimagesTable(pageno);
                            swal("Congratulations!", "Product Image Deleted Successfully!", "success");
                            
                        }else{
                            swal("Try Again!", "Product Image Not Deleted! Please Try Again...", "error");
                        }
                    }
                  });
            }
          });

        


    });

    // Process Of pimagesegories End Here




});
