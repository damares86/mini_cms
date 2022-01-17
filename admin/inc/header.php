<?php


require 'phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));


session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../');
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>damares86 Dashboard</title>
        <link type="text/css" href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="assets/css/theme.css" rel="stylesheet">
        <link type="text/css" href="assets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
            <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
            <!--
    ###################################################################
    #                                                                 #
    #   Reserved Area by damares86 (https://github.com/damares86/)    #
    #                                                                 #
    ###################################################################
-->

    </head>
  