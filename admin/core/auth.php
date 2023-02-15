<?php

// require '../vendor/autoload.php';		// If installed via composer
// $debug = new \bdk\Debug(array(
// 	'collect' => true,
// 	'output' => true,
// ));

    ##############    Mini Cms    ##############
    #                                          #
    #           A project by DM WebLab         #
    #   Website: https://www.dmweblab.com      #
    #   GitHub: https://github.com/damares86   #
    #                                          #
    ############################################


session_start();

spl_autoload_register('autoloader');

function autoloader($class){
	include("../class/$class.php");
}

$database = new Database();
$db = $database->getConnection();

include "../inc/class_initialize.php";




// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['email'], $_POST['password']) ) {
    // Could not get the data that should have been sent.
    header("Location: ../../login.php?msg=errUserPsw");
    exit;
}


        $user->email=$_POST['email'];

        // $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        // $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        $email_exists=$user->emailExists();


        // validate login
        if ($email_exists && password_verify($_POST['password'], $user->password)){
            session_start();
            // if it is, set the session value to true
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['name'] = $user->username;
            $_SESSION['rolename'] = $user->rolename;
                    
            $time=date("Y.m.d, G:i:s");

            $user->updateLog($time);
            
            header("Location: ../");
            exit;
        }
        
        // if username does not exist or password is wrong
        else{
            $access_denied=true;
            header("Location: ../../login.php?msg=errUserPsw");
            exit;
        }


?>