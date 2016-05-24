<?php
	include($_SERVER['DOCUMENT_ROOT'].'/FlashCard/Config.php');
	session_start();


	if (isset($_POST["ADD_CATEGORY"]) && strlen($_POST["ADD_CATEGORY"]) > 0) {

		$u_email 	  = mysqli_real_escape_string($db, $_SESSION['login_user']);
		$title 	  	  = mysqli_real_escape_string($db, $_POST['title']);
		$description  = mysqli_real_escape_string($db, $_POST['description']);

		$sql 		  = "SELECT * FROM CATEGORY WHERE U_EMAIL = '$u_email'";
		$result 	  = mysqli_query($db,$sql);
		$count  	  = mysqli_num_rows($result) + 1; // Va a ser eliminado

		$sql 		  = "INSERT INTO CATEGORY (U_EMAIL, TITLE, COUNT, DESCRIPTION) VALUES ('$u_email', '$title', '$count', '$description')";

		if (mysqli_query($db,$sql)) {
			header("Category created sucessfully");
			exit();
		}
		else {
			header("Category was created already");
			exit();
		}

	}	
	elseif (isset($_POST["DEL_CATEGORY"]) && strlen($_POST["DEL_CATEGORY"]) > 0) {

		$u_email 	  = mysqli_real_escape_string($db, $_SESSION['login_user']);
		$title 		  = mysqli_real_escape_string($db, $title);
		$sql		  = "DELETE FROM CATEGORY WHERE U_EMAIL = '$u_email' AND TITLE = '$title'";
		
		if (!mysqli_query($db,$sql)) {
			header("HTTP/1.1 500 Could not delete record");
			exit();
		}
		mysqli_close($db);

	}
	else {
    	//Output error
    	header('HTTP/1.1 500 Error occurred, Could not process request!');
    	exit();
	}




?>