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
    public $img;
    public $counter;
    public $in_menu;
    public $item_order;
    public $parent;
    public $child_of;

    // constructor
    public function __construct($db){
        $this->conn = $db;
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
            $this->uploadPhoto();

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
        
        if($this->type=="custom"||($this->type=="default"&&$this->id==1)){
            
       
            if($this->block2){
                $this->setParam2 = ", block2 = :block2";
                
            } 
            
            if($this->block3){
                $this->setParam3 = ", block3 = :block3";
            }
            
            if($this->block4){
                $this->setParam4 = ", block4 = :block4";
            }

            if($this->block5){
                $this->setParam5 = ", block5 = :block5";
            }
            
            if($this->block6){
                $this->setParam6 = ", block6 = :block6";
            }


            $stmt="";

                $query = "UPDATE
                " . $this->table . "
                SET
                page_name = :page_name".$this->setNo_mod.",
                layout = :layout,
                header = :header,
                block1_type = :block1_type,
                block1 = :block1,
                block1_bg = :block1_bg,
                block1_text = :block1_text,
                block2_type = :block2_type, 
                block2_bg = :block2_bg, 
                block2_text = :block2_text". $this->setParam2 .", 
                block3_type = :block3_type, 
                block3_text = :block3_text, 
                block3_bg = :block3_bg". $this->setParam3 .", 
                block4_type = :block4_type, 
                block4_text = :block4_text, 
                block4_bg = :block4_bg". $this->setParam4 .", 
                block5_type = :block5_type, 
                block5_text = :block5_text, 
                block5_bg = :block5_bg". $this->setParam5 .", 
                block6_type = :block6_type, 
                block6_text = :block6_text, 
                block6_bg = :block6_bg". $this->setParam6 . " WHERE id = :id";
              
                // prepare the query
                $stmt = $this->conn->prepare($query);

                // bind the values
                $stmt->bindParam(':page_name', $this->page_name); 
                if($this->table=="page"){
                    $stmt->bindParam(':no_mod', $this->no_mod);       
                }
                $stmt->bindParam(':layout', $this->layout);    
                $stmt->bindParam(':header', $this->header);    
                $stmt->bindParam(':block1_type', $this->block1_type);       
                $stmt->bindParam(':block1', $this->block1);       
                $stmt->bindParam(':block1_bg', $this->block1_bg);       
                $stmt->bindParam(':block1_text', $this->block1_text);       
                
                $stmt->bindParam(':block2_type', $this->block2_type);       
                if($this->block2){
                    $stmt->bindParam(':block2', $this->block2);       
                }
                $stmt->bindParam(':block2_bg', $this->block2_bg);       
                $stmt->bindParam(':block2_text', $this->block2_text);       

                $stmt->bindParam(':block3_type', $this->block3_type);       
                if($this->block3){
                    $stmt->bindParam(':block3', $this->block3);       
                }
                $stmt->bindParam(':block3_bg', $this->block3_bg);       
                $stmt->bindParam(':block3_text', $this->block3_text);       

                $stmt->bindParam(':block4_type', $this->block4_type);       
                if($this->block4){
                    $stmt->bindParam(':block4', $this->block4);       
                }
                $stmt->bindParam(':block4_bg', $this->block4_bg);       
                $stmt->bindParam(':block4_text', $this->block4_text);       

                $stmt->bindParam(':block5_type', $this->block5_type);          
                if($this->block5){
                    $stmt->bindParam(':block5', $this->block5);       
                }
                $stmt->bindParam(':block5_bg', $this->block5_bg);       
                $stmt->bindParam(':block5_text', $this->block5_text);       
            
                $stmt->bindParam(':block6_type', $this->block6_type);       
                if($this->block6){
                    $stmt->bindParam(':block6', $this->block6);       
                }
                $stmt->bindParam(':block6_bg', $this->block6_bg);       
                $stmt->bindParam(':block6_text', $this->block6_text);       
                $stmt->bindParam(':id', $this->id);    

            }else if($this->type=="default"&&$this->id!=1){

                $query = "UPDATE
                    default_page
                    SET
                    header = :header
                    WHERE
                    id = :id";

                    $stmt = $this->conn->prepare($query);
                    
                    $stmt->bindParam(':header', $this->header);      
                    $stmt->bindParam(':id', $this->id);   
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

                    // $id= $this->id-2;
                    
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

                        if($this->uploadPhoto()){
                            return true;
                        }else{
                            return false;
                        }
                    }
                }
                return true;

            }else{
                $this->showError($stmt);
                return false;
            }
        // } else {
        //     $query1="SELECT * FROM default_page WHERE page_name = :page_name LIMIT 0,1";
        //         $stmt1 = $this->conn->prepare($query1);
        //         $stmt1->bindParam(':page_name', $this->page_name);       
        //         $stmt1->execute();
        //         $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
        //         $actualImage=$row1['img'];
        //         if(($this->img)==$actualImage){
        //             return true;
        //         }else{
        //             if($this->uploadPhoto()){
        //                 return true;
        //             }else{
        //                 return false;
        //             }
        //         }
                
        // }
    
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
   

    function showAllCustom($from_record_num, $records_per_page){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
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
        $this->block1_type = $row['block1_type'];
        $this->block1 = $row['block1'];
        $this->block1_bg = $row['block1_bg'];
        $this->block1_text = $row['block1_text'];
        $this->block2_type = $row['block2_type'];
        $this->block2 = $row['block2'];
        $this->block2_bg = $row['block2_bg'];
        $this->block2_text = $row['block2_text'];
        $this->block3_type = $row['block3_type'];
        $this->block3 = $row['block3'];
        $this->block3_bg = $row['block3_bg'];
        $this->block3_text = $row['block3_text'];
        $this->block4_type = $row['block4_type'];
        $this->block4 = $row['block4'];
        $this->block4_bg = $row['block4_bg'];
        $this->block4_text = $row['block4_text'];
        $this->block5_type = $row['block5_type'];
        $this->block5 = $row['block5'];
        $this->block5_bg = $row['block5_bg'];
        $this->block5_text = $row['block5_text'];
        $this->block6_type = $row['block6_type'];
        $this->block6 = $row['block6'];
        $this->block6_bg = $row['block6_bg'];
        $this->block6_text = $row['block6_text'];
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
        $this->img = $row['img'];
        $this->block1_type = $row['block1_type'];
        $this->block1 = $row['block1'];
        $this->block1_bg = $row['block1_bg'];
        $this->block1_text = $row['block1_text'];
        $this->block2_type = $row['block2_type'];
        $this->block2 = $row['block2'];
        $this->block2_bg = $row['block2_bg'];
        $this->block2_text = $row['block2_text'];
        $this->block3_type = $row['block3_type'];
        $this->block3 = $row['block3'];
        $this->block3_bg = $row['block3_bg'];
        $this->block3_text = $row['block3_text'];
        $this->block4_type = $row['block4_type'];
        $this->block4 = $row['block4'];
        $this->block4_bg = $row['block4_bg'];
        $this->block4_text = $row['block4_text'];
        $this->block5_type = $row['block5_type'];
        $this->block5 = $row['block5'];
        $this->block5_bg = $row['block5_bg'];
        $this->block5_text = $row['block5_text'];
        $this->block6_type = $row['block6_type'];
        $this->block6 = $row['block6'];
        $this->block6_bg = $row['block6_bg'];
        $this->block6_text = $row['block6_text'];


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
        $this->img = $row['img'];
        $this->block1_type = $row['block1_type'];
        $this->block1 = $row['block1'];
        $this->block1_bg = $row['block1_bg'];
        $this->block1_text = $row['block1_text'];
        $this->block2_type = $row['block2_type'];
        $this->block2 = $row['block2'];
        $this->block2_bg = $row['block2_bg'];
        $this->block2_text = $row['block2_text'];
        $this->block3_type = $row['block3_type'];
        $this->block3 = $row['block3'];
        $this->block3_bg = $row['block3_bg'];
        $this->block3_text = $row['block3_text'];
        $this->block4_type = $row['block4_type'];
        $this->block4 = $row['block4'];
        $this->block4_bg = $row['block4_bg'];
        $this->block4_text = $row['block4_text'];
        $this->block5_type = $row['block5_type'];
        $this->block5 = $row['block5'];
        $this->block5_bg = $row['block5_bg'];
        $this->block5_text = $row['block5_text'];
        $this->block6_type = $row['block6_type'];
        $this->block6 = $row['block6'];
        $this->block6_bg = $row['block6_bg'];
        $this->block6_text = $row['block6_text'];
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
        $this->img = $row['img'];
        $this->block1_type = $row['block1_type'];
        $this->block1 = $row['block1'];
        $this->block1_bg = $row['block1_bg'];
        $this->block1_text = $row['block1_text'];
        $this->block2_type = $row['block2_type'];
        $this->block2 = $row['block2'];
        $this->block2_bg = $row['block2_bg'];
        $this->block2_text = $row['block2_text'];
        $this->block3_type = $row['block3_type'];
        $this->block3 = $row['block3'];
        $this->block3_bg = $row['block3_bg'];
        $this->block3_text = $row['block3_text'];
        $this->block4_type = $row['block4_type'];
        $this->block4 = $row['block4'];
        $this->block4_bg = $row['block4_bg'];
        $this->block4_text = $row['block4_text'];
        $this->block5_type = $row['block5_type'];
        $this->block5 = $row['block5'];
        $this->block5_bg = $row['block5_bg'];
        $this->block5_text = $row['block5_text'];
        $this->block6_type = $row['block6_type'];
        $this->block6 = $row['block6'];
        $this->block6_bg = $row['block6_bg'];
        $this->block6_text = $row['block6_text'];


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