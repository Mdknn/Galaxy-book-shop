

// Login
document.getElementById("loginBtn").onclick = function(event) {
    event.preventDefault();
    
    
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let form= $("#loginForm");
    console.log(email);
    console.log(password);

    if((email=="") | (password=="")){
        swal("Try Again!", "All Fields are Required*!", "error");
    }
    
    else{
        
        jQuery.ajax({
            type: "POST",
            url:"../backend/adminlogin.php",
            data: form.serialize() + "&login",
            success:function(data){
                if(data=="Login Successfull"){
                    swal("Congratulations!", "Login Successfull!", "success");
                    window.setTimeout(function () {
                        window.location.href = "../index.php";
                    }, 2000);
                    form[0].reset();
                }
                else if(data=="Wrong Password"){
                    swal("Password Wrong", "Invalid Password! Please Enter correct Password", "error");
                }
                else{
                    swal("Try Again!", "Login Failed! Please give correct Email and Password", "error");
                }
                
                
            }
        })
    }
}




