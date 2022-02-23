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
	if($_POST['idParent']){

		$idParent=$_POST['idParent'];

		for($i=0; $i<count($idParent); $i++){

		$menu->id=$idParent[$i];
		$inmenu="";
		
		if(isset($_POST['inmenuParent'])){
			$inmenu=0;
		} else{
			$inmenu=1;
		}

		$menu->inmenu=$inmenu;
		$menu->childof=$_POST['childof'];
		
		$menu->itemorder=$_POST['itemorderParent'];
		print_r($_POST['itemorderParent']);
		exit;
		
		// if($_POST['inmenu']!=1){
		// 	$menu->inmenu=0;
		// }else{
		// 	$menu->inmenu=$_POST['inmenu'];
			
		// }
		// if($_POST['parent']!=1){
		// 	$menu->parent=0;
		// }else{
		// 	$menu->parent=$_POST['parent'];
		
		// }
		// if($_POST['childof']){
		// 	$menu->childof=$_POST['childof'];
		// 	print_r($menu->childof);
		// 	exit;
		
		// }
	}
}
		if($menu->update()){
			header("Location: ../index.php?man=settings&msg=menuEditSucc");
			exit;
		}else{
			header("Location: ../index.php?man=settings&msg=menuEditErr");
			exit;
		}
	exit;
}else{
	echo "errore settings";
	exit;
}


exit;

?>


