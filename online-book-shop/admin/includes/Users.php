<a href="/" class="btn btn-success w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="author text-white">View All Users</span> </a>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewUser">
  ADD NEW STAFF
</button>


<!-- Signup Model -->
<div class="modal fade" id="addNewUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signupModalTitle">ADD NEW STAFF</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method='post' id='userAddForm'>
            <span class="f-w5 text-danger" id="errortext"></span>
           
            <div class="form-group my-2">
              <label for="name" class="my-2">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Full Name">
            </div>
            
            <div class="form-group my-3">
              <label for="email" class="my-2">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" >
              
            </div>
        
            <div class="form-group my-2">
              <label for="mobile" class="my-2">Mobile Number</label>
              <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter Your Full Name">
            </div>

            <select class="form-select my-4" aria-label="Default select example" id="user_type" name="user_type">
                <option value="0" selected>Select User Type</option>
                <option value="user">User</option>
                <option value="vendor">Vendor</option>
                <option value="admin">Admin</option>
            </select>

            <select class="form-select my-3" aria-label="Default select example" id="job" name="job">
                <option value="0" selected>Select Job</option>
                <option value="customer">Customer</option>
                <option value="seller">Seller</option>
                <option value="marketer">Marketer</option>
                <option value="admin">Admin</option>
            
            </select>
            
            <div class="form-group my-2">
              <label for="pass1" class="my-2">Choose a password</label>
              <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Choose Your Password" aria-describedby="passhelp1">
              <!-- <div class="form-text" id="passhelp1">Your Password must be more than 5 characters</div> -->
            </div>
            <div class="form-group my-2">
              <label for="pass2" class="my-2">Confirm Password</label>
              <input type="password" class="form-control" id="pass2" name="pass2"
                placeholder="Enter your password again" aria-describedby="passhelp2">
              <!-- <div class="form-text" id="passhelp2">Your Password must be more than 5 characters</div> -->
            </div>


            
            <button type="submit" class="btn btn-primary my-3 w-25" id="userAddBtn">Submit</button>

            <!-- Login Btn Here with Signup Button -->
            <!-- We handle model close and open by javascript -->
            <button type="button" class="btn btn-success mx-3 w-25 my-3" id="loginAgain">
              Login
          </button>

          </form>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>


<div class="row">

    <div class="col-lg-12 mt-4">

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb ms-2">
            <li class="breadcrumb-item"><a href="#" class="smallLinkTitle f-w5">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> <span class="smallLinkTitle f-w5 text-success">View All Staffs</span></li>
        </ol>
    </nav>
    <div class="card p-0 table-responsive"id="viewuserData">
        <!-- Adding Here Dynamic Data -->
                
                    
            
                
            

        <!-- <nav aria-label="...">
            <ul class="pagination pagination justify-content-center align-items-center my-4">
                <li class="page-item active" aria-current="page">
                <a class="page-link">1</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
            </ul>
        </nav> -->

       
    </div>

    </div>



</div>



<!-- Edit Modal -->


<!-- Modal -->
<div class="modal fade" id="editauthor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPDATE STAFF DETAILS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="authorUpdateForm">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="eauthor_name" class="form-label">authore Name</label>
                        <input type="text" class="form-control" id="eauthor_name" name="eauthor_name" value="hero">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="eauthor_slug" class="form-label">author Slug</label>
                        <input type="text" class="form-control" id="eauthor_slug" name="eauthor_slug" >
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="eauthor_desc" class="form-label">author Description</label>
                        <textarea type="text" class="form-control" id="eauthor_desc" name="eauthor_desc" rows="3" ></textarea>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label for="eauthor_image" class="form-label">Choose Image</label>
                        <input class="form-control form-control-sm" id="eauthor_image" name="eauthor_image" type="file">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <img src="" id="imgsrc" alt="" width="100px" height="100px">
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100" id="authorUpdateBtn">Update</button>
                </div>
                
                <div class="col-lg-3 mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
            
        </form>
      </div>
     
    </div>
  </div>
</div>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="includes/addingUsers.js" > </script>

