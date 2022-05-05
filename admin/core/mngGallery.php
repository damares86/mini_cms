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
			header("Location: ../index.php?man=files&op=show&msg=fileDelSucc");
			exit;
			
		}else{
			header("Location: ../index.php?man=files&op=show&msg=fileDelErr");
			exit;
		}
	}else{
		header("Location: ../index.php?man=files&op=show&msg=fileNotDel");
		exit;
	}
}

if(filter_input(INPUT_POST,"subReg")){

	$file->gallery_title = $_POST['title'];
	$dir = $_POST['title'];
	$target_directory = "../../uploads/$dir/";

	mkdir($target_directory, 0777, true);

	$countfiles = count($_FILES['file']['name']);
    for($i=0;$i<$countfiles;$i++){
        $filename = $_FILES['file']['name'][$i];
        $target_file=$target_directory.$filename;
        move_uploaded_file($_FILES['file']['tmp_name'][$i],$target_file);
		chmod($target_file, 0777);

    }
	header("Location: ../index.php?man=gall&op=show&msg=gallSucc");
	exit;

} else {
	header("Location: ../index.php?man=gall&op=show&msg=gallErr");
	exit;
}


exit;

?>

