<?php

class Contact{


    private $conn;
    private $table_name = "contacts";

    public $id;
    public $label;
    public $email;

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
                    label = :label,
                    email = :email";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->color=htmlspecialchars(strip_tags($this->label));
        $this->color=htmlspecialchars(strip_tags($this->email));
    
        // bind the values
        $stmt->bindParam(':label', $this->label);
        $stmt->bindParam(':email', $this->email);
        
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    
    }


    function update(){

        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    email = :email
                WHERE
                    id = :id";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id', $this->id);
                
      
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

    function showAllContacts(){
        
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                    WHERE NOT id=1
                ORDER BY
                    id";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    function delete(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
    
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }  
    }

}