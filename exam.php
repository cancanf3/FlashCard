<html>
<head>
<title>Exam</title>
	  <link rel="stylesheet" type="text/css" href="style.css">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> 
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

     <!-- <script type="text/javascript" scr="main.js"></script> -->
</head>
   <body>
	   <div class="container">
	   <h1> hello </h1>
		   <!-- <?php
		      		include($_SERVER["DOCUMENT_ROOT"]. '/FlashCard/Config.php');
		               
		               session_start();

		               $email   = $_SESSION['login_user'];
		               $catTitle = $_POST['catTitle']; 
		               $sql     = "SELECT C_TITLE, TITLE, DEFINITION FROM QUESTION WHERE U_EMAIL= '$email' AND C_TITLE= '$catTitle'";
		               $result  = mysqli_query($db, $sql);
		               $result_array = array();

		               		echo "<h1 id=".$catTitle." class='title'> Category " .$catTitle. " User: " .$_SESSION['login_user']. "</h1>";
							while($row = mysql_fetch_assoc($result))
							{
							    $result_array[] = $row;
							};

							for( int i = 0; i < sizeof($result_array); i++ ){
								echo $result_array[i];
							}
		    ?> --> 
	    </div>
   </body>

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
   <!-- <script type="text/javascript" src="../FlashCard/exam.js"></script> --> 
</html>