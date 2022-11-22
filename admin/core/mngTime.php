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
	include("../class/Time.php");


	$database = new Database();
	$db = $database->getConnection();

	$time = new Time($db);

if(filter_input(INPUT_POST,"subReg")){

	// $editor = preg_replace('/\s+/', '', $_POST['editor']);
	// $editor2 = preg_replace('/\s+/', '', $_POST['editor2']);

	$time->id=1;
	$time->mass=$_POST['editor'];
	$time->office=$_POST['editor2'];
	if($time->update()){
		
		header("Location: ../index.php?man=time&op=show&msg=timeSucc");
		exit;
	}else{
		header("Location: ../index.php?man=time&op=show&msg=timeErr");
		exit;
	}
	
} else {
	echo "errore time";
	exit;
}


exit;

?>

