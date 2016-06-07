<?php
	include($_SERVER['DOCUMENT_ROOT'].'/FlashCard/Config.php');
	session_start();


	// Add in Welcome
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

	// Add in Category
	else if (isset($_POST["ADD_QUESTION_TITLE"]) && strlen($_POST["ADD_QUESTION_TITLE"]) > 0) {

		$u_email 	  = mysqli_real_escape_string($db, $_SESSION['login_user']);
		$title 	  	  = mysqli_real_escape_string($db, $_POST['ADD_QUESTION_TITLE']);
		$description  = mysqli_real_escape_string($db, $_POST['ADD_QUESTION_DEF']);
		$sql 		  = "INSERT INTO QUESTION (U_EMAIL, TITLE, DEFINITION) VALUES ('$u_email', '$title', '$description')";

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
	elseif (isset($_POST["EDIT_CATEGORY_TITLE"]) && strlen($_POST["EDIT_CATEGORY_TITLE"]) > 0) {
		
		$u_email 	  = mysqli_real_escape_string($db, $_SESSION['login_user']);
		$old_title 	  = mysqli_real_escape_string($db, $_POST['OLD_CATEGORY_TITLE']);
		$title 		  = mysqli_real_escape_string($db, $_POST['EDIT_CATEGORY_TITLE']);
		$description  = mysqli_real_escape_string($db, $_POST['EDIT_CATEGORY_DES']);
		$sql 		  = "UPDATE CATEGORY SET TITLE='$title', DESCRIPTION='$description' WHERE U_EMAIL='$u_email' AND TITLE='$old_title'";

		if (!mysqli_query($db,$sql)) {
			header("HTTP/1.1 500 Could not update record");
			exit();
		}
			
	}
	elseif (isset($_POST["SHOW_CAT"]) && strlen($_POST["SHOW_CAT"]) > 0) {
		
		$u_email 	  = mysqli_real_escape_string($db, $_SESSION['login_user']);
		$catTitle 	  = mysqli_real_escape_string($db, $_POST['SHOW_CAT']);
		$sql 		  = "SELECT C_TITLE,TITLE, DEFINITION FROM QUESTION WHERE U_EMAIL= '$u_email' AND C_TITLE='$catTitle'";
		$query 		  = mysqli_query($sql);

    	$reusult = mysqli_fetch_assoc($query);
    	echo json_encode($reusult);

		if (!mysqli_query($db,$sql)) {
			header("HTTP/1.1 500 Could not show record");
			exit();
		}
			
	}
	else {
    	//Output error
    	header('HTTP/1.1 500 Error occurred, Could not process request!');
    	exit();
    }
?>