<?php

    ##############    Mini Cms    ##############
    #                                          #
    #           A project by DM WebLab         #
    #   Website: https://www.dmweblab.com      #
    #   GitHub: https://github.com/damares86   #
    #                                          #
    ############################################

    class Colors{


    private $conn;
    private $table_name = "color";
    
    public $id;
    public $color;
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


    // create new color record
    function create(){
    
        // insert query
        $query = "INSERT INTO
                    " .$this->prx. $this->table_name . "
                SET
                    color = :color";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->color=htmlspecialchars(strip_tags($this->color));
    
        // bind the values
        $stmt->bindParam(':color', $this->color);
        
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    
    }

    function showAllList(){
        //select all data
        $query = "SELECT
                    id, color
                FROM
                    " .$this->prx. $this->table_name . "
                ORDER BY
                    color";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    public function countAll(){
    
        $query = "SELECT id FROM ".$this->prx."color";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }

    function showById(){
        $query = "SELECT *
        FROM " .$this->prx. $this->table_name . "
        WHERE id = ?
        LIMIT 0,1";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->id = $row['id'];
    }


    function colorExists(){
    
        // query to check if color exists
        $query = "SELECT id, color
                FROM " .$this->prx. $this->table_name . "
                WHERE color = ?
                LIMIT 0,1";
    
        // prepare the query
        $stmt = $this->conn->prepare( $query );
    
        // sanitize
        $this->color=htmlspecialchars(strip_tags($this->color));
    
        // bind given color value
        $stmt->bindParam(1, $this->color);
    
        // execute the query
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        if($num>0){
    
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // assign values to object properties
            $this->id = $row['id'];
            $this->color = $row['color'];
    
            // return true because color exists in the database
            return true;
        }
    
        // return false if color does not exist in the database
        return false;
    }

 // delete the color
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