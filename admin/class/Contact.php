<?php

    ##############    Mini Cms    ##############
    #                                          #
    #           A project by DM WebLab         #
    #   Website: https://www.dmweblab.com      #
    #   GitHub: https://github.com/damares86   #
    #                                          #
    ############################################

class Contact{


    private $conn;
    private $table_name = "contacts";

    public $id;
    public $label;
    public $email;
    public $prx;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }

    // create new contact record
    function create(){
    
        // insert query
        $query = "INSERT INTO
                    " .$this->prx. $this->table_name . "
                SET
                    label = :label,
                    email = :email";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->label=htmlspecialchars(strip_tags($this->label));
        $this->email=htmlspecialchars(strip_tags($this->email));
    
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
                    " .$this->prx. $this->table_name . "
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

    function showAll(){
        
        //select all data
        $query = "SELECT
                    *
                FROM
                    " .$this->prx. $this->table_name . "
                ORDER BY
                    id";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    // show only contacts for the form, not the noreply mail
    function showAllContacts(){
        
        //select all data
        $query = "SELECT
                    *
                FROM
                    " .$this->prx. $this->table_name . "
                    WHERE NOT id=1
                ORDER BY
                    id";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    function delete(){
        
        $query = "DELETE FROM " .$this->prx. $this->table_name . " WHERE id = :id";
        
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