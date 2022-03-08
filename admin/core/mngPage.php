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
	
	$page->id=$idToDel;
	$page->showById();

	$str=$page->page_name;
	$str = preg_replace('/\s+/', '_', $str);
	$str = strtolower($str);
	$filepath = "../../" . $str . ".php";

	if(unlink($filepath) || !file_exists(($filepath))){
		if($page->delete()){

			header("Location: ../index.php?msg=pageDelSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?msg=pageDelErr");
			exit;
		}
	} else {
		echo "file not deleted";
	}
}

if(filter_input(INPUT_POST,"subReg")){
	$operation=filter_input(INPUT_POST,"operation");

	if(!$_POST['page_name']||!$_POST['editor']){
		header("Location: ../index.php?man=page&op=show&msg=pageEmpty");
		exit;
	}

	
	if($operation=="add"){
	
		//inserimento
		$page->page_name=$_POST['page_name'];
		$page->layout=$_POST['layout'];
		$page->block1=$_POST['editor'];
		$page->block1_bg=$_POST['block1_bg'];
		$page->block1_text=$_POST['block1_text'];

		if($_POST['editor2']){
			$page->block2=$_POST['editor2'];
			$page->block2_bg=$_POST['block2_bg'];
			$page->block2_text=$_POST['block2_text'];
		}

		if($_POST['editor3']){
			$page->block3=$_POST['editor3'];
			$page->block3_bg=$_POST['block3_bg'];
			$page->block3_text=$_POST['block3_text'];
		}
		if($_POST['editor4']){
			$page->block4=$_POST['editor4'];
			$page->block4_bg=$_POST['block4_bg'];
			$page->block4_text=$_POST['block4_text'];
		}
		if($_POST['editor5']){
			$page->block5=$_POST['editor5'];
			$page->block5_bg=$_POST['block5_bg'];
			$page->block5_text=$_POST['block5_text'];
		}
	
		if($_POST['editor6']){
			$page->block6=$_POST['editor6'];
			$page->block6_bg=$_POST['block6_bg'];
			$page->block6_text=$_POST['block6_text'];
		}
		
		
		
		// create the page
		if($page->insert()){
			$str=$page->page_name;
			$str = preg_replace('/\s+/', '_', $str);
			
			$str = strtolower($str);

			if(copy('../template/master.php', '../../master.php')){
				rename('../../master.php','../../'. $str . '.php');
				chmod('../../'. $str . '.php',0777);
				header("Location: ../index.php?man=page&op=show&msg=pageSucc");
				exit;
			 } else {
				 echo "ko";
			 }
		
		}else{
			header("Location: ../index.php?msg=pageErr");
			exit;
		}
	} else if($operation=="mod"){
		$page->id=$_POST['idToMod'];
		$page->page_name=$_POST['page_name'];
		$page->layout=$_POST['layout'];
		$page->block1=$_POST['editor'];
		$page->block1_bg=$_POST['block1_bg'];
		$page->block1_text=$_POST['block1_text'];
		
		if($_POST['editor2']){
			$page->block2=$_POST['editor2'];
			$page->block2_bg=$_POST['block2_bg'];
			$page->block2_text=$_POST['block2_text'];
		}
		
		if($_POST['editor3']){
			$page->block3=$_POST['editor3'];
			$page->block3_bg=$_POST['block3_bg'];
			$page->block3_text=$_POST['block3_text'];
		}
		if($_POST['editor4']){
			$page->block4=$_POST['editor4'];
			$page->block4_bg=$_POST['block4_bg'];
			$page->block4_text=$_POST['block4_text'];
		}

		if($_POST['editor5']){
			$page->block5=$_POST['editor5'];
			$page->block5_bg=$_POST['block5_bg'];
			$page->block5_text=$_POST['block5_text'];
		}
	    if($_POST['editor6']){
			$page->block6=$_POST['editor6'];
			$page->block6_bg=$_POST['block6_bg'];
			$page->block6_text=$_POST['block6_text'];
		}


		

		// update the page
		if($page->update()){
			header("Location: ../index.php?msg=pageEditSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?msg=pageEditErr");
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

