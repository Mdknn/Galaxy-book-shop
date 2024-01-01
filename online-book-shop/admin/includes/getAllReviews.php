<?php

include('../backend/function.php');

// This Code is for Viewing All Datas of Category with Pagination
if(isset($_POST['view_all_reviews'])){

    $limit_per_page = 5;

    $page = "";
    if(isset($_POST["page_no"])){
        $page = $_POST["page_no"];
    }else{
        $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM reviews LIMIT {$offset},{$limit_per_page}";
    
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
                <th>User Name</th>
                <th >Product Name</th>
                <th >Review Rating</th>
                <th >User Review</th>              
                <th >Date Time</th>              
                <th>Action</th>
            </tr>
        </thead>
        <tbody >';
        
        while($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr class='text-center align-middle'>
            <td>{$sno}</td>
            <td>{$row['user_name']}</td>
            <td>".getProductName($row['prod_id'])."</td>
            <td class='text-success fw-bolder'>{$row['user_rating']}</td>
            <td class='text-success fw-bolder'>{$row['user_review']}</td>
            <td>{$row['timestamp']}</td>
            
            <td >";

            $name="";
            $color="";
            if($row['rev_status'] == 0){
                   $name = "Active"; 
                   $color="btn-success";
            }else{
                $name="Deactivate"; 
                $color="btn-danger";
            }

            $output .= "<a data-status='{$row['rev_id']}@{$row['rev_status']}@{$page}' class='btn {$color} btn-sm' id='statusCheck'>
                            {$name}
                        </a>
                        
                        <a class='btn btn-primary btn-sm' data-delete='{$row['rev_id']}@{$row['rev_status']}@{$page}' id='delReview'>
                            Delete
                        </a>
                    </td></tr>";
            
           $sno++; 
        }
        $output .= "</tbody>
                </table>
                ";

        $sql_total = "SELECT * FROM reviews";
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



// This Code is for Updating Status of Selected Reviews
if(isset($_POST['review_status_change'])){
    // print_r($_POST);

    $rev_id=get_safe($_POST['rev_id']);
    $rev_status=get_safe($_POST['rev_status']);

    if($rev_status == 0){
        $rev_status = 1;
    }else{
        $rev_status = 0 ;
    }

    $sql = "UPDATE `reviews` SET `rev_status`=$rev_status WHERE rev_id=$rev_id";


    if(mysqli_query($conn , $sql)){
        echo "Status Updated Successfully";
    }else{
        "Status Updatation Failed!!";
    }



}



// This Code is For Deleting Reviews 
if(isset($_POST['del_rev'])){
    // print_r($_POST);

    $rev_id=get_safe($_POST['rev_id']);
    $rev_status=get_safe($_POST['rev_status']);

    $sql = "DELETE FROM `reviews` WHERE rev_id=$rev_id";


    if(mysqli_query($conn , $sql)){
        echo "Delete Successfull";
    }else{
        "Deletion Failed!!";
    }



}



?>