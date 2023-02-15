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

$lang=$_POST['lang'];
require "../locale/$lang.php";

// loading class
	spl_autoload_register('autoloader');
    function autoloader($class){
        include("../class/$class.php");
    }


$database = new Database();
$db = $database->getConnection();

include "../inc/class_initialize.php";

	
	$resetForm = filter_input(INPUT_POST, "resetForm");
	$resetMail = filter_input(INPUT_POST, "resetMail");

	if($resetForm){
		
	
		// receive the reset password request

		if(!isset($_POST['email'])){
			header("Location: ../../login.php?msg=mailResetErr");
			exit;
		}

		$user->email=$_POST['email'];
		$email=$_POST['email'];
		// $email = filter_var($email, FILTER_SANITIZE_EMAIL);
		// $email = filter_var($email, FILTER_VALIDATE_EMAIL);

		$email_exists=$user->emailExists();
		
		if(!$email_exists){
			header("Location: ../../login.php?msg=mailNotReg");
			exit;
		}
		
		$query="SELECT * FROM `".$user->prx."password_reset_temp` WHERE `email` = '$email' LIMIT 0,1";
		$stmt=$db->prepare($query);	
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		$curDate=date("Y-m-d H:i:s");
		$expDate=$row['expDate'];
		
		if((!$row['email']||(($row['email']) && ($expDate<$curDate)))){
			$query="DELETE FROM `".$user->prx."password_reset_temp` WHERE `email` = '$email'";
			$stmt=$db->prepare($query);	
			if(!$stmt->execute()){
				header("Location: ../../login.php?msg=noResetDelete");
				exit;
			}else {
			$expFormat = mktime(date("H")+1, date("i"), date("s"), date("m") ,date("d"), date("Y"));
			$expDate = date("Y-m-d H:i:s",$expFormat);
			// $user->expDate=$expDate;
			$token = md5(2418*2+$email);
			$addToken= substr(md5(uniqid(rand(),1)),3,10);
			$token = $token . $addToken;
			$user->token=$token;
			// $user->addResetPassKey();
			$query="INSERT INTO `".$user->prx."password_reset_temp` (`email`, `token`, `expDate`)
			VALUES ('".$email."', '".$token."', '".$expDate."');";
			$stmt=$db->prepare($query);

			if($stmt->execute()){
	
				function get_base_url() {
					$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
					$sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
					$protocol = substr($sp, 0, strpos($sp, "/")) . $s;
					$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
					return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port ;
				}
				// esempio di utilizzo
				$url = get_base_url();

				// select the noreply mail from database
				$stmt=$contact->showAll();
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
				$from=$row['reset'];



				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				// Create email headers
				$headers .= 'From: '.$from."\r\n".
				'Reply-To: '.$from."\r\n" .
				'X-Mailer: PHP/' . phpversion();

				$output=$reset_output1;
				$output.='<p><a href="'.$url.'/login.php?email='.$email.'&token='.$token.'&op=reset" target="_blank">'.$url.'/login.php?email='.$email.'&token='.$token.'&op=reset</a></p>';		
				$output.=$reset_output2;
				
				$to= $email; 
				$subject="Reset password Mini Cms";

				
				if (mail ($to, $subject, $output, $headers)) {
					header("Location: ../../login.php?msg=sentMail");
					exit;
				} else {
					header("Location: ../../login.php?msg=errSend");
					exit;
				}
			
			}else{	
				header("Location: ../../login.php?msg=noReset");
				exit;
			}
		}
		} else{
			header("Location: ../../login.php?msg=errResetRequest");
			exit;
		}
	}else if($resetMail) {

		$email=filter_input(INPUT_POST, "email");
		$user->email=$email;
		$user->showByEmail();

		if(!$_POST['password']){
			header("Location: ../../login.php?msg=pswEmpty");
			exit;
		}
	
		$user->password = $_POST['password'];

		// update the post
		if($user->updatePass()){
			$query="DELETE FROM ".$user->prx."password_reset_temp WHERE email = '$email'";
			$stmt=$db->prepare($query);	
			if($stmt->execute()){
				header("Location: ../../login.php?msg=newPass");
				exit;
			}else{
				header("Location: ../../login.php?msg=keyDelErr");
				exit;
			}
			// empty posted values
			// $_POST=array();
			
		}else{
			header("Location: ../../login.php?msg=pswEditErr");
			exit;
		}
	}else{	
		$user->id = $_POST['idToMod'];
		
		if(!$_POST['password']){
			header("Location: ../index.php?man=users&op=show&msg=pswEmpty");
			exit;
		}
		
		$user->password = $_POST['password'];
		
		// update the post
		if($user->updatePass()){
			header("Location: ../index.php?man=users&op=show&msg=userEditSucc");
			exit;
			
			// empty posted values
			// $_POST=array();
			
		}else{
			header("Location: ../index.php?man=users&op=show&msg=userEditErr");
			exit;
		}
	}
		
exit;

?>