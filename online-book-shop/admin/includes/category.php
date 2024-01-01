<a href="/" class="btn btn-danger w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="author text-white">View All Categories</span> </a>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnewcategory">
  ADD NEW CATEGORY
</button>


<!-- Modal -->
<div class="modal fade" id="addnewcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW CATEGORY</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="catAddForm">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="cat_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="cat_name" name="cat_name" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="cat_slug" class="form-label">Category Slug</label>
                        <input type="text" class="form-control" id="cat_slug" name="cat_slug" >
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="cat_desc" class="form-label">Category Description</label>
                        <textarea type="text" class="form-control" id="cat_desc" name="cat_desc" rows="3" ></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="cat_image" class="form-label">Choose Image</label>
                        <input class="form-control form-control-sm" id="cat_image" name="cat_image" type="file">
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100" id="catAddBtn">Submit</button>
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
            <li class="breadcrumb-item active" aria-current="page"> <span class="smallLinkTitle f-w5 text-success">View Categories</span></li>
        </ol>
    </nav>
    <div class="card p-0 table-responsive"id="viewCatData">
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
<div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPDATE CATEGORY DETAILS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="catUpdateForm">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="ecat_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="ecat_name" name="ecat_name" value="hero">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="ecat_slug" class="form-label">Category Slug</label>
                        <input type="text" class="form-control" id="ecat_slug" name="ecat_slug" >
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="ecat_desc" class="form-label">Category Description</label>
                        <textarea type="text" class="form-control" id="ecat_desc" name="ecat_desc" rows="3" ></textarea>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label for="ecat_image" class="form-label">Choose Image</label>
                        <input class="form-control form-control-sm" id="ecat_image" name="ecat_image" type="file">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <img src="" id="imgsrc" alt="" width="100px" height="100px">
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100" id="catUpdateBtn">Update</button>
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
<script type="text/javascript" src="includes/addingCategory.js" > </script>



