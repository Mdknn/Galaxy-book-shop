<?php
include('function.php');


// Process Of Categories Start From Here

// This Code is For Adding New Category
if(isset($_POST['cat_add'])){

    //print_r($_REQUEST);
    //print_r($_POST);
    // print_r($_FILES);
    // die();

    $catName = get_safe($_POST['cat_name']);
    $catSlug = get_safe($_POST['cat_slug']);
    $catDesc = get_safe($_POST['cat_desc']);
    $imageName = $_FILES['cat_image']['name'];

    $finalImageName = time().$imageName;

    $imageTempName = $_FILES['cat_image']['tmp_name'];

    move_uploaded_file($imageTempName,"../Images/CategoryImages/".$finalImageName);
    

    $sql = "INSERT INTO `categories`(`cat_name`, `cat_slug`, `cat_pic`, `cat_desc`) VALUES ('$catName','$catSlug','$finalImageName','$catDesc')";

    $runQuery = mysqli_query($conn , $sql);

    if($runQuery){
        echo "Adding Successfull";
    }else{
        echo "Adding Failed";
    }

}


// This Code is for Viewing All Datas of Category with Pagination
if(isset($_POST['view_cat'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM categories ORDER BY cat_id DESC LIMIT {$offset},{$limit_per_page}";
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    // print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '<table class="table table-borderless table-hover">
        <thead>
            <tr class="text-center">
                <th >S No.</th>
                <th>Category Name</th>
                <th >Category Slug</th>
                <th width="10%">Cat Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td>{$row['cat_name']}</td>
            <td>{$row['cat_slug']}</td>
            <td><img src='../admin/Images/CategoryImages/{$row['cat_pic']}' width='70%' ></td>
            <td >";

            $name="";
            $color="";
            if($row['cat_status'] == 0){
                   $name = "Active"; 
                   $color="btn-success";
            }else{
                $name="Deactivate"; 
                $color="btn-danger";
            }

            $output .= "<a data-status='{$row['cat_id']}@{$row['cat_status']}@{$page}' class='btn {$color} btn-sm' id='statusCheck'>
                            {$name}
                        </a>
                        <a class='btn btn-primary btn-sm' data-edit='{$row['cat_id']}@{$row['cat_status']}@{$page}' id='editCat'>
                            Edit
                        </a>
                        <a class='btn btn-primary btn-sm' data-delete='{$row['cat_id']}@{$row['cat_status']}@{$page}' id='delCat'>
                            Delete
                        </a>
                    </td></tr>";
            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM categories ORDER BY cat_id DESC";
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}




// This Code is for Updating Status of Selected Category
if(isset($_POST['cat_status_change'])){
    // print_r($_POST);

    $cat_id=get_safe($_POST['cat_id']);
    $cat_status=get_safe($_POST['cat_status']);

    if($cat_status == 0){
        $cat_status = 1;
    }else{
        $cat_status = 0 ;
    }

    $sql = "UPDATE `categories` SET `cat_status`=$cat_status WHERE cat_id=$cat_id";


    if(mysqli_query($conn , $sql)){
        echo "Status Updated Successfully";
    }else{
        "Status Updatation Failed!!";
    }



}


// This Code is for Showing Data in Update Modal
if(isset($_POST['edit_cat'])){
    // print_r($_POST);

    $cat_id=get_safe($_POST['cat_id']);
    $cat_status=get_safe($_POST['cat_status']);

    $result_array=[];

    $sql = "select * from categories WHERE cat_id=$cat_id";

    $runQuery = mysqli_query($conn,$sql);


    if(mysqli_num_rows($runQuery)){
        $row= mysqli_fetch_assoc($runQuery);
        array_push($result_array,$row);
        echo json_encode($result_array);
    }else{
        echo "Data Not Found!!";
    }

}


// This Code is for Updating Category Data
if(isset($_POST['cat_update'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $catName = get_safe($_POST['ecat_name']);
    $catSlug = get_safe($_POST['ecat_slug']);
    $catDesc = get_safe($_POST['ecat_desc']);
    $cat_id = get_safe($_POST['cat_id']);
    //$imageName = $_FILES['ecat_image']['name'];

    //$imageTempName = $_FILES['ecat_image']['tmp_name'];

    //move_uploaded_file($imageTempName,"../Images/CategoryImages/".$imageName);
    

    $sql = "UPDATE `categories` SET `cat_name`='$catName',`cat_slug`='$catSlug',`cat_desc`='$catDesc' WHERE cat_id=$cat_id";

    $runQuery = mysqli_query($conn , $sql);

    //echo $sql;

    if($runQuery){
        echo "Updating Successfull";
    }else{
        echo "Updating Failed";
    }

}


// This Code is For Deleting Category with CategoryImage
if(isset($_POST['del_cat'])){
    // print_r($_POST);

    $cat_id=get_safe($_POST['cat_id']);
    $cat_status=get_safe($_POST['cat_status']);

    $sql_image = "select * from `categories` where cat_id=$cat_id";
    $runQuery_image = mysqli_query($conn,$sql_image);
    $row_image = mysqli_fetch_assoc($runQuery_image);

    // For deleting Image from Folder
     unlink("../Images/CategoryImages/".$row_image['cat_pic']);
     
    // print_r("Images/CategoryImages/".$row_image['cat_pic']);


    $sql = "DELETE FROM `categories` WHERE cat_id=$cat_id";


    if(mysqli_query($conn , $sql)){
        echo "Delete Successfull";
    }else{
        "Deletion Failed!!";
    }



}

// Process Of Category End Here







// Process Of Authors Start From Here


// This Code is For Adding New Authors
if(isset($_POST['author_add'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $authorName = get_safe($_POST['author_name']);
    $authorSlug = get_safe($_POST['author_slug']);
    $authorDesc = get_safe($_POST['author_desc']);
    $imageName = $_FILES['author_image']['name'];

    $finalImageName = time().$imageName;

    $imageTempName = $_FILES['author_image']['tmp_name'];

    move_uploaded_file($imageTempName,"../Images/AuthorImages/".$finalImageName);
    

    $sql = "INSERT INTO `authors`(`author_name`, `author_slug`, `author_pic`, `author_desc`) VALUES ('$authorName','$authorSlug','$finalImageName','$authorDesc')";

    $runQuery = mysqli_query($conn , $sql);

    if($runQuery){
        echo "Adding Successfull";
    }else{
        echo "Adding Failed";
    }

}


// This Code is for Viewing All Datas of Authors with Pagination
if(isset($_POST['view_author'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM authors ORDER BY author_id DESC LIMIT {$offset},{$limit_per_page}";
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    // print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '<table class="table table-borderless table-hover">
        <thead>
            <tr class="text-center">
                <th >S No.</th>
                <th>Author Name</th>
                <th >Author Slug</th>
                <th width="10%">Author Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td>{$row['author_name']}</td>
            <td>{$row['author_slug']}</td>
            <td><img src='../admin/Images/AuthorImages/{$row['author_pic']}' width='70%' ></td>
            <td >";

            $name="";
            $color="";
            if($row['author_status'] == 0){
                   $name = "Active"; 
                   $color="btn-success";
            }else{
                $name="Deactivate"; 
                $color="btn-danger";
            }

            $output .= "<a data-status='{$row['author_id']}@{$row['author_status']}@{$page}' class='btn {$color} btn-sm' id='statusCheck'>
                            {$name}
                        </a>
                        <a class='btn btn-primary btn-sm' data-edit='{$row['author_id']}@{$row['author_status']}@{$page}' id='editAuthor'>
                            Edit
                        </a>
                        <a class='btn btn-primary btn-sm' data-delete='{$row['author_id']}@{$row['author_status']}@{$page}' id='delAuthor'>
                            Delete
                        </a>
                    </td></tr>";
            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM authors ORDER BY author_id DESC";
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}




// This Code is for Updating Status of Selected Authors
if(isset($_POST['author_status_change'])){
    // print_r($_POST);

    $author_id=get_safe($_POST['author_id']);
    $author_status=get_safe($_POST['author_status']);

    if($author_status == 0){
        $author_status = 1;
    }else{
        $author_status = 0 ;
    }

    $sql = "UPDATE `authors` SET `author_status`=$author_status WHERE author_id=$author_id";


    if(mysqli_query($conn , $sql)){
        echo "Status Updated Successfully";
    }else{
        "Status Updatation Failed!!";
    }



}


// This Code is for Showing Data in Update Modal Of Authors
if(isset($_POST['edit_author'])){
    // print_r($_POST);

    $author_id=get_safe($_POST['author_id']);
    $author_status=get_safe($_POST['author_status']);

    $result_array=[];

    $sql = "select * from authors WHERE author_id=$author_id";

    $runQuery = mysqli_query($conn,$sql);


    if(mysqli_num_rows($runQuery)){
        $row= mysqli_fetch_assoc($runQuery);
        array_push($result_array,$row);
        echo json_encode($result_array);
    }else{
        echo "Data Not Found!!";
    }

}


// This Code is for Updating Authors Data
if(isset($_POST['author_update'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $authorName = get_safe($_POST['eauthor_name']);
    $authorSlug = get_safe($_POST['eauthor_slug']);
    $authorDesc = get_safe($_POST['eauthor_desc']);
    $author_id = get_safe($_POST['author_id']);
    //$imageName = $_FILES['eauthor_image']['name'];

    //$imageTempName = $_FILES['eauthor_image']['tmp_name'];

    //move_uploaded_file($imageTempName,"../Images/authoregoryImages/".$imageName);
    

    $sql = "UPDATE `authors` SET `author_name`='$authorName',`author_slug`='$authorSlug',`author_desc`='$authorDesc' WHERE author_id=$author_id";

    $runQuery = mysqli_query($conn , $sql);

    //echo $sql;

    if($runQuery){
        echo "Updating Successfull";
    }else{
        echo "Updating Failed";
    }

}


// This Code is For Deleting Authors with AuthorImage
if(isset($_POST['del_author'])){
    // print_r($_POST);

    $author_id=get_safe($_POST['author_id']);
    $author_status=get_safe($_POST['author_status']);

    $sql_image = "select * from `authors` where author_id=$author_id";
    $runQuery_image = mysqli_query($conn,$sql_image);
    $row_image = mysqli_fetch_assoc($runQuery_image);

    // For deleting Image from Folder
     unlink("../Images/AuthorImages/".$row_image['author_pic']);
     
    // print_r("Images/authoregoryImages/".$row_image['author_pic']);


    $sql = "DELETE FROM `authors` WHERE author_id=$author_id";


    if(mysqli_query($conn , $sql)){
        echo "Delete Successfull";
    }else{
        "Deletion Failed!!";
    }



}


// Process Of Authors End Here









// Process Of Publishers Start From Here


// This Code is For Adding New Publishers
if(isset($_POST['pub_add'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $pubName = get_safe($_POST['pub_name']);
    $publisherslug = get_safe($_POST['pub_slug']);
    $pubDesc = get_safe($_POST['pub_desc']);
    $imageName = $_FILES['pub_image']['name'];

    $finalImageName = time().$imageName;

    $imageTempName = $_FILES['pub_image']['tmp_name'];

    move_uploaded_file($imageTempName,"../Images/PublisherImages/".$finalImageName);
    

    $sql = "INSERT INTO `publishers`(`pub_name`, `pub_slug`, `pub_pic`, `pub_desc`) VALUES ('$pubName','$publisherslug','$finalImageName','$pubDesc')";

    $runQuery = mysqli_query($conn , $sql);

    if($runQuery){
        echo "Adding Successfull";
    }else{
        echo "Adding Failed";
    }

}


// This Code is for Viewing All Datas of Publishers with Pagination
if(isset($_POST['view_pub'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM publishers ORDER BY pub_id DESC LIMIT {$offset},{$limit_per_page}";
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    // print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '<table class="table table-borderless table-hover">
        <thead>
            <tr class="text-center">
                <th >S No.</th>
                <th>Publisher Name</th>
                <th >Publisher Slug</th>
                <th width="10%">Publisher Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td>{$row['pub_name']}</td>
            <td>{$row['pub_slug']}</td>
            <td><img src='../admin/Images/PublisherImages/{$row['pub_pic']}' width='70%' ></td>
            <td >";

            $name="";
            $color="";
            if($row['pub_status'] == 0){
                   $name = "Active"; 
                   $color="btn-success";
            }else{
                $name="Deactivate"; 
                $color="btn-danger";
            }

            $output .= "<a data-status='{$row['pub_id']}@{$row['pub_status']}@{$page}' class='btn {$color} btn-sm' id='statusCheck'>
                            {$name}
                        </a>
                        <a class='btn btn-primary btn-sm' data-edit='{$row['pub_id']}@{$row['pub_status']}@{$page}' id='editPub'>
                            Edit
                        </a>
                        <a class='btn btn-primary btn-sm' data-delete='{$row['pub_id']}@{$row['pub_status']}@{$page}' id='delPub'>
                            Delete
                        </a>
                    </td></tr>";
            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM publishers ORDER BY pub_id DESC";
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}




// This Code is for Updating Status of Selected Publishers
if(isset($_POST['pub_status_change'])){
    // print_r($_POST);

    $pub_id=get_safe($_POST['pub_id']);
    $pub_status=get_safe($_POST['pub_status']);

    if($pub_status == 0){
        $pub_status = 1;
    }else{
        $pub_status = 0 ;
    }

    $sql = "UPDATE `publishers` SET `pub_status`=$pub_status WHERE pub_id=$pub_id";


    if(mysqli_query($conn , $sql)){
        echo "Status Updated Successfully";
    }else{
        "Status Updatation Failed!!";
    }



}


// This Code is for Showing Data in Update Modal Of Publisher
if(isset($_POST['edit_pub'])){
    // print_r($_POST);

    $pub_id=get_safe($_POST['pub_id']);
    $pub_status=get_safe($_POST['pub_status']);

    $result_array=[];

    $sql = "select * from publishers WHERE pub_id=$pub_id";

    $runQuery = mysqli_query($conn,$sql);


    if(mysqli_num_rows($runQuery)){
        $row= mysqli_fetch_assoc($runQuery);
        array_push($result_array,$row);
        echo json_encode($result_array);
    }else{
        echo "Data Not Found!!";
    }

}


// This Code is for Updating Publishers Data
if(isset($_POST['pub_update'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $pubName = get_safe($_POST['epub_name']);
    $publisherslug = get_safe($_POST['epub_slug']);
    $pubDesc = get_safe($_POST['epub_desc']);
    $pub_id = get_safe($_POST['pub_id']);
    //$imageName = $_FILES['epub_image']['name'];

    //$imageTempName = $_FILES['epub_image']['tmp_name'];

    //move_uploaded_file($imageTempName,"../Images/PublisherImages/".$imageName);
    

    $sql = "UPDATE `publishers` SET `pub_name`='$pubName',`pub_slug`='$publisherslug',`pub_desc`='$pubDesc' WHERE pub_id=$pub_id";

    $runQuery = mysqli_query($conn , $sql);

    //echo $sql;

    if($runQuery){
        echo "Updating Successfull";
    }else{
        echo "Updating Failed";
    }

}


// This Code is For Deleting Publishers with PublisherImage
if(isset($_POST['del_pub'])){
    // print_r($_POST);

    $pub_id=get_safe($_POST['pub_id']);
    $pub_status=get_safe($_POST['pub_status']);

    $sql_image = "select * from `publishers` where pub_id=$pub_id";
    $runQuery_image = mysqli_query($conn,$sql_image);
    $row_image = mysqli_fetch_assoc($runQuery_image);

    // For deleting Image from Folder
     unlink("../Images/PublisherImages/".$row_image['pub_pic']);
     
    // print_r("Images/pubegoryImages/".$row_image['pub_pic']);


    $sql = "DELETE FROM `publishers` WHERE pub_id=$pub_id";


    if(mysqli_query($conn , $sql)){
        echo "Delete Successfull";
    }else{
        "Deletion Failed!!";
    }



}


// Process Of Publishers End Here









  // Process Of Product Categories Start From Here

// This Code is For Adding New Product Category
if(isset($_POST['pcat_add'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $pcatName = get_safe($_POST['pcat_name']);
    $pcatSlug = get_safe($_POST['pcat_slug']);
    $pcatDesc = get_safe($_POST['pcat_desc']);
    $catID = get_safe($_POST['cat_id']);
    $imageName = $_FILES['pcat_image']['name'];

    $finalImageName = time().$imageName;

    $imageTempName = $_FILES['pcat_image']['tmp_name'];

    move_uploaded_file($imageTempName,"../Images/ProdCategoryImages/".$finalImageName);
    

    $sql = "INSERT INTO `product_categories`(`cat_id`,`pcat_name`, `pcat_slug`, `pcat_pic`, `pcat_desc`) VALUES ($catID,'$pcatName','$pcatSlug','$finalImageName','$pcatDesc')";

    $runQuery = mysqli_query($conn , $sql);

    if($runQuery){
        echo "Adding Successfull";
    }else{
        echo "Adding Failed";
    }

}


// This Code is for Viewing All Datas of Product Category with Pagination
if(isset($_POST['view_pcat'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM product_categories ORDER BY pcat_id DESC LIMIT {$offset},{$limit_per_page}";
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    // print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '<table class="table table-borderless table-hover">
        <thead>
            <tr class="text-center">
                <th >S No.</th>
                <th>Product Category Name</th>
                <th>Category Name</th>
                <th >Product Category Slug</th>
                <th width="10%">Product Category Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td>{$row['pcat_name']}</td>
            <td>".getCategoryName($row['cat_id'])."</td>
            <td>{$row['pcat_slug']}</td>
            <td><img src='../admin/Images/ProdCategoryImages/{$row['pcat_pic']}' width='70%' ></td>
            <td >";

            $name="";
            $color="";
            if($row['pcat_status'] == 0){
                   $name = "Active"; 
                   $color="btn-success";
            }else{
                $name="Deactivate"; 
                $color="btn-danger";
            }

            $output .= "<a data-status='{$row['pcat_id']}@{$row['pcat_status']}@{$page}' class='btn {$color} btn-sm' id='statusCheck'>
                            {$name}
                        </a>
                        <a class='btn btn-primary btn-sm' data-edit='{$row['pcat_id']}@{$row['pcat_status']}@{$page}' id='editpcat'>
                            Edit
                        </a>
                        <a class='btn btn-primary btn-sm' data-delete='{$row['pcat_id']}@{$row['pcat_status']}@{$page}' id='delpcat'>
                            Delete
                        </a>
                    </td></tr>";
            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM product_categories ORDER BY pcat_id DESC";
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}




// This Code is for Updating Status of Selected Product Category
if(isset($_POST['pcat_status_change'])){
    // print_r($_POST);

    $pcat_id=get_safe($_POST['pcat_id']);
    $pcat_status=get_safe($_POST['pcat_status']);

    if($pcat_status == 0){
        $pcat_status = 1;
    }else{
        $pcat_status = 0 ;
    }

    $sql = "UPDATE `product_categories` SET `pcat_status`=$pcat_status WHERE pcat_id=$pcat_id";


    if(mysqli_query($conn , $sql)){
        echo "Status Updated Successfully";
    }else{
        "Status Updatation Failed!!";
    }



}


// This Code is for Showing Data in Update Modal Of Product Categories
if(isset($_POST['edit_pcat'])){
    // print_r($_POST);

    $pcat_id=get_safe($_POST['pcat_id']);
    $pcat_status=get_safe($_POST['pcat_status']);

    $result_array=[];

    $sql = "select * from product_categories WHERE pcat_id=$pcat_id";

    $runQuery = mysqli_query($conn,$sql);


    if(mysqli_num_rows($runQuery)){
        $row= mysqli_fetch_assoc($runQuery);
        $cat_name=getCategoryName($row['cat_id']);
        
        array_push($result_array,$row);
        array_push($result_array,$cat_name);
        //print_r($result_array);
        echo json_encode($result_array);
    }else{
        echo "Data Not Found!!";
    }

}


// This Code is for Updating Product Category Data
if(isset($_POST['pcat_update'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $pcatName = get_safe($_POST['epcat_name']);
    $pcatSlug = get_safe($_POST['epcat_slug']);
    $pcatDesc = get_safe($_POST['epcat_desc']);
    $cat_id = get_safe($_POST['ecat_id']);
    $pcat_id = get_safe($_POST['pcat_id']);
    //$imageName = $_FILES['epcat_image']['name'];

    //$imageTempName = $_FILES['epcat_image']['tmp_name'];

    //move_uploaded_file($imageTempName,"../Images/ProdCategoryImages/".$imageName);
    

    $sql = "UPDATE `product_categories` SET `cat_id`=$cat_id , `pcat_name`='$pcatName',`pcat_slug`='$pcatSlug',`pcat_desc`='$pcatDesc' WHERE pcat_id=$pcat_id";

    //print_r($sql);

    $runQuery = mysqli_query($conn , $sql);

    //print_r($runQuery);

    if($runQuery){
        echo "Updating Successfull";
    }else{
        echo "Updating Failed";
    }

}


// This Code is For Deleting Product Category with ProductCategoryImages
if(isset($_POST['del_pcat'])){
    // print_r($_POST);

    $pcat_id=get_safe($_POST['pcat_id']);
    $pcat_status=get_safe($_POST['pcat_status']);

    $sql_image = "select * from `product_categories` where pcat_id=$pcat_id";
    $runQuery_image = mysqli_query($conn,$sql_image);
    $row_image = mysqli_fetch_assoc($runQuery_image);

    // For deleting Image from Folder
     unlink("../Images/ProdCategoryImages/".$row_image['pcat_pic']);
     
    // print_r("Images/ProdCategoryImages/".$row_image['pcat_pic']);


    $sql = "DELETE FROM `product_categories` WHERE pcat_id=$pcat_id";


    if(mysqli_query($conn , $sql)){
        echo "Delete Successfull";
    }else{
        echo "Deletion Failed!!";
    }



}

// Process Of pcategory End Here









// Process Of Product Description Start From Here

// This Code is For Adding New Product Description
if(isset($_POST['prod_add'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    
    $prodDesc = get_safe($_POST['prod_desc']);
    $descName = get_safe($_POST['desc_name']);


    $sql = "INSERT INTO `product_description`(`desc_name`, `prod_desc`) VALUES ('$descName','$prodDesc')";

    $runQuery = mysqli_query($conn , $sql);

    if($runQuery){
        echo "Adding Successfull";
    }else{
        echo "Adding Failed";
    }

}


// This Code is for Viewing All Datas of Product Description with Pagination
if(isset($_POST['view_prod'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM product_description ORDER BY desc_id DESC LIMIT {$offset},{$limit_per_page}";
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    // print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '<table class="table table-borderless table-hover">
        <thead>
            <tr class="text-center">
                <th >S No.</th>
                <th >Description Name</th>
                <th width="60%" >Product Description</th>
             
                <th>Action</th>
            </tr>
        </thead>
        <tbody >';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td>{$row['desc_name']}</td>
            <td>{$row['prod_desc']}</td>
            <td >";

            $name="";
            $color="";
            if($row['prod_status'] == 0){
                   $name = "Active"; 
                   $color="btn-success";
            }else{
                $name="Deactivate"; 
                $color="btn-danger";
            }

            $output .= "<a data-status='{$row['desc_id']}@{$row['prod_status']}@{$page}' class='btn {$color} btn-sm' id='statusCheck'>
                            {$name}
                        </a>
                        <a class='btn btn-primary btn-sm' data-edit='{$row['desc_id']}@{$row['prod_status']}@{$page}' id='editProd'>
                            Edit
                        </a>
                        <a class='btn btn-primary btn-sm' data-delete='{$row['desc_id']}@{$row['prod_status']}@{$page}' id='delprod'>
                            Delete
                        </a>
                    </td></tr>";
            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM product_description ORDER BY desc_id DESC";
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}




// This Code is for Updating Status of Selected Product Description
if(isset($_POST['prod_status_change'])){
    // print_r($_POST);

    $desc_id=get_safe($_POST['desc_id']);
    $prod_status=get_safe($_POST['prod_status']);

    if($prod_status == 0){
        $prod_status = 1;
    }else{
        $prod_status = 0 ;
    }

    $sql = "UPDATE `product_description` SET `prod_status`=$prod_status WHERE desc_id=$desc_id";


    if(mysqli_query($conn , $sql)){
        echo "Status Updated Successfully";
    }else{
        "Status Updatation Failed!!";
    }



}


// This Code is for Showing Data in Update Modal Of Product Description
if(isset($_POST['edit_prod'])){
    // print_r($_POST);

    $desc_id=get_safe($_POST['desc_id']);
    $prod_status=get_safe($_POST['prod_status']);

    $result_array=[];

    $sql = "select * from product_description WHERE desc_id=$desc_id";

    $runQuery = mysqli_query($conn,$sql);


    if(mysqli_num_rows($runQuery)){
        $row= mysqli_fetch_assoc($runQuery);
        array_push($result_array,$row);
        echo json_encode($result_array);
    }else{
        echo "Data Not Found!!";
    }

}


// This Code is for Updating Product Description Data
if(isset($_POST['prod_update'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    
    
    $prodDesc = get_safe($_POST['eprod_desc']);
    $desc_id = get_safe($_POST['desc_id']);
    $descName = get_safe($_POST['edesc_name']);
    

    $sql = "UPDATE `product_description` SET `desc_name`='$descName' , `prod_desc`='$prodDesc' WHERE desc_id=$desc_id";

    $runQuery = mysqli_query($conn , $sql);

    //echo $sql;

    if($runQuery){
        echo "Updating Successfull";
    }else{
        echo "Updating Failed";
    }

}


// This Code is For Deleting Product Description
if(isset($_POST['del_prod'])){
    // print_r($_POST);

    $desc_id=get_safe($_POST['desc_id']);
    $prod_status=get_safe($_POST['prod_status']);

    $sql = "DELETE FROM `product_description` WHERE desc_id=$desc_id";


    if(mysqli_query($conn , $sql)){
        echo "Delete Successfull";
    }else{
        "Deletion Failed!!";
    }



}


// Process Of Product Description End Here








//  Process Start for Product Section From Here

// Process for Product Adding
if(isset($_POST['product_add'])){

    // print_r($_POST);
    // print_r($_FILES);


    $product_name = get_safe($_POST['product_name']);
    $product_slug = get_safe($_POST['product_slug']);
    $cat_id = get_safe($_POST['cat_id']);
    $pcat_id = get_safe($_POST['pcat_id']);
    $author_id = get_safe($_POST['author_id']);
    $pub_id = get_safe($_POST['pub_id']);
    $desc_id = get_safe($_POST['desc_id']);
    $product_mrp = get_safe($_POST['product_mrp']);
    $product_price = get_safe($_POST['product_price']);
    $product_discount = get_safe($_POST['product_discount']);
    $product_subject = get_safe($_POST['product_subject']);
    $product_stock = get_safe($_POST['product_stock']);
    $product_lang = get_safe($_POST['product_lang']);
    $product_pages = get_safe($_POST['product_pages']);
    $product_isbn = get_safe($_POST['product_isbn']);
    $product_pubDate = get_safe($_POST['product_pubDate']);
    $product_delType = get_safe($_POST['product_delType']);
    $product_age = get_safe($_POST['product_age']);
    $product_features = get_safe($_POST['product_features']);
    $product_keywords = get_safe($_POST['product_keywords']);
    if(isset($_POST['product_istrending'])){
        $product_istrending = get_safe($_POST['product_istrending']);
    }else{
        $product_istrending = 0 ;
    }


    $imageName = $_FILES['product_image']['name'];

    $finalImageName = time().$imageName;

    $imageTempName = $_FILES['product_image']['tmp_name'];

    move_uploaded_file($imageTempName,"../Images/ProductImages/".$finalImageName);


    $sql = "INSERT INTO `products`( `prod_name`, `prod_slug`, `prod_author_id`, `prod_cat_id`, `prod_pcat_id`, `prod_publisher_id`, `prod_mrp`, `prod_price`, `prod_discount`, `prod_desc_id`, `prod_keywords`, `prod_features`, `prod_subject`, `prod_stock`, `prod_trending`, `prod_thumbnail`, `prod_lang`, `prod_pages`, `prod_isbn`, `prod_publication_date`, `prod_delivery_type`, `prod_see_age`) VALUES ('$product_name','$product_slug',$author_id,$cat_id,$pcat_id,$pub_id,$product_mrp,$product_price,$product_discount,$desc_id,'$product_keywords','$product_features','$product_subject',$product_stock,$product_istrending,'$finalImageName','$product_lang',$product_pages,'$product_isbn','$product_pubDate','$product_delType','$product_age')";

    // print_r($sql);
    $runQuery = mysqli_query($conn , $sql);

    if($runQuery){
        echo "Adding Successfull";
    }else{
        echo "Adding Failed";
    }



}




// This Code is for Viewing All Datas of Products with Pagination
if(isset($_POST['view_product'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM products ORDER BY prod_id DESC LIMIT {$offset},{$limit_per_page}";
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    // print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '<table class="table table-borderless table-hover">
        <thead >
            <tr class="text-center">
                <th >S No.</th>
                <th>Product Name</th>
                <th >Product Slug</th>
                <th>Author Name</th>
                <th>Category Name</th>
                <th>Product Category Name</th>
                <th>Publisher Name</th>
                <th>Product Mrp</th>
                <th>Product Price</th>
                <th>Product Discount</th>
                <th>Product Description Name</th>
                <th>Product Subject</th>
                <th>Product Stock</th>
                <th>Product Language</th>
                <th>Product Pages</th>
                <th>Product Publication Date</th>
                <th>Product Delivery</th>
                <th>Product See Age</th>
                <th width="10%">Product Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td>{$row['prod_name']}</td>
            <td>{$row['prod_slug']}</td>
            <td class='text-success fw-bolder' >".getAuthorName($row['prod_author_id'])."</td>
            <td class='text-success fw-bolder'>".getCategoryName($row['prod_cat_id'])."</td>
            <td class='text-success fw-bolder'>".getPcatName($row['prod_pcat_id'])."</td>
            <td class='text-success fw-bolder'>".getPublisherName($row['prod_publisher_id'])."</td>
            <td>Rs. {$row['prod_mrp']}</td>
            <td>Rs. {$row['prod_price']}</td>
            <td>{$row['prod_discount']} %</td>
            <td class='text-success fw-bolder'>".getDescriptionName($row['prod_desc_id'])."</td>
            <td>{$row['prod_subject']}</td>
            <td>{$row['prod_stock']}</td>
            <td>{$row['prod_lang']}</td>
            <td>{$row['prod_pages']}</td>
            <td>{$row['prod_publication_date']}</td>
            <td>{$row['prod_delivery_type']}</td>
            <td>{$row['prod_see_age']}</td>

            <td><img src='../admin/Images/ProductImages/{$row['prod_thumbnail']}' width='100%' ></td>
            <td >";

            $name="";
            $color="";
            if($row['prod_status'] == 0){
                   $name = "Active"; 
                   $color="btn-success";
            }else{
                $name="Deactivate"; 
                $color="btn-danger";
            }

            $output .= "<a data-status='{$row['prod_id']}@{$row['prod_status']}@{$page}' class=' ms-1 me-1 my-1 btn {$color} btn-sm' id='statusCheck'>
                            {$name}
                        </a>
                        <a class='btn  ms-1 me-1 my-1 btn-primary btn-sm' data-edit='{$row['prod_id']}@{$row['prod_status']}@{$page}' id='editProduct'>
                            Edit
                        </a>
                        <a class='btn  ms-1 me-1 my-1 btn-danger btn-sm' data-delete='{$row['prod_id']}@{$row['prod_status']}@{$page}' id='delProduct'>
                            Delete
                        </a>
                    </td></tr>";
            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM products ORDER BY prod_id DESC";
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}


// This Code is for Updating Status of Selected Products
if(isset($_POST['product_status_change'])){
    // print_r($_POST);

    $product_id=get_safe($_POST['product_id']);
    $product_status=get_safe($_POST['product_status']);

    if($product_status == 0){
        $product_status = 1;
    }else{
        $product_status = 0 ;
    }

    $sql = "UPDATE `products` SET `prod_status`=$product_status WHERE prod_id=$product_id";


    if(mysqli_query($conn , $sql)){
        echo "Status Updated Successfully";
    }else{
        "Status Updatation Failed!!";
    }



}



// This Code is for Showing Data in Update Modal Of Products
if(isset($_POST['edit_product'])){
    // print_r($_POST);

    $product_id=get_safe($_POST['product_id']);
    $product_status=get_safe($_POST['product_status']);

    $result_array=[];

    $sql = "select * from products WHERE prod_id=$product_id";

    $runQuery = mysqli_query($conn,$sql);


    if(mysqli_num_rows($runQuery)){
        $row= mysqli_fetch_assoc($runQuery);
        $author_name=getAuthorName($row['prod_author_id']);
        $cat_name=getCategoryName($row['prod_cat_id']);
        $pcat_name=getPcatName($row['prod_pcat_id']);
        $publisher_name=getPublisherName($row['prod_publisher_id']);
        $desc_name=getDescriptionName($row['prod_desc_id']);
        
        array_push($result_array,$row);
        array_push($result_array,$author_name,$cat_name,$pcat_name,$publisher_name,$desc_name);
        //print_r($result_array);
        echo json_encode($result_array);
    }else{
        echo "Data Not Found!!";
    }

}



// This Code is for Updating Products Data
if(isset($_POST['product_update'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $product_name = get_safe($_POST['eproduct_name']);
    $product_slug = get_safe($_POST['eproduct_slug']);
    $cat_id = get_safe($_POST['ecat_id']);
    $pcat_id = get_safe($_POST['pcat_id']);
    $author_id = get_safe($_POST['eauthor_id']);
    $pub_id = get_safe($_POST['epub_id']);
    $desc_id = get_safe($_POST['edesc_id']);
    $product_mrp = get_safe($_POST['eproduct_mrp']);
    $product_price = get_safe($_POST['eproduct_price']);
    $product_discount = get_safe($_POST['eproduct_discount']);
    $product_subject = get_safe($_POST['eproduct_subject']);
    $product_stock = get_safe($_POST['eproduct_stock']);
    $product_lang = get_safe($_POST['eproduct_lang']);
    $product_pages = get_safe($_POST['eproduct_pages']);
    $product_isbn = get_safe($_POST['eproduct_isbn']);
    $product_pubDate = get_safe($_POST['eproduct_pubDate']);
    $product_delType = get_safe($_POST['eproduct_delType']);
    $product_age = get_safe($_POST['eproduct_age']);
    $product_features = get_safe($_POST['eproduct_features']);
    $product_keywords = get_safe($_POST['eproduct_keywords']);
    if(isset($_POST['eproduct_istrending'])){
        $product_istrending = get_safe($_POST['eproduct_istrending']);
    }else{
        $product_istrending = 0 ;
    }



    $product_id = get_safe($_POST['product_id']);



    

    $sql = "UPDATE `products` SET `prod_name`='$product_name',`prod_slug`='$product_slug',`prod_author_id`=$author_id,`prod_cat_id`=$cat_id,`prod_pcat_id`=$pcat_id,`prod_publisher_id`=$pub_id,`prod_mrp`='$product_mrp',`prod_price`='$product_price',`prod_discount`='$product_discount',`prod_desc_id`=$desc_id,`prod_keywords`='$product_keywords',`prod_features`='$product_features',`prod_subject`='$product_subject',`prod_stock`=$product_stock,`prod_trending`=$product_istrending,`prod_lang`='$product_lang',`prod_pages`=$product_pages,`prod_isbn`='$product_isbn',`prod_publication_date`='$product_pubDate',`prod_delivery_type`='$product_delType',`prod_see_age`='$product_age' WHERE prod_id=$product_id";

    $runQuery = mysqli_query($conn , $sql);

   // print_r($sql);

    //echo $sql;

    if($runQuery){
        echo "Updating Successfull";
    }else{
        echo "Updating Failed";
    }

}




// This Code is For Deleting Products with ProductImages
if(isset($_POST['del_product'])){
    // print_r($_POST);

    $product_id=get_safe($_POST['product_id']);
    $product_status=get_safe($_POST['product_status']);

    $sql_image = "select * from `products` where prod_id=$product_id";
    $runQuery_image = mysqli_query($conn,$sql_image);
    $row_image = mysqli_fetch_assoc($runQuery_image);

    // For deleting Image from Folder
    unlink("../Images/ProductImages/".$row_image['prod_thumbnail']);

    // Delete Products Related Images from ""product_images"" table
    $delImagesSql = mysqli_query($conn,"select * from product_images where prod_id=$product_id");

    if(mysqli_num_rows($delImagesSql) > 0){
        while($rowImages = mysqli_fetch_assoc($delImagesSql)){
            $image_id = $rowImages['image_id'];
            unlink("../Images/ProductsImages/".$rowImages['image']);
            $sqlDelete = mysqli_query($conn,"DELETE FROM `product_images` WHERE image_id=$image_id");
        }
    }
     

    $sql = "DELETE FROM `products` WHERE prod_id=$product_id";


    if(mysqli_query($conn , $sql)){
        echo "Delete Successfull";
    }else{
        "Deletion Failed!!";
    }



}


// Process End For Product Section 










// Process Of Product Discuss Start From Here

// This Code is For Adding New Product Discuss
if(isset($_POST['pdiscuss_add'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $pdiscussName = get_safe($_POST['pdiscuss_name']);
    $pdiscussDesc = get_safe($_POST['pdiscuss_desc']);
    $productID = get_safe($_POST['product_id']);

    
    $sql = "INSERT INTO `product_discuss`(`prod_id`, `dis_title`, `dis_desc`) VALUES ($productID , '$pdiscussName' , '$pdiscussDesc' )";

   // print_r($sql);

    $runQuery = mysqli_query($conn , $sql);

    if($runQuery){
        echo "Adding Successfull";
    }else{
        echo "Adding Failed";
    }

}


// This Code is for Viewing All Datas of Product Discuss with Pagination
if(isset($_POST['view_pdiscuss'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM product_discuss ORDER BY dis_id DESC LIMIT {$offset},{$limit_per_page}";
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    // print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '<table class="table table-borderless table-hover">
        <thead>
            <tr class="text-center">
                <th >S No.</th>
                <th>Product Name</th>
                <th>Product Discuss Title</th>
                <th>Product Discuss Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td>".getProductName($row['prod_id'])."</td>
            <td>{$row['dis_title']}</td>
            <td>{$row['dis_desc']}</td>
            <td>";

            $name="";
            $color="";
            if($row['dis_status'] == 0){
                   $name = "Active"; 
                   $color="btn-success";
            }else{
                $name="Deactivate"; 
                $color="btn-danger";
            }

            $output .= "<a data-status='{$row['dis_id']}@{$row['dis_status']}@{$page}' class='btn {$color} btn-sm' id='statusCheck'>
                            {$name}
                        </a>
                        <a class='btn btn-primary btn-sm' data-edit='{$row['dis_id']}@{$row['dis_status']}@{$page}' id='editPdiscuss'>
                            Edit
                        </a>
                        <a class='btn btn-danger btn-sm' data-delete='{$row['dis_id']}@{$row['dis_status']}@{$page}' id='delPdiscuss'>
                            Delete
                        </a>
                    </td></tr>";
            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM product_discuss ORDER BY dis_id DESC";
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}




// This Code is for Updating Status of Selected Product Discuss
if(isset($_POST['pdiscuss_status_change'])){
    // print_r($_POST);

    $pdiscuss_id=get_safe($_POST['pdiscuss_id']);
    $pdiscuss_status=get_safe($_POST['pdiscuss_status']);

    if($pdiscuss_status == 0){
        $pdiscuss_status = 1;
    }else{
        $pdiscuss_status = 0 ;
    }

    $sql = "UPDATE `product_discuss` SET `dis_status`=$pdiscuss_status WHERE dis_id=$pdiscuss_id";

    // print_r($sql);


    if(mysqli_query($conn , $sql)){
        echo "Status Updated Successfully";
    }else{
        "Status Updatation Failed!!";
    }



}


// This Code is for Showing Data in Update Modal Of Product Discuss
if(isset($_POST['edit_pdiscuss'])){
    // print_r($_POST);

    $pdiscuss_id=get_safe($_POST['pdiscuss_id']);
    $pdiscuss_status=get_safe($_POST['pdiscuss_status']);

    $result_array=[];

    $sql = "select * from product_discuss WHERE dis_id=$pdiscuss_id";

    $runQuery = mysqli_query($conn,$sql);


    if(mysqli_num_rows($runQuery)){
        $row= mysqli_fetch_assoc($runQuery);
        $prod_name=getProductName($row['prod_id']);
        
        array_push($result_array,$row);
        array_push($result_array,$prod_name);
        //print_r($result_array);
        echo json_encode($result_array);
    }else{
        echo "Data Not Found!!";
    }

}


// This Code is for Updating Product Discuss Data
if(isset($_POST['pdiscuss_update'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $pdiscussName = get_safe($_POST['epdiscuss_name']);
    $pdiscussDesc = get_safe($_POST['epdiscuss_desc']);
    $product_id = get_safe($_POST['eproduct_id']);
    $pdiscuss_id = get_safe($_POST['pdiscuss_id']);
   
    $sql = "UPDATE `product_discuss` SET `prod_id`=$product_id,`dis_title`='$pdiscussName',`dis_desc`='$pdiscussDesc' WHERE dis_id=$pdiscuss_id";

    //print_r($sql);

    $runQuery = mysqli_query($conn , $sql);

    //print_r($runQuery);

    if($runQuery){
        echo "Updating Successfull";
    }else{
        echo "Updating Failed";
    }

}


// This Code is For Deleting Product Discuss
if(isset($_POST['del_pdiscuss'])){
    // print_r($_POST);

    $pdiscuss_id=get_safe($_POST['pdiscuss_id']);
    $pdiscuss_status=get_safe($_POST['pdiscuss_status']);


    $sql = "DELETE FROM `product_discuss` WHERE dis_id=$pdiscuss_id";


    if(mysqli_query($conn , $sql)){
        echo "Delete Successfull";
    }else{
        echo "Deletion Failed!!";
    }



}

// Process Of Product Discuss End Here









// Process Of Product Images Start From Here


// Process Of Adding Images in Product Images Table
if(isset($_POST['pimages_add'])){

    // echo "<pre>";
    // print_r($_POST);
    // print_r($_FILES);
    // die();

    //$pimages = get_safe($_POST['pimages']);
    $productID = get_safe($_POST['product_id']);

    
    $imageName = $_FILES['pimages']['name'];
    $imageTmp = $_FILES['pimages']['tmp_name'];
    foreach($imageName as $index => $image){
        $finalImageName = time().$image;
        // print_r($finalImageName);

        if(move_uploaded_file($imageTmp[$index] , "../Images/ProductsImages/$finalImageName")){
            $query = "INSERT INTO `product_images`(`prod_id`, `image`) VALUES ($productID , '$finalImageName')";
            $runQuery = mysqli_query($conn , $query);
        }
        
    }

    echo "Adding Successfull";
    
   // print_r($finalImageName);
  //  print_r($imageTmp);
    

}


// This Code is for Viewing All Datas of Product Images with Pagination
if(isset($_POST['view_pimages'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM product_images ORDER BY image_id DESC LIMIT {$offset},{$limit_per_page}";
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    // print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '<table class="table table-borderless table-hover">
        <thead>
            <tr class="text-center">
                <th >S No.</th>
                <th>Product Name</th>
                <th width="40%">Product Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td>".getProductName($row['prod_id'])."</td>
            <td><img src='Images/ProductsImages/{$row['image']}' width='20%'></td>
            <td>";

            $name="";
            $color="";
            if($row['image_status'] == 0){
                   $name = "Active"; 
                   $color="btn-success";
            }else{
                $name="Deactivate"; 
                $color="btn-danger";
            }

            $output .= "<a data-status='{$row['image_id']}@{$row['image_status']}@{$page}' class='btn {$color} btn-sm' id='statusCheck'>
                            {$name}
                        </a>
                
                        <a class='btn btn-danger btn-sm' data-delete='{$row['image_id']}@{$row['image_status']}@{$page}' id='delpimages'>
                            Delete
                        </a>
                    </td></tr>";
            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM product_images ORDER BY image_id DESC";
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Product Images Available.</h2>";
    }
}




// This Code is for Updating Status of Selected ProductImages
if(isset($_POST['pimages_status_change'])){
    // print_r($_POST);

    $pimages_id=get_safe($_POST['pimages_id']);
    $pimages_status=get_safe($_POST['pimages_status']);

    if($pimages_status == 0){
        $pimages_status = 1;
    }else{
        $pimages_status = 0 ;
    }

    $sql = "UPDATE `product_images` SET `image_status`=$pimages_status WHERE image_id=$pimages_id";

    // print_r($sql);


    if(mysqli_query($conn , $sql)){
        echo "Status Updated Successfully";
    }else{
        "Status Updatation Failed!!";
    }



}



// This Code is For Deleting Product Images with Images from folder and also delete
if(isset($_POST['del_pimages'])){
    // print_r($_POST);

    $pimages_id=get_safe($_POST['pimages_id']);
    $pimages_status=get_safe($_POST['pimages_status']);

    $sql_image = "select * from `product_images` where image_id=$pimages_id";
    $runQuery_image = mysqli_query($conn,$sql_image);
    $row_image = mysqli_fetch_assoc($runQuery_image);

    // For deleting Image from Folder
     unlink("../Images/ProductsImages/".$row_image['image']);


    $sql = "DELETE FROM `product_images` WHERE image_id=$pimages_id";


    if(mysqli_query($conn , $sql)){
        echo "Delete Successfull";
    }else{
        echo "Deletion Failed!!";
    }



}


// Process Of Product Images End Here









// Process Of Sliders Start Here


// This Code is For Adding New Slider Image
if(isset($_POST['slider_add'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    
    $sliderUrl = get_safe($_POST['slider_url']);
    
    $imageName = $_FILES['slider_image']['name'];

    $finalImageName = time().$imageName;

    $imageTempName = $_FILES['slider_image']['tmp_name'];

    move_uploaded_file($imageTempName,"../Images/sliderImages/".$finalImageName);
    

    $sql = "INSERT INTO `slider`(`slider_url`, `slider_pic`) VALUES ('$sliderUrl','$finalImageName')";

    $runQuery = mysqli_query($conn , $sql);

    if($runQuery){
        echo "Adding Successfull";
    }else{
        echo "Adding Failed";
    }

}


// This Code is for Viewing All Datas of Slider with Pagination
if(isset($_POST['view_slider'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM slider ORDER BY slider_id DESC LIMIT {$offset},{$limit_per_page}";
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    // print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '<table class="table table-borderless table-hover">
        <thead>
            <tr class="text-center">
                <th >S No.</th>
                <th>slider Url</th>
        
                <th width="20%">slider Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td>{$row['slider_url']}</td>
            <td><img src='../admin/Images/sliderImages/{$row['slider_pic']}' width='80%' ></td>
            <td >";

            $name="";
            $color="";
            if($row['slider_status'] == 0){
                   $name = "Active"; 
                   $color="btn-success";
            }else{
                $name="Deactivate"; 
                $color="btn-danger";
            }

            $output .= "<a data-status='{$row['slider_id']}@{$row['slider_status']}@{$page}' class='btn {$color} btn-sm' id='statusCheck'>
                            {$name}
                        </a>
                        <a class='btn btn-primary btn-sm' data-edit='{$row['slider_id']}@{$row['slider_status']}@{$page}' id='editSlider'>
                            Edit
                        </a>
                        <a class='btn btn-primary btn-sm' data-delete='{$row['slider_id']}@{$row['slider_status']}@{$page}' id='delSlider'>
                            Delete
                        </a>
                    </td></tr>";
            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM slider ORDER BY slider_id DESC ";
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}




// This Code is for Updating Status of Selected Slider
if(isset($_POST['slider_status_change'])){
    // print_r($_POST);

    $slider_id=get_safe($_POST['slider_id']);
    $slider_status=get_safe($_POST['slider_status']);

    if($slider_status == 0){
        $slider_status = 1;
    }else{
        $slider_status = 0 ;
    }

    $sql = "UPDATE `slider` SET `slider_status`=$slider_status WHERE slider_id=$slider_id";


    if(mysqli_query($conn , $sql)){
        echo "Status Updated Successfully";
    }else{
        "Status Updatation Failed!!";
    }



}


// This Code is for Showing Data in Update Modal Of Slider Data
if(isset($_POST['edit_slider'])){
    // print_r($_POST);

    $slider_id=get_safe($_POST['slider_id']);
    $slider_status=get_safe($_POST['slider_status']);

    $result_array=[];

    $sql = "select * from slider WHERE slider_id=$slider_id";

    $runQuery = mysqli_query($conn,$sql);


    if(mysqli_num_rows($runQuery)){
        $row= mysqli_fetch_assoc($runQuery);
        array_push($result_array,$row);
        echo json_encode($result_array);
    }else{
        echo "Data Not Found!!";
    }

}


// This Code is for Updating Slider Data
if(isset($_POST['slider_update'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $sliderUrl = get_safe($_POST['eslider_url']);
    
    $slider_id = get_safe($_POST['slider_id']);
    //$imageName = $_FILES['eslider_image']['name'];

    //$imageTempName = $_FILES['eslider_image']['tmp_name'];

    //move_uploaded_file($imageTempName,"../Images/slideregoryImages/".$imageName);
    

    $sql = "UPDATE `slider` SET `slider_url`='$sliderUrl' WHERE slider_id=$slider_id";

    $runQuery = mysqli_query($conn , $sql);

    //echo $sql;

    if($runQuery){
        echo "Updating Successfull";
    }else{
        echo "Updating Failed";
    }

}


// This Code is For Deleting Slider Data with Slider Image Also
if(isset($_POST['del_slider'])){
    // print_r($_POST);

    $slider_id=get_safe($_POST['slider_id']);
    $slider_status=get_safe($_POST['slider_status']);

    $sql_image = "select * from `slider` where slider_id=$slider_id";
    $runQuery_image = mysqli_query($conn,$sql_image);
    $row_image = mysqli_fetch_assoc($runQuery_image);

    // For deleting Image from Folder
     unlink("../Images/sliderImages/".$row_image['slider_pic']);
     
    // print_r("Images/sliderImages/".$row_image['slider_pic']);


    $sql = "DELETE FROM `slider` WHERE slider_id=$slider_id";


    if(mysqli_query($conn , $sql)){
        echo "Delete Successfull";
    }else{
        "Deletion Failed!!";
    }



}


// Process Of Sliders End Here












// Process Of Users Start Here


// This Code is For Adding New Staff
if(isset($_POST['user_add'])){

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    $name = get_safe($_POST['name']);
    $email = get_safe($_POST['email']);
    $mobile = get_safe($_POST['mobile']);
    $pass = password_hash(get_safe($_POST['pass1']),PASSWORD_BCRYPT);
    $job=get_safe($_POST['job']);
    $user_type=get_safe($_POST['user_type']);

    $emailCheck = mysqli_query($conn,"select * from registration where email = '$email'");
    if(mysqli_num_rows($emailCheck) > 0 ){
        echo "Email Already Exist";
        die();
    }

    $sql = "INSERT INTO `registration`(`name`, `email`, `password`, `mobile`, `job`,`user_type`) VALUES ('$name','$email','$pass','$mobile','$job','$user_type')";

    $runQuery = mysqli_query($conn , $sql);

    if($runQuery){
        echo "Registration Successful";
    }else{
        echo "Registration Failed";
    }

}


// This Code is for Viewing All Datas of Users with Pagination
if(isset($_POST['view_user'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM registration ORDER BY auth_id DESC LIMIT {$offset},{$limit_per_page}";
    
    // $result1 = mysqli_query($conn,$sql);
    
    $result = mysqli_query($conn,$sql) ;
    // print_r($result);
    $output= "";
    $sno = $offset + 1;
    if(mysqli_num_rows($result) > 0){
        $output .= '<table class="table table-borderless table-hover">
        <thead>
            <tr class="text-center">
                <th >S No.</th>
                <th >Name</th>
                <th >Email</th>
                <th>Mobile</th>
                <th>User Type</th>
                <th>Job</th>
                <th>Date Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td class='text-primary fw-bolder'>{$row['name']}</td>
            <td class='text-primary fw-bolder'>{$row['email']}</td>
            <td class='text-primary fw-bolder'>{$row['mobile']}</td>
            <td class='text-success fw-bolder'>{$row['user_type']}</td>
            <td class='text-success fw-bolder'>{$row['job']}</td>
            <td>{$row['timestamp']}</td>
            <td >";

            $name="";
            $color="";
            if($row['reg_status'] == 0){
                   $name = "Active"; 
                   $color="btn-success";
            }else{
                $name="Deactivate"; 
                $color="btn-danger";
            }

            $output .= "<a data-status='{$row['auth_id']}@{$row['reg_status']}@{$page}' class='btn {$color} btn-sm' id='statusCheck'>
                            {$name}
                        </a>
                        
                        <a class='btn btn-primary btn-sm' data-delete='{$row['auth_id']}@{$row['reg_status']}@{$page}' id='deluser'>
                            Delete
                        </a>
                    </td></tr>";
            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM registration ORDER BY auth_id DESC";
        $records = mysqli_query($conn,$sql_total);
        $total_record = mysqli_num_rows($records);
        $total_pages = ceil($total_record/$limit_per_page);

        $output .='<nav aria-label="...">
        <ul class="pagination pagination justify-content-center align-items-center my-4" id="pagination">';

        for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<li class='page-item {$class_name} p-1' aria-current='page'><a class='page-link' id='{$i}' href=''>{$i}</a>
        </li>";
        }
        $output .='</ul>
        </nav>';

        echo $output;
    }else{
        echo "<h2>No Record Found.</h2>";
    }
}




// This Code is for Updating Status of Selected User
if(isset($_POST['user_status_change'])){
    // print_r($_POST);

    $user_id=get_safe($_POST['user_id']);
    $user_status=get_safe($_POST['user_status']);

    if($user_status == 0){
        $user_status = 1;
    }else{
        $user_status = 0 ;
    }

    $sql = "UPDATE `registration` SET `reg_status`=$user_status WHERE auth_id=$user_id";


    if(mysqli_query($conn , $sql)){
        echo "Status Updated Successfully";
    }else{
        "Status Updatation Failed!!";
    }



}




// This Code is For Deleting Users
if(isset($_POST['del_user'])){
    // print_r($_POST);

    $user_id=get_safe($_POST['user_id']);
    $user_status=get_safe($_POST['user_status']);



    $sql = "DELETE FROM `registration` WHERE auth_id=$user_id";


    if(mysqli_query($conn , $sql)){
        echo "Delete Successfull";
    }else{
        "Deletion Failed!!";
    }



}


// Process Of users End Here








?>