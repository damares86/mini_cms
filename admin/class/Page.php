<?php

class Page{


    private $conn;
    private $table_name = "page";
    private $table;
    private $setNo_mod;


    public $type;
    public $theme;
    public $id;
    public $old_page_name;
    public $page_name;
    public $no_mod;
    public $use_name;
    public $use_desc;
    public $layout;
    public $header;
    public $visual_img;
    public $visual_gall;
    public $img;
    public $img_tmp;
    public $img_pict;
    public $img_tmp_pict;
    public $img_info;
    public $img_tmp_info;
    public $counter;
    public $in_menu;
    public $item_order;
    public $parent;
    public $child_of;
    public $maps;
    public $contacts;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function initCheckSessVar(){
        
        $_SESSION['error']=0;
        $operation=$_POST['operation'];
    
        $counter=filter_input(INPUT_POST,"counter");
    
        if(filter_input(INPUT_POST,"rmBlock")){
            $remove=filter_input(INPUT_POST,"rmBlock");
        }
    

        if(!empty($_POST['page_name'])){
            $_SESSION['sess_page_name']=$_POST['page_name'];
        }else{
            $_SESSION['error']++;
        }
 

        if(isset($_POST['use_name'])){
            $_SESSION["sess_use_name"]=1;
        }else{
            $_SESSION["sess_use_name"]=0;
        }
    
        if(isset($_POST['use_desc'])){
            $_SESSION["sess_use_desc"]=1;
        }else{
            $_SESSION["sess_use_desc"]=0;
        }

        $_SESSION['sess_page_type']==$_POST['type'];
    
        if(isset($_POST['layout'])){
            $_SESSION['sess_layout']=$_POST['layout'];
        }else{
            $_SESSION['error']++;
        }

        if(isset($_POST['visualSel'])){
            $_SESSION['sess_header']=$_POST['visualSel'];
        } else {
            $_SESSION['sess_header']=0;
        }	

        if($_POST['visual'][0]=="visual_img"){
            $_SESSION['sess_img_select']=1;
            $_SESSION['sess_gall_select']=0;
            if($_FILES['myfile']['size']!=0){
                $this->img=$_FILES['myfile']['name'];
                $this->uploadPhoto();
                $_SESSION['sess_img']=$_FILES['myfile']['name'];
            }else{
                $_SESSION['sess_img']=$_POST['actual_image'];
            }
		}else if($_POST['visual'][0]=="visual_gall"){
            $_SESSION['sess_img_select']=0;
            $_SESSION['sess_gall_select']=1;
            $folder=$_POST['visual_gallery'];
            $gallery= str_replace("_"," ", $folder);
            $gallery=ucfirst($gallery);
			$_SESSION['sess_img']=$gallery;
		}

           
        $_SESSION['sess_no_mod']=0;
        if($_SESSION['sess_page_name']=="index"){
            $_SESSION['sess_no_mod']=1;
        }
        $_SESSION['sess_theme']=$_POST['theme'];
    
 	
    
        for($i=1;$i<=$counter;$i++){
            $i_real=$i;
            

            if(isset($remove)&&$remove<=$i){
                if($_SESSION['sess_pict_'.$i.'']){
                    unlink("../../uploads/img/".$_SESSION['sess_pict_'.$i.'']."");
                }
                if($_SESSION['sess_pict_info_'.$i.'']){
                    unlink("../../uploads/img/".$_SESSION['sess_pict_info_'.$i.'']."");
                }
                $i_real++;
            }
    
    
            $block_name="block$i_real";
            $sess_bg="sess_bg_$i";
            $_SESSION[''.$sess_bg.'']=$_POST[''.$block_name.'_bg'];
    
            $sess_text="sess_text_$i";
            $_SESSION[''.$sess_text.'']=$_POST[''.$block_name.'_text'];
    
    
            // TYPE
    
            $$block_name=$_POST[''.$block_name.''][0];
            $sess_type="sess_type_$i";

            if($$block_name=="t$i_real"){
                $_SESSION[''.$sess_type.'']="t";
                $editor = preg_replace('/^\s+/', '', $_POST['editor'.$i_real.'']);
                if(!empty($editor)){
                    $_SESSION['sess_editor'.$i.'']=$_POST['editor'.$i_real.''];

                }else{
                    $_SESSION['error']++;
                }
            } else if($$block_name=="p$i_real"){
                    $_SESSION[''.$sess_type.'']="p";
                if($_FILES['pict'.$i_real.'']['name']){
                    $this->img_pict=$_FILES['pict'.$i_real.'']['name'];
                    $this->img_tmp_pict=$_FILES['pict'.$i_real.'']['tmp_name'];
                    $this->uploadPicture();
                    $_SESSION['sess_pict_'.$i_real.'']=$_FILES['pict'.$i_real.'']['name'];
                }else{
                    $_SESSION['sess_pict_'.$i_real.'']=$_POST['old_img_'.$i_real.''];
                }
            }  else if($$block_name=="i$i_real"){
                $_SESSION[''.$sess_type.'']="i";
                $editor = preg_replace('/^\s+/', '', $_POST['info_editor'.$i_real.'']);
                if(!empty($editor)){
                    $_SESSION['sess_info_editor'.$i.'']=$_POST['info_editor'.$i_real.''];

                }else{
                    $_SESSION['error']++;
                }
                if($_FILES['info'.$i_real.'']['name']){
                    $this->img_info=$_FILES['info'.$i_real.'']['name'];
                    $this->img_tmp_info=$_FILES['info'.$i_real.'']['tmp_name'];
                    $this->uploadPicture();
                    $_SESSION['sess_pict_info_'.$i_real.'']=$_FILES['info'.$i_real.'']['name'];
                }else{
                    $_SESSION['sess_pict_info_'.$i_real.'']=$_POST['old_info_'.$i_real.''];
                }
            } else if($$block_name=="g$i_real"){
                $gallery=$_POST[''.$block_name.'_gall'];
                $gallery= str_replace(" ","_", $gallery);
                $gallery=strtolower($gallery);
                $_SESSION[''.$sess_type.'']=$gallery;
            } else if($$block_name=="b$i_real"){
                $_SESSION[''.$sess_type.'']="b";
            } else if($$block_name=="q$i_real"){
                $_SESSION[''.$sess_type.'']="q";
            } else if($$block_name=="n$i_real"){
                $_SESSION[''.$sess_type.'']="n";
            }
    
        }
    
    
    }

