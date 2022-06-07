<?php
class Database{
public $db_name="cms_class";
public $username="root";
public $password="Salomon-86";
public $host="localhost";
public $conn;

public function getConnection(){
$this->conn = null;
try{
$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
}catch(PDOException $exception){
echo "Connection error: " . $exception->getMessage();
}
return $this->conn;
}
}
?>