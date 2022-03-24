<?php


// require 'phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));

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
$total_user=$user->countAll();
$role = new Role($db);
$post = new Post($db);
$total_post=$post->countAll();
$page = new Page($db);



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mini Cms - Dashboard</title>

    <!-- Custom fonts for this template-->
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script> <!-- per le modali -->
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script type="text/javascript" src="scripts/farbtastic/farbtastic.js"></script>
        <link rel="stylesheet" href="scripts/farbtastic/farbtastic.css" type="text/css" />

            <!-- <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script> -->
            <link href="scripts/summernote/summernote.css" rel="stylesheet">

            <!-- Custom styles for this template-->
            <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">-->
           
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> 
            <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
            <link href="assets/css/custom.css" rel="stylesheet">
            <script>
    $(document).ready(function(){
        $(".btn").click(function(){
            $("#myModal").modal('show');
        });
    });
</script>

</head>