<?php

/*
    ###################################################################
    #                                                                 #
    #   Reserved Area by damares86 (https://github.com/damares86/)    #
    #                                                                 #
    ###################################################################
*/


if(!is_file('db.php')){
  $dbname=filter_input(INPUT_POST,"dbname");
  $username=filter_input(INPUT_POST,"username");
  $password=filter_input(INPUT_POST,"password");
  $host=filter_input(INPUT_POST,"host");
  $file_handle = fopen('db.php', 'w');
  fwrite($file_handle, '<?php');
  fwrite($file_handle, "\n");
  fwrite($file_handle, '$dbname="'.$dbname.'";');
  fwrite($file_handle, "\n");
  fwrite($file_handle, '$username="'.$username.'";');
  fwrite($file_handle, "\n");
  fwrite($file_handle, '$password="'.$password.'";');
  fwrite($file_handle, "\n");
  fwrite($file_handle, '$server="'.$host.'";');
  fwrite($file_handle, "\n");
  fwrite($file_handle, '?>');
  
}
require "functions.php";

$conn=OpenConnection();

/////////////////////////////////////////////////////////////

// create the db tables if not exists

/////////////////////////////////////////////////////////////

// creating 'admin' table and inserting default 'admin' user with default password 'admin'

$conn->query("CREATE TABLE IF NOT EXISTS admin
                           ( id INT ( 5 ) AUTO_INCREMENT NOT NULL PRIMARY KEY,
                             username VARCHAR(50) NOT NULL,
                             password VARCHAR(255) NOT NULL)");

$conn->query("INSERT INTO admin
                            (id, username, password)
                            VALUES ('1','admin', '$2y$10$/EoJNAFqj1MgZRZOs4iG3OY22LXjUJsFXdPCQGhjUClVRXNup0Vbm')
                            
                            ");

$conn->query("INSERT INTO admin
                        (id, username, password)
                        SELECT * FROM (SELECT '1','admin', '$2y$10$/EoJNAFqj1MgZRZOs4iG3OY22LXjUJsFXdPCQGhjUClVRXNup0Vbm') AS tmp
                        WHERE NOT EXISTS (
                            SELECT username FROM admin WHERE username = 'admin'
                        ) LIMIT 1");



// creazione della tabella per il login
$conn->query("CREATE TABLE IF NOT EXISTS accounts
                           ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             username VARCHAR(50) NOT NULL,
                             password VARCHAR(255) NOT NULL,
                             email VARCHAR(255) NOT NULL,
                             role_id INT(5) NOT NULL)");


// creazione della tabella per il login
$conn->query("CREATE TABLE IF NOT EXISTS files
                           ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             filename VARCHAR(255) NOT NULL,
                             title VARCHAR(255) NOT NULL,
                             role_id INT(5) NOT NULL)");

// creazione della tabella per il login
$conn->query("CREATE TABLE IF NOT EXISTS roles
                           ( id INT ( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             rolename VARCHAR(255) NOT NULL)");

header("Location: ../index.php");

?>
