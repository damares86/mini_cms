<?php

// require '../vendor/autoload.php';		// If installed via composer
// $debug = new \bdk\Debug(array(
// 	'collect' => true,
// 	'output' => true,
// ));


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
	
	$user->id=$idToDel;
	
	// delete the role
	if($user->delete()){
		header("Location: ../index.php?man=users&op=show&msg=userDelSucc");
		exit;
	
		// empty posted values
		// $_POST=array();
	
	}else{
		header("Location: ../index.php?man=users&op=show&msg=userDelErr");
		exit;
	}
}

if(filter_input(INPUT_POST,"subReg")){

	$operation=filter_input(INPUT_POST,"operation");


	if($operation=="add"){
	//inserimento
		if(!$_POST['email']||!$_POST['username']||!$_POST['password']||!$_POST['rolename']){
			header("Location: ../index.php?man=users&op=show&msg=userEmpty");
			exit;
		}

		$user->email=$_POST['email'];

		if($user->emailExists()){
			header("Location: ../index.php?man=users&op=show&msg=mailExists");
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
				header("Location: ../index.php?man=users&op=show&msg=userSucc");
				exit;
			
			
			}else{
				header("Location: ../index.php?man=users&op=show&msg=userErr");
				exit;
			}
		}
	} else if($operation=="mod"){

		
		$user->id = $_POST['idToMod'];
		if($user->id!=1){
			$roleArr=$_POST['rolename'];
			$rolename=$roleArr[0];
			$user->rolename = $rolename;
		}
		$user->username = $_POST['username'];
		$user->email = $_POST['email'];

		// update the post
		if($user->update()){
			header("Location: ../index.php?man=users&op=show&msg=userEditSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?man=users&op=show&msg=userEditErr");
			exit;
		}
		
	}
	

} else {
	header("Location: ../index.php?man=users&op=show&msg=userErr");
	exit;
}


exit;

?>


