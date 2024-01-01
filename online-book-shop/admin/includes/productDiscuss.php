<a href="/" class="btn btn-success w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="author text-white">View All Discussions About Products</span> </a>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnewpdiscuss">
  ADD NEW PRODUCT DISCUSS
</button>


<!-- Modal -->
<div class="modal fade" id="addnewpdiscuss" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW PRODUCT DISCUSS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="pdiscussAddForm">
            <div class="row">

                <div class="col-lg-6">
                    <div class="mb-3 mt-4">
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
                        <label for="pdiscuss_name" class="form-label">Product Discuss Title</label>
                        <input type="text" class="form-control" id="pdiscuss_name" name="pdiscuss_name" >
                    </div>
                </div>
               
               
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="pdiscuss_desc" class="form-label">Product Discuss Description</label>
                        <textarea type="text" class="form-control" id="pdiscuss_desc" name="pdiscuss_desc" rows="3" ></textarea>
                    </div>
                </div>
               

                <div class="col-lg-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100" id="pdiscussAddBtn">Submit</button>
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
            <li class="breadcrumb-item active" aria-current="page"> <span class="smallLinkTitle f-w5 text-success">View Product Discuss</span></li>
        </ol>
    </nav>
    <div class="card p-0 table-responsive"id="viewpdiscussData">
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
<div class="modal fade" id="editpdiscuss" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPDATE PRODUCT DISCUSS DETAILS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="pdiscussUpdateForm">
            <div class="row">

                <div class="col-lg-6">
                    <div class="mb-3 mt-4">
                    <select class="form-select" aria-label="Default select example" id="eproduct_id" name="eproduct_id">
                        <option selected>Select Any Product</option>
                        <?php 
                            $productsName = getAllProducts();
                            foreach($productsName as $productName){
                                
                        ?> 
                            <option value="<?= $productName['prod_id']?>"><?= $productName['prod_name']?></option>
                        <?php } ?>
                    </select>
                    <p class="text-success fw-bolder my-1" id="showSelected">Hello</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="epdiscuss_name" class="form-label">Product Discuss Title</label>
                        <input type="text" class="form-control" id="epdiscuss_name" name="epdiscuss_name" >
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="epdiscuss_desc" class="form-label">Product Discuss Description</label>
                        <textarea type="text" class="form-control" id="epdiscuss_desc" name="epdiscuss_desc" rows="3" ></textarea>
                    </div>
                </div>


                <div class="col-lg-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100" id="pdiscussUpdateBtn">Submit</button>
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
<script type="text/javascript" src="includes/addingProductDiscuss.js" > </script>



