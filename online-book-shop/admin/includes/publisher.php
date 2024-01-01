<a href="/" class="btn btn-danger w-100 fs-2 mt-2 mb-2 fw-bolder ftext" id="oneLineTitle"> <span class="pub text-white">View All Publishers</span> </a>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnewpub">
  ADD NEW PUBLISHER
</button>


<!-- Modal -->
<div class="modal fade" id="addnewpub" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW PUBLISHER</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="pubAddForm">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="pub_name" class="form-label">Publisher Name</label>
                        <input type="text" class="form-control" id="pub_name" name="pub_name" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="pub_slug" class="form-label">Publisher Slug</label>
                        <input type="text" class="form-control" id="pub_slug" name="pub_slug" >
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="pub_desc" class="form-label">Publisher Description</label>
                        <textarea type="text" class="form-control" id="pub_desc" name="pub_desc" rows="3" ></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="pub_image" class="form-label">Choose Image</label>
                        <input class="form-control form-control-sm" id="pub_image" name="pub_image" type="file">
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100" id="pubAddBtn">Submit</button>
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
            <li class="breadcrumb-item active" aria-current="page"> <span class="smallLinkTitle f-w5 text-success">View All Publishers</span></li>
        </ol>
    </nav>
    <div class="card p-0 table-responsive"id="viewpubData">
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
<div class="modal fade" id="editpub" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPDATE PUBLISHER DETAILS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="pubUpdateForm">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="epub_name" class="form-label">Publisher Name</label>
                        <input type="text" class="form-control" id="epub_name" name="epub_name" value="hero">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="epub_slug" class="form-label">Publisher Slug</label>
                        <input type="text" class="form-control" id="epub_slug" name="epub_slug" >
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="epub_desc" class="form-label">Publisher Description</label>
                        <textarea type="text" class="form-control" id="epub_desc" name="epub_desc" rows="3" ></textarea>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label for="epub_image" class="form-label">Choose Image</label>
                        <input class="form-control form-control-sm" id="epub_image" name="epub_image" type="file">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <img src="" id="imgsrc" alt="" width="100px" height="100px">
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100" id="pubUpdateBtn">Update</button>
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
<script type="text/javascript" src="includes/addingPublisher.js" > </script>

