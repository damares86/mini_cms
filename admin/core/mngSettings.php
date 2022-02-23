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
include("../class/Settings.php");
include("../class/Menu.php");


$database = new Database();
$db = $database->getConnection();

$settings = new Settings($db);
$menu = new Menu($db);


if(filter_input(INPUT_POST,"subReg")){
		if(!$_POST['site_name']||!$_POST['site_description']){
			header("Location: ../index.php?man=settings&msg=settingsEmpty");
			exit;
		}

		$settings->id=$_POST['id'];
		$settings->site_name=$_POST['site_name'];
		$settings->site_description=$_POST['site_description'];
		$settings->theme=$_POST['theme'];
		
		// update the settings
		if($settings->update()){
			header("Location: ../index.php?msg=setEditSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?msg=setEditErr");
			exit;
		}

} else if(filter_input(INPUT_POST,"subTheme")) {

	$settings->theme=$_POST['theme'];
		
		// update the settings
		if($settings->updateTheme()){
			header("Location: ../index.php?msg=setEditSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?msg=setEditErr");
			exit;
		}
}else if(filter_input(INPUT_POST,"subMenu")) {
	$allID=$_POST['id'];
	for($i=0; $i<count($allID); $i++){
				
		echo $allID[$i];
	}
	exit;
}else{
	echo "errore settings";
	exit;
}


exit;

?>


