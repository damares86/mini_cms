<?php

class Plugins{


    private $conn;
    private $table_name = "plugins";

    public $id;
    public $plugin_name;
    public $active;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // create new role record
    function create(){
    
        // insert query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    plugin_name = :plugin_name,
                    active = :active";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
    
        // bind the values
        $stmt->bindParam(':plugin_name', $this->plugin_name);
        $stmt->bindParam(':active', $this->active);
        
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
                    " . $this->table_name . "
                SET
                    plugin_name = :plugin_name,
                    active = :active
                WHERE
                    id = :id";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':plugin_name', $this->plugin_name);
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
                    " . $this->table_name . "
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

    function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }


    function showAll(){
        
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    function showByName(){
        $query = "SELECT *
        FROM " . $this->table_name . "
        WHERE plugin_name = :plugin_name
        LIMIT 0,1";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(':plugin_name', $this->plugin_name);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->id = $row['id'];
        $this->plugin_name = $row['plugin_name'];
        $this->active = $row['active'];
    }

    // function showAllList(){
    //     //select all data
    //     $query = "SELECT
    //                 id, color
    //             FROM
    //                 " . $this->table_name . "
    //             ORDER BY
    //                 color";  
  
    //     $stmt = $this->conn->prepare( $query );
    //     $stmt->execute();
  
    //     return $stmt;
    // }

    // public function countAll(){
    
    //     $query = "SELECT id FROM color";
    
    //     $stmt = $this->conn->prepare( $query );
    //     $stmt->execute();
    
    //     $num = $stmt->rowCount();
    
    //     return $num;
    // }

//     function showById(){
//         $query = "SELECT *
//         FROM " . $this->table_name . "
//         WHERE id = ?
//         LIMIT 0,1";
  
//         $stmt = $this->conn->prepare( $query );
//         $stmt->bindParam(1, $this->id);
//         $stmt->execute();
    
//         $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
//         $this->id = $row['id'];
//         $this->username = $row['username'];
//         $this->email = $row['email'];
//         $this->rolename = $row['rolename'];
//     }


//     function colorExists(){
    
//         // query to check if email exists
//         $query = "SELECT id, color
//                 FROM " . $this->table_name . "
//                 WHERE color = ?
//                 LIMIT 0,1";
    
//         // prepare the query
//         $stmt = $this->conn->prepare( $query );
    
//         // sanitize
//         $this->color=htmlspecialchars(strip_tags($this->color));
    
//         // bind given email value
//         $stmt->bindParam(1, $this->color);
    
//         // execute the query
//         $stmt->execute();
    
//         // get number of rows
//         $num = $stmt->rowCount();
    
//         // if email exists, assign values to object properties for easy access and use for php sessions
//         if($num>0){
    
//             // get record details / values
//             $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
//             // assign values to object properties
//             $this->id = $row['id'];
//             $this->status = $row['color'];
    
//             // return true because email exists in the database
//             return true;
//         }
    
//         // return false if email does not exist in the database
//         return false;
//     }

//  // delete the role
//  function delete(){
    
//     $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
//     $stmt = $this->conn->prepare($query);
//     $stmt->bindParam(1, $this->id);

//     if($result = $stmt->execute()){
//         return true;
//     }else{
//         return false;
//     }
// }


}

?>