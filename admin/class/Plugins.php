<?php

class Plugins{


    private $conn;
    private $table_name = "plugins";

    public $id;
    public $plugin_name;
    public $description;
    public $active;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // create new role record
    function create(){
    
        // insert query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    plugin_name = :plugin_name,
                    description = :description,
                    active = 0";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
    
        // bind the values
        $stmt->bindParam(':plugin_name', $this->plugin_name);
        $stmt->bindParam(':description', $this->description);
        
        
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    
    }



    function updateActive(){
        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    active = :active
                WHERE
                    plugin_name = :plugin_name";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':active', $this->active);
        $stmt->bindParam(':plugin_name', $this->plugin_name);
                
      
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

    function showByName(){
        $query = "SELECT *
        FROM " . $this->table_name . "
        WHERE plugin_name = :plugin_name
        LIMIT 0,1";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(':plugin_name', $this->plugin_name);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->id = $row['id'];
        $this->plugin_name = $row['plugin_name'];
        $this->description = $row['description'];
        $this->active = $row['active'];
    }


    function delete(){
    
    $query = "DELETE FROM " . $this->table_name . " WHERE plugin_name = :plugin_name";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':plugin_name', $this->plugin_name);

    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

function deletePage(){
    
    $query = "DELETE FROM default_page WHERE page_name = :plugin_name";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':plugin_name', $this->plugin_name);

    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}


}

?>