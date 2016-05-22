<?php
	include("config.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$u_email 	  = mysqli_real_escape_string($db, $_SESSION['login_user']);
		$title 	  	  = mysqli_real_escape_string($db, $_POST['title']);

		$sql 		  = "SELECT * FROM CATEGORY WHERE U_EMAIL = '$u_email'";
		$result 	  = mysqli_query($db,$sql);
		$count  	  = mysqli_num_rows($result) + 1;

		$sql 		  = "INSERT INTO CATEGORY (U_EMAIL, TITLE, COUNT) VALUES ('$u_email', '$title', '$count')";

		if(mysqli_query($db,$sql)) {
			echo "Category created sucessfully";
			echo "<a href='welcome.php'>\t go back </a>";
		}
		else {
			echo "Category was created already";
			"Error: " . $_POST['title'] . "<br>" . mysqli_error($db);
		}

	}
?>	

<html>
   
   <head>
      <title>Register Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Title  :</label><input type = "text" name = "title" class = "box"/><br /><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>