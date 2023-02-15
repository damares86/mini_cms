<?php

    ##############    Mini Cms    ##############
    #                                          #
    #           A project by DM WebLab         #
    #   Website: https://www.dmweblab.com      #
    #   GitHub: https://github.com/damares86   #
    #                                          #
    ############################################

class Verify{


    private $conn;
    private $table_name = "verify";

    public $id;
    public $public;
    public $secret;
    public $active;
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


    function update(){
        // insert query
        $query = "UPDATE
                    " .$this->prx. $this->table_name . "
                SET
                    public = :public,
                    secret = :secret,
                    active = :active
                WHERE
                    id = :id";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':public', $this->public);
        $stmt->bindParam(':secret', $this->secret);
        $stmt->bindParam(':active', $this->active);
        $stmt->bindParam(':id', $this->id);
                
      
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
                    " .$this->prx. $this->table_name . "
                SET
                    active = :active
                WHERE
                    id = :id";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':active', $this->active);
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


}

?>