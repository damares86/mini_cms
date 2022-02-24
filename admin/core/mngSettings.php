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
			$menu->parent=1;
			$menu->childof="index";
			
			if(isset($_POST['childofParent'])){
				$menu->parent=0;
			}
			
			$order=$_POST["itemorderParent{$idParent[$i]}"];
			
		
			if(isset($_POST["orderParent{$idParent[$i]}"])){

				if(($_POST["orderParent{$idParent[$i]}"])=="upParent"){
					$order=$order-1;	
			
					
				} else if(($_POST["orderParent{$idParent[$i]}"])=="downParent"){
					$order++;
				} 
			}
			$menu->itemorder=$order;

			$inmenu=1;			
			if(isset($_POST["inmenuParent{$idParent[$i]}"])){
				$inmenu=0;
			}
			$menu->inmenu=$inmenu;
		
			$menu->update();

	}
}


	header("Location: ../index.php?man=settings");
	exit;
}else{
	echo "errore settings";
	exit;
}

print_r("ko");
exit;

?>


