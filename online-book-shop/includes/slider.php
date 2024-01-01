<div id="carouselExampleControls" class="carousel slide mt-1 p-1" data-bs-ride="carousel" >
  <div class="carousel-inner">
    <?php
      $sliderSql = mysqli_query($conn,"SELECT * from slider where slider_status=1");

      if(mysqli_num_rows($sliderSql) > 0 ){
        $serialNum= 0;
        while($rows=mysqli_fetch_array($sliderSql)){
          $serialNum++;
          if($serialNum == 1){
            $active = 'active';
          }else{
            $active='';
          }
          echo '<a href="'.$rows['slider_url'].'" class=" img-hover-thumb carousel-item '.$active.'">
                <img src="admin/Images/sliderImages/'.$rows['slider_pic'].'" class="d-block w-100" height="350px" alt="..." id="sliderImageHeight" >
                </a>';
        }
      }

    ?>
    
    
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>