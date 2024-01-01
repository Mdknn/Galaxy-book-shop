// For Logout

if(document.getElementById("logout") !=null ){
document.getElementById("logout").onclick = function(event) {
    event.preventDefault();
    
    swal({
        title: "Do Logout",
        text: "Are You Sure You Want to Logout?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            jQuery.ajax({
                type: "POST",
                url:"frontend/register.php",
                data: "logout",
                success:function(data){
                    if(data=="Logout Successfull"){
                        swal("Congratulations!", "Logout Successfull!", "success");
                        window.setTimeout(function () {
                            window.location.href = "index.php";
                        }, 1000)
                    }
                    
                    
                }
            });  
        }
      });
        
    
}
}
