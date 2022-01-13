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

    function read(){
        //select all data
        $query = "SELECT
                    id, rolename
                FROM
                    " . $this->table_name . "
                WHERE
                    id != 1
                ORDER BY
                    id";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

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