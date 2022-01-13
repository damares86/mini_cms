<?php

require "../../core/functions.php";
$conn=OpenConnection();


if(filter_input(INPUT_POST,"subName")){
	
	
			if ($stmt = $conn->prepare('UPDATE admin SET username=? WHERE id=1')) {
			
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
		
			header("Location: ../index.php?msg=adminModSucc");
			} else {
				// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
				//echo 'Could not prepare statement!';
				header("Location: ../index.php?msg=stmtErr");
			}
	
	} else if(filter_input(INPUT_POST,"subPass")) {
	
		
		if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
			// exit('Password must be between 5 and 20 characters long!');
			header("Location: ../../index.php?msg=passErr");
	
		}
		
		if ($stmt = $conn->prepare('UPDATE admin SET password=? WHERE id=1')) {
		
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$stmt->bind_param('s', $password);
			$stmt->execute();

			header("Location: ../index.php?msg=passAdminModSucc");

		} else {
				// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
				//echo 'Could not prepare statement!';
				header("Location: ../index.php?msg=stmtErr");
			}

	}  else {
			header("Location: ../index.php?msg=adminErr");
		}
	

?>