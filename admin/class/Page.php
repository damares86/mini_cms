<?php

class Page{


    private $conn;
    private $table_name = "post";

    public $id;
    public $page_name;
    public $block1;
    public $block1_bg;
    public $block2;
    public $block2_bg;
    public $block3;
    public $block3_bg;
    public $block4;
    public $block4_bg;

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
                    content = :content,
                    category_id = :category_id,
                    modified = NOW()";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
       
        // bind the values
        $stmt->bindParam(':title', $this->title);       
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
                    content = :content,
                    category_id = :category_id,
                    modified = NOW()
                WHERE
                    id = :id";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':title', $this->title);
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

    function showAll(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    public function countAll(){
    
        $query = "SELECT id FROM post";
    
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
        $this->content = $row['content'];
        $this->category_id = $row['category_id'];
        $this->modified = $row['modified'];
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