
<?php
require "admin/template/inc/header.php";


// if(!is_file('admin/class/Database.php')){
// 	require "admin/inc/dbdata.php";

// }

// session_start();


// if (isset($_SESSION['loggedin'])) {
	// 	header('Location: admin/');
	// 	exit;
	// }
	?>

<div id="bottomContainer">
	<div id="content">
		<div class="d-flex justify-content-center ">
				<div class="card mt-3 mb-5 login">
					<div class="card-body">
						<?php
							require "admin/template/inc/alert.php";


								$stmt=$verify->showAll();
								$row=$stmt->fetch(PDO::FETCH_ASSOC);
								$active=$row['active'];

								$send="mngMail";
								if($active==1){
									$send="mngMailRecap";
								}


						?>

							<h3 class="my-3">Contact</h3>

							<form method="POST" class="my-login-validation" novalidate="" action="admin/core/<?=$send?>.php">
								<div class="form-group">
									<label for="name">Your name</label>
									<input id="name" class="form-control" name="name" value="" required autofocus>
								</div>
								<div class="form-group">
									<label for="email">Your Email</label>
									<input id="email" class="form-control" name="email" value="" required autofocus>
								</div>
								<div class="form-group">
									<label for="subject">Subject</label>
									<input id="subject" class="form-control" name="subject" value="" required autofocus>

								</div>
								<div class="form-group">
									<label for="message">Your Message</label>
									<textarea id="message" name="message" placeholder="Write your message here"></textarea>
								</div>
								
								<input type="hidden" name="recaptcha_response" id="recaptchaResponse">

								<br>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Send
									</button>
								</div>
							</form>

				</div>
			</div>
		</div>

</div>
					

						</div> 			
						<?php
require "admin/template/inc/footer.php";
?>