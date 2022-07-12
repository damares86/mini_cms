<?php

class Plugins{


    private $conn;
    private $table_name = "plugins";

    public $id;
    public $plugin_name;
    public $link;
    public $page_exist;
    public $second_page;
    public $description;
    public $icon;
    public $title;
    public $sub_show_title;
    public $sub_show_link;
    public $sub_add_title;
    public $sub_add_link;
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
                    link = :link,
                    second_page = :second_page,
                    description = :description,
                    icon = :icon,
                    title = :title,
                    sub_show_title = :sub_show_title, 
                    sub_show_link = :sub_show_link,
                    sub_add_title = :sub_add_title, 
                    sub_add_link = :sub_add_link,
                    active = 0";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
    
        // bind the values
        $stmt->bindParam(':plugin_name', $this->plugin_name);
        $stmt->bindParam(':link', $this->link);
        $stmt->bindParam(':second_page', $this->second_page);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':icon', $this->icon);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':sub_show_title', $this->sub_show_title);
        $stmt->bindParam(':sub_show_link', $this->sub_show_link);
        $stmt->bindParam(':sub_add_title', $this->sub_add_title);
        $stmt->bindParam(':sub_add_link', $this->sub_add_link);
        
        
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
                    plugin_name = :plugin_name";
    // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // bind the values
        $stmt->bindParam(':active', $this->active);
        $stmt->bindParam(':plugin_name', $this->plugin_name);
                
      
        // execute the query, also check if query was successful
        if($stmt->execute()){
            if($this->active==1 && $this->page_exist>0){
                $query1= "INSERT INTO  default_page      
                SET
                page_name = :page_name,
                layout = 'default',
                header = 1,
                img = 'visual.jpg',
                use_name = 1,
                use_desc = 1,
                counter = 1";

                    // prepare the query
                $stmt1 = $this->conn->prepare($query1);
                
                // bind the values
                $stmt1->bindParam(':page_name', $this->plugin_name);  
                
                if($stmt1->execute()){
                    return true;
                }else{
                    return false;
                }
            } else if($this->active==0){
                $this->deletePage();
            }

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
        $this->link = $row['link'];
        $this->second_page = $row['second_page'];
        $this->description = $row['description'];
        $this->icon = $row['icon'];
        $this->title = $row['title'];
        $this->sub_show_title = $row['sub_show_title'];
        $this->sub_show_link = $row['sub_show_link'];
        $this->sub_add_title = $row['sub_add_title'];
        $this->sub_add_link = $row['sub_add_link'];
        $this->active = $row['active'];
    }


    function delete(){
    
    $query = "DELETE FROM " . $this->table_name . " WHERE plugin_name = :plugin_name";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':plugin_name', $this->plugin_name);

    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

function deletePage(){
    
    $query = "DELETE FROM default_page WHERE page_name = :plugin_name";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':plugin_name', $this->plugin_name);

    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}


}

?>