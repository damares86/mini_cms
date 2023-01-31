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

spl_autoload_register('autoloader');
    function autoloader($class){
        include("../class/$class.php");
    }


$database = new Database();
$db = $database->getConnection();

include "../inc/class_initialize.php";

if(filter_input(INPUT_GET,"idToDel")){
	
	$idToDel = filter_input(INPUT_GET,"idToDel");
	
	$colors->id=$idToDel;
	
	// delete the role
	if($colors->delete()){
		header("Location: ../index.php?man=color&op=show&msg=colorDelSucc");
		exit;
	
		// empty posted values
		// $_POST=array();
	
	}else{
		header("Location: ../index.php?man=color&op=show&msg=colorDelErr");
		exit;
	}
}

if(filter_input(INPUT_POST,"subReg")){

	if(!$_POST['color']){
		header("Location: ../index.php?man=color&op=show&msg=colorEmpty");
		exit;
	}

	$colors->color=$_POST['color'];
	
	// create the user
	if($colors->create()){
		header("Location: ../index.php?man=color&op=show&msg=colorSucc");
		exit;
	
		// empty posted values
		// $_POST=array();
	
	}else{
		header("Location: ../index.php?man=color&op=show&msg=colorErr");
		exit;
	}
} else {
	header("Location: ../index.php?man=color&op=show&msg=colorErr");
		exit;
}


exit;

?>

