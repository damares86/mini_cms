<?php

// require '../phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));



session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../');
    exit;
}

	// loading class
	include("../class/Database.php");
	include("../class/User.php");


	$database = new Database();
	$db = $database->getConnection();

	$user = new User($db);

	$type = filter_input(INPUT_POST, "type");
	
	$user->id = $_POST['idToMod'];

	if(!$_POST['password']){
		header("Location: ../index.php?msg=pswEmpty");
		exit;
	}

	$user->password = $_POST['password'];

		// update the post
		if($user->updatePass()){
			header("Location: ../index.php?msg=userEditSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?msg=userEditErr");
			exit;
		}

		
exit;

?>