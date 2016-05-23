<?php
   include($_SERVER['DOCUMENT_ROOT'].'/FlashCard/Config.php');
   session_start();

   $email   = $_SESSION['login_user'];
   $sql     = "SELECT TITLE FROM CATEGORY WHERE U_EMAIL = '$email'";
   $result  = mysqli_query($db, $sql);

   echo "<h1> Welcome ".$_SESSION['login_user']."</h1>";
   echo "\nCurrent Categories";
   echo "<div>";

   while( $row = mysqli_fetch_array($result) ){
      $title = $row['TITLE'];
      echo "<div>" .$title. "</div>";
   }
   echo "</div>";
   echo "<a href='register_category.php'> \n Add a new Category</a>";


?>
<html">
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body> 
      <?php echo $login_session;
              
      ?> 
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
   
</html>