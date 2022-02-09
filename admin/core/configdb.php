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


if(!$_POST['dbname']||!$_POST['username']||!$_POST['db_password']||!$_POST['host']||!$_POST['email']||!$_POST['password']){
  header("Location: ../inc/dbdata.php?err=missing");
  exit;
} else if(!is_file('../class/Database.php')){
  $db_name=filter_input(INPUT_POST,"dbname");
  $username=filter_input(INPUT_POST,"username");
  $db_password=filter_input(INPUT_POST,"db_password");
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
  fwrite($file_handle, 'private $password="'.$db_password.'";');
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

chmod('../class/Database.php',0777);

spl_autoload_register('autoloader');

function autoloader($class){
	include("../class/$class.php");
}

$database = new Database();
$db = $database->getConnection();

$user_email=$_POST['email'];
$password=$_POST['password'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$user=new User($db);


/////////////////////////////////////////////////////////////

// create the db tables if not exists

/////////////////////////////////////////////////////////////

// creating user's table 
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
  summary text COLLATE utf8_unicode_ci NOT NULL,
  content text COLLATE utf8_unicode_ci NOT NULL,
  modified datetime NOT NULL,
  category_id INT (5) NOT NULL) 
  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

$db->query("CREATE TABLE settings (
  id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  site_name VARCHAR(255) NOT NULL,
  site_description VARCHAR(255) NOT NULL,
  dashboard_language VARCHAR(255) NOT NULL,
  theme VARCHAR(255) NOT NULL)");

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
                              block1_text VARCHAR(255) DEFAULT '#000000',
                              block2 text COLLATE utf8_unicode_ci NULL,
                              block2_bg VARCHAR(255) DEFAULT 'none',
                              block2_text VARCHAR(255) DEFAULT '#000000',
                              block3 text COLLATE utf8_unicode_ci NULL,
                              block3_bg VARCHAR(255) DEFAULT 'none',
                              block3_text VARCHAR(255) DEFAULT '#000000',
                              block4 text COLLATE utf8_unicode_ci NULL,
                              block4_bg VARCHAR(255) DEFAULT 'none',
                              block4_text VARCHAR(255) DEFAULT '#000000')
                              ");

$db->query("CREATE TABLE IF NOT EXISTS menu
                            ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                              pagename VARCHAR(255) NOT NULL,
                              inmenu VARCHAR(1) DEFAULT 'n',
                              itemorder INT ( 5 ) DEFAULT 0,
                              parent BOOLEAN DEFAULT 0,
                              childof VARCHAR(255) DEFAULT 'none')
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
$db->query("INSERT INTO color
                           (id, color)
                           VALUES ('3','#000000')
                           ");

$db->query("INSERT INTO accounts
(id, username, password,email,rolename)
VALUES ('1','admin', '". $password_hash ."','". $user_email ."','Admin')
");


$db->query("INSERT INTO settings
(id, site_name, site_description,dashboard_language,theme)
VALUES ('1','Mini Cms', 'Description of your website','en','dm_theme')
");


$db->query("INSERT INTO page 
(id, page_name, block1, block1_bg, block1_text,block2, block2_bg, block2_text,block3, block3_bg, block3_text,block4, block4_bg, block4_text) 
VALUES ('1','index', '<p>This is your homepage</p>','none','#000000','', 'none','#000000', '', 'none','#000000','', 'none','#000000')
");


$db->query("INSERT INTO page 
(id, page_name, block1, block1_bg, block1_text,block2, block2_bg, block2_text,block3, block3_bg, block3_text,block4, block4_bg, block4_text) 
VALUES ('2','Blog', '<p>This is your blog page</p>','none','#000000','', 'none','#000000', '', 'none','#000000','', 'none','#000000')
");

$db->query("INSERT INTO menu 
(id, pagename, inmenu) 
VALUES ('1','index', 'y')
");

$db->query("INSERT INTO menu 
(id, pagename, inmenu) 
VALUES ('2','Blog', 'y')
");



header("Location: ../index.php");
