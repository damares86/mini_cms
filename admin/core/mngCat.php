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
	include("../class/Categories.php");


	$database = new Database();
	$db = $database->getConnection();

	$cat = new Categories($db);

if(filter_input(INPUT_GET,"idToDel")){
	
	$idToDel = filter_input(INPUT_GET,"idToDel");
	
	$cat->id=$idToDel;
	
	// delete the role
	if($cat->delete()){
		header("Location: ../index.php?msg=catDelSucc");
		exit;
		
	}else{
		header("Location: ../index.php?msg=catDelErr");
		exit;
	}
}

if(filter_input(INPUT_POST,"subReg")){

	$operation=filter_input(INPUT_POST,"operation");
	
	if(!$_POST['category_name']){
		header("Location: ../index.php?man=cat&op=show&msg=catEmpty");
		exit;
	}
	
	$cat->category_name=$_POST['category_name'];

	if($operation=="add"){
		//inserimento

		if($cat->catExists()){
			header("Location: ../index.php?msg=catExists");
		} else {

			$cat->category_name=$_POST['category_name'];
			
			// create the user
			if($cat->create()){
				header("Location: ../index.php?msg=catSucc");
				exit;
			
				// empty posted values
				// $_POST=array();
			
			}else{
				header("Location: ../index.php?msg=catErr");
				exit;
			}
		}
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

