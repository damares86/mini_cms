<?php

// require '../vendor/autoload.php';		// If installed via composer
// $debug = new \bdk\Debug(array(
// 	'collect' => true,
// 	'output' => true,
// ));

session_start();

spl_autoload_register('autoloader');

function autoloader($class){
	include("../class/$class.php");
}

$database = new Database();
$db = $database->getConnection();

include "../inc/class_initialize.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
    $stmt=$verify->showAll();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $secret=$row['secret'];
    // Costruire il POST request:      
    
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = $secret;
    $recaptcha_response = $_POST['recaptcha_response'];
    
    // Istanziare e decodificare la richiesta POST:      
    
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
    
    // Azioni da compiere basate sul punteggio ottenuto:      
    
    if ($recaptcha->score >= 0.5) {
    


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
            
            header("Location: ../");
            exit;
        }
        
        // if username does not exist or password is wrong
        else{
            $access_denied=true;
            header("Location: ../../login.php?msg=errUserPsw");
            exit;
        }


    }else{
        header("Location: ../../login.php?msg=errRecaptcha");
        exit;
    }

}else{
    header("Location: ../../login.php?msg=errPost");
    exit;
}





  
?>