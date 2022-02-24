<?php


//require 'phpDebug/src/Debug/Debug.php';   			// if not using composer

//$debug = new \bdk\Debug(array(
 //   'collect' => true,
 //   'output' => true,
//));

session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}


// loading class

spl_autoload_register('autoloader');

function autoloader($class){
	include("class/$class.php");
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$role = new Role($db);
$post = new Post($db);
$page = new Page($db);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <!--
        ==========================================================================

        Mini Cms is a project by damares86 (https://github.com/damares86/mini_cms)
        
        ==========================================================================
        -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mini Cms - Dashboard</title>        
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        <link type="text/css" href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="assets/css/theme.css" rel="stylesheet">
        <link type="text/css" href="assets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
        <script type="text/javascript" src="scripts/farbtastic/farbtastic.js"></script>
        <link rel="stylesheet" href="scripts/farbtastic/farbtastic.css" type="text/css" />

            <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
         
  
    </head>
  
