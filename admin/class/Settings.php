<?php

class Settings{
    
    private $conn;
    private $table_name = "settings";

    public $id;
    public $site_name;
    public $site_description;
    public $dashboard_language = "en";

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
                    site_description = :site_description
                WHERE
                    id = :id";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':site_name', $this->site_name);
        $stmt->bindParam(':site_description', $this->site_description); 
        $stmt->bindParam(':id', $this->id);
        
                
      
        // execute the query, also check if query was successful
        if($stmt->execute()){
            print_r("ok");
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


    function showSettings(){
        $query = "SELECT
                    *
                FROM
                " . $this->table_name . "";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    }

   
    }

?>