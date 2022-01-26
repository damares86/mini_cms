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
	include("../class/Role.php");


	$database = new Database();
	$db = $database->getConnection();

	$role = new Role($db);

if(filter_input(INPUT_GET,"idToDel")){
	
	$idToDel = filter_input(INPUT_GET,"idToDel");
	
	$role->id=$idToDel;
	
	// delete the role
	if($role->delete()){
		header("Location: ../index.php?msg=roleDelSucc");
		exit;
	
		// empty posted values
		// $_POST=array();
	
	}else{
		header("Location: ../index.php?msg=roleDelErr");
		exit;
	}
}

if(filter_input(INPUT_POST,"subReg")){


	//inserimento
	$role->rolename=$_POST['rolename'];

	if($role->roleExists()){
        header("Location: ../index.php?err=roleExists");
    } else {

		$role->rolename=$_POST['rolename'];
		
		// create the user
		if($role->create()){
			header("Location: ../index.php?msg=roleSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?msg=roleErr");
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

