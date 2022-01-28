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

	if(unlink($filepath)){
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

	
	if($operation=="add"){
		//inserimento
		$page->page_name=$_POST['page_name'];
		$page->block1=$_POST['editor'];
		$page->block1_bg=$_POST['block1_bg'];

		if($_POST['editor2']){
			$page->block2=$_POST['editor2'];
			$page->block2_bg=$_POST['block2_bg'];
		}

		if($_POST['editor3']){
			$page->block3=$_POST['editor3'];
			$page->block3_bg=$_POST['block3_bg'];
		}
		if($_POST['editor4']){
			$page->block4=$_POST['editor4'];
			$page->block4_bg=$_POST['block4_bg'];
		}
		
		// create the page
		if($page->insert()){
			$str=$page->page_name;
			$str = preg_replace('/\s+/', '_', $str);
			
			$str = strtolower($str);
			

			if(copy('../themes/dm_theme/master.php', '../../master.php')){
				rename('../../master.php','../../'. $str . '.php');
				chmod('../../'. $str . '.php',0777);
				header("Location: ../index.php?man=page&op=show&msg=pageSucc");
				exit;
			 } else {
				 echo "ko";
			 }




			header("Location: ../index.php?msg=pageSucc");
			exit;
		
		
		}else{
			header("Location: ../index.php?msg=pageErr");
			exit;
		}
	} else if($operation=="mod"){
			
		// modifica post
			$post->title=$_POST['title'];
			$post->content=$_POST['editor'];
			$post->category_id=$_POST['category_id'];
			$post->id=$_POST['idToMod'];
				
			// update the post
			if($post->update()){
				header("Location: ../index.php?msg=postEditSucc");
				exit;
			
				// empty posted values
				// $_POST=array();
			
			}else{
				header("Location: ../index.php?msg=postEditErr");
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
