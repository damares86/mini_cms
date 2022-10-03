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
	include("../class/Page.php");
	include("../class/Menu.php");


	$database = new Database();
	$db = $database->getConnection();

	$page = new Page($db);
	$menu = new Menu($db);

	if(filter_input(INPUT_GET,"idToDel")){
	
			$idToDel = filter_input(INPUT_GET,"idToDel");
			
			$page->id=$idToDel;
			$page->showById();
			$menu->pagename=$page->page_name;
			
			$str=$page->page_name;
			$str = preg_replace('/\s+/', '_', $str);
			$str = strtolower($str);
			$filepath = "../../" . $str . ".php";
		
		
			if(unlink($filepath) || !file_exists(($filepath))){
					if($page->delete()){
						header("Location: ../index.php?man=page&op=show&type=custom&msg=pageDelSucc");
						exit;
			
					}else{
						header("Location: ../index.php?man=page&op=show&type=custom&msg=pageDelErr");
						exit;
					}

			} else {
				echo "file not deleted";
			}
		}




if(filter_input(INPUT_POST,"addBlock")){
	$counter=filter_input(INPUT_POST,"counter");
	$operation=filter_input(INPUT_POST,"operation");
	if($operation=="mod"){
		$op="edit";
	}else{
		$op="add";
	}
	$idText="";
	if(filter_input(INPUT_POST,"idToMod")){
		$id=filter_input(INPUT_POST,"idToMod");
		$idText="&idToMod=$id";
	}
	
	$page->initCheckSessVar();
	
	$msg="";
	if($_SESSION['error']!=0){
		$msg="&msg=pageDataMissing";
	}

	$counter++;
	$_SESSION['counter']=$counter;
	
	header("Location: ../index.php?man=page&op=$op&type=custom$idText&count=$counter&more=yes$msg");
	exit;


}else if(filter_input(INPUT_POST,"rmBlock")){
	$counter=filter_input(INPUT_POST,"counter");
	$operation=filter_input(INPUT_POST,"operation");
	if($operation=="mod"){
		$op="edit";
	}else{
		$op="add";
	}
	$idText="";
	if(filter_input(INPUT_POST,"idToMod")){
		$id=filter_input(INPUT_POST,"idToMod");
		$idText="&idToMod=$id";
	}

	$page->initCheckSessVar();

	$counter--;
	$_SESSION['counter']=$counter;

	
	$msg="";
	if($_SESSION['error']!=0){
		$msg="&msg=pageDataMissing";
	}

	
	header("Location: ../index.php?man=page&op=$op&type=custom$idText&count=$counter&more=yes$msg");
	exit;

}else if(filter_input(INPUT_GET,"op")){

	$idToCopy=filter_input(INPUT_GET,"idToMod");

	$page->id=$idToCopy;

	$page->showById();

	$name =$page->page_name;
	$name = preg_replace('/\s+/', '_', $name);
	$name = strtolower($name);

	if(copy('../../'.$name.'.php', '../../'.$name.'_copy.php')){
		chmod('../../'.$name.'_copy.php',0777);
			$page->copyPage();

			header("Location: ../index.php?man=page&op=show&type=custom&msg=pageCopySucc");
			exit;
		}else {
			header("Location: ../index.php?man=page&op=show&type=custom&msg=pageCopyErr");
			exit;
		 }

}else if(filter_input(INPUT_POST,"subReg")){

	$type=filter_input(INPUT_POST,"type");

	if($type=="default"){

		$page->type=filter_input(INPUT_POST,"type");

		$idToMod=filter_input(INPUT_POST,"idToMod");

		$page->id=$idToMod;

		$page->page_name=$_POST['page_name'];
		if(isset($_POST['use_name'])){
			$page->use_name=1;
		}else{
			$page->use_name=0;
		}

		if(isset($_POST['use_desc'])){
			$page->use_desc=1;
		}else{
			$page->use_desc=0;
		}

		if(isset($_POST['visualSel'])){
			$page->header=1;
		}else{
			$page->header=0;
		}
		
		if($_FILES['myfile']['name']){
			$page->img=$_FILES['myfile']['name'];
		}else{
			$query1="SELECT * FROM default_page WHERE page_name = :page_name LIMIT 0,1";
			$stmt1 = $db->prepare($query1);
			$stmt1->bindParam(':page_name', $page->page_name);       
			$stmt1->execute();
			$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
			$page->img=$row1['img'];
		}

		if($page->update()){
			header("Location: ../index.php?man=page&op=show&type=default&msg=pageEditSucc");
			exit;
		}else{
			header("Location: ../index.php?man=page&op=show&type=default&msg=pageEditErr");
			exit;
		}



	}


	$counter=filter_input(INPUT_POST,"counter");

	$page->initCheckSessVar();
	
	if($_SESSION['error']!=0){
		header("Location: ../index.php?man=page&op=add&type=custom&count=$counter&more=yes&msg=pageDataMissing");
		exit;
	}

	$page->type=$_POST['type'];
	
	$operation=filter_input(INPUT_POST,"operation");

	if($operation=="add"){
		$page->page_name = $_SESSION['sess_page_name'];

		if(isset($_SESSION['sess_img'])){
			$page->img=$_SESSION['sess_img'];
		}else{
			$page->img="visual.jpg";
		}

		$page->no_mod=$_SESSION['sess_no_mod'];
		$page->layout=$_SESSION['sess_layout'];
		$page->header=$_SESSION['sess_header'];
		$page->use_name=$_SESSION['sess_use_name'];
		$page->use_desc=$_SESSION['sess_use_desc'];
		$page->counter=$_POST['counter'];

		$arr0=array(
			"name"		=> $_SESSION['sess_page_name']
		);

		for($i=1;$i<=$counter;$i++){
			$sess_type="sess_type_$i";
			$sess_bg="sess_bg_$i";
			$sess_text="sess_text_$i";
			$array_name="arr$i";



			if($_SESSION["$sess_type"]=="p"){
				if($_SESSION['sess_pict_'.$i.'']){
					$page->img_pict=$_SESSION['sess_pict_'.$i.''];
					$page->img_tmp_pict=$_SESSION['sess_pict_'.$i.'_tmp'];
				}else{
					$page->img_pict=$_FILES['pict'.$i.'']['name'];
					$page->img_tmp_pict=$_FILES['pict'.$i.'']['tmp_name'];
				}
				$page->uploadPicture();
				$$array_name=array(
					'block'.$i.'_type' 	=> $_SESSION["$sess_type"],
					'block'.$i.'_pict' 	=> $_SESSION['sess_pict_'.$i.''],
					'block'.$i.'_bg'	=> $_SESSION[''.$sess_bg.''],
					'block'.$i.'_text'  => $_SESSION[''.$sess_text.'']
				);

			}else if($_SESSION["$sess_type"]=="i"){
				if($_SESSION['sess_pict_info_'.$i.'']){
					$page->img_info=$_SESSION['sess_pict_info_'.$i.''];
					$page->img_tmp_info=$_SESSION['sess_pict_info_'.$i.'_tmp'];
				}else{
					$page->img_info=$_FILES['info'.$i.'']['name'];
					$page->img_tmp_info=$_FILES['info'.$i.'']['tmp_name'];
				}
				$page->uploadInfo();
				$editor = preg_replace('/^\s+/', '', $_SESSION["sess_info_editor$i"]);
				$$array_name=array(
					'block'.$i.'_type' 	=> $_SESSION["$sess_type"],
					'block'.$i.'_info' 	=> $page->img,
					'block'.$i.'_desc' 	=> $editor,
					'block'.$i.'_bg'	=> $_SESSION[''.$sess_bg.''],
					'block'.$i.'_text'  => $_SESSION[''.$sess_text.'']
				);

			}else if($_SESSION["$sess_type"]=="t"){
				$editor = preg_replace('/^\s+/', '', $_SESSION["sess_editor$i"]);
				$$array_name=array(
						'block'.$i.'_type' 	=> $_SESSION["$sess_type"], 
						'block'.$i.''		=> $editor,
						'block'.$i.'_bg'	=> $_SESSION[''.$sess_bg.''],
						'block'.$i.'_text'  => $_SESSION[''.$sess_text.'']
				);
	
			}else{
				$$array_name=array(
						'block'.$i.'_type' 	=> $_SESSION["$sess_type"],
						'block'.$i.'_bg'	=> $_SESSION[''.$sess_bg.''],
						'block'.$i.'_text'  => $_SESSION[''.$sess_text.'']
				);
			}
		}

		$arr_tot=array($arr0);

		for($i=1;$i<=$counter;$i++){
			$array_name="arr$i";
			$arr_tot[]=$$array_name;
		}
	

		$page_name=preg_replace('/\s+/', '_',$_SESSION['sess_page_name']);
		$page_name=strtolower($page_name);

 		$file='../inc/pages/'.$page_name.'.json';
		$json=json_encode($arr_tot);

		$page->content=$json;

			if($page->insert()){

			$str=$page->page_name;
			$str = preg_replace('/\s+/', '_', $str);
			
			$str = strtolower($str);

			if(copy('../template/master.php', '../../master.php')){
				rename('../../master.php','../../'. $str . '.php');
				chmod('../../'. $str . '.php',0777);

				$page->counter=$counter;

				$page->destroyCheckSessVar();

				header("Location: ../index.php?man=page&op=show&type=custom&msg=pageSucc");
				exit;
			} else {
				header("Location: ../index.php?man=page&op=show&type=custom&msg=pageErr");
				exit;
			}
		
		}else{
			header("Location: ../index.php?man=page&op=show&type=custom&msg=pageErr");
			exit;
		}
	}else if($operation=="mod"){
		
			$page->id=$_POST['idToMod'];
			
			$page->page_name=$_POST['page_name'];
			$page->old_page_name = $_POST['old_page_name'];	
		
			$name=$page->page_name;
			if($page->old_page_name != $page->page_name){
				$name=$page->old_page_name;
			}
		
			$page->no_mod=$_SESSION['sess_no_mod'];
			$page->layout=$_SESSION['sess_layout'];
			$page->header=$_SESSION['sess_header'];
			$page->use_name=$_SESSION['sess_use_name'];
			$page->use_desc=$_SESSION['sess_use_desc'];
			$page->counter=$_POST['counter'];
		
				
			if($_FILES['myfile']['name']){
				$page->img=$_FILES['myfile']['name'];
			}else if($page->type=="custom") {
				$page->img= $_SESSION['sess_img'];
			}else if($page->type=="default") {
				$query1="SELECT * FROM default_page WHERE page_name = :page_name LIMIT 0,1";
				$stmt1 = $db->prepare($query1);
				$stmt1->bindParam(':page_name', $name);       
				$stmt1->execute();
				$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
				$page->img=$row1['img'];
			}



			

				$arr0=array(
					"name"		=> $_SESSION['sess_page_name']
				);
		
				for($i=1;$i<=$counter;$i++){
					$sess_type="sess_type_$i";
					$sess_bg="sess_bg_$i";
					$sess_text="sess_text_$i";
					$array_name="arr$i";
				if($_SESSION["$sess_type"]=="t"){
						$$array_name=array(
								'block'.$i.'_type' 	=> $_SESSION["$sess_type"], 
								'block'.$i.''		=> $_SESSION["sess_editor$i"],
								'block'.$i.'_bg'	=> $_SESSION[''.$sess_bg.''],
								'block'.$i.'_text'  => $_SESSION[''.$sess_text.'']
						);
					}else if($_SESSION["$sess_type"]=="p"){
						if($_FILES['pict'.$i.'']['name']){
							$page->img_pict=$_FILES['pict'.$i.'']['name'];
							$page->img_tmp_pict=$_FILES['pict'.$i.'']['tmp_name'];
							$page->uploadPicture();
							$pict=$_FILES['pict'.$i.'']['name'];
						}else{
							$pict=$_POST['old_img_'.$i.''];
						}
						
						$$array_name=array(
							'block'.$i.'_type' 	=> $_SESSION["$sess_type"],
							'block'.$i.'_pict' 	=> $pict,
							'block'.$i.'_bg'	=> $_SESSION[''.$sess_bg.''],
							'block'.$i.'_text'  => $_SESSION[''.$sess_text.'']
						);
					}else if($_SESSION["$sess_type"]=="i"){
						if($_FILES['info'.$i.'']['name']){
							$page->img_info=$_FILES['info'.$i.'']['name'];
							$page->img_tmp_info=$_FILES['info'.$i.'']['tmp_name'];
							$page->uploadInfo();
							$info=$_FILES['info'.$i.'']['name'];
						}else{
							$info=$_POST['old_info_'.$i.''];
						}
						
						$$array_name=array(
							'block'.$i.'_type' 	=> $_SESSION["$sess_type"],
							'block'.$i.'_info' 	=> $info,
							'block'.$i.'_desc' 	=> $_SESSION["sess_info_editor$i"],
							'block'.$i.'_bg'	=> $_SESSION[''.$sess_bg.''],
							'block'.$i.'_text'  => $_SESSION[''.$sess_text.'']
						);
					}else{
						$$array_name=array(
								'block'.$i.'_type' 	=> $_SESSION["$sess_type"],
								'block'.$i.'_bg'	=> $_SESSION[''.$sess_bg.''],
								'block'.$i.'_text'  => $_SESSION[''.$sess_text.'']
						);
					}
				}
		
				$arr_tot=array($arr0);
		
				for($i=1;$i<=$counter;$i++){
					$array_name="arr$i";
					$arr_tot[]=$$array_name;
				}
			
		
			

				$json=json_encode($arr_tot);

				$page->content=$json;

				if($page->update()){
					
					$page->counter=$counter;

					$page->destroyCheckSessVar();

					header("Location: ../index.php?man=page&op=show&type=$page->type&msg=pageEditSucc");
					exit;
				}else{
					header("Location: ../index.php?man=page&op=show&type=$page->type&msg=pageEditErr");
					exit;
				}
		}
}
