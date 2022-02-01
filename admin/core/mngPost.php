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
	include("../class/Post.php");


	$database = new Database();
	$db = $database->getConnection();

	$post = new Post($db);

if(filter_input(INPUT_GET,"idToDel")){
	
	$idToDel = filter_input(INPUT_GET,"idToDel");
	
	$post->id=$idToDel;
	
	// delete the role
	if($post->delete()){
		header("Location: ../index.php?msg=postDelSucc");
		exit;
	
		// empty posted values
		// $_POST=array();
	
	}else{
		header("Location: ../index.php?msg=postDelErr");
		exit;
	}
}

if(filter_input(INPUT_POST,"subReg")){

	$operation=filter_input(INPUT_POST,"operation");
	if(!$_POST['title']||!$_POST['editor']||!$_POST['category_id']){
		header("Location: ../index.php?man=post&op=show&msg=postEmpty");
		exit;
	}

	if($operation=="add"){

		//inserimento
		$post->title=$_POST['title'];
		$post->content=$_POST['editor'];
		$post->category_id=$_POST['category_id'];
			
		// create the post
		if($post->insert()){
			header("Location: ../index.php?msg=postSucc");
			exit;
		
		
		}else{
			header("Location: ../index.php?msg=postErr");
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