    function modCheckSessVar($json_arr){

        $_SESSION['error']=0;
    
        $counter=filter_input(INPUT_GET,"count");
    
        $_SESSION['sess_page_name']=$this->page_name;
        $_SESSION["sess_use_name"]=$this->use_name;
        $_SESSION["sess_use_desc"]=$this->use_desc;
        $_SESSION['sess_layout']=$this->layout;
        $_SESSION['sess_img']=$this->img;
        if(pathinfo($this->img, PATHINFO_EXTENSION)){
            $_SESSION['sess_img_select']=1;
        }else{
            $_SESSION['sess_gall_select']=1;
        }
        $_SESSION['sess_no_mod']=$this->no_mod;
        $_SESSION['sess_theme']=$this->theme;
        $_SESSION['sess_header']=$this->header;
    
        for($i=1;$i<=$counter;$i++){       
    
            $block_name="block$i";
            $sess_bg="sess_bg_$i";
            $_SESSION[''.$sess_bg.'']=$json_arr[$i]['block'.$i.'_bg'];
    
            $sess_text="sess_text_$i";
            $_SESSION[''.$sess_text.'']=$json_arr[$i]['block'.$i.'_text'];
    
    
            // TYPE
    
            $$block_name=$_POST[''.$block_name.''][0];
            $sess_type="sess_type_$i";
            $_SESSION[''.$sess_type.'']=$json_arr[$i]['block'.$i.'_type'];

            
            if($_SESSION[''.$sess_type.'']=="t"){
                $_SESSION['sess_editor'.$i.'']=$json_arr[$i]['block'.$i.''];
            } else if($_SESSION[''.$sess_type.'']=="p"){
                $_SESSION['sess_pict_'.$i.'']=$json_arr[$i]['block'.$i.'_pict'];

            } else if($_SESSION[''.$sess_type.'']=="i"){
                $_SESSION['sess_pict_info_'.$i.'']=$json_arr[$i]['block'.$i.'_info'];
                $_SESSION['sess_info_editor'.$i.'']=$json_arr[$i]['block'.$i.'_desc'];
            }

        }
    }

