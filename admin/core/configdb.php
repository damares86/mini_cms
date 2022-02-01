<?php
require '../phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));
/*
    ###################################################################
    #                                                                 #
    #   Reserved Area by damares86 (https://github.com/damares86/)    #
    #                                                                 #
    ###################################################################
*/


if(!is_file('../class/Database.php')){
  $db_name=filter_input(INPUT_POST,"dbname");
  $username=filter_input(INPUT_POST,"username");
  $password=filter_input(INPUT_POST,"password");
  $host=filter_input(INPUT_POST,"host");
  $file_handle = fopen('../class/Database.php', 'w');
  fwrite($file_handle, '<?php');
  fwrite($file_handle, "\n");
  fwrite($file_handle, "class Database{");
  fwrite($file_handle, "\n");
  fwrite($file_handle, 'private $db_name="'.$db_name.'";');
  fwrite($file_handle, "\n");
  fwrite($file_handle, 'private $username="'.$username.'";');
  fwrite($file_handle, "\n");
  fwrite($file_handle, 'private $password="'.$password.'";');
  fwrite($file_handle, "\n");
  fwrite($file_handle, 'private $host="'.$host.'";');
  fwrite($file_handle, "\n");
  fwrite($file_handle, 'public $conn;');
  fwrite($file_handle, "\n");
  fwrite($file_handle, "\n");
  fwrite($file_handle, "public function getConnection(){");
  fwrite($file_handle, "\n");
  fwrite($file_handle, '$this->conn = null;');
  fwrite($file_handle, "\n");
  fwrite($file_handle, 'try{');
  fwrite($file_handle, "\n");
  fwrite($file_handle, '$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);');
  fwrite($file_handle, "\n");
  fwrite($file_handle, '}catch(PDOException $exception){');
  fwrite($file_handle, "\n");
  fwrite($file_handle, 'echo "Connection error: " . $exception->getMessage();');
  fwrite($file_handle, "\n");
  fwrite($file_handle, '}');
  fwrite($file_handle, "\n");
  fwrite($file_handle, 'return $this->conn;');
  fwrite($file_handle, "\n");
  fwrite($file_handle, '}');
  fwrite($file_handle, "\n");
  fwrite($file_handle, '}');
  fwrite($file_handle, "\n");

  fwrite($file_handle, '?>');
  
}

spl_autoload_register('autoloader');

function autoloader($class){
	include("../class/$class.php");
}

$database = new Database();
$db = $database->getConnection();


/////////////////////////////////////////////////////////////

// create the db tables if not exists

/////////////////////////////////////////////////////////////

// creating user's table and inserting the default "admin" user
$db->query("CREATE TABLE IF NOT EXISTS accounts
                           ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             username VARCHAR(50) NOT NULL,
                             password VARCHAR(255) NOT NULL,
                             email VARCHAR(255) NOT NULL,
                             rolename VARCHAR(50) NOT NULL)");

// creating role's table
$db->query("CREATE TABLE IF NOT EXISTS roles
                           ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             rolename VARCHAR(255) NOT NULL)");

$db->query("INSERT INTO roles
                            (id, rolename)
                            VALUES ('1','Admin')
                            ");

$db->query("INSERT INTO roles
                            (id, rolename)
                            VALUES ('2','Editor')
                            ");
$db->query("INSERT INTO roles
                            (id, rolename)
                            VALUES ('3','Contributor')
                            ");


$db->query("CREATE TABLE post (
  id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content text COLLATE utf8_unicode_ci NOT NULL,
  modified datetime NOT NULL,
  category VARCHAR(255) NOT NULL) 
  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

$db->query("CREATE TABLE settings (
  id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  site_name VARCHAR(255) NOT NULL,
  site_description VARCHAR(255) NOT NULL,
  dashboard_language VARCHAR(255) NOT NULL)");

$db->query("CREATE TABLE IF NOT EXISTS categories
                           ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             category_name VARCHAR(255) NOT NULL)");

$db->query("INSERT INTO categories
                            (id, category_name)
                            VALUES ('1','Misc')
                            ");

$db->query("CREATE TABLE IF NOT EXISTS page
                            ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                              page_name VARCHAR(255) NOT NULL,
                              block1 text COLLATE utf8_unicode_ci NOT NULL,
                              block1_bg VARCHAR(255) DEFAULT 'none',
                              block2 text COLLATE utf8_unicode_ci NULL,
                              block2_bg VARCHAR(255) DEFAULT 'none',
                              block3 text COLLATE utf8_unicode_ci NULL,
                              block3_bg VARCHAR(255) DEFAULT 'none',
                              block4 text COLLATE utf8_unicode_ci NULL,
                              block4_bg VARCHAR(255) DEFAULT 'none')
                              ");

$db->query("CREATE TABLE IF NOT EXISTS color
                              ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                color VARCHAR(50) NOT NULL)");
$db->query("INSERT INTO color
                              (id, color)
                              VALUES ('1','#008db1')
                              ");
$db->query("INSERT INTO color
                            (id, color)
                            VALUES ('2','#00cc99')
                            ");
                           
$db->query("INSERT INTO accounts
(id, username, password,email,rolename)
VALUES ('1','admin', '$2y$10$/EoJNAFqj1MgZRZOs4iG3OY22LXjUJsFXdPCQGhjUClVRXNup0Vbm','mail@mail.com','Admin')
");


$db->query("INSERT INTO settings
(id, site_name, site_description,dashboard_language)
VALUES ('1','Your site name', 'This is a short description of your website','en')
");

header("Location: ../index.php");
