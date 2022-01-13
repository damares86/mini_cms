<?php

class User{
    
    private $conn;
    private $table_name = "accounts";

    public $id;
    public $username;
    public $password;
    public $role_id;
    public $email;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

   // create new user record
    function create(){
    
        // insert query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    username = :username,
                    password = :password,
                    email = :email,
                    role_id = :role_id";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->role_id=htmlspecialchars(strip_tags($this->role_id));
    
        // bind the values
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':role_id', $this->role_id);
    
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

    function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }

    // check if given email exist in the database
    function emailExists(){
    
        // query to check if email exists
        $query = "SELECT id, username, password, role_id
                FROM " . $this->table_name . "
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
            $this->status = $row['role_id'];
    
            // return true because email exists in the database
            return true;
        }
    
        // return false if email does not exist in the database
        return false;
    }


   
    }

?>