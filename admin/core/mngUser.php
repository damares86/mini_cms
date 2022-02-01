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
	include("../class/User.php");
	include("../class/Role.php");


	$database = new Database();
	$db = $database->getConnection();

	$user = new User($db);
	$role = new Role($db);

if(filter_input(INPUT_GET,"idToDel")){
	
	$idToDel = filter_input(INPUT_GET,"idToDel");
	
	$user->id=$idToDel;
	
	// delete the role
	if($user->delete()){
		header("Location: ../index.php?msg=userDelSucc");
		exit;
	
		// empty posted values
		// $_POST=array();
	
	}else{
		header("Location: ../index.php?msg=userDelErr");
		exit;
	}
}

if(filter_input(INPUT_POST,"subReg")){

	$operation=filter_input(INPUT_POST,"operation");


	if($operation=="add"){
	//inserimento
		if(!$_POST['email']||!$_POST['username']||!$_POST['password']||!$_POST['rolename']){
			header("Location: ../index.php?man=user&op=show&msg=userEmpty");
			exit;
		}

		$user->email=$_POST['email'];

		if($user->emailExists()){
			header("Location: ../index.php?msg=mailExists");
		} else {

			$roleArr=$_POST['rolename'];
			$rolename=$roleArr[0];

			// set values to object properties
			$user->username=$_POST['username'];
			$user->email=$_POST['email'];
			$user->password=$_POST['password'];
			$user->rolename=$rolename;
		
			
			// create the user
			if($user->create()){
				header("Location: ../index.php?msg=userSucc");
				exit;
			
			
			}else{
				header("Location: ../index.php?msg=userErr");
				exit;
			}
		}
	} else if($operation=="mod"){

		
		$user->id = $_POST['idToMod'];

		$roleArr=$_POST['rolename'];
		$rolename=$roleArr[0];

		$user->username = $_POST['username'];
		$user->email = $_POST['email'];
		$user->rolename = $rolename;

		// update the post
		if($user->update()){
			header("Location: ../index.php?msg=userEditSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?msg=userEditErr");
			exit;
		}
		
	}
	

} else {
	echo "errore post";
	exit;
}


exit;

?>


