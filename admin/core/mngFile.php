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
	spl_autoload_register('autoloader');
    function autoloader($class){
        include("../class/$class.php");
    }


$database = new Database();
$db = $database->getConnection();

include "../inc/class_initialize.php";


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

	$operation=filter_input(INPUT_POST,"operation");
	
	if($operation=="add"){
		
		if((!$_POST['title'])){
			header("Location: ../index.php?man=files&op=show&msg=fileTitleEmpty");
			exit;
		}
		
		if ($_FILES['myfile']['size'] == 0 ){
			header("Location: ../index.php?man=files&op=show&msg=fileEmpty");
			exit;
		}
		
		
		
		
		//insert
		$file->operation = "add";
		$file->file=$_FILES['myfile']['tmp_name'];
		$file->title=$_POST['title'];
		$file->filename=$_FILES['myfile']['name'];
		

		
			if($file->uploadFile()){
				header("Location: ../index.php?man=files&op=show&msg=fileSucc");
				exit;
			
				// empty posted values
				// $_POST=array();
			
			}else{
				header("Location: ../index.php?man=files&op=show&msg=fileErr");
				exit;
			}
		 }else if($operation=="edit"){
			
			$file->operation = "edit";
			$file->id=$_POST['idToMod'];
			if((!$_POST['title'])){
				header("Location: ../index.php?man=files&op=show&msg=fileTitleEmpty");
				exit;
			}
			$file->title=$_POST['title'];

			if($file->update()){
				if(isset($_POST['fileSel'])){

					$idToDel = filter_input(INPUT_POST,"idToMod");
		
					$file->id=$idToDel;

					$file->showById();
					
					$filename = $file->filename;

					$filepath = "../../uploads/". $filename ."";
					
					if(unlink($filepath) || !file_exists(($filepath))){
							if ($_FILES['myfile']['size'] == 0 ){
								header("Location: ../index.php?man=files&op=show&msg=fileEmpty");
								exit;
							}
							$file->file=$_FILES['myfile']['tmp_name'];
							$file->title=$_POST['title'];
							$file->filename=$_FILES['myfile']['name'];
						
						
							if($file->uploadFile()){
								header("Location: ../index.php?man=files&op=show&msg=fileModSucc");
								exit;
							
								// empty posted values
								// $_POST=array();
							
							}else{
								header("Location: ../index.php?man=files&op=show&msg=fileModErr");
								exit;
							}
							

					}else{
						header("Location: ../index.php?man=files&op=show&msg=fileModNotDel");
						exit;
					}
				}else{
					header("Location: ../index.php?man=files&op=show&msg=fileModTitleSucc");
					exit;	
				}
				}else{
					header("Location: ../index.php?man=files&op=show&msg=fileModTitleErr");
					exit;
			}


		 }



} else {
	header("Location: ../index.php?man=files&op=show&msg=fileErr");
	exit;
}


exit;

?>

