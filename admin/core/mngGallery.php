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

if(filter_input(INPUT_GET,"gallToDel")){
	function removeFolder($folderName) {
			if (is_dir($folderName))
			$folderHandle = opendir($folderName);

			if (!$folderHandle){
				header("Location: ../index.php?man=gall&op=show&msg=gallDelSucc");
				exit;
			}

			while($file = readdir($folderHandle)) {
				if ($file != "." && $file != "..") {
						if (!is_dir($folderName."/".$file))
							unlink($folderName."/".$file);
						else
							removeFolder($folderName.'/'.$file);
				}
			}
			closedir($folderHandle);
			rmdir($folderName);
			header("Location: ../index.php?man=gall&op=show&msg=gallNotDel");
			exit;

	}
	$gallToDel = filter_input(INPUT_GET,"gallToDel");
	$folderName="../../uploads/gallery/$gallToDel";
	removeFolder($folderName);
}

if(filter_input(INPUT_POST,"subReg")){

	if(!$_POST['title']){
		header("Location: ../index.php?man=gall&op=add&msg=gallTitleErr");
		exit;
	}

	if ($_FILES['file']['size'] == 0 ){
		header("Location: ../index.php?man=gall&op=add&msg=gallFileErr");
		exit;
	}

	$gallery = $_POST['title'];
	$dir = preg_replace('/\s+/', '_', $gallery);	
	$dir = strtolower($dir);
	$target_directory = "../../uploads/gallery/$dir/";

	mkdir($target_directory, 0777, true);
	
	$countfiles = count($_FILES['file']['name']);

    for($i=0;$i<$countfiles;$i++){

		// controllo formato
		$target_file = $target_directory . $_FILES['file']['name'][$i];
		$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
		$file_upload_error_messages="";
		$allowed_file_types=array("jpg", "JPG", "jpeg", "png");
		if(!in_array($file_type, $allowed_file_types)){
			rmdir($target_directory);
			header("Location: ../index.php?man=gall&op=add&msg=formatErr");
			exit;
			// $file_upload_error_messages.="<div>Only .zip, .doc, .docx,.pdf files are allowed.</div>";
			//exit;
		}
		$filename = $_FILES['file']['name'][$i];

		$temp = explode(".", $filename);
		if($i<10){
			$newfilename = $dir . '_0'. $i . '.' . end($temp);
		} else {
			$newfilename = $dir . '_' . $i . '.' . end($temp);
		}
        $target_file=$target_directory.$newfilename;
	
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

