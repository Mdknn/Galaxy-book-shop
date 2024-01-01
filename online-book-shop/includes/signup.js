

// Hiding and Showing Modal at same time
$("#signupAgain").on("click", function(){
    $("#loginModal").modal("hide");
    $('#signupModal').modal("show");
});

$("#loginAgain").on("click", function(){
    $("#signupModal").modal("hide");
    $('#loginModal').modal("show");
});



// For Email Otp part start from here

var otp_from_back="";

    document.getElementById("votp").style.display='none';

    let submitBtn = document.getElementById("submitBtn");
    submitBtn.classList.add("disabled")

    let sendotp = document.getElementById("sotp");
    sendotp.classList.add("disabled")

    let verifyotpBtn = document.getElementById("verotp");
    verifyotpBtn.classList.add("disabled")

    let validEmail = false;

    let email = document.getElementById("email");

    email.onkeyup = function(){
        // console.log("Keydown")
        const regex = /^([\.\_a-zA-Z0-9]+)@([a-zA-Z]+)\.([a-zA-Z]){2,8}$/;
        const regexo = /^([\.\_a-zA-Z0-9]+)@([a-zA-Z]+)\.([a-zA-Z]){2,3}\.[a-zA-Z]{1,3}$/;
        // console.log(email.value)

        if(regex.test(email.value) || regexo.test(email.value)){
        // console.log("write")
        
        document.getElementById("emailstatus").style.color="green";            
        document.getElementById("emailstatus").innerHTML="Your Email is Valid";
        sendotp.classList.remove("disabled");
        
        validEmail = true;

        }else{
        // console.log("wrong")
        document.getElementById("emailstatus").style.color="red";            
        document.getElementById("emailstatus").innerHTML="Your Email is Inalid";
        validEmail = false;
        sendotp.classList.add("disabled");
        
        }
    }


    let otpValue = document.getElementById("verifyotp");

    let validOTP = false;


    otpValue.onkeyup = function(){
        // console.log("Keydown")
        const regex = /^[0-9]{4}$/;

        if(regex.test(otpValue.value)){
        // console.log("write")
        
        verifyotpBtn.classList.remove("disabled")
        document.getElementById("msgstatus").style.color="green";            
        document.getElementById("msgstatus").innerHTML="We will Check Your Otp";
        
        validOTP = true;

        }else{
        // console.log("wrong")
        verifyotpBtn.classList.add("disabled");
        document.getElementById("msgstatus").style.color="red";            
        document.getElementById("msgstatus").innerHTML="Please Enter 4 Digit OTP";
        validOTP = false;
        
        
        }
    }


    function ajax_send_otp(){
    
    email = document.getElementById("email");

    if (validEmail){

        let emailValue = document.getElementById("emailvalue")
        emailValue.value = email.value;
        //  console.log(emailValue.value)

        sendotp.classList.add("disabled");
        document.getElementById("email").disabled=true;

        document.getElementById("votp").style.display='block';

        document.getElementById("sotp").classList.add("btn-warning");
        document.getElementById("sotp").innerHTML="Please wait";


        jQuery.ajax({
            type: "post",
            url:'frontend/register.php',
            data:{'email':email.value,'check_email':true},
            success:function(data){
               // otp_from_back = data;

                if(data=="Email Already Exists"){
                    sendotp.classList.remove("disabled");
                    document.getElementById("email").disabled=false;
                    document.getElementById("sotp").innerHTML="Send OTP";
                    document.getElementById("sotp").classList.add("btn-warning");
                    document.getElementById("sotp").innerHTML="Try Again!"
                    document.getElementById("votp").style.display='none';
                    document.getElementById("emailstatus").style.color="red";            
                    document.getElementById("emailstatus").innerHTML="Your Email is Already Exist";

                    swal("Email Already Exist!", "Email Already Registered! Please Enter Another Email", "info");

                }else{
                    document.getElementById("sotp").classList.remove("btn-warning");            
                    document.getElementById("sotp").classList.add("btn-success");            
                    document.getElementById("sotp").innerHTML="OTP Sended";

                    document.getElementById("emailstatus").style.color="blue";            
                    document.getElementById("emailstatus").innerHTML="Please Check your Email";
                    document.getElementById("emailstatus").style.color="success";            
                    document.getElementById("emailstatus").innerHTML="OTP is sended successfully! Please Check Your Email";

                    swal("Congratulations!", "OTP is Sent Successfully! Check your Email", "success");

                        jQuery.ajax({
                            type: "post",
                            url:'frontend/register.php',
                            data:{'email':email.value,'send_email':true},
                            success:function(data){
                                otp_from_back = data;
                            }
                        });
                }

            }
        })
        
    
    }

    }


    function verify_otp(){

    verifyotpBtn.classList.add("disabled");
    document.getElementById("verifyotp").disabled=true;

    // console.log(document.getElementById("verifyotp").value);
    // console.log(otp_from_back);

    if(validOTP){
        var user_otp=document.getElementById("verifyotp").value;
        if (user_otp==otp_from_back){
            verifyotpBtn.classList.remove("disabled");
            verifyotpBtn.classList.add("disabled");           
            document.getElementById("verotp").classList.remove("btn-danger");            
            document.getElementById("verotp").classList.add("btn-success");            
            document.getElementById("verotp").innerHTML="Verified";
            document.getElementById("verifyotp").disabled=true;
            document.getElementById("msgstatus").style.color="green";            
            document.getElementById("msgstatus").innerHTML="Your OTP is verified";

            submitBtn.classList.remove("disabled");

            swal("OTP Verified!", "Your OTP is verified Successfully! ", "success");

            // document.getElementById("otp_div").style.display="none";
            // document.getElementById("form_div").style.display="block";
        }
        else{
            verifyotpBtn.classList.remove("disabled");            
            document.getElementById("verotp").classList.add("btn-danger");
            document.getElementById("verotp").innerHTML="Try Again!";
            document.getElementById("verifyotp").disabled=false;
            document.getElementById("msgstatus").style.color="fuchsia";            
            document.getElementById("msgstatus").innerHTML="Please Enter Correct OTP!!";

            swal("Wrong OTP!", "OTP is Wrong! Enter Correct OTP", "info");
        }

    }
        
        
    } 



