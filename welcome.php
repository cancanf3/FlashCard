<?php
   include('session.php');
?>
<html">
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome 
      	<?php echo $login_session;
      		  echo $_SESSION['login_user'];
              echo "<a href='register_category.php'> \n Add a new Category</a>";
      	?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
   
</html>