
//  for View Categories ("This function is Run When Page Refresh")
$(document).ready(function() {

    // let viewCat = document.getElementById('viewCatData');
    function viewCatTable(page){
      $.ajax({
        url: "backend/addingInDatabase.php",
        type: "POST",
        data: {page_no :page ,'view_cat':true},
        success: function(data) {
            // console.log(data);
            // alert(data);
            $("#viewCatData").html(data);
            
        }
      });
    }
    viewCatTable();

    //Pagination Code
    $(document).on("click","#pagination a",function(e) {
      e.preventDefault();
      var page_id = $(this).attr("id");

      viewCatTable(page_id);
    })






    // Adding Category 
    // For Adding New Category
    document.getElementById("catAddBtn").onclick = function(event) {
        event.preventDefault();
        
        let catName = document.getElementById("cat_name").value;
        let catSlug = document.getElementById("cat_slug").value;
        let catDesc = tinymce.get("cat_desc").getContent();
        // let catDesc = document.getElementById("cat_desc").value;
        let catImage = document.getElementById("cat_image").value;
        let form= $("#catAddForm");
        
        let formdata = new FormData(document.getElementById("catAddForm"));
        formdata.append('cat_add',true);

        // console.log(formdata);
        // console.log(form.serialize());

        // console.log(catImage);
        
        if((catName=="") | (catSlug=="") | (catDesc=="") | (catImage=="")){
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
                        $('#addnewcategory').modal('hide');
                        viewCatTable();
                        swal("Congratulations!", "Category Created Successfully!", "success");
                        
                    }else{
                        swal("Try Again!", "Category Not Inserted! Please Try Again...", "error");
                    }
                    form[0].reset();
                    
                }
            })
        }
        
    }



    // This is for Updating Status of Category

    $(document).on("click","#statusCheck",function() {

        let allData = $(this).data("status");
        let myArray = allData.split('@');
        //console.log(myArray);
        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];
        //let value = $('input[id="cat_id"]').val();

        //alert(status);

        $.ajax({
            url: "backend/addingInDatabase.php",
            type: "POST",
            data: "cat_id="+id+"&cat_status="+status+"&cat_status_change",
            success: function(data) {
                // console.log(data);
                if(data == "Status Updated Successfully"){
                    viewCatTable(pageno);
                    swal("Congratulations!", "Status Updated Successfully!", "success");
                }else{
                    swal("Congratulations!", "Status Updatation Failed!", "error");
                }
                
            }
          });

    });


    //  This is for Polutaing Data on Update Modal and Functionality Of Update

    $(document).on("click","#editCat",function() {

        let allData = $(this).data("edit");
        let myArray = allData.split('@');

        $("#editCategory").modal('show');

        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];
        
        $.ajax({
            url: "backend/addingInDatabase.php",
            type: "POST",
            data: "cat_id="+id+"&cat_status="+status+"&edit_cat",
            success: function(data) {
                result = JSON.parse(data);
               //console.log(result[0].cat_name);
               $("#ecat_name").val(result[0].cat_name);
               //console.log(result[0].cat_pic);
               //console.log(result[0].cat_slug);
               //console.log(result[0].cat_desc);
               $("#ecat_slug").val(result[0].cat_slug);
               tinymce.get("ecat_desc").setContent(result[0].cat_desc);
              // $("#ecat_desc").val(result[0].cat_desc);
               $("#imgsrc").attr("src","Images/CategoryImages/"+result[0].cat_pic);
               
               
            }
          });


        // This is for Updating Category
        // For Updating Category
        document.getElementById("catUpdateBtn").onclick = function(event) {
        event.preventDefault();
        
        let catName = document.getElementById("ecat_name").value;
        let catSlug = document.getElementById("ecat_slug").value;
       // let catDesc = tinymce.get("ecat_desc").getContent();
         let catDesc = document.getElementById("ecat_desc").value;
        let form= $("#catUpdateForm");
        
        let formdata = new FormData(document.getElementById("catUpdateForm"));
        formdata.append('cat_update',true);
        formdata.append('cat_id',id);
        
        if((catName=="") | (catSlug=="") | (catDesc=="") ){
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
                        $("#editCategory").modal('hide');
                        viewCatTable(pageno);
                        swal("Congratulations!", "Category Updated Successfully!", "success");
                        
                    }else{
                        swal("Try Again!", "Category Not Updated! Please Try Again...", "error");
                    }
                    form[0].reset();
                    
                }
            })
        }
        
    }


          

    });  //  Ending Edit and Updating Functionality




    //  Code for Deleting Category

    $(document).on("click","#delCat",function() {

        let allData = $(this).data("delete");
        let myArray = allData.split('@');

        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];


        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Category!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "backend/addingInDatabase.php",
                    type: "POST",
                    data: "cat_id="+id+"&cat_status="+status+"&del_cat",
                    success: function(data) {
                        
                        if(data=="Delete Successfull"){
                            $("#editCategory").modal('hide');
                            viewCatTable(pageno);
                            swal("Congratulations!", "Category Deleted Successfully!", "success");
                            
                        }else{
                            swal("Try Again!", "Category Not Deleted! Please Try Again...", "error");
                        }
                    }
                  });
            }
          });

        


    });

    // Process Of Categories End Here




});
