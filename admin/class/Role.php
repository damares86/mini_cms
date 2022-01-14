<?php

class Role{


    private $conn;
    private $table_name = "roles";

    public $id;
    public $rolename;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function showAll(){
        //select all data
        $query = "SELECT
                    id, rolename
                FROM
                    " . $this->table_name . "
                WHERE NOT
                    rolename='Admin'
                ORDER BY
                    id";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    public function countAll(){
    
        $query = "SELECT id FROM roles";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
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