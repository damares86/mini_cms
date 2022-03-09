<?php

require '../phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));



session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../');
    exit;
}

	// loading class
	include("../class/Database.php");
	include("../class/File.php");


	$database = new Database();
	$db = $database->getConnection();

	$file = new File($db);

if(filter_input(INPUT_GET,"idToDel")){
	
	$idToDel = filter_input(INPUT_GET,"idToDel");
	
	$file->id=$idToDel;

	$file->showById();
	
	$filename = $file->filename;

	$filepath = "../../uploads/". $filename ."";
	
	if(unlink($filepath) || !file_exists(($filepath))){
		if($file->delete()){
			header("Location: ../index.php?msg=fileDelSucc");
			exit;
			
		}else{
			header("Location: ../index.php?msg=fileDelErr");
			exit;
		}
	}else{
		header("Location: ../index.php?msg=fileNotDel");
		exit;
	}
}

if(filter_input(INPUT_POST,"subReg")){

	$operation=filter_input(INPUT_POST,"operation");

	if($operation=="bck"){
				/* Get the name of the file uploaded to Apache */
		$filename = $_FILES['file']['name'];


		/* Prepare to save the file upload to the upload folder */
		$location = "../../../uploaded/".$filename;
	

		/* Permanently save the file upload to the upload folder */
		if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
			header("Location: ../index.php?man=bckfiles&op=show&msg=bckFileSucc&name=$filename");
			exit;
		} else { 
			header("Location: ../index.php?man=bckfiles&op=show&msg=bckFileErr");
			exit;
		}

	}
	
	if((!$_POST['title'])){
		header("Location: ../index.php?man=partfiles&op=show&msg=fileTitleEmpty");
		exit;
	}
	
	if ($_FILES['myfile']['size'] == 0 && $_FILES['myfile']['error'] == 0){
	// if(empty($_FILES['myfile'])){
		header("Location: ../index.php?man=partfiles&op=show&msg=fileEmpty");
		exit;
	}


	if($operation=="add"){

		//inserimento

		// if($cat->catExists()){
		// 	header("Location: ../index.php?msg=catExists");
		// } else {

			$file->file=$_FILES['myfile']['tmp_name'];
			$file->title=$_POST['title'];
			$file->filename=$_FILES['myfile']['name'];
			$file->category_id=$_POST['category_id'];
		
		
			// create the user
			if($file->uploadFile()){
				header("Location: ../index.php?msg=fileSucc");
				exit;
			
				// empty posted values
				// $_POST=array();
			
			}else{
				header("Location: ../index.php?msg=fileErr");
				exit;
			}
		// }
	} else if($operation=="mod"){

		$cat->id = $_POST['idToMod'];

		// update the post
		if($cat->update()){
			header("Location: ../index.php?msg=catEditSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?msg=catEditErr");
			exit;
		}



	}
	


	// MODIFICA UTENTE



} else {
	echo "errore post";
	exit;
}


exit;

?>

