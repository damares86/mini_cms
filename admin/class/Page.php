<?php

class Page{


    private $conn;
    private $table_name = "page";
    private $setParam2;
    private $setParam3;
    private $setParam4;

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
       
      
        if($this->block2){
            $this->setParam2 = ", block2 = :block2, block2_bg = :block2_bg";
         
        } 
    
        if($this->block3){
            $this->setParam3 = ", block3 = :block3, block3_bg = :block3_bg";
        }
 
        if($this->block4){
            $this->setParam4 = ", block4 = :block4, block4_bg = :block4_bg";
        }
        // insert query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    page_name = :page_name,
                    block1 = :block1,
                    block1_bg = :block1_bg". $this->setParam2 . $this->setParam3 . $this->setParam4 . "";
                  
        // prepare the query
        $stmt = $this->conn->prepare($query);
        
        // bind the values
        $stmt->bindParam(':page_name', $this->page_name);       
        $stmt->bindParam(':block1', $this->block1);       
        $stmt->bindParam(':block1_bg', $this->block1_bg);       
        if($this->block2){
            $stmt->bindParam(':block2', $this->block2);       
            $stmt->bindParam(':block2_bg', $this->block2_bg);       
        }
        if($this->block3){
            $stmt->bindParam(':block3', $this->block3);       
            $stmt->bindParam(':block3_bg', $this->block3_bg);       
        }
        if($this->block4){
            $stmt->bindParam(':block4', $this->block4);       
            $stmt->bindParam(':block4_bg', $this->block4_bg);       
        }
      
        // execute the query, also check if query was successful
        if($stmt->execute()){
            
            return true;
            print_r("ok");
            exit;
        }else{
            $this->showError($stmt);
            return false;
            print_r("ko");
            exit;
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
        $this->page_name = $row['page_name'];
    //     $this->content = $row['content'];
    //     $this->category_id = $row['category_id'];
    //     $this->modified = $row['modified'];
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