// For Email Otp part End here






// Signup
document.getElementById("submitBtn").onclick = function(event) {
    event.preventDefault();
    
    let name = document.getElementById("name").value;
    let email = document.getElementById("emailvalue").value;
    let mobile = document.getElementById("mobile").value;
    let pass1 = document.getElementById("pass1").value;
    let pass2 = document.getElementById("pass2").value;
    let form= $("#signupForm");
    console.log(email);

    if((name=="") | (email=="") | (mobile=="") | (pass1=="") | (pass2=="")){
        swal("Try Again!", "All Fields are Required*!", "error");
    }
    else if((pass1 != pass2)){
        swal("Try Again!", "Confirm Password Does not match*!", "error");
    }
    
    else{
        
        jQuery.ajax({
            type: "POST",
            url:"frontend/register.php",
            data: form.serialize() + "&register",
            success:function(data){
                if(data=="Registration Successfull"){
                    $("#signupModal").modal("hide");
                    swal("Congratulations!", "Registration Successfull!", "success");
                }else{
                    swal("Try Again!", "Registration Failed!", "error");
                }
                form[0].reset();
                
            }
        })
    }
}
// Login
document.getElementById("loginBtn").onclick = function(event) {
    event.preventDefault();
    
    
    let lemail = document.getElementById("lemail").value;
    let password = document.getElementById("password").value;
    let form= $("#loginForm");
    console.log(lemail);
    console.log(password);

    if((lemail=="") | (password=="")){
        swal("Try Again!", "All Fields are Required*!", "error");
    }
    
    else{
        
        jQuery.ajax({
            type: "POST",
            url:"frontend/register.php",
            data: form.serialize() + "&login",
            success:function(data){
                // alert(data);
                if(data=="Your Account is Temporary Deactivated"){
                    swal("Temporary Deactivated", "Login Failed! Your Account is Temporary Deactivated!! ", "info");
                }
                else if(data=="Password is Wrong"){
                    swal("Password Wrong", "Invalid Password! Please Enter correct Password", "error");
                }
                else if(data=="Login Successfull"){
                    $("#loginModal").modal("hide");
                    swal("Congratulations!", "Login Successfull!", "success");
                    window.setTimeout(function () {
                        window.location.href = "index.php";
                    }, 1000);
                    form[0].reset();
                }else{
                    swal("Try Again!", "Login Failed! Please give correct Email and Password", "error");
                }
                
                
            }
        })
    }
}





// This javascript code for loading animation
var loadAnimation = document.getElementById("loadanimation");
function myFunction() {
    loadAnimation.style.display="none";
}



