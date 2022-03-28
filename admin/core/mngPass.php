<?php

// require '../phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));


session_start();
// if (!isset($_SESSION['loggedin'])) {
// 	header('Location: ../');
//     exit;
// }

// loading class
	include("../class/Database.php");
	include("../class/User.php");

	
	$database = new Database();
	$db = $database->getConnection();
	
	$user = new User($db);
	
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
		
		$expFormat = mktime(date("H")+1, date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
		$expDate = date("Y-m-d H:i:s",$expFormat);
		// $user->expDate=$expDate;
		$key = md5(2418*2+$email);
		$addKey = substr(md5(uniqid(rand(),1)),3,10);
		$key = $key . $addKey;
		$user->keys=$key;
		// $user->addResetPassKey();
		$query="INSERT INTO `password_reset_temp` (`email`, `keys`, `expDate`)
		VALUES ('".$email."', '".$key."', '".$expDate."');";
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


		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$from="noreply@davidemasera.it";
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
		'Reply-To: '.$from."\r\n" .
		'X-Mailer: PHP/' . phpversion();

		$output='<html><body>';
		$output.='<p>Dear user,</p>';
		$output.='<p>Please click on the following link to reset your password.</p>';
		$output.='<p>-------------------------------------------------------------</p>';
		$output.='<p><a href="'.$url.'/login.php?email='.$email.'&key='.$key.'&op=reset" target="_blank">'.$url.'/login.php?key='.$key.'&email='.$email.'&op=reset</a></p>';		
		$output.='<p>-------------------------------------------------------------</p>';
		$output.='<p>Please be sure to copy the entire link into your browser.
		The link will expire after 1 hour for security reason.</p>';
		$output.='<p>If you did not request this forgotten password email, no action 
		is needed, your password will not be reset. However, you may want to log into 
		your account and change your security password as someone may have guessed it.</p>';   	
		$output.='<p>Thanks,</p>';
		$output.='<p>Mini CMS</p>';
		$output.='</body></html>';
		
		$to= $email; 
		$subject="Reset password Mini Cms";

		
		if (mail ($to, $subject, $output, $headers)) {
			header("Location: ../../login.php?op=sentMail");
			exit;
		} else {
			header("Location: ../../login.php?msg=errSend");
			exit;
		}
	
	}else{	
		$this->showError($stmt);
		return false;
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
			$query="DELETE FROM password_reset_temp WHERE email = '$email'";
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