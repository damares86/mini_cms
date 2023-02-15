<?php

    ##############    Mini Cms    ##############
    #                                          #
    #           A project by DM WebLab         #
    #   Website: https://www.dmweblab.com     #
    #   GitHub: https://github.com/damares86   #
    #                                          #
    ############################################

class User{
    
    private $conn;
    private $table_name = "accounts";
    private $setRolename;

    public $id;
    public $username;
    public $password;
    public $rolename;
    public $email;
    public $last_login;
    public $token;
    public $expDate;
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


   // create new user record
    function create(){
    
        // insert query
        $query = "INSERT INTO
                    " .$this->prx. $this->table_name . "
                SET
                    username = :username,
                    password = :password,
                    email = :email,
                    rolename = :rolename";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->rolename=htmlspecialchars(strip_tags($this->rolename));
    
        // bind the values
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':rolename', $this->rolename);
    
        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $password_hash);
    
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    
    }

    function update(){
        if($this->rolename){
            $this->setRolename=", rolename = :rolename";
        }
        // insert query
        $query = "UPDATE
                    " .$this->prx. $this->table_name . "
                SET
                    username = :username,
                    email = :email" . $this->setRolename . "
                WHERE
                    id = :id";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email); 
        if($this->rolename){
            $stmt->bindParam(':rolename', $this->rolename);
        }
        $stmt->bindParam(':id', $this->id);
                
      
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;

        }else{
            $this->showError($stmt);
            return false;
        }
    
    }

    function updatePass(){
        // insert query
        $query = "UPDATE
                    " .$this->prx. $this->table_name . "
                SET
                    password = :password
                WHERE
                    id = :id";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
       // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':id', $this->id);
                
      
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;

        }else{
            $this->showError($stmt);
            return false;
        }
    
    }

    function updateLog($time){
        $query="UPDATE 
        " .$this->prx. $this->table_name . "
            SET last_login=:last_login 
            WHERE username = :username";

        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(':last_login', $time);
        $stmt->bindParam(':username', $this->username);
        
        if($stmt->execute()){
            return true;

        }else{
            $this->showError($stmt);
            return false;
        }

    }

    public function findToken(){
    
        $query = "SELECT * FROM ".$this->prx."password_reset_temp WHERE
                ( email = :email AND token = :token)";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':token', $this->token);
        $stmt->execute();
        
        return $stmt;
    }


    function showAll($from_record_num, $records_per_page, $where){
        $query = "SELECT
                    *
                FROM
                " .$this->prx. $this->table_name . "
                WHERE NOT
                    rolename='Admin'".$where."
                ORDER BY
                    username ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    }

    function showById(){
        $query = "SELECT *
        FROM " .$this->prx. $this->table_name . "
        WHERE id = :id
        LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->id = $row['id'];
        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->rolename = $row['rolename'];
        $this->last_login = $row['last_login'];
    }

    function showByEmail(){
        $query = "SELECT *
        FROM " .$this->prx. $this->table_name . "
        WHERE email = :email
        LIMIT 0,1";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->id = $row['id'];
        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->rolename = $row['rolename'];
    }


    function showEmailPass(){
        $query = "SELECT *
        FROM ".$this->prx."password_reset_temp
        WHERE email = :email
        LIMIT 0,1";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(':email', $this->email);
                $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->expDate = $row['expDate'];
    }



    public function countAll(){
    
        $query = "SELECT id FROM ".$this->prx."accounts WHERE NOT id=1";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }

    public function countFetch($where){
    
        $query = "SELECT id FROM ".$this->prx."accounts WHERE NOT id=1 ".$where."";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }


    // check if given email exist in the database
    function emailExists(){
    
        // query to check if email exists
        $query = "SELECT id, username, password, rolename
                FROM " .$this->prx. $this->table_name . "
                WHERE email = ?
                LIMIT 0,1";
    
        // prepare the query
        $stmt = $this->conn->prepare( $query );
    
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
    
        // bind given email value
        $stmt->bindParam(1, $this->email);
    
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
            $this->username = $row['username'];
            $this->password = $row['password'];
            $this->rolename = $row['rolename'];
    
            // return true because email exists in the database
            return true;
        }
    
        // return false if email does not exist in the database
        return false;
    }

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