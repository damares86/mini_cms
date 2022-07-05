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



if(filter_input(INPUT_POST,"addBlock")){
	$counter=filter_input(INPUT_POST,"counter");
	for($i=1;$i<=$counter;$i++){
		
		$_SESSION['sess_page_name']=$_POST['page_name'];
		$_SESSION['sess_layout']=$_POST['layout'];
		if($_FILES['myfile']){
			$_SESSION['sess_img']=$_FILES['myfile']['name'];
		}
		$_SESSION['sess_no_mod']=0;
		$_SESSION['sess_theme']=$_POST['theme'];

		if(isset($_POST['visualSel'])){
			$_SESSION['sess_header']=$_POST['visualSel'];
		} else {
			$_SESSION['sess_header']=0;
		}		

		$block_name="block$i";

		$sess_bg="sess_bg_$i";
		$_SESSION[''.$sess_bg.'']=$_POST[''.$block_name.'_bg'];

		$sess_text="sess_text_$i";
		$_SESSION[''.$sess_text.'']=$_POST[''.$block_name.'_text'];

		print_r($_SESSION['sess_text_1']);
		exit;

		// TYPE

		$$block_name=$_POST[''.$block_name.''][0];
		$sess_type="sess_type_$i";
		
		if($$block_name=="t$i"){
			$_SESSION[''.$sess_type.'']="t";
			$_SESSION['sess_editor'.$i.'']=$_POST['editor'.$i.''];
		} else if($$block_name=="g$i"){
			$gallery=$_POST[''.$block_name.'_gall'];
			$gallery= str_replace(" ","_", $gallery);
			$gallery=strtolower($gallery);
			$_SESSION[''.$sess_type.'']=$gallery;
		} else if($$block_name=="b$i"){
			$_SESSION[''.$sess_type.'']="b";
		} else if($$block_name=="n$i"){
			$_SESSION[''.$sess_type.'']="n";
		}

	
		print_r($_SESSION['sess_type_1']);
		exit;

	}
	$counter++;
	header("Location: ../index.php?man=page&op=add&type=custom&count=$counter&more=yes");
	exit;


}else if(filter_input(INPUT_POST,"subReg")){
	
}

exit;




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


if(filter_input(INPUT_GET,"op")){
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
	 } else {
		header("Location: ../index.php?man=page&op=show&type=custom&msg=pageCopyErr");
		exit;
	 }
	 
	
}