    function destroyCheckSessVar(){
        $_SESSION['error']=0;
        unset($_SESSION['sess_page_name']);
        unset($_SESSION['sess_old_page_name']);
        unset($_SESSION['sess_use_name']);
        unset($_SESSION['sess_use_desc']);
        unset($_SESSION['sess_layout']);
        unset($_SESSION['sess_img']);
        unset($_SESSION['sess_no_mod']);
        unset($_SESSION['sess_theme']);
        unset($_SESSION['sess_header']);
        unset($_SESSION['sess_page_type']);
        unset($_SESSION['sess_img_select']);
        unset( $_SESSION['sess_gall_select']);
        $count=$_SESSION['counter'];
        for($i=1;$i<=$count;$i++){
            $sess_bg="sess_bg_$i";
            $sess_text="sess_text_$i";
            $sess_type="sess_type_$i";
            unset($_SESSION["$sess_type"]);
            unset($_SESSION["sess_editor$i"]);
            unset($_SESSION["sess_info_editor$i"]);
            unset($_SESSION[''.$sess_bg.'']);
            unset($_SESSION[''.$sess_text.'']);
            unset($_SESSION['sess_pict_'.$i.'']);
            unset($_SESSION['sess_pict_info_'.$i.'']);
        }
        // unset($_SESSION['counter']);
    
    }

    
    function insert(){
    if($this->type=="default"){
        $this->table="default_page";
    }else if($this->type=="custom"){
        $this->table="page";
    }
    
    // insert query
    $query = "INSERT INTO
        " . $this->table_name . "
        SET
        page_name = :page_name,
        no_mod = :no_mod,
        layout = :layout,
        header = :header,
        use_name = :use_name,
        use_desc = :use_desc,
        counter = :counter";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);
        
        // bind the values
        $stmt->bindParam(':page_name', $this->page_name);       
        $stmt->bindParam(':no_mod', $this->no_mod);       
        $stmt->bindParam(':layout', $this->layout);    
        $stmt->bindParam(':header', $this->header);    
        $stmt->bindParam(':use_name', $this->use_name);    
        $stmt->bindParam(':use_desc', $this->use_desc);    
        $stmt->bindParam(':counter', $this->counter);    
        
        // execute the query, also check if query was successful
        if($stmt->execute()){

            if($this->visual_img==1){
                $this->uploadPhoto();
            }else if($this->visual_gall==1){
                $query2 = "UPDATE " . $this->table . "
                        SET
                        img = :img
                        WHERE page_name = :page_name";

                // prepare the query
                $stmt2 = $this->conn->prepare($query2);
                // bind the values
                $stmt2->bindParam(':img', $this->img);
                $stmt2->bindParam(':page_name', $this->page_name);  
                
                $stmt2->execute();
            }

            $query1="INSERT INTO menu SET pagename = :page_name";
            $stmt1 = $this->conn->prepare($query1);
            $stmt1->bindParam(':page_name', $this->page_name);       
            if($stmt1->execute()){
                return true;
            }else{
                $this->showError($stmt);
                return false;
            }
        }else{
            $this->showError($stmt);
            return false;
        }
    
    }

