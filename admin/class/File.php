<?php

    ##############    Mini Cms    ##############
    #                                          #
    #           A project by DM WebLab         #
    #   Website: https://www.dmweblab.com      #
    #   GitHub: https://github.com/damares86   #
    #                                          #
    ############################################

class File{


    private $conn;
    private $table_name = "files";

    public $id;
    public $filename;
    public $title;
    public $category_id;
    public $rolename;
    public $file;
    public $image;
    public $operation;
    public $prx;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function uploadFile(){
        
        if($this->filename){

            $target_directory = "../../uploads/";
            $target_file = $target_directory . $this->filename;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
            $file_upload_error_messages="";
            
            $allowed_file_types=array("pdf", "doc", "docx", "zip");
            if(!in_array($file_type, $allowed_file_types)){
                header("Location: ../index.php?man=partfiles&op=show&msg=formatErr");
		        exit;
            }
            
            if(file_exists($target_file)){
                $file_upload_error_messages.="File already exists";
            }

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
            
            if(empty($file_upload_error_messages)){                
                
                // the physical file on a temporary uploads directory on the server
                $file = $_FILES['myfile']['tmp_name'];
      
                
				if (move_uploaded_file($file, $target_file)) {
                    $oldmask = umask(0);
                    chmod($target_file, 0777);
                    umask($oldmask);
                    $query="";
                    if($this->operation=="add"){
                    $query = "INSERT INTO
                                " .$this->prx. $this->table_name . "
                            SET
                            filename = :filename,
                            title = :title";
                        }else if($this->operation=="edit"){
                            $query = "UPDATE
                            " .$this->prx. $this->table_name . "
                            SET
                            filename = :filename,
                            title = :title
                            WHERE 
                            id = :id";
                        }
                            // prepare the query
                            $stmt = $this->conn->prepare($query);
                       
                    // bind the values
                    $stmt->bindParam(':filename', $this->filename);
                    $stmt->bindParam(':title', $this->title);
                    if($this->operation=="edit"){
                        $stmt->bindParam(':id', $this->id);
                    }
                   
                    // execute the query, also check if query was successful
                    if($stmt->execute()){
                        return true;
                    }else{
                        $this->showError($stmt);
                        return false;
                    }
				
				
                } else {
                    echo "Failed to upload file.";
                }   
        	}
        }
 
    }


    function showAll($from_record_num, $records_per_page,$where){
        //select all data
        $query = "SELECT
            *
        FROM
            " .$this->prx. $this->table_name . " ".$where."
        ORDER BY
            id 
        LIMIT
        {$from_record_num}, {$records_per_page}";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    public function countAll(){
    
        $query = "SELECT id FROM " .$this->prx."files";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }

    public function countFetch($where){
    
        $query = "SELECT id FROM " .$this->prx."files".$where."";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }

    function uploadPhoto(){
    
        $result_message="";
    
        // now, if image is not empty, try to upload the image
        if($this->image){
    
            $target_directory = "../uploads/img/";
            $target_file = $target_directory . $this->image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
    
            // error message is empty
            $file_upload_error_messages="";

            // make sure that file is a real image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
                // submitted file is an image
            }else{
                $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
            }
            
            // make sure certain file types are allowed
            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }
            
            // make sure file does not exist
            if(file_exists($target_file)){
                $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }
            
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['image']['size'] > (5120000)){
                $file_upload_error_messages.="<div>Image must be less than 5 MB in size.</div>";
            }
            
            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                $oldmask = umask(0);
                mkdir($target_directory, 0777, true);
                umask($oldmask);
            }

            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload photo.</div>";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
            }
            
            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="{$file_upload_error_messages}";
                    $result_message.="<div>Update the record to upload photo.</div>";
                $result_message.="</div>";
            }
        }
    
        return $result_message;
    }

    function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }

    function update(){
        // insert query
        $query = "UPDATE
                    " .$this->prx. $this->table_name . "
                SET
                title = :title
                WHERE
                    id = :id";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':id', $this->id);
                
      
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;

        }else{
            $this->showError($stmt);
            return false;
        }
    
    }



 // delete the file
 function delete(){
    
    $query = "DELETE FROM " .$this->prx. $this->table_name . " WHERE id = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);

    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}


function showById(){
    $query = "SELECT *
    FROM " .$this->prx. $this->table_name . "
    WHERE id = ?
    LIMIT 0,1";

    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id = $row['id'];
    $this->filename = $row['filename'];
    $this->title = $row['title'];
    $this->category_id = $row['category_id'];


    }



}

?>