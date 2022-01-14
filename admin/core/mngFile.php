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
	
	$idToDel = filter_input(INPUT_GET, "idToDel");

	$file->id = $idToDel;
	$stmt=$file->showById($idToDel);

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
		extract($row);
		
		$filepath='../../uploads/file/'.$filename;
	
		if(unlink($filepath)){
			
			if ($file->delete($idToDel)){		
				header("Location: ../index.php?msg=delSucc&obj=file");
				exit;
			
			} else {
				header("Location: ../index.php?msg=delErr&obj=file");
				exit;
			}
		
		} else {
			header("Location: ../index.php?msg=delErr&obj=file1");
		}

	}
} 

 if(filter_input(INPUT_POST,"subReg")){


	
	$doc=!empty($_FILES["myfile"]["name"])
          // ? sha1_file($_FILES['myfile']['tmp_name']) . "-" . basename($_FILES["myfile"]["name"]) : "";
		  ? basename($_FILES["myfile"]["name"]) : "";
	$title=$_POST['title'];

	$file->file = $doc;
	$file->title = $title;
	$file->filename = $_FILES["myfile"]["name"];

	
	if($file->uploadFile()){
		echo "file caricato";
		exit;
	} else {
		echo "file non caricato";
		exit;
	}
		
	} else {
	echo "Something wrong";
	exit;
}


?>