    function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }


    function update(){

        if($this->type=="default"){
            $this->table="default_page";
        }else if($this->type=="custom"){
            $this->table="page";
            $this->setNo_mod = ", no_mod = :no_mod";
        }
        
        if($this->type=="custom"){
            
            $stmt="";
            
            $query = "UPDATE
                " . $this->table . "
                SET
                page_name = :page_name".$this->setNo_mod.",
                layout = :layout,
                header = :header,
                use_name = :use_name,
                use_desc = :use_desc,
                counter = :counter WHERE id = :id";
                
              
                // prepare the query
                $stmt = $this->conn->prepare($query);

                // bind the values
                $stmt->bindParam(':page_name', $this->page_name); 
                if($this->table=="page"){
                    $stmt->bindParam(':no_mod', $this->no_mod);       
                }
                $stmt->bindParam(':layout', $this->layout);    
                $stmt->bindParam(':header', $this->header);    
                $stmt->bindParam(':use_name', $this->use_name);    
                $stmt->bindParam(':use_desc', $this->use_desc);    
                $stmt->bindParam(':counter', $this->counter);  
                $stmt->bindParam(':id', $this->id); 

            }else if($this->type=="default"){

           
                $query = "UPDATE
                    default_page
                    SET
                    header = :header,
                    use_name = :use_name,
                    use_desc = :use_desc
                    WHERE
                    id = :id";

                    $stmt = $this->conn->prepare($query);
                    
                    $stmt->bindParam(':header', $this->header);      
                    $stmt->bindParam(':use_name', $this->use_name);      
                    $stmt->bindParam(':use_desc', $this->use_desc);      
                    $stmt->bindParam(':id', $this->id);   

                    if($stmt->execute()){  
                        $query1="SELECT * FROM ".$this->table." WHERE page_name = :page_name LIMIT 0,1";
                        $stmt1 = $this->conn->prepare($query1);
                        $stmt1->bindParam(':page_name', $this->page_name);       
                        $stmt1->execute();
                        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                        $actualImage=$row1['img'];
                        if($this->header!=0){
                            if(($this->img)==$actualImage){
                                return true;
                            }else{
                                if($this->visual_img==1){
                                    if($this->uploadPhoto()){
                                        return true;
                                    }else{
                                        return false;
                                    }
                                }else if($this->visual_gall==1){
                                    $query2 = "UPDATE " . $this->table . "
                                            SET
                                            img = :img
                                            WHERE page_name = :page_name";
                    
                                    // prepare the query
                                    $stmt2 = $this->conn->prepare($query2);
                                    // bind the values
                                    $stmt2->bindParam(':img', $this->img);
                                    $stmt2->bindParam(':page_name', $this->page_name);  
                                    
                                    if($stmt2->execute()){
                                        return true;
                                    }else{
                                        $this->showError($stmt);
                                        return false;
                                    }
                                }
                             
                            }
                        }
                        return true;
                    }else{
                        return false;
                    }
            }

            // execute the query, also check if query was successful
            if($stmt->execute()){    

                if($this->old_page_name != $this->page_name){
                    $query3="SELECT * FROM menu WHERE pagename = :page_name LIMIT 0,1";
                    $stmt3 = $this->conn->prepare($query3);
                    $stmt3->bindParam(':page_name', $this->old_page_name);       
                    $stmt3->execute();
                    $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                    $id=$row3['id'];


                    $query2 = "UPDATE menu SET 
                    pagename = :page_name
                    WHERE
                    id = :id";

                    
                    $stmt2 = $this->conn->prepare($query2);
                    $stmt2->bindParam(':page_name', $this->page_name);       
                    $stmt2->bindParam(':id', $id);       



                    if($stmt2->execute()){

                        $this->page_name = preg_replace('/\s+/', '_', $this->page_name);			
                        $this->page_name = strtolower($this->page_name);

                        $this->old_page_name = preg_replace('/\s+/', '_', $this->old_page_name);			
                        $this->old_page_name = strtolower($this->old_page_name);
                        rename('../../'.$this->old_page_name.'.php','../../'. $this->page_name . '.php');
                        chmod('../../'. $this->page_name . '.php',0777);
                    }else{
                        return false;
                    }
                    
                }

         

                $query1="SELECT * FROM ".$this->table." WHERE page_name = :page_name LIMIT 0,1";
                $stmt1 = $this->conn->prepare($query1);
                $stmt1->bindParam(':page_name', $this->page_name);       
                $stmt1->execute();
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                $actualImage=$row1['img'];
                if($this->header!=0){
                    if(($this->img)==$actualImage){
                        return true;
                    }else{
                        if($this->visual_img==1){
                            if($this->uploadPhoto()){
                                return true;
                            }else{
                                return false;
                            }
                        }else if($this->visual_gall==1){
                            $query2 = "UPDATE " . $this->table . "
                                    SET
                                    img = :img
                                    WHERE page_name = :page_name";
            
                            // prepare the query
                            $stmt2 = $this->conn->prepare($query2);
                            // bind the values
                            $stmt2->bindParam(':img', $this->img);
                            $stmt2->bindParam(':page_name', $this->page_name);  
                            
                            if($stmt2->execute()){
                                return true;
                            }else{
                                $this->showError($stmt);
                                return false;
                            }
                        }
                     
                    }
                }
                return true;

    }else{
        $this->showError($stmt);
        return false;
    }
}


    function copyPage(){
        
        $this->showById();

        $this->page_name = $this->page_name."_copy";

        if($this->insert()){
            return true;
        }else {
            return false;
        }


	
    }

    function uploadPhoto(){
        
        if($this->img){
            $target_directory = "../../uploads/img/";
            $target_file = $target_directory . $this->img;
            if(!file_exists($target_file)){
                // print_r("ok");
                // exit;
                $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
                $file_upload_error_messages="";
                $allowed_file_types=array("jpg", "png");
                if(!in_array($file_type, $allowed_file_types)){
                    header("Location: ../index.php?man=page&op=show&type=".$this->type."&msg=formatImgErr");
                    exit;
                    // $file_upload_error_messages.="<div>Only .zip, .doc, .docx,.pdf files are allowed.</div>";
                    //exit;
                }
                
                if(file_exists($target_file)){
                    // $file_upload_error_messages.="File already exists";
                }
                
                // make sure submitted file is not too large, can't be larger than 5 MB
                // if($_FILES['myfile']['size'] > (5120000)){
                    //     $file_upload_error_messages.="<div>Doc must be less than 5 MB in size.</div>";
                    // }
                    
                    // make sure the 'uploads' folder exists
                    // if not, create it
                    if(!is_dir($target_directory)){
                        mkdir($target_directory, 0777, true);
                    }else{
                        chmod($target_directory, 0777);
                    }
                
                if(empty($file_upload_error_messages)){
                    
                    
                    // the physical file on a temporary uploads directory on the server
                    $file = $_FILES['myfile']['tmp_name'];
                    

                    
                    if (move_uploaded_file($file, $target_file)) {
                        chmod($target_file, 0777);
                        
                    }
                }
            }
            $query2 = "UPDATE " . $this->table . "
                        SET
                        img = :img
                        WHERE page_name = :page_name";
                        
                        // prepare the query
                        $stmt2 = $this->conn->prepare($query2);
                                
                            
                    
                        // bind the values
                        $stmt2->bindParam(':img', $this->img);
                        $stmt2->bindParam(':page_name', $this->page_name);    
                    
                        // execute the query, also check if query was successful
                        if($stmt2->execute()){
                            return true;
                        }else{
                            return false;
                        }
				
				
                } else {
                    echo "Failed to upload image.";
                }   
        	}
   

            function uploadPicture(){
                if($this->img_pict){
                    $target_directory = "../../uploads/img/";
                    $target_file = $target_directory . $this->img_pict;

                    if(!file_exists($target_file)){
                        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
                        $file_upload_error_messages="";
                        $allowed_file_types=array("jpg", "png", "jpeg");
                        if(!in_array($file_type, $allowed_file_types)){
                            header("Location: ../index.php?man=page&op=show&msg=formatImgErr");
                            exit;
                            // $file_upload_error_messages.="<div>Only .zip, .doc, .docx,.pdf files are allowed.</div>";
                            //exit;
                        }
                        
                        if(file_exists($target_file)){
                            // $file_upload_error_messages.="File already exists";
                        }
                        
                        // make sure submitted file is not too large, can't be larger than 5 MB
                        // if($_FILES['myfile']['size'] > (5120000)){
                            //     $file_upload_error_messages.="<div>Doc must be less than 5 MB in size.</div>";
                            // }
                            
                            // make sure the 'uploads' folder exists
                            // if not, create it
                            if(!is_dir($target_directory)){
                                mkdir($target_directory, 0777, true);
                            }else{
                                chmod($target_directory, 0777);
                            }
                        
                        if(empty($file_upload_error_messages)){
                            
                            
                            // the physical file on a temporary uploads directory on the server
                            $file = $this->img_tmp_pict;
                            
                    
                            if (move_uploaded_file($file, $target_file)) {
                                chmod($target_file, 0777);
                                
                            }
                        }
                    }
                }
            }


            function uploadInfo(){
                if($this->img_info){
                    $target_directory = "../../uploads/img/";
                    $target_file = $target_directory . $this->img_info;

                    if(!file_exists($target_file)){
                        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
                        $file_upload_error_messages="";
                        $allowed_file_types=array("jpg", "png", "jpeg");
                        if(!in_array($file_type, $allowed_file_types)){
                            header("Location: ../index.php?man=page&op=show&msg=formatImgErr");
                            exit;
                            // $file_upload_error_messages.="<div>Only .zip, .doc, .docx,.pdf files are allowed.</div>";
                            //exit;
                        }
                        
                        if(file_exists($target_file)){
                            // $file_upload_error_messages.="File already exists";
                        }
                        
                        // make sure submitted file is not too large, can't be larger than 5 MB
                        // if($_FILES['myfile']['size'] > (5120000)){
                            //     $file_upload_error_messages.="<div>Doc must be less than 5 MB in size.</div>";
                            // }
                            
                            // make sure the 'uploads' folder exists
                            // if not, create it
                            if(!is_dir($target_directory)){
                                mkdir($target_directory, 0777, true);
                            }else{
                                chmod($target_directory, 0777);
                            }
                        
                        if(empty($file_upload_error_messages)){
                            
                            
                            // the physical file on a temporary uploads directory on the server
                            $file = $this->img_tmp_info;
                            
                    
                            if (move_uploaded_file($file, $target_file)) {
                                chmod($target_file, 0777);
                                
                            }
                        }
                    }
                }
            }

    function showAllCustom($from_record_num, $records_per_page,$where){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "".$where."
                ORDER BY
                    id DESC
                    LIMIT
                    {$from_record_num}, {$records_per_page}";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }



    function showAllDefault(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    default_page
                ORDER BY
                    id ASC";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    }

    function showAllPages(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    page
                ORDER BY
                    id DESC";  
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $all_pages=array();
        
        foreach($stmt as $row){
            $all_pages[]=$row['page_name'];
        }

        $query1 = "SELECT
                *
            FROM
                default_page
            ORDER BY
                id DESC";  

        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->execute();
                
        foreach($stmt1 as $row1){
            $all_pages[]=$row1['page_name'];
        }


        return $all_pages;
    }
    
    function showMenu(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    menu
                WHERE
                inmenu = 'y' ORDER BY itemorder ASC";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }


    public function countAllDefault(){
    
        $query = "SELECT id FROM default_page";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }

    public function countAllCustom(){
    
        $query = "SELECT id FROM page";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }

    public function countFetchCustom($where){
    
        $query = "SELECT id FROM page".$where."";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }


    function showById(){
        $query = "SELECT *
        FROM " . $this->table_name . "
        WHERE id = ?
        LIMIT 0,1";
              
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->id = $row['id'];
        $this->page_name = $row['page_name'];
        $this->no_mod = $row['no_mod'];
        $this->layout = $row['layout'];
        $this->header = $row['header'];
        $this->img = $row['img'];
        $this->use_name = $row['use_name'];
        $this->use_desc = $row['use_desc'];
        $this->counter = $row['counter'];
        
    }

    function showByName(){
        $query = "SELECT *
        FROM " . $this->table_name . "
        WHERE page_name = :page_name
        LIMIT 0,1";      
        
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(':page_name', $this->page_name);       
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->page_name = $row['page_name'];
        $this->no_mod = $row['no_mod'];
        $this->layout = $row['layout'];
        $this->header = $row['header'];
        $this->use_name = $row['use_name'];
        $this->use_desc = $row['use_desc'];
        $this->img = $row['img'];
        $this->counter = $row['counter']; 
    }

    function showByIdDefault(){
        $query = "SELECT *
        FROM default_page
        WHERE id = ?
        LIMIT 0,1";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->id = $row['id'];
        $this->page_name = $row['page_name'];
        $this->layout = $row['layout'];
        $this->header = $row['header'];
        $this->use_name = $row['use_name'];
        $this->use_desc = $row['use_desc'];
        $this->img = $row['img'];
        $this->counter = $row['counter']; 
    }

    function showByNameDefault(){
        $query = "SELECT *
        FROM default_page
        WHERE page_name = :page_name
        LIMIT 0,1";
        


        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(':page_name', $this->page_name);       
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->page_name = $row['page_name'];
        $this->layout = $row['layout'];
        $this->header = $row['header'];
        $this->use_name = $row['use_name'];
        $this->use_desc = $row['use_desc'];
        $this->img = $row['img'];
        $this->counter = $row['counter']; 


    }


 // delete the post
 function delete(){

    if($this->type=="default"){
        $this->table="default_page";
    }else if($this->type=="custom"){
        $this->table="page";
        $this->setNo_mod = ", no_mod = :no_mod";
    }

    $name=$this->page_name;
    
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);

    if($stmt->execute()){
        $query1 = "DELETE FROM menu WHERE pagename = :pagename";
        
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->bindParam(":pagename", $name);
        if($stmt1->execute()){
            return true;
        }else{
            $this->showError($stmt1);
            return false;
        }  
        
    }else{
        return false;
    }
}




}

?>