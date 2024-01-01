<?php
include('function.php');
if(isset($_POST['get_pcatName'])){

    $cat_id = get_safe($_POST['cat_id']);

    $sql = "select * from product_categories where cat_id=$cat_id";

    $runQuery = mysqli_query($conn, $sql);

    $output="";

    if(mysqli_num_rows($runQuery) >0){
        $output .= '<div class="mb-3">
        <select class="form-select" aria-label="Default select example" id="pcat_id" name="pcat_id">
            <option selected>Select Any Product Category</option>';
        while($rows=mysqli_fetch_assoc($runQuery)){
            $output .= "<option value=".$rows['pcat_id'].">".$rows['pcat_name']."</option>";   
            
        }
        $output .= '</select>
        </div>';

        echo $output;
    }
    else{
        echo "No Data";
    }

}
?>