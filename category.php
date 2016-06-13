<html>
<head>
<title>Category</title>
	  <link rel="stylesheet" type="text/css" href="style.css">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> 
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

     <!-- <script type="text/javascript" scr="main.js"></script> -->
</head>
   <body>

      <div class="container" id="FlashCardDiv2">
         <button type='button' class='btn btn-primary btn-sm' id='buttonCat1'> Back to Categories </button>
      	
      	<div class="catTitle">
      		<?php
      		include($_SERVER["DOCUMENT_ROOT"]. '/FlashCard/Config.php');
               
               session_start();

               $email   = $_SESSION['login_user'];
               $catTitle = $_POST['catTitle']; 
               $sql     = "SELECT C_TITLE, TITLE, DEFINITION FROM QUESTION WHERE U_EMAIL= '$email' AND C_TITLE= '$catTitle'";
               $result  = mysqli_query($db, $sql);
      		
               echo "<button type='button' class='btn btn-primary btn-sm' id='buttonCat' 
                     data-toggle='modal' data-target='#myModal'>";
               echo "Register a Question</button> ";

               echo "<a href='/FlashCard/exam.php'> <button type='button' class='btn btn-primary btn-sm'> Start Exam </button></a> </div>";

               echo "<h1 id=".$catTitle." class='title'> Category " .$catTitle. " User: " .$_SESSION['login_user']. "</h1>";
               while( $row = mysqli_fetch_array($result) ){
                  echo '<div class="col-md-3 text-center">';
                  echo '<div class="box">';
                  echo '<div class="border" style="background-color:'.$color[$i].'"> <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="modal" data-target="#myModal"> </i>  <i id="exitIcon" class="fa fa-trash-o" aria-hidden="true"></i> </div>';
                     $title = $row['TITLE'];
                  echo '<div id="box-content" class="box-content" > <h1 id="tag-title">' .$title. "</h1>";
                     $description = $row['DEFINITION'];
                  echo "<p id='tag-description'>" .$description. "</p>";  
                  echo "</div> </div> </div>";
               }
               
               ?>
      	</div>

      </div>

   </body>

</html>