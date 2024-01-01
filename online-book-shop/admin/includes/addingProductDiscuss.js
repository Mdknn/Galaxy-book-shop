
//  for View pdiscussegories ("This function is Run When Page Refresh")
$(document).ready(function() {

    // let viewpdiscuss = document.getElementById('viewpdiscussData');
    function viewpdiscussTable(page){
      $.ajax({
        url: "backend/addingInDatabase.php",
        type: "POST",
        data: {page_no :page ,'view_pdiscuss':true},
        success: function(data) {
            // console.log(data);
            // alert(data);
            $("#viewpdiscussData").html(data);
            
        }
      });
    }
    viewpdiscussTable();

    //Pagination Code
    $(document).on("click","#pagination a",function(e) {
      e.preventDefault();
      var page_id = $(this).attr("id");

      viewpdiscussTable(page_id);
    })






    // Adding pdiscussegory 
    // For Adding New pdiscussegory
    document.getElementById("pdiscussAddBtn").onclick = function(event) {
        event.preventDefault();
        
        let pdiscussName = document.getElementById("pdiscuss_name").value;        
        let pdiscussDesc = document.getElementById("pdiscuss_desc").value;
        let product_id = document.getElementById("product_id").value;
        let form= $("#pdiscussAddForm");

        // alert(pdiscussDesc)
        
        let formdata = new FormData(document.getElementById("pdiscussAddForm"));
        formdata.append('pdiscuss_add',true);

        // console.log(formdata);
        // console.log(form.serialize());

        // console.log(pdiscussImage);
        
        if((pdiscussName=="") | (pdiscussDesc=="") | (product_id=="Select Any Product")){
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
                        $('#addnewpdiscuss').modal('hide');
                        viewpdiscussTable();
                        swal("Congratulations!", "Post Category Created Successfully!", "success");
                        
                    }else{
                        swal("Try Again!", "Post Category Not Inserted! Please Try Again...", "error");
                    }
                    form[0].reset();
                    
                }
            })
        }
        
    }



    // This is for Updating Status of pdiscussegory

    $(document).on("click","#statusCheck",function() {

        let allData = $(this).data("status");
        let myArray = allData.split('@');
        //console.log(myArray);
        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];
        //let value = $('input[id="pdiscuss_id"]').val();

        //alert(status);

        $.ajax({
            url: "backend/addingInDatabase.php",
            type: "POST",
            data: "pdiscuss_id="+id+"&pdiscuss_status="+status+"&pdiscuss_status_change",
            success: function(data) {
                // console.log(data);
                if(data == "Status Updated Successfully"){
                    viewpdiscussTable(pageno);
                    swal("Congratulations!", "Status Updated Successfully!", "success");
                }else{
                    swal("Congratulations!", "Status Updatation Failed!", "error");
                }
                
            }
          });

    });


    //  This is for Polutaing Data on Update Modal and Functionality Of Update

    $(document).on("click","#editPdiscuss",function() {

        let allData = $(this).data("edit");
        let myArray = allData.split('@');

        $("#editpdiscuss").modal('show');

        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];
        
        $.ajax({
            url: "backend/addingInDatabase.php",
            type: "POST",
            data: "pdiscuss_id="+id+"&pdiscuss_status="+status+"&edit_pdiscuss",
            success: function(data) {
                result = JSON.parse(data);
                // console.log(result);
            
               $("#epdiscuss_name").val(result[0].dis_title);
               tinymce.get("epdiscuss_desc").setContent(result[0].dis_desc);
            //    $("#epdiscuss_desc").val(result[0].dis_desc);
               $("#showSelected").text("Earlier \""+result[1]+"\"" + " Selected");
               
               
               $("#imgsrc").attr("src","Images/ProdCategoryImages/"+result[0].pdiscuss_pic);
               
               
            }
          });


        // This is for Updating pdiscussegory
        // For Updating pdiscussegory
        document.getElementById("pdiscussUpdateBtn").onclick = function(event) {
        event.preventDefault();
        
        let pdiscussName = document.getElementById("epdiscuss_name").value;
        let pdiscussDesc = document.getElementById("epdiscuss_desc").value;
        let eproduct_id = document.getElementById("eproduct_id").value;
        //console.log(eproduct_id);
        let form= $("#pdiscussUpdateForm");
        
        let formdata = new FormData(document.getElementById("pdiscussUpdateForm"));
        formdata.append('pdiscuss_update',true);
        formdata.append('pdiscuss_id',id);

        console.log(eproduct_id)
        
        if((pdiscussName=="") | (pdiscussDesc=="") | (eproduct_id=="Select Any Product")){
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
                        $("#editpdiscuss").modal('hide');
                        viewpdiscussTable(pageno);
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




    //  Code for Deleting pdiscussegory

    $(document).on("click","#delPdiscuss",function() {

        let allData = $(this).data("delete");
        let myArray = allData.split('@');

        let id = myArray[0];
        let status = myArray[1];
        let pageno = myArray[2];


        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this pdiscussegory!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "backend/addingInDatabase.php",
                    type: "POST",
                    data: "pdiscuss_id="+id+"&pdiscuss_status="+status+"&del_pdiscuss",
                    success: function(data) {
                        
                        if(data=="Delete Successfull"){
                            
                            viewpdiscussTable(pageno);
                            swal("Congratulations!", "Product Discuss Deleted Successfully!", "success");
                            
                        }else{
                            swal("Try Again!", "Product Discuss Not Deleted! Please Try Again...", "error");
                        }
                    }
                  });
            }
          });

        


    });

    // Process Of pdiscussegories End Here




});
