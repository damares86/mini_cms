<?php

class Time{


    private $conn;
    private $table_name = "time";

    public $id;
    public $mass;
    public $office;


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
                    " . $this->table_name . "
                SET
                mass = :mass,
                office = :office
                WHERE
                id = :id";
                // prepare the query
                $stmt = $this->conn->prepare($query);
                
                // bind the values
                $stmt->bindParam(':mass', $this->mass);       
                $stmt->bindParam(':office', $this->office);   
                $stmt->bindParam(':id', $this->id);
                    
      
        // execute the query, also check if query was successful
        if($stmt->execute()){

            return true;

        }else{
            $this->showError($stmt);
            return false;
        }
    
    }
    
    function test(){
        echo "ciao";
    }

    
    function showAll(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name."";  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }


}

?>