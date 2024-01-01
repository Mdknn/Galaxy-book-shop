
<?php
session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script> window.location.href='includes/login.php'; </script>";
}


if(isset($_REQUEST['view_category'])){
  $title = "View Categories | Admin Panel";
}
else if(isset($_REQUEST['view_postCategory'])){
  $title = "View Product Categories | Admin Panel";
}
else if(isset($_REQUEST['view_authors'])){
  $title = "View Authors | Admin Panel";
}
else if(isset($_REQUEST['view_publishers'])){
  $title = "View Publishers | Admin Panel";
}
else if(isset($_REQUEST['view_prodDescription'])){
  $title = "View Product Description | Admin Panel";
}
else if(isset($_REQUEST['view_products'])){
  $title = "View Products | Admin Panel";
}
else if(isset($_REQUEST['view_productDiscuss'])){
  $title = "View Products Discuss | Admin Panel";
}
else if(isset($_REQUEST['view_prodImages'])){
  $title = "View Product Images | Admin Panel";
}
else if(isset($_REQUEST['view_allorders'])){
  $title = "View All Orders | Admin Panel";
}
else if(isset($_REQUEST['order_id'])){
  $title = "View Orders | Admin Panel";
}
else if(isset($_REQUEST['view_all_reviews'])){
  $title = "View All Reviews | Admin Panel";
}
else if(isset($_REQUEST['view_all_sliders'])){
  $title = "View All Sliders | Admin Panel";
}
else if(isset($_REQUEST['view_all_Users'])){
  $title = "View All Users | Admin Panel";
}else{
  $title = "Dashboard | Admin Panel";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="icon" type="image/x-icon" href="gfav.svg">
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="css/sidebar.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://cdn.tiny.cloud/1/fal4t5igzy8q5dlwhl8huyzboexof14nk6c803agviqr1qcs/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>



  <script type="text/javascript">
    tinymce.init({
    selector: 'textarea',
      // This is Very Important for Saving Data into Database
        setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
      },
    

    // Add this Line is very Important for Showing Source Code Option
    plugins: ['code',
        'advlist autolink link image lists charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking','table emoticons template paste help','print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons '
      ],
    
    menu: {
      tc: {
        title: 'Comments',
        items: 'addcomment showcomments deleteallconversations'
      }
    },
    menubar: 'file edit view insert format tools table tc help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    link_list: [
      { title: 'My page 1', value: 'https://www.tiny.cloud' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_list: [
      { title: 'My page 1', value: 'https://www.tiny.cloud' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_class_list: [
      { title: 'None', value: '' },
      { title: 'Some class', value: 'class-name' }
    ],
    importcss_append: true,
    templates: [
          { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
      { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
      { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 400,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
    tinycomments_mode: 'embedded',
    
    contextmenu: 'link image imagetools table configurepermanentpen',
    a11y_advanced_options: true,
    
    /*
    The following settings require more configuration than shown here.
    For information on configuring the mentions plugin, see:
    https://www.tiny.cloud/docs/plugins/premium/mentions/.
    */
    mentions_selector: '.mymention',

    
  });

  </script>

<style>
    #loadanimation{
    display:flex;
    align-items:center;
    width:100%;
    height:100vh;
    justify-content:center;
    background-color: rgba(244,245,246,255) !important;
    background: rgba(12,12,12,255) url('https://cdn.dribbble.com/users/108183/screenshots/2301400/spinnervlll.gif') no-repeat center;
    }
</style>


<link rel="stylesheet" href="style.css">
    
    
</head>

<body onload="myFunction()">

<div id="loadanimation"></div>
    
      <?php include('includes/sidebar.php') ?>

    <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
    </div>

    <div class="mx-5">
        <?php
        if(isset($_REQUEST['view_category'])){
          $title = "View Categories | Admin Panel";
        }
        if(isset($_REQUEST['view_postCategory'])){
          $title = "View Product Categories | Admin Panel";
        }
        if(isset($_REQUEST['view_authors'])){
          $title = "View Authors | Admin Panel";
        }
        if(isset($_REQUEST['view_publishers'])){
          $title = "View Publishers | Admin Panel";
        }
        if(isset($_REQUEST['view_prodDescription'])){
          $title = "View Product Description | Admin Panel";
        }
        if(isset($_REQUEST['view_products'])){
          $title = "View Products | Admin Panel";
        }
        if(isset($_REQUEST['view_productDiscuss'])){
          $title = "View Products Discuss | Admin Panel";
        }
        if(isset($_REQUEST['view_prodImages'])){
          $title = "View Product Images | Admin Panel";
        }
        if(isset($_REQUEST['view_allorders'])){
          $title = "View All Orders | Admin Panel";
        }
        if(isset($_REQUEST['order_id'])){
          $title = "View Orders | Admin Panel";
        }
        if(isset($_REQUEST['view_all_reviews'])){
          $title = "View All Reviews | Admin Panel";
        }
        if(isset($_REQUEST['view_all_sliders'])){
          $title = "View All Sliders | Admin Panel";
        }
        if(isset($_REQUEST['view_all_Users'])){
          $title = "View All Users | Admin Panel";
        }
        if(isset($_GET['view_category'])){
            include('includes/category.php');
        }
        else if(isset($_GET['view_postCategory'])){
            include('includes/postCategory.php');
        }
        else if(isset($_GET['view_authors'])){
          include('includes/author.php');
        }
        else if(isset($_GET['view_publishers'])){
          include('includes/publisher.php');
        }
        else if(isset($_GET['view_prodDescription'])){
          include('includes/prodDescription.php');
        }
        else if(isset($_GET['view_products'])){
          include('includes/product.php');
        }
        else if(isset($_GET['view_productDiscuss'])){
          include('includes/productDiscuss.php');
        }
        else if(isset($_GET['view_prodImages'])){
          include('includes/productImages.php');
        }
        else if(isset($_GET['view_allorders'])){
          include('includes/orders.php');
        }
        else if(isset($_GET['order_id'])){
          include('includes/seeorderproducts.php');
        }
        else if(isset($_GET['view_all_reviews'])){
          include('includes/allreviews.php');
        }
        else if(isset($_GET['view_all_sliders'])){
          include('includes/sliders.php');
        }
        else if(isset($_GET['view_all_Users'])){
          include('includes/Users.php');
        }
        else{
          include('includes/adminDashboard.php');
        }


        ?>
    </div>
  </section>
   


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- This jQuery cdn is required for Lightbox -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.1/js/lightbox.min.js"></script>

<!-- <script type="text/javascript" src="https://cdn.bootcss.com/typed.js/1.1.4/typed.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.4/typed.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<script type="text/javascript" src="includes/adminlogout.js" > </script>










<!-- for SideBar Js -->
<script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  // console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });




  // This javascript code for loading animation
  var loadAnimation = document.getElementById("loadanimation");
  function myFunction() {
    loadAnimation.style.display="none";
    
  }

  </script>
</body>
</html>
