<?php

require '../vendor/autoload.php';		// If installed via composer
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
	spl_autoload_register('autoloader');
    function autoloader($class){
        include("../class/$class.php");
    }


$database = new Database();
$db = $database->getConnection();

include "../inc/class_initialize.php";


	if(filter_input(INPUT_GET,"idToDel")){

		$idToDel = filter_input(INPUT_GET,"idToDel");
			
		$page->id=$idToDel;
		$page->showById();
		$menu->pagename=$page->page_name;
		
		$str=$page->page_name;
		$str = preg_replace('/\s+/', '_', $str);
		$str = strtolower($str);
		$filepath = "../../" . $str . ".php";
		$json="../inc/pages/$str.json";
	
	
		if(unlink($filepath) || !file_exists(($filepath))){
			if(unlink($json) || !file_exists(($json))){
				if($page->delete()){
					header("Location: ../index.php?man=page&op=show&type=custom&msg=pageDelSucc");
					exit;
		
				}else{
					header("Location: ../index.php?man=page&op=show&type=custom&msg=pageDelErr");
					exit;
				}
			}else{
				header("Location: ../index.php?man=page&op=show&type=custom&msg=pageDelErr1");
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
		if(copy('../inc/pages/'.$name.'.json','../inc/pages/'.$name.'_copy.json')){

			$page->copyPage();

			header("Location: ../index.php?man=page&op=show&type=custom&msg=pageCopySucc");
			exit;
		}else {
			header("Location: ../index.php?man=page&op=show&type=custom&msg=pageCopyErr");
			exit;
		 }
	 } else {
		header("Location: ../index.php?man=page&op=show&type=custom&msg=pageCopyErr");
		exit;
	 }

} else if(filter_input(INPUT_POST,"subReg")){

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

		
		if($_POST['visual'][0]=="visual_img"){
			$page->visual_img=1;
			if($_FILES['myfile']['name']){
				print_r("file caricato: err");
				exit;
				$page->img=$_FILES['myfile']['name'];
			}else{
				$query1="SELECT * FROM ".$page->prx."default_page WHERE page_name = :page_name LIMIT 0,1";
				$stmt1 = $db->prepare($query1);
				$stmt1->bindParam(':page_name', $page->page_name);       
				$stmt1->execute();
				$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
				$page->img=$row1['img'];
			}
		}else if($_POST['visual'][0]=="visual_gall"){
			$page->visual_gall=1; 
			$page->img=$_POST['visual_gallery'];
		}

		if($idToMod==2){
			$page->maps=$_POST['maps'];
			$page->contacts=$_POST['editor1'];

			$json_file = '../inc/pages/contact.json';
			$data = file_get_contents($json_file);
			$json_arr = json_decode($data, true);

			$arr_0=array(
				'name' => 'contact'
			);

			$arr_tot[]=$arr_0;

			$arr_1=array(
				'block1_type' 	=> "t", 
				'block1'		=> "$page->contacts",
				'block1_bg'	=> "none",
				'block1_text'  => "none"
			);
			$arr_tot[]=$arr_1;
			
			$arr_2=array(
				'block2_type' 	=> "t", 
				'block2'		=> "$page->maps",
				'block2_bg'	=> "none",
				'block2_text'  => "none"
			);	
			$arr_tot[]=$arr_2;
			

			$arr_3=array(
				'block3_type' 	=> "t", 
				'block3'		=> "ok",
				'block3_bg'	=> "none",
				'block3_text'  => "none"
			);	
			$arr_tot[]=$arr_3;
			
			rename("../inc/pages/contact.json","../inc/pages/contact_tmp.json");
			$file='../inc/pages/contact.json';
			
			$json=json_encode($arr_tot);
			
			if(file_put_contents($file, $json, FILE_APPEND)){
				chmod($file,0777);
				unlink('../inc/pages/contact_tmp.json');
			}
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
		$name=$_SESSION['sess_page_name'];
		$name=strtolower($name);
		$name=str_replace(" ","_",$name);
		$page->page_name=$name;

		if($_POST['visual'][0]=="visual_img"){
			$page->visual_img=1;
			if(isset($_SESSION['sess_img'])){
				$page->img=$_SESSION['sess_img'];
			}else{
				$page->img="visual.jpg";
			}
		}else if($_POST['visual'][0]=="visual_gall"){
			$page->visual_gall=1;
			$page->img=$_POST['visual_gallery'];
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
					'block'.$i.'_pict' 	=> $page->img_pict,
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
					'block'.$i.'_info' 	=> $page->img_info,
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

		file_put_contents($file, $json, FILE_APPEND);
		chmod($file,0777);

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
		$old_name=$_POST['old_page_name'];
		$old_name=preg_replace("/\s+/", "_", $old_name);
		$old_name=strtolower($old_name);
		$page->old_page_name = $old_name ;

		$new =$_POST['page_name'];
		$new=preg_replace("/\s+/", "_", $new);
		$new=strtolower($new);
	
		$old = $_POST['old_page_name'];
		$old=preg_replace("/\s+/", "_", $old);
		$old=strtolower($old);

		if(is_file("../inc/pages/$new.json")){
			rename("../inc/pages/$new.json",'../inc/pages/'.$new.'_tmp.json');
		}else if(is_file("../inc/pages/$old.json")){
			rename("../inc/pages/$old.json",'../inc/pages/'.$old.'_tmp.json');
		}
		
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

			if($_POST['visual'][0]=="visual_img"){
				$page->visual_img=1;				
				if($_FILES['myfile']['name']){
					$page->img=$_FILES['myfile']['name'];
				}else if($page->type=="custom") {
					$page->img= $_SESSION['sess_img'];
				}
			}else if($_POST['visual'][0]=="visual_gall"){
				$page->visual_gall=1;
				$page->img=$_POST['visual_gallery'];
			}
			// else if($page->type=="default") {
			// 	$query1="SELECT * FROM default_page WHERE page_name = :page_name LIMIT 0,1";
			// 	$stmt1 = $db->prepare($query1);
			// 	$stmt1->bindParam(':page_name', $name);       
			// 	$stmt1->execute();
			// 	$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
			// 	$page->img=$row1['img'];
			// }



			if($page->update()){

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
							$page->img=$_FILES['pict'.$i.'']['name'];
							$page->img_tmp=$_FILES['pict'.$i.'']['tmp_name'];
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
							$page->img=$_FILES['info'.$i.'']['name'];
							$page->img_tmp=$_FILES['info'.$i.'']['tmp_name'];
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
			
		
				$page_name=preg_replace('/\s+/', '_',$_SESSION['sess_page_name']);
				$page_name=strtolower($page_name);
		
				$file='../inc/pages/'.$page_name.'.json';

				$json=json_encode($arr_tot);
		
				if(file_put_contents($file, $json, FILE_APPEND)){
					chmod($file,0777);
					if(is_file('../inc/pages/'.$new.'_tmp.json')){

						unlink('../inc/pages/'.$new.'_tmp.json');
					}else if(is_file('../inc/pages/'.$old.'_tmp.json')){

						unlink('../inc/pages/'.$old.'_tmp.json');
					}

				}else{
					if(is_file('../inc/pages/'.$new.'_tmp.json')){

						rename('../inc/pages/'.$new.'_tmp.json',"../inc/pages/$name.json");
					}else if(is_file('../inc/pages/'.$old.'_tmp.json')){

						rename('../inc/pages/'.$old.'_tmp.json',"../inc/pages/$name.json");
					}
				}

				$page->destroyCheckSessVar();

				header("Location: ../index.php?man=page&op=show&type=$page->type&msg=pageEditSucc");
				exit;
			
				// empty posted values
				// $_POST=array();
			
			}else{


				header("Location: ../index.php?man=page&op=show&type=$page->type&msg=pageEditErr");
				exit;
			}
		}
}
