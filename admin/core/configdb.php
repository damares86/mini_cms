<?php
// require '../phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));


/*
==========================================================================

Mini Cms is a project by damares86 (https://github.com/damares86/mini_cms)

==========================================================================
*/


if(!$_POST['dbname']||!$_POST['username']||!$_POST['db_password']||!$_POST['host']||!$_POST['email']||!$_POST['password']){
  header("Location: ../inc/dbdata.php?err=missing");
  exit;
} 

if(!is_file('../class/Database.php')){
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
                             rolename VARCHAR(50) NOT NULL,
                             last_login datetime DEFAULT CURRENT_TIMESTAMP)");

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
  main_img VARCHAR(255) NOT NULL,
  gall VARCHAR(255) NOT NULL,
  title VARCHAR(255) NOT NULL,
  summary text COLLATE utf8_unicode_ci NOT NULL,
  content text COLLATE utf8_unicode_ci NOT NULL,
  modified datetime NOT NULL,
  category_id INT (5) NOT NULL)");

$db->query("CREATE TABLE settings (
  id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  site_name VARCHAR(255) NOT NULL,
  site_description VARCHAR(255) NOT NULL,
  use_text INT (1) DEFAULT '1',
  footer VARCHAR(255) NOT NULL,
  dashboard_language VARCHAR(255) NOT NULL,
  theme VARCHAR(255) NOT NULL,
  dm INT (1) DEFAULT 1)");

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
                              layout VARCHAR(255) NOT NULL DEFAULT 'default',
                              header INT (1) DEFAULT '1',
                              img VARCHAR(255) NOT NULL DEFAULT 'visual.jpg',
                              block1_type VARCHAR(255) DEFAULT 't',
                              block1 text COLLATE utf8_unicode_ci NOT NULL,
                              block1_bg VARCHAR(255) DEFAULT 'none',
                              block1_text VARCHAR(255) DEFAULT '#000000',
                              block2_type VARCHAR(255)  DEFAULT 'n',
                              block2 text COLLATE utf8_unicode_ci NULL,
                              block2_bg VARCHAR(255) DEFAULT 'none',
                              block2_text VARCHAR(255) DEFAULT '#000000',
                              block3_type VARCHAR(255)  DEFAULT 'n',
                              block3 text COLLATE utf8_unicode_ci NULL,
                              block3_bg VARCHAR(255) DEFAULT 'none',
                              block3_text VARCHAR(255) DEFAULT '#000000',
                              block4_type VARCHAR(255)  DEFAULT 'n',
                              block4 text COLLATE utf8_unicode_ci NULL,
                              block4_bg VARCHAR(255) DEFAULT 'none',
                              block4_text VARCHAR(255) DEFAULT '#000000',
                              block5_type VARCHAR(255) DEFAULT 'n',
                              block5 text COLLATE utf8_unicode_ci NULL,
                              block5_bg VARCHAR(255) DEFAULT 'none',
                              block5_text VARCHAR(255) DEFAULT '#000000',
                              block6_type VARCHAR(255) DEFAULT 'n',
                              block6 text COLLATE utf8_unicode_ci NULL,
                              block6_bg VARCHAR(255) DEFAULT 'none',
                              block6_text VARCHAR(255) DEFAULT '#000000')
                              ");

$db->query("CREATE TABLE IF NOT EXISTS menu
                            ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                              pagename VARCHAR(255) NOT NULL,
                              inmenu INT(1) DEFAULT '0',
                              itemorder INT ( 5 ) DEFAULT 0,
                              parent BOOLEAN DEFAULT 0,
                              childof VARCHAR(255) DEFAULT 'none')
                              ");

chmod("../inc/func/regCheck.php",0777);


$db->query("CREATE TABLE IF NOT EXISTS plugins
                            ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                              plugin_name VARCHAR(255) NOT NULL,
                              active INT(1) NOT NULL)
                              ");

$db->query("CREATE TABLE IF NOT EXISTS files
                            ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                              filename VARCHAR(255) NOT NULL,
                              title VARCHAR(255) NOT NULL)
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

