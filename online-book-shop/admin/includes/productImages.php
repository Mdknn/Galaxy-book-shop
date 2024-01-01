<a href="/" class="btn btn-warning w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="author text-dark">View All Product Images</span> </a>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnewpimages">
  ADD NEW PRODUCT IMAGES
</button>


<!-- Modal -->
<div class="modal fade" id="addnewpimages" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW PRODUCT IMAGES</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="pimagesAddForm">
            <div class="row">

                <div class="col-lg-6">
                    <div class="mb-3 ">
                    <label for="product_id" class="form-label">Select Product Name</label>
                    <select class="form-select" aria-label="Default select example" id="product_id" name="product_id">
                        <option selected>Select Any Product</option>
                        <?php include('function/fetchFunction.php'); 
                            $productsName = getAllProducts();
                            foreach($productsName as $productName){
                                
                        ?> 
                            <option value="<?= $productName['prod_id']?>"><?= $productName['prod_name']?></option>
                        <?php } ?>
                       
                    </select>
                    </div>
                </div>
                <div class="col-lg-6">
                <div class="mb-3">
                        <label for="pimages" class="form-label">Choose Image</label>
                        <input class="form-control form-control-sm" id="pimages" name="pimages[]" multiple type="file">
                    </div>
                </div>
               

                <div class="col-lg-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100" id="pimagesAddBtn">Submit</button>
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



<div class="row">

    <div class="col-lg-12 mt-4">

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb ms-2">
            <li class="breadcrumb-item"><a href="#" class="smallLinkTitle f-w5">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> <span class="smallLinkTitle f-w5 text-success">View Product Images</span></li>
        </ol>
    </nav>
    <div class="card p-0 table-responsive"id="viewpimagesData">
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




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="includes/addingProductImages.js" > </script>



