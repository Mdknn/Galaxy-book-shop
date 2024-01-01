<?php
include('function/fetchFunction.php');
?>
<a href="/" class="btn btn-danger w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="author text-white">View All Products</span> </a>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnewproduct">
  ADD NEW PRODUCT
</button>


<!-- Modal -->
<div class="modal fade" id="addnewproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW PRODUCT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="productAddForm">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="product_slug" class="form-label">Product Slug</label>
                        <input type="text" class="form-control" id="product_slug" name="product_slug" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" id="cat_id" name="cat_id">
                        <option selected value=0>Select Any Category</option>
                        <?php 
                            $categoriesName = getAllCategories();
                            foreach($categoriesName as $categoryName){
                                
                        ?> 
                            <option value="<?= $categoryName['cat_id']?>"><?= $categoryName['cat_name']?></option>
                        <?php } ?>
                       
                    </select>
                    </div>
                </div>
                <div class="col-6" id="pcatName">
                    <span class="text-primary fw-bolder">Please Select Any Category...</span>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" id="author_id" name="author_id">
                        <option selected value=0>Select Any Author</option>
                        <?php  
                            $authorsName = getAllAuthors();
                            foreach($authorsName as $authorName){
                                
                        ?> 
                            <option value="<?= $authorName['author_id']?>"><?= $authorName['author_name']?></option>
                        <?php } ?>
                       
                    </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" id="pub_id" name="pub_id">
                        <option selected value=0>Select Any Publisher</option>
                        <?php  
                            $publishersName = getAllPublishers();
                            foreach($publishersName as $publisherName){
                                
                        ?> 
                            <option value="<?= $publisherName['pub_id']?>"><?= $publisherName['pub_name']?></option>
                        <?php } ?>
                       
                    </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" id="desc_id" name="desc_id">
                        <option selected value=0>Select Description Name</option>
                        <?php  
                            $descsName = getAllProductDescription();
                            foreach($descsName as $descName){
                                
                        ?> 
                            <option value="<?= $descName['desc_id']?>"><?= $descName['desc_name']?></option>
                        <?php } ?>
                       
                    </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="product_mrp" class="form-label">Product MRP</label>
                        <input type="number" class="form-control" id="product_mrp" name="product_mrp" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="product_price" class="form-label">Product Price</label>
                        <input type="number" class="form-control" id="product_price" name="product_price" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="product_discount" class="form-label">Product Discount</label>
                        <input type="number" class="form-control" id="product_discount" name="product_discount" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="product_subject" class="form-label">Product Subject</label>
                        <input type="text" class="form-control" id="product_subject" name="product_subject" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="product_stock" class="form-label">Product Stock</label>
                        <input type="number" class="form-control" id="product_stock" name="product_stock" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="product_lang" class="form-label">Product Language</label>
                        <input type="text" class="form-control" id="product_lang" name="product_lang" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="product_pages" class="form-label">Product Pages</label>
                        <input type="text" class="form-control" id="product_pages" name="product_pages" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="product_isbn" class="form-label">Product ISBN</label>
                        <input type="text" class="form-control" id="product_isbn" name="product_isbn" >
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="product_pubDate" class="form-label">Product Publication Date</label>
                        <input type="date" class="form-control" id="product_pubDate" name="product_pubDate" >
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="product_delType" class="form-label">Product Delivery Type</label>
                        <input type="text" class="form-control" id="product_delType" name="product_delType" >
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="product_age" class="form-label">Product Select Age</label>
                        <input type="text" class="form-control" id="product_age" name="product_age" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="product_features" class="form-label">Product Features</label>
                        <textarea type="text" class="form-control" id="product_features" name="product_features" rows="4" ></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="product_keywords" class="form-label">Product Keywords</label>
                        <textarea type="text" class="form-control" id="product_keywords" name="product_keywords" rows="4" ></textarea>
                    </div>
                </div>
                <div class="col-lg-4">
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" name="product_istrending" value="1" id="product_istrending" aria-label="...">
                        Is Trending Product
                    </li>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label for="product_image" class="form-label">Choose One Product Image</label>
                        <input class="form-control form-control-sm" id="product_image" name="product_image" type="file">
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100" id="productAddBtn">Submit</button>
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
            <li class="breadcrumb-item active" aria-current="page"> <span class="smallLinkTitle f-w5 text-success">View Products</span></li>
        </ol>
    </nav>
    <div class="card p-0 table-responsive"id="viewProductData">
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
<div class="modal fade" id="editproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPDATE PRODUCT DETAILS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="productUpdateForm">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="eproduct_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="eproduct_name" name="eproduct_name" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="eproduct_slug" class="form-label">Product Slug</label>
                        <input type="text" class="form-control" id="eproduct_slug" name="eproduct_slug" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" id="ecat_id" name="ecat_id">
                        <option selected value=0>Select Any Category</option>
                        <?php 
                            $categoriesName = getAllCategories();
                            foreach($categoriesName as $categoryName){
                                
                        ?> 
                            <option value="<?= $categoryName['cat_id']?>"><?= $categoryName['cat_name']?></option>
                        <?php } ?>
                       
                    </select>
                    <div class="mt-1 text-success fw-bolder text-center" id="showCategory">Hello</div>
                    </div>
                </div>
                <div class="col-lg-4" id="epcatName">
                    <span class="text-primary fw-bolder">Please Select Any Category...</span>
                </div>
                <div class=" col-lg-2 mt-1 text-success fw-bolder text-center" id="showPcat">Hello</div>
                <div class="col-lg-6">
                    <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" id="eauthor_id" name="eauthor_id">
                        <option selected value=0>Select Any Author</option>
                        <?php  
                            $authorsName = getAllAuthors();
                            foreach($authorsName as $authorName){
                                
                        ?> 
                            <option value="<?= $authorName['author_id']?>"><?= $authorName['author_name']?></option>
                        <?php } ?>
                       
                    </select>
                    <p class="mt-1 text-success fw-bolder text-center" id="showAuthor">Hello</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" id="epub_id" name="epub_id">
                        <option selected value=0>Select Any Publisher</option>
                        <?php  
                            $publishersName = getAllPublishers();
                            foreach($publishersName as $publisherName){
                                
                        ?> 
                            <option value="<?= $publisherName['pub_id']?>"><?= $publisherName['pub_name']?></option>
                        <?php } ?>
                       
                    </select>
                    <p class="mt-1 text-success fw-bolder text-center" id="showPublisher">Hello</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" id="edesc_id" name="edesc_id">
                        <option selected value=0>Select Description Name</option>
                        <?php  
                            $descsName = getAllProductDescription();
                            foreach($descsName as $descName){
                                
                        ?> 
                            <option value="<?= $descName['desc_id']?>"><?= $descName['desc_name']?></option>
                        <?php } ?>
                       
                    </select>
                    <p class="mt-1 text-success fw-bolder text-center" id="showDescription">Hello</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="eproduct_mrp" class="form-label">Product MRP</label>
                        <input type="number" class="form-control" id="eproduct_mrp" name="eproduct_mrp" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="eproduct_price" class="form-label">Product Price</label>
                        <input type="number" class="form-control" id="eproduct_price" name="eproduct_price" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="eproduct_discount" class="form-label">Product Discount</label>
                        <input type="number" class="form-control" id="eproduct_discount" name="eproduct_discount" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="eproduct_subject" class="form-label">Product Subject</label>
                        <input type="text" class="form-control" id="eproduct_subject" name="eproduct_subject" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="eproduct_stock" class="form-label">Product Stock</label>
                        <input type="number" class="form-control" id="eproduct_stock" name="eproduct_stock" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="eproduct_lang" class="form-label">Product Language</label>
                        <input type="text" class="form-control" id="eproduct_lang" name="eproduct_lang" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="eproduct_pages" class="form-label">Product Pages</label>
                        <input type="text" class="form-control" id="eproduct_pages" name="eproduct_pages" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="eproduct_isbn" class="form-label">Product ISBN</label>
                        <input type="text" class="form-control" id="eproduct_isbn" name="eproduct_isbn" >
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="eproduct_pubDate" class="form-label">Product Publication Date</label>
                        <input type="date" class="form-control" id="eproduct_pubDate" name="eproduct_pubDate" >
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="eproduct_delType" class="form-label">Product Delivery Type</label>
                        <input type="text" class="form-control" id="eproduct_delType" name="eproduct_delType" >
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="eproduct_age" class="form-label">Product Select Age</label>
                        <input type="text" class="form-control" id="eproduct_age" name="eproduct_age" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="eproduct_features" class="form-label">Product Features</label>
                        <textarea type="text" class="form-control" id="eproduct_features" name="eproduct_features" rows="4" ></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="eproduct_keywords" class="form-label">Product Keywords</label>
                        <textarea type="text" class="form-control" id="eproduct_keywords" name="eproduct_keywords" rows="4" ></textarea>
                    </div>
                </div>
                <div class="col-lg-4">
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" name="eproduct_istrending" value="1" id="eproduct_istrending" aria-label="...">
                        Is Trending Product
                    </li>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="eproduct_image" class="form-label">Choose One Product Image</label>
                        <input class="form-control form-control-sm" id="eproduct_image" name="eproduct_image" type="file">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <img src="" id="imgsrc" alt="" width="100px" height="100px">
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100" id="productUpdateBtn">Submit</button>
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
<script type="text/javascript" src="includes/addingProduct.js" > </script>



