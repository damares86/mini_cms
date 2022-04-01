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
include("../class/Contact.php");
include("../class/Verify.php");


$database = new Database();
$db = $database->getConnection();

$settings = new Settings($db);
$menu = new Menu($db);
$contact = new Contact($db);
$verify = new Verify($db);


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
			header("Location: ../index.php?man=settings&msg=setEditSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?man=settings&msg=setEditErr");
			exit;
		}

} else if(filter_input(INPUT_POST,"subMail")){

	if(!$_POST['reset']||!$_POST['inbox']){
		header("Location: ../index.php?man=settings&msg=contactEmpty");
		exit;
	}

	$contact->id=$_POST['id'];
	$contact->reset=$_POST['reset'];
	$contact->inbox=$_POST['inbox'];
	// update the settings
	if($contact->update()){
		header("Location: ../index.php?man=settings&msg=setContactSucc");
		exit;
	
		// empty posted values
		// $_POST=array();
	
	}else{
		header("Location: ../index.php?man=settings&msg=setContactErr");
		exit;
	}

} else if(filter_input(INPUT_POST,"subKey")){

	if(!$_POST['public']||!$_POST['secret']){
		header("Location: ../index.php?man=settings&msg=contactEmpty");
		exit;
	}

	$verify->id=$_POST['id'];
	$verify->public=$_POST['public'];
	$verify->secret=$_POST['secret'];
	// update the settings
	if($verify->update()){
		header("Location: ../index.php?man=settings&msg=setKeySucc");
		exit;
	
		// empty posted values
		// $_POST=array();
	
	}else{
		header("Location: ../index.php?man=settings&msg=setCKeyErr");
		exit;
	}

} else if(filter_input(INPUT_POST,"subTheme")) {

	$settings->theme=$_POST['theme'];
		
		// update the settings
		if($settings->updateTheme()){
			header("Location: ../index.php?man=settings&msg=setEditSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?man=settings&msg=setEditErr");
			exit;
		}
}else if(filter_input(INPUT_POST,"subMenu")) {
	if(isset($_POST['idParent'])){
		
		$idParent=$_POST['idParent'];
		
		for($i=0; $i<count($idParent); $i++){
			$menu->id=$idParent[$i];
			$menu->parent=1;
			$menu->childof="none";
			
			if(isset($_POST["childofParent{$idParent[$i]}"])){
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

	if(isset($_POST['idChild'])){
		
		$idChild=$_POST['idChild'];
		
		for($i=0; $i<count($idChild); $i++){
			$menu->id=$idChild[$i];
			$menu->parent=0;
			$menu->childof=$_POST["childofChild{$idChild[$i]}"];
			if(isset($_POST["parentChild{$idChild[$i]}"])){
				$menu->parent=1;
				$menu->childof="none";
			}
			
			$order=$_POST["itemorderChild{$idChild[$i]}"];
			if(isset($_POST["orderChild{$idChild[$i]}"])){

				if(($_POST["orderChild{$idChild[$i]}"])=="upChild"){
					$order--;	
				} else if(($_POST["orderChild{$idChild[$i]}"])=="downChild"){
					$order++;
				} 
			}
			$menu->itemorder=$order;

			$inmenu=1;			
			if(isset($_POST["inmenuChild{$idChild[$i]}"])){
				$inmenu=0;
			}
			$menu->inmenu=$inmenu;
		
			$menu->update();

	}
}

if(isset($_POST['idNoMenu'])){
	
	$idNoMenu=$_POST['idNoMenu'];


	for($i=0; $i<count($idNoMenu); $i++){
		$menu->id=$idNoMenu[$i];
		if(isset($_POST["notInMenu{$idNoMenu[$i]}"])){
			$menu->inmenu=1;
			$menu->itemorder=1;
			$menu->parent=1;
			$menu->childof="none";

			$menu->update();
		}


	}

}

if(isset($_POST['idChildNone'])){

	$idChildNone=$_POST['idChildNone'];
		
	for($i=0; $i<count($idChildNone); $i++){
		$menu->id=$idChildNone[$i];
		$menu->parent=0;
		$menu->childof=$_POST["childNone{$idChildNone[$i]}"];
		// if(isset($_POST["parentChild{$idChild[$i]}"])){
		// 	$menu->parent=1;
		// 	$menu->childof="none";
		// }
		
		// $order=$_POST["itemorderChild{$idChild[$i]}"];
		// if(isset($_POST["orderChild{$idChild[$i]}"])){

		// 	if(($_POST["orderChild{$idChild[$i]}"])=="upChild"){
		// 		$order--;	
		// 	} else if(($_POST["orderChild{$idChild[$i]}"])=="downChild"){
		// 		$order++;
		// 	} 
		// }
		$menu->itemorder=1;

		// $inmenu=1;			
		// if(isset($_POST["inmenuChild{$idChild[$i]}"])){
		// 	$inmenu=0;
		// }
		$menu->inmenu=1;
	
		$menu->update();

}


}


	header("Location: ../index.php?man=menu");
	exit;
}else{
	header("Location: ../index.php?man=settings");
	exit;
}



?>


