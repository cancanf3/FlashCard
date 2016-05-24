<html>
   <head>
      <title>Welcome </title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> 
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
   </head>
   
   <body> 
   <div class="container-fluid">
      <div class="container">
         <div class="WelTitle">

      <?php
         include($_SERVER["DOCUMENT_ROOT"]. '/FlashCard/Config.php');
         
         session_start();

         $email   = $_SESSION['login_user'];
         $sql     = "SELECT TITLE, DESCRIPTION FROM CATEGORY WHERE U_EMAIL = '$email'";
         $result  = mysqli_query($db, $sql);

         echo "<h1> Welcome ".$_SESSION['login_user']."</h1>";
         echo "</div>";
         echo "<div>";

         Echo "Current Categories";
         echo '<div class="container">';
         echo '<div class="row">';

         $i = 0;
         $color = array("#428bca","#ec971f","#c9302c","#5cb85c","#bb39d7");

         while( $row = mysqli_fetch_array($result) ){
            echo '<div class="col-md-3 text-center">';
            echo '<div class="box">';
            echo '<div class="border" style="background-color:'.$color[$i].'"> <a href=""> <i class="fa fa-pencil-square-o" aria-hidden="true"> </i> </a>  <i id="exitIcon" class="fa fa-trash-o" aria-hidden="true"></i> </div>';
            $title = $row['TITLE'];
            echo '<div id="box-content" class="box-content" > <h1 id="tag-title" class="tag-title">' .$title. "</h1> ";
            $description = $row['DESCRIPTION'];
            echo "<p>" .$description. "</p>";  
            //echo '<button type="button" class="btn btn-primary btn-round-lg btn-lg">  </button>';
            echo "</div> </div> </div>";
            $i++;
            if($i == 5){ 
               $i = 0;
            }
          
         }
         echo "</div> </div> </div>";

         echo "<a href='register_category.php'> \n Add a new Category</a>";
      ?>   
      <?php echo $login_session; ?> 
      <h2><a href = "/FlashCard/Logout.php">Sign Out</a></h2>
      </div>
      </div>
   </body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {

      $(".fa-trash-o").click(function() {

         var title  = $(this).parent().parent().children("#box-content").children("#tag-title").text();
         var box    = $(this).parent().parent().parent();
         var mydata = 'DEL_CATEGORY=' + title;
         $(this).hide();

         $.ajax( {
            type: 'POST',
            url: '/FlashCard/respond.php',
            data: mydata,
            success:function(data) {
               box.fadeOut();
            }
         });
      });


});
</script>
   
</html>

