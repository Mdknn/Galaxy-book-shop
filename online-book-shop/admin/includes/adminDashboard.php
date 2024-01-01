<a href="/" class="btn btn-primary w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="author text-white">ADMIN DASHBOARD</span> </a>

<?php

include('backend/function.php');

?>

<div class="container">
    <div class="row">


        <div class="col-lg-6 my-5">
            <a href='index.php?view_authors' class="dcard bg-c-blue order-card text-decoration-none">
                <div class="card-block sp">
                    <h3 class="m-b-20 text-center">Total Number Of Authors</h3>
                    <h2 class="text-center mt-3 fw-bolder"><?= getAllNumberAuthors();  ?></h2>
                    <h5 class="text-center mt-3">See All Authors <i class="fas text-center fa-arrow-alt-circle-right ms-1" style="font-size:18px"></i></span></h5>
                </div>
            </a>
        </div>
        
        <div class="col-lg-6 my-5">
            <a href='index.php?view_publishers' class="dcard bg-c-blue order-card text-decoration-none">
                <div class="card-block sp">
                    <h3 class="m-b-20 text-center">Total Number Of Publishers</h3>
                    <h3 class="text-center mt-3 fw-bolder"><?= getAllNumberPublishers();  ?></h3>
                    <h5 class="text-center mt-3">See All Publishers <i class="fas text-center fa-arrow-alt-circle-right ms-1" style="font-size:18px"></i></span></h5>
                </div>
            </a>
        </div>

        
        <div class="col-lg-6 my-4">
            <a href='index.php?view_products' class="dcard bg-c-blue order-card text-decoration-none">
                <div class="card-block sp">
                    <h3 class="m-b-20 text-center">Total Number Of Products</h3>
                    <h3 class="text-center mt-3 fw-bolder"><?= getAllNumberProducts();  ?></h3>
                    <h5 class="text-center mt-3">See All Products <i class="fas text-center fa-arrow-alt-circle-right ms-1" style="font-size:18px"></i></span></h5>
                </div>
            </a>
        </div>

        <div class="col-lg-6 my-4">
            <a href='index.php?view_all_Users' class="dcard bg-c-blue order-card text-decoration-none">
                <div class="card-block sp">
                    <h3 class="m-b-20 text-center">Total Number Of Users</h3>
                    <h3 class="text-center mt-3 fw-bolder"><?= getAllNumberUsers();  ?></h3>
                    <h5 class="text-center mt-3">See All Users <i class="fas text-center fa-arrow-alt-circle-right ms-1" style="font-size:18px"></i></span></h5>
                </div>
            </a>
        </div>

        

        



    </div>
</div>
