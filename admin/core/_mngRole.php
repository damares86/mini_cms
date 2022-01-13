<?php

require "../../core/functions.php";
$conn=OpenConnection();


if(filter_input(INPUT_GET,"idToDel")){

	$idToDel = filter_input(INPUT_GET, "idToDel");


    if (DeleteRecord($conn,"roles",$idToDel)){

        header("Location: ../index.php?msg=delSucc&obj=role");
        exit;
    } else {
        header("Location: ../index.php?msg=delErr&obj=role");
        exit;
    }


} else if(filter_input(INPUT_POST,"subReg")){

	$operation=filter_input(INPUT_POST,"operation");
	

	// Make sure the submitted registration values are not empty.
	if (empty($_POST['rolename']) ) {
		// One or more values are empty.
		// exit('Please complete the registration form');
		header("Location: ../index.php?msg=emptyRole");
		exit;
	}

	if($operation=="mod"){
		$roleIDToMod=$_POST["idToMod"];
	
	
		
			if ($stmt = $conn->prepare('UPDATE roles SET rolename=? WHERE id=?')) {
			
			$stmt->bind_param('si', $_POST['rolename'], $roleIDToMod);
			$stmt->execute();
			//echo 'You have successfully registered, you can now login!';
			header("Location: ../index.php?msg=roleModSucc");
			} else {
				// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
				//echo 'Could not prepare statement!';
				header("Location: ../index.php?msg=stmtErr");
			}
	
	} else if($operation=="add"){

		// We need to check if the account with that username exists.
		if ($stmt = $conn->prepare('SELECT * FROM roles WHERE rolename = ?')) {
			// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
			$stmt->bind_param('s', $_POST['rolename']);
			$stmt->execute();
			$stmt->store_result();
			// Store the result so we can check if the account exists in the database.
			if ($stmt->num_rows > 0) {
				// Username already exists
				header("Location: ../index.php?msg=roleExist");
			} else {
				// Username doesnt exists, insert new account
				if ($stmt = $conn->prepare('INSERT INTO roles (rolename) VALUES (?)')) {
					$stmt->bind_param('s', $_POST['rolename']);
					$stmt->execute();
					
					header("Location: ../index.php?msg=roleSucc");
				} else {
					// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
					header("Location: ../index.php?msg=stmtErr");
				}

			}
		} else {
			header("Location: ../index.php?msg=roleErr");

		}
	}
}
?>