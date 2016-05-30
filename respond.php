<?php
	include($_SERVER['DOCUMENT_ROOT'].'/FlashCard/Config.php');
	session_start();


	if (isset($_POST["ADD_CATEGORY_TITLE"]) && strlen($_POST["ADD_CATEGORY_TITLE"]) > 0) {

		$u_email 	  = mysqli_real_escape_string($db, $_SESSION['login_user']);
		$title 	  	  = mysqli_real_escape_string($db, $_POST['ADD_CATEGORY_TITLE']);
		$description  = mysqli_real_escape_string($db, $_POST['ADD_CATEGORY_DES']);
		$sql 		  = "INSERT INTO CATEGORY (U_EMAIL, TITLE, DESCRIPTION) VALUES ('$u_email', '$title', '$description')";

		if (!mysqli_query($db,$sql)) {
			header("HTTP/1.1 500 Category was created already");
			exit();
		}

	}	
	elseif (isset($_POST['DEL_CATEGORY']) && strlen($_POST['DEL_CATEGORY']) > 0) {

		$u_email 	  = mysqli_real_escape_string($db, $_SESSION['login_user']);
		$title 		  = mysqli_real_escape_string($db, $_POST['DEL_CATEGORY']);
		$sql		  = "DELETE FROM CATEGORY WHERE U_EMAIL = '$u_email' AND TITLE = '$title'";
		
		if (!mysqli_query($db,$sql)) {
			header("HTTP/1.1 500 Could not delete record");
			exit();
		}

	}
	else { 

    	//Output error
    	header('HTTP/1.1 500 Error occurred, Could not process request!');
    	exit();
	}




?>

	/* elseif ($_POST["EDIT_CATEGORY_TITLE"]) && strlen($_POST["EDIT_CATEGORY_TITLE"]) > 0) {

		$u_email 	  = mysqli_real_escape_string($db, $_SESSION['login_user']);
		$old_title 	  = mysqli_real_escape_string($db, $_POST['OLD_CATEGORY_TITLE']);
		$title 		  = mysqli_real_escape_string($db, $_POST['EDIT_CATEGORY_TITLE']);
		$description  = mysqli_real_escape_string($db, $_POST['EDIT_CATEGORY_DES']);
		$sql 		  = "UPDATE CATEGORY SET TITLE='$title', DESCRIPTION='$description' WHERE U_EMAIL='$u_email' AND TITLE='$old_title'"

		if (!mysqli_query($db,$sql)) {
			header("HTTP/1.1 500 Could not update record");
			exit();
		}


	} */
