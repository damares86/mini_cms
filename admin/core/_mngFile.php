<?php

require "../../core/functions.php";
$conn=OpenConnection();

if(filter_input(INPUT_GET,"idToDel")){
	
	$idToDel = filter_input(INPUT_GET, "idToDel");
	$fileToDel=GetDataById($conn, "files",$idToDel);
	$filenameToDel=$fileToDel['filename'];
	$filepath='../../file/'.$filenameToDel;
	
	if(unlink($filepath)){
		if (DeleteRecord($conn,"files",$idToDel)){		
			header("Location: ../index.php?msg=delSucc&obj=file");
			exit;
		
		} else {
			header("Location: ../index.php?msg=delErr&obj=file");
			exit;
		}
	} else {
		header("Location: ../index.php?msg=delErr&obj=file1");
	}


} else if(filter_input(INPUT_POST,"subReg")){
	
	$operation=filter_input(INPUT_POST,"operation");
		
	
	// Make sure the submitted registration values are not empty.
	if (empty($_POST['title']) || empty($_FILES['myfile']) || empty($_POST['rolename'])) {
		// One or more values are empty.
		// exit('Please complete the registration form');
		header("Location: ../index.php?msg=empty");
	}

	
		$filename = $_FILES['myfile']['name'];
	
		// destination of the file on the server
		$destination = '../../file/' . $filename;
		
		// get the file extension
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		
		// the physical file on a temporary uploads directory on the server
		$file = $_FILES['myfile']['tmp_name'];
		$title=$_POST['title'];		
		$roleArr=$_POST['rolename'];
		$roleID=$roleArr[0];
	
		if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
			echo "You file extension must be .zip, .pdf or .docx";
		} elseif ($_FILES['myfile']['size'] > 1000000) { // <-- CHOOSE THE MAXIMUM FILE SIZE (EXPRESSED IN BYTE)
			echo "File too large!";
		} else {
        // move the uploaded (temporary) file to the specified destination

			if (move_uploaded_file($file, $destination)) {
				
				$sql = "INSERT INTO files (filename, title, role_id) VALUES ('$filename','$title', '$roleID')";

				if (mysqli_query($conn, $sql)) {
					header('Location: ../index.php?msg=fileSucc');
				}
			} else {
				echo "Failed to upload file.";
			}
    	}
 
		$conn->close();
	} else {
	echo "Something wrong";
}


?>