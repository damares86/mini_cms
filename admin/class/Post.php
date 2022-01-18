<?php

class Post{


    private $conn;
    private $table_name = "post";

    public $id;
    public $title;
    public $content;
    public $created;
    public $modified;

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
                    created = NOW(),
                    modified = NOW()";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // bind the values
        $stmt->bindParam(':title', $this->title);       
        $stmt->bindParam(':content', $this->content);       
      
        // execute the query, also check if query was successful
        if($stmt->execute()){
            print_r("ok2");
            exit;
            return true;

        }else{
            print_r("ko");
            exit;
            $this->showError($stmt);
            return false;
        }
    
    }

    function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }

// DA CAPIRE
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

    
 // delete the role
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


    // function showById($id){
        
    //     //select all data
    //     $query = "SELECT
    //                 rolename
    //             FROM
    //                 " . $this->table_name . "
    //             WHERE
    //                 id = ".$id."";  
        
    //     $stmt = $this->conn->prepare( $query );
        
    //     $stmt->execute();
    //     return $stmt;

    // }

    // function rolename_id(){
    //     //select all data
    //     $query = "SELECT
    //                 id, rolename
    //             FROM
    //                 " . $this->table_name . "
    //             WHERE
    //                 rolename = :rolename";  
  
    //     $stmt = $this->conn->prepare( $query );
    //     $stmt->execute();
  
    //     return $stmt;
    // }



}

?>