if(filter_input(INPUT_POST,"subReg")){
	$operation=filter_input(INPUT_POST,"operation");
	
	$page->type = $_POST['type'];

	if($page->type=="custom"){
		$editor = preg_replace('/\s+/', '', $_POST['editor1']);
	}

	
	if($operation=="add"){
		//inserimento

		$arr0=array(
			"name"		=> $_POST['page_name'],
			"no_mod"	=> 0,
			"layout"	=> $_POST['layout'],
			"theme"		=> $_POST['theme']
		);

		// $json0=json_encode($arr0);
		$file="test.json";
		// file_put_contents($file, $json, FILE_APPEND);


		$arr1=array(
			"block1"=>array(
				"block1_type"=> 't',
				"block1"	=> $_POST['editor1'],
				"block1_bg"	=> $_POST['block1_bg'],
				"block1_text"=>$_POST['block1_text']
				)
			);

		// $json1=json_encode($arr1);

		// file_put_contents($file, $json, FILE_APPEND);

		$arr2=array(
			"block2"=>array(
				"block2_type"=> 't',
				"block2"	=> $_POST['editor2'],
				"block2_bg"	=> $_POST['block2_bg'],
				"block2_text"=>$_POST['block2_text']
			)
		);

		$arr_tot=array($arr0,$arr1,$arr2);
		$json=json_encode($arr_tot);

		
		file_put_contents($file, $json, FILE_APPEND);
		chmod("test.json",0777);


		exit;
		// $page->page_name=$_POST['page_name'];
		// $page->no_mod=0;
		// $page->layout=$_POST['layout'];
		// $page->theme=$_POST['theme'];
		// $page->img=$_FILES['myfile']['name'];
		
		
		// if(isset($_POST['visualSel'])){
		// 	$page->header=$_POST['visualSel'];
		// } else {
		// 	$page->header=0;
		// }
		
		// $page->block1_type = "t";
		// $page->block1=$_POST['editor1'];
		// $page->block1_bg=$_POST['block1_bg'];
		// $page->block1_text=$_POST['block1_text'];

		// if($_POST['block2'][0]=="g2"){
		// 	$gallery=$_POST['block2_gall'];
		// 	$gallery= str_replace(" ","_", $gallery);
		// 	$gallery=strtolower($gallery);
		// 	$page->block2_type=$gallery;	
		// }else if($_POST['block2'][0]=="t2"){
		// 	if($_POST['editor2']){
		// 		$page->block2=$_POST['editor2'];
		// 	}
		// 	$page->block2_type="t";
		// }else if($_POST['block2'][0]=="b2"){
		// 	$page->block2_type="b";
		// }else if($_POST['block2'][0]=="n2"){
		// 	$page->block2_type="n";
		// }
		// $page->block2_bg=$_POST['block2_bg'];
		// $page->block2_text=$_POST['block2_text'];

		// if($_POST['block3'][0]=="g3"){
		// 	$gallery=$_POST['block3_gall'];
		// 	$gallery= str_replace(" ","_", $gallery);
		// 	$gallery=strtolower($gallery);
		// 	$page->block3_type=$gallery;	
		// }else if($_POST['block3'][0]=="t3"){
		// 	if($_POST['editor3']){
		// 		$page->block3=$_POST['editor3'];
		// 	}
		// 	$page->block3_type="t";
		// }else if($_POST['block3'][0]=="b3"){
		// 	$page->block3_type="b";
		// }else if($_POST['block3'][0]=="n3"){
		// 	$page->block3_type="n";
		// }
		// $page->block3_bg=$_POST['block3_bg'];
		// $page->block3_text=$_POST['block3_text'];

		// if($_POST['block4'][0]=="g4"){
		// 	$gallery=$_POST['block4_gall'];
		// 	$gallery= str_replace(" ","_", $gallery);
		// 	$gallery=strtolower($gallery);
		// 	$page->block4_type=$gallery;	
		// }else if($_POST['block4'][0]=="t4"){
		// 	if($_POST['editor4']){
		// 		$page->block4=$_POST['editor4'];
		// 	}
		// 	$page->block4_type="t";
		// }else if($_POST['block4'][0]=="b4"){
		// 	$page->block4_type="b";
		// }else if($_POST['block4'][0]=="n4"){
		// 	$page->block4_type="n";
		// }
		// $page->block4_bg=$_POST['block4_bg'];
		// $page->block4_text=$_POST['block4_text'];

		// if($_POST['block5'][0]=="g5"){
		// 	$gallery=$_POST['block5_gall'];
		// 	$gallery= str_replace(" ","_", $gallery);
		// 	$gallery=strtolower($gallery);
		// 	$page->block5_type=$gallery;	
		// }else if($_POST['block5'][0]=="t5"){
		// 	if($_POST['editor5']){
		// 		$page->block5=$_POST['editor5'];
		// 	}
		// 	$page->block5_type="t";
		// }else if($_POST['block5'][0]=="b5"){
		// 	$page->block5_type="b";
		// }else if($_POST['block5'][0]=="n5"){
		// 	$page->block5_type="n";
		// }
		// $page->block5_bg=$_POST['block5_bg'];
		// $page->block5_text=$_POST['block5_text'];
		
		// if($_POST['block6'][0]=="g6"){
		// 	$gallery=$_POST['block6_gall'];
		// 	$gallery= str_replace(" ","_", $gallery);
		// 	$gallery=strtolower($gallery);
		// 	$page->block6_type=$gallery;	
		// }else if($_POST['block6'][0]=="t6"){
		// 	if($_POST['editor6']){
		// 		$page->block6=$_POST['editor6'];
		// 	}
		// 	$page->block6_type="t";
		// }else if($_POST['block6'][0]=="b6"){
		// 	$page->block6_type="b";
		// }else if($_POST['block6'][0]=="n6"){
		// 	$page->block6_type="n";
		// }
		// $page->block6_bg=$_POST['block6_bg'];
		// $page->block6_text=$_POST['block6_text'];

		
		
		// create the page
		if($page->insert()){
			$str=$page->page_name;
			$str = preg_replace('/\s+/', '_', $str);
			
			$str = strtolower($str);

			if(copy('../template/master.php', '../../master.php')){
				rename('../../master.php','../../'. $str . '.php');
				chmod('../../'. $str . '.php',0777);
				header("Location: ../index.php?man=page&op=show&type=custom&msg=pageSucc");
				exit;
			 } else {
				 echo "ko";
			 }
		
		}else{
			header("Location: ../index.php?man=page&op=show&type=custom&msg=pageErr");
			exit;
		}
	} else if($operation=="mod"){

		$page->id=$_POST['idToMod'];
		
		$page->page_name=$_POST['page_name'];
		$page->old_page_name = $_POST['old_page_name'];
		$name=$page->page_name;
		if($page->old_page_name != $page->page_name){
			$name=$page->old_page_name;

		}

		
		if($_FILES['myfile']['name']){
			$page->img=$_FILES['myfile']['name'];
		}else if($page->type=="custom") {
			$query1="SELECT * FROM page WHERE page_name = :page_name LIMIT 0,1";
			$stmt1 = $db->prepare($query1);
			$stmt1->bindParam(':page_name', $name);       
			$stmt1->execute();
			$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
			$page->img=$row1['img'];
		}else if($page->type=="default") {
			$query1="SELECT * FROM default_page WHERE page_name = :page_name LIMIT 0,1";
			$stmt1 = $db->prepare($query1);
			$stmt1->bindParam(':page_name', $name);       
			$stmt1->execute();
			$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
			$page->img=$row1['img'];
		}


		

		if(isset($_POST['visualSel'])){
			$page->header=$_POST['visualSel'];
		} else {
			$page->header=0;
		}
		

		if($page->type=="custom" || (($page->type=="default")&&($page->id==1))){

			$page->no_mod=0;
			$page->page_name=$_POST['page_name'];
			$page->layout=$_POST['layout'];
			$page->theme=$_POST['theme'];
			// $page->img=$_FILES['myfile']['name'];
			
			
			// if(isset($_POST['visualSel'])){
			// 	$page->header=$_POST['visualSel'];
			// } else {
			// 	$page->header=0;
			// }

		
			$page->block1_type = "t";
			$page->block1=$_POST['editor1'];
			$page->block1_bg=$_POST['block1_bg'];
			$page->block1_text=$_POST['block1_text'];
		

			if($_POST['block2'][0]=="g2"){
				$gallery=$_POST['block2_gall'];
				$gallery= str_replace(" ","_", $gallery);
                $gallery=strtolower($gallery);
				$page->block2_type=$gallery;	
	
				
			}else if($_POST['block2'][0]=="t2"){
				if($_POST['editor2']){
					$page->block2=$_POST['editor2'];
				}
				$page->block2_type="t";
			}else if($_POST['block2'][0]=="b2"){
				$page->block2_type="b";
			}else if($_POST['block2'][0]=="n2"){
				$page->block2_type="n";
			}
			$page->block2_bg=$_POST['block2_bg'];
			$page->block2_text=$_POST['block2_text'];
	
			if($_POST['block3'][0]=="g3"){
				$gallery=$_POST['block3_gall'];
				$gallery= str_replace(" ","_", $gallery);
                $gallery=strtolower($gallery);
				$page->block3_type=$gallery;	
			}else if($_POST['block3'][0]=="t3"){
				if($_POST['editor3']){
					$page->block3=$_POST['editor3'];

				}
				$page->block3_type="t";
			}else if($_POST['block3'][0]=="b3"){
				$page->block3_type="b";
			
			}else if($_POST['block3'][0]=="n3"){
				$page->block3_type="n";
			}
			$page->block3_bg=$_POST['block3_bg'];
			$page->block3_text=$_POST['block3_text'];
	
			if($_POST['block4'][0]=="g4"){
				$gallery=$_POST['block4_gall'];
				$gallery= str_replace(" ","_", $gallery);
                $gallery=strtolower($gallery);
				$page->block4_type=$gallery;
			}else if($_POST['block4'][0]=="t4"){
				if($_POST['editor4']){
					$page->block4=$_POST['editor4'];
				}
				$page->block4_type="t";
			}else if($_POST['block4'][0]=="b4"){
				$page->block4_type="b";
			}else if($_POST['block4'][0]=="n4"){
				$page->block4_type="n";
			}
			$page->block4_bg=$_POST['block4_bg'];
			$page->block4_text=$_POST['block4_text'];
	
			if($_POST['block5'][0]=="g5"){
				$gallery=$_POST['block5_gall'];
				$gallery= str_replace(" ","_", $gallery);
                $gallery=strtolower($gallery);
				$page->block5_type=$gallery;
			}else if($_POST['block5'][0]=="t5"){
				if($_POST['editor5']){
					$page->block5=$_POST['editor5'];
				}
				$page->block5_type="t";
			}else if($_POST['block5'][0]=="b5"){
				$page->block5_type="b";
			}else if($_POST['block5'][0]=="n5"){
				$page->block5_type="n";
			}
			$page->block5_bg=$_POST['block5_bg'];
			$page->block5_text=$_POST['block5_text'];
	
			if($_POST['block6'][0]=="g6"){
				$gallery=$_POST['block6_gall'];
				$gallery= str_replace(" ","_", $gallery);
                $gallery=strtolower($gallery);
				$page->block6_type=$gallery;
			}else if($_POST['block6'][0]=="t6"){
				if($_POST['editor6']){
					$page->block6=$_POST['editor6'];
				}
				$page->block6_type="t";
			}else if($_POST['block6'][0]=="b6"){
				$page->block6_type="b";
			}else if($_POST['block6'][0]=="n6"){
				$page->block6_type="n";
			}
			$page->block6_bg=$_POST['block6_bg'];
			$page->block6_text=$_POST['block6_text'];
	
		}

		// update the page
		if($page->update()){
			header("Location: ../index.php?man=page&op=show&type=$page->type&msg=pageEditSucc");
			exit;
		
			// empty posted values
			// $_POST=array();
		
		}else{
			header("Location: ../index.php?man=page&op=show&type=$page->type&msg=pageEditErr");
			exit;
		}

	} 
	


	// MODIFICA UTENTE



} else {
	header("Location: ../index.php?man=page&op=show&type=$$page->type&msg=pageEditErr");
	exit;
}


exit;

?>

