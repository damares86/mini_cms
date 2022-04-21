<?php

class Post{


    private $conn;
    private $table_name = "t_post";

    public $id;
    public $title;
    public $summary;
    public $content;
    public $modified;
    public $category_id;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // create new role record
    function insert(){
        
        // insert query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    title = :title,
                    summary = :summary,
                    content = :content,
                    category_id = :category_id,
                    modified = NOW()";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
       
        // bind the values
        $stmt->bindParam(':title', $this->title);       
        $stmt->bindParam(':summary', $this->summary);       
        $stmt->bindParam(':content', $this->content);       
        $stmt->bindParam(':category_id', $this->category_id);       
       
      
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

    function update(){
        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                title = :title,
                summary = :summary,
                content = :content,
                category_id = :category_id,
                modified = NOW()
                WHERE
                id = :id";
                // prepare the query
                $stmt = $this->conn->prepare($query);
                
                // bind the values
                $stmt->bindParam(':title', $this->title);
                $stmt->bindParam(':summary', $this->summary);
                $stmt->bindParam(':content', $this->content); 
                $stmt->bindParam(':category_id', $this->category_id);       
                $stmt->bindParam(':id', $this->id);
                    
      
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;

        }else{
            $this->showError($stmt);
            return false;
        }
    
    }

    function showAll($from_record_num, $records_per_page){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id
                    LIMIT
                    {$from_record_num}, {$records_per_page}";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    function showTot(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name ." ";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    public function countAll(){
    
        $query = "SELECT id FROM t_post";
    
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
        $this->title = $row['title'];
        $this->summary = $row['summary'];
        $this->content = $row['content'];
        $this->category_id = $row['category_id'];
        $this->modified = $row['modified'];
    }

    function showByCatId(){
        $query = "SELECT *
        FROM " . $this->table_name . "
        WHERE category_id = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->category_id);
        $stmt->execute();
        
        return $stmt;
   
    
        
    }

 // delete the post
 function delete(){
    
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);

    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}





}

?>