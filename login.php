
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
		<div class="row">
			<div class="col-2 col-lg-3 d-none d-sm-block">&nbsp;</div>
			<div class="col px-3 py-5">
				<?php
				require "admin/template/inc/alert.php";
				$op=filter_input(INPUT_GET,"op");
				if($op==""){
				?>
					
					<h3 class="my-3">Login</h3>

					<form method="POST" class="my-login-validation" novalidate="" action="admin/core/auth.php">
						<!-- <div class="form-group">
							<label for="username">Username</label>
							<input id="username" class="form-control" name="username" value="" required autofocus>
						</div> -->
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" class="form-control" name="email" value="" required autofocus>
						</div>

						<div class="form-group">
							<label for="password">Password
								<a href="?op=insert" class="float-right">
									Forgot Password?
								</a>
							</label>
							<input id="password" type="password" class="form-control" name="password" required data-eye>
							<div class="invalid-feedback">
								Password is required
							</div>
						</div>
						
						<br>

						<div class="form-group m-0">
							<button type="submit" class="btn btn-primary btn-block">
								Login
							</button>
						</div>
					</form>
					
			<?php
			} else if($op=="insert"){
				?>

				<a href="login.php"><-- Back to login</a>

				<h3 class="my-3">Forgot your password?</h3>

				<p>Insert your email below to reset your password</p>

				<form method="POST" class="my-login-validation" novalidate="" action="admin/core/mngPass.php">
					<input type="hidden" name="resetForm" value="resetForm" />

					<div class="form-group">
						<label for="email">Email</label>
						<input id="email" class="form-control" name="email" value="" required autofocus>
					</div>


					
					<br>

					<div class="form-group m-0">
						<button type="submit" class="btn btn-primary btn-block">
							Submit
						</button>
					</div>
				</form>

				<?php

			} else if($op=="sentMail"){
				?>

				<div class="alert alert-success" role="alert">
					An email has been sent to you with instructions on how to reset your password.
				</div>

				<a href="login.php"><-- Back to login</a>
				<?php
			}else if($op=="reset"){
				$email=filter_input(INPUT_GET, "email");
				$user->email=$email;
				$token=filter_input(INPUT_GET, "token");
				$user->token=$token;
				$curDate=date("Y-m-d H:i:s");
				// $findToken=$user->findToken();
				$query="SELECT * FROM `password_reset_temp` WHERE (`email` = '.$email.' AND `token` = '.$token.')";
				$stmt=$db->prepare($query);	
				$stmt->execute();
					
				if(!$stmt){	
				?>
				<div class="alert alert-danger">
					Wrong Link
				</div>
				<a href="login.php"><-- Back to login</a>

				<?php	
				}else{
					$user->showEmailPass();
					$expDate=$user->expDate;
					if($expDate>=$curDate){
					?>
				<h3 class="my-3">Insert your new password</h3>
				<form method="POST" class="my-login-validation" novalidate="" action="admin/core/mngPass.php">
					<input type="hidden" name="resetMail" value="resetMail" />
					<input type="hidden" name="email" value="<?=$email?>" />

					
					<div class="form-group">
						<label for="password">Password
							
						</label>
						<input id="password" type="password" class="form-control" name="password" required data-eye>
						<div class="invalid-feedback">
							Password is required
						</div>
					</div>
					<br>

					<div class="form-group m-0">
						<button type="submit" class="btn btn-primary btn-block">
							Submit
						</button>
					</div>
				</form>
					<?php
					
					} else {
						?>
					<div class="alert alert-danger">
					Your link is expired
					</div>
				<a href="login.php"><-- Back to login</a>

				<?php

					}

			}
			$query="DELETE FROM `password_reset_temp` WHERE email = '.$email.'";
			$stmt=$db->prepare($query);	
			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}
			?>
			</div>
			<div class="col-2 col-lg-3 d-none d-sm-block">&nbsp;</div>
		</div>
	
</div>
					

						</div> 			
						<?php
require "admin/template/inc/footer.php";
?>