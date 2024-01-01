<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" id="navColor">
  <div class="container-fluid">
    <a class="navbar-brand text-white f-w5 d-flex justify-content-center align-items-center" href="index.php"><i class="fab fa-gofore fs-1" style="color:#f09449;" id="logohover"></i> <span class="ms-3 fs-3" style="color:#f09449;" id="brandhover">Book Shop</span> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <?php 
      $currentPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    ?>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php if($currentPageName == 'index.php') { echo 'active' ;} ?> text-white f-w4 linkTitle" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($currentPageName == 'allbooks.php') { echo 'active' ;} ?> text-white f-w4 linkTitle" aria-current="page" href="allbooks.php">All Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($currentPageName == 'categories.php') { echo 'active' ;} ?> text-white f-w4 linkTitle" aria-current="page" href="categories.php">All Categories</a>
        </li>
        <li class="nav-item dropdown">
          <a class=" text-white f-w4 linkTitle nav-link dropdown-toggle <?php if($currentPageName == 'filter-products.php' or $currentPageName == 'show-books.php') { echo 'active' ;} ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Filter By
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="f-w4 <?php if(isset($_REQUEST['allsubject']) or isset($_REQUEST['subject'])){ echo 'active' ; } ?> linkTitle dropdown-item" href="http://localhost/Php All Projects/online-book-shop/filter-products.php?allsubject=yes">Subjects</a></li>
            <li><a class=" f-w4 <?php if(isset($_REQUEST['language'])){ echo 'active' ; } ?> linkTitle dropdown-item" href="http://localhost/Php All Projects/online-book-shop/filter-products.php?language=yes">Book Language</a></li>
            <li><a class=" f-w4 <?php if(isset($_REQUEST['author'])){ echo 'active' ; } ?> linkTitle dropdown-item" href="http://localhost/Php All Projects/online-book-shop/filter-products.php?author=yes">Author Name</a></li>
            <li><a class=" f-w4 <?php if(isset($_REQUEST['publisher'])){ echo 'active' ; } ?> linkTitle dropdown-item" href="http://localhost/Php All Projects/online-book-shop/filter-products.php?publisher=yes">Publisher Name</a></li>
            <li><a class=" f-w4 <?php if(isset($_REQUEST['suitage'])){ echo 'active' ; } ?> linkTitle dropdown-item" href="http://localhost/Php All Projects/online-book-shop/filter-products.php?suitage=yes">Recommended Age</a></li>
            <li><a class=" f-w4 <?php if(isset($_REQUEST['trending'])){ echo 'active' ; } ?> linkTitle dropdown-item" href="http://localhost/Php All Projects/online-book-shop/show-books.php?trending=yes">All Trending Books</a></li>
            <li><a class=" f-w4 linkTitle <?php if(isset($_REQUEST['discount'])){ echo 'active' ; } ?> dropdown-item" href="http://localhost/Php All Projects/online-book-shop/filter-products.php?discount=yes">Books on Discount</a></li>
            
          </ul>
        </li>
       
        
        
      </ul>
      <form class="d-flex" method="get" action="show-books.php">
        <input class="form-control me-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary text-white f-w4" type="submit">Search</button>
      </form>

      

      <?php
      if(isset($_SESSION['customer_email'])){
        ?>
        <a class="nav-link <?php if($currentPageName == 'cart.php') { echo 'active' ;} ?> f-w7 text-white linkTitle " aria-current="page" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge rounded-pill bg-success fs-6" id="cartNumber" ><?php echo $totalCartProduct ;?></span></a>
        <ul class="navbar-nav mx-2">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle p-2 btn btn-primary text-white ms-2 dashnav"  href='#' id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false"> Welcome  <?= $_SESSION['customer_name'] ?></a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

              <a class="dropdown-item mt-2 <?php if($currentPageName == 'myorders.php') { echo 'active' ;} ?> " href="myorders.php">My Orders</a>          
              <a class="dropdown-item mt-2 <?php if($currentPageName == 'update-password.php') { echo 'active' ;} ?>" href="update-password.php">Update Password</a>
              <a class="dropdown-item mt-2" href="#" id="logout">Logout</a>

            </div>
          </li>
        </ul>
      </div>
<?php
      }else{  ?>



      <button class="btn btn-success ms-2 signup" aria-current="page" href="#" id="signupnav" data-bs-toggle="modal"  data-bs-target="#signupModal"><i class="fa fa-user-plus me-1" aria-hidden="true"></i> Sign up</button>
      <button class="btn btn-primary ms-2 signin" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#loginModal" id="loginnav"><i class="fas fa-sign-in-alt me-1"></i> Sign in</button>
      <a class="nav-link f-w7 text-white linkTitle <?php if($currentPageName == 'cart.php') { echo 'active' ;} ?> " aria-current="page" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge rounded-pill bg-success fs-6" id="cartNumber" ><?php echo $totalCartProduct ;?></span></a>

      <?php
      }
      ?>
    </div>
  </div>
</nav>



<!-- Signup Model -->
<div class="modal fade" id="signupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signupModalTitle">SignUp Here</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method='post' id='signupForm'>
            <span class="f-w5 text-danger" id="errortext"></span>
           
            <div class="form-group my-2">
              <label for="name" class="my-2">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Full Name">
            </div>
            
            <div class="form-group my-3">
              <label for="email" class="my-2">Email address</label>
              <input type="email" class="form-control w-50 d-inline " id="email" name="email" placeholder="name@example.com" >
              
              <input type="hidden" id="emailvalue" name="emailvalue" value="Hello" placeholder="name@example.com">
              <a class="btn btn-primary " onclick="ajax_send_otp()" id="sotp" >Send OTP</a>
              <div id="emailstatus" class="form-text fs-6 fw-bolder text-center me-5"></div>
            </div>
            <div class="form-group my-3 " id="votp">
              <label for="verifyotp" class="my-2">Verify OTP</label>
              <input type="number" class="form-control w-50 d-inline ms-2 me-2 " id="verifyotp" name="verifyotp" placeholder="1234">
              <a class="btn btn-primary" onclick="verify_otp()" id="verotp" >Verify OTP</a>
              <div id="msgstatus" class="form-text fs-6 fw-bolder text-center me-5"></div>
            </div>

            

            <div class="form-group my-2">
              <label for="mobile" class="my-2">Mobile Number</label>
              <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter Your Full Name">
            </div>
            
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


            
            <button type="submit" class="btn btn-primary my-3 w-25" id="submitBtn">Submit</button>

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



  <!-- Login Model -->
  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Login Here</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="loginForm">

            <div class="form-group my-2">
              <label for="lemail" class="my-2">Email</label>
              <input type="email" class="form-control" id="lemail" name="lemail"
                placeholder="Enter Email Here">
            </div>
            <div class="form-group my-2">
              <label for="password" class="my-2">Enter your password </label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password ">
            </div>

            <button type="submit" class="my-4 btn btn-primary w-25" id="loginBtn">Submit</button>

            <!-- Signup Btn Here with Login Button -->
            <!-- We handle model close and open by javascript -->
             
            <button type="button" id="signupAgain" class="btn btn-success w-25"    >
              SignUp
            </button>


          </form>

          
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>

<?php
// print_r($_SESSION);
?>