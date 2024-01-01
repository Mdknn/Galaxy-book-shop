
//  for View pcategories ("This function is Run When Page Refresh")
$(document).ready(function() {

    // let viewpcat = document.getElementById('viewpcatData');
    function viewpcatTable(page){
      $.ajax({
        url: "backend/addingInDatabase.php",
        type: "POST",
        data: {page_no :page ,'view_pcat':true},
        success: function(data) {
            // console.log(data);
            // alert(data);
            $("#viewpcatData").html(data);
            
        }
      });
    }
    viewpcatTable();

    //Pagination Code
    $(document).on("click","#pagination a",function(e) {
      e.preventDefault();
      var page_id = $(this).attr("id");

      viewpcatTable(page_id);
    })






    // Adding pcategory 
    // For Adding New pcategory
    document.getElementById("pcatAddBtn").onclick = function(event) {
        event.preventDefault();
        
        let pcatName = document.getElementById("pcat_name").value;
        let pcatSlug = document.getElementById("pcat_slug").value;
        let pcatDesc = tinymce.get("pcat_desc").getContent();
        // let pcatDesc = document.getElementById("pcat_desc").value;
        let pcatImage = document.getElementById("pcat_image").value;
        let cat_id = document.getElementById("cat_id").value;
        let form= $("#pcatAddForm");
        
        let formdata = new FormData(document.getElementById("pcatAddForm"));
        formdata.append('pcat_add',true);

        // console.log(formdata);
        // console.log(form.serialize());

        // console.log(pcatImage);
        
        if((pcatName=="") | (pcatSlug=="") | (pcatDesc=="") | (pcatImage=="") | (cat_id=="Select Any Category")){
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
                        $('#addnewpcategory').modal('hide');
                        viewpcatTable();
                        swal("Congratulations!", "Post Category Created Successfully!", "success");
                        
                    }else{
                        swal("Try Again!", "Post Category Not Inserted! Please Try Again...", "error");
                    }
                    form[0].reset();
                    
                }
            })
        }
        
    }



    // This is for Updating Status of pcategory

    $(document).on("click","#statusCheck",function() {

        let allData = $(this).data("status");
        let myArray = allData.split('@');
        //console.log(myArray);
        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];
        //let value = $('input[id="pcat_id"]').val();

        //alert(status);

        $.ajax({
            url: "backend/addingInDatabase.php",
            type: "POST",
            data: "pcat_id="+id+"&pcat_status="+status+"&pcat_status_change",
            success: function(data) {
                // console.log(data);
                if(data == "Status Updated Successfully"){
                    viewpcatTable(pageno);
                    swal("Congratulations!", "Status Updated Successfully!", "success");
                }else{
                    swal("Congratulations!", "Status Updatation Failed!", "error");
                }
                
            }
          });

    });


    //  This is for Polutaing Data on Update Modal and Functionality Of Update

    $(document).on("click","#editpcat",function() {

        let allData = $(this).data("edit");
        let myArray = allData.split('@');

        $("#editpcategory").modal('show');

        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];
        
        $.ajax({
            url: "backend/addingInDatabase.php",
            type: "POST",
            data: "pcat_id="+id+"&pcat_status="+status+"&edit_pcat",
            success: function(data) {
                result = JSON.parse(data);
               //console.log(result[0].pcat_name);
               $("#epcat_name").val(result[0].pcat_name);
            //    console.log(result[0].pcat_pic);
            //    console.log(result[0].pcat_slug);
            //    console.log(result[0].pcat_desc);
               $("#epcat_slug").val(result[0].pcat_slug);
               tinymce.get("epcat_desc").setContent(result[0].pcat_desc);
            //    $("#epcat_desc").val(result[0].pcat_desc);
               $("#showSelected").text("Earlier \""+result[1]+"\"" + " Selected");
               
               
               $("#imgsrc").attr("src","Images/ProdCategoryImages/"+result[0].pcat_pic);
               
               
            }
          });


        // This is for Updating pcategory
        // For Updating pcategory
        document.getElementById("pcatUpdateBtn").onclick = function(event) {
        event.preventDefault();
        
        let pcatName = document.getElementById("epcat_name").value;
        let pcatSlug = document.getElementById("epcat_slug").value;
        //let pcatDesc =tinymce.get("epcat_desc").getContent();
        let pcatDesc = document.getElementById("epcat_desc").value;
        let ecat_id = document.getElementById("ecat_id").value;
        console.log(ecat_id);
        let form= $("#pcatUpdateForm");
        
        let formdata = new FormData(document.getElementById("pcatUpdateForm"));
        formdata.append('pcat_update',true);
        formdata.append('pcat_id',id);

        console.log(ecat_id)
        
        if((pcatName=="") | (pcatSlug=="") | (pcatDesc=="") | (ecat_id=="Select Any Category")){
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
                        $("#editpcategory").modal('hide');
                        viewpcatTable(pageno);
                        swal("Congratulations!", "Post Category Updated Successfully!", "success");
                        
                    }else{
                        swal("Try Again!", "Post Category Not Updated! Please Try Again...", "error");
                    }
                    form[0].reset();
                    
                }
            })
        }
        
    }


          

    });  //  Ending Edit and Updating Functionality




    //  Code for Deleting pcategory

    $(document).on("click","#delpcat",function() {

        let allData = $(this).data("delete");
        let myArray = allData.split('@');

        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];


        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this pcategory!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "backend/addingInDatabase.php",
                    type: "POST",
                    data: "pcat_id="+id+"&pcat_status="+status+"&del_pcat",
                    success: function(data) {
                        
                        if(data=="Delete Successfull"){
                            $("#editpcategory").modal('hide');
                            viewpcatTable(pageno);
                            swal("Congratulations!", "Post Category Deleted Successfully!", "success");
                            
                        }else{
                            swal("Try Again!", "Post Category Not Deleted! Please Try Again...", "error");
                        }
                    }
                  });
            }
          });

        


    });

    // Process Of pcategories End Here




});
