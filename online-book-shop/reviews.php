<?php

$sql = "SELECT * FROM products WHERE prod_status=1 and prod_slug='$slug'";

$runQuery = mysqli_query($conn,$sql);

if(mysqli_num_rows($runQuery)){
    $row = mysqli_fetch_assoc($runQuery);

    $product_id = $row['prod_id'];
}else{
    $row = array();
}

?>

<div class="container">
    	<h2 class="mt-5 mb-5">Reviews and Rating for <span class="text-success fw-bolder"> <?= $row['prod_name'] ?> Book</span></h2>
        <input type="hidden" name="productId" id="productId" value="<?php echo $row['prod_id']; ?>">
    	<div class="card">
    		<div class="card-header">View All Ratings and Reviews</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-4 text-center">
    					<h1 class="text-warning mt-4 mb-4">
    						<b><span id="average_rating">0.0</span> / 5</b>
    					</h1>
    					<div class="mb-3">
    						<i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
	    				</div>
    					<h3><span id="total_review">0</span> Review</h3>
    				</div>
    				<div class="col-sm-4">
    					<p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
    				</div>
    				<div class="col-sm-4 text-center">
    					<h3 class="mt-4 mb-3">Write Review Here</h3>
                        <?php if (isset($_SESSION['customer_email'])) {
                            echo '<button type="button" name="add_review" id="add_review" class="btn btn-primary">Give Rating</button>';
                        
                        }else{
                            echo '<button type="button" name="" data-bs-toggle="modal" data-bs-target="#loginModal" id="loginnav" class="btn btn-danger">First Login Then Review</button>';
                        } ?>
    					
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="mt-5" id="review_content"></div>
    </div>

    <!-- For Showing No Ratings and Reviews Available -->
    <h2 id="noreviews"></h2>

</body>
</html>

<!-- For getting Current Review Star Value -->
<?php

if(isset($_SESSION['customer_email'])){
    $user_id = $_SESSION['user_id'];   
}else{
    $user_id = '';    
}
if($user_id != ''){ 
    $getRating = mysqli_query($conn,"SELECT * FROM reviews where user_id=$user_id and prod_id=$product_id");

    if(mysqli_num_rows($getRating) > 0){
        $getValues = mysqli_fetch_assoc($getRating);

        $getRatingValues = $getValues['user_rating'];
        $getRatingCValues = $getValues['user_review'];
    }else{
        
        $getRatingValues= '';
        $getRatingCValues= '';
    }
}else{
    $getRatingValues= '';
    $getRatingCValues= '';
}


?>

<input type="hidden" name="ratingValue" id="ratingValue" value="<?= $getRatingValues; ?>">


<div id="review_modal" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">Submit Review</h5>
	        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      	</div>
	      	<div class="modal-body">
	      		<h4 class="text-center mt-2 mb-4">
	        		<i class="fas fa-star star-light <?php if($getRatingValues >= 1){ echo 'text-warning'; }else if($getRatingValues ==''){ echo 'text-warning'; } ?> submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light <?php if($getRatingValues >= 2){ echo 'text-warning'; }else if($getRatingValues ==''){ echo 'text-warning'; } ?> submit_star mr-1" id="submit_star_2" data-rating="2" ></i>
                    <i class="fas fa-star star-light <?php if($getRatingValues >= 3){ echo 'text-warning'; }else if($getRatingValues ==''){ echo 'text-warning'; } ?> submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light <?php if($getRatingValues >= 4){ echo 'text-warning'; }else if($getRatingValues ==''){ echo 'text-warning'; } ?> submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light <?php if($getRatingValues >= 5){ echo 'text-warning'; }else if($getRatingValues ==''){ echo 'text-warning'; } ?> submit_star mr-1" id="submit_star_5" data-rating="5"></i>
	        	</h4>
	        	
	        	<div class="form-group">
	        		<textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"><?= $getRatingCValues; ?></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
	        		<button type="button" class="btn btn-primary" id="save_review">Submit</button>
	        	</div>
	      	</div>
    	</div>
  	</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- This jQuery cdn is required for Lightbox -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>

var rating_value = document.getElementById("ratingValue").value;
// console.log(rating_value);

var rating_data = 5;
if(rating_value != ''){
    rating_data = rating_value;
}else{
    rating_data = 5;
}
// alert(rating_data);


    $('#add_review').click(function(){

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){
        // alert("Please")
        var rating = $(this).data('rating');

       //  alert($("#productId").val());

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function(){

        
        let productId = $('#productId').val();

        
        var user_review = $('#user_review').val();

        if( user_review == '')
        {
            alert("Please Fill Review Text Field");
            return false;
        }
        else
        {
            $.ajax({
                url:"submit_rating.php",
                method:"POST",
                data:{'rating_data':rating_data,'user_review':user_review,'product_id':productId
                    ,'save_rating_data':true},

                success:function(data)
                {
                    $('#review_modal').modal('hide');

                    load_rating_data();

                    if(data == "Review Updated Successfully"){
                        swal("Congratulations!", "Review Updated Successfully!", "success");
                    }else if(data == "Review Added Successfully"){
                        swal("Congratulations!", "Review Added Successfully!", "success");
                    }else{
                        swal("Error!", "Review Not Added!", "error");
                    }
                    
                }
            })
        }

    });



    load_rating_data();

function load_rating_data()
{
    let productId = $('#productId').val();

    $.ajax({
        url:"submit_rating.php",
        method:"POST",
        data:{'load_reviews':true,'product_id':productId},
        dataType:"JSON",
        success:function(data)
        {
           // alert(data.review_data);
            if(data.review_data == "No Reviews Available"){
               // alert('No reviews available');
                html = "No Ratings and Reviews Available";
                $('#noreviews').html(html);
                
            }else{
                
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

            // console.log(data.average_rating)
                var count_star = 0;

                $('.main_star').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                if(data.review_data.length > 0)
                {
                    var html = '';

                    for(var count = 0; count < data.review_data.length; count++)
                    {
                        html += '<div class="row mb-3">';

                        html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pb-3 pt-3"><h2 class="text-center  fw-bolder">'+data.review_data[count].user_name.charAt(0)+'</h2></div></div>';

                        html += '<div class="col-sm-11">';

                        html += '<div class="card">';

                        html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

                        html += '<div class="card-body">';

                        for(var star = 1; star <= 5; star++)
                        {
                            var class_name = '';

                            if(data.review_data[count].user_rating >= star)
                            {
                                class_name = 'text-warning';
                            }
                            else
                            {
                                class_name = 'star-light';
                            }

                            html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                        }

                        html += '<br />';

                        html += data.review_data[count].user_review;

                        html += '</div>';

                        html += '<div class="card-footer text-end">On '+data.review_data[count].timestamp+'</div>';

                        html += '</div>';

                        html += '</div>';

                        html += '</div>';
                    }

                    $('#review_content').html(html);
                }
            }



            
        }
    })
    }


</script>