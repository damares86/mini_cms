<?php

class Settings{
    
    private $conn;
    private $table_name = "settings";

    public $id;
    public $site_name;
    public $site_description;
    public $use_text;
    public $footer;
    public $dashboard_language;
    public $theme;
    public $dm;
    public $file_name;
    public $file_tmp_name;
    public $use_logo;
    public $actual_logo;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

  
    function update(){
        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    site_name = :site_name,
                    use_text = :use_text,
                    use_logo = :use_logo,
                    footer = :footer
                WHERE
                    id = :id";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':site_name', $this->site_name);
        $stmt->bindParam(':use_text', $this->use_text); 
        $stmt->bindParam(':use_logo', $this->use_logo); 
        $stmt->bindParam(':footer', $this->footer); 
        $stmt->bindParam(':id', $this->id);
        
        
      
        // execute the query, also check if query was successful
        if($stmt->execute()){
            if($this->file_name!=$this->actual_logo){
                if($this->uploadImg()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return true;
            }

        }else{
            $this->showError($stmt);
            return false;
        }
    
    }



    function updateTheme(){
        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    theme = :theme";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        
        $stmt->bindParam(':theme', $this->theme); 
        
                
      
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;

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


    function showSettings(){
        $query = "SELECT
                    *
                FROM
                " . $this->table_name . "";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    }

    function updateCheck(){
        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    dm = :dm
                WHERE
                    id = :id";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':dm', $this->dm);
        $stmt->bindParam(':id', $this->id);
        
                
      
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;

        }else{
            $this->showError($stmt);
            return false;
        }
    
    }

    function uploadImg(){
        

            $target_directory = "../../uploads/img/";
            $target_file = $target_directory . $this->file_name;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
            $file_upload_error_messages="";
            
            $allowed_file_types=array("jpg", "JPG", "png","svg");
            if(!in_array($file_type, $allowed_file_types)){
                header("Location: ../index.php?man=settings");
		        exit;
            }
            
            // if(file_exists($target_file)){
            //     $file_upload_error_messages.="File already exists";
            // }
            
            // make sure submitted file is not too large, can't be larger than 5 MB
            // if($_FILES['myfile']['size'] > (5120000)){
                //     $file_upload_error_messages.="<div>Doc must be less than 5 MB in size.</div>";
                // }
                
                // make sure the 'uploads' folder exists
                // if not, create it
                if(!is_dir($target_directory)){
                    $oldmask = umask(0);
                    mkdir($target_directory, 0777, true);
                    umask($oldmask);
                }else{
                    $oldmask = umask(0);
                    chmod($target_directory, 0777);
                    umask($oldmask);
                }
            
                
                // the physical file on a temporary uploads directory on the server
                $file = $_FILES['myfile']['tmp_name'];
      
                
				if (move_uploaded_file($file, $target_file)) {
                    $oldmask = umask(0);
                    chmod($target_file, 0777);
                    umask($oldmask);
                    $query = "UPDATE
                    " . $this->table_name . "
                    SET
                    logo = :logo";
                
                    // prepare the query
                    $stmt = $this->conn->prepare($query);
                            
                   
                    // sanitize
                    // $this->rolename=htmlspecialchars(strip_tags($this->title));
                
                    // bind the values
                    $stmt->bindParam(':logo', $this->file_name);
                   
                    // execute the query, also check if query was successful
                    if($stmt->execute()){
                        return true;
                    }else{
                        $this->showError($stmt);
                        return false;
                    }
				
				
                } else {
                    return false;
                }   
        	
   
 
    }
    
    function showLangAndName(){
        $query = "SELECT
                    *
                FROM
                " . $this->table_name . "";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->dashboard_language = $row['dashboard_language'];
        $this->site_name = $row['site_name'];
    }

   
    }

?>