$db->query("INSERT INTO color
                            (id, color)
                            VALUES ('4','#ffffff')
                            ");

$db->query("INSERT INTO accounts
(id, username, password,email,rolename)
VALUES ('1','admin', '". $password_hash ."','". $user_email ."','Admin')
");


$db->query("INSERT INTO settings
(id, site_name, site_description,footer,dashboard_language,theme,dm)
VALUES ('1','Mini Cms', 'Create your own website','Your footer text','en','damares','1')
");


$db->query("INSERT INTO page 
(id, page_name, layout, header, img, block1_type, block1, block1_bg, block1_text, block2_type, block2, block2_bg, block2_text, block3_type,block3, block3_bg, block3_text, block4_type,block4, block4_bg, block4_text,  block5_type,block5, block5_bg, block5_text,  block6_type,block6, block6_bg, block6_text) 
VALUES ('1','index', 'default', '1', 'visual.jpg', 't',  '<p>This is your homepage</p>','none','#000000', 'n', '', 'none','#000000', 'n',  '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000')
");

$db->query("INSERT INTO page 
(id, page_name, layout, header, img, block1_type, block1, block1_bg, block1_text, block2_type, block2, block2_bg, block2_text, block3_type,block3, block3_bg, block3_text, block4_type,block4, block4_bg, block4_text,  block5_type,block5, block5_bg, block5_text,  block6_type,block6, block6_bg, block6_text) 
VALUES ('2','Blog', 'default', '1', 'visual.jpg', 't',  '','none','#000000', 'n', '', 'none','#000000', 'n',  '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000')
");

$db->query("INSERT INTO page 
(id, page_name, layout, header, img, block1_type, block1, block1_bg, block1_text, block2_type, block2, block2_bg, block2_text, block3_type,block3, block3_bg, block3_text, block4_type,block4, block4_bg, block4_text,  block5_type,block5, block5_bg, block5_text,  block6_type,block6, block6_bg, block6_text) 
VALUES ('3','Post', 'default', '1', 'visual.jpg', 't',  '','none','#000000', 'n', '', 'none','#000000', 'n',  '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000')
");

$db->query("INSERT INTO page 
(id, page_name, layout, header, img, block1_type, block1, block1_bg, block1_text, block2_type, block2, block2_bg, block2_text, block3_type,block3, block3_bg, block3_text, block4_type,block4, block4_bg, block4_text,  block5_type,block5, block5_bg, block5_text,  block6_type,block6, block6_bg, block6_text) 
VALUES ('4','Login', 'default', '1', 'visual.jpg', 't',  '','none','#000000', 'n', '', 'none','#000000', 'n',  '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000')
");

$db->query("INSERT INTO page 
(id, page_name, layout, header, img, block1_type, block1, block1_bg, block1_text, block2_type, block2, block2_bg, block2_text, block3_type,block3, block3_bg, block3_text, block4_type,block4, block4_bg, block4_text,  block5_type,block5, block5_bg, block5_text,  block6_type,block6, block6_bg, block6_text) 
VALUES ('5','Contact', 'default', '1', 'visual.jpg', 't',  '','none','#000000', 'n', '', 'none','#000000', 'n',  '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000')
");

$db->query("INSERT INTO page 
(id, page_name, layout, header, img, block1_type, block1, block1_bg, block1_text, block2_type, block2, block2_bg, block2_text, block3_type,block3, block3_bg, block3_text, block4_type,block4, block4_bg, block4_text,  block5_type,block5, block5_bg, block5_text,  block6_type,block6, block6_bg, block6_text) 
VALUES ('6','Portfolio', 'default', '1', 'visual.jpg', 't',  '','none','#000000', 'n', '', 'none','#000000', 'n',  '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000')
");

$db->query("INSERT INTO page 
(id, page_name, layout, header, img, block1_type, block1, block1_bg, block1_text, block2_type, block2, block2_bg, block2_text, block3_type,block3, block3_bg, block3_text, block4_type,block4, block4_bg, block4_text,  block5_type,block5, block5_bg, block5_text,  block6_type,block6, block6_bg, block6_text) 
VALUES ('7','Gallery', 'default', '1', 'visual.jpg', 't',  '','none','#000000', 'n', '', 'none','#000000', 'n',  '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000', 'n', '', 'none','#000000')
");

$db->query("INSERT INTO menu 
(id, pagename, inmenu,itemorder,parent,childof) 
VALUES ('1','index', '0','0','1','none')
");

$db->query("INSERT INTO menu 
(id, pagename, inmenu,itemorder,parent,childof) 
VALUES ('2','Blog', '0','0','1','none')
");

$db->query("INSERT INTO menu 
(id, pagename, inmenu,itemorder,parent,childof) 
VALUES ('3','Login', '1','0','1','none')
");

$db->query("INSERT INTO menu 
(id, pagename, inmenu,itemorder,parent,childof) 
VALUES ('4','Contact', '0','0','1','none')
");

$db->query("INSERT INTO menu 
(id, pagename, inmenu,itemorder,parent,childof) 
VALUES ('5','Portfolio', '0','0','1','none')
");

$db->query("CREATE TABLE `password_reset_temp` (
  `email` varchar(250) NOT NULL PRIMARY KEY,
  `token` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
)
");

$db->query("CREATE TABLE `verify` (
  `id` INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `public` varchar(250) NOT NULL,
  `secret` varchar(250) NOT NULL,
  `active` INT ( 5 ) DEFAULT 0
)");

$db->query("INSERT INTO verify
(id, public, secret, active) 
VALUES ('1','PUBLIC_KEY', 'SECRET_KEY', '0')
");


$db->query("CREATE TABLE `contacts` (
  `id` INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `reset` varchar(250) NOT NULL,
  `inbox` varchar(250) NOT NULL
)");

$db->query("INSERT INTO contacts 
(id, reset, inbox) 
VALUES ('1','noreply@yoursite.com', 'info@yoursite.com')
");

$db->query("CREATE TABLE IF NOT EXISTS portfolio
                            ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                              project_title VARCHAR(255) NOT NULL,
                              main_img VARCHAR(255) NOT NULL DEFAULT 'visual.jpg',
                              description text COLLATE utf8_unicode_ci NOT NULL,
                              client VARCHAR(255) NOT NULL,
                              completed date NOT NULL,
                              category INT NOT NULL,
                              link VARCHAR(255) NOT NULL)
                              ");

$db->query("CREATE TABLE IF NOT EXISTS categories_portfolioegories
                           ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             category_name VARCHAR(255) NOT NULL)");


$db->query("INSERT INTO categories_portfolioegories
                            (id, category_name)
                            VALUES ('1','Web design')
                            ");

header("Location: ../index.php");
