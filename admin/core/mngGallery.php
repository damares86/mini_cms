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
			
		}
		$gallToDel = filter_input(INPUT_GET,"gallToDel");
		$folderName="../../misc/gallery/img/$gallToDel/";
		removeFolder($folderName);
			if(unlink("../../misc/gallery/$gallToDel.php")){
				header("Location: ../index.php?man=gall&op=show&msg=pageGallDel");
				exit;
			}else{
				header("Location: ../index.php?man=gall&op=show&msg=pageGallNotDel");
				exit;
			}
		header("Location: ../index.php?man=gall&op=show&msg=gallNotDel");
		exit;
		

}else  if(filter_input(INPUT_GET, "imgToDel")){

	$imgName = filter_input(INPUT_GET, "imgToDel");
	$gall = filter_input(INPUT_GET, "gall");
	$filepath = "../../misc/gallery/img/$gall/$imgName";
	
	if(unlink($filepath) || !file_exists(($filepath))){
		header("Location: ../index.php?man=gall&op=edit&name=$gall&msg=imgDelSucc");
		exit;
	}else{
		header("Location: ../index.php?man=gall&op=show&msg=imgNotDel");
		exit;
	}


}

if(filter_input(INPUT_POST,"subReg")){

	if(filter_input(INPUT_POST,"gall")){

		$gall = filter_input(INPUT_POST,"gall");
		$path="../../misc/gallery/img/$gall";
		$files = scandir($path, SCANDIR_SORT_DESCENDING);
		$newest_file = $files[0];

		$filename = explode(".", $newest_file);
		$temp = explode("_",$filename[0]);
		$number = end($temp);
		$temp2 = str_split($number);
		$i = "";

		if($temp2[0]==0){
			$i = $temp2[1]+1;
		}else{
			$i = $number+1;
		}

		$target_directory = "../../misc/gallery/img/$gall/";

		$target_file = $target_directory . $_FILES['file']['name'];
		$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
		$file_upload_error_messages="";
		$allowed_file_types=array("jpg", "JPG", "jpeg", "png");
		if(!in_array($file_type, $allowed_file_types)){
			header("Location: ../index.php?man=gall&op=edit&name=$gall&msg=formatErr");
			exit;
			// $file_upload_error_messages.="<div>Only .zip, .doc, .docx,.pdf files are allowed.</div>";
			//exit;
		}
		$filename = $_FILES['file']['name'];

		$temp = explode(".", $filename);
		if($i<10){
			$newfilename = $gall . '_0'. $i . '.' . end($temp);
		} else {
			$newfilename = $gall . '_' . $i . '.' . end($temp);
		}
        $target_file=$target_directory.$newfilename;
	
        move_uploaded_file($_FILES['file']['tmp_name'],$target_file);
		chmod($target_file, 0777);
		

		header("Location: ../index.php?man=gall&op=edit&name=$gall&msg=imgSucc");
		exit;

	}else{

	if(!$_POST['title']){
		header("Location: ../index.php?man=gall&op=add&msg=gallTitleErr");
		exit;
	}

	if ($_FILES['file']['size'] == 0 ){
		header("Location: ../index.php?man=gall&op=add&msg=gallFileErr");
		exit;
	}

	$path="../../misc/gallery/img/";
	if(!is_dir($path)){
		$oldmask = umask(0);
		mkdir($path,0777,true);
		umask($oldmask);
	}

	$gallery = $_POST['title'];
	$dir = preg_replace('/\s+/', '_', $gallery);	
	$dir = strtolower($dir);
	$target_directory = $path.$dir.'/';
	
	$oldmask = umask(0);
	mkdir($target_directory, 0777, true);
	umask($oldmask);
	
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


		if(copy('../template/gallery.php', '../../misc/gallery/gallery.php')){
			rename('../../misc/gallery/gallery.php','../../misc/gallery/'.$dir. '.php');
			
			$page='../../misc/gallery/'.$dir. '.php';
			chmod($page,0777);

			header("Location: ../index.php?man=gall&op=show&msg=gallSucc");
			exit;
		} else {
			header("Location: ../index.php?man=gall&op=show&msg=gallErr");
			exit;
		}
		// header("Location: ../index.php?man=gall&op=show&msg=gallSucc");
		// exit;
	}
} else {
	header("Location: ../index.php?man=gall&op=show&msg=gallErr");
	exit;
}


exit;

?>

