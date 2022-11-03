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
	include("../class/Page.php");


	$database = new Database();
	$db = $database->getConnection();

	$page = new Page($db);


if(filter_input(INPUT_GET,"idToDel")){

	$idToDel = filter_input(INPUT_GET,"idToDel");
		
	$page->id_popup=$idToDel;

	if($page->deletePopup()){
		header("Location: ../index.php?man=page&op=show&type=popup&msg=popupDelSucc");
		exit;

	}else{
		header("Location: ../index.php?man=page&op=show&type=popup&msg=popupDelErr");
		exit;
	}
}

if(filter_input(INPUT_POST,"subReg")){

	$page->initPopupSessVar();
	
	if($_SESSION['error']!=0){
		header("Location: ../index.php?man=page&op=add&type=popup&more=yes&msg=pageDataMissing");
		exit;
	}
	
	$operation=filter_input(INPUT_POST,"operation");
	
	if($operation=="add"){
	
		$page->title_popup = $_POST['title'];
		$page->editor_popup = $_POST['editor1'];
		$page->page_popup = $_POST['pagename'];

		if($page->insertPopup()){
			header("Location: ../index.php?man=page&op=show&type=popup&msg=popupSucc");
			exit;
		}else{
			header("Location: ../index.php?man=page&op=show&type=popup&msg=popupErr");
			exit;
		}

	}else if($operation=="mod"){

		$page->id_popup=$_POST['idToMod'];
		$page->title_popup = $_POST['title'];
		$page->editor_popup = $_POST['editor1'];
		$page->page_popup = $_POST['pagename'];


		if($page->updatePopup()){
			header("Location: ../index.php?man=page&op=show&type=popup&msg=popupModSucc");
			exit;
		}else{
			header("Location: ../index.php?man=page&op=show&type=popup&msg=popupModErr");
			exit;
		}
	}
}else{
	header("Location: ../index.php?man=page&op=show&type=popup");
	exit;
}

