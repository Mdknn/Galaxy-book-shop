<a href="/" class="btn btn-success w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="author text-white">View All Authors</span> </a>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnewauthor">
  ADD NEW AUTHOR
</button>


<!-- Modal -->
<div class="modal fade" id="addnewauthor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW AUTHOR</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="authorAddForm">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="author_name" class="form-label">Author Name</label>
                        <input type="text" class="form-control" id="author_name" name="author_name" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="author_slug" class="form-label">Author Slug</label>
                        <input type="text" class="form-control" id="author_slug" name="author_slug" >
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="author_desc" class="form-label">Author Description</label>
                        <textarea type="text" class="form-control" id="author_desc" name="author_desc" rows="3" ></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="author_image" class="form-label">Author Image</label>
                        <input class="form-control form-control-sm" id="author_image" name="author_image" type="file">
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100" id="authorAddBtn">Submit</button>
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
            <li class="breadcrumb-item active" aria-current="page"> <span class="smallLinkTitle f-w5 text-success">View All Authors</span></li>
        </ol>
    </nav>
    <div class="card p-0 table-responsive"id="viewAuthorData">
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
        <h5 class="modal-title" id="exampleModalLabel">UPDATE Author DETAILS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="authorUpdateForm">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="eauthor_name" class="form-label">Author Name</label>
                        <input type="text" class="form-control" id="eauthor_name" name="eauthor_name" value="hero">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="eauthor_slug" class="form-label">Author Slug</label>
                        <input type="text" class="form-control" id="eauthor_slug" name="eauthor_slug" >
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="eauthor_desc" class="form-label">Author Description</label>
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
<script type="text/javascript" src="includes/addingAuthor.js" > </script>

