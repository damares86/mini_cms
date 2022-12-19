<?php

// require '../phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));


// loading class
spl_autoload_register('autoloader');
    function autoloader($class){
        include("../class/$class.php");
    }


$database = new Database();
$db = $database->getConnection();

include "../inc/class_initialize.php";


if(filter_input(INPUT_POST,"subRegCheck")){

	$settings->id=$_POST['id'];
	if(isset($_POST['dm'])){
		$settings->dm=0;
	}else{
		$settings->dm=1;
	}

	$settings->updateCheck();
	header('Location: ../../');
    exit;
}

session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../');
    exit;
}

if(filter_input(INPUT_GET,"idToDel")){
	$idToDel=filter_input(INPUT_GET,"idToDel");
	$contact->id=$idToDel;

	if($contact->delete()){
		header("Location: ../index.php?man=settings&msg=mailDelSucc");
		exit;
	}else{
		header("Location: ../index.php?man=settings&msg=mailDelErr");
		exit;
	}

}


if(filter_input(INPUT_POST,"subReg")){

		if(!$_POST['site_name']||!$_POST['site_description']){
			header("Location: ../index.php?man=settings&msg=settingsEmpty");
			exit;
		}

		if(isset($_POST['use_text'])){
			$settings->use_text = 1;
		}else{
			$settings->use_text = 0;
		}

		$settings->id=$_POST['id'];
		$settings->site_name=$_POST['site_name'];
		$settings->site_description=$_POST['site_description'];
		$settings->footer=$_POST['editor1'];
		$settings->dashboard_language=$_POST['language'];
		
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

	if(!$_POST['label']||!$_POST['email']){
		header("Location: ../index.php?man=settings&msg=contactEmpty");
		exit;
	}

	$contact->id=$_POST['id'];
	$contact->label=$_POST['label'];
	$contact->email=$_POST['email'];
	// update the settings
	if($contact->create()){
		header("Location: ../index.php?man=settings&msg=setMailSucc");
		exit;
	
		// empty posted values
		// $_POST=array();
	
	}else{
		header("Location: ../index.php?man=settings&msg=setMailErr");
		exit;
	}

}else if(filter_input(INPUT_POST,"subReset")){

	if(!$_POST['reset']){
		header("Location: ../index.php?man=settings&msg=contactEmpty");
		exit;
	}

	$contact->id=1;
	$contact->email=$_POST['reset'];
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
		header("Location: ../index.php?man=settings&msg=keyEmpty");
		exit;
	}

	$verify->id=$_POST['id'];
	$verify->active=0;
	
	$verify->updateActive();

	$verify->public=$_POST['public'];
	$verify->secret=$_POST['secret'];
	if($_POST['verify']){
		$verify->active=1;
	}

	// update the settings
	if($verify->update()){
		header("Location: ../index.php?man=settings&msg=setKeySucc");
		exit;
	
		// empty posted values
		// $_POST=array();
	
	}else{
		header("Location: ../index.php?man=settings&msg=setKeyErr");
		exit;
	}

} else if(filter_input(INPUT_POST,"subTheme")) {

	$settings->theme=$_POST['theme'];
		
		// update the settings
		if($settings->updateTheme()){
			header("Location: ../index.php?man=color&op=show&msg=setEditSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?man=color&op=show&msg=setEditErr");
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
}else if(filter_input(INPUT_POST,"subDestroy")){


	$query = "DROP TABLE `".$user->prx."accounts`, `".$user->prx."color`, `".$user->prx."files`, `".$user->prx."menu`, `".$user->prx."default_page`,`".$user->prx."page`, `".$user->prx."roles`, `".$user->prx."settings`, `".$user->prx."verify`, `".$user->prx."contacts`,`".$user->prx."password_reset_temp`,`".$user->prx."view_home`,`".$user->prx."plugins`";
    
	$stmt = $database->conn->prepare($query);

	$stmt->execute();
	header("Location: ../inc/func/regCheck.php?msg=destroyed");
	exit;
}else{
	header("Location: ../index.php?man=settings");
	exit;
}



?>


