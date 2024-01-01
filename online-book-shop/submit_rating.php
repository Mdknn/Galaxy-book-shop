<?php
session_start();
include('frontend/function.php');

if(isset($_POST["save_rating_data"]))
{

    if(isset($_SESSION["customer_email"])){
        $user_id = $_SESSION["user_id"];
        $user_name = $_SESSION["customer_name"];
    }

    $product_id = get_safe($_POST["product_id"]);
    $rating_data = get_safe($_POST["rating_data"]);
    $user_review = get_safe($_POST["user_review"]);

    $sql1 = "select * from reviews where user_id = $user_id and prod_id = $product_id";

	$runQuery1 = mysqli_query($conn,$sql1);

	if(mysqli_num_rows($runQuery1) > 0 ){

		$row = mysqli_fetch_array($runQuery1);
		$rev_id = $row['rev_id'];

		$sql2 = "UPDATE `reviews` SET `user_rating`=$rating_data,`user_review`='$user_review' WHERE rev_id=$rev_id";

		$runQuery2 = mysqli_query($conn,$sql2);

		echo "Review Updated Successfully";

	}else{
		$sql = "INSERT INTO `reviews`(`user_id`,`user_name`, `prod_id`, `user_rating`, `user_review`) VALUES ($user_id, '$user_name', $product_id, $rating_data, '$user_review')";

    	$runQuery = mysqli_query($conn, $sql);

		echo "Review Added Successfully";

	}
	
	

}



	if(isset($_POST["load_reviews"]))
	{
		$average_rating = 0;
		$total_review = 0;
		$five_star_review = 0;
		$four_star_review = 0;
		$three_star_review = 0;
		$two_star_review = 0;
		$one_star_review = 0;
		$total_user_rating = 0;
		$review_content = array();

		$product_id = get_safe($_POST["product_id"]);

		$query = "
		SELECT * FROM reviews where prod_id=$product_id and rev_status =1
		ORDER BY rev_id DESC LIMIT 0,5
		";

		$runQuery = mysqli_query($conn, $query);

		if(mysqli_num_rows($runQuery) > 0){
			while($row = mysqli_fetch_assoc($runQuery)){

				$review_content[] = $row;
				// print_r($review_content);

				if($row["user_rating"] == '5')
				{
					$five_star_review++;
				}

				if($row["user_rating"] == '4')
				{
					$four_star_review++;
				}

				if($row["user_rating"] == '3')
				{
					$three_star_review++;
				}

				if($row["user_rating"] == '2')
				{
					$two_star_review++;
				}

				if($row["user_rating"] == '1')
				{
					$one_star_review++;
				}

				$total_review++;

				$total_user_rating = $total_user_rating + $row["user_rating"];

			}


			$average_rating = $total_user_rating / $total_review;

			$output = array(
				'average_rating'	=>	number_format($average_rating, 1),
				'total_review'		=>	$total_review,
				'five_star_review'	=>	$five_star_review,
				'four_star_review'	=>	$four_star_review,
				'three_star_review'	=>	$three_star_review,
				'two_star_review'	=>	$two_star_review,
				'one_star_review'	=>	$one_star_review,
				'review_data'		=>	$review_content
			);

			echo json_encode($output);

		}else{
			$output = array(
				'review_data'		=>	"No Reviews Available"
			);
			echo json_encode($output);
		}

		

		
		
		
	}			
			
	
?>