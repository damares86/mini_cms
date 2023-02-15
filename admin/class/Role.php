<?php

    ##############    Mini Cms    ##############
    #                                          #
    #           A project by DM WebLab         #
    #   Website: https://www.dmweblab.com      #
    #   GitHub: https://github.com/damares86   #
    #                                          #
    ############################################

class Role{


    private $conn;
    private $table_name = "roles";

    public $prx;
    public $id;
    public $rolename;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }

    // create new role record
    function create(){
    
        // insert query
        $query = "INSERT INTO
                    " .$this->prx. $this->table_name . "
                SET
                    rolename = :rolename";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->rolename=htmlspecialchars(strip_tags($this->rolename));
    
        // bind the values
        $stmt->bindParam(':rolename', $this->rolename);
        
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    
    }



    function showAll($from_record_num,$records_per_page){
        //select all data
        $query = "SELECT
                    id, rolename
                FROM
                    " .$this->prx. $this->table_name . "
                WHERE NOT
                    rolename='Admin'
                ORDER BY
                    id
                    LIMIT
                    {$from_record_num}, {$records_per_page}";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    function showAllList(){
        //select all data
        $query = "SELECT
                    id, rolename
                FROM
                    " .$this->prx. $this->table_name . "
                WHERE NOT
                    rolename='Admin'
                ORDER BY
                    id";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    public function countAll(){
    
        $query = "SELECT id FROM ".$this->prx."roles";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }

    function roleExists(){
    
        // query to check if email exists
        $query = "SELECT id, rolename
                FROM " .$this->prx. $this->table_name . "
                WHERE rolename = ?
                LIMIT 0,1";
    
        // prepare the query
        $stmt = $this->conn->prepare( $query );
    
        // sanitize
        $this->rolename=htmlspecialchars(strip_tags($this->rolename));
    
        // bind given email value
        $stmt->bindParam(1, $this->rolename);
    
        // execute the query
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
    
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // assign values to object properties
            $this->id = $row['id'];
            $this->rolename = $row['rolename'];
    
            // return true because email exists in the database
            return true;
        }
    
        // return false if email does not exist in the database
        return false;
    }

 // delete the role
 function delete(){
    
    $query = "DELETE FROM " .$this->prx. $this->table_name . " WHERE id = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);

    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}

}

?>