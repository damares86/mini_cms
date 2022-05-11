<?php

class Page{


    private $conn;
    private $table_name = "page";
    private $setParam2;
    private $setParam3;
    private $setParam4;
    private $setParam5;
    private $setParam6; 


    public $type;
    public $theme;
    public $id;
    public $page_name;
    public $layout;
    public $header;
    public $img;
    public $in_menu;
    public $item_order;
    public $parent;
    public $child_of;
    public $block1;
    public $block1_bg;
    public $block1_text;
    public $block2;
    public $block2_bg;
    public $block2_text;
    public $block3;
    public $block3_bg;
    public $block3_text;
    public $block4;
    public $block4_bg;
    public $block4_text;
    public $block5;
    public $block5_bg;
    public $block5_text;
    public $block6;
    public $block6_bg;
    public $block6_text;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // create new role record
    function insert(){
        if($this->block2){
            $this->setParam2 = ", block2 = :block2, block2_bg = :block2_bg, block2_text = :block2_text";
         
        } 
    
        if($this->block3){
            $this->setParam3 = ", block3 = :block3, block3_bg = :block3_bg, block3_text = :block3_text";
        }
 
        if($this->block4){
            $this->setParam4 = ", block4 = :block4, block4_bg = :block4_bg, block4_text = :block4_text";
        }

        if($this->block5){
            $this->setParam5 = ", block5 = :block5, block5_bg = :block5_bg, block5_text = :block5_text";
        }
        
        if($this->block6){
            $this->setParam6 = ", block6 = :block6, block6_bg = :block6_bg, block6_text = :block6_text";
        }
        // insert query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    page_name = :page_name,
                    layout = :layout,
                    header = :header,
                    block1 = :block1,
                    block1_bg = :block1_bg,
                    block1_text = :block1_text". $this->setParam2 . $this->setParam3 . $this->setParam4 . $this->setParam5 . $this->setParam6 . "";
                  
        // prepare the query
        $stmt = $this->conn->prepare($query);
        
        // bind the values
        $stmt->bindParam(':page_name', $this->page_name);       
        $stmt->bindParam(':layout', $this->layout);    
        $stmt->bindParam(':header', $this->header);    
        $stmt->bindParam(':block1', $this->block1);       
        $stmt->bindParam(':block1_bg', $this->block1_bg);       
        $stmt->bindParam(':block1_text', $this->block1_text);       
        if($this->block2){
            $stmt->bindParam(':block2', $this->block2);       
            $stmt->bindParam(':block2_bg', $this->block2_bg);       
            $stmt->bindParam(':block2_text', $this->block2_text);       
        }
        if($this->block3){
            $stmt->bindParam(':block3', $this->block3);       
            $stmt->bindParam(':block3_bg', $this->block3_bg);       
            $stmt->bindParam(':block3_text', $this->block3_text);       
        }
        if($this->block4){
            $stmt->bindParam(':block4', $this->block4);       
            $stmt->bindParam(':block4_bg', $this->block4_bg);       
            $stmt->bindParam(':block4_text', $this->block4_text);       
        }
       
        if($this->block5){
            $stmt->bindParam(':block5', $this->block5);       
            $stmt->bindParam(':block5_bg', $this->block5_bg);       
            $stmt->bindParam(':block5_text', $this->block5_text);       
        }
       
        if($this->block6){
            $stmt->bindParam(':block6', $this->block6);       
            $stmt->bindParam(':block6_bg', $this->block6_bg);       
            $stmt->bindParam(':block6_text', $this->block6_text);       
        }
      
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
        if($this->id!=2 && $this->id!=3){
            if($this->block2||$this->block2==NULL){
                $this->setParam2 = ", block2 = :block2, block2_bg = :block2_bg, block2_text = :block2_text";
                
            } 
            
            if($this->block3||$this->block3==NULL){
                $this->setParam3 = ", block3 = :block3, block3_bg = :block3_bg, block3_text = :block3_text";
            }
            
            if($this->block4||$this->block4==NULL){
                $this->setParam4 = ", block4 = :block4, block4_bg = :block4_bg, block4_text = :block4_text";
            }

            if($this->block5||$this->block5==NULL){
                $this->setParam5 = ", block5 = :block5, block5_bg = :block5_bg, block5_text = :block5_text";
            }
            
            if($this->block6||$this->block6==NULL){
                $this->setParam6 = ", block6 = :block6, block6_bg = :block6_bg, block6_text = :block6_text";
            }


            $stmt="";

            if($this->type=="custom"){
                $query = "UPDATE
                        " . $this->table_name . "
                    SET
                    layout = :layout,
                    header = :header,
                    block1 = :block1,
                    block1_bg = :block1_bg,
                    block1_text = :block1_text". $this->setParam2 . $this->setParam3 . $this->setParam4 . $this->setParam5 . $this->setParam6 . "
                    WHERE
                    id = :id";

                    // prepare the query
                    $stmt = $this->conn->prepare($query);
                

                    // bind the values
                    $stmt->bindParam(':layout', $this->layout);      
                    $stmt->bindParam(':header', $this->header);      
                    $stmt->bindParam(':block1', $this->block1);       
                    $stmt->bindParam(':block1_bg', $this->block1_bg);       
                    $stmt->bindParam(':block1_text', $this->block1_text);       
                    if($this->setParam2){
                        $stmt->bindParam(':block2', $this->block2);       
                        $stmt->bindParam(':block2_bg', $this->block2_bg);       
                        $stmt->bindParam(':block2_text', $this->block2_text);       
                    }
                    
                    if($this->setParam3){
                        $stmt->bindParam(':block3', $this->block3);       
                        $stmt->bindParam(':block3_bg', $this->block3_bg);       
                        $stmt->bindParam(':block3_text', $this->block3_text);       
                    }
                    if($this->setParam4){
                        $stmt->bindParam(':block4', $this->block4);       
                        $stmt->bindParam(':block4_bg', $this->block4_bg);       
                        $stmt->bindParam(':block4_text', $this->block4_text);       
                    }
                    if($this->setParam5){
                        $stmt->bindParam(':block5', $this->block5);       
                        $stmt->bindParam(':block5_bg', $this->block5_bg);       
                        $stmt->bindParam(':block5_text', $this->block5_text);       
                    }
                    if($this->setParam6){
                        $stmt->bindParam(':block6', $this->block6);       
                        $stmt->bindParam(':block6_bg', $this->block6_bg);       
                        $stmt->bindParam(':block6_text', $this->block6_text);       
                    }
                    $stmt->bindParam(':id', $this->id);       

            }else if($this->type=="default"){

                $query = "UPDATE
                " . $this->table_name . "
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
                $query1="SELECT * FROM ".$this->table_name." WHERE page_name = :page_name LIMIT 0,1";
                $stmt1 = $this->conn->prepare($query1);
                $stmt1->bindParam(':page_name', $this->page_name);       
                $stmt1->execute();
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                $actualImage=$row1['img'];
                if(($this->img)==$actualImage){
                    return true;
                    
                }else{
                    if($this->uploadPhoto()){
                        return true;
                    }else{
                        return false;
                    }
                }
                return true;

            }else{
                $this->showError($stmt);
                return false;
            }
        } else {
            $query1="SELECT * FROM ".$this->table_name." WHERE page_name = :page_name LIMIT 0,1";
                $stmt1 = $this->conn->prepare($query1);
                $stmt1->bindParam(':page_name', $this->page_name);       
                $stmt1->execute();
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                $actualImage=$row1['img'];
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
    
    }

    function uploadPhoto(){
        
        if($this->img){
            
            $target_directory = "../../assets/".$this->theme."/img/";
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
                    $file_upload_error_messages.="File already exists";
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
            $query2 = "UPDATE " . $this->table_name . "
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
                WHERE id>7
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
                    " . $this->table_name . "
                WHERE id BETWEEN 1 AND 7
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


    public function countAll(){
    
        $query = "SELECT id FROM page";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }

    public function countAllCustom(){
    
        $query = "SELECT id FROM page WHERE id > 7";
    
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
        $this->layout = $row['layout'];
        $this->header = $row['header'];
        $this->img = $row['img'];
        $this->block1 = $row['block1'];
        $this->block1_bg = $row['block1_bg'];
        $this->block1_text = $row['block1_text'];
        $this->block2 = $row['block2'];
        $this->block2_bg = $row['block2_bg'];
        $this->block2_text = $row['block2_text'];
        $this->block3 = $row['block3'];
        $this->block3_bg = $row['block3_bg'];
        $this->block3_text = $row['block3_text'];
        $this->block4 = $row['block4'];
        $this->block4_bg = $row['block4_bg'];
        $this->block4_text = $row['block4_text'];
        $this->block5 = $row['block5'];
        $this->block5_bg = $row['block5_bg'];
        $this->block5_text = $row['block5_text'];
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
        $this->layout = $row['layout'];
        $this->header = $row['header'];
        $this->img = $row['img'];
        $this->block1 = $row['block1'];
        $this->block1_bg = $row['block1_bg'];
        $this->block1_text = $row['block1_text'];
        $this->block2 = $row['block2'];
        $this->block2_bg = $row['block2_bg'];
        $this->block2_text = $row['block2_text'];
        $this->block3 = $row['block3'];
        $this->block3_bg = $row['block3_bg'];
        $this->block3_text = $row['block3_text'];
        $this->block4 = $row['block4'];
        $this->block4_bg = $row['block4_bg'];
        $this->block4_text = $row['block4_text'];
        $this->block5 = $row['block5'];
        $this->block5_bg = $row['block5_bg'];
        $this->block5_text = $row['block5_text'];
        $this->block6 = $row['block6'];
        $this->block6_bg = $row['block6_bg'];
        $this->block6_text = $row['block6_text'];


    }
 // delete the post
 function delete(){
    
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);

    if($result = $stmt->execute()){
        
        $query1 = "DELETE FROM menu WHERE id = ?";
    
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->bindParam(1, $this->id);
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