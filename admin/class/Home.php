<?php

    ##############    Mini Cms    ##############
    #                                          #
    #           A project by DM WebLab         #
    #   Website: https://www.dmweblab.com      #
    #   GitHub: https://github.com/damares86   #
    #                                          #
    ############################################

class Home{


    private $conn;
    private $table_name = "view_home";

    public $id;
    public $name_function;
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


    // create new home record
    function create(){
        // insert query
        $query = "INSERT INTO
                    " .$this->prx. $this->table_name . "
                SET
                    name_function = :name_function";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
    
        // bind the values
        $stmt->bindParam(':name_function', $this->name_function);
        
        
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



    function delete(){
    
    $query = "DELETE FROM " .$this->prx. $this->table_name . " WHERE name_function = :name_function";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':name_function', $this->name_function);

    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}


}

?>