<?php

require '../phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));

session_start();

spl_autoload_register('autoloader');

function autoloader($class){
	include("../class/$class.php");
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['email'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

$user->email=$_POST['email'];

$email_exists=$user->emailExists();

// validate login
if ($email_exists && password_verify($_POST['password'], $user->password)){
    session_start();
    // if it is, set the session value to true
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $user->id;
    $_SESSION['name'] = $user->username;
    
    header("Location: ../");
    exit;
    // if access level is 'Admin', redirect to admin section
    // if($user->id=='1'){
    //     header("Location: {$home_url}admin/index.php?action=login_success");
    // }
 
    // // else, redirect only to 'Customer' section
    // else{
    //     header("Location: {$home_url}index.php?action=login_success");
    // }
}
 
// if username does not exist or password is wrong
else{
    $access_denied=true;
    print_r("ko");
}

  
?>